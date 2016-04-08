<script type="text/javascript">
  var progress = document.getElementById('progress');
  var label = document.getElementById('label');
</script>
<?php

	// Checksum processor //

	$perms = explode("\n", file_get_contents("includes/permissions/permissions.txt"));
	$totalPerms = count($perms);
	
	// Give the system a couple seconds ! //
	sleep(1);
	
	foreach ($perms as $i => $perm) {
	
		if ($perm != "") {

			$perm = str_replace("\r", "", $perm);

			$percentage = round((100 / $totalPerms) * $i);
			
			if (!is_writable("../".$perm)) {
				
				if (is_dir("../".$perm)) @chmod("../".$perm, "0777");
				else @chmod("../".$perm, "0666");
				
				// Check again //
				if (!is_writable("../".$perm)) {
					if (is_dir("../".$perm)) $fileError[] = "0777 : {$perm} directory must be writable";
					else $fileError[] = "0666 : {$perm} file must be writable";
				}
			}
				
			echo "
				<script type=\"text/javascript\">
					progress.style.width = '{$percentage}%';
					progress.innerHTML = '{$percentage}%';
					label.innerHTML = 'Checking file {$perm}';			
				</script>";
			flush();
			
			// Don't flood the system! //
			usleep(50000);
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
	if (isset($fileError) && count($fileError) > 0) {
		echo "
			<script type=\"text/javascript\"> 
				document.getElementById('permissionsError').style.visibility = 'visible';
				document.getElementById('permissionsError').innerHTML = '<strong>Permissions Errors:</strong><br />".implode("<br />", $fileError)."<br /><br /><a href=\"?step=4\">Test again</a>';
			</script>"
		;
		
		$fail = true;
	}
	
	else {
		echo "
			<script type=\"text/javascript\"> 
				document.getElementById('permissionsError').style.visibility = 'visible';
				document.getElementById('permissionsError').innerHTML = 'System check completed. There was no error.';
			</script>"
		;
	}
?>


<script type="text/javascript">
	document.getElementById('submit').disabled = false;
	document.getElementById('submit').className = 'submit';
</script>