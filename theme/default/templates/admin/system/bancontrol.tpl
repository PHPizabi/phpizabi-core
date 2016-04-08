<h2>Ban Control Settings </h2>
<br /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
	</td>
    <td align="right"><a href="?L=admin.users.ban">Control Banishments</a>  </td>
  </tr>
</table>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Enable ban check: </strong></td>
    <td width="10">&nbsp;</td>
    <td><label><input type="checkbox" name="BAN_ENABLE_BANCHECK" value="1" {ck.BAN_ENABLE_BANCHECK}/> Enable ban control check</label>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Check proxy: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="BAN_CHECK_PROXY" value="1" {ck.BAN_CHECK_PROXY}/> Check for IP proxy</label>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Enforce bans: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="BAN_ENFORCE" value="1" {ck.BAN_ENFORCE}/> Enforce bans with cookies</label>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Ban info file: </strong></td>
    <td>&nbsp;</td>
    <td><input name="BAN_INFOFILE" type="text" id="BAN_INFOFILE" value="{CONF.BAN_INFOFILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p><strong>&quot;</strong><strong>Banned&quot; template file: </strong></p>      </td>
    <td>&nbsp;</td>
    <td><input name="BAN_TEMPLATE_FILE" type="text" id="BAN_TEMPLATE_FILE" value="{CONF.BAN_TEMPLATE_FILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Force suicide: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="BAN_FORCE_SUICIDE" value="1" {ck.BAN_FORCE_SUICIDE}/> Foce system sigsegv </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Suicide message: </strong></td>
    <td>&nbsp;</td>
    <td><input name="BAN_FORCE_SUICIDE_MESSAGE" type="text" id="BAN_FORCE_SUICIDE_MESSAGE" value="{CONF.BAN_FORCE_SUICIDE_MESSAGE}" size="40" /></td>
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
