<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
     <!-- leftpane --> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="25">&nbsp;</td>
          <td colspan="2"><h1>[Search Blogs {2035}]</h1>
            <p>[Looking for a particular subject or topic? Use our search to find exactly what you are looking for. {2040}] </p><!-- breadcrumbs -->
<!-- /breadcrumbs --></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td height="1" colspan="3" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
        </tr>
        <tr>
          <td height="8" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">
		  
		  <ZONE searchCounter enabled>
		  <strong>[Your search produced {count.total} results {2045}]</strong>
		  </ZONE searchCounter enabled>
		  
		  <ZONE searchCounter disabled>
		  </ZONE searchCounter disabled>
		  
		  <ZONE searchCounter noResult>
		  <strong>[Sorry your search produced no result {2046}] </strong></ZONE searchCounter noResult>
		  
		  </td>
        </tr>
        <tr>
          <td height="8" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
        </tr>
        <tr>
          <td colspan="3" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
        <tr>
          <td bgcolor="#DCE6FF">&nbsp;</td>
          <td colspan="2" bgcolor="#DCE6FF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#DCE6FF">&nbsp;</td>
          <td colspan="2" bgcolor="#DCE6FF">
		  <form method="get">
		  <div class="tabber">
            <div class="tabbertab">
              <h2>[Search Blogs {2035}] </h2>
			  <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td colspan="2"><input type="hidden" name="L" value="blogs.search" />
                          <input name="query" type="text" class="fullwidth" id="query" value="{get.query}" /></td>
                  </tr>
                <tr>
                  <td colspan="2" valign="top"><label>
                    <input name="boolean" type="radio" value="or" {boolean.or.checkvalue} />
                    [At least one word {165}] </label>
                          <label>
                            <input name="boolean" type="radio" value="and" {boolean.and.checkvalue} />
                            [All the words {170}] </label>
                          <label>
                            <input name="boolean" type="radio" value="phrase" {boolean.phrase.checkvalue} />
                            [As a phrase {175}] </label></td>
                </tr>
                <tr>
                  <td width="50%" valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top"><p>
                    <input name="Submit" type="submit" id="Submit" value="[Search {300}]" class="submit" />
                  </p>
                          <br></td>
                  <td valign="top">&nbsp;</td>
                </tr>
              </table>
              <p>&nbsp;</p>
            </div>
            <div class="tabbertab">
              <h2>[Advanced {180}] </h2>
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="50%" valign="top"><strong>[Search in</strong> {185}] <br>
                    <label><input name="sin[]" type="checkbox" id="picture" value="title" {sin.title} />
                    [Articles Title {190}] </label>
                    <br/>
                    <label><input name="sin[]" type="checkbox" id="picture" value="body" {sin.body} />
                    [Article Body {195}]</label></td>
				  <td valign="top">
				    <p><strong>[Order by</strong> {220}] <br />
                    <label><input name="order" type="radio" value="natural" {order.natural.checkvalue} /> 
                    [Relevance {200}] </label>
                    <br />
                    <label><input name="order" type="radio" value="date" {order.date.checkvalue} /> 
                    [Article date {205}]</label>
                    <br>
                    <label><input name="order" type="radio" value="views" {order.views.checkvalue} /> 
                    [Most viewed {210}] </label>
                    <br>
                    <label><input name="order" type="radio" value="comments" {order.comments.checkvalue} /> 
                    [Most commented {215}] </label>
                    <br/>
                    <br>
                      <strong>[Direction</strong> {225}] <br>
                    <label><input name="direction" type="radio" value="asc" {direction.asc.checkvalue} /> 
                    [Ascending {230}] </label>
                    <br/>
                    <label><input name="direction" type="radio" value="desc" {direction.desc.checkvalue} /> 
                    [Descending {235}] </label>
                    <br>
                      <br>
                      </p>                    </td>
                </tr>
                <tr>
                  <td valign="top"><p>
                    <input name="submit" type="submit" id="submit" value="[Search {300}]" class="submit" />
                  </p>
                          <br></td>
                  <td valign="top">&nbsp;</td>
                </tr>
              </table>
            </div>
          </div></form></td>
        </tr>
        <tr>
          <td height="2" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
        </tr>
        <tr>
          <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
        <tr>
          <td height="10" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
        </tr>
        <ZONE searchResultsBlock enabled>
		<tr>
		  <td>&nbsp;</td>
          <td><h1>[Your Search Results {240}] </h1></td>
          <td align="right">&nbsp;</td>
        </tr>
        <tr>
          <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
          <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif" bgcolor="#C0FF5E"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">
		  <ZONE searchResults enabled>
		  <LOOP searchResultsLoop>
            <table width="100%" cellpadding="0" cellspacing="3">
              <tr>
                <td colspan="2" valign="top" style="padding-top:5px;" width="80"><a href="?L=users.profile&amp;id={blog.userid}"> <img src="system/image.php?file={blog.mainpicture}" alt="[Picture {150}]" id="picture" /></a><br /><a href="?L=users.profile&amp;id={blog.userid}">{blog.user}</a> </td>
                <td width="100%" valign="top"><h4><a href="?L=blogs.blog&amp;article={blog.id}">{blog.title}</a></h4>
                    <h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.date} <img src="{themePath}/images/icons/comment.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.comments} <img src="{themePath}/images/icons/document.gif" alt="[Icon {140}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.views}</h6>
                  {blog.body}  ... <a href="?L=blogs.blog&amp;article={blog.id}">[Read this article {245}] </a> | <a href="?L=blogs.blog&id={blog.userid}">[User's blog {250}] </a></td>
              </tr>
            </table>
          </LOOP searchResultsLoop>
		  </ZONE searchResults enabled>
		  
		  <ZONE searchResults noResult>
		    <h6>[Sorry your search produced no result {280}] </h6>
		  </ZONE searchResults noResult></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" align="center">
	
	
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
		  <ZONE pagination.next linked><a href="{pagination.next.link}">[Next {260}] &raquo;</a></ZONE pagination.next linked>
		</ZONE paginationBlock enabled>

		<ZONE paginationBlock disabled>		</ZONE paginationBlock disabled>		  </td>
        </tr>
		</ZONE searchResultsBlock enabled>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
      </table><!-- /leftpane -->
    </td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[My Saved Searches {265}] </h1>
              <p>[Make your searching faster and easier by saving your searches for a one click operation. {270}] </p></td>
        <td width="25">&nbsp;</td>
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
        <td><h2>[Popular Searches {275}] </h2></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><p>&nbsp;</p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td height="1" colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->