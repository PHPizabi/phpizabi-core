<!-- header --><!-- /header --><ZONE mailsPage enabled>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
              <td valign="top"><h1>[My Mail {6995}] </h1>
                  <p>[You have {mailsCounter.mails} mail ({mailsCounter.newMails} new). {7000}]</p>
                  <p>&nbsp;</p><!-- breadcrumbs --><a href="?L=mails.write">[Write a new message {7005}]</a><!-- /breadcrumbs --></td>
              <td width="20" valign="top">&nbsp;</td>
              <td align="right" valign="top"><br />
                  <img src="theme/default/images/icons/headers/mail.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
            </tr>
          </table>		  </td>
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
        <td bgcolor="#DCE6FF" style="padding-right:15px;">
		    <div class="tabber">
			  <LOOP mailBoxes>
              <div class="tabbertab">
	            <h2>{box.name} ({box.newCount}) </h2>
	            <table width="100%" border="0" cellspacing="2" cellpadding="0">
                  {box.mailsContent}
				  <OBJ newMailRow>
				  <tr>
                    <td><img src="system/image.php?file={mail.mainpicture}&amp;width=30" alt="[Picture {150}]" name="picture" hspace="2" border="0" align="left" id="picture" /></td>
                    <td><strong>{mail.username}</strong></td>
                    <td><strong><a href="?L=mails.read&id={mail.id}">{mail.subject}</a></strong></td>
                    <td align="right"><strong>{mail.date}</strong></td>
                    <td align="right"><input type="checkbox" name="chkMulti[]" value="{mail.id}" onClick="wSel();" /></td>
				  </tr>
				  </OBJ newMailRow>
				  <OBJ newMailWithAttachmentRow>
                  <tr>
                    <td><a href="javascript:showUserPicture('{user.mainpicture}');"><img src="system/image.php?file={mail.mainpicture}&amp;width=30" alt="[Picture {150}]" name="picture" hspace="2" border="0" align="left" id="picture" /></a></td>
                    <td><strong>{mail.username}</strong></td>
                    <td><strong>(A) <a href="?L=mails.read&id={mail.id}">{mail.subject}</a></strong></td>
                    <td align="right"><strong>{mail.date}</strong></td>
                    <td align="right"><input type="checkbox" name="chkMulti[]" value="{mail.id}" onClick="wSel();" /></td>
                  </tr>
				  </OBJ newMailWithAttachmentRow>
				  <OBJ mailRow>
                  <tr>
                    <td><a href="javascript:showUserPicture('{user.mainpicture}');"><img src="system/image.php?file={mail.mainpicture}&amp;width=30" alt="[Picture {150}]" name="picture" hspace="2" border="0" align="left" id="picture" /></a></td>
                    <td>{mail.username}</td>
                    <td><a href="?L=mails.read&id={mail.id}">{mail.subject}</a></td>
                    <td align="right">{mail.date}</td>
                    <td align="right"><input type="checkbox" name="chkMulti[]" value="{mail.id}" onClick="wSel();" /></td>
                  </tr>
				  </OBJ mailRow>
				  <OBJ mailWithAttachmentRow>
                  <tr>
                    <td><a href="javascript:showUserPicture('{user.mainpicture}');"><img src="system/image.php?file={mail.mainpicture}&amp;width=30" alt="[Picture {150}]" name="picture" hspace="2" border="0" align="left" id="picture" /></a></td>
                    <td>{mail.username}</td>
                    <td>(A) <a href="?L=mails.read&id={mail.id}">{mail.subject}</a></td>
                    <td align="right">{mail.date}</td>
                    <td align="right"><input type="checkbox" name="chkMulti[]" value="{mail.id}" onClick="wSel();" /></td>
                  </tr>
                  </OBJ mailWithAttachmentRow>
				  <OBJ emptyBox>
				  <tr>
                    <td colspan="5" align="center">
					    <strong>[Sorry this mailbox is empty {7010}] </strong>					</td>
                  </tr>
				  </OBJ emptyBox>
                </table>
				<br /><br />
				{box.emptyTrash}
				<OBJ emptyTrashLink><a href="?L=mails.mails&emptytrash=1">[Empty trash {7015}]</a></OBJ emptyTrashLink>
	          </div>
			  </LOOP mailBoxes>
            </div>	    </td>
        <td bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td height="2" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><h2>[With selected... {600}] </h2></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td><select name="checkedMailsOptions" id="checkedMailsOptionsDropDown">
              <option value="">[With selected... {600}]</option>
              <LOOP dropDownBoxNames>
			  <option value="moveTo_{dropdownMailbox.name}">[Move all selected mails to {dropdownMailbox.name} {605}]</option>
			  </LOOP dropDownBoxNames>
			  <option value="delete">[Delete all selected mails {610}]</option>
			  <option value="spam">[Report as spam {615}]</option>
			  <option value="abuse">[Report as abuse {620}]</option>
            </select></td>
          </tr>
          <tr>
            <td><input type="submit" name="withSelectPost" id="withSelectOK" value="[Ok {625}]" class="submit" /></td>
          </tr>
        </table>		</td>
      </tr>
    </table>
	</form><!-- /leftpane -->
	</td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[Mailboxes {7025}] </h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <LOOP mailBoxesControl>
			  <tr>
                <td>{controlBoxes.name}</td>
                <td>{controlBoxes.newMails}/{controlBoxes.mailsCount}</td>
                <td align="right">&nbsp; {controlBoxes.delete}
				  <OBJ deleteBox>
				    <a href="?L=mails.mails&rembox={delete.boxName}">[Delete {10}]</a>
				  </OBJ deleteBox>
				</td>
              </tr>
			  </LOOP mailBoxesControl>
          </table>
		</td>
        <td>&nbsp;</td>
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
      <tr>
        <td><h2>[Create a mailbox {7020}] </h2></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		<ZONE createMailboxMessage tooLong>
		<strong>[Sorry the mailbox name you submitted is too long {7030}]</strong>
		</ZONE createMailboxMessage tooLong>
		
		<ZONE createMailboxMessage notAllowed>
		<strong>[Sorry you are not allowed to create custom mailboxes {7035}]</strong>
		</ZONE createMailboxMessage notAllowed>

		<ZONE createMailboxMessage overQuota>
		<strong>[Sorry you are not allowed to create more mailboxes {7040}]</strong>
		</ZONE createMailboxMessage overQuota>

		<ZONE createMailboxMessage success>
		<strong>[The mailbox has been created successfully {7045}]</strong>
		</ZONE createMailboxMessage success>
		
		<form method="post" action="">
                  <table border="0" cellspacing="3" cellpadding="0">
                    <tr>
                      <td align="right"><input name="boxName" type="text" id="boxName" size="35" /></td>
                    </tr>
                    <tr>
                      <td align="right"><input type="submit" name="Submit" value="[Submit {295}]" class="submit" /></td>
                    </tr>
                  </table>
            </form>	    </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td height="1" colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td>
		  <h2>[Quota {7050}] </h2>
		  <br />
		  <p>[You are using {quota.kBytesInUse}K out of a total allotment of {quota.allotment}K ({quota.percentageInUse}% space in use) {7055}]<br />
          </p>
		  <br />
          <table width="200" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><div id="gaugewrapper">
                  <div id="gaugelevel" style="width:{quota.percentageInUse}%;">
                    <div id="gaugelabel"> {quota.percentageInUse}% </div>
                  </div>
              </div></td>
            </tr>
          </table>	      </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>

<script language="javascript" type="text/javascript">
  function wSel() {
    document.getElementById('withSelectOK').disabled = false;
	document.getElementById('checkedMailsOptionsDropDown').disabled = false;
  }
  
  document.getElementById('withSelectOK').disabled = true
  document.getElementById('checkedMailsOptionsDropDown').disabled = true
</script>


</ZONE mailsPage enabled>

<ZONE mailsPage disabled>
<center>
  <strong>[Sorry you have to be logged in in order to access this page. {630}]</strong>
</center>
</ZONE mailsPage disabled>

<!-- footer --><!-- /footer -->