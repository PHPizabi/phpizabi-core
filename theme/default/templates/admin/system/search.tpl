<h2>Search System Settings </h2>
<br /><br />
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Results per page: </strong></td>
    <td width="10">&nbsp;</td>
    <td><input name="SEARCH_RESULTS_PER_PAGE" type="text" id="SEARCH_RESULTS_PER_PAGE" value="{CONF.SEARCH_RESULTS_PER_PAGE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Pagination padding: </strong></td>
    <td>&nbsp;</td>
    <td><input name="SEARCH_PAGINATION_PADDING" type="text" id="SEARCH_PAGINATION_PADDING" value="{CONF.SEARCH_PAGINATION_PADDING}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Prioritize account types: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="SEARCH_PRIORITIZE_ACCOUNTTYPES" value="1" {ck.SEARCH_PRIORITIZE_ACCOUNTTYPES}/> Prioritize account types</label>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Only return active / approved users:  </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="SEARCH_REQUIRES_ACTIVE" value="1" {ck.SEARCH_REQUIRES_ACTIVE}/> Requires active</label>
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="Submit" value="Submit" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
