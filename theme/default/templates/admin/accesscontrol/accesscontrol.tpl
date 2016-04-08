<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_type_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Access Control</h2>
<p><a href="?L=admin.news.create"><br>
</a><br>
</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Select a user type to edit</strong></td>
    <td align="right"><a href="?L=admin.system.accessrule">Default Access Rules</a> </td>
  </tr>
</table>
<p><br>
</p>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Type Id </strong></td>
    <td><strong>User Type </strong></td>
    <td>&nbsp;</td>
    <td><strong>Edit Access Restrictions </strong></td>
  </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP usersTypes>
  <tr id="row_type_{type.id}">
    <td onMouseOver="omov('{type.id}', 1);" onMouseOut="omov('{type.id}', 0);">{type.id}</td>
    <td onMouseOver="omov('{type.id}', 1);" onMouseOut="omov('{type.id}', 0);">{type.name}</td>
    <td onMouseOver="omov('{type.id}', 1);" onMouseOut="omov('{type.id}', 0);">&nbsp;</td>
    <td onMouseOver="omov('{type.id}', 1);" onMouseOut="omov('{type.id}', 0);"><a href="?L=admin.accesscontrol.edit&id={type.id}">Edit Access Restrictions </a></td>
    </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP usersTypes>
</table>
