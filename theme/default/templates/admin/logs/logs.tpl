<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_log_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
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
      <td align="right" valign="top"><a href="?L=admin.system.logging">System Logging Configurations </a></td>
    </tr>
  </table>
  <p><br>
  </p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Log Date</strong> </td>
    <td><strong>Size</strong></td>
    <td>&nbsp;</td>
    <td><strong>View</strong></td>
    <td><strong>Delete</strong></td>
    </tr>
  <tr>
    <td height="1" colspan="5" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP logsList>
  <tr id="row_log_{log.datestamp}">
    <td onMouseOver="omov('{log.datestamp}', 1);" onMouseOut="omov('{log.datestamp}', 0);">{log.date}</td>
    <td onMouseOver="omov('{log.datestamp}', 1);" onMouseOut="omov('{log.datestamp}', 0);">{log.size} Mb </td>
    <td onMouseOver="omov('{log.datestamp}', 1);" onMouseOut="omov('{log.datestamp}', 0);">&nbsp;</td>
    <td onMouseOver="omov('{log.datestamp}', 1);" onMouseOut="omov('{log.datestamp}', 0);"><a href="?L=admin.logs.read&id={log.datestamp}">View</a></td>
    <td onMouseOver="omov('{log.datestamp}', 1);" onMouseOut="omov('{log.datestamp}', 0);"><a href="?L=admin.logs.logs&rm={log.datestamp}">Delete</a></td>
    </tr>
  <tr>
    <td height="1" colspan="5" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP logsList>
</table>
