<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_error_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Error Pages</h2>
<strong><br>
</strong>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<p><strong>{errorCount.total} Total error pages </strong></p>
	<zone error writeLock>
    <p style="color:red"><strong>The error pages directory is write protected. You won't be able to create error pages.</strong></p>
    </zone error writeLock>
    </td>
    <td align="right" valign="top"><a href="?L=admin.templates.editerrorpage&amp;id=generic">Edit the generic error page </a></td>
  </tr>
</table>
<strong><br />
</strong>
  <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Access Error for Page </strong></td>
    <td><strong>Size</strong></td>
    <td><strong>Edit</strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP errorPagesList>
  <tr id="row_error_{error.file}">
    <td onMouseOver="omov('{error.file}', 1);" onMouseOut="omov('{error.file}', 0);">{error.file}</td>
    <td onMouseOver="omov('{error.file}', 1);" onMouseOut="omov('{error.file}', 0);">{error.size} Kb </td>
    <td onMouseOver="omov('{error.file}', 1);" onMouseOut="omov('{error.file}', 0);"><a href="?L=admin.templates.editerrorpage&amp;id={error.file}">Edit</a></td>
    <td onMouseOver="omov('{error.file}', 1);" onMouseOut="omov('{error.file}', 0);"><a href="?L=admin.templates.errorpages&amp;rm={error.file}">Delete</a></td>
    </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP errorPagesList>
</table>

<br /><br /><br />

<h2><strong>Create an Error Page</strong></h2>
<br /><br />
<form method="get">
  <input type="hidden" name="L" value="admin.templates.editerrorpage" />
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td>For this page: 
      <select name="id" id="id">
        <LOOP modulesDropDown>
		  <option value="{module}" selected>{module}</option>
		</LOOP modulesDropDown>
      </select> 
      <span style="padding-left:8px;">
      <input name="Submit" type="submit" id="Submit" value="Create" />
      </span> </td>
  </tr>
</table>
</form>