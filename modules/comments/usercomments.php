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

	$tpl = new template;
	$tpl -> Load("usercomments");
	$tpl->GetObjects();
	$tpl->AssignUser($_GET["id"]);
	
	/* Handle removal */
	if (isset($_GET["rmcomment"]) and is_mop()) {
		myQ("DELETE FROM `[x]comments` WHERE `id`='{$_GET["rmcomment"]}'");
	}
	
		$userCommentsSelect = myQ("
			SELECT * FROM `[x]comments` 
			WHERE `relative`='{$_GET["id"]}' 
			AND `type`='user' 
			ORDER BY `date` DESC"
		);
		
		if (myNum($userCommentsSelect) > 0) {
			while ($userCommentsRow = myF($userCommentsSelect)) {
				
				$commentsArray[$i] = array(
				"comment.id" => 			$userCommentsRow["id"],
				"comment.title" => 			_fnc("strtrim", strip_tags($userCommentsRow["title"]), 40),
				"comment.body" => 			_fnc("clearBodyCodes", _fnc("strtrim", $userCommentsRow["body"], 500)),
				"comment.username" => 		_fnc("user", $userCommentsRow["user"], "username"),
				"comment.userid" => 		$userCommentsRow["user"],
				"comment.mainpicture" => 	_fnc("user", $userCommentsRow["user"], "mainpicture"),
				"comment.date" => 			date($CONF["LOCALE_SHORT_DATE_TIME"], $userCommentsRow["date"])
			);
				
				$i ++;
			}
			$tpl -> Zone("usercomments", "enabled");
			$tpl -> Loop("usercomments", $commentsArray);
		}			
		

		
		
		$user2CommentsSelect = myQ("
			SELECT * FROM `[x]comments` 
			WHERE `user`='{$_GET["id"]}' 
			AND `type`='user' 
			ORDER BY `date` DESC"
		);
		
		if (myNum($user2CommentsSelect) > 0) {
			while ($user2CommentsRow = myF($user2CommentsSelect)) {
				
				$comments2Array[$i] = array(
				"comment.id" => 			$user2CommentsRow["id"],
				"comment.title" => 			_fnc("strtrim", strip_tags($user2CommentsRow["title"]), 40),
				"comment.body" => 			_fnc("clearBodyCodes", _fnc("strtrim", $user2CommentsRow["body"], 500)),
				"comment.username" => 		_fnc("user", $user2CommentsRow["user"], "username"),
				"comment.userid" => 		$user2CommentsRow["user"],
				"comment.mainpicture" => 	_fnc("user", $user2CommentsRow["user"], "mainpicture"),
				"comment.date" => 			date($CONF["LOCALE_SHORT_DATE_TIME"], $user2CommentsRow["date"])
			);
				
				$i ++;
			}
			$tpl -> Zone("usercomments2", "enabled");
			$tpl -> Loop("usercomments2", $comments2Array);
		}			
	
	
	// PRINT MEMBER ////////////////////////////////////////////////////////////////////// 
    $member = myF(myQ("SELECT * FROM `[x]users` WHERE `id`='{$_GET["id"]}'")); 
     
    $tpl -> AssignArray(array( 
         
        "user.username" => ($member["username"]),
		 "user.mainpicture" => ($member["mainpicture"]),
  
    ));
	
	
	/* Total Received //////////////////////////////////////*/
		$Pending2Array = myQ("
			SELECT `id` FROM `[x]comments` WHERE `relative`='{$_GET["id"]}' 
			AND `type`='user'");
$Pending2=0;
			
		while ($Row = myF($Pending2Array)) {
			$Pending2++;
		}
		
		$tpl->AssignArray(array(
			"count.received"=>$Pending2,
		));	
		
		
	/* Total Received //////////////////////////////////////*/
		$PendingArray = myQ("
			SELECT `id` FROM `[x]comments` WHERE `user`='{$_GET["id"]}' 
			AND `type`='user'");
$Pending=0;
			
		while ($Row = myF($PendingArray)) {
			$Pending++;
		}
		
		$tpl->AssignArray(array(
			"count.sent"=>$Pending,
		));			


	$tpl -> CleanZones();
	$tpl -> Flush();
	
?>