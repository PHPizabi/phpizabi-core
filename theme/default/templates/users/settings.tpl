<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
<!-- leftpane -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><h1>[My Settings {8415}] </h1>
                [Here at {siteName}, we wish to  make your experience the best that it can be.&nbsp;  Please look through the following options and select the preferences  that are appropriate for you. {8420}] <br />
                  <br />
                  <!-- breadcrumbs --><a href="?L=users.desktop">[My Desktop {790}] </a> | <a href="?L=users.myself">[Myself {795}]</a><!-- /breadcrumbs --></td>
              <td align="right" valign="top"><img src="theme/default/images/icons/headers/settings.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
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
<h2>[Notifications {8425}] </h2>
      <form method="post">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><strong>[Notify me ... {8430}] </strong></td>
                <td colspan="2"><strong>[Send notification to... {8435}]</strong> </td>
                </tr>
              <tr>
                <td>[when I receive a new message {8440}] </td>
                <td><label>
                  <input name="notify_mail[]" type="checkbox" id="notify_mail[]" value="message" {no.ma.ck.message} />
                  [Mail {8445}]</label></td>
                <td><label>
                <input name="notify_sms[]" type="checkbox" id="notify_sms[]" value="message" {no.sms.ck.message} />
                [Mobile {8450}] (sms) 
                </label></td>
              </tr>
              <tr>
                <td>[when an event is about to start {8455}] </td>
                <td><input name="notify_mail[]" type="checkbox" id="notify_mail[]" value="event" {no.ma.ck.event} />
[Mail {8445}]</td>
                <td><input name="notify_sms[]" type="checkbox" id="notify_sms[]" value="event" {no.sms.ck.event} />
[Mobile (sms) {8460}] </td>
              </tr>
              <tr>
                <td>[about my contacts birthday {8465}] </td>
                <td><input name="notify_mail[]" type="checkbox" id="notify_mail[]" value="birthday" {no.ma.ck.birthday} />
[Mail {8445}]</td>
                <td><input name="notify_sms[]" type="checkbox" id="notify_sms[]" value="birthday" {no.sms.ck.birthday} />
[Mobile (sms) {8460}] </td>
              </tr>
              <tr>
                <td>[when I receive a  profile comment {8470}] </td>
                <td><input name="notify_mail[]" type="checkbox" id="notify_mail[]" value="comment" {no.ma.ck.comment} />
[Mail {8445}]</td>
                <td><input name="notify_sms[]" type="checkbox" id="notify_sms[]" value="comment" {no.sms.ck.comment} />
[Mobile (sms) {8460}] </td>
              </tr>
              <tr>
                <td>[when I receive a contact request {8475}] </td>
                <td><input name="notify_mail[]" type="checkbox" id="notify_mail[]" value="request" {no.ma.ck.request} />
[Mail {8445}]</td>
                <td><input name="notify_sms[]" type="checkbox" id="notify_sms[]" value="request" {no.sms.ck.request} />
[Mobile (sms) {8460}] </td>
              </tr>
              <tr>
                <td>[when I receive a nudge {8480}] </td>
                <td><input name="notify_mail[]" type="checkbox" id="notify_mail[]" value="nudge" {no.ma.ck.nudge} />
[Mail {8445}]</td>
                <td><input name="notify_sms[]" type="checkbox" id="notify_sms[]" value="nudge" {no.sms.ck.nudge} />
[Mobile (sms) {8460}] </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input type="submit" name="SubmitNotifications" value="Save" class="submit" /></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table>
			</form>
            <p>&nbsp;</p>
          </div>
          <div class="tabbertab">
            <h2>[Mobile {8485}] </h2>
                        [Did you know that you can access your account and receive notifications and messages with your mobile device? If your cellular phone or PDA has an SMS address or an internet access, you can configure your mobile preferences to route selected information to it. {8490}]<br />
            <br />
			<form method="post">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>[My SMS address: {8495}]</td>
                <td>&nbsp;</td>
                <td><input name="sms_address" type="text" id="sms_address" value="{sms_address}" />
            <br /></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4"><p>
                  <label>
                  <input type="checkbox" name="sms_trustcontacts" value="1" {mob.ck.trustcontacts} />
                  [Let my contacts send SMS messages to me {8500}] </label>
                  <br />
                  <label>
                  <input type="checkbox" name="sms_excludeonline" value="1" {mob.ck.excludeonline} />
[Don't send me SMS messages while I am online {8505}]</label>
                  <br />
                  <br />
                  </p>                </td>
              </tr>
              <tr>
                <td colspan="4"><input type="submit" name="SubmitMobile" value="Save" class="submit" /></td>
              </tr>
            </table>
			</form>
          </div>
		  <div class="tabbertab">
			<h2>Display Settings</h2>
			<form method="post">
			<table width="100%" border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td><strong>Site style: </strong></td>
                <td width="10">&nbsp;</td>
                <td>
				<select name="theme" id="theme">
				<loop themes>
				<option value="{theme}" {select}>{theme}</option>
				</loop themes>
                </select>				</td>
              </tr>
              <tr>
                <td><strong>Language:</strong></td>
                <td>&nbsp;</td>
                <td><select name="language" id="language">
                  <loop languages>
                    <option value="{language}">{language}</option>
                  </loop languages>
                </select></td>
              </tr>
              <tr>
                <td><strong>Random members gender: </strong></td>
                <td>&nbsp;</td>
                <td><select name="random_gender" id="random_gender">
                  <option value="">Any</option>
                  <loop genders>
                    <option value="{g.gender}" {g.select}>{g.gender}</option>
                  </loop genders>
                                </select></td>
              </tr>
              <tr>
                <td colspan="3"><input name="SubmitDisplay" type="submit" class="submit" id="SubmitDisplay" value="Save" /></td>
                </tr>
            </table>
			</form>
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
    </table><!-- /leftpane -->

	</td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[Did you know? {8510}] </h1>          
          [Did you know that you can edit  your profile information such as: quote, header, geographic location,  questionnaires, and even your password?&nbsp;  Visit the <a href="?L=users.myself">Myself</a> page to view these options! {8515}]</td>
        <td width="25">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->