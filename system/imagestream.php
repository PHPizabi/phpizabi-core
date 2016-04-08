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

// MAIN ///////////////////////////////////////////////////////////////////////////////

	/*
		This file is used externally, we will need to
		manually include the configuration file for
		this one
	*/
	include("conf.inc.php");
	
	
	/*
		Get information set from the remote file
	*/
	if (list($width, $height, $type, $attr) = @getimagesize($_GET["location"])) {
		
		switch($type) {
				
			case(1): // gif //
				$tempHandle = imagecreatefromgif($_GET["location"]);
				$handle = imagecreatetruecolor(imagesx($tempHandle), imagesy($tempHandle));
				imagecopy($handle, $tempHandle, 0, 0, 0, 0, $width, $height);
			break;
				
			case(2): // jpg //
				$handle = imagecreatefromjpeg($_GET["location"]);
			break;
				
			case(3): // png //
				$handle = imagecreatefrompng($_GET["location"]);
			break;
			
		}
	}
	
	else {
		
		$width = 100;
		$height = 100;
		
		$handle = imagecreatetruecolor($width, $height);
		$black = imagecolorallocate($handle, 0, 0, 0);
		$white = imagecolorallocate($handle, 255, 255, 255);
		
		imagefill($handle, 0, 0, $white);
		
		imageline($handle, 0, 0, $width, $height, $black);
		imageline($handle, 0, $height, $width, 0, $black);
		
		imageline($handle, 0, 0, $width, 0, $black); // Horizontal top
		imageline($handle, 0, $height-1, $width, $height-1, $black); // Horizontal bottom
		
		imageline($handle, 0, 0, 0, $height-1, $black); // Vertical left
		imageline($handle, $width-1, 0, $height-1, $width-1, $black); // Vertical right
	
	}


	if (isset($handle)) {
	
		$targetHeight = 100;
		$targetWidth = round($width * $targetHeight / $height);
		
		if ($targetWidth > $targetHeight) {
			
			$targetWidth = 100;
			$targetHeight = round($height * $targetWidth / $width);
			
		}
		
		$thumb = imagecreatetruecolor($targetWidth, $targetHeight);
		imagecopyresampled($thumb, $handle, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
		
		header("Content-type: image/jpeg");	
		imagejpeg($thumb);
		
		imagedestroy($thumb); 
		imagedestroy($handle);
	
	}
	
?>