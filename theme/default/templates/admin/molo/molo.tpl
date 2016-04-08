<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_molo_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Modules Loader </h2>
<p><a href="?L=admin.news.create"><br>
</a></p>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><strong>{moloCount.total} Total modules found in system </strong></td>
    <td align="right"><a href="?L=admin.pos.browser&mode=modules">Browse Available Modules </a></td>
  </tr>
</table>
<p><strong><br />
  </strong>
  <br>
  <br>
</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td><strong>Module Name </strong></td>
    <td><strong>Module Version</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>Details</strong></td>
    <td><strong>Install</strong></td>
    <td><strong>Update</strong></td>
    <td><strong>Uninstall</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="8" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP moloList>
  <tr id="row_molo_{molo.id}">
    <td onMouseOver="omov('{molo.id}', 1);" onMouseOut="omov('{molo.id}', 0);">{molo.id}</td>
    <td onMouseOver="omov('{molo.id}', 1);" onMouseOut="omov('{molo.id}', 0);">{molo.name}</td>
    <td onMouseOver="omov('{molo.id}', 1);" onMouseOut="omov('{molo.id}', 0);">{molo.version}</td>
    <td onMouseOver="omov('{molo.id}', 1);" onMouseOut="omov('{molo.id}', 0);">{molo.status}</td>
    <td onMouseOver="omov('{molo.id}', 1);" onMouseOut="omov('{molo.id}', 0);"><a href="?L=admin.molo.details&f={molo.file}">Details</a></td>
    <td onMouseOver="omov('{molo.id}', 1);" onMouseOut="omov('{molo.id}', 0);"><a href="?L=admin.molo.install&mode=install&f={molo.file}">Install</a></td>
    <td onMouseOver="omov('{molo.id}', 1);" onMouseOut="omov('{molo.id}', 0);"><a href="?L=admin.molo.install&mode=update&f={molo.file}">Update</a></td>
    <td onMouseOver="omov('{molo.id}', 1);" onMouseOut="omov('{molo.id}', 0);"><a href="?L=admin.molo.install&mode=uninstall&f={molo.file}">Uninstall</a></td>
  </tr>
  <tr>
    <td height="1" colspan="8" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP moloList>
</table>
<obj installed><span style="color:#009900;">Installed</span></obj installed>
<obj not_installed>Not Installed</obj not_installed>