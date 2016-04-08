<script language="javascript" type="text/javascript">
  function ck(id) {
    ckStatus = document.getElementById('ck_user_' + id).checked;
	
	document.getElementById('ck_user_' + id).checked = (ckStatus ? false : true);
	document.getElementById('row_user_' + id).style.backgroundColor = (ckStatus ? "#FFFFFF" : "#CFD6E2");
  }
  
  function omov(id, over) {
    ckStatus = document.getElementById('ck_user_' + id).checked;
	document.getElementById('row_user_' + id).style.backgroundColor = (over?(ckStatus?"#CFD6E2":"#F1F3F8"):(ckStatus?"#CFD6E2":"#FFFFFF"));
  }
  
  function checkAll(formID, boolean) {
	var formSet = document.forms[formID].getElementsByTagName('input');
	for (var i=0; i<formSet.length; i++) {
		formSet[i].checked = boolean;
	}
  }
  
</script>
	
<h2>Users Control Panel</h2>
<p>&nbsp;</p>
<form metod="get" id="userControlForm">
<input type="hidden" name="L" value="admin.users.users" />
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Only sort: </strong></td>
    <td><select name="sort" onChange="this.form.submit();">
      <option value="all" {sort.ck.all}>All users</option>
      <option value="admin" {sort.ck.admin}>Administrators</option>
      <option value="active" {sort.ck.active}>Active users</option>
      <option value="notactive" {sort.ck.notactive}>Non-active users</option>
      <option value="online" {sort.ck.online}>Online users</option>
      <option value="offline" {sort.ck.offline}>Offline users</option>
      <option value="picture" {sort.ck.picture}>Users with a picture</option>
      <option value="nopicture" {sort.ck.nopicture}>Users without a picture</option>
      <option value="type" {sort.ck.type}>Users with a membership level</option>
      <option value="notype" {sort.ck.notype}>Users without a membership level</option>
            </select></td>
    <td>&nbsp;</td>
    <td><strong>Search or User ID:</strong></td>
    <td><input name="query" type="text" id="query" value="{query}"></td>
  </tr>
  <tr>
    <td><strong>Order by:    </strong></td>
    <td><select name="order" onChange="this.form.submit();">
      <option value="id" {order.ck.id}>ID</option>
      <option value="username" {order.ck.username}>User name</option>
      <option value="active" {order.ck.active}>Active / Non-active</option>
      <option value="gender" {order.ck.gender}>Gender</option>
      <option value="account_type" {order.ck.account_type}>Membership level</option>
      <option value="account_expire" {order.ck.account_expire}>Membership expiration date</option>
	  <option value="last_load" {order.ck.last_load}>Last load / last login</option>
      </select>
      <select name="direction" onChange="this.form.submit();">
        <option value="ASC" {direction.ck.asc}>Ascending</option>
        <option value="DESC" {direction.ck.desc}>Descending</option>
      </select></td>
    <td>&nbsp;</td>
    <td><strong>Results per page: </strong></td>
    <td><select name="rpp" id="rpp" onChange="this.form.submit();">
      <option value="20" {rpp.ck.20}>20 users per page</option>
      <option value="50" {rpp.ck.50}>50 users per page</option>
      <option value="100" {rpp.ck.100}>100 users per page</option>
      <option value="500" {rpp.ck.500}>500 users per page</option>
      <option value="1000" {rpp.ck.1000}>1000 users per page</option>
    </select></td>
  </tr>
  <tr>
    <td><input name="Submit" type="submit" value="Resample"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<br>
<br>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>{dbCount.total} Total users in database<br />
      This sampling returned {dbCount.sample} results</strong>
	  <ZONE dbUpdate enabled><br /><strong><span style="color:red;">Successfully updated {dbUpdateCount} database row(s)</span></strong></ZONE dbUpdate enabled>
	  </td>
    <td align="right">Page {page.pagenumber} out of {page.totalpages} <br>
      <a href="?L=admin.users.tocsv">Export users table as CSV </a></td>
  </tr>
</table>
<br>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="22"><input type="checkbox" name="null" value="null" onClick="checkAll('userControlForm', this.checked);"></td>
    <td width="40">&nbsp;</td>
    <td><strong>Username</strong></td>
    <td><strong>Last Acitvity </strong></td>
    <td><strong>Administrator</strong></td>
    <td><strong>Active</strong></td>
    <td><strong>Account type </strong></td>
    <td><strong>Edit</strong></td>
    <td><strong>Ghost</strong></td>
    <td><strong>Profile</strong></td>
  </tr>
  <tr>
    <td height="1" colspan="10" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  <LOOP usersList>
  <tr id="row_user_{user.id}" onClick="ck('{user.id}');">
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);"><input type="checkbox" name="ck[]" id="ck_user_{user.id}" value="{user.id}" onClick="ck('{user.id}');"></td>
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);">{user.id}</td>
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);">{user.username}</td>
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);">{user.lastload}</td>
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);">{user.admin}</td>
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);">{user.active}</td>
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);">{user.account_type}</td>
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);"><a href="?L=admin.users.edit&id={user.id}">Edit </a></td>
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);"><a href="?L=admin.users.users&amp;ghost={user.id}">Ghost</a></td>
    <td onMouseOver="omov('{user.id}', 1);" onMouseOut="omov('{user.id}', 0);"><a href="?L=users.profile&id={user.id}">Profile</a> </td>
  </tr>
  <tr>
    <td height="1" colspan="10" bgcolor="#CCCCCC"><img src="{themePath}/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
  </tr>
  </LOOP usersList>
  <tr>
    <td height="30" colspan="10" nowrap bgcolor="#CCCCCC" style="padding-left:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><select name="action" id="action">
          <option selected>With selected users...</option>
          <option value="activate">Activate users accounts</option>
          <option value="unactivate">Deactivate users accounts</option>
          <option value="admin">Give users admin access</option>
          <option value="unadmin">Remove users admin access</option>
          <option value="emailcheck">Mark email address as verified</option>
          <option value="bulkmail">Add to bulk mail list</option>
          <option value="delete">Delete selected users</option>
        </select>
          <input name="Act" type="submit" id="Act" value="Submit"></td>
        <td align="right" style="padding-right:10px;">
		 <ZONE paginationBlock enabled>
        <ZONE pagination.back disabled>&laquo; Back</ZONE pagination.back disabled>
        <ZONE pagination.back linked><a href="{pagination.back.link}">&laquo; Back</a></ZONE pagination.back linked>
        
        <ZONE pagination.first disabled></ZONE pagination.first disabled>
        <ZONE pagination.first linked><a href="{pagination.first.link}">1...</a> </ZONE pagination.first linked>
        
        <OBJ pagination.unlinked.page><strong>{pagination.page.pageNumber}</strong></OBJ pagination.unlinked.page>
        <OBJ pagination.linked.page> <a href="{pagination.page.link}">{pagination.page.pageNumber}</a> </OBJ pagination.linked.page>
        
        {pagination.pages}
        
        <ZONE pagination.last disabled></ZONE pagination.last disabled>
        <ZONE pagination.last linked><a href="{pagination.last.link}">...{pagination.last.pageNumber}</a> </ZONE pagination.last linked>
        
        <ZONE pagination.next disabled>Next &raquo;</ZONE pagination.next disabled>
        <ZONE pagination.next linked><a href="{pagination.next.link}">Next &raquo;</a></ZONE pagination.next linked>
        </ZONE paginationBlock enabled>

      <ZONE paginationBlock disabled>      </ZONE paginationBlock disabled>		</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>