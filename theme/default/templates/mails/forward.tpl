<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top"><!-- leftpane -->
	<ZONE sendMailForm enabled>
	<form method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top">
				  <ZONE sendMailHeader enabled>
				  <h1>[Forward mail {6905}] </h1>
                    <p>[Forward .. {6910}]. </p>
				  </ZONE sendMailHeader enabled>
				  
				  <ZONE sendMailHeader success>
				    <h1>[Successful! {155}] </h1>                    
                    <p>[Your mail has been delivered successfully {6915}] </p>
                    <p><a href="?L=mails.mails">[Go to my inbox {6920}]</a> | <a href="?L=users.desktop">[Go to my desktop {6925}] </a></p>
				  </ZONE sendMailHeader success>
				  
				  <ZONE sendMailHeader blocked>
				    <h1>[Can not send mail {6930}] </h1>                    
                    <p>[Sorry there has been an error trying to send your mail. The user's mailbox may be full. Please try again later. {6935}] </p>
				  </ZONE sendMailHeader blocked>

				  <ZONE sendMailHeader quota>
				    <h1>[Can not send mail {6930}] </h1>                    
                    <p>[Sorry there has been an error trying to send your mail. The user's mailbox may be full. Please try again later. {6935}] </p>
				  </ZONE sendMailHeader quota>
				  
				  <ZONE sendMailHeader emptyField>
				    <h1>[Can not send mail {6930}] </h1>                    
                    <p>[Either one or both the subject and/or body field where empty. Please fill in the form entirely. {6940}] </p>
				  </ZONE sendMailHeader emptyField>
				  
				  <ZONE sendMailHeader noUserSpecified>
				    <h1>[Can not send mail {6930}] </h1>                    
                    <p>[No username was specified {6945}] </p>
				  </ZONE sendMailHeader noUserSpecified><ZONE sendMailHeader noSuchUser>
				    <h1>[Can not send mail {6930}] </h1>                    
                    <p>[The username you specified is not valid {6950}]</p>
				  </ZONE sendMailHeader noSuchUser>	<ZONE sendMailHeader floodControl>
				    <h1>[Flood Control {6955}] </h1>
					<p>[Sorry, your host is sending massive mails. Please wait a couple minutes before resending your mail {6960}]</p>
				  </ZONE sendMailHeader floodControl>	<!-- breadcrumbs --><!-- /breadcrumbs --></td>
                </tr>
              </table>          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF">
		    <h1>[Forward mail {6905}] </h1> 		</td>
      </tr>
      <tr>
        <td height="6" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:25px;"><strong>[Send to... {6965}]</strong>
          <table border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td width="5">&nbsp;</td>
              <td>[Send to a contact: {6970}] </td>
              <td colspan="3">
                <ZONE contactsListDropdown enabled>
				<select name="contact" id="contact">
                  <option value="">Please Select a Contact...</option>
                  <LOOP contactsListDropdownOptions>
                    <option value="{contact.username}">{contact.username}</option>
                  </LOOP contactsListDropdownOptions>
                </select>
				</ZONE contactsListDropdown enabled>
				
				<ZONE contactsListDropdown noContact>
				[Sorry you don't have any contact set yet {6975}] </ZONE contactsListDropdown noContact>
				</td>
            </tr>

            <tr>
              <td width="5">&nbsp;</td>
              <td>[Send to a user: {6980}] </td>
              <td>
                <input name="username" type="text" id="username" value="{post.username}" />              </td>
              <td>&nbsp;</td>
              <td>
			  <ZONE usernameSuggest enabled>
				[Did you mean {6985}] 
				<a href="javascript:document.getElementById('username').value='{usernameSuggest.username}'; void(0);">
				{usernameSuggest.username}</a>?
			  </ZONE usernameSuggest enabled>
			  </td>
            </tr>
          </table>
          </td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:25px;">
		<strong>[Subject: {595}]</strong>  <br />
		<input name="subject" type="text" class="fullwidth" value="{post.subject}" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:25px;">
        <textarea name="body" class="fullwidth" rows="20">{post.body}</textarea></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:25px;"><input name="Submit" type="submit" id="Submit" value="[Submit {295}]" class="submit" /></td>
      </tr>
      <tr>
        <td height="10" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
      </tr>
      <tr>
        <td height="2" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td colspan="2"><br />
          <br />
          <br /></td>
      </tr>
    </table>
	</form>
	</ZONE sendMailForm enabled><!-- /leftpane -->
	<ZONE sendMailForm guest>
	[Sorry, guests can not send mails. {6990}] <a href="registration.register">[Register {305}]</a>
	</ZONe sendMailForm guest>
	</td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table>
<!-- footer --><!-- /footer -->