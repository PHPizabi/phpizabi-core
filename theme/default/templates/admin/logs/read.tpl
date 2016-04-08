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
	
<h2>Read Log File</h2>
<br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Log Date: </strong></td>
    <td>{log.date}</td>
    <td>&nbsp;</td>
    <td><strong>Approx hits in this logfile: </strong></td>
    <td>{log.hits}</td>
  </tr>
  <tr>
    <td><strong>Logfile Size: </strong></td>
    <td>{log.size} Mb </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td><strong>User ID </strong></td>
    <td><strong>Username</strong></td>
    <td><strong>IP</strong></td>
    <td><strong>L</strong></td>
    <td><strong>Time</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP logRows>
  <tr id="row_log_{log.id}" onClick="ck('{log.id}');">
    <td onMouseOver="omov('{log.id}', 1);" onMouseOut="omov('{log.id}', 0);">{log.id}</td>
    <td onMouseOver="omov('{log.id}', 1);" onMouseOut="omov('{log.id}', 0);">{log.userid}</td>
    <td onMouseOver="omov('{log.id}', 1);" onMouseOut="omov('{log.id}', 0);">{log.username}</td>
    <td onMouseOver="omov('{log.id}', 1);" onMouseOut="omov('{log.id}', 0);">{log.ip}</td>
    <td onMouseOver="omov('{log.id}', 1);" onMouseOut="omov('{log.id}', 0);">{log.l}</td>
    <td onMouseOver="omov('{log.id}', 1);" onMouseOut="omov('{log.id}', 0);">{log.date}</td>
    </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP logRows>
<tr>
    <td height="30" colspan="10" nowrap bgcolor="#CCCCCC" style="padding-left:5px; padding-right:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		<zone prevPage enabled>		
		  <a href="?L=admin.logs.read&id={prev.id}&page={prev.page}">&laquo; Previous 100 rows</a>
		</zone prevPage enabled>
		</td>
        <td align="right">
		<zone nextPage enabled>		
		  <a href="?L=admin.logs.read&id={next.id}&page={next.page}">Next 100 rows &raquo;</a>
		</zone nextPage enabled>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
