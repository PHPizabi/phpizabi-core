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
		load the template file. 
	*/
	$tpl = new template;
	$tpl -> Load("daily");
	$tpl -> GetObjects();
	
	/*
		Get the timestamp for the called day
	*/
	$timeStamp = date("U", mktime(0, 0, 0, date("m", $_GET["ut"]), date("d", $_GET["ut"]), date("Y", $_GET["ut"])));
	$tomorrowStamp = date("U", mktime(23, 59, 59, date("m", $_GET["ut"]), date("d", $_GET["ut"]), date("Y", $_GET["ut"])));
	
	/*
		Make and assign the topic
	*/
	$tpl -> AssignArray(array(
		"day.month" => $GLOBALS["OBJ"]["month_".date("n", $timeStamp)],
		"day.date.jS" => date("jS", $timeStamp),
		"day.ut" => date("U")
	));
	
	// NEXT EVENTS /////////////////////////////////////////////////////////////////
	$nextEventsSelect = myQ("
		SELECT `id`,`title`,`date`
		FROM `[x]events`
		WHERE (
			(`display`='private' AND `user`='".me("id")."')
			OR
			(`display`='shared' AND (`user`='myFriendID' OR `user`='myFriendID2'))
			OR
			(`display`='public')
			OR
			(`display`='system')
		)
		ORDER BY `date` ASC
		LIMIT 20
	");
	
	$i=0;
	while ($nextEventsRow = myF($nextEventsSelect)) {
		$nextEventsReplacementArray[$i]["nextEvent.date"] = date($CONF["LOCALE_SHORT_DATE"], $nextEventsRow["date"]);
		$nextEventsReplacementArray[$i]["nextEvent.title"] = _fnc("strtrim", $nextEventsRow["title"], 20);
		$nextEventsReplacementArray[$i]["nextEvent.id"] = $nextEventsRow["id"];
		$i++;
	}
	
	if (isset($nextEventsReplacementArray)) $tpl->Loop("nextEvents", $nextEventsReplacementArray);
		
	
	// GET EVENTS //////////////////////////////////////////////////////////////////
	/*
		Select all events for this day
	*/
	$eventsSelect = myQ("
		SELECT *
		FROM `[x]events` 
		WHERE (
			(`display`='private' AND `user`='".me("id")."')
			OR
			(`display`='shared' AND (`user`='myFriendID' OR `user`='myFriendID2'))
			OR
			(`display`='public')
			OR
			(`display`='system')
		)
		AND `date` >= '{$timeStamp}'
		AND `date` < '{$tomorrowStamp}' 
		ORDER BY `date` ASC
	");

		
	/*
		Loop in the results, create the looping array
	*/
	$i=0;
	while ($eventRow = myF($eventsSelect)) {

		$eventsReplacementArray[$i]["event.title"] = _fnc("strtrim", $eventRow["title"], 30);
		$eventsReplacementArray[$i]["event.date"] = date($CONF["LOCALE_LONG_DATE_TIME"], $eventRow["date"]);
		$eventsReplacementArray[$i]["event.id"] = $eventRow["id"];
		$eventsReplacementArray[$i]["event.body"] = _fnc("clearBodyCodes", _fnc("strtrim", $eventRow["body"], 250));
		$eventsReplacementArray[$i]["event.time"] = date($CONF["LOCALE_HEADER_TIME"], $eventRow["date"]);

		$i++;
	}

	/*
		Assign the array to the loop engine
	*/
	if (isset($eventsReplacementArray)) {
		$tpl->Loop("eventsList", $eventsReplacementArray);
		$tpl->Zone("eventsBlock", "enabled");
	}
	
	/*
		No event on that day
	*/
	else $tpl->Zone("eventsBlock", "noEvent");
	
	/* 
		Let's create a new instance of a calendar
	*/
	if (!function_exists("calendar")) include_once("system/functions/classes/calendar.class.php");

	$thisMonthCalendar = new calendar();
	$lastMonthCalendar = new calendar(date("n")+1);
	$thirdMonthCalendar = new calendar(date("n")+2);
		
	/*
		Select all the events for the actual month
	*/
	$calEventSelect = myQ("
		SELECT `id`,`date`
		FROM `[x]events` 
		WHERE (
			(`display`='private' AND `user`='".me("id")."')
			OR
			(`display`='shared' AND (`user`='myFriendID' OR `user`='myFriendID2'))
			OR
			(`display`='public')
			OR
			(`display`='system')
		)
		AND `date` >= '".date("U", mktime(0, 0, 0, date("m"), 1, date("Y")))."'
		AND `date` < '".date("U", mktime(0, 0, -1, date("m")+3, 1, date("Y")))."'
		ORDER BY `date` DESC
		LIMIT 500
	");

	/*
		Loop in the results, inject values into the calendar object
	*/
	while ($calEventRow = myF($calEventSelect)) {
		if ($calEventRow["date"] > date("U", mktime(0, 0, 0, date("m")+2, 1, date("Y")))) {
			$thirdMonthCalendar -> injectDate(date("j", $calEventRow["date"]), "?L=events.daily&ut={$calEventRow["date"]}");
		} elseif ($calEventRow["date"] > date("U", mktime(0, 0, 0, date("m")+1, 1, date("Y")))) {
			$lastMonthCalendar -> injectDate(date("j", $calEventRow["date"]), "?L=events.daily&ut={$calEventRow["date"]}");
		} else {
			$thisMonthCalendar -> injectDate(date("j", $calEventRow["date"]), "?L=events.daily&ut={$calEventRow["date"]}");
		}
	}

	/*
		flush the calendar result into the assignarray
		method for the template engine.
	*/
	$tpl->AssignArray(array(
		"thisMonthCalendar" => $thisMonthCalendar -> makeAndFlush(),
		"lastMonthCalendar" => $lastMonthCalendar -> makeAndFlush(),
		"thirdMonthCalendar" => $thirdMonthCalendar -> makeAndFlush(),
		
		"thisMonthCalendarTopic" => $GLOBALS["OBJ"]["month_".date("n")],
		"lastMonthCalendarTopic" => $GLOBALS["OBJ"]["month_".date("n", mktime(0,0,0,date("m")+1,1,date("Y")))],
		"thirdMonthCalendarTopic" => $GLOBALS["OBJ"]["month_".date("n", mktime(0,0,0,date("m")+2,1,date("Y")))]
	));
	

	$tpl->Flush();
?>