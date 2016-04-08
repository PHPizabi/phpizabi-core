<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
	<!-- leftpane --><form method="post">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><h1>Fight!</h1>
                The following are fights on this website! Come on now, enter the game, and take a bet! <br />
                  <br />
                  <!-- breadcrumbs -->
                  <a href="?L=fight.create">Start a  fight</a></td>
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
        <td colspan="2" bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td height="6" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF"><h4>Open Fights</h4>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><strong>User</strong></td>
              <td>&nbsp;</td>
              <td><strong>Fight Topic </strong></td>
            </tr>
            <loop openfights>
			<tr>
              <td>{of.username}</td>
              <td>&nbsp;</td>
              <td><a href="?L=fight.details&id={of.id}">{of.topic}</a></td>
            </tr>
			</loop openfights>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        <td bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF"><h4>Fighting Peoples</h4>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td><strong>Fighters</strong></td>
              <td>&nbsp;</td>
              <td><strong>Time Remaining </strong></td>
            </tr>
            <loop fights>
			<tr>
              <td><a href="?L=fight.details&id={f.id}">{f.username} against {f.opponent} </a></td>
              <td>&nbsp;</td>
              <td>{f.remaining} minutes left </td>
            </tr>
			</loop fights>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>          
          <p>&nbsp;</p></td>
        <td bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td height="2" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
    </table>
	<br />
	<br />
	</form><!-- /leftpane -->
	</td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>Some winners </h1>
          Those are some winners of the last couple closed fights! </td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		<loop winners>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><img src="system/image.php?file={winner.picture}" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /></td>
            <td align="center"><strong>against</strong></td>
            <td align="center"><img src="system/image.php?file={looser.picture}&width=50" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /></td>
          </tr>
          <tr>
            <td colspan="3" align="center">{winner.username} won against {looser.username}<strong><br>
  </strong><a href="?L=fight.details&id={winner.fightid}">{winner.topic}</a><br></td>
            </tr>
          <tr>
            <td height="20" colspan="3">&nbsp;</td>
          </tr>
        </table>
		</loop winners>
		</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->