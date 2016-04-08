<script type="text/javascript">
  var progress = document.getElementById('progress');
  var label = document.getElementById('label');
</script>
<?php

	// Checksum processor //

	$sums = explode("\n", file_get_contents("includes/checksum/checksum.txt"));
	$totalSums = count($sums);
	
	// Give the system a couple seconds ! //
	sleep(1);
	
	foreach ($sums as $i => $sum) {
	
		if ($sum != "") {

			$percentage = round((100 / $totalSums) * $i);
			
			$sum = str_replace("\r", "", $sum);
			
			list ($file, $md5val) = explode(":", $sum);
			if (!is_file("../{$file}")) $missingfiles[] = $file;
			elseif (md5_file("../{$file}") != $md5val) $wrongfiles[] = $file;
			
			echo "
				<script type=\"text/javascript\">
					progress.style.width = '{$percentage}%';
					progress.innerHTML = '{$percentage}%';
					label.innerHTML = 'Checking file {$file}';			
				</script>";
			flush();
			
			// Don't flood the system! //
			usleep(10);
		}
	}

	echo "
		<script type=\"text/javascript\">
			document.getElementById('wrapper').style.visibility = 'hidden';
			document.getElementById('wrapper').style.height = '1px';
			document.getElementById('results').style.visibility = 'visible';
			document.getElementById('results').style.height = '';
		</script>"
	;
	
	
	// Output the results //
	$fail = false;
	
	if (isset($missingfiles) && count($missingfiles) > 0) {
		echo "
			<script type=\"text/javascript\"> 
				document.getElementById('missingFiles').style.visibility = 'visible';
				document.getElementById('missingFiles').innerHTML = '<strong>Missing Files:</strong><br />".implode("<br />", $missingfiles)."';
			</script>"
		;
		
		$fail = true;
	}

	if (isset($wrongfiles) && count($wrongfiles) > 0) {
		echo "
			<script type=\"text/javascript\"> 
				document.getElementById('wrongFiles').style.visibility = 'visible';
				document.getElementById('wrongFiles').innerHTML = '<strong>Corrupted Files:</strong><br />".implode("<br />", $wrongfiles)."';
			</script>"
		;
		
		$fail = true;
	}
	
	if (!$fail) {
		echo "
			<script type=\"text/javascript\"> 
				document.getElementById('missingFiles').style.visibility = 'visible';
				document.getElementById('missingFiles').innerHTML = '<strong>System check completed. There was no error.</strong>';
			</script>"
		;
	}
?>


<script type="text/javascript">
	document.getElementById('submit').disabled = false;
	document.getElementById('submit').className = 'submit';
</script>