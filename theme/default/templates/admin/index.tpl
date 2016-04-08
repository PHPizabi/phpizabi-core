<h2>Administration Panel Home </h2>
<p>Welcome to {siteName}'s administration area.  Please take the time to familiarize yourself with the available menu's to ensure that you secure your site, and configure it to your needs.</p>
<p>&nbsp;</p>
<h2>Site Statistics </h2>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><a href="system/grapher.php?&amp;title=Live Hits Today&amp;size=1024,768&amp;y_legend=Hits Per Hour&amp;array={today.by_hour}"><img src="system/grapher.php?&amp;title=Live Hits Today&size=350,200&amp;y_legend=Hits Per Hour&array={today.by_hour}" alt="Graph" border="0" /></a></td>
    <td width="10" rowspan="2">&nbsp;</td>
    <td valign="top"><a href="system/grapher.php?&amp;title=Hits / day in the last 30 days&amp;size=1024,768&amp;y_legend=Hits per day&amp;array={s_hits}"><img src="system/grapher.php?&amp;title=Hits / day in the last 30 days&amp;size=350,200&amp;y_legend=Hits per day&amp;array={s_hits}" alt="Graph" border="0" /></a></td>
  </tr>
  <tr>
    <td valign="top"><table border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td><strong>Total Hits Today: </strong></td>
        <td>&nbsp;</td>
        <td>{today.total_hits}</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td><strong>Total Hits: (30 days) </strong></td>
        <td>&nbsp;</td>
        <td>{s.hits_total}</td>
      </tr>
      <tr>
        <td><strong>Peak Hits: (30 days) </strong></td>
        <td>&nbsp;</td>
        <td>{s.hits_peak} hits on {s.hits_peak_date}</td>
      </tr>
      <tr>
        <td><strong>Avg. Hits / day: (30 days) </strong></td>
        <td>&nbsp;</td>
        <td>~ {s.hits_avg}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><a href="system/grapher.php?&amp;title=Distinct IP / day in the last 30 days&amp;size=1024,768&amp;y_legend=Distinct per day&amp;array={s_ip}"><img src="system/grapher.php?&amp;title=Distinct IP / day in the last 30 days&amp;size=350,200&amp;y_legend=Distinct per day&amp;array={s_ip}" alt="Graph" border="0" /></a></td>
    <td width="10" rowspan="2">&nbsp;</td>
    <td valign="top"><a href="system/grapher.php?&amp;title=Distinct users / day in the last 30 days&amp;size=1024,768&amp;y_legend=Distinct per day&amp;array={s_us}"><img src="system/grapher.php?&amp;title=Distinct users / day in the last 30 days&amp;size=350,200&amp;y_legend=Distinct per day&amp;array={s_us}" alt="Graph" border="0" /></a></td>
  </tr>
  <tr>
    <td valign="top"><table border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td><strong>Total  IP: (30 days) </strong></td>
        <td>&nbsp;</td>
        <td>{s.ip_total}</td>
      </tr>
      <tr>
        <td><strong>Peak  IP: (30 days) </strong></td>
        <td>&nbsp;</td>
        <td>{s.ip_peak} distinct IP on {s.ip_peak_date}</td>
      </tr>
      <tr>
        <td><strong>Avg.  IP / day: (30 days) </strong></td>
        <td>&nbsp;</td>
        <td>~ {s.ip_avg}</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="3" cellpadding="0">
      <tr>
        <td><strong>Total  Users: (30 days) </strong></td>
        <td>&nbsp;</td>
        <td>{s.us_total}</td>
      </tr>
      <tr>
        <td><strong>Peak  Users: (30 days) </strong></td>
        <td>&nbsp;</td>
        <td>{s.us_peak} distinct users on {s.us_peak_date}</td>
      </tr>
      <tr>
        <td><strong>Avg.  Users / day: (30 days) </strong></td>
        <td>&nbsp;</td>
        <td>~ {s.us_avg}</td>
      </tr>
    </table></td>
  </tr>
</table>