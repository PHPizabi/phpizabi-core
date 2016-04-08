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
            <td valign="top"><h1>[Event Details {6230}]</h1>
              [Go ahead and  have some fun!&nbsp; Have someone you would  like to share this event with?&nbsp; Use the  refer to a friend option to share the excitement with them! {6235}] <br />
                  <br />                  
                  <!-- breadcrumbs --><a href="?L=events.daily&ut={day.ut}">[Events Today {6240}]</a><!-- /breadcrumbs --></td>
            <td align="right" valign="top"><h1><img src="theme/default/images/icons/headers/calendar_arrow.gif" alt="[Calendar {350}]" width="100" height="100" /></h1>                </td>
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
        <td bgcolor="#DCE6FF" style="padding-right:10px;">
		     
			 
	                     
		     <table width="100%%" border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td><h4>{event.title}</h4></td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td><h6>
			   <img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" />
			   {event.date}
			 </h6></td>
                 <td>&nbsp;</td>
               </tr>
               <tr>
                 <td><p>[Created by <a href="?L=users.profile&amp;id={event.userID}">{event.username}</a> on {event.creationDate} {6250}]</td>
                 <td align="right"><is_mop><a href="?L=events.event&id={event.id}&rm=1">Delete event</a></is_mop></td>
               </tr>
             </table>
		     <p><br>
		       
	         <div class="tabber"> 
              <div class="tabbertab">
                <h2>[Event {495}] </h2>
	            <strong>[Event location: {event.location} {6255}] </strong>
				<br />
				<br />
		  
		  <ZONE eventPicture enabled><img src="system/image.php?file={event.mainpicture}&amp;width=500" alt="[Event Picture {6245}]" name="picture" vspace="5" border="0" align="left" id="picture" /><br />
		  </ZONE eventPicture enabled> 
		  {event.body}
		  
		  </div>
            <div class="tabbertab">
              <h2>[Comments {500}] </h2>
              <ZONE eventCommentsBlock enabled>
		  <LOOP eventComments>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="90" valign="top" class="small">
				  <a href="?L=users.profile&id={comment.userid}">
				    <img src="system/image.php?file={comment.usermainpicture}" alt="[Picture {150}]" name="picture" hspace="4" border="0" id="picture" />				  </a>
				  <br />
                  <a href="?L=users.profile&id={comment.userid}">{comment.username}</a>				</td>
                <td valign="top">
				  <h4> {comment.title}</h4>
			      <h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" />
			        {comment.date}			        </h6>
			      <p>{comment.body}</p>
				  <is_mop>
				    <div style="float:right; clear:none;">
				      <a href="?L=events.event&id={event.id}&rmcomment={comment.id}">Delete</a>
				    </div>
				  </is_mop>
				  </td>
			  </tr>
              <tr>
                <td height="1" colspan="2" valign="top" bgcolor="#6699FF" class="small"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                </tr>
            </table>
		    <br />
		  </LOOP eventComments>
		</ZONE eventCommentsBlock enabled>
		
		<ZONE eventCommentsBlock disabled>
		  [Sorry there is no comment on this event yet. Would you like to be the first one to write a comment? {6260}]	</ZONE eventCommentsBlock disabled>
			</div>
		  </div>

		  
		  <p>&nbsp;</p></td>
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
        <td><h1>[Drop your comment for this event {6265}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5">&nbsp;</td>
        <td height="5"><ZONE writeComment enabled>
	    <form method="post">
	      <table width="100%" border="0" cellpadding="0" cellspacing="3">
            <tr>
              <td valign="top"><strong>[Title: {15}] </strong></td>
              <td colspan="2" valign="top"><input name="title" type="text" id="title" class="fullwidth" /></td>
            </tr>
            <tr>
              <td valign="top"><strong>[Body: {20}] </strong></td>
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
	  </ZONE writeComment enabled>
	  <ZONE writeComment posted>
	    <strong>[Your comment has been successfully posted {40}]</strong>	  </ZONE writeComment posted>
	  <ZONE writeComment guest>
	   <strong>[Sorry, guests can not post comments {45}]</strong>
|	<a href="?L=registration.register">[Register {50}]</a> </ZONE writeComment guest></td>
      </tr>
      <tr>
        <td height="5">&nbsp;</td>
        <td height="5">&nbsp;</td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[Actions {505}] <a href="#"></a></h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td style="background-repeat:no-repeat;"><p><a href="?L=invite.tellafriend&amp;origin={system.origin}">[Tell a friend about this event {6270}]</a> </p>
          </td>
        <td style="background-repeat:no-repeat;">&nbsp;</td>
      </tr>
      <tr>
        <td style="background-repeat:no-repeat;"><h4>&nbsp;</h4>          </td>
        <td style="background-repeat:no-repeat;">&nbsp;</td>
      </tr>
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table><!-- footer --><!-- /footer -->