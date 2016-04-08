<h2>Mass Mailer</h2>
<br /><br />
<ZONE massmail preview>
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
    <tr>
      <td height="30" colspan="2" bgcolor="#CCCCCC" style="padding-left:5px;"><strong>System is going to send mass mail {users.count} total user(s)</strong></td>
    </tr>
    <tr>
      <td valign="top"><strong>Subject:</strong></td>
      <td valign="top">{field.subject}</td>
    </tr>
    <tr>
      <td valign="top"><strong>Body:</strong></td>
      <td valign="top"><em>{field.body}</em></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</ZONE massmail preview>
<ZONE massmail success>
<strong>Successfully sent mass mail</strong>
</ZONE massmail success>
<br />
<br />

<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Send mail to:  </strong></td>
    <td><select name="mode" id="mode">
      <option value="all" {ck.mode.all}>All Users</option>
      <option value="active" {ck.mode.active}>Active Users</option>
      <option value="nonactive" {ck.mode.nonactive}>Non-Active Users</option>
      <option value="admin" {ck.mode.admin}>Administrators</option>
      <option value="cemail" {ck.mode.cemail}>Users with confirmed email</option>
      <option value="uncemail" {ck.mode.uncemail}>Users with unconfirmed email</option>
      <option value="customlist" {ck.mode.customlist}>Use Custom Users List / Bulk Mail List</option>
      <option value="customwhere" {ck.mode.customwhere}>Use Custom Where Clause</option>
    </select>    </td>
    <td>&nbsp;</td>
    <td><strong>Users list*:</strong></td>
    <td><input name="userslist" type="text" id="userslist" value="{field.userslist}"></td>
  </tr>
  <tr>
    <td><strong>Subject:</strong></td>
    <td><input name="subject" type="text" id="subject" value="{field.subject}" size="40"></td>
    <td>&nbsp;</td>
    <td><strong>Custom <em>where</em> clause: </strong></td>
    <td><input name="where" type="text" id="where" value="{field.where}"></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><strong>Message body:</strong> </td>
  </tr>
  <tr>
    <td colspan="5"><textarea name="body" rows="20" class="fullwidth" id="body">{field.body}
</textarea></td>
  </tr>
  <tr>
    <td height="30" colspan="5" bgcolor="#CCCCCC" style="padding-left:5px;"><input name="Preview" type="submit" id="Preview" value="Preview">
    <input name="Submit" type="submit" id="Submit" value="Send"></td>
  </tr>
</table>
</form>