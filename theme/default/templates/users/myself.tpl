<zone main enabled>
<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
	<!-- leftpane --><form method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><h1>[Myself {8080}] </h1>
                [Take a moment to share additional  information about yourself by completing the following sections.&nbsp; Let people know who you are, your likes and  dislikes, and let everyone experience a little of your world today! {8085}] <br />
                  <br />
                  <!-- breadcrumbs --><a href="?L=users.desktop">[My Desktop {320}] </a> | <a href="?L=users.settings">[My Settings {8090}]</a><!-- /breadcrumbs --></td>
              <td align="right" valign="top"><img src="theme/default/images/icons/headers/myself.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td colspan="2" bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td height="6" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF"><div class="tabber">
          <div class="tabbertab">
            <h2>[Your User Data {8095}] </h2>
            <p>[Your personal user data .... {8100}] </p>
            <table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td><strong>[Quote: {8105}] </strong></td>
                <td><input name="quote" type="text" id="quote" value="{me.quote}" class="fullwidth" maxlength="50" /></td>
              </tr>
              <tr>
                <td valign="top"><strong>[Header: {8110}] </strong></td>
                <td><textarea name="header" class="fullwidth" rows="5" id="header">{me.header}</textarea></td>
              </tr>

              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><strong>[City: {715}] </strong></td>
                <td><input name="city" type="text" id="city2" value="{me.city}" class="fullwidth" maxlength="50" /></td>
              </tr>
              <tr>
                <td><strong>[State: {720}] </strong></td>
                <td><input name="state" type="text" id="state2" value="{me.state}" class="fullwidth" maxlength="50" /></td>
              </tr>
              <tr>
                <td><strong>[Country: {725}] </strong></td>
                <td><input name="country" type="text" id="country2" value="{me.country}" class="fullwidth" maxlength="50" /></td>
              </tr>
              <tr>
                <td><strong>[Zipcode: {727}] </strong></td>
                <td><input name="zipcode" type="text" id="zipcode2" value="{me.zipcode}" class="fullwidth" maxlength="50" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submitUserData" value="[Submit {295}]" class="submit" /></td>
              </tr>
            </table>
            <p>&nbsp;</p>
          </div>
          <div class="tabbertab">
            <h2>[Add to your profile {8115}]</h2>
            <p>[Those are some questionaires you may want to fill to add more data to your profile. {8120}]</p>
            <br />
            <LOOP questionaires>{filled} <a href="?L=questionaire.fill&amp;id={id}">{questionaire}</a> <br/>
            </LOOP questionaires>
            <OBJ filled><img src="theme/default/images/icons/checkbox.gif" alt="[Checked {8125}]" /></OBJ filled>
            <OBJ unfilled><img src="theme/default/images/frame/spacer.gif" width="12" /></OBJ unfilled>
          </div>
          <div class="tabbertab">
            <h2>[Password {8130}] </h2>
            <p>[Change your password! {8135}] </p>
            <ZONE passChangeMessage success>[Your password has been updated successfully {8140}]</ZONE passChangeMessage success>
            <ZONE passChangeMessage noMatch>[The new password you created does not match the password confirmation value required {8145}]</ZONE passChangeMessage noMatch>
            <ZONE passChangeMessage badFormat>[Your password was not formatted correctly. Please do not use spaces {8150}]</ZONE passChangeMessage badFormat>
            <ZONE passChangeMessage tooShort>[Your password is to short {8155}]</ZONE passChangeMessage tooShort>
            <ZONE passChangeMessage wrongPass>[The &quot;actual&quot; password you entered is incorrect. Please try again {8160}]</ZONE passChangeMessage wrongPass>
            <table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td>[Actual password: {8165}] </td>
                <td><input name="actualPassword" type="password" id="actualPassword" /></td>
              </tr>
              <tr>
                <td>[New password: {8170}] </td>
                <td><input name="newPassword" type="password" id="newPassword" /></td>
              </tr>
              <tr>
                <td>[Confirm new password: {8180}] </td>
                <td><input name="confirmPassword" type="password" id="confirmPassword" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input name="changePassword" type="submit" id="changePassword" value="[Submit {295}]" /></td>
              </tr>
            </table>
          </div>
        </div></td>
        <td bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td height="2" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
    </table>
	<br />
	<br />
	</form><!-- /leftpane -->
	</td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[Did you know? {8185}] </h1>
          [Many settings such as mobile  preferences, what to show on your desktop, and your notification behaviors can  by found by visiting the <a href="?L=users.settings">My Settings</a> page. {8190}] </td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->
</zone main enabled>
<zone main guest>
Sorry guests can't access this page
</zone main guest>