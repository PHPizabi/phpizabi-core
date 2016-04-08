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
	
	// TEMPLATE HANDLING ////////////////////////////////////////////////////////////////// FINAL //
	/*
		Initialize the template engine and
		load the template file. Get objects,
		convert self user.
	*/
	$tpl = new template;
	$tpl -> Load("topic");
	$tpl -> GetObjects();

	if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
		
		// HANDLE DELETE REQUEST /////////////////////////////////////////////////////////
		if (isset($_GET["delete"])) {
			if (me("is_administrator") or me("is_superadministrator"))
				myQ("DELETE FROM `[x]inkspot` WHERE `id`='{$_GET["delete"]}'");
		}
		
		// LOAD ORIGINS //////////////////////////////////////////////////////////////////
		/*
			This loads the called ID topic string and subject ID,
			we will go get those values from the database so we're
			sure we get the right content even if the user called
			a thread content ID instead of the main originating post
		*/
		$postInfo = myF(myQ("
			SELECT `id`,`topic`,`subject`,`user`,`view_count`
			FROM `[x]inkspot`
			WHERE `id` = '{$_GET["id"]}'
			LIMIT 1
		"));
		
		$tpl -> AssignArray(array(
			"subject.id" => $postInfo["subject"],
			"topic.id" => $_GET["id"]
		));

		// HANDLE DELETE THREAD //////////////////////////////////////////////////////////
		if (isset($_GET["rmthread"])) {
			if (me("is_administrator") or me("is_superadministrator")) {

				/* Delete all replies */
				myQ("
					DELETE FROM `[x]inkspot`
					WHERE `topic`='{$postInfo["topic"]}'
					AND `subject`='{$postInfo["subject"]}'
					AND `origin` != '1'
				");
				
				/* Delete Origin post */
				myQ("
					DELETE FROM `[x]inkspot`
					WHERE `id`='{$postInfo["id"]}'
				");
			
				_fnc("reload", 0, "?L=inkspot.subject&id={$postInfo["subject"]}");
			}
		}
		
		if (me("is_administrator") or me("is_superadministrator")) {
			$tpl -> Zone("admin", "enabled");
		}
		
		// LOAD SUBJECT OBJECT ///////////////////////////////////////////////////////////
		/*
			Load the inkspot subjects array
		*/
		$inkSpotSubjects = unpk(file_get_contents("system/cache/inkspot.dat"));
		if (!is_array($inkSpotSubjects)) $inkSpotSubjects = array();
			
		foreach ($inkSpotSubjects as $key => $inkSpotArray) {
			if ($inkSpotArray["ID"] == $postInfo["subject"]) {
				$spotKey = $key;
				break;
			}
		}
		
		// UPDATE THE VIEWS COUNTER //////////////////////////////////////////////////////
		if (!isset($_SESSION["last_spot_view"]) || $_SESSION["last_spot_view"] != $_GET["id"]) {
			
			myQ("
				UPDATE `[x]inkspot`
				SET `view_count` = '".($postInfo["view_count"]+1)."'
				WHERE `topic`='{$postInfo["topic"]}'
				AND `subject`='{$postInfo["subject"]}'
			");
			
			$_SESSION["last_spot_view"] = $_GET["id"];
		}
		
		// HANDLE POSTED REPLY ///////////////////////////////////////////////////////////
		if (isset($_POST["Submit"]) && isset($_POST["body"]) && $_POST["body"] != "") {
			
			/* 
				Only admins can post in a locked subject
			*/
			if (
				($inkSpotSubjects[$spotKey]["LOCKED"] && 
					(me("is_administrator") || me("is_superadministrator"))
				) || (!$inkSpotSubjects[$spotKey]["LOCKED"])
			) {
					
				/*
					Control the post allow array
				*/
				$allowList = explode(",", $inkSpotSubjects[$spotKey]["TYPES"]);
				if (
					(!isset($_SESSION["id"]) && in_array("g", $allowList))
					||
					(isset($_SESSION["id"]) && in_array("u", $allowList))
					||
					(in_array(me("account_type"), $allowList))
					||
					(me("is_administrator") || me("is_superadministrator"))
				) {

					if ($CONF["INKSPOT_SPAN_POSTS"] && strlen($_POST["body"]) > $CONF["INKSPOT_SPAN_CHARLEN"]) {
			
						$body = str_chunk($_POST["body"], $CONF["INKSPOT_SPAN_CHARLEN"]);

						$i=0;

						foreach ($body as $bodyChunk) {
					
							myQ("
								INSERT INTO `[x]inkspot` 
								(`subject`,`topic`,`user`,`origin_user`,`body`,`date`)
								VALUES
								(
									'{$postInfo["subject"]}',
									'{$postInfo["topic"]}',
									'".me("id")."',
									'{$postInfo["user"]}',
									'".($i>0?$GLOBALS["OBJ"]["chunkHeader"]:NULL)."{$bodyChunk}".($i<count($body)-1?$GLOBALS["OBJ"]["chunkFooter"]:NULL)."',
									'".date("U")."'
								)
							");
							
							$i++;
						}
					} 
			
					else {
						myQ("
							INSERT INTO `[x]inkspot` 
							(`subject`,`topic`,`user`,`origin_user`,`body`,`date`)
							VALUES
							(
								'{$postInfo["subject"]}',
								'{$postInfo["topic"]}',
								'".me("id")."',
								'{$postInfo["user"]}',
								'{$_POST["body"]}',
								'".date("U")."'
							)
						");
					}
									
					myQ("
						UPDATE `[x]inkspot`
						SET `read_array`='".pk(array(me("id")))."'
						WHERE `subject`='{$postInfo["subject"]}'
						AND `topic`='{$postInfo["topic"]}'
					");
		
					if (isset($spotKey)) {
						$inkSpotSubjects[$spotKey]["POST_COUNT"] ++;
						
						if ($handle = fopen("system/cache/inkspot.dat", "w")) {
							fwrite($handle, pk($inkSpotSubjects));
							fclose($handle);
						}
					}
				}
			}
		}
		
		// PAGINATION PREPARATION /////////////////////////////////////////////////////
		if (!isset($_GET["page"]) || !is_numeric($_GET["page"]) || $_GET["page"] == 0) $page = 1;
		else $page = $_GET["page"];
		
		$tpl -> AssignArray(array("this.page" => $page));
		
		// QUERY /////////////////////////////////////////////////////////////////////////
		/*
			We query the db for all the posts that are matching
			the same topic / subject
		*/
		$select = myQ("
			SELECT SQL_CALC_FOUND_ROWS * 
			FROM `[x]inkspot`
			WHERE `topic`='{$postInfo["topic"]}'
			AND `subject`='{$postInfo["subject"]}'
			AND `origin`!='1'
			ORDER BY `id` ASC
			LIMIT ".(($page * $CONF["INKSPOT_POSTS_PER_PAGE"]) - $CONF["INKSPOT_POSTS_PER_PAGE"]).",{$CONF["INKSPOT_POSTS_PER_PAGE"]}
		");

		/*
			Find out how many rows we would have got
			without the limit statement
		*/
		$countRowsSelect = myQ("SELECT FOUND_ROWS()");
		$countRowsResult = mysql_fetch_row($countRowsSelect);
		$totalRows = $countRowsResult[0];
		
		// PAGINATION ////////////////////////////////////////////////////////////////
		$totalPages = ceil($totalRows / $CONF["INKSPOT_POSTS_PER_PAGE"]);
		
		if ($totalPages > 1) {
			
			$tpl -> Zone("paginationBlock", "enabled");
			
			/*
				If the total number of pages to be shown exceed
				the total number of pages we are allowed to show,
				we will show the total allowed pages instead.
			*/
			$showPages = ($totalPages>$CONF["INKSPOT_PAGINATION_PADDING"]?$CONF["INKSPOT_PAGINATION_PADDING"]:$totalPages);
			
			/*
				Find out the first page to start up with; if
				the total number of pages to show divided by
				two (total middle) is greater than the actual 
				page number, we will start with the actual page
				minus the result of the total pages to show 
				divided by two; else, we start with page one.
			*/
			if ($totalPages > $showPages && $page > ceil($showPages/2)) {
				
				/*
					Set the first page
				*/
				$startUpPage = $page - floor($showPages/2);
	
				/*
					Make sure we show the maximum number of pages
					when we're at the end of the results. If 
					the value of startuppage (first page
					to be shown) minus the total number of
					shown pages is greater than the total number
					of pages to be displayed, it means the
					first page should be the result of the
					total pages minus the total of shown
					pages
				*/
				if (($startUpPage+$showPages) > $totalPages) $startUpPage = $totalPages - $showPages;
			}
			
			else $startUpPage = 1;
	
			/*
				Find out the last page number we will show
			*/		
			$lastPage = ($startUpPage+$showPages<$totalPages?$startUpPage+$showPages:$totalPages);
	
			/*
				Build up the actual page link, we will force the
				L value and remove the page value.
			*/
			$getDataString = "?L=".$_GET["L"];
	
			foreach ($_GET as $var => $val) {
				if (!is_array($val)) {
					if ($var != "page" && $var != "L") $getDataString .= "&{$var}={$val}";
				} else foreach ($val as $arVar => $arVal) {
					$getDataString .= "&{$var}[]={$arVal}";
				}
			}
	
			/*
				If the page is greater than page 2
				(not page one, not page two which are
				already linked if $page <= 2), we show
				a "back" link
			*/
			if ($page > 1) {
				$tpl -> Zone("pagination.back", "linked");
				$tpl -> AssignArray(array("pagination.back.link" => $getDataString."&page=".($page-1)));
			} else $tpl -> Zone("pagination.back", "disabled");
	
			/*
				If the first page isnt page number one, 
				we will show a link to it
			*/
			if ($startUpPage > 1) {
				$tpl -> Zone("pagination.first", "linked");
				$tpl -> AssignArray(array("pagination.first.link" => $getDataString."&page=1"));
			} else $tpl -> Zone("pagination.first", "disabled");
	
	
			/*
				Generate the pages
			*/
			$paginationMergeContent = NULL;
			for ($i=$startUpPage; $i<=$lastPage; $i++) {
				
				if ($i == $page) {
					$replaceArray = array(
						"{pagination.page.pageNumber}" => $i
					);
					
					$paginationMergeContent .= strtr($GLOBALS["OBJ"]["pagination.unlinked.page"], $replaceArray);
				} else {
					$replaceArray = array(
						"{pagination.page.pageNumber}" => $i,
						"{pagination.page.link}" => $getDataString."&page={$i}"
					);
					
					$paginationMergeContent .= strtr($GLOBALS["OBJ"]["pagination.linked.page"], $replaceArray);
				}
			}
			
			if (!is_null($paginationMergeContent)) $tpl -> AssignArray(array("pagination.pages" => $paginationMergeContent));
			
			
			/*
				If the last possible page isnt shown, we will
				show a link to it here
			*/
			if ($lastPage < $totalPages) {
				
				$tpl -> Zone("pagination.last", "linked");
				$tpl -> AssignArray(array(
					"pagination.last.link" => $getDataString."&page={$totalPages}",
					"pagination.last.pageNumber" => $totalPages
				));
			} else $tpl -> Zone("pagination.last", "disabled");
			
			/*
				
			*/
			if ($page < $totalPages) {
				$tpl -> Zone("pagination.next", "linked");
				$tpl -> AssignArray(array(
					"pagination.next.link" => $getDataString."&page=".($page+1),
				));
			} else $tpl -> Zone("pagination.next", "disabled");
	
		}
		
		else $tpl -> Zone("paginationBlock", "disabled");
		
		$tpl -> AssignArray(array(
			"page.thisPage" => $page,
			"page.total" => $totalPages,
		));

		// ASSIGN ORIGIN POST ////////////////////////////////////////////////////////
		/*
			The inkspot always keeps the origin post in the vewport, 
			is is queried separately.
		*/
		$row = myF(myQ("
			SELECT *
			FROM `[x]inkspot`
			WHERE `topic`='{$postInfo["topic"]}'
			AND `subject`='{$postInfo["subject"]}'
			AND `origin`='1'
			ORDER BY `id` ASC
			LIMIT 1
		"));

		$mainPostReplacementArray = array(
			"main.topic" => $row["topic"],
			"main.body" => _fnc("convertEmoticons", _fnc("convertBodyCodes", _fnc("convertImages", $row["body"]))),
			"main.date" => date($CONF["LOCALE_HEADER_DATE_TIME"], $row["date"]),
			"main.views" => $row["view_count"],
			"main.replies" => myNum($select),
			"main.userid" => $row["user"],
			"main.mainpicture" => _fnc("user", $row["user"], "mainpicture"),
			"main.username" => _fnc("user", $row["user"], "username")
		);
	
		/*
			Assign the main post replacement array
		*/
		if (isset($mainPostReplacementArray)) {
			$tpl -> AssignArray($mainPostReplacementArray);
		}
		
		// ASSIGN REPLIES /////////////////////////////////////////////////////////////
		/*
			We will get all the replies and assign them
			to the template
		*/
		$even = true;
		
		while ($row = myF($select)) {
			
			$even = ($even?false:true);
			
			if (me("is_administrator") or me("is_superadministrator")) {
				$deleteReplace = array(
					"{this.id}" => $row["id"],
					"{this.page}" => (isset($_GET["page"]) ? $_GET["page"] : 1),
					"{this.topic}" => $_GET["id"]
				);
				$deleteLink = strtr($GLOBALS["OBJ"]["deletereply"], $deleteReplace);
			} 
			else $deleteLink = NULL;
			
			$subPostsReplacementArray[] = array(
				"sub.topic" => $row["topic"],
				"sub.id" => $row["id"],
				"sub.body" => _fnc("convertEmoticons", _fnc("convertBodyCodes", convertImages($row["body"]))),
				"sub.date" => date($CONF["LOCALE_HEADER_DATE_TIME"], $row["date"]),
				"sub.views" => $row["view_count"],
				"sub.replies" => myNum($select) -1,
				"sub.userid" => $row["user"],
				"sub.mainpicture" => user($row["user"], "mainpicture"),
				"sub.username" => _fnc("user", $row["user"], "username"),
				"sub.bgObject" => ($even?$GLOBALS["OBJ"]["bgObjectEven"]:$GLOBALS["OBJ"]["bgObjectOdd"]),
				"sub.delete" => $deleteLink
			);
		}
		
		if (isset($subPostsReplacementArray)) {
			$tpl -> Zone("subPostBlock", "enabled");
			$tpl -> Loop("subPostsLoop", $subPostsReplacementArray);
		}
		
		else $tpl -> Zone("subPostBlock", "noReply");

	}

	
	$tpl -> Flush();
?>