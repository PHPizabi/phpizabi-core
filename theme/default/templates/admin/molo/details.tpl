<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" valign="top"><h2>Module Information </h2>
      <table border="0" cellpadding="0" cellspacing="3">
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
      <tr>
        <td><strong>Status:</strong></td>
        <td>&nbsp;</td>
        <td><strong>{molo.status}</strong></td>
      </tr>
      <tr>
        <td><strong>Description: </strong></td>
        <td>&nbsp;</td>
        <td><em>{molo.body}</em></td>
      </tr>
    </table></td>
    <td width="10" valign="top">&nbsp;</td>
    <td width="50%" valign="top"><h2>Module Support </h2>
      <table border="0" cellspacing="3" cellpadding="0">
        <tr>
          <td><strong>Supports Installation: </strong></td>
          <td width="10">&nbsp;</td>
          <td>{support.install}</td>
        </tr>
        <tr>
          <td><strong>Supports Uninstallation: </strong></td>
          <td>&nbsp;</td>
          <td>{support.uninstall}</td>
        </tr>
        <tr>
          <td><strong>Supports Update: </strong></td>
          <td>&nbsp;</td>
          <td>{support.update}</td>
        </tr>
      </table>      
      </td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="80" colspan="3"><strong>Perform:</strong> <a href="?L=admin.molo.install&mode=install&f={molo.file}">Install</a> | <a href="?L=admin.molo.install&mode=update&f={molo.file}">Update</a> | <a href="?L=admin.molo.install&mode=uninstall&f={molo.file}">Uninstall</a> </td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><h2>Module  Markup</h2>
      <table width="100%" border="0" cellpadding="0" cellspacing="3">
        <tr>
          <td><strong>Installation:</strong></td>
        </tr>
        <tr>
          <td><textarea name="textarea" rows="10" class="fullwidth">{molobat.install}</textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><strong>Uninstallation:</strong></td>
        </tr>
        <tr>
          <td><textarea name="textarea2" rows="10" class="fullwidth">{molobat.uninstall}</textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><strong>Update:</strong></td>
        </tr>
        <tr>
          <td><textarea name="textarea3" rows="10" class="fullwidth">{molobat.update}</textarea></td>
        </tr>
      </table></td>
  </tr>
</table>
<obj installed><span style="color:#009900;">Installed</span></obj installed>
<obj not_installed>Not Installed</obj not_installed>
<obj yes><span style="color:#009900;"><strong>Yes</strong></span></obj yes>
<obj no><span style="color:#FF0000"><strong>No</strong></span></obj no>