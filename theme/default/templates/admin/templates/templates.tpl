<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_template_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Edit Templates </h2>
<strong><br>
</strong>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
	<p><strong>Editing templates in theme <em>{themeName} </em><br />
	  {templatesCount.total} Total mails templates </strong></p>
    </td>
    <td align="right" valign="top">
      <form method="get">
	  <input type="hidden" name="L" value="admin.templates.templates" />
	  <select name="theme" onChange="this.form.submit();">
	  <option>Edit templates in theme ...</option>
	  <LOOP themeList>
	  <option value="{theme.name}">{theme.name}</option>
	  </LOOP themeList>
      </select>
	  </form>
    </td>
  </tr>
</table>
<strong><br />
</strong>
  <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Mail Template </strong></td>
    <td><strong>Size</strong></td>
    <td><strong>Edit</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="3" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP templateList>
  <tr id="row_template_{template.file}">
    <td onMouseOver="omov('{template.file}', 1);" onMouseOut="omov('{template.file}', 0);">{template.file}</td>
    <td onMouseOver="omov('{template.file}', 1);" onMouseOut="omov('{template.file}', 0);">{template.size} Kb </td>
    <td onMouseOver="omov('{template.file}', 1);" onMouseOut="omov('{template.file}', 0);"><a href="?L=admin.templates.edittemplate&amp;id={template.file}">Edit</a></td>
    </tr>
  <tr>
    <td height="1" colspan="3" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP templateList>
</table>

<br /><br />
