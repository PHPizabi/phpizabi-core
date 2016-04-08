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
    <td height="8" colspan="3" bgcolor="#2C4384" style="font-size:10px;">&nbsp;</td>
  </tr>
  <tr>
    <td width="220" height="75" bgcolor="#CFD6E2" style="padding-left:8px;">
	<form method="get">
	<input type="hidden" name="L" value="admin.users.control" />
	<table width="220" border="0" cellpadding="0" cellspacing="2">
      <tr>
        <td>Search for users </td>
      </tr>
      <tr>
        <td><input name="query" type="text" id="query" size="20"/>
          <input name="Search" type="submit" id="Search" value="Search" /></td>
      </tr>
    </table>
	</form>	</td>
    <td height="75" colspan="2" align="right" bgcolor="#CFD6E2" style="padding-right:20px;"><h1>PHPizabi Administration</h1></td>
  </tr>
  <tr>
    <td width="220" height="25" bgcolor="#2C4384" style="padding-left:8px; color:#FFFFFF;"><strong>Administrative Tools</strong> </td>
    <td height="25" align="left" bgcolor="#FFFFFF" style="padding-left:8px;">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF" style="padding-right:8px;"><!-- breadcrumbs --><a href="?L=admin.index">Home</a> | <a href="?L=users.desktop&amp;id={me.id}">Desktop</a> | <a href="?logout=1">Logout</a><!-- /breadcrumbs --></td>
  </tr>
  <tr>
    <td width="220" valign="top" bgcolor="#F1F3F8" style="padding:5px;"><!-- leftpane --><table width="220" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><strong>General</strong></td>
      </tr>
      <tr>
        <td width="1">&nbsp;</td>
        <td width="187"><a href="?L=admin.index">Home</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.mail.bulk">Mass Mail </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.news.news">News</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.cms.cms">Content Pages </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><strong>Users</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.users.users">Users Control </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.heritage.levels">Membership Heritage </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.accesscontrol.accesscontrol">Access Control </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.users.ban">Ban Control </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><strong>System</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.system.index">System Settings</a> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.vhost.index">Virtual Hosts Settings </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.languages.languages">Languages Settings </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.questionnaires.new&amp;reset=1">Questionnaires</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.questionnaires.bindings">Registration Bindings </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.cron.cron">Scheduled Tasks</a> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.logs.logs">Access Logs </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.backups.backups">Backups</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.miscs.picturescache">Pictures Cache</a> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><strong>Theme / Templates </strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.templates.templates">Template Editor </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.templates.mails">Mails Editor</a> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.miscs.terms">Terms &amp; Privacy </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.templates.errorpages">Error Pages</a> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><strong>Modules</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.modules.inkspot.index">InkSpot</a></td>
      </tr>
	  <!-- modules -->
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
	  <!-- /modules -->
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.molo.molo"><strong>Install Modules  </strong></a>  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><strong>PHPizabi Online</strong> </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.pos.browser&amp;mode=support">Get Support </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.pos.browser&amp;mode=updates">Browse Updates </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.pos.browser&amp;mode=modules">Browse Modules </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.pos.browser&amp;mode=license">License information </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><a href="?L=admin.pos.browser&amp;mode=news">News </a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <!-- /leftpane --></td>
    <td colspan="2" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="30" cellpadding="0">
      <tr>
        <td>
		  {jump}		</td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="35" colspan="3" valign="middle" bgcolor="#CFD6E2" style="padding-left:8px;">
	  <span style="
	  font-family: Geneva, Arial, Helvetica, sans-serif;
	  font-size: 10px;
	  color: #666666;
    ">Powered by {systemVersion}  <br />
	(C) 2005, 2006 Real!ty Medias, All rights reserved</span></td>
  </tr>
</table>
</body>
</html>