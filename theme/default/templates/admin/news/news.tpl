<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_news_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>System News Management</h2>
<p><a href="?L=admin.news.create"><br>
Create a news article</a></p>
  <strong><br>
  {dbCount.total} Total news articles in database<br />
</strong>
  <br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td><strong>Title</strong></td>
    <td><strong>Date</strong></td>
    <td><strong>Shown to</strong></td>
    <td><strong>Edit</strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP newsList>
  <tr id="row_news_{news.id}">
    <td onMouseOver="omov('{news.id}', 1);" onMouseOut="omov('{news.id}', 0);">{news.id}</td>
    <td onMouseOver="omov('{news.id}', 1);" onMouseOut="omov('{news.id}', 0);">{news.title}</td>
    <td onMouseOver="omov('{news.id}', 1);" onMouseOut="omov('{news.id}', 0);">{news.date}</td>
    <td onMouseOver="omov('{news.id}', 1);" onMouseOut="omov('{news.id}', 0);">{news.show}</td>
    <td onMouseOver="omov('{news.id}', 1);" onMouseOut="omov('{news.id}', 0);"><a href="?L=admin.news.edit&id={news.key}">Edit</a></td>
    <td onMouseOver="omov('{news.id}', 1);" onMouseOut="omov('{news.id}', 0);"><a href="?L=admin.news.news&rm={news.key}">Delete</a></td>
    </tr>
  <tr>
    <td height="1" colspan="6" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP newsList>
</table>
