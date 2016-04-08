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
        <td>[Search the Help Center {6385}] </td>
      </tr>
      <tr>
        <td><input name="query" type="text" id="query" value="{query}" size="20"/>
          <input name="Search" type="submit" id="Search" value="[Search {300}]" /></td>
      </tr>
    </table>
	</form>	</td>
    <td height="75" align="right" bgcolor="#CFD6E2" style="padding-right:20px;"><h1>[Help Center {6390}] </h1></td>
  </tr>
  <tr>
    <td width="220" height="25" bgcolor="#2C4384" style="padding-left:8px; color:#FFFFFF;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><strong>[See Also {6395}] </strong></td>
          <td align="right" style="padding-right:5px;">{originkey}</td>
        </tr>
      </table></td>
    <td height="25" align="right" bgcolor="#FFFFFF" style="padding-right:8px;"><!-- breadcrumbs --><a href="javascript:window.print();">[Print {6400}]</a> | <strong><a href="?L=help.write&amp;chromeless=1&amp;origin={origin}">[Contribute {6405}]</a></strong> | <a href="javascript:window.close();">[Close {6415}]</a><!-- /breadcrumbs --></td>
  </tr>
  <tr>
    <td width="220" valign="top" bgcolor="#F1F3F8">
	<ZONE sameOrigin enabled>
	  <ul>
		<LOOP sameOriginLoop>
		  <li><a href="?L=help.help&chromeless=1&origin={sameorigin.origin}&id={sameorigin.id}">{sameorigin.title}</a></li>
		</LOOP sameOriginLoop>
	  </ul>
	</ZONE sameOrigin enabled>
	
	</td>
    <td rowspan="3" valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="30" cellpadding="0">
      <tr>
        <td>
		<ZONE article enabled>
		  <h2>{article.title}</h2>
		  <p>&nbsp;</p>
		  <p align="justify"><br />
		    {article.body}</p>
		  <br /><br /><br /><br /><br />
		  
		  <p>[This article relates to {6420}] <a href="javascript:self.opener.location='http://{originKeyLink}'; void(0);">{originkey}</a></p>
		  
		  <span style="
			font-family: Geneva, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #666666;
		  ">[Original help article author: {article.author} {6425}]<br />
		  &copy; [2005, 2006 Real!ty Medias - All rights reserved {6430}]</span></p>
		  
		</ZONE article enabled>
		
		<ZONE article notFound>
		  <h2>[No result {6440}] </h2>
		  <p><br />
		    <br />
		    [Sorry, we can't find any help article for this page; you may try to manually search instead. {6435}]</p>
		</ZONE article notFound>		</td>
      </tr>
    </table>      </td>
  </tr>
  <tr>
    <td height="25" bgcolor="#2C4384" style="padding-left:8px; color:#FFFFFF;"><strong>[Related Articles {6410}] </strong></td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#F1F3F8">
	<ZONE relatedZone enabled>
	  <ul>
		<LOOP relatedArticles>
		  <li><a href="?L=help.help&chromeless=1&origin={origin}&id={related.id}" onmouseover="document.getElementById('relatedTo').innerHTML = 'Relative to {related.origin}';">{related.title}</a></li>
		</LOOP relatedArticles>
	  </ul>
	</ZONE relatedZone enabled>
	</td>
  </tr>
  <tr>
    <td width="220" valign="middle" bgcolor="#CFD6E2" style="padding-left:8px;"><div id="relatedTo"></div></td>
    <td height="20" valign="middle" bgcolor="#CFD6E2" style="padding-left:8px;">[Help base article id {article.code} {6445}] </td>
  </tr>
</table>
</body>
</html>