<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><h1>[UnBlock user {user.username} {6055}]</h1></td>
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
	<ZONE unblock nouser>
	[No user has been specified. {6060}]
	</ZONE unblock nouser>
	
	<ZONE unblock self>
	[You can not unblock yourself. {6065}]
	</ZONE unblock self>
	
	<ZONE unblock noblock>
	[User is not blocked. {6070}]
	</ZONE unblock noblock>
	
	<ZONE unblock question>
	<p>[You are about to unblock a user. If you do so, you may receive communications from this user. Would you like to proceed? {6075}]</p>
      <form method="post">
        <input name="unblock" type="submit" id="block" value="[Yes {1}]">
        <input name="cancel" type="submit" id="noblock" value="[No {340}]">
      </form>
	  
	</ZONE unblock question>
	
	<ZONE unblock unblocked>
	[User is not blocked anymore {6080}]
	</ZONE unblock unblocked>    </td>
  </tr>
</table>
<!-- footer --><!-- /footer -->