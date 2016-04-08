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
	
	class calendar {
	
		var $month;
		var $year;
		var $dayLinks;
		var $calRender;
		
		function calendar($m=NULL, $y=NULL, $dl=NULL) {
			/* Assign a m/y for the calendar to be generated */
			$this->month = (!is_null($m)?$m:date("m"));
			$this->year = (!is_null($y)?$y:date("Y"));
			/* Assign the day links */
			$this->dayLinks = (is_array($dl)?$dl:array());
		}
		
		function injectDate($date, $link) {
			$this->dayLinks[$date] = $link;
		}
		
		/* Just a shortcut ;) */
		function makeAndFlush() {
			$this->make();
			return $this->flush();
		}

		function make() {
			/* Calendar maker */
			$c = "<div id=\"calendar\">";
			
			/* Find the position of the first day of that month in the first week of the month */
			$dayOne = date("w", mktime(0,0,0,$this->month,1,$this->year))+1;
			
			/* Find how many days there is in the given month */
			$daysInMonth = date("t", mktime(0,0,0,$this->month,1,$this->year))+1;
			
			/* Set a pointer variable */
			$dayNo = 1;
			
			for ($row=1; $dayNo < $daysInMonth; $row++) {

				$c .= "<div id=\"calendar_row\">";
				
				/* Print a day */
				for ($col=1; $col <= 7; $col++) {
					
					if ($row==1 && $col < $dayOne) {
						/* Make a blank cell */
						$c .= "<div id=\"calendar_emptyday\">&nbsp;</div>";
					} elseif ($dayNo >= $daysInMonth) {
						$c .= "<div id=\"calendar_emptyday\">&nbsp;</div>";
						$dayNo++;
					} else {
						
						if ($this->month.$dayNo.$this->year == date("mdY")) {
							$dayTag = "<strong>{$dayNo}</strong>";
						} else $dayTag = $dayNo;
						
						if (in_array($dayNo, array_keys($this->dayLinks))) {
							$c .= "<div id=\"calendar_busyDay\"><a href=\"".$this->dayLinks[$dayNo]."\">{$dayTag}</a></div>";
						} else {
							$c .= "<div id=\"calendar_day\">{$dayTag}</div>";
						}
						$dayNo++;
					}
				}
				
				$c .= "</div>";
			}
			$c .= "</div>";

			$this->calRender = $c;
			unset($c);
			return true;
		}
		
		function flush() {
			return $this->calRender;
		}
    }
?>