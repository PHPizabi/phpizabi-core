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
	$tpl -> Load("register");

	if (me('id') != "") {
		$tpl -> Zone("regform", "notallowed");
		_fnc("reload", 3, "?L=users.desktop");
	}
	
	if (isset($_SESSION["REG_ID"])) {
		$tpl -> Zone("regform", "notallowed");
		_fnc("reload", 0, "?L=registration.questionaire");
	}

	/* Handle Submit */
	if (isset($_POST["Submit"]) || isset($_POST["Correct"])) {
		
		$errBreak = false;
		
		foreach ($_POST as $var => $val) {
			$_SESSION["REGISTER"][$var] = $val;
		}
		
		/* Check email address */
		if (
			!isset($_SESSION["REGISTER"]["email"]) 
			|| $_SESSION["REGISTER"]["email"] == "" 
			|| !preg_match($CONF["REGEXP_EMAIL"], $_SESSION["REGISTER"]["email"])) {
			$tpl -> Zone("error", "email");
		} else {
			/* Check Cloned email addresses */
			if (!$CONF["REGISTRATION_ALLOW_DUPLICATE_EMAIL"] && myNum(myQ("
				SELECT `email` 
				FROM `[x]users` 
				WHERE `email`='{$_SESSION["REGISTER"]["email"]}'
			")) > 0) {
				$tpl -> Zone("error", "emailClone");
				session_unregister("REGISTER");
			} 
			
			else {
				/* Check username */
				if (
					!isset($_SESSION["REGISTER"]["username"]) 
					|| $_SESSION["REGISTER"]["username"] == "" || 
					!preg_match($CONF["REGEXP_USERNAME"], $_SESSION["REGISTER"]["username"])
					|| strlen($_SESSION["REGISTER"]["username"]) < $CONF["USERS_USERNAME_MIN_LEN"]
					|| strlen($_SESSION["REGISTER"]["username"]) > $CONF["USERS_USERNAME_MAX_LEN"]) {
					$tpl -> Zone("error", "username");
					$tpl -> Zone("usernameerror", "lenerror");
				}
				
				else {
					/* Check username being in use */
					if (myNum(myQ("
						SELECT `username` 
						FROM `[x]users` 
						WHERE LCASE(`username`)='".strtolower($_SESSION["REGISTER"]["username"])."'")) > 0) {
						$tpl -> Zone("error", "username");
						$tpl -> Zone("usernameerror", "inuse");
					} else {
						/* Check Password form */
						if (
							!isset($_SESSION["REGISTER"]["password"]) 
							|| $_SESSION["REGISTER"]["password"] == "" 
							|| strlen($_SESSION["REGISTER"]["password"]) < $CONF["USERS_PASSWORD_MIN_LEN"] 
							|| strstr($_SESSION["REGISTER"]["password"], " ")) {
							$tpl -> Zone("error", "password");
							$tpl -> Zone("passworderror", "lenghterr");
						} else {
							/* Check password against passcheck */
							if (
								!isset($_SESSION["REGISTER"]["passcheck"]) 
								|| $_SESSION["REGISTER"]["passcheck"] != $_SESSION["REGISTER"]["password"]) {
								$tpl -> Zone("error", "password");
								$tpl -> Zone("passworderror", "nomatch");
							} else {
								/* Check verification code */
								if (
									!isset($_SESSION["REGISTER"]["code"]) || 
									!isset($_SESSION["REGISTER"]["syscode"]) || 
									$_SESSION["REGISTER"]["code"] != $_SESSION["REGISTER"]["syscode"]) {
									$tpl -> Zone("error", "code");
								} else {
									/* Check age */
									if (
										!isset($_SESSION["REGISTER"]["bday"]) or
										!isset($_SESSION["REGISTER"]["bmonth"]) or
										!isset($_SESSION["REGISTER"]["byear"]) or
										_fnc("age", $_SESSION["REGISTER"]["bmonth"]."/".$_SESSION["REGISTER"]["bday"]."/".$_SESSION["REGISTER"]["byear"]) < $CONF["USERS_MIN_AGE"]
									) {
										$tpl -> Zone("error", "age");
									} else {
										/* Form was correctly filled */
										
										if (!isset($_SESSION["REG_ID"])) {
											
											/* Set reference data */
											if ($CONF["REGISTRATION_SAVE_REFERENCE"]) {
												if ($CONF["REGISTRATION_REFERENCE:HTTP_REFERER"]) $refData = $_SERVER['HTTP_REFERER'];
												else $refData = (isset($_GET["ref"])?$_GET["ref"]:NULL);
											} else $refData = NULL;
											
											$user_settings["MAIL"]["NOTIFICATION"] = array(
												"MESSAGES" => 1,
												"EVENTS" => 1,
												"BIRTHDAY" => 1,
												"PROFILECOMMENT" => 1,
												"CONTACTREQUEST" => 1,
												"NUDGE" => 1
											);
											
											/* Save to database */
											myQ("
												INSERT INTO `[x]users` 
												(
													`email`,
													`birthdate`,
													`gender`,
													`username`,
													`password`,
													`country`,
													`state`,
													`city`,
													`zipcode`,
													`active`,
													`registration_date`,
													`registration_reference`,
													`age`,
													`settings`
												)
												VALUES
												(
													'{$_SESSION["REGISTER"]["email"]}',
													'{$_SESSION["REGISTER"]["bmonth"]}/{$_SESSION["REGISTER"]["bday"]}/{$_SESSION["REGISTER"]["byear"]}',
													'{$_SESSION["REGISTER"]["gender"]}',
													'{$_SESSION["REGISTER"]["username"]}',
													'".md5($_SESSION["REGISTER"]["password"])."',
													'{$_SESSION["REGISTER"]["country"]}',
													'{$_SESSION["REGISTER"]["state"]}',
													'{$_SESSION["REGISTER"]["city"]}',
													'{$_SESSION["REGISTER"]["zipcode"]}',
													'".($CONF["REGISTRATION_AUTO_APPROVE"] && !$CONF["REGISTRATION_APPROVE_UPON_EMAIL_CHECK"]?"1":"0")."',
													'".date("U")."',
													'{$refData}',
													'"._fnc("age", "{$_SESSION["REGISTER"]["bmonth"]}/{$_SESSION["REGISTER"]["bday"]}/{$_SESSION["REGISTER"]["byear"]}")."',
													'".pk($user_settings)."'
												)
											");
											$id = mysql_insert_id();
											
											if ($CONF["GEOLOC_STRAPON_REGISTER"]) _fnc("geoLocalize", $id);
									
											/*
												Send the mail out!
											*/
											$mail = new template;
											$mail -> LoadThis(file_get_contents("theme/templates/GLOBALS/mails/registration.tpl"));
											$mail -> AssignArray(array(
												"site.name" => $CONF["SITE_NAME"],
												"site.url" => "http://".$_SERVER['HTTP_HOST'].str_replace("/index.php", NULL, $_SERVER['PHP_SELF']),
												"reg.confirmURL" => "?L=registration.confirm&id={$id}&code=".md5($_SESSION["REGISTER"]["email"].$_SESSION["REGISTER"]["username"].md5($_SESSION["REGISTER"]["password"]))
											));
											$mail -> AssignArray($_SESSION["REGISTER"]);
			
											/*
												Split the body and the subject, then
												send the mail
											*/
											$mailContent = explode("\n", $mail->Flush(1), 2);
											
											/* Include the mail class and prepare it for the mailing */
											include_once("system/functions/classes/mail.class.php");
																		
											$mail = new SendMail;
											$mail -> From = 			"{$CONF["SITE_NAME"]} <{$CONF["SITE_SYSTEM_EMAIL"]}>";
											$mail -> To =				$_SESSION["REGISTER"]["email"];
											$mail -> Subject = 			$mailContent[0];
											$mail -> Body = 			$mailContent[1];
											$mail -> SMTPHost = 		$CONF["MAIL_SMTP_HOST"];
											$mail -> SMTPPort = 		$CONF["MAIL_SMTP_PORT"];
											$mail -> SMTPUser = 		$CONF["MAIL_SMTP_USER"];
											$mail -> SMTPPassword = 	$CONF["MAIL_SMTP_PASSWORD"];
											$mail -> SMTPTimeout = 		$CONF["MAIL_SMTP_TIMEOUT"];
											$mail -> MailMethod = 		$CONF["MAIL_METHOD"];
											$mail -> Charset = 			$CONF["MAIL_CHARSET"];
											$mail -> Encoding = 		$CONF["MAIL_ENCODING"];
											$mail -> SendmailPath = 	$CONF["MAIL_SENDMAIL_PATH"];
											$mail -> Send();
	
											$_SESSION["REG_ID"] = $id;
											session_unregister("REGISTER");
											
											$tpl -> Zone("regform", "success");
											_fnc("reload", 2, "?L=registration.questionaire");
	
										}
									}
								}
							}
						}
					}
				}
			}
		}
	} else {
		$tpl -> Zone("regform", "regform");					
	}

	/* Generate the years array */
	$i=0;
	for ($n = date("Y")-($CONF["USERS_MIN_AGE"]-1); $n > $CONF["REGISTER_YEAR_STARTAT"]; $n--) {
		$yearOptions[$i]["year"] = $n;
		$i++;
	}
	$tpl -> Loop("years", $yearOptions);
	$replace["age"] = $CONF["USERS_MIN_AGE"];

	/* Username min/max len values */
	$replace["username_minlen"] = $CONF["USERS_USERNAME_MIN_LEN"];
	$replace["username_maxlen"] = $CONF["USERS_USERNAME_MAX_LEN"];
	$replace["password_minlen"] = $CONF["USERS_PASSWORD_MIN_LEN"];

	/* Generate the genders array */
	$genders = explode(",", $CONF["USERS_GENDERS"]);
	$i=0;
	foreach ($genders as $g) {
		$genderArray[$i]["gender"] = $g;
		$i++;
	}
	$tpl -> Loop("genderoption", $genderArray);
	
	/* Generate the random verification code */
	$replace["vcode"] = rand(1000,9999);
	
	$tpl -> AssignArray($replace);
	
	$tpl -> CleanZones();
	$tpl -> Flush();
	
?>