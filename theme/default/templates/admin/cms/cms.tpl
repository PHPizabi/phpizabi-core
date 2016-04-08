<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_cms_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Content Pages Management</h2>
<strong><br>
</strong>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<p><strong>{cmsCount.total} Total content pages </strong></p>
    </td>
    <td align="right" valign="top"><a href="?L=admin.cms.edit"></a></td>
  </tr>
</table>
<strong><br />
</strong>
  <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Content page </strong></td>
    <td><strong>Size</strong></td>
    <td><strong>Last Modifications </strong></td>
    <td><strong>View</strong></td>
    <td><strong>Edit</strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP cmsList>
  <tr id="row_cms_{cms.file}">
    <td onMouseOver="omov('{cms.file}', 1);" onMouseOut="omov('{cms.file}', 0);">{cms.file}</td>
    <td onMouseOver="omov('{cms.file}', 1);" onMouseOut="omov('{cms.file}', 0);">{cms.size} Kb </td>
    <td onMouseOver="omov('{cms.file}', 1);" onMouseOut="omov('{cms.file}', 0);">{cms.lastmod}</td>
    <td onMouseOver="omov('{cms.file}', 1);" onMouseOut="omov('{cms.file}', 0);"><a href="?L=cms.{cms.file}" target="_blank">View</a></td>
    <td onMouseOver="omov('{cms.file}', 1);" onMouseOut="omov('{cms.file}', 0);"><a href="?L=admin.cms.edit&id={cms.file}">Edit</a></td>
    <td onMouseOver="omov('{cms.file}', 1);" onMouseOut="omov('{cms.file}', 0);"><a href="?L=admin.cms.cms&rm={cms.file}">Delete</a></td>
  </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP cmsList>
</table>

<p><br />
  <br />
<h2>Create a new content page</h2>
<form method="get">
<input type="hidden" name="L" value="admin.cms.edit" />
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Page name: </strong></td>
    <td>&nbsp;</td>
    <td><input name="id" type="text" id="id"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit"></td>
  </tr>
</table>
<p>&nbsp;</p>
