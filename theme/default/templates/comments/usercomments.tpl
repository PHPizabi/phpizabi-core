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
            <td valign="top"><a href="?L=users.profile&amp;id={user.id}"><img src="system/image.php?file={user.mainpicture}" alt="My Picture" name="picture" hspace="2" vspace="2" border="0" id="picture" /></a></td>
            <td valign="top"><h1>[{user.username}'s profile comments {4000}] </h1>
                  [{user.username}  has written {count.sent} comments on members profiles, and has received {count.received}  comments.&nbsp; See what others are saying  about {user.username} and what {user.username} is saying to {siteName} members! {4005}] <br />
                    <br />
                    <!-- breadcrumbs --><a href="?L=users.profile&amp;id={user.id}">[{user.username}'s profile {4010}]</a><!-- /breadcrumbs --></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td height="6" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:10px;"><div class="tabber">
         <zone usercomments enabled> <div class="tabbertab">
            <h2>[Received {4015}]</h2>
            <strong>[Comments left for {user.username} {4020}] <br />
            </strong><br />
            <LOOP usercomments>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="90" valign="top" style="padding-right:10px;"><a href="?L=users.profile&amp;id={comment.userid}"> <img src="system/image.php?file={comment.mainpicture}" alt="[Picture {150}]" border="0" id="picture" /> </a> <br />
                    <a href="?L=users.profile&amp;id={comment.userid}">{comment.username}</a> </td>
                  <td valign="top"><h4> {comment.title}</h4>
                      <h6><img src="{themePath}/images/icons/date.gif" alt="Date" width="16" height="16" hspace="2" align="absmiddle" /> {comment.date} </h6>
                    <p>{comment.body}<br />
                      <br />
                    </p>
					<is_mop>
				      <div style="float:right; clear:none;">
				        <a href="?L=comments.usercomments&id={user.id}&rmcomment={comment.id}">Delete</a>
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
            </LOOP usercomments>
          </div></zone usercomments enabled>
          <zone usercomments2 enabled><div class="tabbertab">
            <h2>[Sent {4025}] </h2>
            <strong>[Comments submitted by {user.username} for other users {4030}]</strong> <br />
            <br />
            <LOOP usercomments2>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="90" valign="top" style="padding-right:10px;">
				    <a href="?L=users.profile&amp;id={comment.userid}"> 
					  <img src="system/image.php?file={comment.mainpicture}" alt="[Picture {150}]" border="0" id="picture" />					</a>
					<br />
                    <a href="?L=users.profile&amp;id={comment.userid}">{comment.username}</a>				  </td>
                  <td valign="top">
				    <h4>{comment.title}</h4>
                    <h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" hspace="2" align="absmiddle" /> 
				    [{comment.date} | Left for {comment.username} {4035}]</span>				    </h6>
                    <p>{comment.body}<br />
                      <br />
                    </p>
					<is_mop>
				      <div style="float:right; clear:none;">
				        <a href="?L=comments.usercomments&id={user.id}&rmcomment={comment.id}">Delete</a>
				      </div>
				    </is_mop></td>
                </tr>
                <tr>
                  <td height="1" colspan="2" valign="top" bgcolor="#AEC9FF">
				    <img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" />				  </td>
                </tr>
              </table>
              <br />
              <br />
            </LOOP usercomments2>
          </div>  </zone usercomments2 enabled>
        </div></td>
      </tr>
      <tr>
        <td height="10" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
      </tr>
      <tr>
        <td height="2" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table>
<!-- footer --><!-- /footer -->