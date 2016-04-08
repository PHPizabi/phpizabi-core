<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
	<!-- leftpane --><ZONE uploadPicture enabled>
	<form enctype="multipart/form-data" method="post" action="">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top">
				  <ZONE uploadHeader enabled>
				  <h1>[Upload Pictures {645}] </h1>
                    [Take some  time to post a few photos to share with {siteName} members.&nbsp; You may make a photograph public for the  world to see or private for a select few.&nbsp;  Let people see what your world is like! {7420}]
                    <p><a href="?L=pictures.gallery&id={me.id}">[My Gallery {7425}]</a> | <a href="?L=users.desktop">[My desktop {320}] </a></p>
				  </ZONE uploadHeader enabled>
				  
				  <ZONE uploadHeader success>
				    <h1>[Successful! {155}]</h1>                    
                    <p>Your picture has been added successfully. Would you like to upload more pictures?</p>
					<p><a href="?L=pictures.gallery&id={me.id}">[My Gallery {7425}]</a> | <a href="?L=users.desktop">[My desktop {320}] </a></p>
				  </ZONE uploadHeader success>
				  
				  <ZONE uploadHeader noFile>
				    <h1>[Can not save picture {7430}] </h1>                    
                    <p>[Sorry, the file field appeared to be empty, you have to fill the FILE form field. {7435}] </p>
				  </ZONE uploadHeader noFile>
				  
				  <ZONE uploadHeader unallowedExtension>
				    <h1>[Can not save picture {7430}] </h1>                    
                    <p>[Sorry, the file type you sent is not supported by this website. {7440}] </p>
				  </ZONE uploadHeader unallowedExtension><!-- breadcrumbs -->
<!-- /breadcrumbs --></td>
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
		    <h1>[Your picture... {7445}] </h1> 		</td>
      </tr>
      <tr>
        <td height="6" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:25px;"><table border="0" cellspacing="2" cellpadding="0">
            <tr>
              <td valign="top"><strong>[Add into {7450}]</strong></td>
              <td valign="top">
                <ZONE contactsListDropdown enabled></ZONE contactsListDropdown enabled></td>
              <td valign="top"><p>[...an existing group: {7455}]<br />
                <select name="grouplist" id="grouplist">
                    <option value="">[Please Select a Group... {7460}]</option>
                    <option>[Generic Gallery {7465}]</option>
                    <ZONE groupsDropdownField enabled>
					<LOOP groupsDropdownOptions>
                      <option value="{group.name}">{group.name}</option>
                    </LOOP groupsDropdownOptions>
                    </ZONE groupsDropdownField enabled>
                    </select>
                </p>
                <p>[...a new group: {7470}]<br />
                  <input name="grouptext" type="text" id="grouptext" />
                  </p></td>
            </tr>
          </table>          </td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:25px;"><strong>[File: {7475}]</strong><br />
            <input type="file" name="file" id="file" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:25px;">
		<strong>[Picture title: {7480}]</strong><br />
		<input name="title" type="text" class="fullwidth" id="title" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:25px;"><strong>[Picture description: {7485}]</strong> <br />
          <textarea name="description" rows="20" class="fullwidth" id="description"></textarea></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:25px;">
		<label><input type="checkbox" name="private" value="1" id="private" /> [Make this picture private {7490}]</label>		</td>
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
	</ZONE uploadPicture enabled><!-- /leftpane -->
	<ZONE uploadPicture guest>
	[Sorry, guests can not upload pictures. {7495}]<a href="registration.register">[Register {50}]</a>
	</ZONe uploadPicture guest>
	</td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table><!-- footer --><!-- /footer -->