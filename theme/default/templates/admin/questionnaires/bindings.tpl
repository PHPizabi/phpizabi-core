<h2>Registration Questionnaires Bindings</h2>
<p>&nbsp;</p>

<p><strong>Bind those questionnaires to registration (step2): </strong><br>
  <br>
</p>
<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <LOOP questionnaires>
  <tr>
    <td width="25"><input type="checkbox" name="ck[]" value="{q.file}" id="{q.file}" {q.check}></td>
    <td><label for="{q.file}">{q.name}</label></td>
    <td>{q.size} Kb </td>
    <td><a href="?L=admin.raw.decompile&file=questionnaires/{q.file}">Raw Decompile</a> </td>
    <td><a href="?L=admin.questionnaires.bindings&rm={q.file}">Delete</a></td>
  </tr>
  <tr>
    <td height="1" colspan="5" bgcolor="#CCCCCC" style="padding-left:8px;"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP questionnaires>
  <tr>
    <td height="30" colspan="5" bgcolor="#CCCCCC" style="padding-left:8px;"><input type="submit" name="Submit" value="Submit"></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
