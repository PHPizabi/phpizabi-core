<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top"><!-- leftpane -->
        <form method="post">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="25">&nbsp;</td>
              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top"><h1>Start a fight! </h1>
                      Got something to prove?  Someone or something rub you the wrong way?  Get your message sent with a clear, decided victory over your opponent!</td>
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
              <td bgcolor="#DCE6FF"><br>
                <zone fight_form form>
				<strong>{error.message}</strong>
                <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td><strong>Topic:</strong></td>
                  <td width="10">&nbsp;</td>
                  <td><input name="topic" type="text" id="topic" value="{post.topic}" size="30" maxlength="100"></td>
                </tr>
                <tr>
                  <td valign="top"><strong>Fight duration: </strong></td>
                  <td width="10">&nbsp;</td>
                  <td><label><input name="duration" type="radio" value="3600">
                    One hour</label><br>
                    <label><input name="duration" type="radio" value="86400" checked> 
                    One day</label><br>
                    <label><input name="duration" type="radio" value="604800">
                    One week</label></td>
                </tr>
                <tr>
                  <td><strong>Opponent username: </strong></td>
                  <td>&nbsp;</td>
                  <td><input name="opponent" type="text" id="opponent" size="30" maxlength="50"> 
                    * </td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><strong>Explain your fight:</strong> </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3"><textarea name="body" cols="73" rows="10" id="body">{post.body}</textarea></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><input type="submit" name="Submit" value="Fight!" class="submit"></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
			  </zone fight_form form>
			  <zone fight_form success>
			  Success! Your fight has been submitted!<br />
			  </zone fight_form success>
              <br />
			  </td>
              <td bgcolor="#DCE6FF">&nbsp;</td>
            </tr>
            
            <tr>
              <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
            </tr>
          </table>
          <br />
          <br />
        </form>
      <!-- /leftpane -->
    </td>
    <td width="290" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>Instructions </h1>
          <p>Note: Fights are for fun, consider this a game!</p>
          <p><strong>OPEN FIGHTS: </strong><br>
          You may start a fight without an opponent. Leaving the opponent username field blank would create an open fight, you will be fighting against the first user who joins the fight!<br>
            <br>
            <strong>EXPLAIN IT:</strong><br>
          For a fight, you need a topic, and explanations... For other users to vote on your fight, you have to give some explanation on what you are fighting. Keep your explanation short, but descriptive enough.</p>
          </td>
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
    </table>
      <!-- rightpane -->
    <!-- /rightpane --></td>
  </tr>
</table>
<obj no_user>No such user</obj no_user>
<obj mail_subject>Fight request against {me}!</obj mail_subject>
<obj mail_body>{me} requested a fight against you. Please click the following link to accept or deny this request. {url}</obj mail_body>