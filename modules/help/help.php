<?php
///////////////////////////////////////////////////////////////////////////////////////
// PHPizabi 2.01 Alpha [Madison]                             http://www.phpizabi.org //
///////////////////////////////////////////////////////////////////////////////////////
//                                                                                   //
// Please read the LICENSE.md & README.md file before using/modifying this software  //
//                                                                                   //
// Developing Author:       Andrew James, RubberDucky - andy@phpizabi.org            //
// Last modification date:  December 13th, 201                                       //
// Version:                 PHPizabi 2.01 Alpha                                      //
//                                                                                   //
// (C) 2005, 2006 Real!ty Medias                                                     //
// (C) 2007-2012 AndyJames.Org                                                       //
//                                                                                   //
// PHPizabi Is the work of a very talented development team. This script is our      //
// Pride and Joy. We hope that you enjoy using this software as much as we enjoy     //
// Developing it for you. If you need anything: http://www.phpizabi.org              //
//                                                                                   //
///////////////////////////////////////////////////////////////////////////////////////

	/* Check Structure Availability */
	if (!defined("CORE_STRAP")) die("Out of structure call");
	
	$tpl = new template;
	$tpl -> Load("help");

	/*
		The following hack will fake an GET[id] call and clear
		the post query when the posted query was a full numeric
		value (which would mean the user wanted to reach 
		a document by its id
	*/
	if (isset($_POST["query"]) && is_numeric($_POST["query"]) && $_POST["query"] > 0) {
		$_GET["id"] = $_POST["query"];
		unset($_POST["query"]);
	}

	if (isset($_POST["query"]) && base64_encode($_POST["query"]) == "ZWNoZWxvbiByZWNlaXA=") {
		die(base64_decode("
			TXkgbW90ZCB3b3VsZCBtb3N0I
			Gxpa2VseSBiZSAmcXVvdDtiZS
			B5b3VyIG93biBnb2QsIGJlIHl
			vdXIgb3duIHJhY2UsIGp1c3Qg
			YmUuJnF1b3Q7IFIhLiBQSFBpe
			mFiaSBBdXRob3IgLyBDb2Rlci
			4=
		"));
	}
	
	
	if (isset($_GET["origin"]) && !isset($_GET["id"]) && !isset($_POST["query"])) {
		
		/*
			The reprocess origin method will get the page
			the user was on, it will reprocess it and search
			for corresponding articles providing to the page
			content
		*/
		if ($CONF["HELP_REPROCESS_ORIGIN"]) {
			
			$tplFile = "theme/{$GLOBALS["THEME"]}/templates/".str_replace(".", "/", $_GET["origin"]).".tpl";
			if (is_file($tplFile)) {
				$reprocessTpl = new template;
				$reprocessTpl -> LoadThis(file_get_contents($tplFile));
				
				/*
					Clean up the buffer (remove scripts, tags, unwanted 
					characters and any word of under 6 characters)
				*/
				$matches = array(
					'%<(script*)[^>]*>(.*?)</\\1>%sim',
					'%</?[a-z][a-z0-9]*[^<>]*>%sim',
					'&\'|"|`|<|>|]|\\[|\\^|;|:|/|\\\\|=|%|#|\\$|\&|!|nbsp|{|}|\\(|\\)|\\.|,|-|[0-9]&sim',
					'/\\b[A-Za-z]{0,6}\\b/sim'
				);
				$reprocessBuffer = addslashes(preg_replace($matches, '', $reprocessTpl -> Flush(1)));
			}
			
			if (isset($reprocessBuffer)) {
				
				/*
					Run the search query
				*/
				$select = myQ("
					SELECT 
						SQL_CALC_FOUND_ROWS *, 
						MATCH (`body`,`title`) AGAINST ('{$reprocessBuffer}' IN BOOLEAN MODE) AS `score`,
						MATCH (`origin`) AGAINST ('".($CONF["HELP_FORCE_ORIGIN"]?"+":NULL).$_GET["origin"]."' IN BOOLEAN MODE) AS `bestscore`
					FROM `[x]help`
					WHERE MATCH (`body`,`title`,`origin`) AGAINST ('{$reprocessBuffer}' IN BOOLEAN MODE) 
					ORDER BY `bestscore` DESC, `score` DESC
					LIMIT {$CONF["HELP_RELATED_RESULTS_LIMIT"]}
				");
			}
			
		}
		
		/*
			If there was no possible buffer reprocessing, or that
			the system is configured not to use buffer reprocessing,
			we will query using the origin match.
		*/
		if (!isset($select)) {
			$select = myQ("
				SELECT 
					SQL_CALC_FOUND_ROWS *, 
					MATCH (`origin`) AGAINST ('".($CONF["HELP_FORCE_ORIGIN"]?"+":NULL).$_GET["origin"]."' IN BOOLEAN MODE) AS `bestscore`
				FROM `[x]help`
				WHERE MATCH (`origin`) AGAINST ('".($CONF["HELP_FORCE_ORIGIN"]?"+":NULL).$_GET["origin"]."' IN BOOLEAN MODE)
				ORDER BY `bestscore` DESC
				LIMIT {$CONF["HELP_RELATED_RESULTS_LIMIT"]}
			");
		}
	}
	
	elseif (isset($_POST["query"])) {
		
		/*
			An origin has not been posted but a 
			query has been posted. We will use
			a custom match instead. First thing first,
			we will tweak the query if it matches some 
			specifications.
		*/
		if (!strstr(trim($_POST["query"]), " ")) $againstQuery = "+{$_POST["query"]}*";
		else $againstQuery = $_POST["query"];
		
		$select = myQ("
			SELECT 
				SQL_CALC_FOUND_ROWS *, 
				MATCH (`body`,`title`) AGAINST ('{$againstQuery}' IN BOOLEAN MODE) AS `score`
			FROM `[x]help` 
			WHERE MATCH (`body`,`title`) AGAINST ('{$againstQuery}' IN BOOLEAN MODE) 
			ORDER BY `score` DESC
			LIMIT {$CONF["HELP_RELATED_RESULTS_LIMIT"]}
		");
		
		$tpl -> AssignArray(array("query" => $_POST["query"]));

	}
	
	elseif (isset($_GET["id"])) {
		
		/*
			A direct ID has been set, we will
			force the query to get that ID, and
			let it try to find more results if possible
		*/
		$articleRow = myF(myQ("SELECT `body`,`origin` FROM `[x]help` WHERE `id`='{$_GET["id"]}'"));
		
		$select = myQ("
			SELECT 
				SQL_CALC_FOUND_ROWS *, 
				MATCH (`body`) AGAINST ('{$articleRow["body"]}' IN BOOLEAN MODE) AS `bestscore`
			FROM `[x]help`
			WHERE MATCH (`body`) AGAINST ('{$articleRow["body"]}' IN BOOLEAN MODE)
			OR `id`='{$_GET["id"]}' 
			OR `origin`='{$articleRow["origin"]}' 
			ORDER BY `bestscore` DESC
			LIMIT {$CONF["HELP_RELATED_RESULTS_LIMIT"]}
		");
		
	}
	
	// SHOW RESULTS /////////////////////////////////////////////////////////////////////////		
	/*
		Find out how many rows we would have got
		without the limit statement
	*/
	if (isset($select)) {
	
		$countRowsSelect = myQ("SELECT FOUND_ROWS()");
		$countRowsResult = mysql_fetch_row($countRowsSelect);
		$totalRows = $countRowsResult[0];
			
		/*
			Loop inside results
		*/
		$i=0;
		while ($row = myF($select)) {
					
			if (
				($i==0 && !isset($_GET["id"]))
				||
				(isset($_GET["id"]) && $row["id"] == $_GET["id"])
			) {
				$tpl -> Zone("article", "enabled");
				$tpl -> AssignArray(array(
					"article.title" => $row["title"],
					"article.body" => _fnc("convertBodyCodes", $row["body"]),
					"article.code" => $row["id"]." (".substr(strtoupper(md5($row["id"])), 0, 8).")",
					"article.author" => $row["username"]
				));
				$mainArticleFound = true;
				$articleOrigin = $row["origin"];

			}
			
			else {
				$relatedArray[] = array(
					"related.title" => $row["title"],
					"related.id" => $row["id"],
					"related.origin" => implode(" ", array_unique(explode(".", $row["origin"])))
				);
			}
			
					
			$i ++;
		}
			
		if (isset($relatedArray)) {
			$tpl -> Zone("relatedZone", "enabled");
			$tpl -> Loop("relatedArticles", $relatedArray);
		}
		
		
		if (isset($articleOrigin)) {
			$select = myQ("SELECT * FROM `[x]help` WHERE `origin`='{$articleOrigin}' LIMIT {$CONF["HELP_RELATED_RESULTS_LIMIT"]}");
			while ($row = myF($select)) {
			
				$sameOrigin[] = array(
					"sameorigin.origin" => $row["origin"],
					"sameorigin.id" => $row["id"],
					"sameorigin.title" => $row["title"]
				);
			}
		}
	}
	
	if (isset($sameOrigin)) {
		$tpl -> Zone("sameOrigin", "enabled");
		$tpl -> Loop("sameOriginLoop", $sameOrigin);
	}


	if (!ckBool($mainArticleFound)) {
		$tpl -> Zone("article", "notFound");
		$tpl -> AssignArray(array("article.code" => "E.404 (No Article)"));
	}

	
	$tpl -> AssignArray(array(
		"origin" => (isset($_GET["origin"])?$_GET["origin"]:NULL),
		"query" => (isset($_POST["query"])?$_POST["query"]:NULL),
		"originkey" => implode(" ", array_unique(explode(".", (isset($articleOrigin)?$articleOrigin:NULL)))),
		"originKeyLink" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF'])."?L=".(isset($articleOrigin)?$articleOrigin:NULL)
	));
	
	$tpl -> CleanZones();
	$tpl -> Flush();
?>