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
		  <ZONE header enabled>
		  <h1>[Write a topic {6725}] </h1>
          <p>[Creating a new topic in subject {subject.title} {6730}] </p>
          <br />
		  </ZONE header enabled>
		  
		  <ZONE header success>
		  <h1>[Success! {315}] </h1>
          <p>[Your post has been recorded successfully {6735}] </p>
          <p><br />
          <a href="?L=inkspot.topic&id={post.id}">[Read this post {6740}] </a> | <a href="?L=inkspot.topic&id={post.subject}">[Go back to Subject {6745}]</a>
		  
		  </ZONE header success>
		  
		  <ZONE header cloneThread>
		  <h1>[Error! {160}] </h1>
          <p>[Sorry a thread by that name already exist in this subject {6750}]</p>
          <p><br />
		  </ZONE header cloneThread>
		  
		  <ZONE header notAllowed>
		  <h1>[Error! {160}] </h1>
          <p>[Sorry, you are not allowed to post in that thread {6755}] </p>
          <p><br />
		  </ZONE header notAllowed> 
          
  		  <ZONE header subjectLocked>
		  <h1>[Error! {160}] </h1>
          <p>[Sorry, this subject is locked. You can not post into it {6760}]</p>
          <p><br />
		  </ZONE header subjectLocked> 

  		  <ZONE header noSubject>
		  <h1>[Error! {160}] </h1>
          <p>[Sorry, this subject does not exist {6765}] </p>
          <p><br />
		  </ZONE header noSubject> 
		  
   		  <ZONE header blankField>
		  <h1>[Error! {160}] </h1>
          <p>[Sorry, there was blank fields in your post {6770}] </p>
          <p><br />
		  </ZONE header blankField> 
		  
		  <!-- breadcrumbs -->
<!-- /breadcrumbs -->
		  </td>
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
		<form method="post">
		  <select name="subject">
		  <option value="">[Please Select a Subject {6775}]</option>
		  <LOOP subjectsLoop>
		    <option value="{subject.id}" {subject.select}>{subject.title}</option>
		  </LOOP subjectsLoop>
		  </select>
		  <br>
		  <input name="title" type="text" id="title" value="{get.title}" class="fullwidth">
            <br>
            <textarea name="body" rows="10" class="fullwidth"></textarea>
          <br>
          <input type="submit" name="Submit" value="[Submit {295}]" class="submit">
		  </form>
<br />
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
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table><!-- footer --><!-- /footer -->