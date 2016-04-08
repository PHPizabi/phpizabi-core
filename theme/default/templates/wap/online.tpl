<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="pragma" content="no-cache"/>
<meta http-equiv="cache-control" content="no-cache"/>

<title>{siteName}</title>
<style type="text/css">
<!--
a {
 color: #2F63B3;
 text-decoration: none;
}

input, select, textarea {
  border: 1px;
  border-style: solid;
}

body,td,th {
  color: #fff;
  font-family: Arial;
  font-size: 9px;
}
body {
  background-color: #D6E2FD;
  background-image: url("theme/templates/wap/images/background.gif");
  background-repeat: repeat-x;
  color: #fff;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
    <table border="0">
      <tr>
        <td height="17" colspan="3" align="center" valign="top" background="theme/templates/wap/images/header.gif">
	      <center>
	        {siteName},  OnlineContacts 
	      </center>        </td>
      </tr>
	  
	  <LOOP onlineUsersList>
      <tr>
        <td colspan="2" align="left" valign="top">
		{user.username}
		</td>
	    <td align="right" valign="top"><a href="?L=wap.page&id={user.id}">Page</a></td>
      </tr>
	  </LOOP onlineUsersList>
	  
    </table>
</body>
</html>

