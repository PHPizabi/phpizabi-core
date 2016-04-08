<!-- header --><!-- /header -->
<ZONE contactsPage enabled>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
      <!-- leftpane --><table width="100%" border="0" cellspacing="0" cellpadding="0"><!-- /leftpane -->
        <tr>
          <td width="25">&nbsp;</td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><h1>[My Contacts {345}] </h1>
                  <p>[The My Contacts section offers more then a list of  people you want a shortcut for.&nbsp;  Performing a shared connection, or relationship, between you and  another member allows both of you to access each other's private pictures,  notifications, SMS, and much more. {5065}]</p>
                  <p>&nbsp;</p>
                <h6>[You have {g.contacts} contact(s) in {g.groups} group(s) {5070}] </h6><!-- breadcrumbs -->
<!-- /breadcrumbs --></td>
              <td width="20" valign="top">&nbsp;</td>
              <td valign="top"><br />
                  <img src="theme/default/images/icons/headers/contacts.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
            </tr>
          </table></td>
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
		  <div id="contactInjectObject"><strong>[Please pick a contact from the list on the right {5075}]</strong>
		  
		    <ZONE contactEntityBlock enabled>
		      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><h2>{user.username}<br />
                        <img src="system/image.php?file={user.mainpicture}&amp;width=470" alt="[Picture {150}]" name="picture" border="0" id="picture" /></h2></td>
                  </tr>
                <tr>
                  <td><h4><br />
                     {user.header}  </h4>
                    <h6>{user.quote}</h6>
                    <p>&nbsp;</p>
                    <p><strong>{user.username}</strong>, {user.gender}, [{user.age} years old {5080}]<br />
                      <strong>[Location: {5085}]</strong> {user.location}<br />
                      <strong>[In group: {5090}]</strong> {user.group} <br />
                      <br />
                      [View {user.username}'s ... {5095}] <a href="?L=users.profile&amp;id={user.id}">[profile {355}]</a>, <a href="?L=blogs.blog&amp;id={user.id}">[blog {360}]</a>, <a href="?L=pictures.gallery&amp;id={user.id}">[gallery {365}]</a>, <a href="?L=comments.usercomments&amp;id={user.id}">[comments {370}]</a> <br />
                      [Send {user.username} a ... {6000}] <a href="?L=mails.write&amp;to={user.username}">[message {375}]</a>,  <a href="?L=interact.page&amp;id={user.id}">[page {380}]</a>,  <a href="?L=interact.file&amp;id={user.id}">[file {385}]</a><br />  
                      <br />
                      <select name="select" onchange="ajFetch('?L=contacts.contacts&chromeless=1&id={user.id}&move='+this.value, 'contactInjectObject', 0, false);">
					    <option>Move to group ...</option>
						<LOOP moveToList>
						  <option value="{group.name}">{group.name}</option>
						</LOOP moveToList>
                      </select>
                      | <a href="?L=contacts.block&amp;id={user.id}">[Block {390}]</a> | <a href="?L=contacts.remove&amp;id={user.id}">[Delete from contacts {395}]                      </a><br />
                      {group.swapMessage}
					  <OBJ groupSwapMessageSaved>[Group change saved successfully! {6005}]</OBJ groupSwapMessageSaved>
					  <br />
                    </p></td>
                  </tr>
              </table>
			</ZONE contactEntityBlock enabled>
		  </div>
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
          <td><h1>[Manage Contacts Groups {6010}] </h1></td>
        </tr>
        <tr>
          <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
          <td height="5" background="{themePath}/images/frame/greenbar.gif" bgcolor="#C0FF5E"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
		        <ZONE groupsControl enabled>
		          <h2>[Manage Groups {6015}]</h2>
		            <table width="100%" border="0" cellspacing="0" cellpadding="0">
		              <LOOP groupsControlList>
		                <tr>
		                  <td>{groupControl.groupName}</td>
                          <td><a href="?L=contacts.contacts&rmgroup={groupControl.groupNameEncode}">[Delete {10}]</a></td>
                        </tr>
		              </LOOP groupsControlList>
		            </table>
	              </ZONE groupsControl enabled>
			    </td>
              <td>
                <h2>[Create Groups {6050}] </h2>
                <form method="post">
                  <table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td>[Name: {400}]</td>
                      <td><input name="groupName" type="text" id="groupName" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="addGroup" type="submit" id="addGroup" value="[Submit {295}]" class="submit"></td>
                    </tr>
                  </table>
                </form>	
			  </td>
            </tr>
          </table></td>
        </tr>
      </table>
    </td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <ZONE contactRequestsBlock enabled>
		    <h2>[New Requests {6020}] </h2>
            <p>[The following users added you to their contacts lists, would you like to add them to yours? {6025}] </p>
            <p>&nbsp;</p>
            <LOOP contactRequests>
		      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="60" valign="top">
				    <a href="?L=users.profile&amp;id={notification.id}">
					  <img src="system/image.php?file={notification.mainpicture}&width=50" alt="[Picture {150}]" border="0" id="picture" />					</a>
					<br />
                  <a href="?L=users.profile&amp;id={notification.id}">{notification.username}</a>				  </td>
                  <td valign="top">
			        <p>{notification.header}</p>
			        <p>[{notification.gender}, {notification.age} years old {410}] </p>
			        <p>
					  <a href="?L=contacts.adduser&id={notification.id}">[Add {415}]</a> | 
					  <a href="?L=contacts.block&amp;id={notification.id}">[Block {390}]</a> | 
					  <a href="?L=contacts.contacts&amp;dismiss={notification.id}">[Dismiss {420}]</a>					</p>				  </td>
                </tr>
                <tr>
                  <td height="1" colspan="2" valign="top" bgcolor="#A7B7FF">
				    <img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" />				  </td>
                </tr>
                <tr>
                <td height="8" colspan="2" valign="top">
				  <img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" />				</td>
              </tr>
            </table>
            <p>&nbsp;</p>
		    </LOOP contactRequests>
		  </ZONE contactRequestsBlock enabled>		</td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><h2>[My Contacts {345}] </h2></td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td>
		<ZONE contactsListBlock enabled>
		<LOOP contactsList>
          <div style="clear:both; padding-bottom:4px; padding-top:3px; border-bottom: solid 1px #E5E9EC; height:28px; cursor:pointer;" onclick="ajFetch('?L=contacts.contacts&chromeless=1&id={list.id}', 'contactInjectObject', 0, false);">
		    <a href="javascript:ajFetch('?L=contacts.contacts&chromeless=1&id={list.id}', 'contactInjectObject', 0, false);"><img src="system/image.php?file={list.mainpicture}&width=30" hspace="2" border="0" id="picture" align="left" /></a>
			<a href="javascript:ajFetch('?L=contacts.contacts&chromeless=1&id={list.id}', 'contactInjectObject', 0, false);">{list.username}</a>[, {list.gender}, {list.age}y {list.online} {6040}] <h5>[In group {list.group} {6045}]</h5>
		  </div>
		</LOOP contactsList>
        </ZONE contactsListBlock enabled>
		<OBJ online><strong>[Online {425}]</strong></OBJ online>
		<OBJ offline></OBJ offline>		</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
</ZONE contactsPage enabled>
<!-- footer --><!-- /footer -->
<ZONE contactsPage guest>
[Sorry guests can't access this page. {405}]
</ZONE contactsPage guest>
