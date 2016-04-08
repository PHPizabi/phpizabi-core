<h2>Create a News Article</h2>
<p>&nbsp;</p>

<ZONE save success>
  <p><strong>News article saved with success</strong></p><br /><br />
</ZONE save success>

<ZONE save error>
  <p><strong>There has been an error trying to save your news article</strong></p><br /><br />
</ZONE save error>

<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td valign="top"><strong>Article title: </strong></td>
    <td valign="top"><input name="title" type="text" id="title" size="50"></td>
    <td valign="top">&nbsp;</td>
    <td valign="top"><strong>Show to: </strong></td>
    <td valign="top">
	  <label><input type="checkbox" name="show[]" value="g"> Guests</label> <br />
	  <label><input type="checkbox" name="show[]" value="u"> Users</label> <br />
	  <ZONE usersLevels enabled>
	  <LOOP usersLevels>
	    <label><input type="checkbox" name="show[]" value="{level.id}"> {level.title}</label> <br />
	  </LOOP usersLevels>
	  </ZONE usersLevels enabled>
	</td>
  </tr>
  <tr>
    <td colspan="5"><strong>Body:</strong></td>
  </tr>
  <tr>
    <td colspan="5"><textarea name="body" rows="20" class="fullwidth" id="body"></textarea></td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" colspan="5" bgcolor="#CCCCCC" style="padding-left:5px;"><input type="submit" name="Submit" value="Submit"></td>
  </tr>
</table>
</form>