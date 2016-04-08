<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><h1>[Remove user {user.username} {8520}] </h1></td>
  </tr>
  <tr>
    <td colspan="3"><!-- breadcrumbs -->
<!-- /breadcrumbs -->&nbsp;</td>
  </tr>
  <tr>
    <td width="250" valign="top"><br>
      <br></td><td width="10">&nbsp;</td>
    <td valign="top">
	<ZONE remove nouser>
	[No user has been specified. {8525}]	</ZONE remove nouser>
	
	<ZONE remove question>
	<p>[You are about to remove a user from your contacts list. Would you like to proceed? {8530}]</p>
      <form method="post">
        <input name="remove" type="submit" id="remove" value="[Yes {1}]">
        <input name="noremove" type="submit" id="noremove" value="[No {340}]">
      </form>
	</ZONE remove question>
	
	<ZONE remove removed>
	[User has been removed {8535}]	</ZONE remove removed>    </td>
  </tr>
</table>
<!-- footer --><!-- /footer -->