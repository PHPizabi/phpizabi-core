<h2>Misc System Settings </h2>
<br /><br />
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Allow usernames in URL calls: </strong></td>
    <td width="10">&nbsp;</td>
    <td><label><input type="checkbox" name="ALLOW_USERNAMES_URL_CALLS" value="1" {ck.ALLOW_USERNAMES_URL_CALLS}/> Allow usernames in the &quot;?L&quot; key </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Use selfdata dual buffering: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="USE_SELFDATA_DUAL_BUFFERING" value="1" {ck.USE_SELFDATA_DUAL_BUFFERING}/> Use dual layer buffer</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Ban info file: </strong></td>
    <td>&nbsp;</td>
    <td><input name="BAN_INFO_FILE" type="text" id="BAN_INFO_FILE" value="{CONF.BAN_INFO_FILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Ban template file: </strong></td>
    <td>&nbsp;</td>
    <td><input name="BAN_TEMPLATE_FILE" type="text" id="BAN_TEMPLATE_FILE" value="{CONF.BAN_TEMPLATE_FILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Translator enabled: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="TRANSLATOR_ENABLED" value="1" {ck.TRANSLATOR_ENABLED}/> Use system translation</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Translator flat mode: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="TRANSLATOR_FLAT_MODE" value="1" {ck.TRANSLATOR_FLAT_MODE}/> Force flat mode </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Horoscopes datafile: </strong></td>
    <td>&nbsp;</td>
    <td><input name="HOROSCOPES_DATAFILE" type="text" id="HOROSCOPES_DATAFILE" value="{CONF.HOROSCOPES_DATAFILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Notifications datafile: </strong></td>
    <td>&nbsp;</td>
    <td><input name="NOTIFICATIONS_DATAFILE" type="text" id="NOTIFICATIONS_DATAFILE" value="{CONF.NOTIFICATIONS_DATAFILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Use virtual hosts: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="USE_VIRTUAL_HOSTS" value="1" {ck.USE_VIRTUAL_HOSTS}/> Enable virtual hosts </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Virtual hosts autoprefix:</strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="VIRTUAL_HOSTS_AUTO_TRY_PREFIX" value="1" {ck.VIRTUAL_HOSTS_AUTO_TRY_PREFIX}/> Try &quot;www&quot; prefix</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Virtual hosts info file: </strong></td>
    <td>&nbsp;</td>
    <td><input name="VIRTUAL_HOSTS_INFOFILE" type="text" id="VIRTUAL_HOSTS_INFOFILE" value="{CONF.VIRTUAL_HOSTS_INFOFILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Enable user level heritage: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="ENABLE_USER_LEVEL_HERITAGE" value="1" {ck.ENABLE_USER_LEVEL_HERITAGE}/> Enable heritage swapping</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Heritage info file: </strong></td>
    <td>&nbsp;</td>
    <td><input name="HERITAGE_INFOFILE" type="text" id="HERITAGE_INFOFILE" value="{CONF.HERITAGE_INFOFILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Body trim method: (strlen) </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="BODY_TRIM_METHOD_STRLEN" value="1" {ck.BODY_TRIM_METHOD_STRLEN}/> Chop body using string length</label></td>
    <td>* False: Chop at word boundaries </td>
  </tr>
  <tr>
    <td><strong>Https rollback: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="HTTPS_ROLLBACK" value="1" {ck.HTTPS_ROLLBACK}/> Https rollback mode</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Distance values unit: (Miles) </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="DISTANCE_VALUES_UNIT:MILES" value="1" {ck.DISTANCE_VALUES_UNIT:MILES}/> Use imperial units</label></td>
    <td>* False: Use metric (KM) units </td>
  </tr>
  <tr>
    <td><strong>Clean output buffer:</strong>  </td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="POST_PROCESS_CLEAN_OUTPUT" value="1" {ck.POST_PROCESS_CLEAN_OUTPUT}/>
      Clean output buffer</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Enable output compression: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="POST_PROCESS_COMPRESS_OUTPUT" value="1" {ck.POST_PROCESS_COMPRESS_OUTPUT}/> 
      Compress output</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Compression rate: </strong></td>
    <td>&nbsp;</td>
    <td><input name="POST_PROCESS_COMPRESSION_RATE" type="text" id="POST_PROCESS_COMPRESSION_RATE" value="{CONF.POST_PROCESS_COMPRESSION_RATE}" size="3" /></td>
    <td>* 1 to 9 </td>
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
