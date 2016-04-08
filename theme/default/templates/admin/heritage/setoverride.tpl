<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_override_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Setting Heritage Override </h2>
<p><strong><br />
</strong>
  <br>
</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td><strong>Configuration Item </strong></td>
    <td><strong>Default Value </strong></td>
    <td><strong>Override Value </strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="5" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP heritageOverrideList>
  <tr id="row_override_{override.id}">
    <td onMouseOver="omov('{override.id}', 1);" onMouseOut="omov('{override.id}', 0);">&nbsp;</td>
    <td onMouseOver="omov('{override.id}', 1);" onMouseOut="omov('{override.id}', 0);">{override.var}</td>
    <td onMouseOver="omov('{override.id}', 1);" onMouseOut="omov('{override.id}', 0);">{override.conf} (...) </td>
    <td onMouseOver="omov('{override.id}', 1);" onMouseOut="omov('{override.id}', 0);">{override.val} (...) </td>
    <td onMouseOver="omov('{override.id}', 1);" onMouseOut="omov('{override.id}', 0);"><a href="?L=admin.heritage.setoverride&id={override.heritage}&rm={override.id}">Delete</a></td>
    </tr>
  <tr>
    <td height="1" colspan="5" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP heritageOverrideList>
</table>
<p><br>
  <br>
  <br>
</p>
<h2>Create an override</h2>
<br>
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Override entity:</strong> </td>
    <td>&nbsp;</td>
    <td><select name="entity" id="entity">
      <LOOP configDropDownOptions>
	    <option value="{var}">{var}</option>
      </LOOP configDropDownOptions>
    </select>
    </td>
  </tr>
  <tr>
    <td><strong>Override value:  </strong></td>
    <td>&nbsp;</td>
    <td><input name="value" type="text" id="value" size="50"></td>
  </tr>
  <tr>
    <td colspan="3"><input type="submit" name="Submit" value="Create"></td>
  </tr>
</table>
</form>