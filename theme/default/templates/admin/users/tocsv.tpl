<script language="javascript" type="text/javascript">
  function ck(id) {
    ckStatus = document.getElementById('ck_db_' + id).checked;
	
	document.getElementById('ck_db_' + id).checked = (ckStatus ? false : true);
	document.getElementById('row_db_' + id).style.backgroundColor = (ckStatus ? "#FFFFFF" : "#CFD6E2");
  }
  
  function omov(id, over) {
    ckStatus = document.getElementById('ck_db_' + id).checked;
	document.getElementById('row_db_' + id).style.backgroundColor = (over?(ckStatus?"#CFD6E2":"#F1F3F8"):(ckStatus?"#CFD6E2":"#FFFFFF"));
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>

<h2>Export users table as CSV</h2>
<p>&nbsp;</p>


<ZONE pageFlop form>
<form method="get" id="dbControlForm">
<input type="hidden" name="L" value="admin.users.tocsv">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Terminate fields with: </strong></td>
    <td><input name="field_terminator" type="text" id="field_terminator" value="," size="5"></td>
    <td>&nbsp;</td>
    <td><strong>Use this &quot;where&quot; clause: </strong></td>
    <td><input name="where" type="text" id="where" size="40"></td>
  </tr>
  <tr>
    <td><strong>Terminate lines with: </strong></td>
    <td><select name="line_terminator" id="line_terminator">
      <option value="crlf">Carriage Return + Line feed (CRLF)</option>
      <option value="cr">Carriage Return (CR)</option>
    </select>    </td>
    <td>&nbsp;</td>
    <td><strong>Use this &quot;order&quot; clause: </strong></td>
    <td><input name="order" type="text" id="order"></td>
  </tr>
</table>
<br>
<br>
<br>
<h2>Select fields to export</h2>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="22"><input type="checkbox" name="null" value="null" onClick="checkAll('dbControlForm', this.checked);"></td>
    <td width="40"><strong>Field</strong></td>
    <td><strong>Type</strong></td>
    <td><strong>Null</strong></td>
    <td><strong>Key</strong></td>
    <td><strong>Default</strong></td>
    <td><strong>Extra</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="7" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP dbList>
    <tr id="row_db_{db.id}" onClick="ck('{db.id}');">
      <td onMouseOver="omov('{db.id}', 1);" onMouseOut="omov('{db.id}', 0);"><input type="checkbox" name="ck[]" id="ck_db_{db.id}" value="{db.column}" onClick="ck('{db.id}');"></td>
      <td onMouseOver="omov('{db.id}', 1);" onMouseOut="omov('{db.id}', 0);">{db.column}</td>
      <td onMouseOver="omov('{db.id}', 1);" onMouseOut="omov('{db.id}', 0);">{db.type}</td>
      <td onMouseOver="omov('{db.id}', 1);" onMouseOut="omov('{db.id}', 0);">{db.null}</td>
      <td onMouseOver="omov('{db.id}', 1);" onMouseOut="omov('{db.id}', 0);">{db.key}</td>
      <td onMouseOver="omov('{db.id}', 1);" onMouseOut="omov('{db.id}', 0);">{db.default}</td>
      <td onMouseOver="omov('{db.id}', 1);" onMouseOut="omov('{db.id}', 0);">{db.extra}</td>
    </tr>
    <tr>
      <td height="1" colspan="7" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
    </tr>
  </LOOP dbList>
    <tr>
      <td height="30" colspan="7" bgcolor="#CCCCCC" style="padding-left:5px;"><input type="submit" name="Submit" value="Generate"></td>
    </tr>
</table>
</form>
</ZONE pageFlop form>

<ZONE pageFlop result>
    <strong>CSV export result:</strong><br>
    {csvCount} results exported<br> 
  <br> 
  <textarea name="textarea" rows="30" wrap="off" class="fullwidth">{csvOutput}</textarea>
  <br>
</ZONE pageFlop result>
<br>
<a href="?L=admin.users.tocsv">Generate another CSV exportation</a>  