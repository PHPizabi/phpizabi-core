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

	function geoLocalize($data) {
		global $CONF;
	
		if ($CONF["GEOLOC_PROVIDER_URL"] != "") {
			
			$postString = "client=".$GLOBALS["SYSTEM_VERSION"];
			$postString .= "&user=".$CONF["GEOLOC_USERNAME"];
			$postString .= "&password=".md5($CONF["GEOLOC_PASSWORD"]);
			$postString .= "&origin=".$_SERVER["HTTP_HOST"];

			if (!is_array($data)) {
				$user = myF(myQ("SELECT `city`,`state`,`country`,`zipcode` FROM `[x]users` WHERE `id`='{$data}'"));
				
				/* Generate compiled post string */
				$postString .= "&type=single";
				$postString .= "&dat_city=".($CONF["GEOLOC_POST:CITY"]?$user["city"]:NULL);
				$postString .= "&dat_state=".($CONF["GEOLOC_POST:STATE"]?$user["state"]:NULL);
				$postString .= "&dat_country=".($CONF["GEOLOC_POST:COUNTRY"]?$user["country"]:NULL);
				$postString .= "&dat_zipcode=".($CONF["GEOLOC_POST:ZIPCODE"]?$user["zipcode"]:NULL);
				
			} else {

				$postString .= "&type=multi";
				
				foreach ($data as $userID) {
				
					$user = myF(myQ("SELECT `city`,`state`,`country`,`zipcode` FROM `[x]users` WHERE `id`='{$userID}'"));
				
					/* Generate compiled post string */
					$ps[] = array(
						"dat_id" => $userID,
						"dat_city" => ($CONF["GEOLOC_POST:CITY"]?$user["city"]:NULL),
						"dat_state" => ($CONF["GEOLOC_POST:STATE"]?$user["state"]:NULL),
						"dat_country" => ($CONF["GEOLOC_POST:COUNTRY"]?$user["country"]:NULL),
						"dat_zipcode" => ($CONF["GEOLOC_POST:ZIPCODE"]?$user["zipcode"]:NULL)
					);
				}

				$postString .= "&dat_array=".base64_encode(serialize($ps));
			}
			
			/* Split url into chunks */
			$urlParts = explode("/", $CONF["GEOLOC_PROVIDER_URL"]);
			$qualifiedDomain = $urlParts[0];
			
			if (isset($urlParts[1])) {
				unset($urlParts[0]);
				$qualifiedLocation = implode("/", $urlParts);
			} else $qualifiedLocation = "index.php";
									
			/* Generate the post call */
			$post = "POST /{$qualifiedLocation} "
			."HTTP/1.1\r\n"
			."Host: {$qualifiedDomain}\r\n"
			."Content-type: application/x-www-form-urlencoded\r\n"
			."User-Agent: Mozilla 4.0\r\n"
			."Content-length: ".strlen($postString)."\r\n"
			."Connection: close\r\n"
			."\r\n"
			.$postString;

			if ($handle = fsockopen($qualifiedDomain, $CONF["GEOLOC_PROVIDER_PORT"])) {
				fwrite($handle, $post);
				
				while (!feof($handle)) (isset($buffer)?$buffer.=fread($handle,8192):$buffer=fread($handle,8192));
				fclose($handle);
				
				if ($key = array_search($CONF["GEOLOC_STREAM_MARKER"], ($geo = explode("\n", $buffer)))) {
					if (is_array ($resultArray = unserialize(base64_decode($geo[$key+1])))) {
						
						/* Single mode */
						if ($resultArray["type"] == "single") {
							
							$user = myF(myQ("SELECT `city`,`state`,`country`,`zipcode`,`id` FROM `[x]users` WHERE `id`='{$data}'"));
							
							myQ("
								UPDATE `[x]users`
								SET 
									`city`='".($CONF["GEOLOC_ALLOW_UPDATE:CITY"]?$resultArray["city"]:$user["city"])."',
									`state`='".($CONF["GEOLOC_ALLOW_UPDATE:STATE"]?$resultArray["state"]:$user["state"])."',
									`country`='".($CONF["GEOLOC_ALLOW_UPDATE:COUNTRY"]?$resultArray["country"]:$user["country"])."',
									`zipcode`='".($CONF["GEOLOC_ALLOW_UPDATE:ZIPCODE"]?$resultArray["zipcode"]:$user["zipcode"])."',
									`latitude`='{$resultArray["latitude"]}',
									`longitude`='{$resultArray["longitude"]}'
								WHERE `id`='{$user["id"]}'
							");
						} 
						
						elseif ($resultArray["type"] == "multi") foreach($resultArray["data"] as $dat) {
								
							$user = myF(myQ("SELECT `city`,`state`,`country`,`zipcode`,`id` FROM `[x]users` WHERE `id`='{$dat["id"]}'"));
							
							myQ("
								UPDATE `[x]users`
								SET 
									`city`='".($CONF["GEOLOC_ALLOW_UPDATE:CITY"]?$dat["city"]:$user["city"])."',
									`state`='".($CONF["GEOLOC_ALLOW_UPDATE:STATE"]?$dat["state"]:$user["state"])."',
									`country`='".($CONF["GEOLOC_ALLOW_UPDATE:COUNTRY"]?$dat["country"]:$user["country"])."',
									`zipcode`='".($CONF["GEOLOC_ALLOW_UPDATE:ZIPCODE"]?$dat["zipcode"]:$user["zipcode"])."',
									`latitude`='{$dat["latitude"]}',
									`longitude`='{$dat["longitude"]}'
								WHERE `id`='{$user["id"]}'
							");
						}
					}
				}
			}
		}
	}
	
?>