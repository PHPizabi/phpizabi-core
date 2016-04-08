<table width="600" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><h2>Admin Account Creation </h2>
      <p align="justify">Please fill in the form below to create your administrative account</p>

	  <?php if (!isset($_POST["Submit"])) { ?>	  
	  <form method="post">
	  <table width="98%" border="0" align="left" cellpadding="0" cellspacing="3" bgcolor="#999999" style="
	  border: solid 2px #10203A;
	  margin: 5px;
	  padding: 1px;
	  ">
        <tr>
          <td colspan="2"><strong>Administrator information </strong></td>
        </tr>
        <tr>
          <td>Username:</td>
          <td><input name="adminun" type="text" id="adminun" size="40"></td>
        </tr>
        <tr>
          <td>Email Address: </td>
          <td><input name="adminem" type="text" id="adminem" size="40"></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input name="adminpass" type="password" id="adminpass" size="40"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
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
          <td><strong>Administrative account creation results: </strong></td>
        </tr>

        <tr>
          <td><div id="createresult">No result</div></td>
        </tr>
      </table>
	  <?php } ?>
	  </td>
  </tr>
  <tr>
    <td align="right">
	<form method="get" action="index.php"><input type="hidden" name="step" value="8">
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
	if (isset($_POST["Submit"])) $GLOBALS["processors"] = array("database/admincreate.php");
?>