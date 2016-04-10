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
	$tpl -> Load("index");
	$tpl -> GetObjects();


	// TEMP //
	$s[0]["TITLE"] = "This is a subject";
	$s[0]["ID"] = "2147483647";
	$s[0]["LOCKED"] = false;
	$s[0]["TOPIC_COUNT"] = 1;
	$s[0]["POST_COUNT"] = 5;
	$s[0]["TYPES"] = "g,u";

	$s[1]["TITLE"] = "Yozemite ...";
	$s[1]["ID"] = "2147483646";
	$s[1]["LOCKED"] = false;
	$s[1]["TOPIC_COUNT"] = 10;
	$s[1]["POST_COUNT"] = 41;
	$s[1]["TYPES"] = "g,u";

	$s[2]["TITLE"] = "shouldnt allow guests";
	$s[2]["ID"] = "2147483611";
	$s[2]["LOCKED"] = false;
	$s[2]["TOPIC_COUNT"] = 0;
	$s[2]["POST_COUNT"] = 0;
	$s[2]["TYPES"] = "u";

	$s[3]["TITLE"] = "a locked topic";
	$s[3]["ID"] = "2147483610";
	$s[3]["LOCKED"] = true;
	$s[3]["TOPIC_COUNT"] = 0;
	$s[3]["POST_COUNT"] = 0;
	$s[3]["TYPES"] = "g,u";


//	$handle = fopen("system/cache/inkspot.dat", "w");
//	fwrite($handle, pk($s));
//	fclose($handle);

	// End

	// LOAD SUBJECTS /////////////////////////////////////////////////////////////////////
	/*
		Load the inkspot subjects array
	*/
	$inkSpotSubjects = unpk(file_get_contents("system/cache/inkspot.dat"));
	if (!is_array($inkSpotSubjects)) $inkSpotSubjects = array();

	/*
		Set a couple cyclic counter variables
	*/
	$totalSubjects = 0;
	$totalTopics = 0;
	$totalPosts = 0;

	/*
		Generate the inkspot subjects list
		array to be injected into the spot subjects
		block
	*/
	$i=0;
	foreach ($inkSpotSubjects as $key => $spotArray) {

		$subjectsReplacementArray[] = array(
			"subject.title" => $spotArray["TITLE"],
			"subject.topicCount" => $spotArray["TOPIC_COUNT"],
			"subject.postCount" => $spotArray["POST_COUNT"],
			"subject.id" => $spotArray["ID"]
		);

		$totalSubjects++;
		$totalTopics += $spotArray["TOPIC_COUNT"];
		$totalPosts += $spotArray["POST_COUNT"];

		$i ++;
	}

	if (isset($subjectsReplacementArray)) $tpl -> Loop("inkSpotSubjects", $subjectsReplacementArray);


	$tpl -> AssignArray(array(
		"total.subjects" => $totalSubjects,
		"total.topics" => $totalTopics,
		"total.posts" => $totalPosts
	));

	// LOAD POPULAR TOPICS ///////////////////////////////////////////////////////////////
	$query = "
		SELECT *, COUNT(topic) AS count FROM `[x]inkspot`
		GROUP BY `topic`
		ORDER BY `count` DESC
		LIMIT 10
	";

	while ($row = myF($query)) {

		$popularReplacementArray[] = array(
			"pop.date" => date($CONF["LOCALE_HEADER_DATE"], $row["date"]),
			"pop.username" => _fnc("user", $row["user"], "username"),
			"pop.topic" => $row["topic"],
			"pop.count" => $row["count"]-1,
			"pop.id" => $row["id"],
			"pop.userid" => $row["user"],
			"pop.mainpicture" => _fnc("user", $row["user"], "mainpicture")
		);
	}

	if (isset($popularReplacementArray)) {
		$tpl -> Loop("popularTopicsList", $popularReplacementArray);
	}

	// LOAD LAST TOPICS /////////////////////////////////////////////////////////////////
	$query = "
		SELECT *, COUNT(topic) AS count FROM `[x]inkspot`
		GROUP BY `topic`
		ORDER BY `date` DESC
		LIMIT 10
	";

	while ($row = myF($query)) {

		$lastReplacementArray[] = array(
			"last.date" => date($CONF["LOCALE_HEADER_DATE"], $row["date"]),
			"last.username" => _fnc("user", $row["user"], "username"),
			"last.topic" => $row["topic"],
			"last.count" => $row["count"]-1,
			"last.id" => $row["id"],
			"last.userid" => $row["user"],
			"last.mainpicture" => _fnc("user", $row["user"], "mainpicture")
		);
	}

	if (isset($lastReplacementArray)) {
		$tpl -> Loop("lastTopicsList", $lastReplacementArray);
	}

	// LOAD LAST TOPICS /////////////////////////////////////////////////////////////////
	$query = "
		SELECT *, COUNT(topic) AS count FROM `[x]inkspot`
		WHERE `user`='".me("id")."'
		GROUP BY `topic`
		ORDER BY `date` DESC
		LIMIT 10
	";

	while ($row = myF($query)) {

		$participateReplacementArray[] = array(
			"par.date" => date($CONF["LOCALE_HEADER_DATE"], $row["date"]),
			"par.username" => _fnc("user", $row["user"], "username"),
			"par.topic" => $row["topic"],
			"par.count" => $row["count"]-1,
			"par.id" => $row["id"],
			"par.userid" => $row["user"],
			"par.mainpicture" => _fnc("user", $row["user"], "mainpicture")
		);
	}

	if (isset($participateReplacementArray)) {
		$tpl -> Loop("participateTopicsList", $participateReplacementArray);
	}


	$tpl -> Flush();

?>
