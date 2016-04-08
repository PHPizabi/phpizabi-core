<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_heritage_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>User Account Heritage Levels</h2>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>{dbCount.total} Total heritage levels in database</strong></td>
    <td align="right"><a href="?L=admin.system.miscs">System Heritage Configurations  </a></td>
  </tr>
</table>
<strong><br />
</strong>
  <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td><strong>Name</strong></td>
    <td><strong>Total Overrides </strong></td>
    <td><strong>Overrides</strong></td>
    <td><strong>Access Control </strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP heritageList>
  <tr id="row_heritage_{heritage.id}">
    <td onMouseOver="omov('{heritage.id}', 1);" onMouseOut="omov('{heritage.id}', 0);">{heritage.id}</td>
    <td onMouseOver="omov('{heritage.id}', 1);" onMouseOut="omov('{heritage.id}', 0);">{heritage.name}</td>
    <td onMouseOver="omov('{heritage.id}', 1);" onMouseOut="omov('{heritage.id}', 0);">{heritage.overrideCount}</td>
    <td onMouseOver="omov('{heritage.id}', 1);" onMouseOut="omov('{heritage.id}', 0);"><a href="?L=admin.heritage.setoverride&id={heritage.id}">Set Overrides </a></td>
    <td onMouseOver="omov('{heritage.id}', 1);" onMouseOut="omov('{heritage.id}', 0);"><a href="?L=admin.accesscontrol.edit&amp;id={heritage.id}">Access Control</a> </td>
    <td onMouseOver="omov('{heritage.id}', 1);" onMouseOut="omov('{heritage.id}', 0);"><a href="?L=admin.heritage.levels&rm={heritage.id}">Delete</a></td>
    </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP heritageList>
</table>
<p><br>
  <br>
  <br>
</p>
<h2>Create an heritage </h2>
<br>
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Heritage name: </strong></td>
    <td>&nbsp;</td>
    <td><input name="name" type="text" id="name"></td>
  </tr>
  <tr>
    <td colspan="3"><input type="submit" name="Submit" value="Create"></td>
  </tr>
</table>
</form>