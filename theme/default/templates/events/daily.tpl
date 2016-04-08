<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
            <td valign="top"><h1>[Events on {day.month} {day.date.jS} {6180}] </h1>
              [Here are the  events scheduled for today by {siteName} members.&nbsp; Break away from your normal routine and enjoy  meeting new people by attending an event near you! {6185}] <br />
                  <br />
                  <!-- breadcrumbs --><a href="?L=users.desktop">[My Desktop {320}]</a> | <a href="?L=events.daily&ut={day.ut}">[Events Today {6190}] </a><!-- /breadcrumbs --></td>
            <td align="right" valign="top"><h1><img src="theme/default/images/icons/headers/calendar.gif" alt="[Calendar {350}" width="100" height="100" /></h1>                </td>
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
		<h2>[Events list for the day {6195}] </h2>
		<ZONE eventsBlock enabled>
		<LOOP eventsList>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><h4><a href="?L=events.event&id={event.id}">{event.time} {event.title}</a></h4>              <h6><img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {event.date}</h6></td>
            </tr>
          <tr>
            <td>{event.body} ... <a href="?L=events.event&id={event.id}">[Event Details {6200}]</a></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td height="1" bgcolor="#AEC9FF"><span class="small"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></span></td>
          </tr>
        </table>
		</LOOP eventsList>
		</ZONE eventsBlock enabled>
		
		<ZONE eventsBlock noEvent>[Sorry there is no event on that day {6205}]</ZONE eventsBlock noEvent>
		
		</td>
      </tr>
      <tr>
        <td height="10" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
      </tr>
      <tr>
        <td height="2" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[Next Events {6210}] </h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td style="background-repeat:no-repeat;"><p>[Here are the events for the next 3 months. {6215}] </p>
          <p>&nbsp; </p></td>
        <td style="background-repeat:no-repeat;">&nbsp;</td>
      </tr>
      <tr>
        <td style="background-repeat:no-repeat;"><h4>{thisMonthCalendarTopic}</h4>
          <p>{thisMonthCalendar}</p>
          <h4>{lastMonthCalendarTopic}</h4>
          <p>{lastMonthCalendar}</p>
          <h4>{thirdMonthCalendarTopic}</h4>
          <p>{thirdMonthCalendar}</p></td>
        <td style="background-repeat:no-repeat;">&nbsp;</td>
      </tr>
      <tr>
        <td height="5" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td><h2>[Next 20 events {6220}] </h2>
          <p>
            <LOOP nextEvents> <img src="{themePath}/images/icons/icon_link.gif" alt="[Bullet {145}]" align="baseline" /> <a href="?L=events.event&id={nextEvent.id}">{nextEvent.date}: {nextEvent.title}</a><br />
            </LOOP nextEvents>
          </p>
          <p>&nbsp; </p>
          <p><a href="?L=events.create">[Create an event {6225}]</a> | <a href="#">[My Calendar {490}] </a></p></td>
        <td>&nbsp;</td>
      </tr>

      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td height="1" colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>



      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->
<OBJ month_1>[January {55}]</OBJ month_1>
<OBJ month_2>[February {60}]</OBJ month_2>
<OBJ month_3>[March {65}]</OBJ month_3>
<OBJ month_4>[April {70}]</OBJ month_4>
<OBJ month_5>[May {75}]</OBJ month_5>
<OBJ month_6>[June {80}]</OBJ month_6>
<OBJ month_7>[July {85}]</OBJ month_7>
<OBJ month_8>[August {90}]</OBJ month_8>
<OBJ month_9>[September {95}]</OBJ month_9>
<OBJ month_10>[October {100}]</OBJ month_10>
<OBJ month_11>[November {105}]</OBJ month_11>
<OBJ month_12>[December {110}]</OBJ month_12>