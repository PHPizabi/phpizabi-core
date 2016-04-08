<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25">&nbsp;</td>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><h1>Fight Request </h1>
          This user requested a fight against you. You may accept or reject that fight request.<br>
          <br>
          <a href="?L=fight.index">Fight Index</a> | <a href="?L=fight.create">Start a  fight</a></td>
        <td align="right" valign="top">&nbsp;</td>
      </tr>
    </table></td>
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
    <td bgcolor="#DCE6FF"><zone fight_form success></zone fight_form success>
      <br>
	  <zone form enabled>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%" align="center"><h4>USER</h4></td>
              <td align="center">&nbsp;</td>
              <td width="50%" align="center" valign="top"><h4>FIGHT DETAILS </h4></td>
            </tr>
            <tr>
              <td align="center"><img src="system/image.php?file={fight.user_picture}&width=260" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                  <strong>{fight.user}</strong></td>
              <td>&nbsp;</td>
              <td width="50%" align="center" valign="top">
			  <form method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                <tr>
                  <td colspan="2" align="left"><h6><strong>{fight.topic}</strong></h6>
                  {fight.body}</td>
                </tr>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><strong>Would you like 
                    to 
                    fight 
                    against {fight.user}?</strong></td>
                </tr>
                <tr>
                  <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td align="center"><input name="Accept" type="submit" id="Accept" value="Accept" class="submit"></td>
                  <td align="center"><input name="Reject" type="submit" id="Reject" value="Reject" class="submit"></td>
                </tr>
              </table></form></td>
            </tr>
          </table>
		  </zone form enabled>
        <br />
        <br />
    </td>
    <td bgcolor="#DCE6FF">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
  </tr>
</table>
