<?php
///////////////////////////////////////////////////////////////////////////////////////
// PHPizabi 2.01 Alpha [Madison]                             http://www.phpizabi.org //
///////////////////////////////////////////////////////////////////////////////////////
//                                                                                   //
// Please read the LICENSE.md & README.md file before using/modifying this software  //
//                                                                                   //
// Developing Author:       Andy James, AndyWTBlueHair - andy@andy.blue              //
// Last modification date:  April 8th, 2016                                          //
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

	class template {
		var $File; var $Buffer;

		// LOAD ////////////////////////////////////////////////////////////////////
		function Load($file) {
			global $CONF;

			/* Find out if we're using the strict mode or not */
			if (substr($file,0,1) == "!") { /* Strict Mode (Prefixed by "!") */
				$loadFile = substr($file,1);
				$strict = true;
			}

			else { /* Not strict, use the ?L= get value to get the directory name */
				if (isset($_GET["L"])) {
					$loadFile = NULL;
					for ($i=0; $i<count($dir=explode(".", $_GET["L"], 100))-1; $i++) {
						$loadFile .= $dir[$i] . "/";
					}
					$loadFile .= $file;
					$strict = false;
				}
				else die("Not strict template call outside routing");
			}

			if (substr($loadFile, strlen($loadFile)-4) != ".tpl") $loadFile .= ".tpl";

			/* Read the file */
			if ($strict) {
				if (is_file($loadFile)) $this->Buffer = file_get_contents($loadFile);
				else {
					die("Unable to load {$loadFile}");
					return false;
				}
			} else {
				if (is_file("theme/{$GLOBALS["THEME"]}/templates/{$loadFile}")) {
					$this->Buffer = file_get_contents("theme/{$GLOBALS["THEME"]}/templates/{$loadFile}");
					if ($CONF["TRANSLATOR_ENABLED"]) $this->Translate();
				} elseif (is_file("theme/templates/{$loadFile}")) {
					$this->Buffer = file_get_contents("theme/templates/{$loadFile}");
					if ($CONF["TRANSLATOR_ENABLED"]) $this->Translate();
				} else {
					die("Unable to load {$loadFile}");
					return false;
				}
			}
			return true;
		}

		// LOAD SPECIFIC BUFFER CONTENT ///////////////////////////////////////////////
		function LoadThis($content) {
			global $CONF;

			$this->Buffer = $content;
			if ($CONF["TRANSLATOR_ENABLED"]) $this->Translate();
			return true;
		}

		// ASSIGN ARRAY ///////////////////////////////////////////////////////////////
		function AssignArray($array) {
			foreach ($array as $code => $value) {
				$this->Buffer = str_replace("{".$code."}", $value, $this->Buffer);
			}
		}

		// ASSIGN VALUE ///////////////////////////////////////////////////////////////
		function AssignValue($tag, $value) {
			$this->Buffer = str_replace("{".$tag."}", $value, $this->Buffer);
		}

		// ASSIGNROW //////////////////////////////////////////////////////////////////
		function AssignRow($prefix, $array) {
			foreach ($array as $code => $value) {
				$this->Buffer = str_replace("{".$prefix.".".$code."}", $value, $this->Buffer);
			}
		}

		// ASSIGN USER ////////////////////////////////////////////////////////////////
		function AssignUser($user) {
			if (strstr($this->Buffer, "{user.")) {
				if (($user) && (!is_array($user))) {
					$user = myF("
						SELECT *
						FROM `[x]users`
						WHERE `id`='{$user}'
						LIMIT 1
					");
				}
				if (is_array($user)) {
					foreach ($user as $code => $value) {
						$this->Buffer = str_replace("{user.".$code."}", $value, $this->Buffer);
					}
				}
			}
		}

		// ASSIGN LOOP ////////////////////////////////////////////////////////////////
		function Loop($name, $array) {
			global $CONF;

			preg_match("/\<LOOP {$name}\>(.*)\<\/LOOP {$name}\>/isU", $this->Buffer, $tag);

			if (isset($tag[1])) {

				$tag[1] = $this->StateZones($tag[1]);

				/* Initialize the final result container string */
				$ret = NULL;

				foreach($array as $key => $arr) {
					if (is_array($arr)) {
						$temp = $tag[1];
						foreach ($arr as $arkey => $arval) {
							$temp = str_replace("{".$arkey."}", $arval, $temp);
						}
						$ret .= $temp;
					}
				}

				$this->Buffer = str_replace($tag[0], $ret, $this->Buffer);
				return true;
			}
		}

		// GET OBJECTS ////////////////////////////////////////////////////////////////
		function GetObjects() {
			/*
				This will load all objects found in the template file into the
				$GLOBALS["OBJ"] array. The array key ($GLOBALS["OBJ"][KEY]) goes
				by the object name defined in the template.
			*/

			preg_match_all("|\<OBJ ([^>]+)\>(.*)\</OBJ [^>]+\>|isU", $this->Buffer, $obj, PREG_SET_ORDER);

			/* Match result:
				Array[i][0] => Full object with surrounding tags
				Array[i][1] => Object name
				Array[i][2] => Full object WITHOUT surrounding tags
			*/

			if (isset($obj) && is_array($obj)) {
				foreach($obj as $key => $objArray) {
					if (is_array($objArray)) {
						$GLOBALS["OBJ"][$objArray[1]] = $objArray[2];
						$this->Buffer = str_replace($objArray[0], NULL, $this->Buffer);
					}
				}
			}
		}

		// USE ZONE ///////////////////////////////////////////////////////////////////
		function Zone($group, $zone, $retmode=false) {
			/*
				This function will swap zones by groups names and remove other zones
				for the same group
			*/

			preg_match_all("|\<ZONE {$group} ([^>]+)\>(.*)\<\/ZONE {$group} [^>]+\>|isU", $this->Buffer, $zn, PREG_SET_ORDER);

			/* Match result:
				Array[i][0] => Full zone with surrounding tags
				Array[i][1] => zone name
				Array[i][2] => Full zone WITHOUT surrounding tags
			*/

			if (isset($zn) && is_array($zn)) {
				foreach ($zn as $key => $znArray) {
					if (is_array($znArray)) {
						if ($znArray[1] != $zone) {
							$this->Buffer = str_replace($znArray[0], NULL, $this->Buffer);
						} else {
							if ($retmode) return $znArray[2];
							else $this->Buffer = str_replace($znArray[0], $znArray[2], $this->Buffer);
						}
					}
				}
			}
		}


		// CLEAN ZONES ////////////////////////////////////////////////////////////////
		function CleanZones() {
			/*
				This function will remove uncalled zones before the template
				is flushed.
			*/

			preg_match_all("|\<ZONE (.*)\>.*\<\/ZONE \\1\>|isU", $this->Buffer, $zn, PREG_SET_ORDER);

			/* Match result:
				Array[i][0] => Full zone with surrounding tags
				Array[i][1] => zone name
				Array[i][2] => Full zone WITHOUT surrounding tags
			*/

			if (isset($zn) && is_array($zn)) {
				foreach ($zn as $key => $znArray) {
					if (is_array($znArray)) {
						$this->Buffer = str_replace($znArray[0], NULL, $this->Buffer);
					}
				}
			}
		}

		// SELECT FIELD ///////////////////////////////////////////////////////////////
		function FieldSelect($group, $option) {
			preg_match('%<select.*name="'.$group.'".*?>(.*)</select>%si', $this->Buffer, $groupMatch);
			if (isset($groupMatch[1])) {
				$this->Buffer = str_replace(
					$groupMatch[1],
					preg_replace(
						'/(<option[^<]?value="'.$option.'")([^>]?>)/si',
						'\\1 selected="selected"\\2',
						$groupMatch[1]
					),
					$this->Buffer
				);
			}
		}

		// CONVERT SELF USER //////////////////////////////////////////////////////////
		function ConvertSelf() {
			if (strstr($this->Buffer, "{me.")) {
				if ((!isset($GLOBALS["SELF_USER_DATA"])) || (!$GLOBALS["SELF_USER_DATA"])) { me('id'); }

				if (isset($GLOBALS["SELF_USER_DATA"]) && is_array($GLOBALS["SELF_USER_DATA"])) {

					foreach ($GLOBALS["SELF_USER_DATA"] as $code => $value) {
						$this->Buffer = str_replace("{me.".$code."}", $value, $this->Buffer);
					}
				}
			}
		}

		// TRANSLATE TEMPLATE /////////////////////////////////////////////////////////
		function Translate() {
			global $CONF;

			if (!$CONF["TRANSLATOR_FLAT_MODE"]) {
				if ($CONF["LOCALE_LANGUAGE_ALLOW_OVERRIDE"] and me("language")) {
					$dictionaryFile = $CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/".me("language").".php";
					$language = me("language");
				}
				else {
					$dictionaryFile = $CONF["LOCALE_LANGUAGEPACK_LOCATION"]."/".$CONF["LOCALE_SITE_DEFAULT_LANGUAGE"].".php";
					$language = $CONF["LOCALE_SITE_DEFAULT_LANGUAGE"];
				}

				if (strtolower($language) != "english" and !isset($GLOBALS['dictionary']) and is_file($dictionaryFile)) {
					if (include ($dictionaryFile)) $translator_flat_mode = false;
					else $translator_flat_mode = true;
				}
				else $translator_flat_mode = true;
			}
			else $translator_flat_mode = true;


			$this->Buffer = preg_replace(
				'/\\[([^\\]\\[]+) ?\\{(\\d+)\\}]/Usi',
				($translator_flat_mode ? "\\1" : "\\\$GLOBALS['dictionary']['\\2']"),
				$this->Buffer
			);
		}

		// USER STATES ////////////////////////////////////////////////////////////////
		function StateZones($buffer) {

			/*
				Deal with is_* tags, we remove the tag and keep the
				content if true, remove tag and content if false.
			*/
			if (preg_match('/<is_op>|<is_mop>|<is_guest>|<is_user>/i', $buffer)) {
				$buffer = preg_replace('%(<is_op>(.*)</is_op>)%si', (is_op() ? '\\2' : NULL), $buffer);
				$buffer = preg_replace('%(<is_mop>(.*)</is_mop>)%si', (is_mop() ? '\\2' : NULL), $buffer);
				$buffer = preg_replace('%(<is_guest>(.*)</is_guest>)%si', (!isset($_SESSION["id"]) ? '\\2' : NULL), $buffer);
				$buffer = preg_replace('%(<is_user>(.*)</is_user>)%si', (isset($_SESSION["id"]) ? '\\2' : NULL), $buffer);
			}
			return $buffer;
		}


		// FLUSH TEMPLATE /////////////////////////////////////////////////////////////
		function Flush($return=false) {

			$this->Buffer = $this->StateZones($this->Buffer);

			if (!$return) echo $this->Buffer;
			else return $this->Buffer;
		}

	// END OF TEMPLATE CLASS //////////////////////////////////////////////////////////
	}
?>
