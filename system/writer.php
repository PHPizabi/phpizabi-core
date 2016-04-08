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

	$image = imagecreatetruecolor(50, 20); 

	for ($i=0; $i < rand(20,40); $i++) {

		$x = rand(0, 50);
		$y = rand(0, 20);

		imageline($image, $x, $y, $x+rand(0,3), $y+rand(0,3), imagecolorallocate($image, rand(0,0),rand(0,0),rand(0,0)));
	}

	imagestring($image, 5, 3, 3, $_GET["T"], imagecolorallocate($image, 254,254,254));
	imagestring($image, 5, 4, 4, $_GET["T"], imagecolorallocate($image, 10,10,10));

	imagecolortransparent($image, imagecolorallocate($image, 0, 0, 0));
	imageinterlace($image);

	header("Content-type: image/gif");
	imagegif($image);
	imagedestroy($image);

	
?>