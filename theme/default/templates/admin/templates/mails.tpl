<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_mail_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Edit Mails Templates </h2>
<strong><br>
</strong>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<p><strong>{mailsCount.total} Total mails templates </strong></p>
    </td>
    <td align="right" valign="top"><a href="?L=admin.templates.editerrorpage&amp;id=generic"></a></td>
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
  <LOOP mailsList>
  <tr id="row_mail_{mail.file}">
    <td onMouseOver="omov('{mail.file}', 1);" onMouseOut="omov('{mail.file}', 0);">{mail.file}</td>
    <td onMouseOver="omov('{mail.file}', 1);" onMouseOut="omov('{mail.file}', 0);">{mail.size} Kb </td>
    <td onMouseOver="omov('{mail.file}', 1);" onMouseOut="omov('{mail.file}', 0);"><a href="?L=admin.templates.editmail&amp;id={mail.file}">Edit</a></td>
    </tr>
  <tr>
    <td height="1" colspan="3" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP mailsList>
</table>

<br /><br />
