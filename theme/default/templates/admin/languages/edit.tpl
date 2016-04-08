<h2>Edit Dictionary File</h2>
<br />
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Language file:</strong> {language} </td>
    <td align="right"><a href="?L=admin.languages.raw&id={language}">Raw Edit</a> </td>
  </tr>
</table>
<br />

<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <LOOP langEdit>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Id:</strong> {string.id} 
    <strong>At</strong>: {string.location}</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Editing {string.newlang}:<br>
    <textarea name="string[{string.id}]" cols="50" rows="3" id="string_{string.id}">{string.langBody}</textarea></td>
    <td>English sample:<br>
      <textarea name="NULL" cols="50" rows="3" id="NULL" onKeyPress="void(0); return false;">{string.mapBody}</textarea></td>
  </tr>
  <tr>
    <td height="1" colspan="2" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP langEdit>
  <tr>
    <td height="30" colspan="2" bgcolor="#CCCCCC" style="padding-left:8px;"><input type="submit" name="Submit" value="Submit"></td>
  </tr>
</table>
</form>