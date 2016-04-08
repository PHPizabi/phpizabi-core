<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>{siteName}</title>
<script type="text/javascript" src="{themePath}/javascript.js"></script>
<link href="{themePath}/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<!-- header --><!-- /header -->
<table width="855" border="0" align="center" cellpadding="0" cellspacing="0" class="fullheight">
  <tr>
    <td height="160" colspan="2" valign="top" background="{themePath}/images/frame/header.gif"><table width="100%" height="135" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="122" align="left" valign="top"><img src="{themePath}/images/frame/logo.gif" alt="Logo" width="245" height="122" /></td>
          <td height="122" align="center" valign="bottom"><div id="laneContainer"></div></td>
        </tr>
        <tr>
          <td id="navigation"><!-- breadcrumbs -->
            <a accesskey="d" href="?L=users.desktop">My Desktop</a> 
			<img src="{themePath}/images/frame/menu_separator.gif" hspace="2" align="absmiddle" />
            <a href="?L=contacts.contacts">My Contacts</a> 
			<img src="{themePath}/images/frame/menu_separator.gif" hspace="2" align="absmiddle" />
            <a accesskey="s" href="?L=search.users">Search</a> 
			<img src="{themePath}/images/frame/menu_separator.gif" hspace="2" align="absmiddle" />
            <a accesskey="b" href="?L=blogs.browse">Blogs</a>
			<img src="{themePath}/images/frame/menu_separator.gif" hspace="2" align="absmiddle" />
			<a href="?L=chat.chat">Chatrooms</a> 
			<img src="{themePath}/images/frame/menu_separator.gif" hspace="2" align="absmiddle" />
            <a accesskey="f" href="?L=inkspot.index">Inkspot</a>
			<!-- /breadcrumbs --></td>
          <td align="right" id="usercontrol">
		    <ZONE userStatus guest>
			  <a href="?L">Login</a> 
              <img src="{themePath}/images/frame/menu_separator.gif" hspace="2" align="absmiddle" />
			  <a href="?L=registration.register">Register</a>		    </ZONE userStatus guest>
			<ZONE adminLink enabled>
			  <a href="?L=admin.index">Admin</a>
			  <img src="{themePath}/images/frame/menu_separator.gif" hspace="2" align="absmiddle" />
			</ZONE adminLink enabled>
			<ZONE adminLink disabled></ZONE adminLink disabled>
			<ZONE userStatus user>
			<a href="?logout=true">Logout</a>
			<img src="{themePath}/images/frame/menu_separator.gif" hspace="2" align="absmiddle" />
			</ZONE userStatus user>
          <a accesskey="h" href="javascript:popUp('?L=help.help&chromeless=1&origin={system.l}');">Help</a></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF">{jump}</td>
  </tr>
  <tr>
    <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
  </tr>
  <tr>
    <td width="60%" height="160" valign="top" bgcolor="#031545">
	<div style="padding:15px;">
	
	<div id="footer_elements">
	  <ZONE footer_element empty>	
	    <table width="450" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
	  </ZONE footer_element empty>
	  <ZONE footer_element random_users>	
	    <table width="450" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><h1><span class="footerColorSet1">Some</span> <span class="footerColorSet2">Random Members</span></h1></td>
            <td align="right" valign="middle" style="padding-right:8px;">
		      <a href="Javascript:ajFetch('?proc_footer_element=notepad', 'footer_elements', false, 0);"><img src="{themePath}/images/frame/notepad_icon.gif" alt="Notepad" title="Notepad!" width="21" height="22" /></a> 
			  <a href="Javascript:ajFetch('?proc_footer_element=random', 'footer_elements', false, 0);"><img src="{themePath}/images/frame/cycle_icon.gif" alt="Randomize!" title="Randomize!" width="27" height="24" /></a>			</td>
          </tr>
          <tr>
            <td colspan="2">
	          <LOOP footerQuery>
                <div style="float:left; padding-right:6px; clear:none;">
                  <a href="?L=users.profile&id={user.id}">
                    <img src="system/image.php?file={user.mainpicture}" alt="Picture" hspace="2" border="0" id="picture" />
			      </a>
                  <br />
                  <a href="?L=users.profile&id={user.id}">{user.username}</a>
		        </div>
              </LOOP footerQuery>
            </td>
          </tr>
        </table>
	  </ZONE footer_element random_users>
	  <ZONE footer_element notepad>	
	    <table width="450" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><h1><span class="footerColorSet1">My</span> <span class="footerColorSet2">Notepad</span></h1></td>
            <td align="right" valign="middle" style="padding-right:8px;">
		      <a href="Javascript:ajFetch('?proc_footer_element=notepad', 'footer_elements', false, 0);"><img src="{themePath}/images/frame/notepad_icon.gif" alt="Notepad" title="Notepad!" width="21" height="22" /></a> 
		      <a href="Javascript:ajFetch('?proc_footer_element=random', 'footer_elements', false, 0);"><img src="{themePath}/images/frame/cycle_icon.gif" alt="Randomize!" title="Randomize!" width="27" height="24" /></a>			</td>
          </tr>
          <tr>
            <td colspan="2">
	          <ZONE notepad guest>
			    <span class="footerColorSet1">Sorry you have to be logged in in order to use the notepad</span>
			  </ZONE notepad guest>
			  
			  <ZONE notepad enabled>
			    <form method="post">
				  <textarea name="notepad_body" id="notepad_body" rows="3" class="fullwidth" onkeydown="notepadStateChange();">{notepad_content}</textarea>
			      <br />
			      <input type="button" name="Submit" value="Save" class="submit_disabled" id="notepad_save_button" disabled="disabled" onclick="saveNotepad();" />
			    </form>
			  </ZONE notepad enabled>
            </td>
          </tr>
        </table>
	  </ZONE footer_element notepad>
	</div>


	</div>
	<!-- leftfooterblock --><!-- /leftfooterblock -->
	</td>
    <td width="40%" valign="top" bgcolor="#031545"><div style="padding:15px;">
      <h1><span class="footerColorSet1">Important</span> <span class="footerColorSet2">References</span><br />
      </h1>
	  <table width="100%" border="0" cellspacing="2" cellpadding="0">
        <tr>
          <td><a href="?L=invite.tellafriend&amp;origin={system.origin}" class="footerColorSet1">Tell a friend / Invite a friend </a></td>
        </tr>
        <tr>
          <td height="1" bgcolor="#003366"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
        </tr>
        <tr>
          <td><a href="?L=info.contact" class="footerColorSet1">Contact us / Report Abuse </a></td>
        </tr>
        <tr>
          <td height="1" bgcolor="#003366"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
        </tr>
        <tr>
          <td><a href="Javascript:bookmark('{siteName}', '{siteURL}')" class="footerColorSet1">Bookmark us </a></td>
        </tr>
        <tr>
          <td height="1" bgcolor="#003366"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
        </tr>
        <tr>
          <td><a href="?L=info.terms" class="footerColorSet1">Privacy policy &amp; terms of use </a></td>
        </tr>
      </table>
	  <!-- references --><!-- /references -->
    </div>
	<!-- rightfooterblock --><!-- /rightfooterblock -->
	</td>
  </tr>
  <tr>
    <td height="2" colspan="2" bgcolor="#000000"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
  </tr>
  <tr>
    <td height="65" colspan="2" bgcolor="#020B32"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="middle" id="copyright" style="padding-left:25px;"><a href="http://www.izabisquared.com" target="_blank" id="copyright">Powered by {systemVersion}</a><br />            
          &copy; 2005, 2006 - <a href="http://www.izabisquared.com" target="_blank" id="copyright">IzabiSquared</a>, All rights reserved </td>
          <td align="right">
		    <a href="http://www.phpizabi.com"><img src="{themePath}/images/frame/phpizabi.gif" hspace="25" /></a></td>
        </tr>
      </table></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->
<script language="javascript" type="text/javascript">
  launchLANE();
  setTimeout('ajFetch(\'?L=&proc_footer_element=random\', \'footer_elements\', true, 300000);', 300000);
</script>
</body>
</html>