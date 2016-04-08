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
    <ZONE upload form>
	<form action="" method="post" enctype="multipart/form-data">
	<table border="0">
      <tr>
        <td height="17" colspan="3" align="center" valign="top" background="theme/templates/wap/images/header.gif">
	      <center>
	        {siteName}, {me.username}
	      </center>        </td>
      </tr>
      <tr>
        <td colspan="3" align="center" valign="top"><h6>UPLOAD A PICTURE</h6>
        <p>
          <input name="file" type="file" size="5" />
        </p></td>
	  </tr>
      <tr>
        <td colspan="3" align="center" valign="top"><input type="submit" name="Submit" value="Submit" /></td>
      </tr>
    </table>
	</form>
	</ZONE upload form>
	<ZONE upload success>
	Success!
	</ZONE upload success>
</body>
</html>
