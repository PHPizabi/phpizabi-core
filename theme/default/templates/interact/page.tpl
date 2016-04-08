<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top"><!-- leftpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td>
		  <h1>[Page {user.username} {6820}] </h1>
          <p> [Would you like to send a quick message to another user?  If so, type in your short message below, click submit, and your message will be delivered immediately. Keep it short. {6825}] </p>
          <p>&nbsp;</p>
          <p><!-- breadcrumbs --><a href="?L=users.profile&id={user.id}">[{user.username}'s profile {115}]</a><!-- /breadcrumbs --></p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF">
		<ZONE page enabled>
		<h2>[Your message {6830}] </h2>
        <form method="post">
		<table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td>[Type your message: {6835}] </td>
            <td><input name="body" type="text" id="body" size="40" maxlength="80"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" class="submit" value="[Send {585}]"></td>
          </tr>
        </table>
		</form>
		</ZONE page enabled>

        <ZONE page success>
		<h2>[Success! {315}] </h2>
		<p>[Your page has successfully been sent! {6840}] </p>
        </ZONE page success>
		
		<ZONE page floodControl>
		<h2>[OoPs! {590}] </h2>
        <p>[Please wait for some time before paging again. {6845}] </p>
		</ZONE page floodControl>
		
		<ZONE page mobileNotAllowed>
		<h2>[OoPs! {590}] </h2>
        <p>[User is offline and does not want to receive page through his/her mobile device {6850}] </p>
		</ZONE page mobileNotAllowed>
		
		<ZONE page noMobile>
		<h2>[OoPs! {590}] </h2>
        <p>[User is offline and does not have a mobile device configured {6855}]</p>
		</ZONE page noMobile>
				
		</td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table><!-- footer --><!-- /footer -->