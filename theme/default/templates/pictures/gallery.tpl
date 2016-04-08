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
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%" valign="top"><img src="system/image.php?file={user.mainpicture}" alt="[My Picture {125}]" name="picture" hspace="5" vspace="2" border="0" id="picture" /></td>
            <td valign="top"><h1>[Welcome to my gallery! {7310}] </h1>
                    <ZONE personalHeader noHeader>
					<p>[Oh! This person has not written anything to place in their personal header. {7315}]  
					<a href="?L=users.myself">[Have you {7320}] </a>? </p>
					</ZONE personalHeader noHeader>
					<ZONE personalHeader printHeader>
					<p>{user.header}</p>
					</ZONE personalHeader printHeader>
                    <!-- breadcrumbs --><a href="?L=users.profile&amp;id={user.id}">{user.username}'s profile</a><!-- /breadcrumbs --></p></td>
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
        <td height="10" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:10px;">
		

            <ZONE shownPictureBlock enabled>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><h4>{shownPicture.title} </h4></td>
                <td align="right" valign="top"><h6>[Ranked {votes.average}/5, {votes.total} vote(s) {7325}] </h6></td>
              </tr>
            </table>
            <p><img src="system/image.php?file={shownPicture.file}&amp;width=470" alt="[Picture {150}]" name="picture" vspace="5" border="0" id="picture" /></p>
            <h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {shownPicture.date} <img src="{themePath}/images/icons/comment.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {shownPicture.comments} comment(s) </h6>
            <p><br />
            {shownPicture.description}</p>
            <p>&nbsp;</p>
			
			  <ZONE castVoteBlock enabled>
			    <div id="voteInt"></div>
				<div id="votewrap" onmouseout="rankEval(0,0);">
				  <div class="voteclear" id="voteObject1" onmouseover="rankEval(1,1);">
				    <a href="?L=pictures.gallery&id={user.id}&pid={shownPicture.id}&vote=1">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				  <div class="voteclear" id="voteObject2" onmouseover="rankEval(1,2);">
					<a href="?L=pictures.gallery&id={user.id}&pid={shownPicture.id}&vote=2">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				  <div class="voteclear" id="voteObject3" onmouseover="rankEval(1,3);">
				    <a href="?L=pictures.gallery&id={user.id}&pid={shownPicture.id}&vote=3">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				  <div class="voteclear" id="voteObject4" onmouseover="rankEval(1,4);">
				    <a href="?L=pictures.gallery&id={user.id}&pid={shownPicture.id}&vote=4">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				  <div class="voteclear" id="voteObject5" onmouseover="rankEval(1,5);">
				    <a href="?L=pictures.gallery&id={user.id}&pid={shownPicture.id}&vote=5">
					  <img src="theme/default/images/frame/spacer.gif" height="10" width="10" />					</a>				  </div>
				</div>
			  </ZONE castVoteBlock enabled>
			  
			  <ZONE castVoteBlock success>
			    [Thank you - Your vote has been cast! {7330}]			  </ZONE castVoteBlock success>
            </ZONE shownPictureBlock enabled>
			
			<ZONE shownPictureBlock noPicture>
			  <strong>[Sorry, {user.username} has uploaded no picture yet. <a href="?L=pictures.upload">Have you? {7335}]</a></strong>		    </ZONE shownPictureBlock noPicture>
		  </td>
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
        <td height="20" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="20" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><h1>[Comments on this picture {7360}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><ZONE pictureCommentsBlock enabled>
          <LOOP pictureComments>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="90" valign="top" class="small"><a href="?L=users.profile&amp;id={comment.userid}"> <img src="system/image.php?file={comment.usermainpicture}" alt="[Picture {150}]" hspace="4" border="0" id="picture" /> </a> <br />
                <a href="?L=users.profile&amp;id={comment.userid}">{comment.username}</a> </td>
                <td valign="top"><h4> {comment.title}</h4>
                    <h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {comment.date} </h6>
                  <p>{comment.body}</p>
				  <is_mop>
				    <div style="float:right; clear:none;">
				      <a href="?L=pictures.gallery&id={user.id}&pid={shownPicture.pid}&rmcomment={comment.id}">Delete</a>
				    </div>
				  </is_mop>
				  </td>
              </tr>
              <tr>
                <td height="1" colspan="2" valign="top" bgcolor="#E5E9EC" class="small"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
              </tr>
            </table>
            <br />
          </LOOP pictureComments>
          </ZONE pictureCommentsBlock enabled>
          <ZONE pictureCommentsBlock disabled>
		    [Sorry there is no comment for this picture yet {7365}] </ZONE pictureCommentsBlock disabled>
		  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><h1>[Drop your comment for this picture {7370}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
		<ZONE writeComment enabled>
          <form method="post">
            <table width="100%" border="0" cellpadding="0" cellspacing="3">
              <tr>
                <td valign="top"><strong>[Title: {15}] </strong></td>
                <td valign="top"><input name="title" type="text" id="title" class="fullwidth" /></td>
              </tr>
              <tr>
                <td valign="top"><strong>[Body: {20}] </strong></td>
                <td valign="top"><textarea name="body" class="fullwidth" rows="5" id="body"></textarea></td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
                <td valign="middle"><input type="submit" name="SubmitComment" value="[Submit {295}]" class="submit" /></td>
                </tr>
            </table>
          </form>
        </ZONE writeComment enabled>
              <ZONE writeComment posted><strong>[Your comment has been successfully posted {7375}]</strong> </ZONE writeComment posted>
              <ZONE writeComment guest><strong>[Sorry, guests can not post comments {45}]</strong> | <a href="?L=registration.register">[Register {305}]</a> </ZONE writeComment guest>
			  <ZONE writeComment noPicture>
			  [Sorry you can not post comments for this gallery yet, this user has no picture {7380}]
			  </ZONE writeComment noPicture>
		  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[More pictures {7340}] </h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td> <h6>[{user.username} has {counter.totalPictures} pictures ({counter.privatePictures} private) in {counter.groups} groups. {7345}]</h6></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>
            <ZONE picturesGroupsBlock enabled>
			
			<LOOP picturesGroups>
			<table width="100%" border="0" cellpadding="0" cellspacing="2">
                <tr>
                  <td height="1" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                </tr>
                <tr>
                  <td><h4><strong>{group.groupName}</strong></h4></td>
                  </tr>
                <tr>
                  <td>{group.picturesSet}
				  <OBJ pictureBox>
				    <div style="float:left;">
					  <a href="?L=pictures.gallery&id={picture.userID}&pid={picture.id}">
					    <img src="system/image.php?file={picture.file}&width=50" alt="[Picture {150}]" hspace="2" border="0" id="picture" /></a>					</div>
					</OBJ pictureBox>					</td>
                  </tr>
            </table>
			</LOOP picturesGroups>
            </ZONE picturesGroupsBlock enabled>
            <ZONE picturesGroupsBlock noGroups>
			[Sorry, {user.username} does not have more pictures and / or groups {7350}]		    </ZONE picturesGroupsBlock noGroups>		  </td>
        <td>&nbsp;</td>
      </tr>

      <tr>
        <td height="15" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="15" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>

      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td>
		  <ZONE selfUserOptions enabled>
		  <h2>[Control your gallery {7385}] </h2>
            <p>
			<a href="?L=pictures.pictures">[Manage Gallery {7355}]</a><br />
            <a href="?L=pictures.upload">[Upload Pictures {645}]</a><br />
            </p>
		  </ZONE selfUserOptions enabled>          </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->
