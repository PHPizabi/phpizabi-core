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
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top" style="padding-right:10px;"><img src="system/image.php?file={user.mainpicture}" alt="[My Picture {125}]" name="picture" hspace="0" vspace="5" border="0" id="picture" /></td>
                  <td valign="top"><h1>[Welcome on my blog! {1005}]</h1>
                    <p>[{user.username} wrote {count.articles} articles and got {count.comments} comments. The last article was submitted on {count.lastarticle} {1010}] <br />
                      <br />
                      <!-- breadcrumbs --><a href="?L=users.profile&amp;id={user.id}">[{user.username}'s profile {115}]</a> | <a href="?L=pictures.gallery&amp;id={user.id}">[{user.username}'s gallery {120}]</a><!-- /breadcrumbs --></p>                  </td>
                </tr>
              </table>          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="8" /></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="8" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF">
		  <ZONE blogGetMethod latestArticle>
		    <h1>[Latest blog article {1015}]</h1>
		  </ZONE blogGetMethod latestArticle>
		  <ZONE blogGetMethod givenArticle>
		    <h1>[Blog article by {user.username} {1020}]</h1>
		  </ZONE blogGetMethod givenArticle>          </td>
      </tr>
      <tr>
        <td height="6" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="6" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:10px;">

		  <h4>{blog.title}</h4>
          <p><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.date} <img src="{themePath}/images/icons/document.gif" alt="[Icon {140}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.views} <img src="{themePath}/images/icons/comment.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.comments}<br />
            <br />
            {blog.body}</p>
          <br /><br />		  </td>
      </tr>
      <tr>
        <td height="10" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="10" /></td>
      </tr>
      <tr>
        <td height="2" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/block_border_bottom.gif" alt="[Spacer {130}]" height="14" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
		  <ZONE addToFavorites enabled>
		    <a href="?L=blogs.blog&amp;id={user.id}&fav=true">[Add to my favorite blogs {290}]</a> |
		  </ZONE addToFavorites enabled>
		  <a href="?L=blogs.write">[Write blog articles {285}]</a>
		  <ZONE blogControlLinks enabled>
	        | <a href="?L=blogs.edit&amp;id={blog.id}">[Edit {5}]</a> | <a href="?L=blogs.blog&amp;article={blog.id}&amp;rm=1">[Delete {10}]</a>		  </ZONE blogControlLinks enabled>	 
		</td>
      </tr>
      <tr>
        <td height="20" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="20" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><h1>[Comments on this blog article {1035}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="5" /></td>
        <td height="5" background="{themePath}/images/frame/greenbar.gif" bgcolor="#C0FF5E"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><br />
		<ZONE blogArticleCommentsBlock enabled>
		  <LOOP blogArticleComments>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="90" valign="top" style="padding-right: 10px;"><a href="?L=users.profile&id={comment.userid}"><img src="system/image.php?file={comment.usermainpicture}" alt="Picture" name="picture" border="0" id="picture" /></a><br /><a href="?L=users.profile&id={comment.userid}">{comment.username}</a></td>
                <td valign="top">
				  <h4> {comment.title}</h4>
			      <h6><img src="{themePath}/images/icons/date.gif" alt="Date" width="16" height="16" hspace="2" align="absmiddle" />
			        {comment.date}			        </h6>
			      <p>{comment.body}</p>
				  <is_mop>
				    <div style="float:right; clear:none;">
				      <a href="?L=blogs.blog&article={blog.id}&rmcomment={comment.id}">Delete</a>
				    </div>
				  </is_mop>
				  </td>
			  </tr>
              <tr>
                <td height="1" colspan="2" valign="top" bgcolor="#E5E9EC" class="small"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                </tr>
            </table>
		    <br />
		  </LOOP blogArticleComments>
		</ZONE blogArticleCommentsBlock enabled>
		
		<ZONE blogArticleCommentsBlock disabled>
		  [Sorry there is no comment on this blog article yet. Would you like to be the first one to write a comment? {1040}]		</ZONE blogArticleCommentsBlock disabled>		</td>
      </tr>
      <tr>
        <td height="20" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="20" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><h1>[Drop your comment for this article {1045}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="5" /></td>
        <td height="5" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
		<ZONE writeComment enabled>
	    <form method="post">
	      <table width="100%" border="0" cellpadding="0" cellspacing="3">
            <tr>
              <td valign="top"><strong>[Title: {15}]</strong></td>
              <td colspan="2" valign="top"><input name="title" type="text" id="title" class="fullwidth" /></td>
            </tr>
            <tr>
              <td valign="top"><strong>[Body: {20}]</strong></td>
              <td colspan="2" valign="top"><textarea name="body" class="fullwidth" rows="5" id="body"></textarea></td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td valign="middle"><input type="submit" name="SubmitComment" value="Submit" class="submit" /></td>
              <td align="right" valign="top"><table border="0" cellpadding="0" cellspacing="3">
                  <tr>
                    <td><label>
                      <input name="polarity" type="radio" value="+" />
                      [Positive {25}]</label></td>
                    <td><label>
                      <input name="polarity" type="radio" value="=" checked="checked" />
                      [Neutral {30}]</label></td>
                    <td><label>
                      <input name="polarity" type="radio" value="-" />
                      [Negative {35}]</label></td>
                  </tr>
              </table></td>
            </tr>
          </table>
	    </form>
	  </ZONE writeComment enabled>
	  <ZONE writeComment posted>
	    <strong>[Your comment has been successfully posted {40}]</strong>	  </ZONE writeComment posted>
	  <ZONE writeComment guest>
	   <strong>[Sorry, guests can not post comments {45}]</strong>
|	<a href="?L=registration.register">[Register {50}]</a> </ZONE writeComment guest>	  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[More articles {1055}] </h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">
		  <p>[Would you like to read more articles written by {user.username}? Here are the latest posts. {1060}] <br />
		  </p>
		  </td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">
		<ZONE latestBlogArticles enabled>
		    <table width="100%" border="0" cellpadding="0" cellspacing="2">
              <LOOP latestBlogArticlesLoop>
			  <tr>
                <td><img src="{themePath}/images/icons/icon_link.gif" alt="[Bullet {145}]" width="9" height="11" align="baseline" /></td>
                <td colspan="4"><a href="?L=blogs.blog&amp;article={latest.id}"><strong>{latest.title}</strong></a></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {latest.date}</td>
                <td><img src="{themePath}/images/icons/document.gif" alt="[Icon {140}]" width="16" height="16" hspace="2" align="absmiddle" /> {latest.views}</td>
                <td><img src="{themePath}/images/icons/comment.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {latest.comments} comment(s) </td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td height="1" colspan="5" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                </tr>
			  </LOOP latestBlogArticlesLoop>
            </table>
		</ZONE latestBlogArticles enabled>
		<ZONE latestBlogArticles disabled>
		  [Sorry {user.username} doesn't have any other blog articles {1065}]
		</ZONE latestBlogArticles disabled>		</td>
      </tr>
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="5" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="8" /></td>
      </tr>
      <tr>
        <td><h2>[Search my blog {1070}]</h2></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">
		  <form method="get">
		  <input type="hidden" name="L" value="blogs.search" />
		  <input type="hidden" name="user" value="{user.id}" />
		  
		  <table border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td align="right"><input name="query" type="text" id="query" size="35" /></td>
            </tr>
            <tr>
              <td align="right"><input type="submit" name="Submit" value="Submit" class="submit" /></td>
            </tr>
          </table>	     
		  <br />
		  <br />
		  <a href="?L=blogs.browse">[Browse all blogs {1075}] </a></td>
        </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="8" /></td>
      </tr>
      <tr>
        <td height="1" colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="8" /></td>
      </tr>
      <tr>
        <td><h2>[Archived articles {1080}] </h2>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                          <td><h4>{thisMonthLabel}</h4></td>
              </tr>
                        <tr>
                          <td>{thisMonthCalendar}</td>
              </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td><h4>{lastMonthLabel}</h4></td>
              </tr>
                        <tr>
                          <td>{lastMonthCalendar}</td>
              </tr>
            </table>
          </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="[Spacer {130}]" height="8" /></td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->

<OBJ blogEmpty>[Sorry this user has no blog article. {1050}]</OBJ blogEmpty>

<OBJ month_1>[January {55}]</OBJ month_1>
<OBJ month_2>[February {60}]</OBJ month_2>
<OBJ month_3>[March {65}]</OBJ month_3>
<OBJ month_4>[April {70}]</OBJ month_4>
<OBJ month_5>[May {75}]</OBJ month_5>
<OBJ month_6>[June {80}]</OBJ month_6>
<OBJ month_7>[July {85}]</OBJ month_7>
<OBJ month_8>[August {90}]</OBJ month_8>
<OBJ month_9>[September {95}]</OBJ month_9>
<OBJ month_10>[October {100}]</OBJ month_10>
<OBJ month_11>[November {105}]</OBJ month_11>
<OBJ month_12>[December {110}]</OBJ month_12>