<p>Add a nudge</p>
<p>&nbsp;</p>
<form method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td valign="top"><strong>Nudge Title: </strong></td>
    <td width="10">&nbsp;</td>
    <td>
	  <table border="0" cellspacing="0" cellpadding="0">
      <LOOP title>
	  <tr>
        <td>{lang}: </td>
        <td><input name="title_{lang}" type="text" id="title_{lang}"></td>
      </tr>
	  </LOOP title>
    </table>	</td>
  </tr>
  <tr>
    <td valign="top"><strong>Nudge Body:<br>
    </strong>[f_name] = (from) username<br>
    [t_name] = (to) username </td>
    <td width="10">&nbsp;</td>
    <td>
	  <table border="0" cellspacing="0" cellpadding="0">
      <LOOP body>
	  <tr>
        <td>{lang}:</td>
        <td><input name="body_{lang}" type="text" id="body_{lang}" size="60"></td>
      </tr>
      </LOOP body>
    </table>	</td>
  </tr>
  <tr>
    <td valign="top"><strong>Nudge icon: </strong></td>
    <td width="10">&nbsp;</td>
    <td><input type="file" name="file"></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit"></td>
  </tr>
</table>
</form>
<p>&nbsp; </p>
