<table width="600" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><h2>Files Access Permissions </h2>
      <p align="justify">This step will check for file and directory permissions. The system will try to automatically set file and directory permissions if it is possible. If there are errors after the check procedure, please set the permissions manually.</p>

      <div id="wrapper">
	  <table width="98%" border="0" align="left" cellpadding="0" cellspacing="5" bgcolor="#999999" style="
	  border: solid 2px #10203A;
	  margin: 5px;
	  padding: 1px;
	  ">
        <tr>
          <td><strong>Checking Permissions... Please stand by.  </strong></td>
        </tr>
        <tr>
          <td><div id="label" style="overflow:hidden; height:14px;">Initializing</div></td>
        </tr>
        <tr>
          <td><div id="progress" style="
		    background-color: #10203A;
			color: #FFFFFF;
			font-size: 12px;
			font-weight: bold;
		    width: 1px; 
			height: 20px;
			text-align: center;
			padding-top: 4px;
	    "> </div></td>
        </tr>
      </table>
	  </div>
	  
	  <div id="results" style="visibility:hidden; height:1px;">
	  <table width="98%" border="0" align="left" cellpadding="0" cellspacing="5" bgcolor="#999999" style="
	  border: solid 2px #10203A;
	  margin: 5px;
	  padding: 1px;
	  ">
        <tr>
          <td><strong>Permissions Check Results </strong></td>
        </tr>
        <tr>
          <td>
		   <div id="permissionsError" style="visibility:hidden;"></div>
		  </td>
        </tr>
      </table>
	  </div>


	  
    </td>
  </tr>
  <tr>
    <td align="right">
	<form method="get" action="index.php"><input type="hidden" name="step" value="5">
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
	$GLOBALS["processors"] = array("permissions/permissions.php");
?>