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

	list($usec, $sec) = explode(" ", microtime());
	$chrono_dac_start = ((float)$usec + (float)$sec);

	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	session_start();

	class triton {
		var $nickname;								// Holds the user's nickname
		var $channel;								// Holds the channel name the user is in
		var $userStamp;								// Holds the last string datestamp sent to the user
		var $tokenIncrement = 0;					// This is a token incrementer, it prevents time tokens from being the same
		var $channelHandle;							// Holds the channel file handle once the file has been openned
		var $channelBuffer;							// Array that contains the channel buffer lines to be displayed
		var $channelBytes;							// Holds the channel data buffer as a string in an array
		
		var $channelBytesCords = array(				// The channelBytesCords holds the coordnits of the channel files (grp 4 bytes)
			"topic"=>"00000255","mode_a"=>"02550001","mode_A"=>"02560001","mode_c"=>"02570001","mode_G"=>"02580001",
			"mode_i"=>"02590001","mode_k"=>"03000016","mode_l"=>"03160008","mode_m"=>"03240001","mode_n"=>"03250001",
			"mode_N"=>"03260001","mode_O"=>"03270001","mode_P"=>"03280001","mode_q"=>"03290001","mode_Q"=>"03300001",
			"mode_r"=>"03310001","mode_s"=>"03320001","mode_t"=>"03330001","mode_T"=>"03340001","mode_g"=>"03350001",
			"spare"=> "03360254","users"=>"05904096"
		);
		
		/* Constructor */
		function triton() { 
			/* Prevent quit re-cycle */
			if (isset($_SESSION["triton"]["quit"]) and $_SESSION["triton"]["quit"] >= time() - 2) die();
			
			$this -> nickname = (isset($_SESSION["triton"]["nickname"])
				? $_SESSION["triton"]["nickname"] 
				: $_SESSION["triton"]["nickname"] = "Guest".rand(0,999)
			);
			
			$this -> channel = (isset($_SESSION["triton"]["channel"]) 
				? $_SESSION["triton"]["channel"] 
				: $_SESSION["triton"]["channel"] = "home"
			);
			
			$this -> userStamp = ((isset($_SESSION["triton"]["stamp"]) && $_SESSION["triton"]["stamp"] != 0)
				? $_SESSION["triton"]["stamp"] 
				: $_SESSION["triton"]["stamp"] = $this -> token()
			);
			
			@touch("../../system/cache/chat/u_".$this -> nickname.".txt");

			$userDataString = $_SERVER['REMOTE_ADDR']."|"
				.(isset($_SESSION["triton"]["age"]) ? $_SESSION["triton"]["age"] : NULL)."|"
				.(isset($_SESSION["triton"]["gender"]) ? $_SESSION["triton"]["gender"] : NULL)."|"
				.(isset($_SESSION["triton"]["mainpicture"]) ? $_SESSION["triton"]["mainpicture"] : NULL)."|"
				.(isset($_SESSION["triton"]["logintime"]) ? $_SESSION["triton"]["logintime"] : NULL)."|"
				.(isset($_SESSION["triton"]["id"]) ? $_SESSION["triton"]["id"] : NULL);
			
			if (md5($userDataString) != md5_file("../../system/cache/chat/u_".$this -> nickname.".txt")) {
				if ($userDataHandle = fopen("../../system/cache/chat/u_".$this -> nickname.".txt", "w")) {
					fwrite($userDataHandle, $userDataString);
					fclose($userDataHandle);
				}
			}
			
			@touch("../../system/cache/chat/buffer.txt");
			
			/*
				Channel buffer garbage collector ... we will periodically check the size of
				the channel buffer file; if it is over a critical size, we will drop the file
				and create a new one. 
			*/				
			if (rand(0,1000) == 1 and filesize("../../system/cache/chat/buffer.txt") > 5242880) 
				unlink("../../system/cache/chat/buffer.txt");
			
			/* 
				Prepare the channel handle, if something was set in sendChatData, we will need
				to open the channel handle in append/write mode. If we got no sendChatData signal, 
				there will be nothing to write there, thus we open the handle in read only mode.
			*/			
			$this -> channelHandle = fopen("../../system/cache/chat/buffer.txt", "a+");

			/*
				Kick restriction - if a user gets kicked, he will stay kicked for as long as
				his host is trying to cycle and for X seconds.
			*/
			$kickFile = "../../system/cache/chat/k_".ip2long($_SERVER['REMOTE_ADDR'])."_".$this->channel.".txt";
			if (is_file($kickFile) and !isset($_SESSION["triton"]["ircop"])) {
				if (time() - filemtime($kickFile) < 300) { 
					@touch($kickFile);
					$this -> localEcho('ERR_KICKED', array($this -> channel));
					$_SESSION["triton"]["stamp"] = $this -> token();
					die();
				}
				else unlink($kickFile);
			}

			/*
				Ghosts gc - this will kill all the users that are timed-out for that channel
			*/
			if (rand(0,100) == 1) {
				
				$usersList = $this -> getChannelData($this -> channel, "users");
				$users = explode(",", $usersList);
				$rewriteSwitch = false;
				
				foreach($users as $user) {
					if ($user != "") {
						if (is_file("../../system/cache/chat/u_".substr($user, 2).".txt")) {
							if (time() - filemtime("../../system/cache/chat/u_".substr($user, 2).".txt") > 30) {
							
								$nickPosition = strpos($usersList, ":".substr($user, 2).",");
								$usersList = substr_replace($usersList, '', $nickPosition - 1, strlen(substr($user, 2)) + 3);
								
								$this -> sysMsg('SYS_TIMEOUT', array(substr($user, 2)));
								unlink("../../system/cache/chat/".substr($user, 2).".txt");
								$rewriteSwitch = true;
							}
						} 
						else {
							$nickPosition = strpos($usersList, ":".substr($user, 2).",");
							$usersList = substr_replace($usersList, '', $nickPosition - 1, strlen(substr($user, 2)) + 3);

							$this -> sysMsg('SYS_GHOST', array(substr($user, 2)));
							$rewriteSwitch = true;
						}
					}
				}
				if ($rewriteSwitch) $this -> setChannelData($this -> channel, "users", $usersList);
			}

			/* Kick the handleSendChatData command */
			if (isset($_GET["sendChatData"])) $this -> handleSendChatData($_GET["sendChatData"]);
			
			/* Make sure we're in the channel! */
			if (!strstr($usersList = $this -> getChannelData($this -> channel, "users"), ":".$this -> nickname.",")) {
				if (!$this -> getChannelData($this -> channel, "mode_g") or isset($_SESSION["triton"]["id"])) {
					$this -> setChannelData($this -> channel, "users", $usersList."U:".$this -> nickname.",");
					$this -> sysMsg('SYS_JOIN', array($this -> nickname, $this -> channel));
				}
				else $this -> localEcho('ERR_GUEST', array($this -> channel));
			}
			
			/*
				Kick the readchannelstrings command
			*/
			$this -> readChannelStrings();
			
			/*
				If this is the first load, or that the channel file has been changed since the last time we
				sent the data to the user, of if the user has no channel stamp; populate the channel data
			*/
			if (
				!isset($_SESSION["triton"]["channelStamp_".$this->channel]) 
				or isset($_GET["firstload"])
				or filemtime("../../system/cache/chat/c_".$this -> channel.".txt") > $_SESSION["triton"]["channelStamp_".$this->channel]
			) $this -> populateChannelData();
		}
		
		function handleSendChatData($data) {
			if (substr($data, 0, 1) == "/") return $this -> handleChatCommand($data, $this -> channel);
			
			/* strip slashes */
			$data = stripslashes($data);
			
			/* cut messages after 800 characters */
			if (strlen($data) > 800) $data = substr($data, 0, 800); 

			/* Convert illegal character entities */
			$entities = array(";"=>"&#059;", "\""=>"&quot;", "'"=>"&#039;", "<"=>"&lt;", ">"=>"&gt;", "\\"=>"&#092;", "^"=>"&#094;");
			$data = strtr($data, $entities);
			
			/* Convert emoticons */
			$emoticons = array(
				"O:)" 	=> "angel",
				"O:-)" 	=> "angel",
				":@" 	=> "angry",
				":S"	=> "confused",
				":-S"	=> "confused",
				"o.O"	=> "confused",
				"8-]"	=> "cool",
				":&#039;(" 	=> "crying",
				":$" 	=> "embarrassed",
				"8-|" 	=> "glasses",
				"8-)" 	=> "glasses",
				":-]" 	=> "grin",
				":*"	=> "kiss",
				":-*" 	=> "kiss",
				":|" 	=> "plain",
				"8)" 	=> "rolling",
				"8-)" 	=> "rolling",
				":("	=> "sad",
				":-(" 	=> "sad",
				":#"	=> "sealed",
				":-#" 	=> "sealed",
				"+-(" 	=> "sick",
				":)" 	=> "smile",
				":DD" 	=> "smile-big2",
				":D" 	=> "smile-big",
				":-O" 	=> "surprise",
				":P"	=> "tongue",
				":-P" 	=> "tongue",
				":?" 	=> "uh",
				":-?"	=> "uh",
				":w" 	=> "vampire",
				"(V)"	=> "vampire",
				"&#059;)"	=> "wink",
				"&#059;-)" 	=> "wink"
			);
			
			$emoticonReplaceCount = 0;
			
			foreach ($emoticons as $asciiCode => $imageName) {
				while (strstr($data, $asciiCode) and $emoticonReplaceCount < 6) {
					$data = substr_replace(
						$data, 
						'<img 
							src="theme/default/images/icons/emoticons/'.$imageName.'.png" 
							align="absbottom" 
							width="16" 
							height="16"
							alt="'.$imageName.'"
							title="'.$imageName.'"
						>',
						strpos($data, $asciiCode, 0),
						strlen($asciiCode)
					);

					$emoticonReplaceCount ++;
				}
			}

			/* Convert URLs */
			if (strstr($data, "http") or strstr($data, "www")) $data = preg_replace(
				"`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", 
				"<a href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\" target=\"_blank\">\\5\\6</a>", 
				$data
			);

			/* Handle text colors */
			if (isset($_SESSION["triton"]["color"]) and !$this -> getChannelData($this -> channel, "mode_c"))
				$data = '<span style="color:'.$_SESSION['triton']['color'].'">'.$data.'</span>';

			/* Spacify long continuous phrases */
			foreach(explode(" ", $data) as $key => $line)
				if (strlen($line) > 56 and !strstr($line, "\"")) $data = str_replace($line, wordwrap($line, 56, " ", 1), $data);
			
			/* Strip bad words */
			if ($this -> getChannelData($this -> channel, "mode_G")) 
				$data = preg_replace('/\\b'.file_get_contents("badwords.txt").'\\b/i', '-beep-', $data);
				
			/* Moderated channel limitations */
			if ($this -> getChannelData($this -> channel, "mode_m")) {
				$usersList = $this -> getChannelData($this -> channel, "users");
				if (!strstr($usersList, "O:".$this -> nickname.",") and !strstr($usersList, "V:".$this -> nickname.",")) {
					$this -> localEcho('ERR_MODERATED', array($this -> channel));
					return false;
				}
				unset($usersList);
			}
			
			/* Muted or banned in channel */
			$channelUsers = $this -> getChannelData($this -> channel, "users");
			if (strstr($channelUsers, "M:".$this -> nickname.",") or strstr($channelUsers, "B:".$this -> nickname.",")) {
				$this -> localEcho('ERR_MUTED', array($this -> channel));
				return false;
			}

			/* Write data */
			$this -> writeChannelStrings("string", $this -> nickname, $data, $this -> channel);
		}
		
		function handleChatCommand($data, $channel) {
			/* /! is a call to the last called command ... handle it */
			if (substr($data, 1, 1) == "!" and isset($_SESSION["triton"]["lastcommand"]))
				$data = $_SESSION["triton"]["lastcommand"];

			/* Convert illegal character entities */
			$entities = array(";"=>"&#059;", "\""=>"&quot;", "'"=>"&#039;", "<"=>"&lt;", ">"=>"&gt;", "\\"=>"&#092;", "^"=>"&#094;");
			$data = strtr(stripslashes($data), $entities);

			$commandArgs = explode(" ", substr($data, 1));
			if (is_file("commands/".$commandArgs[0].".php") and @include("commands/".$commandArgs[0].".php")) {
				$_SESSION["triton"]["lastcommand"] = $data;
				t_command::runCommand($commandArgs, $channel);
			}
			else $this -> localEcho('ERR_NOCOMMAND', array($commandArgs[0]));
		}
		
		function writeChannelStrings($type, $nickname, $data, $channel, $destination=NULL) {
			if (is_resource($this -> channelHandle)) {
			
				fseek($this -> channelHandle, 0, SEEK_END);				
				$stripEntities = array("\r"=>'', "\n"=>'');
				$data = utf8_encode(strtr($data, $stripEntities));
				
				$writeLockTryCount = 0;
				while ($writeLockTryCount <= 10) {
					if (($writeLockTryCount < 10 and flock($this -> channelHandle, LOCK_EX)) or $writeLockTryCount == 10) {
						fwrite(
							$this -> channelHandle, 
								"\n"
								.$this -> token()
								.":".strtoupper($type)
								.":".(!is_null($destination) ? $destination : $channel)
								.":".$nickname
								.":".$data
						);
						flock($this -> channelHandle, LOCK_UN);
						return true;
					}
					sleep(.1);
					$writeLockTryCount ++;
				}
			}
			return false;
		}
		
		function sysMsg($messageid, $args, $nickname = NULL, $channel = NULL) {
			$this -> writeChannelStrings(
				"system", 
				(!is_null($nickname) ? $nickname : $this -> nickname), 
				vsprintf($this -> getMsg($messageid), $args),
				(!is_null($channel) ? $channel : $this -> channel)
			);
		}
		
		function actionMsg($messageid, $args) {
			$this -> writeChannelStrings(
				"action", 
				$this -> nickname, 
				vsprintf($this -> getMsg($messageid), $args),
				$this -> channel
			);
		}
		
		function localEcho($messageid, $args) {
			echo
				"CHANNELSTRING\t"
				.$this -> channel ."\t"
				."LOCALECHO\t"
				.vsprintf($this -> getMsg($messageid), $args)
				."\n";
		}
		
		function getMsg($message) {
			include_once("messages.php");
			return constant($message);
		}
		
		function readChannelStrings() {	
			if (is_resource($this -> channelHandle)) {
				fseek($this -> channelHandle, 0, SEEK_END);
				$pointerAtByte = ftell($this -> channelHandle);

				while ($pointerAtByte > 0) {
					if(fgetc($this -> channelHandle) == "\n") {
						if (substr($lineBuffer = fgets($this -> channelHandle), 0, strpos($lineBuffer, ":")) > $this -> userStamp) 
							$this -> channelBuffer[] = explode(":", $lineBuffer, 5);
						else break;
					}
					$pointerAtByte -- ;
					fseek($this -> channelHandle, $pointerAtByte);
				}
				$this -> parseChannelStrings();
			}
		}
		
		function parseChannelStrings() {
			if (is_array($this -> channelBuffer)) {
				
				for ($i = count($this -> channelBuffer)-1; $i >= 0; $i--) {

					switch($this -> channelBuffer[$i][1]) {
							
						case("STRING"):
								
							if ($this -> channelBuffer[$i][2] == $this -> channel) {
								
								if ($this->channelBuffer[$i][3] == $this->nickname) {
									$formatString = urlencode(
										'<span id="chat_self_nickname">'.$this -> channelBuffer[$i][3] ." said: </span>"
										.'<span id="chat_self_text">'.utf8_decode(stripslashes($this -> channelBuffer[$i][4])).'</span>'
									);
								}
								else {
									$formatString = urlencode(
										'<span id="chat_nickname">'.$this -> channelBuffer[$i][3] ." said: </span>"
										.'<span id="chat_text">'.utf8_decode(stripslashes($this -> channelBuffer[$i][4])).'</span>'
									);
								}
								
								echo
									"CHANNELSTRING\t"
									.$this -> channel ."\t"
									.$this -> channelBuffer[$i][3] ."\t"
									.$formatString
									."\n";
							}
							
						break;
							
						case("SYSTEM"): case("ACTION"): 
							
							if ($this -> channelBuffer[$i][2] == $this -> channel) {
								$formatString = urlencode(stripslashes(utf8_decode($this -> channelBuffer[$i][4])));
								
								echo
									"CHANNELSTRING\t"
									.$this -> channel ."\t"
									.$this -> channelBuffer[$i][3] ."\t"
									.$formatString
									."\n";
							}

						break;

						case("WALLOP"): 
							
							if (isset($_SESSION["triton"]["ircop"])) {
							
								$formatString = urlencode(stripslashes(utf8_decode($this -> channelBuffer[$i][4])));
								
								echo
									"CHANNELSTRING\t"
									.$this -> channel ."\t"
									.$this -> channelBuffer[$i][3] ."\t"
									.$formatString
									."\n";
							}

						break;
						
						case("PRIVMSG"): 
							
							if (strtolower($this -> channelBuffer[$i][2]) == strtolower($this -> nickname)) {
								$formatString = urlencode(
									'<span id="chat_nickname">'.$this -> channelBuffer[$i][3]." said: </span>"
									.'<span id="chat_text">'.utf8_decode(stripslashes($this -> channelBuffer[$i][4])).'</span>'
								);
								$destinationUserName = strtolower($this -> channelBuffer[$i][3]);
								echo "PRIVMSG\t".$destinationUserName."\t".$destinationUserName."\t".$formatString."\n";
							} 
							
							else if (strtolower($this -> channelBuffer[$i][3]) == strtolower($this -> nickname)) {
								$formatString = urlencode(
									'<span id="chat_self_nickname">'.$this -> channelBuffer[$i][3]." said: </span>"
									.'<span id="chat_self_text">'.utf8_decode(stripslashes($this -> channelBuffer[$i][4])).'</span>'
								);
								$destinationUserName = strtolower($this -> channelBuffer[$i][2]);
								echo "PRIVMSG\t".$destinationUserName."\t".$destinationUserName."\t".$formatString."\n";
							} 


						break;
					}

					if ($i == 0) $_SESSION["triton"]["stamp"] = $this -> channelBuffer[$i][0];
				}
			}
		}
		
		function token() {
			$timeValue = gettimeofday();
			return $timeValue["sec"].substr($timeValue["usec"]."00000000", 0, 8) + $this->tokenIncrement ++;
		}
		
		function readChannelData($channel) {
			if (!is_file("../../system/cache/chat/c_".$channel.".txt")) touch("../../system/cache/chat/c_".$channel.".txt", "rb");
			if ($handle = fopen("../../system/cache/chat/c_".$channel.".txt", "rb")) {
				$this -> channelBytes[$channel] = str_pad(fread($handle, 4686), 4686);
				fclose($handle);
				return true;
			}
			return false;
		}
		
		function setChannelData($channel, $entity, $value) {
			if (!isset($this -> channelBytes[$channel])) $this -> readChannelData($channel);

			list($firstByte, $dataLen) = array_slice(split("-l-", chunk_split($this -> channelBytesCords[$entity], 4, '-l-')), 0, -1);
			
			$this -> channelBytes[$channel] = substr_replace(
				$this -> channelBytes[$channel], 
				str_pad($value, $dataLen), 
				$firstByte, 
				$dataLen
			);

			if ($handle = fopen("../../system/cache/chat/c_".$channel.".txt", "wb")) {
				fwrite($handle, $this -> channelBytes[$channel]);
				fclose($handle);
			}
		}
		
		function getChannelData($channel, $entity) {
			if (!isset($this -> channelBytes[$channel])) $this -> readChannelData($channel);

			list($firstByte, $dataLen) = array_slice(split("-l-", chunk_split($this -> channelBytesCords[$entity], 4, '-l-')), 0, -1);
			return trim(substr($this -> channelBytes[$channel], $firstByte, $dataLen));
		}
		
		function populateChannelData() {
			/* Populate topic */
			$modesString = "aAcgGiklmnNOPqQrstT";
			$cData_modes = '';
			for($i=0; $i<strlen($modesString); $i++) {
				$modeCode = substr($modesString, $i, 1);
				$modeState = $this -> getChannelData($this -> channel, "mode_".$modeCode);
				if ($modeState != '' and $modeState != false and (int)$modeState != 0)
					$cData_modes .= $modeCode;
			}
			
			echo "TOPIC\t".urlencode(vsprintf($this -> getMsg('OBJ_TOPIC'), array(
				ucfirst($this -> channel),
				substr_count($this -> getChannelData($this -> channel, "users"), ","),
				$cData_modes, 
				stripslashes($this -> getChannelData($this -> channel, "topic"))
			)))."\n";

			echo "CHANNELNAME\t".urlencode("#".ucfirst($this -> channel))."\n";
			
			
			/* Populate channel list */
			preg_match_all(
				'/([A-Z]):([A-Z0-9_\\-@]*+),?/i',
				$this -> getChannelData($this -> channel, "users"), 
				$nickListMatches, 
				PREG_SET_ORDER
			);
			
			$nickListRender = NULL;

			foreach ($nickListMatches as $userEntity) {
				
				@list(
					$ue_ip, 
					$ue_age, 
					$ue_gender, 
					$ue_picture, 
					$ue_login
				) = explode("|", @file_get_contents("../../system/cache/chat/u_".$userEntity[2].".txt"));
				
				switch($userEntity[1]) {
					
					case("O"):
						$nickListRender .= sprintf(
							$this -> getMsg('OBJ_NICKLIST_OP'), 
							$userEntity[2], $ue_picture, $userEntity[2], $ue_age
						);
					break;

					case("V"):
						$nickListRender .= sprintf(
							$this -> getMsg('OBJ_NICKLIST_VOICE'), 
							$userEntity[2], $ue_picture, $userEntity[2], $ue_age
						);
					break;

					case("U"):
						$nickListRender .= sprintf(
							$this -> getMsg('OBJ_NICKLIST_USER'), 
							$userEntity[2], $ue_picture, $userEntity[2], $ue_gender, $ue_age
						);
					break;

					case("M"):
						$nickListRender .= sprintf(
							$this -> getMsg('OBJ_NICKLIST_MUTE'), 
							$userEntity[2], $ue_picture, $userEntity[2], $ue_age
						);
					break;
					
					case("W"): case("X"): case("Y"): case("Z"):
						$nickListRender .= sprintf(
							$this -> getMsg('OBJ_NICKLIST_AWAY'), 
							$userEntity[2], $ue_picture, $userEntity[2], $ue_age
						);
					break;
					
					case("G"):
						if (isset($_SESSION["triton"]["ircop"])) {
							$nickListRender .= sprintf(
								$this -> getMsg('OBJ_NICKLIST_GHOST'), 
								$userEntity[2], $ue_picture, $userEntity[2], $ue_age
							);
						}
					break;
				}
			}
			
			echo "NICKNAMES\t{$nickListRender}\n";		

			
			/* Update the user's channel data population stamp */
			$_SESSION["triton"]["channelStamp_".$this->channel] = time();
		}

	} // End of class

	$chat = new triton;
	
	list($usec, $sec) = explode(" ", microtime());
	echo "LATENCY\t".urlencode(
		"Connected to PHPizabi (hub) | "
		."Network has 1 Node | "
		."Server Latency: ".round((((float)$usec + (float)$sec) - $chrono_dac_start), 6)." sec."
		)."\n";

?>