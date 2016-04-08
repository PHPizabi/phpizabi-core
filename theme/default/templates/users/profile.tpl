<zone main enabled>
<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top"><!-- leftpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="1%" valign="top"><img src="system/image.php?file={user.mainpicture}" alt="[My Picture {125}]" name="picture" hspace="5" vspace="2" border="0" id="picture" /></td>
                  <td valign="top">
				    <h1>[Welcome to my profile! {8195}] </h1>
					<ZONE personalQuote noQuote></ZONE personalQuote noQuote>
					<ZONE personalQuote printQuote>
					<h4>{user.quote}</h4>
					</ZONE personalQuote printQuote>
					
                    <ZONE personalHeader noHeader>
					<p>[Oh! This person has not written anything to place in their personal header. {8200}] 
					<a href="?L=users.myself">[Have you {8205}]</a>? </p>
					</ZONE personalHeader noHeader>
					<ZONE personalHeader printHeader>
					<p>{user.header}</p>
					</ZONE personalHeader printHeader><!-- breadcrumbs -->
<!-- /breadcrumbs --></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">
				  <ZONE mypage enabled></ZONE mypage enabled></td>
                </tr>
              </table>          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
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
        <td bgcolor="#DCE6FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><h1>[Me, Myself, I! {8210}] </h1>
                  <h6>[{user.username}, {user.gender}, {user.age} Years old {8215}] </h6></td>
                  <td align="right">{online.object}
				  <OBJ online>
		            <img src="{themePath}/images/icons/status/onlinelargeblue.gif" alt="[Online {425}]" title="Online" />
		          </OBJ online>
				</td>
              </tr>
              </table></td>
        <td bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td height="6" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right: 5px;">
		<div class="tabber">
     <div class="tabbertab">
	  <h2>[Profile {445}]</h2>
	  <p>{profiledata}</p>
	  
	  <OBJ questionaire>
	  <br />
	  <h4>{title}</h4>
	  </OBJ questionaire>
	  <OBJ wrappedQuestionAnswer>
	  <table width="100%" border="0" cellspacing="3" cellpadding="0">
        <tr>
          <td valign="top"><strong>{question}?</strong></td>
          </tr>
        <tr>
          <td valign="top">{answer}</td>
          </tr>
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
      </table>
	  </OBJ wrappedQuestionAnswer>

	  <OBJ inlineQuestionAnswer>
	  <table width="100%" border="0" cellspacing="3" cellpadding="0">
        <tr>
          <td width="50%" valign="top"><strong>{question}?</strong></td>
          <td width="50%" valign="top">{answer}</td>
        </tr>
        <tr>
          <td colspan="2" valign="top">&nbsp;</td>
          </tr>
      </table>
	  </OBJ inlineQuestionAnswer>
     </div>

	<ZONE contactsTab enabled>
	 <div class="tabbertab">
	  <h2>[Contacts {8220}]</h2>
	    <LOOP contactEntity>
	      <div style="float:left;">
            <a href="?L=users.profile&id={contact.id}">
              <img src="system/image.php?file={contact.mainpicture}" alt="[Picture {150}]" hspace="2" border="0" id="picture" />			</a>
            <br />
            <a href="?L=users.profile&id={contact.id}">{contact.username}</a>		  </div>
	    </LOOP contactEntity>

		<ZONE addtocontactstab enabled>
		<a href="?L=contacts.adduser&id={user.id}">[Add {user.username} to my contacts list {8225}]</a>		</ZONE addtocontactstab enabled>
     </div>
	</ZONE contactsTab enabled>
	
	<ZONE usersCommentsTab enabled>
	  <div class="tabbertab">
	  <h2>[Comments {500}]</h2>
	  <p>[{user.username} received {comments.getCount} comments and sent {8230}] <span class="small"> {comments.postCount} </span>[for others | {8235}] <a href="?L=comments.usercomments&amp;id={user.id}">[View all comments {8240}]</a></p>
	  <p>&nbsp;</p>
	  <LOOP userComments>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="90" valign="top" class="small"><a href="?L=users.profile&amp;id={comment.userid}"><img src="system/image.php?file={comment.mainpicture}" alt="[Picture {150}]" name="picture" hspace="5" border="0" id="picture" /></a><br />
                <a href="?L=users.profile&amp;id={comment.userid}">{comment.username}</a></td>
              <td valign="top"><h4> {comment.title}</h4>
                  <h6><img src="{themePath}/images/icons/date.gif" alt="Date" width="16" height="16" hspace="2" align="absmiddle" /> {comment.date} </h6>
                <p>{comment.body}</p>
				  <is_mop>
				    <div style="float:right; clear:none;">
				      <a href="?L=users.profile&id={user.id}&rmcomment={comment.id}">Delete</a>
				    </div>
				  </is_mop>
				</td>
            </tr>
            <tr>
              <td height="1" colspan="2" valign="top" bgcolor="#AEC9FF" class="small"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
            </tr>
          </table>
		  <br />
		<br />
        </LOOP userComments>
		<br />
		<p>[{user.username} received {comments.getCount} comments and sent {8245}]  <span class="small"> {comments.postCount} </span>for others | <a href="?L=comments.usercomments&amp;id={user.id}">View all comments</a> </p>
	  </div>
    </ZONE usersCommentsTab enabled>
    </div>	</td>
        <td bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td height="2" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td height="20" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="20" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><h1>[Latest Blog Article by {user.username} {8250}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif" bgcolor="#C0FF5E"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">
		  <ZONE latestBlogArticle enabled>
          <table width="100%" cellpadding="0" cellspacing="3">
            <tr>
              <td valign="top" style="padding-top:5px;"><a href="?L=blogs.blog&article={blog.id}">
                <h4>{blog.title}</h4>
                </a>
                      <h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.date} <img src="{themePath}/images/icons/comment.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.comments} <img src="{themePath}/images/icons/document.gif" alt="[Icon {140}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.views}</h6>
                  {blog.body}  ... <a href="?L=blogs.blog&article={blog.id}">[Read this article {8255}]</a> | <a href="?L=blogs.blog&id={user.id}">[User's blog {8260}]</a> </td>
              </tr>
          </table>
		  </ZONE latestBlogArticle enabled>
		  
		  <ZONE latestBlogArticle noArticle>
		  [Sorry, {user.username} has no blog article yet. {8265}]		  </ZONE latestBlogArticle noArticle>	 </td>
      </tr>
      <tr>
        <td height="20" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="20" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><h1>[Drop your comment for this profile {8270}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">
		<ZONE postComment success>
		<h2>[Success! {315}]</h2>
		<p>[Your comment has been successfully saved. Thank you! {8275}]</p>
		</ZONE postComment success>
		
		<ZONE postComment enabled>
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
          <td valign="middle"><input type="submit" name="SubmitComment" value="[Submit {295}]" class="submit" /></td>
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
	  </ZONE postComment enabled>
	  <ZONE postComment guest>
	    [Sorry, guests can not post comments {45}] | <a href="?L=registration.register">[Register {50}]</a>	  </ZONE postComment guest>	  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>{user.username}</h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">
		  <ZONE onlinecheck online>[Online since {onlinesince} {8280}]</ZONE onlinecheck online>
	      <ZONE onlinecheck offline>[Last logged in on {lastlogin} {8285}]</ZONE onlinecheck offline>
		  <ZONE onlinecheck nologin>[Never logged in {8290}]</ZONE onlinecheck nologin>		</td>
      </tr>
      <tr>
        <td colspan="2" style="background-repeat:no-repeat;"><a href="?L=pictures.gallery&amp;id={user.id}"><img src="system/image.php?file={user.mainpicture}&amp;width=260" alt="[Me! {8410}]" name="picture" vspace="5" border="0" class="picture" id="picture" /></a><a href="?L=users.profile&amp;id={me.id}"></a><br />
          <img src="{themePath}/images/icons/icon_link.gif" alt="Bullet" width="9" height="11" align="baseline" /> [{pictures.count} pictures, {pictures.privatecount} private | {8295}]<a href="?L=pictures.gallery&amp;id={user.id}">[View Gallery {8300}] </a></td>
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
        <td><h2>[Keep in touch {8305}] </h2></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		<ZONE top_notice guest>
		  <span class="text_redNotice">[You are a guest user, some options are disabled {8310}]</span> 
		  <span class="text_grayNotice">&middot; <a href="?L=registration.register">[Register {50}]</a></span><br /></ZONE top_notice guest>
		
	    <ZONE top_notice self>
		  <span class="text_redNotice">[This is your own profile page, some options are disabled {8315}]</span><br />
		</ZONE top_notice self>
		
		<ZONE addToContacts enabled>
	  	  <a href="?L=contacts.adduser&id={user.id}">[Add {user.username} to my contacts list {8320}]</a><br />
		</ZONE addToContacts enabled>
		
		<ZONE addToBlock enabled>
		  <a href="?L=contacts.block&id={user.id}">[Block {user.username} from contacting me {8325}]</a><br />
		</ZONE addToBlock enabled>
		
		<ZONE addToBlock unBlock>
		  <a href="?L=contacts.unblock&id={user.id}">[UnBlock {user.username} from contacting me {8330}]</a><br />
		</ZONE addToBlock unBlock>
		
		<a href="?L=mails.write&to={user.username}">[Send {user.username} a new message {8335}]</a><br />
		<a href="?L=interact.page&id={user.id}">[Page {user.username} {8340}]</a> <br /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td height="1" colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td><h2>[Rate me! {8345}]</h2>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top">
			  
			  <ZONE castVoteBlock enabled>
			  [Move your mouse over the slider - click to submit your vote {8350}]<br />
               
			    <div id="voteInt"></div>
				<div id="votewrap" onmouseout="rankEval(0,0);">
				  <div class="voteclear" id="voteObject1" onmouseover="rankEval(1,1);">
				    <a href="?L=users.profile&id={user.id}&vote=1">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				  <div class="voteclear" id="voteObject2" onmouseover="rankEval(1,2);">
					<a href="?L=users.profile&id={user.id}&vote=2">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				  <div class="voteclear" id="voteObject3" onmouseover="rankEval(1,3);">
				    <a href="?L=users.profile&id={user.id}&vote=3">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				  <div class="voteclear" id="voteObject4" onmouseover="rankEval(1,4);">
				    <a href="?L=users.profile&id={user.id}&vote=4">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				  <div class="voteclear" id="voteObject5" onmouseover="rankEval(1,5);">
				    <a href="?L=users.profile&id={user.id}&vote=5">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				</div>
			  </ZONE castVoteBlock enabled>
			  
			  <ZONE castVoteBlock success>
			    [Thank you - Your vote has been cast! {8355}]			  </ZONE castVoteBlock success>			</td>
              <td width="98" valign="top"><table width="92" height="98" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center" valign="middle" background="{themePath}/images/icons/rating.gif"><h1>{votes.average}/5</h1></td>
                  </tr>
                </table></td>
            </tr>
          </table>          
          <h6>[{user.username} got <strong>{votes.total}</strong> votes with an average ranking of <strong>{votes.average}/5 {8360}]</strong></h6>          </td>
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
        <td>
        <h2>[Send a Nudge {8365}]</h2>
		<ZONE nudges block>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
              <ZONE nudge nudges>
                <LOOP nudge>
		<a href="?L=users.profile&amp;id={user.id}&amp;nudge={nudge.id}"><img src="system/cache/images/nudges/{nudge.icon}" alt="{nudge.title}" title="{nudge.title}" hspace="2" vspace="2" border="0" /></a></LOOP nudge>
              </ZONE nudge nudges>
              <ZONE nudge sent>
                <h6>[You just sent a nudge {8370}]</h6>
              </ZONE nudge sent>		</td>
        </tr>
        </table>
	  </ZONE nudges block>
	  <ZONE nudges guest>
	    [Sorry, guests can not send nudges {8375}] | <a href="?L=registration.register">[Register {305}]</a>	  </ZONE nudges guest></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td height="1" colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td>
			<h2>[Recent Profile Views {8380}]</h2>
          
		  <ZONE profileViews noViews>
            <h6>[Sorry nobody saw this profile so far {8385}]</h6>
          </ZONE profileViews noViews>
          <ZONE profileViews enabled>
		  	<h6>[{views.total} people have viewed this profile {8390}]</h6>
            <br />
			<LOOP profileViewsList>
			  <div style="clear:both; padding-bottom:4px; padding-top:3px; border-bottom: solid 1px #E5E9EC; height:28px;">
				<a href="?L=users.profile&id={view.id}">
				  <img src="system/image.php?file={view.mainpicture}&width=30" hspace="2" border="0" id="picture" align="left" />				</a>
				<a href="?L=users.profile&id={view.id}">
				  {view.username}</a>, {view.gender}, {view.age}y <h5>{view.date}</h5></div>
            </LOOP profileViewsList>
          </ZONE profileViews enabled>
			<br />		</td>
        <td>&nbsp;</td>
      </tr>
	  <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td height="1" colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td><h2>[Geographic Localisation {8395}] </h2>          </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		[{user.username} is living in {user.city} {user.state} {distance} <ZONE distanceLabel miles>miles</ZONE distanceLabel miles><ZONE distanceLabel kilometers>kilometers</ZONE distanceLabel kilometers> away from you. {8400}]
		<a accesskey="h" href="http://www.google.com/maps?f=q&amp;hl=en&amp;q={map.data}" target="_blank">[Map this {8405}]</a> </td>
        <td>&nbsp;</td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->
</zone main enabled>
<zone main disabled>Sorry this user does not exist or is not activated</zone main disabled>