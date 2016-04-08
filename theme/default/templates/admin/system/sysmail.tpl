<h2>System Mails Settings </h2>
<br /><br />
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Mail method: </strong></td>
    <td width="10"><select name="MAIL_METHOD" id="MAIL_METHOD">
      <option value="mail">Mail</option>
      <option value="tinymail">TinyMail</option>
      <option value="smtp">SMTP</option>
      <option value="sendmail">SendMail</option>
    </select></td>
    <td><label></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Characters set: </strong></td>
    <td><input name="MAIL_CHARSET" type="text" id="MAIL_CHARSET" value="{CONF.MAIL_CHARSET}" size="40" /></td>
    <td><label></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Encoding:</strong></td>
    <td><input name="MAIL_ENCODING" type="text" id="MAIL_ENCODING" value="{CONF.MAIL_ENCODING}" size="40" /></td>
    <td><label></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>SMTP Host: </strong></td>
    <td><input name="MAIL_SMTP_HOST" type="text" id="MAIL_SMTP_HOST" value="{CONF.MAIL_SMTP_HOST}" size="40" /></td>
    <td><label></label></td>
    <td>* Required if using the SMTP Mail method </td>
  </tr>
  <tr>
    <td><strong>SMTP Port: </strong></td>
    <td><input name="MAIL_SMTP_PORT" type="text" id="MAIL_SMTP_PORT" value="{CONF.MAIL_SMTP_PORT}" size="40" /></td>
    <td><label></label></td>
    <td>* Required if using the SMTP Mail method </td>
  </tr>
  <tr>
    <td><strong>SMTP Username: </strong></td>
    <td><input name="MAIL_SMTP_USER" type="text" id="MAIL_SMTP_USER" value="{CONF.MAIL_SMTP_USER}" size="40" /></td>
    <td>&nbsp;</td>
    <td>* If auth is required, using SMTP method </td>
  </tr>
  <tr>
    <td><strong>SMTP Password: </strong></td>
    <td><input name="MAIL_SMTP_PASSWORD" type="password" id="MAIL_SMTP_PASSWORD" value="{CONF.MAIL_SMTP_PASSWORD}" size="40" /></td>
    <td>&nbsp;</td>
    <td>* If auth is required, using SMTP method </td>
  </tr>
  <tr>
    <td><strong>SMTP Timeout: </strong></td>
    <td><input name="MAIL_SMTP_TIMEOUT" type="text" id="MAIL_SMTP_TIMEOUT" value="{CONF.MAIL_SMTP_TIMEOUT}" size="40" /></td>
    <td>&nbsp;</td>
    <td>* Required if using the SMTP Mail method </td>
  </tr>
  <tr>
    <td><strong>Sendmail Path: </strong></td>
    <td><input name="MAIL_SENDMAIL_PATH" type="text" id="MAIL_SENDMAIL_PATH" value="{CONF.MAIL_SENDMAIL_PATH}" size="40" /></td>
    <td>&nbsp;</td>
    <td>* Required if using SENDMAIL Mail method </td>
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
