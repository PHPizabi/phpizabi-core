<script type="text/javascript">
  var label = document.getElementById('createresult');
</script>
<?php

	if ($conection = @mysql_connect($_SESSION["DB"]["dbhost"], $_SESSION["DB"]["dbun"], $_SESSION["DB"]["dbpw"])) {
		@mysql_select_db($_SESSION["DB"]["dbname"]);
	}
		
	if (@mysql_query("
		INSERT INTO `{$_SESSION["DB"]["dbpre"]}users` 
		(`username`,`password`,`email`,`email_verified`,`active`,`is_administrator`,`is_superadministrator`)
		VALUES
		(
			'{$_POST["adminun"]}',
			'".md5($_POST["adminpass"])."',
			'{$_POST["adminem"]}',
			'1',
			'1',
			'1',
			'1'
		)
	")) {
		
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
				label.innerHTML = 'There has been an error trying to create your administrative account. Server replied: ".str_replace("'", "", mysql_error())."';
			</script>"
			;
	}
?>