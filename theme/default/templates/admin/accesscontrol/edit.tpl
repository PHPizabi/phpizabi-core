<script language="javascript" type="text/javascript">
  function ck(id) {
    ckStatus = document.getElementById('ck_page_' + id).checked;
	
	document.getElementById('ck_page_' + id).checked = (ckStatus ? false : true);
	document.getElementById('row_page_' + id).style.backgroundColor = (ckStatus ? "#FFFFFF" : "#CFD6E2");
  }
  
  function omov(id, over) {
    ckStatus = document.getElementById('ck_page_' + id).checked;
	document.getElementById('row_page_' + id).style.backgroundColor = (over?(ckStatus?"#CFD6E2":"#F1F3F8"):(ckStatus?"#CFD6E2":"#FFFFFF"));
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Access Control Rules</h2>
<p>&nbsp;</p>
<form method="post" id="rulesControlForm">
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td valign="top"><strong>Editing rules for user type <em>{type.name}</em> <br>
    </strong>
      <ZONE updateSuccess enabled><strong><span style="color:red;">Successfully updated access rules </span></strong></ZONE updateSuccess enabled></td>
    <td align="right" valign="top"><a href="?L=admin.heritage.setoverride&id={type.id}"></a> </td>
  </tr>
</table>
<br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><input type="checkbox" name="null" value="null" onClick="checkAll('rulesControlForm', this.checked);"></td>
    <td><strong>Page</strong></td>
    <td><strong>Allow</strong></td>
    <td><strong>Deny</strong></td>
    <td><strong>Usage Limit </strong></td>
    <td><strong>Delete Rule </strong></td>
  </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP rulesList>
  <tr id="row_page_{rule.page}" onClick="ck('{rule.page}');">
    <td onMouseOver="omov('{rule.page}', 1);" onMouseOut="omov('{rule.page}', 0);"><input type="checkbox" name="ck[]" id="ck_page_{rule.page}" value="{rule.page}" onClick="ck('{rule.page}');"></td>
    <td onMouseOver="omov('{rule.page}', 1);" onMouseOut="omov('{rule.page}', 0);">{rule.page}</td>
    <td onMouseOver="omov('{rule.page}', 1);" onMouseOut="omov('{rule.page}', 0);">{rule.allow}</td>
    <td onMouseOver="omov('{rule.page}', 1);" onMouseOut="omov('{rule.page}', 0);">{rule.deny}</td>
    <td onMouseOver="omov('{rule.page}', 1);" onMouseOut="omov('{rule.page}', 0);">{rule.bycount}<OBJ unlimited>unlimited</OBJ unlimited></td>
    <td onMouseOver="omov('{rule.page}', 1);" onMouseOut="omov('{rule.page}', 0);"><a href="?L=admin.accesscontrol.edit&id={type.id}&rm={rule.page}">Delete Rule </a> </td>
  </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP rulesList>
  <tr>
    <td height="30" colspan="6" nowrap bgcolor="#CCCCCC" style="padding-left:5px;"><select name="action" id="action">
      <option>With selected rules...</option>
      <option value="allow">Set to Allow</option>
      <option value="deny">Set to Deny</option>
      <option value="unlimited">Set usage limit to unlimited</option>
      <option value="delete">Delete rules</option>
      </select>
      <input name="Act" type="submit" id="Act" value="Submit"></td>
  </tr>
</table>
</form>



<h2>&nbsp;</h2>
<p>&nbsp;</p>
<h2>Add a rule</h2>
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Access rule:</strong></td>
    <td width="10">&nbsp;</td>
    <td><strong>
      <label><input name="allow" type="radio" value="1" checked> Allow </label>
	  <label><input name="allow" type="radio" value="0"> Deny </label>
	  </strong></td>
  </tr>
  <tr>
    <td><strong>Page:</strong></td>
    <td>&nbsp;</td>
    <td><select name="page" id="page">
		<LOOP pagesDropDown>
		<option value="{page.name}">{page.name}</option>
		</LOOP pagesDropDown>
        </select></td>
  </tr>
  <tr>
    <td><strong>Limit usages per day to: </strong></td>
    <td>&nbsp;</td>
    <td><input name="bycount" type="text" id="bycount" value="0">
0 / Blank: No limit </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit"></td>
  </tr>
</table>
</form>