<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><!-- leftpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td colspan="2">
		  <h1>[In the Spot! {6685}] </h1>
          <p>[This is the thread reading mode page ... {6690}] </p>
          <p><br />
            <!-- breadcrumbs --><a href="?L=inkspot.write">[Create a Topic {6695}]</a> | <a href="?L=inkspot.search">[Search {300}]</a> | <a href="?L=inkspot.subject&id={subject.id}">[Back to Subject {6700}]</a> | <a href="#reply">[Reply {575}]</a> <zone admin enabled>| <a href="?L=inkspot.topic&id={topic.id}&rmthread=1">Delete thread</a></zone admin enabled><zone admin disabled></zone admin disabled><!-- /breadcrumbs --> </p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF"><br /><h4>{main.topic}</h4><br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="100" valign="top"><a href="?L=users.profile&id={main.userid}"><img src="system/image.php?file={main.mainpicture}" alt="[Picture {150}]" name="picture" border="0" id="picture" /></a><br>
              <a href="?L=users.profile&id={main.userid}">{main.username}</a></td>
            <td valign="top"><h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {main.date} <img src="{themePath}/images/icons/document.gif" alt="[Icon {140}]" width="16" height="16" hspace="2" align="absmiddle" /> {main.views} <img src="{themePath}/images/icons/comment.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {main.replies}</h6>
              <p>&nbsp;</p>
              <div id="inkspotMainPostBody">
                {main.body}
			  </div>
			</td>
          </tr>
        </table>
            <br>
          <br></td>
        <td width="20" bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
      <tr>
        <td height="10" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
		<ZONE subPostBlock enabled>
		<h6>[{main.replies} replies, {main.views} views for this topic {6705}] <br>
              <br>
           <OBJ bgObjectEven>#FFFFFF</OBJ bgObjectEven>
           <OBJ bgObjectOdd>#F2F5FF</OBJ bgObjectOdd>
          
          <br>
        </h6>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td colspan="2" valign="top" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
              </tr>
			  <LOOP subPostsLoop>
            <tr>
              <td height="5" colspan="2" bgcolor="{sub.bgObject}"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
              </tr>
            <tr>
              <td width="100" valign="top" bgcolor="{sub.bgObject}" style="padding-left:5px;"><a href="?L=users.profile&id={sub.userid}"><img src="system/image.php?file={sub.mainpicture}" alt="[Picture {150}]" name="picture" border="0" id="picture" /></a><br>
              <a href="?L=users.profile&id={sub.userid}">{sub.username}<br>
              <br>
              </a></td>
            <td valign="top" bgcolor="{sub.bgObject}" style="padding-right:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {sub.date}</td>
                    <td align="right">
					{sub.delete}
					<obj deletereply>
					<a href="?L=inkspot.topic&id={this.topic}&page={this.page}&delete={this.id}">Delete</a>
					</obj deletereply>
					</td>
                  </tr>
                </table>
                <p><br>
                  {sub.body} <br>
                  <br>
                </p></td>
            </tr>
            <tr>
              <td height="5" colspan="2" bgcolor="{sub.bgObject}"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
            </tr>
            <tr>
              <td height="1" colspan="2" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td></tr></LOOP subPostsLoop>
          </table>
		  </ZONE subPostBlock enabled>
		  
		  <ZONE subPostBlock noReply>
		  [There is no reply to that thread yet. {6710}]
		  </ZONE subPostBlock noReply>
		  </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="5">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="5">&nbsp;</td>
        <td align="right">

		<ZONE paginationBlock enabled>
		  <ZONE pagination.back disabled>&laquo; [Back {255}]</ZONE pagination.back disabled>
		  <ZONE pagination.back linked><a href="{pagination.back.link}">&laquo; [Back {255}]</a></ZONE pagination.back linked>
		
		  <ZONE pagination.first disabled></ZONE pagination.first disabled>
		  <ZONE pagination.first linked><a href="{pagination.first.link}">1...</a> </ZONE pagination.first linked>
		
		  <OBJ pagination.unlinked.page><strong>{pagination.page.pageNumber}</strong></OBJ pagination.unlinked.page>
		  <OBJ pagination.linked.page> <a href="{pagination.page.link}">{pagination.page.pageNumber}</a> </OBJ pagination.linked.page>
		
		  {pagination.pages}

		  <ZONE pagination.last disabled></ZONE pagination.last disabled>
		  <ZONE pagination.last linked><a href="{pagination.last.link}">...{pagination.last.pageNumber}</a> </ZONE pagination.last linked>

		  <ZONE pagination.next disabled>[Next {260}] &raquo;</ZONE pagination.next disabled>
		  <ZONE pagination.next linked><a href="{pagination.next.link}">[Next {260}]&raquo;</a></ZONE pagination.next linked>
		</ZONE paginationBlock enabled>

		<ZONE paginationBlock disabled>		</ZONE paginationBlock disabled>		</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td height="5">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="5">&nbsp;</td>
        <td colspan="2"><h1><a name="reply"></a>[Post a reply {580}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="5">&nbsp;</td>
        <td>
		<form method="post">
		<textarea name="body" rows="10" class="fullwidth"></textarea>
          <br>
          <input type="submit" name="Submit" value="[Submit {295}]" class="submit">
		  </form>
		  <OBJ chunkHeader>
		    <strong>[... continued from previous post {6715}]</strong>  <br />
		    <br />
		  </OBJ chunkHeader>
		  
		  <OBJ chunkFooter>
		  	<br /><br />
		  	<strong>[This post has been chopped into multiple parts, to be continued ... {6720}] </strong>
		  </OBJ chunkHeader>
		  </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="5">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table><!-- /leftpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->