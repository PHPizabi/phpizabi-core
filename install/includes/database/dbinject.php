<script type="text/javascript">
  var progress = document.getElementById('progress');
  var label = document.getElementById('label');
</script>
<?php

	// Database Injector //
	if ($conection = @mysql_connect($_SESSION["DB"]["dbhost"], $_SESSION["DB"]["dbun"], $_SESSION["DB"]["dbpw"])) {
		@mysql_select_db($_SESSION["DB"]["dbname"]);
	}
	
	$dbs = explode("\n", file_get_contents("includes/database/database.txt"));
	$totalDbs = count($dbs);
	
	// Give the system a couple seconds ! //
	sleep(1);
	
	foreach ($dbs as $i => $db) {
	
		if (trim($db) != "") {
			
			$db = str_replace("\r", "", $db);
			
			$percentage = round((100 / $totalDbs) * $i);
			
			$db = str_replace("##PREFIX##", $_SESSION["DB"]["dbpre"], $db);
			
			mysql_query($db);
			
			if (mysql_error()) $dbError[] = mysql_error();

			echo "
				<script type=\"text/javascript\">
					progress.style.width = '{$percentage}%';
					progress.innerHTML = '{$percentage}%';
					label.innerHTML = 'Performing ".substr(strtolower($db), 0, 100)."...';
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
	if (isset($dbError) && count($dbError) > 0) {
		echo "
			<script type=\"text/javascript\"> 
				document.getElementById('dbcreate').style.visibility = 'visible';
				document.getElementById('dbcreate').innerHTML = '<strong>There has been some errors while creating the database structure:</strong><br />".implode("<br /><br />", str_replace("'", "", $dbError))."<br /><br /><a href=\"?step=5\">Start Over</a>';
			</script>"
		;		
	}
	
	else {
		echo "
			<script type=\"text/javascript\"> 
				document.getElementById('dbcreate').style.visibility = 'visible';
				document.getElementById('dbcreate').innerHTML = 'Database Creation Successful ... Please press Continue';
			</script>"
		;
		
	}

?>


<script type="text/javascript">
	document.getElementById('submit').disabled = false;
	document.getElementById('submit').className = 'submit';
</script>