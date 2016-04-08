<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top"><!-- leftpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1" valign="top"><img src="system/image.php?file={user.mainpicture}" alt="[My Picture {125}]" name="picture" hspace="4" vspace="2" border="0" id="picture" /></td>
            <td valign="top"><h1>[Mail from {user.username} {7060}] </h1>
                  <p><!-- breadcrumbs --><a href="?L=users.profile&amp;id={user.id}">[{user.username}'s profile {115}]</a> | <a href="?L=pictures.gallery&amp;id={user.id}">[{user.username}'s gallery {120}]</a><!-- /breadcrumbs --></p></td>
          </tr>
        </table></td>
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
        <td height="6" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:10px;"><h4>{mail.subject}</h4>
          <h6>[Sent by {user.username} on {mail.date} {7065}]<br />
            <br />
          </h6>
          <p>{mail.body}</p></td>
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
        <td height="20" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="20" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><h1>[With this mail... {7070}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
          		<form method="post">
		<table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td>
		<select name="withMailSelect">
		  <option value="">[With this mail... {7070}]</option>
		  <option value="reply">[Reply to this mail {7075}]</option>
		  <option value="forward">[Forward this mail {7080}]</option>
		  <LOOP mailboxesListTwo>
		  <option value="moveTo_{mailbox.name}">[Move mail to {mailbox.name} {7085}]</option>
		  </LOOP mailboxesListTwo>
		  <option value="delete">[Delete this mail {7090}]</option>
		  <option value="block">[Block this user {7095}]</option>
		  <option value="blockdelete">[Delete this mail and block this user {7100}]</option>
		  <option value="spam">[Report as spam {615}]</option>
		  <option value="abuse">[Report as abuse {620}]</option>
        </select>
			</td>
          </tr>
          <tr>
            <td><input type="submit" name="withMailPost" id="withMailPostOK" value="[Ok {625}]" class="submit" />
              <input type="submit" name="reply" id="reply" value="[Reply {575}]" class="submit" />
              <input type="submit" name="delete" id="delete" value="[Delete {10}]" class="submit" />
			</td>
          </tr>
        </table>
		</form>
          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[With this mail... {7070}] </h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td> 
		<form method="post">
		<table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td>
		<select name="withMailSelect">
		  <option value="">[With this mail... {7070}]</option>
		  <option value="reply">[Reply to this mail {7075}]</option>
		  <option value="forward">[Forward this mail {7080}]</option>
		  <LOOP mailboxesList>
		  <option value="moveTo_{mailbox.name}">[Move mail to {mailbox.name} {7085}]</option>
		  </LOOP mailboxesList>
		  <option value="delete">[Delete this mail {7090}]</option>
		  <option value="block">[Block this user {7095}]</option>
		  <option value="blockdelete">[Delete this mail and block this user {7100}]</option>
		  <option value="spam">[Report as spam {615}]</option>
		  <option value="abuse">[Report as abuse {620}]</option>
        </select>
			</td>
          </tr>
          <tr>
            <td><input type="submit" name="withMailPost" id="withMailPostOK" value="[Ok {625}]" class="submit" />
              <input type="submit" name="reply" id="reply" value="[Reply {575}]" class="submit" />
              <input type="submit" name="delete" id="delete" value="[Delete {10}]" class="submit" /></td>
          </tr>
        </table>
		</form>
		</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td><a href="?L=mails.mails">[Go back to my inbox {7105}]</a> | <a href="?L=mails.write">[Write a mail {7110}] </a></td>
        <td>&nbsp;</td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->