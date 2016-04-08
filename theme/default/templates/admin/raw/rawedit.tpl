<h2>Edit Raw Data</h2>
<p>&nbsp;</p>

<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Field</strong></td>
    <td colspan="2"><strong>Data</strong></td>
  </tr>
  <LOOP rawRow>
  <tr>
    <td>{var}</td>
    <td><input name="{var}" type="text" value="{val}" size="70"></td>
    <td>{decompile}<OBJ decompile><a href="?L=admin.raw.decompile&amp;arr={enc}">Decompile</a></OBJ decompile></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
    </tr>
  </LOOP rawRow>
  <tr>
    <td height="30" colspan="3" bgcolor="#CCCCCC" style="padding-left:5px;"><input type="submit" name="Submit" value="Save Changes"></td>
  </tr>
</table>
</form>