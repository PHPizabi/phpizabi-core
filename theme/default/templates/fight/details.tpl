<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td>&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><!-- leftpane -->
        <form method="post">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25">&nbsp;</td>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top"><h1>Fighting! </h1>
                      Two sides, one outcome.  Bet on the one you feel is the sure winner in this battle of might and wit!  Who will you cast your confidence in to become the victor of this grueling battle of the ages?!<br>
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
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><strong>{fight.topic}</strong></td>
                    <td>&nbsp;</td>
                    <td align="right">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3">{fight.body}</td>
                  </tr>
                </table>
                <br>
                <zone mode open>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" align="center"><h4>USER</h4></td>
                    <td align="center">&nbsp;</td>
                    <td width="50%" align="center"><h4>OPPONENT</h4></td>
                  </tr>
                  <tr>
                    <td align="center"><img src="system/image.php?file={fight.user_picture}&width=260" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                        <strong>{fight.user}</strong></td>
                    <td>&nbsp;</td>
                    <td align="center"><p><strong>This is an open fight</strong><br>
                      <br>
                      Would you like 
                      to 
                      fight <br>
                      against {fight.user}?<br>
                      <br>
                      <br>
                      <input name="GetOpenFight" type="submit" id="GetOpenFight" value="Let's Fight!" class="submit">
                      </p>                    </td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center"><a href="?L=fight.details&id={fight.next}">Next Fight</a></td>
                  </tr>
                </table>
				</zone mode open>
				<zone mode votecast>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="center"><h4>Your Vote has been Cast! </h4></td>
                  </tr>
                  <tr>
                    <td align="center">Thank you for your vote...<br>
                      <a href="?L=fight.details&id={fight.id}">Review this fight results</a> | <a href="?L=fight.details&id={fight.next}">Go to the next fight</a> </td>
                  </tr>
                </table>
				</zone mode votecast>
				<zone mode fight>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" align="center"><h4>USER</h4></td>
                    <td align="center">against</td>
                    <td width="50%" align="center"><h4>OPPONENT</h4></td>
                  </tr>
                  <tr>
                    <td align="center"><img src="system/image.php?file={fight.user_picture}&width=260" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                      <strong>{fight.user} </strong>({fight.user_points})</td>
                    <td align="center" valign="middle"><h2>{fight.time}</h2>
                      <p><strong>                        minutes<br>
                    remaining</strong></p></td>
                    <td align="center"><img src="system/image.php?file={fight.opponent_picture}&width=260" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                      <strong>{fight.opponent}</strong> ({fight.opponent_points})</td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><input name="betUser" type="submit" id="betUser" value="Take Bet" class="submit"></td>
                    <td>&nbsp;</td>
                    <td align="center"><input name="betOpponent" type="submit" id="betOpponent" value="Take Bet" class="submit"></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center"><a href="?L=fight.details&id={fight.next}">Next Fight</a></td>
                  </tr>
                </table>
				</zone mode fight>
				<zone mode winner>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3" align="center"><h4>GRAND WINNER</h4>
                      <h2><br>
                        <img src="system/image.php?file={fight.winnerpicture}&width=260" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                    {fight.winner}</h2></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="50%" align="center"><h4>USER</h4></td>
                    <td align="center">against</td>
                    <td width="50%" align="center"><h4>OPPONENT</h4></td>
                  </tr>
                  <tr>
                    <td align="center"><img src="system/image.php?file={fight.user_picture}" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                    <strong>{fight.user} </strong>({fight.user_points})</td>
                    <td>&nbsp;</td>
                    <td align="center"><img src="system/image.php?file={fight.opponent_picture}" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                    <strong>{fight.opponent}</strong> ({fight.opponent_points})</td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center"><a href="?L=fight.details&id={fight.next}">Next Fight</a> </td>
                  </tr>
                </table>
				</zone mode winner>
                <zone mode matchnull>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3" align="center"><h4>NULL</h4>
                      <p>Nobody won that fight, either there<br>
                        has been 
                      no vote, or the result was equal.</p></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="50%" align="center"><h4>USER</h4></td>
                    <td align="center">against</td>
                    <td width="50%" align="center"><h4>OPPONENT</h4></td>
                  </tr>
                  <tr>
                    <td align="center"><img src="system/image.php?file={fight.user_picture}&width=260" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                        <strong>{fight.user}</strong></td>
                    <td>&nbsp;</td>
                    <td align="center"><img src="system/image.php?file={fight.opponent_picture}&width=260" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                        <strong>{fight.opponent}</strong></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center"><a href="?L=fight.details&id={fight.next}">Next Fight</a></td>
                  </tr>
                </table>
				</zone mode matchnull>
				<zone mode pending>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3" align="center"><h4>PENDING</h4>
                        <p>This fight has not started. <br>
                          The opponent has 
                          not accepted the fight yet.</p></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="50%" align="center"><h4>USER</h4></td>
                    <td align="center">against</td>
                    <td width="50%" align="center"><h4>OPPONENT</h4></td>
                  </tr>
                  <tr>
                    <td align="center"><img src="system/image.php?file={fight.user_picture}&width=260" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                        <strong>{fight.user}</strong></td>
                    <td>&nbsp;</td>
                    <td align="center"><img src="system/image.php?file={fight.opponent_picture}&width=260" alt="[Picture {150}]" name="picture" hspace="2" border="0" id="picture" /><br>
                        <strong>{fight.opponent}</strong></td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td>&nbsp;</td>
                    <td align="center"><a href="?L=fight.details&id={fight.next}">Next Fight</a></td>
                  </tr>
                </table>
                </zone mode pending>
                <br />
                <br />			  </td>
              <td bgcolor="#DCE6FF">&nbsp;</td>
            </tr>
            
            <tr>
              <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
            </tr>
          </table>
          <br />
          <br />
        </form>
      <!-- /leftpane -->    <!-- rightpane -->
        <!-- /rightpane --></td>
  </tr>
</table>
