<h2>Change User Password</h2>
<br /><br />
<ZONE chpass success><strong>Password updated successfully</strong></ZONE chpass success>
<ZONE chpass errorMismatch><strong>Error: Password blank or mismatch</strong></ZONE chpass errorMismatch>
<br /><br />

<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>New password: </strong></td>
    <td><input name="password" type="password" id="password"></td>
  </tr>
  <tr>
    <td><strong>Confirm:</strong></td>
    <td><input name="confirm" type="password" id="confirm"></td>
  </tr>
  <tr>
    <td height="30" colspan="2" bgcolor="#CCCCCC" style="padding-left:5px;"><input name="Submit" type="submit" id="Submit" value="Submit"></td>
  </tr>
</table>
</form>