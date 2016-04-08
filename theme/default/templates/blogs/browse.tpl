<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top"><!-- leftpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td><h1>[Last 20 blog articles {1085}] </h1>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><p>[Searching for the latest blogs posted on {siteName}?&nbsp; Check out the last 20 blogs submitted by  {siteName} members. {1090}] </p></td>
                </tr>
              </table>
          <br /><!-- breadcrumbs -->
              <ZONE writeOptions enabled>
			  <a href="?L=blogs.write">[Write an article {1095}]</a> | <a href="?L=blogs.blog&amp;id={me.id}">[My Blog {2000}] </a>
			  </ZONE writeOptions enabled>
			  <!-- /breadcrumbs -->
			  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
		
		
		<LOOP blogArticles>
<table width="100%" cellpadding="0" cellspacing="3">
  <tr>
    <td valign="top" style="padding-top:5px;" width="80"><a href="?L=users.profile&amp;id={blog.userid}"><img src="system/image.php?file={blog.mainpicture}" alt="[Picture {150}]" id="picture" /></a><br />
      <a href="?L=users.profile&amp;id={blog.userid}">{blog.username}</a></td>
    <td valign="top"><a href="?L=blogs.blog&amp;article={blog.id}">
      <h4>{blog.title}</h4>
      </a>
        <h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.date} <img src="{themePath}/images/icons/comment.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.comments} <img src="{themePath}/images/icons/document.gif" alt="[Icon {140}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.views}</h6>
      {blog.body}  ... <a href="?L=blogs.blog&amp;article={blog.id}">[Read this article {245}]</a> | <a href="?L=blogs.blog&id={blog.userid}">[User's blog {250}]</a> </td>
  </tr>
  <tr>
    <td height="1" colspan="2" valign="top" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
    </tr>
</table>
</LOOP blogArticles>
		
		
		
		</td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[Search for blogs! {2015}] </h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">Search for blogs by topic and content.<br> 
          <br>
            <form method="get">
			<input type="hidden" name="L" value="blogs.search" />
			<table border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td align="right"><input name="query" type="text" size="35" /></td>
          </tr>
          <tr>
            <td align="right"><input type="submit" name="Submit" value="Submit" class="submit" /></td>
          </tr>
        </table></td>
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
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td><h2>[Last 100 titles {2020}] </h2>
              <LOOP blogArticlesList>
                <a href="?L=blogs.blog&article={articlesList.id}">{articlesList.title}</a><br />
            </LOOP blogArticlesList></td>
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
      <tr>
        <td><h2>&nbsp;</h2>          </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->