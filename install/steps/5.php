<table width="600" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><h2>Database Information </h2>
      <p align="justify">Please fill in the form below </p>

	  <?php if (!isset($_POST["Submit"])) { ?>	  
	  <form method="post">
	  <table width="98%" border="0" align="left" cellpadding="0" cellspacing="3" bgcolor="#999999" style="
	  border: solid 2px #10203A;
	  margin: 5px;
	  padding: 1px;
	  ">
        <tr>
          <td colspan="2"><strong>MySQL Database Information </strong></td>
        </tr>
        <tr>
          <td>Tables prefix: </td>
          <td><input name="dbpre" type="text" id="dbpre" value="<?php echo (isset($_SESSION["DB"]["dbpre"])?$_SESSION["DB"]["dbpre"]:"phpizabi_"); ?>" size="40"></td>
        </tr>
        <tr>
          <td>Database Username:  </td>
          <td><input name="dbun" type="text" id="dbun" size="40" value="<?php echo (isset($_SESSION["DB"]["dbun"])?$_SESSION["DB"]["dbun"]:NULL); ?>"></td>
        </tr>
        <tr>
          <td>Database Password: </td>
          <td><input name="dbpw" type="password" id="dbpw" size="40" value="<?php echo (isset($_SESSION["DB"]["dbpw"])?$_SESSION["DB"]["dbpw"]:NULL); ?>"></td>
        </tr>
        <tr>
          <td>Hostname:</td>
          <td><input name="dbhost" type="text" id="dbhost" value="<?php echo (isset($_SESSION["DB"]["dbhost"])?$_SESSION["DB"]["dbhost"]:"localhost"); ?>" size="40"></td>
        </tr>
        <tr>
          <td>Database name: </td>
          <td><input name="dbname" type="text" id="dbname" size="40" value="<?php echo (isset($_SESSION["DB"]["dbname"])?$_SESSION["DB"]["dbname"]:NULL); ?>"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><label><input name="create" type="checkbox" id="create" value="1">
            Attempt to create the database if it doesn't exist</label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit" value="Submit" class="submit"></td>
        </tr>
      </table>
	  </form>
	  <?php } else { ?>
	  <table width="98%" border="0" align="left" cellpadding="0" cellspacing="3" bgcolor="#999999" style="
	  border: solid 2px #10203A;
	  margin: 5px;
	  padding: 1px;
	  ">
        <tr>
          <td><strong>MySQL Database Test Result: </strong></td>
        </tr>

        <tr>
          <td><div id="dbresult">No result</div></td>
        </tr>
      </table>
	  <?php } ?>
	  </td>
  </tr>
  <tr>
    <td align="right">
	<form method="get" action="index.php"><input type="hidden" name="step" value="6">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right"><input name="Continue" type="submit" id="submit" value="Continue" disabled="disabled" class="submitdisabled"></td>
          </tr>
      </table>
	  
	
	</form>
	</td>
  </tr>
</table>
<?php
	if (isset($_POST["Submit"])) $GLOBALS["processors"] = array("database/dbinfo.php");
?>