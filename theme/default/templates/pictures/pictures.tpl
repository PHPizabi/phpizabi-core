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
            <td valign="top"><h1>[Gallery Management {7390}] </h1>
                <p>[Would you like to upload a new picture, update, edit or delete an existing one? Or maybe you would like to put a fresh face on your profile for the world to see. {7395}] <br />                  
                  <br />  
                  <br />  
                  <!-- breadcrumbs --><a href="?L=pictures.upload">[Upload pictures {645}]</a><!-- /breadcrumbs --></p>
                <a href="?L=mails.write"></a></td>
            <td width="20" valign="top">&nbsp;</td>
            <td align="right" valign="top"><img src="theme/default/images/icons/headers/gallery_control.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
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
		
		<ZONE pictures enabled>
		<LOOP piclist>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="1%" rowspan="6" valign="top">
			  <a href="?L=pictures.edit&amp;id={picture.id}"> 
			    <img src="system/image.php?file={picture.file}" name="picture" hspace="3" border="0" id="picture" /> 
			  </a>
			</td>
            <td colspan="2" valign="top"><h6>{picture.title}</h6></td>
            </tr>
          <tr>
            <td colspan="2" valign="top">{picture.description}</td>
            </tr>
          <tr>
            <td colspan="2" valign="top"><strong>[In library: {picture.library} {7400}]</strong><br /></td>
            </tr>
          <tr>
            <td valign="top"><OBJ mainPicture><strong>This is your main picture </strong></OBJ mainPicture>{picture.mainPicture}</td>
            <td valign="top"><OBJ privatePicture><strong>Picture is private</strong></OBJ privatePicture>{picture.privatePicture}</td>
          </tr>
          <tr>
            <td colspan="2" valign="top">&nbsp;</td>
            </tr>
          <tr>
            <td colspan="2" valign="top"><a href="?L=pictures.edit&amp;id={picture.id}">[Edit this picture {7405}]</a>
			<OBJ removePicture>| <a href="?L=pictures.pictures&rm={picture.id}">[Remove this picture {7410}]</a> | <a href="?L=pictures.pictures&main={picture.id}">[Make main {7415}]</a></OBJ removePicture>{picture.removePicture}</td>
            </tr>
          
          <tr>
            <td valign="top">&nbsp;</td>
            <td colspan="2" valign="top">&nbsp;</td>
          </tr>
        </table>
		</LOOP piclist>
		</ZONE pictures enabled>
		
		<ZONE pictures empty>
		[You have to upload pictures before you can use this tool {7416}]
		</ZONE pictures empty>
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
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table><!-- footer --><!-- /footer -->