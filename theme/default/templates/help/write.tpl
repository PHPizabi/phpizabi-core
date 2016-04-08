<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>{siteName}</title>
<link href="{themePath}/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="5" colspan="2" bgcolor="#2C4384" style="font-size:1px;">&nbsp;</td>
      </tr>
      <tr>
        <td width="220" height="75" bgcolor="#CFD6E2" style="padding-left:8px;">
		<form method="post" action="?L=help.help&chromeless=1&origin={origin}">
		<table width="220" border="0" cellpadding="0" cellspacing="2">
            <tr>
              <td>[Search the Help Center {6450}] </td>
            </tr>
            <tr>
              <td><input name="query" type="text" id="query" value="" size="20"/>
                  <input name="Search" type="submit" id="Search" value="[Search {300}]" /></td>
            </tr>
        </table></form></td>
        <td height="75" align="right" bgcolor="#CFD6E2" style="padding-right:20px;"><h1>[Contribute {6470}] </h1></td>
      </tr>
      <tr>
        <td width="220" height="25" bgcolor="#2C4384" style="padding-left:8px; color:#FFFFFF;"><strong>[Important! {6455}]</strong></td>
        <td height="25" align="right" bgcolor="#FFFFFF" style="padding-right:8px;"><a href="javascript:window.close();">[Close {6480}]</a> </td>
      </tr>
      <tr>
        <td width="220" rowspan="2" valign="top" bgcolor="#F1F3F8" style="padding-left:8px;"><p><br />
          <br />
          [This is an administrator tool, your article will not be saved if you don't have administrative privileges. {6460}] </p>
          <p>&nbsp;</p>
          <p><strong>[Allowed bodycodes: {6465}] </strong></p>
          <p>&nbsp;</p>
          <p>[b] <strong>[bold {6485}]</strong> [/b]<br />
        [i] <em>[italic {6490}]</em> [/i] <br />
        [u] <u>[underline {6495}]</u> [/u]<br />
        [s] <s>[strikeout {6500}]</s> [/s]<br />
        [tt] <tt>[teletype {6505}]</tt> [/tt]<br />
        [color red][color {6510}] [/color]
</p>
        </td>
        <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="30" cellpadding="0">
            <tr>
              <td valign="top">
                <form method="post">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
                  <tr>
                    <td colspan="2"><h2>[Contribute {6470}] </h2>
                        <p>[Post an help article related to {origin}: {6525}] </p></td>
                  </tr>
                  <tr>
                    <td><strong>[Origin: {6475}] </strong></td>
                    <td><input name="origin" type="text" id="origin" value="{origin}" style="width:98%;"/></td>
                  </tr>
                  <tr>
                    <td><strong>[Title: {15}] </strong></td>
                    <td><input name="title" type="text" id="title" style="width:98%;" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>[Body: {20}] </strong></td>
                  </tr>
                  <tr>
                    <td colspan="2"><textarea name="body" rows="10" id="body" style="width:98%;" ></textarea></td>
                  </tr>
                  <tr>
                    <td><input type="submit" name="Submit" value="[Submit {295}]" /></td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table></form></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="20" valign="middle" bgcolor="#CFD6E2" style="padding-left:8px;">
		<ZONE saved show>
		<strong>[Saved!  {6515}]</strong> | <a href="?L=help.help&amp;chromeless=1&amp;origin={origin}&amp;id={new.id}">[Generated article {new.id} {6520}]</a></ZONE saved show>
		&nbsp;</td>
      </tr>
    </table>
</body>
</html>
