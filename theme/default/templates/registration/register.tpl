<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top"><!-- leftpane --><form method="post">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="25">&nbsp;</td>
          <td><h1>[Register {50}] </h1>
              <p>[Welcome!&nbsp; You're on your way to joining one of the  fastest growing websites on the internet.&nbsp;  Registration is fast, simple, taking only a minute or two, and then  you're on your way to being part of one of the greatest virtual communities online.&nbsp; Here at {siteName} you will be able to upload  photos, leave comments on member profiles, write your very own blog, search for  friends or make new ones, and much much more. {7510}] &nbsp; </p>
              <p>&nbsp;</p>
              <p>[Let's get  started! {7515}] </p>
              <p>&nbsp;</p><!-- breadcrumbs --><!-- /breadcrumbs --> </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
        </tr>
        <tr>
          <td colspan="2" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
        <tr>
          <td bgcolor="#DCE6FF">&nbsp;</td>
          <td bgcolor="#DCE6FF">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#DCE6FF">&nbsp;</td>
          <td bgcolor="#DCE6FF"><h2>[Please complete the following {7520}] </h2></td>
        </tr>
        <tr>
          <td height="6" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
        </tr>
        <tr>
          <td bgcolor="#DCE6FF">&nbsp;</td>
          <td bgcolor="#DCE6FF">
            <ZONE regform notallowed> [Sorry, you are already a registered member. {7525}] </ZONE regform notallowed>
            <ZONE regform regform>
            <br />
            <table width="100%" border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td width="150" align="right" valign="top"><label for="email"><strong>[Email Address: {7530}] </strong></label></td>
                <td width="10" rowspan="14">&nbsp;</td>
                <td align="left" valign="top"><input name="email" type="text" size="50" id="email" />
                    <br />
                  [We will send you an email to confirm that your email address is valid. Please click the link within the email to activate your registration. If you do not receive our email, please check your junk mail folder. {7535}] </td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[I Was Born On: {7540}] </strong></td>
                <td align="left" valign="top"><select name="bmonth" id="bmonth">
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                    <select name="bday" id="bday">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                    </select>
                    <select name="byear" id="byear">
                      <LOOP years>
                        <option value="{year}">{year}</option>
                      </LOOP years>
                    </select>
                    <br />
                  [You must be at least {age} years old to join. {7545}] </td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[I Am A: {7550}]</strong> </td>
                <td align="left" valign="top"><select name="gender" id="gender">
                    <LOOP genderoption>
                      <option value="{gender}">{gender}</option>
                    </LOOP genderoption>
                </select></td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[Username: {7555}]</strong></td>
                <td align="left" valign="top"><input name="username" type="text" id="username" maxlength="{username_maxlen}" />
                    <br />
                  [Username must be between {username_minlen} and {username_maxlen} characters. Spaces or special characters are not allowed. Username is not case sensitive. {7560}] </td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[Password: {7570}] </strong></td>
                <td align="left" valign="top"><input name="password" type="password" id="password" />
                    <br />
                  [Password must be a minimum of {password_minlen} characters, spaces are not allowed. Password is not case sensitive. {7565}] </td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[Confirm Password: {7575}] </strong></td>
                <td align="left" valign="top"><input name="passcheck" type="password" id="passcheck" /></td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[Country: {7580}]</strong></td>
                <td align="left" valign="top"><select name="country" id="country">
                    <option value="United States" selected="selected">United States </option>
                  <option value="Afghanistan" > Afghanistan </option>
                  <option value="Albania" > Albania </option>
                  <option value="Algeria" > Algeria </option>
                  <option value="Andorra" > Andorra </option>
                  <option value="Angola" > Angola </option>
                  <option value="Antigua and Barbuda" > Antigua and Barbuda </option>
                  <option value="Argentina" > Argentina </option>
                  <option value="Armenia" > Armenia </option>
                  <option value="Aruba" > Aruba </option>
                  <option value="Australia" > Australia </option>
                  <option value="Austria" > Austria </option>
                  <option value="Azerbaidjan" > Azerbaijan </option>
                  <option value="Bahamas" > Bahamas </option>
                  <option value="Bahrain" > Bahrain </option>
                  <option value="Bangladesh" > Bangladesh </option>
                  <option value="Barbados" > Barbados </option>
                  <option value="Belarus" > Belarus </option>
                  <option value="Belgium" > Belgium </option>
                  <option value="Belize" > Belize </option>
                  <option value="Benin" > Benin </option>
                  <option value="Bermuda" > Bermuda </option>
                  <option value="Bhutan" > Bhutan </option>
                  <option value="Bolivia" > Bolivia </option>
                  <option value="Bosnia" > Bosnia </option>
                  <option value="Botswana" > Botswana </option>
                  <option value="Brazil" > Brazil </option>
                  <option value="Brunei" > Brunei </option>
                  <option value="Bulgaria" > Bulgaria </option>
                  <option value="Burkina Faso" > Burkina Faso </option>
                  <option value="Burma" > Burma </option>
                  <option value="Burundi" > Burundi </option>
                  <option value="Cambodia" > Cambodia </option>
                  <option value="Cameroon" > Cameroon </option>
                  <option value="Canada" > Canada </option>
                  <option value="Cape Verde" > Cape Verde </option>
                  <option value="Cayman Islands" > Cayman Islands </option>
                  <option value="Central African Republic" > Central Afr. Rep. </option>
                  <option value="Chad" > Chad </option>
                  <option value="Chile" > Chile </option>
                  <option value="China" > China </option>
                  <option value="Colombia" > Colombia </option>
                  <option value="Comoros" > Comoros </option>
                  <option value="Congo" > Congo </option>
                  <option value="Costa Rica" > Costa Rica </option>
                  <option value="Croatia" > Croatia </option>
                  <option value="Cuba" > Cuba </option>
                  <option value="Cyprus" > Cyprus </option>
                  <option value="Czech Republic" > Czech Republic </option>
                  <option value="Denmark" > Denmark </option>
                  <option value="Djibouti" > Djibouti </option>
                  <option value="Dominica" > Dominica </option>
                  <option value="Dominican Republic" > Dom. Republic </option>
                  <option value="Ecuador" > Ecuador </option>
                  <option value="Egypt" > Egypt </option>
                  <option value="El Salvador" > El Salvador </option>
                  <option value="Equatorial Guinea" > Equatorial Guinea </option>
                  <option value="Eritrea" > Eritrea </option>
                  <option value="Estonia" > Estonia </option>
                  <option value="Ethiopia" > Ethiopia </option>
                  <option value="Fiji" > Fiji </option>
                  <option value="Finland" > Finland </option>
                  <option value="France" > France </option>
                  <option value="Gabon" > Gabon </option>
                  <option value="Gambia" > Gambia </option>
                  <option value="Georgia" > Georgia </option>
                  <option value="Germany" > Germany </option>
                  <option value="Ghana" > Ghana </option>
                  <option value="Gibraltar" > Gibraltar </option>
                  <option value="Greece" > Greece </option>
                  <option value="Grenada" > Grenada </option>
                  <option value="Guadeloupe" > Guadeloupe </option>
                  <option value="Guatemala" > Guatemala </option>
                  <option value="Guinea" > Guinea </option>
                  <option value="Guinea-Bissau" > Guinea-Bissau </option>
                  <option value="Guyana" > Guyana </option>
                  <option value="Haiti" > Haiti </option>
                  <option value="Honduras" > Honduras </option>
                  <option value="Hong Kong" > Hong Kong </option>
                  <option value="Hungary" > Hungary </option>
                  <option value="Iceland" > Iceland </option>
                  <option value="India" > India </option>
                  <option value="Indonesia" > Indonesia </option>
                  <option value="Iran" > Iran </option>
                  <option value="Iraq" > Iraq </option>
                  <option value="Ireland" > Ireland </option>
                  <option value="Israel" > Israel </option>
                  <option value="Italy" > Italy </option>
                  <option value="Ivory Coast" > Ivory Coast </option>
                  <option value="Jamaica" > Jamaica </option>
                  <option value="Japan" > Japan </option>
                  <option value="Jersey" > Jersey </option>
                  <option value="Jordan" > Jordan </option>
                  <option value="Kazakhstan" > Kazakhstan </option>
                  <option value="Kenya" > Kenya </option>
                  <option value="Kuwait" > Kuwait </option>
                  <option value="Laos" > Laos </option>
                  <option value="Latvia" > Latvia </option>
                  <option value="Lebanon" > Lebanon </option>
                  <option value="Lesotho" > Lesotho </option>
                  <option value="Liberia" > Liberia </option>
                  <option value="Libya" > Libya </option>
                  <option value="Liechtenstein" > Liechtenstein </option>
                  <option value="Lithuania" > Lithuania </option>
                  <option value="Luxembourg" > Luxembourg </option>
                  <option value="Macau" > Macau </option>
                  <option value="Macedonia" > Macedonia </option>
                  <option value="Madagascar" > Madagascar </option>
                  <option value="Malawi" > Malawi </option>
                  <option value="Malaysia" > Malaysia </option>
                  <option value="Maldives" > Maldives </option>
                  <option value="Mali" > Mali </option>
                  <option value="Malta" > Malta </option>
                  <option value="Martinique" > Martinique </option>
                  <option value="Mauritania" > Mauritania </option>
                  <option value="Mauritius" > Mauritius </option>
                  <option value="Mexico" > Mexico </option>
                  <option value="Moldova" > Moldova </option>
                  <option value="Monaco" > Monaco </option>
                  <option value="Mongolia" > Mongolia </option>
                  <option value="Morocco" > Morocco </option>
                  <option value="Mozambique" > Mozambique </option>
                  <option value="Namibia" > Namibia </option>
                  <option value="Nepal" > Nepal </option>
                  <option value="Netherlands" > Netherlands </option>
                  <option value="Netherlands Antilles" > Netherlands Antilles </option>
                  <option value="New Zealand" > New Zealand </option>
                  <option value="Nicaragua" > Nicaragua </option>
                  <option value="Niger" > Niger </option>
                  <option value="Nigeria" > Nigeria </option>
                  <option value="North Korea" > North Korea </option>
                  <option value="Norway" > Norway </option>
                  <option value="Oman" > Oman </option>
                  <option value="Pakistan" > Pakistan </option>
                  <option value="Panama" > Panama </option>
                  <option value="Paraguay" > Paraguay </option>
                  <option value="Peru" > Peru </option>
                  <option value="Philippines" > Philippines </option>
                  <option value="Poland" > Poland </option>
                  <option value="Portugal" > Portugal </option>
                  <option value="Qatar" > Qatar </option>
                  <option value="Romania" > Romania </option>
                  <option value="Russia" > Russia </option>
                  <option value="Rwanda" > Rwanda </option>
                  <option value="San Marino" > San Marino </option>
                  <option value="Saudi Arabia" > Saudi Arabia </option>
                  <option value="Senegal" > Senegal </option>
                  <option value="Seychelles" > Seychelles </option>
                  <option value="Sierra Leone" > Sierra Leone </option>
                  <option value="Singapore" > Singapore </option>
                  <option value="Slovakia" > Slovakia </option>
                  <option value="Slovenia" > Slovenia </option>
                  <option value="Somalia" > Somalia </option>
                  <option value="South Africa" > South Africa </option>
                  <option value="South Korea" > South Korea </option>
                  <option value="Spain" > Spain </option>
                  <option value="Sri Lanka" > Sri Lanka </option>
                  <option value="Sudan" > Sudan </option>
                  <option value="Suriname" > Suriname </option>
                  <option value="Sweden" > Sweden </option>
                  <option value="Switzerland" > Switzerland </option>
                  <option value="Syria" > Syria </option>
                  <option value="Taiwan" > Taiwan </option>
                  <option value="Tajikistan" > Tajikistan </option>
                  <option value="Tanzania" > Tanzania </option>
                  <option value="Thailand" > Thailand </option>
                  <option value="Togo" > Togo </option>
                  <option value="Trinidad and Tobago" > Trinidad and Tobago </option>
                  <option value="Tunisia" > Tunisia </option>
                  <option value="Turkey" > Turkey </option>
                  <option value="Turkmenistan" > Turkmenistan </option>
                  <option value="Turks and Caicos Islands" > Turks and Caicos Islands </option>
                  <option value="Uganda" > Uganda </option>
                  <option value="Ukraine" > Ukraine </option>
                  <option value="United Arab Emirates" > U.A.E. </option>
                  <option value="United Kingdom" > United Kingdom </option>
                  <option value="United States" > United States </option>
                  <option value="Uruguay" > Uruguay </option>
                  <option value="Uzbekistan" > Uzbekistan </option>
                  <option value="Venezuela" > Venezuela </option>
                  <option value="Vietnam" > Vietnam </option>
                  <option value="Yemen" > Yemen </option>
                  <option value="Yugoslavia" > Yugoslavia </option>
                  <option value="Zambia" > Zambia </option>
                  <option value="Zimbabwe" > Zimbabwe </option>
                </select>                </td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[State / Province: {7585}] </strong></td>
                <td align="left" valign="top"><input name="state" type="text" id="state" /></td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[City: {7590}]</strong></td>
                <td align="left" valign="top"><input name="city" type="text" id="city" /></td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[Zip / Postal Code: {7595}]</strong></td>
                <td align="left" valign="top"><input name="zipcode" type="text" id="zipcode" /></td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><strong>[Verification Code: {7600}] </strong></td>
                <td align="left" valign="top"><img src="system/writer.php?R=0&amp;T={vcode}&amp;W=100&amp;H=20&amp;FC=16.16.16&amp;BC=16.16.16&amp;D=0&amp;S=1&amp;FS=15&amp;X=15&amp;Y=15" alt="[Code {7655}]" />
                    <input type="hidden" name="syscode" value="{vcode}" />
                    <strong>[Enter Code: {7605}]</strong>
                    <input name="code" type="text" id="code" />
                    <br />
                  [You must enter the verification code in the box above. {7610}] </td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top"><input name="agree" type="checkbox" id="agree" value="true" /></td>
                <td align="left" valign="top"><label for="agree"><strong>[I accept and agree to the user agreement {7615}] </strong></label></td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top">&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
              </tr>
              <tr>
                <td width="150" align="right" valign="top">&nbsp;</td>
                <td align="left" valign="top"><input type="submit" name="Submit" id="Submit" value="[Continue {7620}]" /></td>
              </tr>
            </table>
            </ZONE regform regform>
            <ZONE error emailClone>
			  <h1>[Error! {160}] </h1>
			  <p>[Sorry, that email address is already registered on this website {7640}]</p>
			</ZONE error emailClone>
			<ZONE error email>
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td colspan="2"><h1>[Error! {160}] </h1></td>
                </tr>
                <tr>
                  <td colspan="2">[Your email address has an error, please make sure you type it correctly. {7635}] </td>
                </tr>
                <tr>
                  <td width="150" align="right"><strong>[Email Address: {7530}] </strong></td>
                  <td><input name="email" type="text" size="50" id="email" /></td>
                </tr>
                <tr>
                  <td width="150" align="right">&nbsp;</td>
                  <td><input name="Correct" type="submit" id="Correct" value="[Continue {7620}]" /></td>
                </tr>
              </table>
            </ZONE error email>
            <ZONE error username>
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td colspan="2"><h1>[Error! {160}] </h1></td>
                </tr>
                <tr>
                  <td colspan="2">
				  <ZONE usernameerror lenerror>
				  [Your username was not formatted correctly. Username must be between {username_minlen} and {username_maxlen} characters long. A-Z, a-z, 0-9, dash and underscore are allowed. {7625}]
				  </ZONE usernameerror lenerror>
				  <ZONE usernameerror inuse>
				  [The username you entered is already in use, please choose another. {7626}]
				  </ZONE usernameerror inuse>
				  </td>
                </tr>
                <tr>
                  <td width="150" align="right"><strong>[Username: {7555}]</strong></td>
                  <td><input name="username" type="text" id="username" /></td>
                </tr>
                <tr>
                  <td width="150" align="right">&nbsp;</td>
                  <td><input name="Correct" type="submit" id="Correct" value="[Continue {7620}]" /></td>
                </tr>
              </table>
            </ZONE error username>
            <ZONE error password>
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td colspan="2"><h1>[Error! {160}] </h1></td>
                </tr>
                <tr>
                  <td colspan="2"><ZONE passworderror lenghterr> [The password you entered was too short. Please make sure your password is at least {password_minlen} characters long.</ZONE passworderror lenghterr>
                      <ZONE passworderror nomatch> The password you entered does not match the password confirmation, please try again. {7630}] </ZONE passworderror nomatch>                  </td>
                </tr>
                <tr>
                  <td width="150" align="right"><strong>[Password: {7570}] </strong></td>
                  <td><input name="password" type="password" id="password" /></td>
                </tr>
                <tr>
                  <td width="150" align="right"><strong>[Confirm Password: {7575}]</strong> </td>
                  <td><input name="passcheck" type="password" id="passcheck" /></td>
                </tr>
                <tr>
                  <td width="150" align="right">&nbsp;</td>
                  <td><input name="Correct" type="submit" id="Correct" value="[Continue {7620}]" /></td>
                </tr>
              </table>
            </ZONE error password>
            <ZONE error code>
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td colspan="2"><h1>[Error! {160}] </h1></td>
                </tr>
                <tr>
                  <td colspan="2">[The verification code you entered does not match, please try again. {7645}]</td>
                </tr>
                <tr>
                  <td width="150" align="right"><strong>[Verification code: {7600}]</strong></td>
                  <td><img src="system/writer.php?R=0&amp;T={vcode}&amp;W=100&amp;H=20&amp;FC=16.16.16&amp;BC=16.16.16&amp;D=0&amp;S=1&amp;FS=15&amp;X=15&amp;Y=15" alt="[Code {7655}]" />
                      <input type="hidden" name="syscode" value="{vcode}" /></td>
                </tr>
                <tr>
                  <td width="150" align="right"><strong>[Enter Code: {7605}]</strong> </td>
                  <td><input name="code" type="text" id="code" /></td>
                </tr>
                <tr>
                  <td width="150" align="right">&nbsp;</td>
                  <td><input name="Correct" type="submit" id="Correct" value="[Continue {7620}]" /></td>
                </tr>
              </table>
            </ZONE error code>
            
			<ZONE error age>
<table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td colspan="2"><h1>[Error! {160}] </h1></td>
                </tr>
                <tr>
                  <td colspan="2">Sorry you are too young to register on this website.</td>
                </tr>
              </table>
			</ZONE error age>
			
			<ZONE regform success>
              <h1>[Success! {315}] </h1>
              [This was a success... Please check your emails. {7650}] </ZONE regform success>
            </td>
        </tr>
        <tr>
          <td bgcolor="#DCE6FF">&nbsp;</td>
          <td bgcolor="#DCE6FF">&nbsp;</td>
        </tr>
        <tr>
          <td height="2" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
        </tr>
        <tr>
          <td colspan="2" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[Step 1 out of 2 {7660}] </h1></td>
        </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->