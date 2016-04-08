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
	$tpl -> Load("create");


	/*
		Generate the UT value
	*/
	$tpl -> AssignArray(array("today.ut"=>date("U")));

	// GENERATE THE YEARS DROPDOWN LIST CONTENT ///////////////////////////////////////////
	/*
		We will generate the "years" dropdown menu options
		list starting at now to +10 years.
	*/	
	$n=0;
	for ($i=date("Y"); $i<(date("Y")+10); $i++) {
		$yearsReplaceArray[$n]["year.value"] = $i;
		$n++;
	}
	$tpl->Loop("yearsOptions", $yearsReplaceArray);
	
	// HANDLE POSTED EVENT ////////////////////////////////////////////////////////////////
	/*
		Handle posted event, make sure we're logged in
	*/
	if (isset($_POST["Submit"]) && me("id") != "") {
		
		/*
			Make sure a title was posted
		*/
		if (isset($_POST["title"]) && $_POST["title"] != "" && isset($_POST["body"]) && $_POST["body"] != "") {
				
			/*
				Generate the UDATE value for the posted date and time
				and make sure the event is not set to be in the past
			*/
			$eventUDate = date("U", mktime($_POST["date_h"], $_POST["date_i"], 0, $_POST["date_m"], $_POST["date_d"], $_POST["date_y"]));
			if ($eventUDate > date("U")) {
				
				/*
					Find out the display type
				*/
				if (isset($_POST["display"])) {
					
					if ($_POST["display"] == "public") $displayType = "public";
					elseif ($_POST["display"] == "shared") $displayType = "shared";
					else $displayType = "private";
				} else $displayType = "private";
				
				/*
					Handle sent image
				*/
				if (
					is_uploaded_file($_FILES["file"]["tmp_name"]) 
					and preg_match('/\\.jpg$|\\.jpeg$|\\.gif$|\\.png$/i', basename($_FILES["file"]["name"]))
				) {
			
					$eventPicture = strtolower(rand(1,999)."_".basename($_FILES["file"]["name"]));
					move_uploaded_file($_FILES["file"]["tmp_name"], "system/cache/temp/{$eventPicture}");
					rename("system/cache/temp/{$eventPicture}", "system/cache/pictures/{$eventPicture}");
				} else $eventPicture = NULL;
				
				/*
					Ok that's ready to save... Let's go
				*/
				myQ("
					INSERT INTO `[x]events`
					(`user`,`active`,`title`,`location`,`body`,`date`,`set_date`,`display`,`mainpicture`)
					VALUES (
						'".me("id")."',
						'0',
						'{$_POST["title"]}',
						'{$_POST["location"]}',
						'{$_POST["body"]}',
						'{$eventUDate}',
						'".date("U")."',
						'{$displayType}',
						'{$eventPicture}'
					)
				");

				$tpl -> AssignArray(array("this.eventID" => mysql_insert_id()));
				
				/*
					tell the user about it!
				*/
				$tpl->Zone("createEventHeader", "success");
			}
				
			/*
				Event date was set to be in the past... uh?!
			*/
			else $tpl->Zone("createEventHeader", "retroDate");
			
		}
			
		/*
			Event had no body or no title
		*/
		else $tpl->Zone("createEventHeader", "emptyField");
		
	}
	else $tpl->Zone("createEventHeader", "enabled");
	
	
	
	// FILTER GUESTS ////////////////////////////////////////////////////////////
	if (me("id") != "") $tpl->Zone("createEventForm", "enabled");
	else $tpl->Zone("createEventForm", "guest");
	
			
			
	
	
	$tpl -> Flush();	
	
?>