<h2>Maintenance Settings </h2>
<br /><br />
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>System is under Maintenance:  </strong></td>
    <td width="10">&nbsp;</td>
    <td><label><input type="checkbox" name="MAINTENANCE_MODE_ON" value="1" {ck.MAINTENANCE_MODE_ON}/> Maintenance Mode Enabled</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Generic Maintenance Mode Template: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAINTENANCE_MODE_TEMPLATE" type="text" id="MAINTENANCE_MODE_TEMPLATE" value="{CONF.MAINTENANCE_MODE_TEMPLATE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Admin Maintenance Mode Template: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAINTENANCE_MODE_ADMIN_TEMPLATE" type="text" id="MAINTENANCE_MODE_ADMIN_TEMPLATE" value="{CONF.MAINTENANCE_MODE_ADMIN_TEMPLATE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="Submit" value="Submit" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
