<ZONE myPageHeader enabled>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>{siteName} - {me.username}'s home page</title>
</head>
<body>
<style type="text/css">
<!--
body {
  font: 12px "Lucida Grande", verdana, helvetica, arial, sans-serif;
  margin: 0px;
}
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td height="12" colspan="3" background="{themePath}/templates/mypage/images/mypage_03.gif"><img src="{themePath}/templates/mypage/images/mypage_01.gif" alt="Left" width="67" height="12" /></td></tr>
<tr><td height="34" background="{themePath}/templates/mypage/images/mypage_06.gif" style="padding-left:10px;"><span style="font: 18px bolder 'Lucida Grande', verdana, helvetica, arial, sans-serif; color: #000000">{user.username}'s Home Page</td>
<td height="34" align="right" background="{themePath}/templates/mypage/images/mypage_06.gif"><a href="?L=users.profile&id={me.id}" style="color:#0033CC;">Go back to {me.username}'s profile</a> </td>
<td width="100" align="right" background="{themePath}/templates/mypage/images/mypage_06.gif"><img src="{themePath}/templates/mypage/images/mypage_07.gif" alt="Logo" width="68" height="34" /></td>
</tr></table>
</ZONE myPageHeader enabled>
{myPage}
</body>
</html>
<OBJ noPage>Sorry, this user does not have a personal page.</OBJ noPage>