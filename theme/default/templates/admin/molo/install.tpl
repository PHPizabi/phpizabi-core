<zone install preinstall>
<form method="post">
<table width="100%" border="0" cellpadding="0" cellspacing="3">
  <tr>
    <td width="50%" valign="top"><h2>Installation Information </h2>
      <table width="100%" border="0" cellpadding="0" cellspacing="3">
      <tr>
        <td><strong>Installation Mode: </strong></td>
        <td><strong>{install.mode}</strong></td>
      </tr>
      <tr>
        <td><strong>Select the theme to affect:</strong></td>
        <td><select name="theme" id="theme">
          <loop themes>
            <option value="{theme}">{theme}</option>
          </loop themes>
        </select></td>
      </tr>

      <tr>
        <td valign="top"><strong>Execute those instructions:</strong> </td>
        <td valign="top" nowrap><label>
          <input name="run[]" type="checkbox" id="run[]" value="tpl" checked>
Template Updates </label>
          <br />
          <label>
          <input name="run[]" type="checkbox" id="run[]" value="conf" checked>
Configuration Updates </label>
          <br />
          <label>
          <input name="run[]" type="checkbox" id="run[]" value="map" checked>
Languages Map Updates </label>
          <br />
          <label>
          <input name="run[]" type="checkbox" id="run[]" value="db" checked>
Database Updates </label>
          <br />
          <label>
          <input name="run[]" type="checkbox" id="run[]" value="io" checked>
File System Updates </label></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><label></label></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><input name="Install" type="submit" id="Install" value="Run Install"></td>
      </tr>
    </table></td>
    <td width="10" valign="top">&nbsp;</td>
    <td width="50%" valign="top"><h2>Module Details </h2>
      <table width="100%" border="0" cellpadding="0" cellspacing="3">
      <tr>
        <td><strong>Module Name: </strong></td>
        <td width="10">&nbsp;</td>
        <td>{molo.name}</td>
      </tr>
      <tr>
        <td><strong>Version:</strong></td>
        <td>&nbsp;</td>
        <td>{molo.version}</td>
      </tr>
      <tr>
        <td><strong>Compiled Identifier: </strong></td>
        <td>&nbsp;</td>
        <td>{molo.id}</td>
      </tr>
      <tr>
        <td><strong>Author:</strong></td>
        <td>&nbsp;</td>
        <td>{molo.author}</td>
      </tr>
      <tr>
        <td><strong>Support information: </strong></td>
        <td>&nbsp;</td>
        <td>{molo.support}</td>
      </tr>
      <tr>
        <td><strong>URL:</strong></td>
        <td>&nbsp;</td>
        <td><a href="{molo.url}" target="_blank">{molo.url}</a></td>
      </tr>
      <tr>
        <td><strong>MoLo File: </strong></td>
        <td>&nbsp;</td>
        <td>{molo.file}</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p><a href="?L=admin.molo.details&f={molo.file}">More details</a></p></td>
  </tr>
</table>
</form>
</zone install preinstall>

<zone install installLog>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><h2>Installation Results </h2></td>
  </tr>
  <tr>
    <td height="500" valign="top"><strong>Installation log:</strong> <br>
      {install.log}</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Total errors encountered:</strong> {install.errorCount}</td>
  </tr>
</table>
</zone install installLog>