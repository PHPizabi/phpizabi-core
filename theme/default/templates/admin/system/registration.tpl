<h2>Registration Settings </h2>
<br /><br />
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Auto active / approve users: </strong></td>
    <td width="10">&nbsp;</td>
    <td><label><input type="checkbox" name="REGISTRATION_AUTO_APPROVE" value="1" {ck.REGISTRATION_AUTO_APPROVE}/> Auto approve</label>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Only active / approve upon email check: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="REGISTRATION_APPROVE_UPON_EMAIL_CHECK" value="1" {ck.REGISTRATION_APPROVE_UPON_EMAIL_CHECK}/> Approve upon email check</label>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Allow same email to register again: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="REGISTRATION_ALLOW_DUPLICATE_EMAIL" value="1" {ck.REGISTRATION_ALLOW_DUPLICATE_EMAIL}/> Allow email clones</label>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Password minimum length: </strong></td>
    <td>&nbsp;</td>
    <td><input name="REGISTRATION_PASSWORD_MIN_CHAR" type="text" id="REGISTRATION_PASSWORD_MIN_CHAR" value="{CONF.REGISTRATION_PASSWORD_MIN_CHAR}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Save registration reference: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="REGISTRATION_SAVE_REFERENCE" value="1" {ck.REGISTRATION_SAVE_REFERENCE}/> Save reference</label>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Use HTTP referer as reference: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="REGISTRATION_REFERENCE:HTTP_REFERER" value="1" {ck.REGISTRATION_REFERENCE:HTTP_REFERER}/> Use HTTP reference </label></td>
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
<p>&nbsp;</p>
