<script language="javascript" type="text/javascript">
  function ck(id) {
    ckStatus = document.getElementById('ck_ban_' + id).checked;
	
	document.getElementById('ck_ban_' + id).checked = (ckStatus ? false : true);
	document.getElementById('row_ban_' + id).style.backgroundColor = (ckStatus ? "#FFFFFF" : "#CFD6E2");
  }
  
  function omov(id, over) {
    ckStatus = document.getElementById('ck_ban_' + id).checked;
	document.getElementById('row_ban_' + id).style.backgroundColor = (over?(ckStatus?"#CFD6E2":"#F1F3F8"):(ckStatus?"#CFD6E2":"#FFFFFF"));
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Ban Control</h2>
<p>&nbsp;</p>
<form metod="get" id="banControlForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input type="hidden" name="L" value="admin.users.ban" />
      <strong>{banCount.total} Total Bans, {banCount.active} are active</strong></td>
    <td align="right"><p><a href="?L=admin.system.bancontrol">Ban Control System Settings</a> </p>
      </td>
  </tr>
</table>
<br /><br /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="22"><input type="checkbox" name="null" value="null" onClick="checkAll('banControlForm', this.checked);"></td>
    <td width="40">&nbsp;</td>
    <td><strong>IP Pool Start </strong></td>
    <td><strong>IP Pool End </strong></td>
    <td><strong>Username</strong></td>
    <td><strong>Set by</strong></td>
    <td><strong>Expiration</strong></td>
    <td><strong>Active</strong></td>
    </tr>
  <tr>
    <td height="1" colspan="8" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP banList>
  <tr id="row_ban_{ban.id}" onClick="ck('{ban.id}');">
    <td onMouseOver="omov('{ban.id}', 1);" onMouseOut="omov('{ban.id}', 0);"><input type="checkbox" name="ck[]" id="ck_ban_{ban.id}" value="{ban.id}" onClick="ck('{ban.id}');"></td>
    <td onMouseOver="omov('{ban.id}', 1);" onMouseOut="omov('{ban.id}', 0);">{ban.id}</td>
    <td onMouseOver="omov('{ban.id}', 1);" onMouseOut="omov('{ban.id}', 0);">{ban.startip}</td>
    <td onMouseOver="omov('{ban.id}', 1);" onMouseOut="omov('{ban.id}', 0);">{ban.endip}</td>
    <td onMouseOver="omov('{ban.id}', 1);" onMouseOut="omov('{ban.id}', 0);">{ban.username}</td>
    <td onMouseOver="omov('{ban.id}', 1);" onMouseOut="omov('{ban.id}', 0);">{ban.from}</td>
    <td onMouseOver="omov('{ban.id}', 1);" onMouseOut="omov('{ban.id}', 0);">{ban.expire}</td>
    <td onMouseOver="omov('{ban.id}', 1);" onMouseOut="omov('{ban.id}', 0);">{ban.active}</td>
    </tr>
  <tr>
    <td height="1" colspan="8" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP banList>
  <tr>
    <td height="30" colspan="8" nowrap bgcolor="#CCCCCC" style="padding-left:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><select name="action" id="action">
          <option>With selected bans...</option>
          <option value="delete">Remove</option>
          <option value="extend_1h">Extend by 1 hour</option>
          <option value="extend_1d">Extend by 1 day</option>
          <option value="extend_1w">Extend by 1 week</option>
          <option value="extend_1m">Extend by 1 month</option>
        </select>
          <input name="Act" type="submit" id="Act" value="Submit"></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>







<p><br />
  <br />
  <br />
</p>
<h2>Add a ban entry </h2>
<ZONE createBan errorTimeStamp>
  <strong>Error: The specified expiration can not be converted to a timestamp</strong>
</ZONE createBan errorTimeStamp>

<ZONE createBan success>
  <strong>The ban entry has been successfully added</strong>
</ZONE createBan success>
<br />
<br />
<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>IP Pool Start: </strong></td>
    <td><input name="ipstart" type="text" id="ipstart" /></td>
    <td>&nbsp;</td>
    <td><strong>Expiration*:</strong></td>
    <td><input name="expire" type="text" id="expire" size="40" /></td>
  </tr>
  <tr>
    <td><strong>IP Pool End: </strong></td>
    <td><input name="ipend" type="text" id="ipend" /></td>
    <td>&nbsp;</td>
    <td><strong>Notes:</strong></td>
    <td><input name="note" type="text" id="note" size="40" /></td>
  </tr>
  <tr>
    <td><input name="Submit" type="submit" id="Submit" value="Create" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><p>* Expiration field can be filled with an english time expression that represents a date, or a date modifier. Examples;</p>
      <ul>
        <li>10 September 2009</li>
        <li>+1 day</li>
        <li>+1 week</li>
        <li>+1 month 2 week 5 days</li>
        <li>next monday</li>
        <li>tomorrow<br />
        </li>
      </ul></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
