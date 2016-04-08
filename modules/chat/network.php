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

	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

	class tritonNetwork {
	
		var $netHubAut = array("tizzy" => "12345");
		var $netLeaves = array("demo.phpizabi.net/gremlins/" => "12345");
		var $localNodeName = "tizzy";
		var $tokenIncrement = 0;
		
		function tritonNetwork() {
			if (isset($_POST["network"])) $this -> hub();
			else $this -> leaf();
		}
		
		function hub() {
			/* Launched as hub (a client is sending something) */
			if ($this->netHubAut[$_POST["node"]] == $_POST["key"]) {
				/* Parse the received buffer */
				$buffer = base64_decode($_POST["buffer"]);
				$buffer = explode("\n", $buffer);
				$rewriteBuffer = NULL;
				foreach ($buffer as $bufferLine) {
					$rewriteBuffer .= "\n" . preg_replace('/([^:]+):(.*)/', $this -> token().':\\2', $bufferLine);
				}
				$this -> writeBufferStrings($rewriteBuffer);
			}
			echo "<strings>".base64_encode($this -> readBufferStrings($localNodeName))."</strings>";
			
		}
		
		function leaf() {
			/* Launched as leaf (we will send to hubs) */
			foreach($this -> netLeaves as $leaf => $key) {
				
				if (preg_match('%([A-Z0-9_\\-\\.]+)/(.*)%i', $leaf, $address)) {

					// We will open a connection to each leaf one by one //
					if ($handle = fsockopen($address[1], "80", $errno, $errstr, 5)) {
						
						$query = "network=1&node=".$this->localNodeName."&key=".$key;
						
						$query .= "&buffer=". base64_encode($this -> readBufferStrings($address[1]));
						
						fwrite($handle,
							"POST /".(isset($address[2])?$address[2]:NULL)."/network.php HTTP/1.0\r\n"
							."Host: {$address[1]}\r\n"
							."Content-type: application/x-www-form-urlencoded\r\n"
							."Content-length: ".strlen($query)."\r\n"
							."Connection: close\r\n\r\n"
							.$query
						);
				
						$returnBuffer = NULL;
						while (!feof($handle)) {
							$returnBuffer .= fgets($handle, 1024);
						}
						
						preg_match('%<strings>(.*)</strings>%si', $returnBuffer, $buffer);
												
						$buffer = base64_decode($buffer[1]);
						$buffer = explode("\n", $buffer);
						$rewriteBuffer = NULL;
						foreach ($buffer as $bufferLine) {
							$rewriteBuffer .= "\n" . preg_replace('/([^:]+):(.*)/', $this -> token().':\\2', $bufferLine);
						}
						$this -> writeBufferStrings($rewriteBuffer);
						
						fclose($handle);
					}
				}
			}
		}
		
		function readBufferStrings($node) {	
			
			$pid = $this -> getNodePid($node);
			if ($handle = fopen("cache/buffer.txt", "r")) {
				fseek($handle, 0, SEEK_END);
				$pointerAtByte = ftell($handle);
				
				$buffer = NULL;
				while ($pointerAtByte > 0) {
					if(fgetc($handle) == "\n") {
						if (substr($lineBuffer = fgets($handle), 0, strpos($lineBuffer, ":")) > $pid) 
							$buffer .= "\n".preg_replace(
								'/([^:]+:[^:]+:[^:]+:)([^:]+)(:.*)/i', 
								'\\1\\2_at_'.$this->localNodeName.'\\3', 
								$lineBuffer
							);
						else break;
					}
					$pointerAtByte -- ;
					fseek($handle, $pointerAtByte);
				}
				$this -> setNodePid($node, $this -> token());
				return $buffer;
			}
		}
		
		function writeBufferStrings($buffer) {
			if ($handle = fopen("cache/buffer.txt", "a+")) {
				fwrite($handle, $buffer);
				fclose($handle);
			}
		}
		
		function getNodePid($node) {
			return file_get_contents("cache/{$node}.pid");
		}
		
		function setNodePid($node, $value) {
			if ($handle = fopen("cache/{$node}.pid", "w")) {
				fwrite($handle, $value);
				fclose($handle);
			}
		}
		
		function token() {
			$timeValue = gettimeofday();
			return $timeValue["sec"].substr($timeValue["usec"]."00000000", 0, 8) + $this->tokenIncrement ++;
		}

	} // End of class


	$net = new tritonNetwork;	


	
?>