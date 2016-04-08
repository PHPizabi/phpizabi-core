<!-- header --><!-- /header -->
<ZONE main desktop>
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
        <td colspan="2">
		  <ZONE notifications newContact>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><h1>[You have contacts! {7820}] </h1>
                  <p>[{me.username} you have {notification.count} pending contact request(s). Please click the &quot;My Contacts&quot; link to go to your contact management page where you can accept or deny the new request(s). {7825}]</p>
                  <p>&nbsp;</p>
                  <p><a href="?L=contacts.contacts">[My Contacts {345}]</a> </p></td>
              <td width="20" valign="top">&nbsp;</td>
              <td valign="top"><img src="theme/default/images/icons/headers/contact_notification.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
            </tr>
          </table>
		  </ZONE notifications newContact>
		  <ZONE notifications newMail>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><h1>[You have mail! {7830}] </h1>
                  <p>[{me.username} you have received {mails.counter} new message(s). To view your new message(s) please click the &quot;My Inbox&quot; link to go to your inbox. {7835}] </p>
                  <p>&nbsp;</p>
                  <p><a href="?L=mails.mails">[My Inbox {525}] </a></p></td>
              <td width="20" valign="top">&nbsp;</td>
              <td valign="top"><img src="theme/default/images/icons/headers/mail_notification.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
            </tr>
          </table>
		  </ZONE notifications newMail>
		  <ZONE notifications noPicture>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><h1>[You don't have a picture! {7840}]</h1>
                  <p>[By uploading a picture of yourself, you will receive many more profile views than those without a picture. Click the &quot;Upload Pictures&quot; link to upload a picture now! {7850}] </p>
                  <p>&nbsp;</p>
                  <p><a href="?L=pictures.upload">[Upload Pictures {7845}] </a></p></td>
              <td width="20" valign="top">&nbsp;</td>
              <td valign="top"><img src="theme/default/images/icons/headers/nopicture_notification.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
            </tr>
          </table>
		  </ZONE notifications noPicture>
		  <ZONE notifications default>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><h1>[Welcome to your desktop {7855}] </h1>
                  <p>[{me.username} Your desktop is your centralized location for receiving new mail notices, contact requests, nudges and much more. It is also where you will find links to your overall preferences and settings, making your time with us as pleasant and rewarding as possible. {7860}] <br />
                  </p>
                <p>&nbsp;</p></td>
              <td width="20" valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
            </tr>
          </table>
		  </ZONE notifications default></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><!-- breadcrumbs --><a href="?L=users.settings">[My Settings {7865}] </a> | <a href="?L=users.myself">[Myself {7870}] </a> | <a href="?L=users.profile&amp;id={me.id}">[My Profile {530}] </a> | <a href="?L=blogs.blog&amp;id={me.id}">[My Blog {7875}] </a> | <a href="?L=blogs.write">[Write Blog {7880}] </a> | <a href="?L=comments.usercomments&amp;id={me.id}">[Comments {500}] </a> | <a href="?L=mails.mails">[Mails {7885}] </a><!-- /breadcrumbs --></td>
        <td>&nbsp;</td>
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
        <td bgcolor="#DCE6FF"><h1>[My Contacts {345}] </h1>
          <ZONE contactsNotification enabled>
		  <p><strong>[You have {notification.count} pending contact requests! {7890}] </strong></p>
          </ZONE contactsNotification enabled>
		  
          <p>[{contacts.userCount} contact(s) ({contacts.onlineCount} online) in {contacts.groupCount} group(s) {7895}] | <a href="?L=contacts.contacts">[Manage my contacts {7900}] </a></p></td>
        <td width="20" bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td height="6" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
        </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF">
		  <div class="tabber"> 
	        <ZONE contactsTabsZone contactsTabEnabled>
			<LOOP contactsTabs>
              <div class="tabbertab">
                <h2>{tabName} ({userCount})</h2>
                <p>{tabContent}</p>
              </div>
            </LOOP contactsTabs>
	        <p style="clear:both;">&nbsp;</p>
			</ZONE contactsTabsZone contactsTabEnabled>
			
			<ZONE contactsTabsZone contactsTabNoGroup>
			  [Sorry you have no groups and/or contacts {7905}]
			</ZONE contactsTabsZone contactsTabNoGroup>

            <OBJ noContact><strong>[This group contains no contact {7910}]</strong></OBJ noContact>

			<OBJ userBlock>
			  <div style="float:left; clear:none; padding-bottom: 10px;">
                <a href="?L=users.profile&amp;id={id}">
                  <img src="system/image.php?file={mainpicture}" alt="[Picture {150}]" hspace="2" border="0" id="picture" /></a>
                <br />
              <p><a href="?L=users.profile&amp;id={id}">{username}</a></p></div>
            </OBJ userBlock>
			
			<OBJ onlineUserBlock>
			  <div style="float:left; clear:none; padding-bottom: 10px;">
                <a href="?L=users.profile&amp;id={id}">
                  <img src="system/image.php?file={mainpicture}" alt="[Picture {150}]" hspace="2" border="0" id="picture" /></a>
                <br />
                <p><img src="theme/default/images/icons/status/online_mini.gif" width="10" height="10" align="baseline" /> 
			  <a href="?L=users.profile&amp;id={id}"><strong>{username}</strong></a></p></div>
            </OBJ onlineUserBlock>
          </div>		  </td>
        <td width="20" bgcolor="#DCE6FF">&nbsp;</td>
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
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><h1>[My Favorite Blogs {7915}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif" bgcolor="#C0FF5E"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">
		  <ZONE favoriteBlogs enabled>
		  <LOOP favoriteBlogsList>
	        <table width="100%" cellpadding="0" cellspacing="3">
	          <tr>
	            <td colspan="2" valign="top" style="padding-top:5px;" width="80">
	              <a href="?L=users.profile&amp;id={blog.userid}">
	                <img src="system/image.php?file={blog.mainpicture}" alt="[Picture {150}]" id="picture" /></a><br />
	            <a href="?L=users.profile&amp;id={blog.userid}">{blog.user}</a>	            </td>
	            <td valign="top">	    
	              <a href="?L=blogs.blog&amp;article={blog.id}">
	              <h4>{blog.title}</h4></a>
	              <h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" />  {blog.date} <img src="{themePath}/images/icons/comment.gif" alt="" width="16" height="16" hspace="2" align="absmiddle" /> {blog.comments} <img src="{themePath}/images/icons/document.gif" alt="[Icon {140}]" width="16" height="16" hspace="2" align="absmiddle" /> {blog.views}</h6>
                  {blog.body}  ... 
	              <a href="?L=blogs.blog&amp;article={blog.id}">[Read this article {245}] </a> | <a href="?L=blogs.blog&id={blog.userid}">[User's blog {7920}]</a>
				</td>
              </tr>
	        </table>
          </LOOP favoriteBlogsList>
		  </ZONE favoriteBlogs enabled>
		  
		  <ZONE favoriteBlogs noFavorite>
		    <strong>[You do not have any favorite blog yet {7925}] </strong> <br />
			[You may add blogs to your favorites by clicking the "add to favorites" link on any blog on this website! {7930}]
		  </ZONE favoriteBlogs noFavorite>
		  </td>
      </tr>
      <tr>
        <td height="20" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="20" /></td>
      </tr>
      
	  <ZONE nudges block>
	  <tr>
        <td>&nbsp;</td>
        <td colspan="2"><h1>[Notifications {7935}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">

		  <table width="100%" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td valign="top"><h4>[You got nudges! {7940}] </h4></td>
              <td align="right" valign="top"><a href="?L=users.desktop&clearnudges=1">[Clear All {7945}]</a></td>
            </tr>
            <tr>
              <td colspan="2" valign="top">
                <LOOP nudge>
				  <div style="clear:both;">
				    <img src="system/cache/images/nudges/{nudge.icon}" alt="" hspace="2" vspace="2" border="0" align="absmiddle" />
                    <a href="?L=users.profile&amp;id={nudge.user}">{nudge.body}</a>
				    <br />
				  </div>
				</LOOP nudge>
			  </td>
            </tr>
          </table>

	    </td>
      </tr>
	  <tr>
        <td height="20" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="20" /></td>
        </tr>
      <tr>
      </ZONE nudges block>
	  
        <td>&nbsp;</td>
          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><h1>[Today {7950}] </h1></td>
                <td align="right"><h6>{today.date}</h6></td>
              </tr>
            </table></td>
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
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h4>[My Horoscope {7955}] </h4></td>
          </tr>
          <tr>
            <td>{today.horoscope}</td>
          </tr>
        </table>
          <br />
          <ZONE blogsToday enabled>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><h4>[New Blogs {7960}] </h4></td>
            </tr>
            <tr>
              <td>
			    <LOOP blogsTodayLoop>
			      <div style="clear:both; padding-bottom:4px; padding-top:3px; border-bottom: solid 1px #E5E9EC; height:28px;">
				    <a href="?L=users.profile&id={blog.userid}">
				      <img src="system/image.php?file={blog.mainpicture}&amp;width=30" name="picture" hspace="2" border="0" align="left" id="picture" /></a>
					  <a href="?L=blogs.blog&amp;article={blog.id}">{blog.title}</a>
					  <h5>[Blog article by <a href="?L=users.profile&id={blog.userid}">{blog.username}</a> posted at {blog.time} (~{blog.words} words) {7965}]</h5>
			      </div>
                </LOOP blogsTodayLoop>
			  </td>
            </tr>
          </table>
		  <br />
          </ZONE blogsToday enabled>
          <ZONE commentsToday enabled>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><h4>[New Comments on your Profile {7970}] </h4></td>
            </tr>
            <tr>
              <td><LOOP commentsTodayLoop>
                <div style="clear:both; padding-bottom:4px; padding-top:3px; border-bottom: solid 1px #E5E9EC; height:28px;"> 
                  <a href="?L=users.profile&amp;id={comment.userid}"> <img src="system/image.php?file={comment.mainpicture}&amp;width=30" name="picture" hspace="2" border="0" align="left" id="picture" /></a>
				  
				    &laquo; <em>{comment.body}</em> &raquo;
					<h5>[Comment by <a href="?L=users.profile&amp;id={comment.userid}">{comment.username}</a> posted at  {comment.time} {7975}] <br />
					</h5>
                  
                </div>
              </LOOP commentsTodayLoop>              </td>
            </tr>
          </table>
		  </ZONE commentsToday enabled>
          <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" style="background-repeat:no-repeat;">
		  <a href="?L=users.profile&amp;id={me.id}"><img src="system/image.php?file={me.mainpicture}&amp;width=260" alt="[My Picture {125}]" name="picture" hspace="2" vspace="2" border="0" id="picture" /></a><br />
		  <br />		  
		  <img src="{themePath}/images/icons/icon_link.gif" alt="Bullet" width="9" height="11" align="baseline" /> [You have {pictures.total} picture(s), {pictures.private} private {7980}]<br />
	      <a href="?L=pictures.pictures">[Manage {780}]</a> | 
		  <a href="?L=pictures.upload">[Upload {775}]</a> | 
		  <a href="?L=pictures.gallery&amp;id={me.id}">[My Gallery {770}]</a></td>
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
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h2>[My Events {785}] </h2></td>
            <td align="right"><h4>{calendar.month}</h4></td>
          </tr>
        </table></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td>{calendar}</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><h2>[Next 5 events: {7985}]</h2>
          <p>
		  <LOOP nextEvents><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" hspace="2" align="absmiddle" /><a href="?L=events.event&amp;id={event.id}">{event.date}: {event.title}</a><br />
		  </LOOP nextEvents>
		  </p>
          <p> <a href="?L=events.create"><br />
            [Create an event {7990}]</a></p></td>
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
        <td><h2>[Site News {7995}] </h2>
          <ZONE siteNews enabled>
		    <LOOP siteNewsLoop>
		  	  <h6>&nbsp;</h6>
			  <strong> <img src="{themePath}/images/icons/comment.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {news.title}</strong> <img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {news.date}<br />
			  {news.body}
			  <br /><br />
		    </LOOP siteNewsLoop>
          </ZONE siteNews enabled>
		  
		  <ZONE siteNews noNewsArticle>
		    [No news article to show {8000}]		  </ZONE siteNews noNewsArticle>		</td>
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
        <td><h2>[Recent Profile Views {8005}]</h2>
          
		  <ZONE profileViews noViews>
            <h6>[Sorry nobody saw your profile so far {8010}] </h6>
          </ZONE profileViews noViews>
          <ZONE profileViews enabled>
		  	<h6>[{views.total} people have viewed your profile {8015}]</h6>
            <br />
			<LOOP profileViewsList>
			  <div style="clear:both; padding-bottom:4px; padding-top:3px; border-bottom: solid 1px #E5E9EC; height:28px;">
				<a href="?L=users.profile&id={view.id}">
				  <img src="system/image.php?file={view.mainpicture}&width=30" hspace="2" border="0" id="picture" align="left" /></a>
				<a href="?L=users.profile&id={view.id}">
				  {view.username}</a>, {view.gender}, {view.age}y <h5>{view.date}</h5></div>
            </LOOP profileViewsList>
          </ZONE profileViews enabled>
			<br /></td>
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
        <td><h2>[My Ranking {8020}] </h2>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="98"><table width="92" height="98" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td align="center" valign="middle" background="{themePath}/images/icons/rating.gif"><h1>{votes.average}/5</h1></td>
                  </tr>
                </table></td>
              <td><p>[You have gotten <strong>{votes.total}</strong> votes with an average ranking of <strong>{votes.average}/5 {8025}]</strong>.</p></td>
            </tr>
          </table>          </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <ZONE savedSearchesBlock enabled>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>
          <td height="1" colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
          </tr>
        <tr>
          <td height="8"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><h2>[My Saved Searches {265}] </h2>
            <LOOP favoriteSearches>
			<p><a href="{search.get}">{search.name}</a></p>
			</LOOP favoriteSearches>			</td>
          <td width="28">&nbsp;</td>
        </tr>
      </table>
      </ZONE savedSearchesBlock enabled>
      <p>&nbsp;</p>
	  <!-- /rightpane --></td>
  </tr>
</table>
</ZONE main desktop>
<!-- footer --><!-- /footer -->

<!-- Not logged in -->
<ZONE main nouser>
  <strong>[Sorry guests can't access this page. {405}]</strong>
</ZONE main nouser>


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