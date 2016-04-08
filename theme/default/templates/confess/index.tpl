<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
	<!-- leftpane -->
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td colspan="2">
		  <h1>Confessions</h1>
		  <p>Those are users submitted confessions.</p>
		  <!-- breadcrumbs --><!-- /breadcrumbs --></td>
      </tr>
      <tr>
        <td height="8" colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF"><br>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <loop confessions>
			  <tr>
                <td valign="top">{confession.body}</td>
                </tr>
			  
              <tr>
                <td height="10"><OBJ delete_object></OBJ delete_object></td>
                </tr>
              <tr>
                <td>{confession.delete}
                  <OBJ delete_object><a href="{confession.rmlink}&rm={confession.id}">Delete</a></OBJ delete_object></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              </loop confessions>
            </table>
            <br></td>
        <td width="15" bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td colspan="3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" align="center">
		<ZONE paginationBlock enabled>
		  <ZONE pagination.back disabled>&laquo; [Back {255}]</ZONE pagination.back disabled>
		  <ZONE pagination.back linked><a href="{pagination.back.link}">&laquo; [Back {255}]</a></ZONE pagination.back linked>
		
		  <ZONE pagination.first disabled></ZONE pagination.first disabled>
		  <ZONE pagination.first linked><a href="{pagination.first.link}">1...</a> </ZONE pagination.first linked>
		
		  <OBJ pagination.unlinked.page><strong>{pagination.page.pageNumber}</strong></OBJ pagination.unlinked.page>
		  <OBJ pagination.linked.page> <a href="{pagination.page.link}">{pagination.page.pageNumber}</a> </OBJ pagination.linked.page>
		
		  {pagination.pages}

		  <ZONE pagination.last disabled></ZONE pagination.last disabled>
		  <ZONE pagination.last linked><a href="{pagination.last.link}">...{pagination.last.pageNumber}</a> </ZONE pagination.last linked>

		  <ZONE pagination.next disabled>[Next {260}] &raquo;</ZONE pagination.next disabled>
		  <ZONE pagination.next linked><a href="{pagination.next.link}">[Next {260}] &raquo;</a></ZONE pagination.next linked>
		</ZONE paginationBlock enabled>

		<ZONE paginationBlock disabled></ZONE paginationBlock disabled></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
    </table>
	<!-- /leftpane -->
	</td>
    <td width="290" valign="top"><!-- rightpane -->
      <zone confessform enabled>
	  <form method="post">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><h2>Confess!</h2></td>
        </tr>
        <tr>
          <td><textarea name="body" cols="40" rows="10" id="body"></textarea></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Confessions are absolutely anonymous, this system does NOT record your username.</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input type="submit" name="Submit" value="Submit" class="submit"></td>
        </tr>
      </table>
      </form>
	  </zone confessform enabled>

	  <zone confessform saved>
	  Thank you for your confession. 
      </zone confessform daved>

	  <zone confessform disabled>
	  Sorry you can not confess for now. Please login or try again later.
      </zone confessform disabled>
    <!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->