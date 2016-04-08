<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
	<!-- leftpane -->
	<form method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top">
				  <ZONE blogEditHeader edit>
				  <h1>[Edit blog article {2025}] </h1>                    
                    ...</ZONE blogEditHeader edit>
				  <ZONE blogEditHeader saved>
				    <h1>[Successful! {155}] </h1>                    
                    <p>[Your blog article has been successfully updated {2030}] </p>
                    </ZONE blogEditHeader saved><ZONE blogEditHeader error>
				    <h1>[Error! {160}] </h1>                    
                    <p>[Sorry there has been an error trying to update your blog article. Either the title or the body was empty. {2030}] </p>
				  </ZONE blogEditHeader error>
				  <!-- breadcrumbs --><!-- /breadcrumbs -->
				  </td>
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
        <td bgcolor="#DCE6FF">
		<ZONE blogEditBlock enabled>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><h1>[Edit your article below {2035}] </h1></td>
              </tr>
              <tr>
                <td><span style="padding-right:25px;">
                  <input name="title" type="text" id="formTitle" class="fullwidth" value="{article.title}" />
                </span></td>
              </tr>
              <tr>
                <td><span style="padding-right:25px;">
                  <textarea name="body" rows="20" id="formBody" class="fullwidth">{article.body}</textarea>
                </span></td>
              </tr>
              <tr>
                <td><span style="padding-right:25px;">
                  <input name="Submit" type="submit" id="Submit" value="[Submit {295}]" class="submit" />
                </span></td>
              </tr>
            </table>
			</ZONE blogEditBlock enabled>
			<ZONE blogEditBlock restricted>
			  [Sorry, you can not edit this blog article; it must belong to another user. {2040}] </ZONE blogEditBlock restricted>			</td>
        <td bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td colspan="3"><br />
          <br />
          <br /></td>
      </tr>
    </table>
	</form>
	<!-- /leftpane -->
	</td>
    <td width="290" valign="top">
	<!-- rightpane -->
	<!-- /rightpane -->&nbsp;</td>
  </tr>
</table>
<!-- footer --><!-- /footer -->