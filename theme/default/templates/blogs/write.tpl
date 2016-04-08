<script language="javascript" type="text/javascript">
  var clicksArray = new Array()
  
  function populatedFieldClick(fieldName) {
  	if (!clicksArray[fieldName]) {
	  clicksArray[fieldName] = true;
	  document.getElementById(fieldName).value = '';
	}
  }
</script>
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
				  <ZONE blogWriteHeader write>
				  <h1>[Write blog articles {285}] </h1>                    
                    [Blogs offer you a chance to have  your voice heard on the internet.&nbsp; It can  be a place to organize your thoughts, share interesting stories, write a living  diary for all to see, or just share what is on your mind.&nbsp; Connect with other like-minded individuals  today! {2050}] </ZONE blogWriteHeader write>
				  <ZONE blogWriteHeader saved>
				    <h1>[Successful! {155}] </h1>                    
                    <p>[Your blog article has been successfully added. You may write another blog article or you may click below to view this new article! {2060}] </p>
                    <p><a href="?L=blogs.blog&article={lastAddedID}">[View this blog article {2065}]</a></p>
				  </ZONE blogWriteHeader saved><ZONE blogWriteHeader error>
				    <h1>[Error! {160}] </h1>                    
                    <p>[Sorry there has been an error trying to save your blog article. Either the title or the body was empty. {2070}] </p>
				  </ZONE blogWriteHeader error><!-- breadcrumbs -->
<!-- /breadcrumbs --></td>
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
		<ZONE blogWriteBlock enabled>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><h1>[Write your article below {2075}] </h1></td>
              </tr>
              <tr>
                <td><span style="padding-right:25px;">
                  <input name="title" type="text" id="formTitle" class="fullwidth" value="[My Article Title {2075}]" onclick="populatedFieldClick('formTitle');" />
                </span></td>
              </tr>
              <tr>
                <td><span style="padding-right:25px;">
                  <textarea name="body" rows="20" id="formBody" class="fullwidth" onclick="populatedFieldClick('formBody');">[Click here to write your article {2080}]</textarea>
                </span></td>
              </tr>
              <tr>
                <td><span style="padding-right:25px;">
                  <input name="Submit" type="submit" id="Submit" value="[Submit {295}]" class="submit" />
                </span></td>
              </tr>
            </table>
			</ZONE blogWriteBlock enabled>
			<ZONE blogWriteBlock guest>
			[Sorry, guests can't post blog articles. {2085}] <a href="?L=registration.register">[Register</a>	{305}]		</ZONE blogWriteBlock guest>			</td>
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
	</form><!-- /leftpane -->
	</td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table>
<!-- footer --><!-- /footer -->