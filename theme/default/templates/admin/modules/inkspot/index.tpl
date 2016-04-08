<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_subject_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>InkSpot Admin</h2>
  <strong><br>
  {dbCount.total} Total InkSpot subjects<br />
</strong>
  <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td><strong>Title</strong></td>
    <td><strong>Locked</strong></td>
    <td><strong>Topics </strong></td>
    <td><strong>Posts</strong></td>
    <td><strong>Open to </strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="7" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP subjectsList>
  <tr id="row_subject_{subject.id}">
    <td onMouseOver="omov('{subject.id}', 1);" onMouseOut="omov('{subject.id}', 0);">{subject.id}</td>
    <td onMouseOver="omov('{subject.id}', 1);" onMouseOut="omov('{subject.id}', 0);">{subject.title}</td>
    <td onMouseOver="omov('{subject.id}', 1);" onMouseOut="omov('{subject.id}', 0);">{subject.locked}</td>
    <td onMouseOver="omov('{subject.id}', 1);" onMouseOut="omov('{subject.id}', 0);">{subject.topic_count}</td>
    <td onMouseOver="omov('{subject.id}', 1);" onMouseOut="omov('{subject.id}', 0);">{subject.post_count}</td>
    <td onMouseOver="omov('{subject.id}', 1);" onMouseOut="omov('{subject.id}', 0);">{subject.allow}</td>
    <td onMouseOver="omov('{subject.id}', 1);" onMouseOut="omov('{subject.id}', 0);"><a href="?L=admin.modules.inkspot.index&rm={subject.id}">Delete</a></td>
    </tr>
  <tr>
    <td height="1" colspan="7" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP subjectsList>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<h2>Create a New Subject</h2>
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td valign="top"><strong>Subject Title: </strong></td>
    <td width="10">&nbsp;</td>
    <td><input name="title" type="text" id="title" size="30"></td>
  </tr>
  <tr>
    <td valign="top"><strong>Lock:</strong></td>
    <td>&nbsp;</td>
    <td><label><input name="lock" type="checkbox" id="lock" value="1"> 
      Lock this subject</label></td>
  </tr>
  <tr>
    <td valign="top"><strong>Allow Types: </strong></td>
    <td>&nbsp;</td>
    <td>
    <loop usersClasses>
	<label><input type="checkbox" name="class[]" value="{class.id}"> {class.name} </label><br />
	</loop usersClasses>
	</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit"></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
