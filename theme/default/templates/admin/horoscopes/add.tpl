<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td valign="top"><strong>Horoscope data: </strong></td>
    <td>&nbsp;</td>
    <td><table border="0" cellspacing="0" cellpadding="0">
      <LOOP language>
	  <tr>
        <td valign="top">{language}:</td>
        <td><textarea name="body_{language}" cols="60" rows="8" id="body_{language}"></textarea></td>
      </tr>
	  </LOOP language>
    </table>
      </td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit" /></td>
  </tr>
</table>
</form>