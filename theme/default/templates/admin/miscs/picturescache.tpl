<script language="javascript" type="text/javascript">
  function omov(id, over) {
	document.getElementById('row_cache_' + id).style.backgroundColor = (over?"#F1F3F8":"#FFFFFF");
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Pictures Cache  Management</h2>
<p><a href="?L=admin.news.create"><br>
</a></p>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><strong>{stats.totalFiles} Total cached pictures in the system </strong></td>
      <td align="right"><a href="?L=admin.system.imageproc">Image Processing Configurations </a></td>
    </tr>
    <tr>
      <td><a href="?L=admin.miscs.picturescache&flush=1">Flush the Pictures Cache</a> </td>
      <td align="right">&nbsp;</td>
    </tr>
  </table>
  <p><a href="?L=admin.news.create">    </a><strong><br />
    </strong>
    <br>
    <br>
  </p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Cached Item</strong> </td>
    <td><strong>Size</strong></td>
    <td><strong>Created on </strong></td>
    <td><strong>Delete</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP picturesList>
  <tr id="row_cache_{cache.id}">
    <td onMouseOver="omov('{cache.id}', 1);" onMouseOut="omov('{cache.id}', 0);">{cache.id}</td>
    <td onMouseOver="omov('{cache.id}', 1);" onMouseOut="omov('{cache.id}', 0);">{cache.size} Kb</td>
    <td onMouseOver="omov('{cache.id}', 1);" onMouseOut="omov('{cache.id}', 0);">{cache.date}</td>
    <td onMouseOver="omov('{cache.id}', 1);" onMouseOut="omov('{cache.id}', 0);"><a href="?L=admin.miscs.picturescache&rm={cache.id}">Delete</a></td>
    </tr>
  <tr>
    <td height="1" colspan="4" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP picturesList>
</table>
