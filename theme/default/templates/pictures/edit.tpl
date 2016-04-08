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
            <td valign="top"><h1>[Edit Picture {7255}] </h1>
              [Would you like to add or edit your pictures description or change the pictures title? You may do so by entering or editing the information below. {7260}]<br />
              <br /><!-- breadcrumbs -->
              <a href="?L=pictures.upload">[Upload Pictures {645}]</a> | <a href="?L=pictures.pictures">[Manage Pictures {650}] </a><!-- /breadcrumbs -->

              <p>&nbsp;</p>
              <a href="?L=mails.write"></a></td>
            <td width="20" valign="top">&nbsp;</td>
            <td align="right" valign="top"><img src="theme/default/images/icons/headers/gallery_control.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
          </tr>
        </table>
        </td>
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
		  <form method="post">
		  <table width="100%" border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td width="1%" rowspan="5" valign="top">
			    <img src="system/image.php?file={picture.file}" name="picture" hspace="3" border="0" id="picture" />			  			</td>
            <td valign="top">[Title: {15}] </td>
            <td valign="top"><input name="title" type="text" id="title" value="{picture.title}" class="fullwidth" /></td>
          </tr>
          <tr>
            <td valign="top">[Description: {655}] </td>
            <td valign="top"><textarea name="description" rows="6" class="fullwidth" id="description">{picture.description}</textarea></td>
          </tr>
          <tr>
            <td valign="top">[Move to: {7265}] </td>
            <td valign="top"><p>[...one of your libraries: {7270}] <br />
                  <select name="move" id="move">
                      <option value="" selected="selected">[Move from {picture.library} {7275}]</option>
                      <option value="SYSTEM_ROOT">[...to Main Library {7280}]
					  <LOOP libraryItems>
                        <option value="{library.item}">[...to {library.item} {7285}]
                          <OBJ mainLibrary>[Main Library {7290}]</OBJ mainLibrary>
                          </option>
                      </LOOP libraryItems>
                      </select>
                <br />
                [
                ...a new library: {7295}]
                <br />
                <input name="newLibrary" type="text" id="newLibrary" class="fullwidth" />
            </p>
              </td>
          </tr>
          <tr>
            <td colspan="2" valign="top">
              <ZONE makePrivate enabled>
			    <label>
			      <input name="private" type="checkbox" id="private" value="1" {picture.private} />
				  [Make this picture private {7300}]
				</label>
              </ZONE makePrivate enabled>
            </td>
          </tr>
          <tr>
            <td colspan="2" valign="top">
              <input type="submit" name="Submit" value="[Update {7305}]" class="submit" />            </td>
            </tr>
        </table>
		</form>
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
</table>
<!-- footer --><!-- /footer -->