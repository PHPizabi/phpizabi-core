<h2>Logging &amp; Statistics Configurations </h2>
<br /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
	</td>
    <td align="right"><a href="?L=admin.logs.logs">Browse  Access Logs </a></td>
  </tr>
</table>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Enable logging: </strong></td>
    <td width="10">&nbsp;</td>
    <td><label><input type="checkbox" name="LOG_ENABLED" value="1" {ck.LOG_ENABLED}/> Logging enabled</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Log directory: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOG_DIRECTORY" type="text" id="LOG_DIRECTORY" value="{CONF.LOG_DIRECTORY}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Error log file: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOG_ERRORLOG_FILE" type="text" id="LOG_ERRORLOG_FILE" value="{CONF.LOG_ERRORLOG_FILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Daily mode: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOG_DAILY_MODE" value="1" {ck.LOG_DAILY_MODE}/> Split log files per day</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Log file extention: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOG_FILE_EXTENTION" type="text" id="LOG_FILE_EXTENTION" value="{CONF.LOG_FILE_EXTENTION}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>UniLog file:  </strong></td>
    <td>&nbsp;</td>
    <td><label>
    <input name="LOG_UNILOG_FILE" type="text" id="LOG_UNILOG_FILE" value="{CONF.LOG_UNILOG_FILE}" size="40" />
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Log chromeless calls: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOG_CHROMELESS_CALLS" value="1" {ck.LOG_CHROMELESS_CALLS}/> Log internal chromeless calls</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Data separator: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOG_DATA_SEPARATORS" type="text" id="LOG_DATA_SEPARATORS" value="{CONF.LOG_DATA_SEPARATORS}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Line separator: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOG_LINE_SEPARATORS" type="text" id="LOG_LINE_SEPARATORS" value="{CONF.LOG_LINE_SEPARATORS}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Error message on log open: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOG_LOGFILE_ERROR:OPEN" type="text" id="LOG_LOGFILE_ERROR:OPEN" value="{CONF.LOG_LOGFILE_ERROR:OPEN}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Error message on log write: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOG_LOGFILE_ERROR:WRITE" type="text" id="LOG_LOGFILE_ERROR:WRITE" value="{CONF.LOG_LOGFILE_ERROR:WRITE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="Submit" value="Submit" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
