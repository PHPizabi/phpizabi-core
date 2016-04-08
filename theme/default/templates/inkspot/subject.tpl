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
        <td colspan="2">
		  <h1>[Topics {6655}] </h1>
          <p>[Topics in subject {subject.title} {6660}] </p>
          <p>&nbsp;</p>
          <!-- breadcrumbs --><p><a href="?L=inkspot.write">[Create a Topic {6665}]</a> | <a href="?L=inkspot.search">[Search {300}]</a> | <a href="?L=inkspot.index">[Back to Index {560}]</a> </p><!-- /breadcrumbs --></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF"><br>
          <table width="100%" border="0" cellspacing="3" cellpadding="0">
          
		  <tr>
		    <td width="30">&nbsp;</td>
		    <td><strong>[Topic {545}] </strong></td>
		    <td width="50"><strong>[Replies {555}] </strong></td>
		    <td width="50"><strong>[Views {565}] </strong></td>
		    <td width="80" align="right"><strong>[Last post {570}] </strong></td>
		    </tr>
			
		  <tr>
		    <td height="1" colspan="5" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
		    </tr>
			<LOOP topicsInSubject>
		  <tr>
            <td width="30"><a href="?L=users.profile&id={topic.userID}"><img src="system/image.php?file={topic.mainpicture}&width=30" alt="{username}" hspace="2" border="0" align="left" id="picture" /></a></td>
            <td><a href="?L=inkspot.topic&id={topic.id}">{topic.title}</a></td>
            <td>{topic.replies}</td>
            <td>{topic.views}</td>
            <td align="right">{topic.lastPostUsername}</td>
          </tr>
		  <tr>
		    <td height="1" colspan="5" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
		    </tr>
		  </LOOP topicsInSubject>
        </table>
            <br>
		  <br></td>
        <td width="20" bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
      <tr>
        <td height="10" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><h1>[Start a new topic! {6670}] </h1></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td colspan="2">
		<form method="get">
		<input type="hidden" name="L" value="inkspot.write">
		<input type="hidden" name="subject" value="{subject.id}">
		<table width="100%" border="0" cellpadding="0" cellspacing="3">
          <tr>
            <td valign="top"><strong>[Title: {15}] </strong></td>
            <td colspan="2" valign="top"><input name="topic" type="text" class="fullwidth" id="topic" /></td>
          </tr>

          <tr>
            <td valign="top">&nbsp;</td>
            <td valign="middle"><input name="Submit" type="submit" class="submit" id="Submit" value="[Submit {295}]" /></td>
            <td align="right" valign="top">&nbsp;</td>
          </tr>
        </table>
		</form>		</td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[Search the Spot {6675}] </h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><p>[Search for topics in the InkSpot {6680}]
            
		  <br />
		  <br />		</p>		  </td>
      </tr>
      <tr>
        <td>
		<form method="get">
		<input type="hidden" name="L" value="inkspot.search" />
		<input name="query" type="text" id="query" class="fullwidth" />
          <br />
          <br />
          <input type="submit" name="Submit2" value="Submit" class="submit" /></form></td>
        
		<td>&nbsp;</td>
      </tr>
    </table>
     <!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->