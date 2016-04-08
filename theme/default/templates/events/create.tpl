<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top"><!-- leftpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><h1>[Create a new event {6085}] </h1>
                  [Want to tell  {siteName} members about a party or special event?&nbsp; Get off to a great start by posting all  related news about your event today! {6090}] <br />
                      <br />
                      <!-- breadcrumbs --><a href="?L=users.desktop">[My Desktop {320}]</a> | <a href="?L=events.daily&amp;ut={today.ut}">[Today's Events {6100}] </a><!-- /breadcrumbs --></td>
            <td align="right" valign="top"><img src="theme/default/images/icons/headers/calendar_create.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
          </tr>
        </table></td>
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
        <td height="6" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="6" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF" style="padding-right:10px;">
		<ZONE createEventHeader success>
		<h2>[Success! {315}] </h2>
		<p>[Your Event has been added to the events calendar. Would you like to add another event? {6105}] <br />
		    <br />
		      <a href="?L=events.event&amp;id={this.eventID}">[View event listing {6110}]</a></p>
		<br/><br/>
		</ZONE createEventHeader success>
		
		<ZONE createEventHeader retroDate>
		<h2>[Error {160}] </h2>
		<p>[Sorry, you can not set an event to be attended on a past date. Please start over {6115}] </p>
		<br/><br/>
		</ZONE createEventHeader retroDate>
		
		<ZONE createEventHeader emptyField>
		<h2>[Error {160}] </h2>
		<p>[Either the title or the description field has been left empty, you must set a title and a description {6120}] </p>
		<br/><br/>
		</ZONE createEventHeader emptyField>
		
		
		<ZONE createEventHeader enabled>
		<h2>[Event details {6125}] </h2>
		</ZONE createEventHeader enabled>
		
		<ZONE createEventForm enabled>
          <form method="post" enctype="multipart/form-data">
		  <table width="100%" border="0" cellspacing="3" cellpadding="0">
            <tr>
              <td valign="top">[Event Title: {6130}] </td>
              <td><input name="title" type="text" class="fullwidth" id="title"></td>
            </tr>
            <tr>
              <td valign="top">[Description: {6135}] </td>
              <td><textarea name="body" rows="8" class="fullwidth" id="body"></textarea></td>
            </tr>
            <tr>
              <td valign="top">[Show to: {6140}] </td>
              <td>
			    <label><input name="display" type="radio" value="private" checked> 
			    [Me {6145}] </label>
			    <label><br>
			    <input name="display" type="radio" value="shared">
			    [My Contacts {6150}] </label>
			    <br>
                <label><input name="display" type="radio" value="public">
                [All the users {6155}] </label></td>
            </tr>
            <tr>
              <td valign="top">[Date: {6160}] </td>
              <td><select name="date_m" id="date_m">
                <option value="1">[January {55}]</option>
                <option value="2">[February {60}]</option>
                <option value="3">[March {65}]</option>
                <option value="4">[April {70}]</option>
                <option value="5">[May {75}]</option>
                <option value="6">[June {80}]</option>
                <option value="7">[July {85}]</option>
                <option value="8">[August {90}]</option>
                <option value="9">[September {95}]</option>
                <option value="10">[October {100}]</option>
                <option value="11">[November {105}]</option>
                <option value="12">[December {110}]</option>
              </select>
                <select name="date_d" id="date_d">
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
                <select name="date_y" id="date_y">
                  <LOOP yearsOptions>
                    <option value="{year.value}" selected>{year.value}</option>
                  </LOOP yearsOptions>
                      </select></td>
            </tr>
            <tr>
              <td valign="top">[Starts at: {6165}] </td>
              <td><select name="date_h" id="date_h">
					<option value="0" selected>12 am</option>
					<option value="1">1 am</option>
					<option value="2">2 am</option>
					<option value="3">3 am</option>
					<option value="4">4 am</option>
					<option value="5">5 am</option>
					<option value="6">6 am</option>
					<option value="7">7 am</option>
					<option value="8">8 am</option>
					<option value="9">9 am</option>
					<option value="10">10 am</option>
					<option value="11">11 am</option>
					<option value="12">12 pm</option>
					<option value="13">1 pm</option>
					<option value="14">2 pm</option>
					<option value="15">3 pm</option>
					<option value="16">4 pm</option>
					<option value="17">5 pm</option>
					<option value="18">6 pm</option>
					<option value="19">7 pm</option>
					<option value="20">8 pm</option>
					<option value="21">9 pm</option>
					<option value="22">10 pm</option>
					<option value="23">11 pm</option>
              </select>
			        <select name="date_i" class="style2" id="date_i">
					<option value="0" selected>:00</option>
					<option value="15">:15</option>
					<option value="30">:30</option>
					<option value="45">:45</option>
            </select>			  </td>
            </tr>
            <tr>
              <td valign="top">[Location: {6170}] </td>
              <td><input name="location" type="text" class="fullwidth" id="location"></td>
            </tr>
            <tr>
              <td valign="top">[Upload Photo: {480}] </td>
              <td><input type="file" name="file"></td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td valign="top">&nbsp;</td>
              <td><input type="submit" name="Submit" value="[Submit {295}]" class="submit"></td>
            </tr>
          </table> 
		  </form>
		  </ZONE createEventForm enabled>
		  
		  <ZONE createEventForm guest>
		  <p>[Sorry, guests can not create events {6175}]| <a href="?L=registration.register">[Register {305}]</a></p>
		  </ZONE createEventForm guest>
		  
          <p>&nbsp;</p></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
    </table><!-- /leftpane -->
    <br />
    <br /></td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table>
<!-- footer --><!-- /footer -->