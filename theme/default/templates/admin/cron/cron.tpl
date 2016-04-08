<h2>Scheduled Tasks Daemon Control </h2>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td nowrap="nowrap"><strong>Cron most probable status: </strong></td>
    <td width="10">&nbsp;</td>
    <td>
	  <ZONE cronStatus running>Running</ZONE cronStatus running>
	  <ZONE cronStatus dead>Dead</ZONE cronStatus dead>	</td>
    <td align="right"><a href="?L=admin.system.cron">System Scheduled Tasks Configurations</a> </td>
  </tr>
  <tr>
    <td nowrap="nowrap"><strong>Last cron cycle:</strong></td>
    <td>&nbsp;</td>
    <td colspan="2">{cron.lastCycle}</td>
  </tr>
  <tr>
    <td valign="top" nowrap="nowrap"><strong>Control:</strong></td>
    <td valign="top">&nbsp;</td>
    <td colspan="2"><p><a href="?L=admin.cron.cron&amp;run=1" target="_blank">Run</a> | <a href="?L=admin.cron.cron&amp;abort=1">Abort</a> | <a href="?L=admin.cron.cron&amp;launch=1">Run all tasks now</a> <br>
      <br>
      <strong>ATTENTION!</strong> Running cron may lock your browser. 
    If you want to run cron from here, it is strongly suggested that you open up another browser type and run cron with that browser. Once you pressed &quot;run&quot;, the page will NOT load but cron should start in the 
    background. Close your browser after you have clicked &quot;start&quot;.</p>    </td>
  </tr>
  <tr>
    <td colspan="4"><strong>Cron log:</strong> </td>
  </tr>
  <tr>
    <td colspan="4"><textarea name="textarea" rows="20" wrap="virtual" class="fullwidth">{cron.log}</textarea>
    <br>
    <a href="?L=admin.cron.cron&amp;clearlog=1">Clear the cron log</a> </td>
  </tr>
</table>
