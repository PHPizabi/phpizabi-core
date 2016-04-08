<script type="text/javascript">
  var label = document.getElementById('dbresult');
</script>
<?php

	if (isset($_POST["Submit"])) $_SESSION["DB"] = $_POST;

	$failed = false;
	
	if (!$conection = @mysql_connect($_SESSION["DB"]["dbhost"], $_SESSION["DB"]["dbun"], $_SESSION["DB"]["dbpw"])) {
		// Error @ connect //
		echo "
			<script type=\"text/javascript\">
				label.innerHTML = 'Failed to connect to the database. The server replied: <br />".str_replace("'", "", mysql_error())."<br /><br /><a href=\"?step=5\">Please start over</a>';
			</script>"
		;
		$failed = true;
	}
	
	if (!$failed && !@mysql_select_db($_SESSION["DB"]["dbname"])) {
		// Error @ select - Try to create //
		echo "
			<script type=\"text/javascript\">
				label.innerHTML = 'Failed to select the specified database. The server replied: <br />".str_replace("'", "", mysql_error())."<br /><br /><a href=\"?step=5\">Please start over</a>';
			</script>"
		;
		$failed = true;
	}
	
	if (!$failed) {
		
		if ($config = @file_get_contents("config/default.conf.inc.php")) {
			if ($handle = @fopen("../system/conf.inc.php", "w")) {
				
				$replaces = array(
					"##TABLEPREFIX##" => $_SESSION["DB"]["dbpre"],
					"##USERNAME##" => $_SESSION["DB"]["dbun"],
					"##PASSWORD##" => $_SESSION["DB"]["dbpw"],
					"##HOSTNAME##" => $_SESSION["DB"]["dbhost"],
					"##DATABASE##" => $_SESSION["DB"]["dbname"]
				);
				$config = strtr($config, $replaces);
				
				fwrite($handle, $config);
				fclose($handle);
				
				echo "
					<script type=\"text/javascript\">
						label.innerHTML = 'Success ... Please press Continue';
						document.getElementById('submit').disabled = false;
						document.getElementById('submit').className = 'submit';
					</script>"
				;
			} 
			
			else {
				echo "
					<script type=\"text/javascript\">
					label.innerHTML = 'There has been an error trying to write the configuration file. Please make sure
					that the system/conf.inc.php file is writable.<br /><br /><a href=\"?step=5\">Please start over</a>';
					</script>"
				;
			}
		}
		
		else {
			echo "
				<script type=\"text/javascript\">
				label.innerHTML = 'There has been an error trying to read the default configuration file. Please make sure
				that you uploaded the install/config/default.conf.inc.php file and that it is readable.<br /><br /><a href=\"?step=5\">Please start over</a>';
				</script>"
			;
		}
	}
?>