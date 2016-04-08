<h2>Database Settings </h2>
<br /><br />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
	<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>&nbsp;</td>
    <td align="right"><a href="?L=admin.cron.cron">Scheduled Tasks Daemon Control</a> </td>
  </tr>
</table>
<br /><br />
<form method="post">
  <table border="0" cellspacing="3" cellpadding="0">
    <tr>
      <td><strong>Cron cycle delay: </strong></td>
      <td width="10">&nbsp;</td>
      <td><input name="CRON_CYCLE_DELAY" type="text" id="CRON_CYCLE_DELAY" value="{CONF.CRON_CYCLE_DELAY}" size="40" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Clean chat IO buffer: </strong></td>
      <td>&nbsp;</td>
      <td><label>
        <input type="checkbox" name="CRON_CLEAR_CHAT_IO" value="1" {ck.CRON_CLEAR_CHAT_IO}/>
        Clean chat IO buffer</label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Clean chat IO once every: </strong></td>
      <td>&nbsp;</td>
      <td><input name="CRON_CLEAR_CHAT_IO_DELAY" type="text" id="CRON_CLEAR_CHAT_IO_DELAY" value="{CONF.CRON_CLEAR_CHAT_IO_DELAY}" size="40" /></td>
      <td>seconds</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Clear old lane tokens: </strong></td>
      <td>&nbsp;</td>
      <td><label>
        <input type="checkbox" name="CRON_CLEAR_LANE_TOKEN" value="1" {ck.CRON_CLEAR_LANE_TOKEN}/>
        Clear lane tokens</label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Clear old lane tokens once every: </strong></td>
      <td>&nbsp;</td>
      <td><input name="CRON_CLEAR_LANE_TOKEN_DELAY" type="text" id="CRON_CLEAR_LANE_TOKEN_DELAY" value="{CONF.CRON_CLEAR_LANE_TOKEN_DELAY}" size="40" /></td>
      <td>seconds</td>
    </tr>
    <tr>
      <td><strong>Clear tokens that are older than: </strong></td>
      <td>&nbsp;</td>
      <td><label>
        <input name="CRON_CLEAR_LANE_TOKEN_OLD_THRESHOLD" type="text" id="CRON_CLEAR_LANE_TOKEN_OLD_THRESHOLD" value="{CONF.CRON_CLEAR_LANE_TOKEN_OLD_THRESHOLD}" size="40" />
      </label></td>
      <td>seconds</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Optimize database tables:</strong></td>
      <td>&nbsp;</td>
      <td><label>
        <input type="checkbox" name="CRON_OPTIMIZE_DATABASE" value="1" {ck.CRON_OPTIMIZE_DATABASE}/>
        Optimize database</label>      </td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Optimize database tables once every:</strong></td>
      <td>&nbsp;</td>
      <td><input name="CRON_OPTIMIZE_DATABASE_DELAY" type="text" id="CRON_OPTIMIZE_DATABASE_DELAY" value="{CONF.CRON_OPTIMIZE_DATABASE_DELAY}" size="40" /></td>
      <td>seconds</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Backup system configurations: </strong></td>
      <td>&nbsp;</td>
      <td><label>
        <input type="checkbox" name="CRON_BACKUP_CONFIGURATIONS" value="1" {ck.CRON_BACKUP_CONFIGURATIONS}/>
        Perform system config backup</label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Backup system configurations once every: </strong></td>
      <td>&nbsp;</td>
      <td><input name="CRON_BACKUP_CONFIGURATIONS_DELAY" type="text" id="CRON_BACKUP_CONFIGURATIONS_DELAY" value="{CONF.CRON_BACKUP_CONFIGURATIONS_DELAY}" size="40" /></td>
      <td>seconds</td>
    </tr>
    <tr>
      <td><strong>Backup as: </strong></td>
      <td>&nbsp;</td>
      <td><input name="CRON_BACKUP_CONFIG_FILE" type="text" id="CRON_BACKUP_CONFIG_FILE" value="{CONF.CRON_BACKUP_CONFIG_FILE}" size="40" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Update users ages values: </strong></td>
      <td>&nbsp;</td>
      <td><label>
        <input type="checkbox" name="CRON_UPDATE_AGE_VALUE" value="1" {ck.CRON_UPDATE_AGE_VALUE}/>
        Update ages</label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Update ages once every: </strong></td>
      <td>&nbsp;</td>
      <td><input name="CRON_UPDATE_AGE_VALUE_DELAY" type="text" id="CRON_UPDATE_AGE_VALUE_DELAY" value="{CONF.CRON_UPDATE_AGE_VALUE_DELAY}" size="40" /></td>
      <td>seconds</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Update GeoData values: </strong></td>
      <td>&nbsp;</td>
      <td><label>
        <input type="checkbox" name="CRON_UPDATE_GEODATA" value="1" {ck.CRON_UPDATE_GEODATA}/>
        Run GeoLoc</label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Update GeoData values once every:</strong></td>
      <td>&nbsp;</td>
      <td><input name="CRON_UPDATE_GEODATA_DELAY" type="text" id="CRON_UPDATE_GEODATA_DELAY" value="{CONF.CRON_UPDATE_GEODATA_DELAY}" size="40" /></td>
      <td>seconds</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Cron logfile: </strong></td>
      <td>&nbsp;</td>
      <td><input name="CRON_LOGFILE" type="text" id="CRON_LOGFILE" value="{CONF.CRON_LOGFILE}" size="40" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Backup database: </strong></td>
      <td>&nbsp;</td>
      <td><label>
        <input type="checkbox" name="CRON_DATABASE_BACKUP" value="1" {ck.CRON_DATABASE_BACKUP}/>
        Perform database backups</label></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><strong>Database backup method: </strong></td>
      <td>&nbsp;</td>
      <td><label>
        <input type="checkbox" name="CRON_DATABASE_BACKUP_METHOD:PHP" value="1" {ck.cron_database_backup_method:php}/>
        PHP</label></td>
      <td>* False: Server-side </td>
    </tr>
    <tr>
      <td><strong>Database backup file: </strong></td>
      <td>&nbsp;</td>
      <td><input name="CRON_DATABASE_BACKUP_FILE" type="text" id="CRON_DATABASE_BACKUP_FILE" value="{CONF.CRON_DATABASE_BACKUP_FILE}" size="40" /></td>
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
