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
        <td colspan="2">
		  <h1>[Forums {6585}] </h1>
          <p>[Welcome to the forum, please follow the forum rules. {6590}] </p>
          <p><br />
            <!-- breadcrumbs --><a href="?L=inkspot.write">[Create a Topic {6595}] </a> | <a href="?L=inkspot.search">[Search {300}]</a><a href="?L=users.settings"></a> <!-- /breadcrumbs --></p></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF">
		  <div class="tabber"> 
            <div class="tabbertab">
              <h2>[Popular Topics {6600}] </h2>
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="30">&nbsp;</td>
                  <td><strong>[Topic {545}] </strong></td>
                  <td width="50"><strong>[User {550}] </strong></td>
                  <td width="50"><strong>[Replies {555}] </strong></td>
                  <td width="80" align="right"><strong>[Date {135}] </strong></td>
                </tr>
                <tr>
                  <td height="1" colspan="5" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                </tr>
                <LOOP popularTopicsList>
                  <tr>
                    <td width="30"><a href="?L=users.profile&amp;id={pop.userid}"><img src="system/image.php?file={pop.mainpicture}&amp;width=30" alt="{username}" name="picture" hspace="2" border="0" align="left" id="picture" /></a></td>
                    <td><a href="?L=inkspot.topic&amp;id={pop.id}">{pop.topic}</a></td>
                    <td>{pop.username}</td>
                    <td>{pop.count}</td>
                    <td align="right">{pop.date}</td>
                  </tr>
                  <tr>
                    <td height="1" colspan="5" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                  </tr>
                </LOOP popularTopicsList>
              </table>
              <p>&nbsp;</p>
            </div>
            
			<div class="tabbertab">
              <h2>[Last Topics {6605}] </h2>
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="30">&nbsp;</td>
                  <td><strong>[Topic {545}]</strong></td>
                  <td width="50"><strong>[User {550}] </strong></td>
                  <td width="50"><strong>[Replies {555}] </strong></td>
                  <td width="80" align="right"><strong>[Date {135}] </strong></td>
                </tr>
                <tr>
                  <td height="1" colspan="5" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                </tr>
                <LOOP lastTopicsList>
                  <tr>
                    <td width="30"><a href="?L=users.profile&amp;id={last.userid}"><img src="system/image.php?file={last.mainpicture}&amp;width=30" alt="{username}" name="picture" hspace="2" border="0" align="left" id="picture" /></a></td>
                    <td><a href="?L=inkspot.topic&amp;id={last.id}">{last.topic}</a></td>
                    <td>{last.username}</td>
                    <td>{last.count}</td>
                    <td align="right">{last.date}</td>
                  </tr>
                  <tr>
                    <td height="1" colspan="5" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                  </tr>
                </LOOP lastTopicsList>
              </table>
			  <p>&nbsp;</p>
            </div>
			
			<div class="tabbertab">
              <h2>[Participating Topics {6610}] </h2>
              <table width="100%" border="0" cellspacing="3" cellpadding="0">
                <tr>
                  <td width="30">&nbsp;</td>
                  <td><strong>[Topic {545}] </strong></td>
                  <td width="50"><strong>[User {550}] </strong></td>
                  <td width="50"><strong>[Replies {555}] </strong></td>
                  <td width="80" align="right"><strong>[Date {135}] </strong></td>
                </tr>
                <tr>
                  <td height="1" colspan="5" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                </tr>
                <LOOP participateTopicsList>
                  <tr>
                    <td width="30"><a href="?L=users.profile&amp;id={par.userid}"><img src="system/image.php?file={par.mainpicture}&amp;width=30" alt="{username}" name="picture" hspace="2" border="0" align="left" id="picture" /></a></td>
                    <td><a href="?L=inkspot.topic&amp;id={par.id}">{par.topic}</a></td>
                    <td>{par.username}</td>
                    <td>{par.count}</td>
                    <td align="right">{par.date}</td>
                  </tr>
                  <tr>
                    <td height="1" colspan="5" bgcolor="#BBD4F9"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
                  </tr>
                </LOOP participateTopicsList>
              </table>
			  <p>&nbsp;</p>
            </div>
          </div></td>
        <td width="20" bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
        </tr>
    </table><!-- /leftpane --></td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[Spot Subjects {6615}] </h1></td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><p>[{total.posts} posts in {total.topics} topics ({total.subjects} subjects) {6620}] </p>
		  <br />
		  <LOOP inkSpotSubjects>
		    <a href="?L=inkspot.subject&id={subject.id}">{subject.title}</a> <br />
		    {subject.topicCount} topics, {subject.postCount} posts <br />
		    <br />
		  </LOOP inkSpotSubjects>
		  <br /><br />		</td>
      </tr>
    </table>
    <!-- /rightpane --></td>
  </tr>
</table>
<!-- footer --><!-- /footer -->