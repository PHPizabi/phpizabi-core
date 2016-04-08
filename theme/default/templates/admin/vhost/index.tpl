<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_vhost_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Virtual Hosts Management </h2>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>{dbCount.total} Total virtual hosts </strong></td>
    <td align="right"><a href="?L=admin.system.miscs">System Configuration (Enable / Disable virtual hosts) </a></td>
  </tr>
</table>
<strong><br />
</strong>
  <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Domain Name </strong></td>
    <td><strong>Total Overrides </strong></td>
    <td><strong>Overrides</strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP vhostsList>
  <tr id="row_vhost_{vhost.id}">
    <td onMouseOver="omov('{vhost.id}', 1);" onMouseOut="omov('{vhost.id}', 0);">{vhost.id}</td>
    <td onMouseOver="omov('{vhost.id}', 1);" onMouseOut="omov('{vhost.id}', 0);">{vhost.overrideCount}</td>
    <td onMouseOver="omov('{vhost.id}', 1);" onMouseOut="omov('{vhost.id}', 0);"><a href="?L=admin.vhost.setoverride&amp;id={vhost.id}">Set Overrides </a></td>
    <td onMouseOver="omov('{vhost.id}', 1);" onMouseOut="omov('{vhost.id}', 0);"><a href="?L=admin.vhost.index&amp;rm={vhost.id}">Delete</a></td>
    </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP vhostsList>
</table>
<p><br>
  <br>
  <br>
</p>
<h2>Create a Virtual Host </h2>
<br>
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Domain name: </strong></td>
    <td>&nbsp;</td>
    <td><input name="domain" type="text" id="domain"></td>
  </tr>
  <tr>
    <td colspan="3"><input type="submit" name="Submit" value="Create"></td>
  </tr>
</table>
</form>