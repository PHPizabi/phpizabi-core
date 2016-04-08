<h2>Internal Mails Settings </h2>
<br /><br />
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Inbox name:  </strong></td>
    <td width="10">&nbsp;</td>
    <td><input name="MAILS_INBOX_NAME" type="text" id="MAILS_INBOX_NAME" value="{CONF.MAILS_INBOX_NAME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Trashbox name: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_TRASHBOX_NAME" type="text" id="MAILS_TRASHBOX_NAME" value="{CONF.MAILS_TRASHBOX_NAME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Sentbox name: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_SENTBOX_NAME" type="text" id="MAILS_SENTBOX_NAME" value="{CONF.MAILS_SENTBOX_NAME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Keep sent messages: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="MAILS_AUTO_KEEP_SENT" value="1" {ck.MAILS_AUTO_KEEP_SENT}/> Keep sent messages in sent box</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Sent subject prefix: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_SENT_SUBJECT_PREFIX" type="text" id="MAILS_SENT_SUBJECT_PREFIX" value="{CONF.MAILS_SENT_SUBJECT_PREFIX}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Reply subject prefix: </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="MAILS_REPLY_SUBJECT_PREFIX" type="text" id="MAILS_REPLY_SUBJECT_PREFIX" value="{CONF.MAILS_REPLY_SUBJECT_PREFIX}" size="40" />
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Reply quote separator prefix: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_REPLY_QUOTE_SEPARATOR_PREFIX" type="text" id="MAILS_REPLY_QUOTE_SEPARATOR_PREFIX" value="{CONF.MAILS_REPLY_QUOTE_SEPARATOR_PREFIX}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Reply quote separator suffix: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_REPLY_QUOTE_SEPARATOR_SUFFIX" type="text" id="MAILS_REPLY_QUOTE_SEPARATOR_SUFFIX" value="{CONF.MAILS_REPLY_QUOTE_SEPARATOR_SUFFIX}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Forward subject prefix: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_FORWARD_SUBJECT_PREFIX" type="text" id="MAILS_FORWARD_SUBJECT_PREFIX" value="{CONF.MAILS_FORWARD_SUBJECT_PREFIX}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Forward body prefix: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_FORWARD_BODY_PREFIX" type="text" id="MAILS_FORWARD_BODY_PREFIX" value="{CONF.MAILS_FORWARD_BODY_PREFIX}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Forward from origin: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="MAILS_FORWARD_FROM_ORIGIN" value="1" {ck.MAILS_FORWARD_FROM_ORIGIN}/> Forward messages from their origins</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Forward body suffix: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_FORWARD_BODY_SUFFIX" type="text" id="MAILS_FORWARD_BODY_SUFFIX" value="{CONF.MAILS_FORWARD_BODY_SUFFIX}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Quota: Max kilobytes: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_QUOTA_MAX_KILOBYTES" type="text" id="MAILS_QUOTA_MAX_KILOBYTES" value="{CONF.MAILS_QUOTA_MAX_KILOBYTES}" size="40" /></td>
    <td>* Integer (Kb) </td>
  </tr>
  <tr>
    <td><strong>Custom mailboxes allowed: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="MAILS_CUSTOM_MAILBOX_ALLOWED" value="1" {ck.MAILS_CUSTOM_MAILBOX_ALLOWED}/> Allow users to create custom mailboxes</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Custom mailboxes name maximum length: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_CUSTOM_MAILBOX_NAME_MAX_LEN" type="text" id="MAILS_CUSTOM_MAILBOX_NAME_MAX_LEN" value="{CONF.MAILS_CUSTOM_MAILBOX_NAME_MAX_LEN}" size="40" /></td>
    <td>* Integer </td>
  </tr>
  <tr>
    <td><strong>Maximum number of custom mailboxes: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_CUSTOM_MAILBOX_MAX_BOXES" type="text" id="MAILS_CUSTOM_MAILBOX_MAX_BOXES" value="{CONF.MAILS_CUSTOM_MAILBOX_MAX_BOXES}" size="40" /></td>
    <td>* Integer </td>
  </tr>
  <tr>
    <td><strong>Maximum subject length: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_MAX_SUBJECT_LENGHT" type="text" id="MAILS_MAX_SUBJECT_LENGHT" value="{CONF.MAILS_MAX_SUBJECT_LENGHT}" size="40" /></td>
    <td>* Integer </td>
  </tr>
  <tr>
    <td><strong>Minimum remail delay: </strong></td>
    <td>&nbsp;</td>
    <td><input name="MAILS_MIN_REMAIL_DELAY" type="text" id="MAILS_MIN_REMAIL_DELAY" value="{CONF.MAILS_MIN_REMAIL_DELAY}" size="40" /></td>
    <td>* Seconds </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="Submit" value="Submit" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
