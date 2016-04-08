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

	/* Graphic size */
	if (!isset($_GET["size"])) $size = array("x" => 600, "y" => 250);
	else list($size["x"], $size["y"]) = explode(",", $_GET["size"]);
	
	$graph_pad_top = 40;
	$graph_pad_bottom = 30;
	$graph_pad_left = 60;
	$graph_pad_right = 20;
	$y_legend_padding_right = 10;
	
	$graph_height = $size["y"] - $graph_pad_top - $graph_pad_bottom;
	$graph_width = $size["x"] - $graph_pad_left - $graph_pad_right;
	
	$array_data = unserialize(base64_decode($_GET["array"]));

	
	// IMAGE CONSTRUCTION /////////////////////////////////////////////////////
	$img = imagecreatetruecolor($size["x"], $size["y"]);

	/* Colors allocation */
	$white_gray_blue = 	imagecolorallocate($img, 242, 244, 249);
	$pale_gray_blue = 	imagecolorallocate($img, 226, 230, 238);
	$pale_blue = 		imagecolorallocate($img, 207, 214, 226);
	$blue = 			imagecolorallocate($img, 44, 67, 132);
	$black = 			imagecolorallocate($img, 0, 0, 0);
	$white =			imagecolorallocate($img, 255, 255, 255);
	
	/* Set the image background */
	imagefill($img, 0, 0, $pale_gray_blue);
	
	/* Set the borders */
	imagerectangle($img, 0, 0, $size["x"]-1, $size["y"]-1, $pale_blue);
	imagerectangle($img, 1, 1, $size["x"]-2, $size["y"]-2, $pale_blue);
	
	/* Draw the graph recrangle part */
	imagefilledrectangle(
		$img, 
		$graph_pad_left, 
		$graph_pad_top, 
		$size["x"] - $graph_pad_right, 
		$size["y"] - $graph_pad_bottom, 
		$white
	);
	
	imagerectangle(
		$img, 
		$graph_pad_left, 
		$graph_pad_top, 
		$size["x"] - $graph_pad_right, 
		$size["y"] - $graph_pad_bottom, 
		$pale_blue
	);
	
	/* Add the copyright notice */
	imagestring($img, 1, $size["x"]-45, $size["y"]-12, "PHPizabi", $pale_blue);
	
	/* Add the graphic title */
	imagestring($img, 3, 6, ($graph_pad_top - imagefontheight(3)) / 2, $_GET["title"], $blue);
	
	/* Add the left Y legend, it's centered with the graph block */
	imagestringup(
		$img, 
		3, 
		(($graph_pad_left - imagefontheight(3)) / 2) - $y_legend_padding_right,
		(($graph_height - (strlen($_GET["y_legend"]) * imagefontwidth(3))) / 2) + $graph_pad_top + (strlen($_GET["y_legend"]) * imagefontwidth(3)),
		$_GET["y_legend"], 
		$blue
	);
	
	// POPULATE ARRAY MEMBERS ////////////////////////////////////////////////////
	/*
		Array map:
			$a["Monday"] = 8;
			$a["Tuesday"] = 100;
			...
	*/
	$labels = array_keys($array_data);
	$high_value = max($array_data);
	$total_cols = count($array_data);
	$y_subdivisions = 5;
	$y_hops_pixel_interval = $graph_width / $total_cols;
	
	$x_hops = 10;
	
	$x_subdivisions = 4;
	$x_hops_interval = round($high_value / $x_hops);
	$x_hops_pixel_interval = $graph_height / $x_hops;
	
	/* Generate the X subdivisions by $hops*$x_subdivisions hops */
	for ($i=1; $i < $x_hops * $x_subdivisions; $i++) {
		$line_x = ($graph_height + $graph_pad_top) - $x_hops_pixel_interval / $x_subdivisions * $i;
		imageline($img, $graph_pad_left + 1, $line_x, $size["x"] - $graph_pad_right - 1, $line_x, $white_gray_blue);
	}
	
	/* Generate the X divisions by $hops hops */
	for ($i=1; $i < $x_hops; $i++) {
		imageline(
			$img,
			$graph_pad_left+1, 
			($graph_height + $graph_pad_top) - $x_hops_pixel_interval * $i,
			$size["x"] - $graph_pad_right - 1, 
			($graph_height + $graph_pad_top) - $x_hops_pixel_interval * $i,
			$pale_gray_blue
		);
		
		imageline(
			$img, 
			$graph_pad_left - 5, 
			($graph_height + $graph_pad_top) - $x_hops_pixel_interval * $i,
			$graph_pad_left - 1, 
			($graph_height + $graph_pad_top) - $x_hops_pixel_interval * $i,
			$pale_blue
		);
		
		/* Print the tags */
		imagestring(
			$img,
			1, 
			$graph_pad_left - (strlen($x_hops_interval * $i) * imagefontwidth(1)) - 10, 
			($graph_height + $graph_pad_top) - $x_hops_pixel_interval * $i - (imagefontheight(1) / 2),
			$x_hops_interval * $i,
			$black
		);
	}
	
	/* Y Injections */
	for ($i=0; $i < $total_cols; $i++) {
		
		/* Generate the Y divisions by $total_cols hops */
		if ($i > 0 and $i < $total_cols-1) {
			imageline(
				$img, 
				$graph_pad_left + (($graph_width / ($total_cols - 1)) * $i),
				$graph_pad_top + 1, 
				$graph_pad_left + (($graph_width / ($total_cols - 1)) * $i),
				$graph_pad_top + $graph_height - 1, 
				$pale_blue
			);
		}
			
		/* Generate the footer labels */
		$string_y = $graph_pad_left + (($graph_width / (($total_cols - 1 > 0 ? $total_cols - 1 : 1))) * $i) - 
		($i == $total_cols-1 
			? (imagefontwidth(1) * strlen($labels[$i])) 
			: ($i != 0 ? (imagefontwidth(1) * strlen($labels[$i]) / 2) : 0)
		);
		imagestring($img, 1, $string_y, $graph_height + $graph_pad_top + 5, $labels[$i], $black);
	}
	
	/* Generate the graph */
	imagesetthickness($img, 2);
	for ($i=0; $i < $total_cols-1; $i++) {
		imageline(
			$img, 
			$graph_pad_left + (($graph_width / ($total_cols - 1)) * $i),
			($graph_height + $graph_pad_top) - ($graph_height / $high_value) * $array_data[$labels[$i]],
			$graph_pad_left + (($graph_width / ($total_cols - 1)) * ($i+1)),
			($graph_height + $graph_pad_top) - ($graph_height / $high_value) * $array_data[$labels[$i+1]],
			$blue
		);
	}
	
	
	/* Flush the image result */
	header("Content-type: image/gif");
	imagegif($img);
	imagedestroy($img);


?>