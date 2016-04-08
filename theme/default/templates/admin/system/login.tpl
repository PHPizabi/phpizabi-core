<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<h2>Login / Logout Configurations </h2>
<p>&nbsp;</p><br />
<p><strong>Attention: </strong>Modifying the session parameters may log you out<br />
  <br />
    <ZONE save success>
      <span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>          </ZONE save success>
  <br />
  <br />
</p>
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Session Cache Expire: </strong></td>
    <td width="10">&nbsp;</td>
    <td><input name="SESSION_CACHE_EXPIRE" type="text" id="SESSION_CACHE_EXPIRE" value="{CONF.SESSION_CACHE_EXPIRE}" size="40" /></td>
    <td>* Seconds </td>
  </tr>
  <tr>
    <td><strong>Session Cache Limiter: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="SESSION_CACHE_LIMITER" value="1" {ck.SESSION_CACHE_LIMITER}/> Use Session Cache Limiter</label></td>
    <td nowrap="nowrap">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Session Name: </strong></td>
    <td>&nbsp;</td>
    <td><input name="SESSION_NAME" type="text" id="SESSION_NAME" value="{CONF.SESSION_NAME}" size="40" /></td>
    <td nowrap="nowrap">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Session Save Path: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="SESSION_SAVE_PATH" value="1" {ck.SESSION_SAVE_PATH}/> Save Session Path</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Login Signal Trigger: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGIN_SIGNAL_TRIGGER" type="text" id="LOGIN_SIGNAL_TRIGGER" value="{CONF.LOGIN_SIGNAL_TRIGGER}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Login Requires Active: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOGIN_REQUIRE_ACTIVE" value="1" {ck.LOGIN_REQUIRE_ACTIVE}/> Login requires user account to be active / approved </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Login Route To: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGIN_ROUTE_TO" type="text" id="LOGIN_ROUTE_TO" value="{CONF.LOGIN_ROUTE_TO}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>First Login Route To: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGIN_FIRST_ROUTE_TO" type="text" id="LOGIN_FIRST_ROUTE_TO" value="{CONF.LOGIN_FIRST_ROUTE_TO}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Login System Failure Error Message: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGIN_FAILED_ERROR_MESSAGE" type="text" id="LOGIN_FAILED_ERROR_MESSAGE" value="{CONF.LOGIN_FAILED_ERROR_MESSAGE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Enable BruteForce Protection </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOGIN_BRUTEFORCE_PROTECT:ENABLE" value="1" {ck.LOGIN_BRUTEFORCE_PROTECT:ENABLE}/> 
      Enable BruteForce Protection Control</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>BruteForce Max Failures: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGIN_BRUTEFORCE_FAILCOUNT" type="text" id="LOGIN_BRUTEFORCE_FAILCOUNT" value="{CONF.LOGIN_BRUTEFORCE_FAILCOUNT}" size="40" /></td>
    <td>* Integer </td>
  </tr>
  <tr>
    <td><strong>Disable duration on bruteforce: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGIN_BRUTEFORCE_DISABLE_DURATION" type="text" id="LOGIN_BRUTEFORCE_DISABLE_DURATION" value="{CONF.LOGIN_BRUTEFORCE_DISABLE_DURATION}" size="40" /></td>
    <td>* Seconds </td>
  </tr>
  <tr>
    <td><strong>Show bruteforce error message </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOGIN_BRUTEFORCE_SHOWERROR" value="1" {ck.LOGIN_BRUTEFORCE_SHOWERROR}/> 
      Show BruteForce error message</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>BruteForce error message: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGIN_BRUTEFORCE_ERROR_MESSAGE" type="text" id="LOGIN_BRUTEFORCE_ERROR_MESSAGE" value="{CONF.LOGIN_BRUTEFORCE_ERROR_MESSAGE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Enable Login &quot;Remember me&quot; </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOGIN_REMEMBERME_ENABLED" value="1" {ck.LOGIN_REMEMBERME_ENABLED}/> 
      Enable &quot;Remember me&quot;</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>&quot;Remember me&quot; Cookie Name: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGIN_REMEMBERME_COOKIENAME" type="text" id="LOGIN_REMEMBERME_COOKIENAME" value="{CONF.LOGIN_REMEMBERME_COOKIENAME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Show &quot;Remember me&quot; option  </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOGIN_REMEMBERME_SHOWOPTION" value="1" {ck.LOGIN_REMEMBERME_SHOWOPTION}/>
      Show the &quot;Remember me&quot; option</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>&quot;Remember me&quot; time to live: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGIN_REMEMBERME_TIMETOLIVE" type="text" id="LOGIN_REMEMBERME_TIMETOLIVE" value="{CONF.LOGIN_REMEMBERME_TIMETOLIVE}" size="40" /></td>
    <td>* Seconds </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Logout Signal Trigger: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGOUT_SIGNAL_TRIGGER" type="text" id="LOGOUT_SIGNAL_TRIGGER" value="{CONF.LOGOUT_SIGNAL_TRIGGER}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Logout route to: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOGOUT_ROUTE_TO" type="text" id="LOGOUT_ROUTE_TO" value="{CONF.LOGOUT_ROUTE_TO}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="Submit" type="submit" class="style1" value="Submit" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
