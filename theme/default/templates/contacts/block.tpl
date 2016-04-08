<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><h1>[Block user {user.username} {5045}] </h1></td>
  </tr>
  <tr>
    <td colspan="3" class="cell_line"><img src="[THEME_PATH]/images/spacer.gif" alt="Spacer" width="1" height="1" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><!-- breadcrumbs -->
<!-- /breadcrumbs -->&nbsp;</td>
  </tr>
  <tr>
    <td width="250" valign="top"><br>
      <br></td><td width="10">&nbsp;</td>
    <td valign="top">
	<ZONE block nouser>
	[No user has been specified.
	</ZONE block nouser>
	
	<ZONE block self>
	You can not block yourself.
	</ZONE block self>
	
	<ZONE block duplicate>
	User already blocked. {5050}]
	</ZONE block duplicate>
	
	<ZONE block question>
	<p>[You are about to block a user and  will not receive any further communications from this user.   Would you like to proceed? {5055}] </p>
      <form method="post">
        <input name="block" type="submit" id="block" value="[Yes {1}]">
        <input name="noblock" type="submit" id="noblock" value="[No {340}]">
      </form>
	  
	</ZONE block question>
	
	<ZONE block blocked>
	[User is now blocked {5060}]
	</ZONE block blocked>    </td>
  </tr>
</table>
<!-- footer --><!-- /footer -->