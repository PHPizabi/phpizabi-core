<!-- header --><!-- /header --><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#031545">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top"><!-- leftpane --><table width="468" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td>
	        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top">
				    <div class="homeColorSet1">
				      <h1>Welcome to <span class="homeColorSet2">{siteName}</span></h1>
				      <p>Welcome to {siteName}!  Please register yourself and take a look around.  There's lots to see and do, so take your time, meet some new friends, and make yourself at home.</p>
				      <p>&nbsp;</p>
				      <p><img src="{themePath}/images/frame/home_sprache.gif" alt="Sprache" width="400" height="213"></p>
			        </div></td>
                </tr>
            </table>	    </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="right">&nbsp;</td>
        </tr>
    </table><!-- /leftpane -->
	</td>
    <td width="290" valign="top"><!-- rightpane --><table width="255" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1 class="homeColorSet2">Login</h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">
		<form method="post">
		<table width="100%" border="0" cellpadding="0" cellspacing="2">
		  <tr>
		    <td><p class="homeColorSet1">Username:</p></td>
		    <td><input name="username" type="text" id="username" size="15"></td>
		  </tr>
		  <tr>
		    <td><p class="homeColorSet1">Password:</p></td>
		    <td><input name="password" type="password" id="password" size="15"></td>
		  </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td><input name="userlogin" type="submit" id="userlogin" value="Login"></td>
		  </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td><span class="homeColorSet1">{login.failMessage}</span>
			<OBJ loginError.username>Username does not exist</OBJ loginError.username>
			<OBJ loginError.password>Wrong password</OBJ loginError.password>
			<OBJ loginError.bruteforce>Account disabled</OBJ loginError.bruteforce>
			<OBJ loginError.active>Account is not active</OBJ loginError.active>			</td>
		    </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td><a href="?L=registration.register">Register</a> | <a href="?L=users.lostpass">Lost password </a></td>
		  </tr>
		</table>
		</form>		</td>
        </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#0A1D58"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
  <tr>
    <td valign="top"><p>&nbsp;</p>
      <form method="get">
        <table width="468" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25">&nbsp;</td>
            <td><table width="100%" border="0" cellspacing="3" cellpadding="0" class="homeColorSet1">
              <tr>
                <td colspan="2"><div class="homeColorSet1">
				      <h1>Find <span class="homeColorSet2">Somebody!</span></h1></td>
                </tr>
              <tr>
                <td width="50%"><input type="hidden" name="L" value="search.users" />
                    <input name="query" type="text" id="query" class="fullwidth" /></td>
                <td><select name="gender" id="gender">
                    <option value="">Any gender</option>
                    <option value="man">Man</option>
                    <option value="woman">Woman</option>
                                                </select></td>
              </tr>

              <tr>
                <td valign="top"><strong>Only show </strong><br />
                    <p>
                      <label>
                      <input name="picture" type="checkbox" value="1" />
                        Users with a picture</label>
                      <label><br />
                      <input name="online" type="checkbox" id="online" value="1" />
                        Online users</label>
                  </p></td>
                <td valign="top"><p><strong>With age between</strong><br />
                        <input name="agelow" type="text" id="agelow" size="3" />
                  and
                  <input name="agehigh" type="text" id="agehigh" size="3" />
                  years old </p></td>
              </tr>
              <tr>
                <td valign="top"><p>
                    <input name="Submit" type="submit" id="Submit" value="Search" />
                  </p>
                    <br /></td>
                <td valign="top">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table>
	  </form>
	  </td>
    <td>&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
</table>
<!-- footer --><!-- /footer -->