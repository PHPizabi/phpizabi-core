<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
      <!-- leftpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="25">&nbsp;</td>
          <td><h1>[Add {user.username} to your contacts {4040}] </h1>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top">[Adding a user to your contacts list helps you stay in touch! You will get a shortcut to this user's profile on your desktop, get special notifications about him/her, and, if a shared connection &quot;relationship&quot; is established, you both will have a special access to each others private options! {4045}] <!-- breadcrumbs -->
<!-- /breadcrumbs --></td>
                </tr>
              </table>            </td>
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
          <td bgcolor="#DCE6FF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#DCE6FF">&nbsp;</td>
          <td bgcolor="#DCE6FF">
		  <ZONE addContact success>
		    <h1>[Success! {315}] </h1>
		    <p>[Congratulations, you successfully addded {user.username} to your contact groups! {4050}] </p>
		    <p><a href="?L=users.desktop">[My Desktop {320}]</a> | <a href="?L=users.profile&amp;id={user.id}">[{user.username}'s profile {325}] </a></p>
		  </ZONE addContact success>

		  <ZONE addContact errorBlocked>
		    <h1>[Blocked! {330}] </h1>
			<p>[Sorry you can not add somebody you blocked. You must 
			<a href="?L=contacts.unblock&id={user.id}">unblock {user.username}</a> 
			before you try adding him/her to your contacts {4055}] </p>
		  </ZONE addContact errorBlocked>
		  
		  <ZONE addContact errorAlreadyInList>
		    <h1>[Cloning?! {4060}] </h1>
			<p>[Sorry, you can not add the same user twice in your contacts list {4065}] </p>
		  </ZONE addContact errorAlreadyInList><ZONE addContact errorSelfUser>
		    <h1>[Talking to yourself? {4070}] </h1>
			<p>[Sorry, you can not add yourself to your own contacts list! {4075}] </p>
		  </ZONE addContact errorSelfUser><ZONE addContact errorNoUserID>
		    <h1>[No user specified {4080}] </h1>
			<p>[Sorry, no user ID has been specified {4085}]</p>
		  </ZONE addContact errorNoUserID> <ZONE addContact enabled>
		    <ZONE selectGroup showGroups>
	  	    <h1>[Pick a group! {4090}] </h1>
              <form method="post">
			    <table width="100%" border="0" cellspacing="3" cellpadding="0">
                  <tr>
                    <td><h6>[Select a group into which you would like to add {user.username} {4095}] </h6></td>
                  </tr>
                  <tr>
                    <td>
				    <select name="groupSelect" id="groupSelect">
				      <LOOP contactGroupsOptions>
				        <option value="{groupNameEncode}">{groupName}</option>
				      </LOOP contactGroupsOptions>
				    </select>
				    </td>
                  </tr>
                  <tr>
                    <td><input name="addToThisGroup" type="submit" id="addToThisGroup" value="[Add to group {5000}]" class="submit" /></td>
                  </tr>
                </table>
			  </form>
  	        </ZONE selectGroup showGroups>
			
			<ZONE selectGroup noGroups>
			<h1>[Please create a group {5005}]</h1>
			<p>[You do NOT have any group created yet, you have to create a group before you can add {user.username} to your contacts list. Please create a group using the group tool below. {5010}] </p>
			</ZONE selectGroup noGroups>
		  
		  
		  </ZONE addContact enabled>
          </td>
        </tr>
        <tr>
          <td height="6" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
        </tr>
        <tr>
          <td bgcolor="#DCE6FF">&nbsp;</td>
          <td bgcolor="#DCE6FF">&nbsp;</td>
        </tr>
        <tr>
          <td height="2" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
        </tr>
        <tr>
          <td colspan="2" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
        <tr>
          <td height="10" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><h1>[Create new contacts groups {5015}] </h1></td>
        </tr>
        <tr>
          <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
          <td height="5" background="{themePath}/images/frame/greenbar.gif" bgcolor="#C0FF5E"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
		  <ZONE createGroupMessage success>
		    <h2>[Success! {315}] </h2>
		    <p>[Congratulations! You successfully created a contacts group! {5020}] </p>
		  </ZONE createGroupMessage success>
		  
		  <ZONE createGroupMessage errorNoGroupValue>
		    <h2>[Error! {160}] </h2>
			<p>[Sorry, the group name you specified was blank or had invalid characters in it. Please start over. {5025}]		  
		  </p>
		  </ZONE createGroupMessage errorNoGroupValue><ZONE createGroupMessage errorGroupAlreadyExist>
		    <h2>[Error! {160}] </h2>
			<p>[Sorry, the group you wanted to create already exist in your contacts groups list {5030}] </p>
		  </ZONE createGroupMessage errorGroupAlreadyExist>
		  
            <br />
            [Would you like to create new contacts groups? {5035}] <br />
          <form method="post">
		  <table width="100%" border="0" cellspacing="3" cellpadding="0">

            <tr>
              <td>
			    <input name="group" type="text" id="group" />
		      </td>
            </tr>
            <tr>
              <td><input name="addGroup" type="submit" id="addGroup" value="[Create {335}]" class="submit" /></td>
            </tr>
          </table>
		  </form>
		  </td>
        </tr>
      </table><!-- /leftpane -->
    </td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table><!-- footer --><!-- /footer -->