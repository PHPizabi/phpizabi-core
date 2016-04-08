<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_backup_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Access Logs</h2>
<p><br>
</p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="3">
        <tr>
          <td><strong>Total access log files: </strong></td>
          <td>{stats.totalFiles}</td>
        </tr>
        <tr>
          <td><strong>Total size: </strong></td>
          <td>{stats.totalSize} MegaBytes </td>
        </tr>
      </table></td>
      <td align="right" valign="top"><a href="?L=admin.system.cron">Scheduled Tasks Configurations </a></td>
    </tr>
  </table>
  <p><br>
  </p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Backup File</strong></td>
    <td><strong>Size</strong></td>
    <td><strong>Date</strong></td>
    <td><strong>Download</strong></td>
    <td><strong>Delete</strong></td>
    </tr>
  <tr>
    <td height="1" colspan="5" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP backupList>
  <tr id="row_backup_{backup.file}">
    <td onMouseOver="omov('{backup.file}', 1);" onMouseOut="omov('{backup.file}', 0);">{backup.file}</td>
    <td onMouseOver="omov('{backup.file}', 1);" onMouseOut="omov('{backup.file}', 0);">{backup.size} Kb </td>
    <td onMouseOver="omov('{backup.file}', 1);" onMouseOut="omov('{backup.file}', 0);">{backup.date}</td>
    <td onMouseOver="omov('{backup.file}', 1);" onMouseOut="omov('{backup.file}', 0);"><a href="?L=admin.backups.backups&get={backup.file}">Download</a></td>
    <td onMouseOver="omov('{backup.file}', 1);" onMouseOut="omov('{backup.file}', 0);"><a href="?L=admin.backups.backups&rm={backup.file}">Delete</a></td>
    </tr>
  <tr>
    <td height="1" colspan="5" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP backupList>
</table>
