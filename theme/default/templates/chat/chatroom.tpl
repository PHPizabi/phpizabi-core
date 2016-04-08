<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div id="topicHeader" style="clear: none; padding-left:10px; overflow:hidden; width:100%;"><h1><img src="theme/default/images/icons/chat/headers/1.gif" id="headerImage" height="28" width="28" align="absmiddle" />&nbsp;Now talking in {channel}</h1></div></td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
	  <tr>
	    <td height="20" valign="top" bgcolor="#BBD4F9" style="padding-left:10px;"><img src="{themePath}/images/icons/comment.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="left" /> <div id="topicHandle" style="clear:none; color:#2f63b3; padding-left:5px; overflow:hidden; width:100%; height:14px;">&nbsp;</div></td>
	    <td height="20" valign="top" bgcolor="#BBD4F9">&nbsp;</td>
	    <td height="20" align="right" valign="top" bgcolor="#BBD4F9"><div style="padding-right:10px;"><!-- breadcrumbs -->
{channel} <a href="javascript:detachChat();">[x {3035}]</a><!-- /breadcrumbs --></div></td>
	    <td height="20" valign="top" bgcolor="#BBD4F9">&nbsp;</td>
	  </tr>
      <tr>
        <td valign="top" bgcolor="#DCE6FF">
		<div id="chatBlockWrapper">
		  <div id="chatContent"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></div>
		</div>		</td>
        <td width="10" valign="top" bgcolor="#DCE6FF">&nbsp;</td>
        <td width="200" valign="top" bgcolor="#DCE6FF">
		  <div id="nickList">		  </div>		</td>
        <td width="10" valign="top" bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" valign="top" bgcolor="#DCE6FF"><input name="text" type="text" id="textInput" onkeydown="javascript:if(event.keyCode=='9') { keyEventHandler(event.keyCode); return false; void(0); }" onkeyup="javascipt:if(event.keyCode!='9') { keyEventHandler(event.keyCode); }" class="fullwidth" maxlength="500" /></td>
        <td colspan="2" valign="top" bgcolor="#DCE6FF">
		<select name="userAction" id="userAction" class="fullwidth" onchange="Javascript:actUser();">
          <option selected="selected">[With selected user ... {3015}]</option>
		  <option value="slap">[Slap {3020}]</option>
		  <option value="kiss">[Kiss {3025}]</option>
		  <option value="beat">[Beat {3030}]</option>
        </select>        </td>
        </tr>
      <tr>
        <td colspan="4" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td height="20" colspan="4">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

<div id="detachedInfoDiv" style="visibility:hidden">
  [Chat window detached, you can now browse the site using that window! {2095}]
</div>

<div id="debugLink"><a href="javascript:showDebug();">[Debug</a> {3000}] </div>
<div id="debug" style="
	visibility: hidden;
	width: 400px;
	height: 500px;
	background-color: #999933;
	overflow: scroll;
	position: absolute;
	top: 10px;
	left: 10px;
	padding: 10px;
	border: solid 3px #000;
"><table width="100%" border="0"><tr><td><h2>[DO NOT REPORT! {3005}] </h2></td>
<td align="right"><a href="javascript:clearDebug();">[Clear {3010}] </a></td>
</tr></table></div>

<div id="shadeWrapper"></div>
<div id="noShadeContent"><a href="Javascript:hideUserPicture();"><img id="dynamicUserPictureViewer" class="picture" /></a></div>

<div id="commandsHelper" style="visibility:hidden; padding:2px; background-color:#FFCC66; border: solid 1px #FF6600; width: 500px;"></div>
<!-- footer --><!-- /footer -->
<script language="javascript" type="text/javascript" src="theme/default/javascript.js"></script>
<script language="javascript" type="text/javascript">
launchTRITON();
</script>
