<?php
///////////////////////////////////////////////////////////////////////////////////////
// PHPizabi 2.01 Alpha [Madison]                             http://www.phpizabi.org //
///////////////////////////////////////////////////////////////////////////////////////
//                                                                                   //
// Please read the LICENSE.md & README.md file before using/modifying this software  //
//                                                                                   //
// Developing Author:       Andrew James, RubberDucky - andy@phpizabi.org            //
// Last modification date:  December 13th, 201                                       //
// Version:                 PHPizabi 2.01 Alpha                                      //
//                                                                                   //
// (C) 2005, 2006 Real!ty Medias                                                     //
// (C) 2007-2012 AndyJames.Org                                                       //
//                                                                                   //
// PHPizabi Is the work of a very talented development team. This script is our      //
// Pride and Joy. We hope that you enjoy using this software as much as we enjoy     //
// Developing it for you. If you need anything: http://www.phpizabi.org              //
//                                                                                   //
///////////////////////////////////////////////////////////////////////////////////////
	if (me("id")) {
		$_SESSION["triton"]["id"] = me("id");
		$_SESSION["triton"]["nickname"] = me('username');
		$_SESSION["triton"]["age"] = me('age');
		$_SESSION["triton"]["gender"] = me('gender');
		$_SESSION["triton"]["mainpicture"] = me('mainpicture');
		$_SESSION["triton"]["logintime"] = time();
		
		if (is_mop()) $_SESSION["triton"]["ircop"] = true;

		session_write_close();
	}
?>

<script type="text/javascript">

/* global definitions */
var tritonInitComplete = false;
var selectedNode = 'channel';
var channelTopic = '';
var scrollerActivated = true;

var usersInChat = new Array;
var chatDataBuffer = new Object;

/* Triton Chat Starter */
function launchTRITON() {
	if (!tritonInitComplete) {
		ajFetch('modules/chat/dac.php?firstload=1', 'processReceivedData', false, 0);
		ajFetch('modules/chat/dac.php', 'processReceivedData', true, 3000);
		onlineTimerUpdate();
		tritonInitComplete = true;
	}
	document.getElementById('textInput').focus();
}

/* RX data processor */
function processReceivedData(data) {
	streamLines = data.split('\n');
	for (var n=0; n < streamLines.length; n++) {
		if (trim(streamLines[n]) != '') {
			contentArray = streamLines[n].split('\t');

			switch(contentArray[0]) {
				
				case 'CHANNELSTRING':
					if (!chatDataBuffer.channel) chatDataBuffer.channel = urlDecode(contentArray[3]) + '<br />';
					else {
						chatDataBuffer.channel = chatDataBuffer.channel.substring(
							(chatDataBuffer.channel.length - 10000 > 0 ? chatDataBuffer.channel.length - 10000 : 0), 
							chatDataBuffer.channel.length) + urlDecode(contentArray[3]) + '<br />';
					}
					showBuffer('channel');
				break;
				
				case 'CHANNELNAME':
					var channelNode = document.getElementById('nodeElement_channel');
					if (channelNode.innerHTML != urlDecode(contentArray[1])) channelNode.innerHTML = urlDecode(contentArray[1]);
				break;
				
				case 'PRIVMSG':
					if (!document.getElementById('nodeElement_' + contentArray[1])) {
						var containerElement = document.getElementById('chat_nodes');
						var newNodeContainer = document.createElement('div');
						newNodeContainer.setAttribute('id', 'nodeElement_' + contentArray[1]);
						newNodeContainer.setAttribute('class', 'disabledNode');
						newNodeContainer.setAttribute('className', 'disabledNode');
						newNodeContainer.setAttribute('onClick', 'selectNode(this.innerHTML);');

						newNodeContainer.innerHTML = urlDecode(contentArray[1]);
						containerElement.appendChild(newNodeContainer);
						
						containerElement.innerHTML = containerElement.innerHTML;
					}
			
					if (!chatDataBuffer[contentArray[1]]) chatDataBuffer[contentArray[1]] = urlDecode(contentArray[3]) + '<br />';
					else {
						chatDataBuffer[contentArray[1]] = chatDataBuffer[contentArray[1]].substring(
							(chatDataBuffer[contentArray[1]].length - 10000 > 0 ? chatDataBuffer[contentArray[1]].length - 10000 : 0), 
							chatDataBuffer[contentArray[1]].length) + urlDecode(contentArray[3]) + '<br />';
					}	
					showBuffer(contentArray[1]);
				break;
				
				case 'NICKLISTPUSH':
					if (!document.getElementById('nickElement_'+contentArray[1])) {
						/* Push an element into the nicklist */
						var containerElement = document.getElementById('nickList');
						var newNickContainer = document.createElement('div');
						newNickContainer.setAttribute('id', 'nickElement_'+contentArray[1]);
						newNickContainer.innerHTML = urlDecode(contentArray[2]);
						containerElement.appendChild(newNickContainer);
						
						usersInChat.push(contentArray[1]);
					}
				break;
				
				case 'NICKLISTPOP':
					/* Pop an element off the nicklist */
					if (document.getElementById('nickElement_'+contentArray[1])) {
						var containerElement = document.getElementById('nickList');
						containerElement.removeChild('nickElement_'+contentArray[1]);
					}
					array_pop(usersInChat, contentArray[1]);
				break;
				
				case 'NICKNAMES':
					/* TEMPORARY TEMPORARY TEMPORARY TEMPORARY TEMPORARY TEMPORARY TEMPORARY TEMPORARY */
					var containerElement = document.getElementById('nickContent');
					containerElement.innerHTML = contentArray[1];
				break;
				
				case 'TOPIC':
					channelTopic = urlDecode(contentArray[1]);
					if (selectedNode == 'channel')
						document.getElementById('chat_topic').innerHTML = urlDecode(contentArray[1]);
				break;
				
				case 'LATENCY':
					document.getElementById('chat_footer').innerHTML = urlDecode(contentArray[1]);
				break;
				
				default:
					document.getElementById('chatContentBlock').innerHTML += streamLines[n] + '<br />';
					scrollDown();
				break;
			}
		}
	}
}

/* Node event handling */
function selectNode(node) {
	selectedNode = node;
	
	var containerElement = document.getElementById('chat_nodes');
	for (var i=0; i < containerElement.childNodes.length; i++)
		if (containerElement.childNodes[i].className == 'enabledNode')
			containerElement.childNodes[i].className = 'disabledNode';
	
	document.getElementById('nodeElement_' + node).className = 'enabledNode';
	
	/* Enable / Disable nicklist */
	if (node != 'channel') {
		document.getElementById('chatContentBlock').className = 'chatContentBlockPrivate';
		document.getElementById('nickContent').className = 'nickContentPrivate';
		document.getElementById('chat_topic').innerHTML = node;
	}
	else {
		document.getElementById('chatContentBlock').className = 'chatContentBlock';
		document.getElementById('nickContent').className = 'nickContent';
		document.getElementById('chat_topic').innerHTML = channelTopic;
	}
	
	showBuffer(node);
}

function killNode() {
	if (selectedNode != 'channel' && document.getElementById('nodeElement_' + selectedNode)) {
		var containerElement = document.getElementById('chat_nodes');
		containerElement.removeChild(document.getElementById('nodeElement_' + selectedNode));
		chatDataBuffer[selectedNode] = "";
		selectNode('channel');
	}
}

/* show buffer to client */
function showBuffer(node) {
	if (node == selectedNode) {
		document.getElementById('chatContentBlock').innerHTML = (chatDataBuffer[node] ? chatDataBuffer[node] : '');
		scrollDown();
	}
	
	else document.getElementById('nodeElement_' + node).className = 'noticeNode';
}

/* KeyCodes handler */
function keyEventHandler(key) {
	/* This is called when a key has been pressed in the text area */
	switch (key) {
		case 9: /* Tab key */
			
			i=0;
			
			var textField = document.getElementById('textInput');
			if (textField.value != "") {
				
				words = textField.value.split(' ');
				var wordLen = words[words.length-1].length;
				var wholeLen = document.getElementById('textInput').value.length;
				
				if (trim(words[words.length-1]) != "") {
				
					while (key < usersInChat.length) {
						if (words[words.length-1].toLowerCase() == usersInChat[i].substr(0, wordLen).toLowerCase()) {
							textField.value += usersInChat[i].substr(wordLen, usersInChat[i].length-wordLen).toLowerCase() + " ";
							break;
						}
						i++;
					}
				}
		  	}
			void(0);
		break;

		case 13: /* Return key */
			sendData();
		break;
		
		case 37: /* Left Arrow */
			// 
		break;
		
		case 38: /* Up Arrow */
			textBufferArrayActual = document.getElementById('textInput').value;
			document.getElementById('textInput').value = textBufferArray;
		break;	
		
		case 39: /* Right Arrow */
			//
		break;
		
		case 40: /* Down Arrow */

			document.getElementById('textInput').value = textBufferArrayActual;
		break;
		
		default:
			data = document.getElementById('textInput').value;
			if (data.substr(0, 1) == "/") {
				ajFetch('?L=chat.comhelper&chromeless=1&str=' + urlEncode(data), 'commandHelper', false, 0);
				document.getElementById('textInput').focus();
			}
			
			else {
				document.getElementById('textInput').focus();
			}
		break;
	}
}

/* Send data from textInput element */
function sendData() {
	data = document.getElementById('textInput').value;

	/* Don't act if data is null */
	if (data != null && trim(data) != '') {

		if (selectedNode != 'channel' && data.substring(0,1) != '/')
			data = '/msg ' + selectedNode + ' ' + data;

		textBufferArray = data;

		ajFetch('modules/chat/dac.php?sendChatData=' + urlEncode(data), 'processReceivedData', false, 0);

		/* Clear the textInput value */
		document.getElementById('textInput').value = '';
		
		/* Hide the command helper */
		//setTimeout("document.getElementById('commandsHelper').style.visibility = 'hidden';", 500);
		
	}
}

/* Scrolls the content div to its end */
function scrollDown() {
	if (scrollerActivated) {
		content = document.getElementById('chatContentBlock');
		content.scrollTop = content.scrollHeight;
	}
}

function scrollingActivate() {
	if (scrollerActivated) {
		scrollerActivated = false;
		ajFetch('modules/chat/menus/noscroll.php', 'chat_toolbox', false, 0);
	}
	else {
		scrollerActivated = true;
		ajFetch('modules/chat/menus/tools.php', 'chat_toolbox', false, 0);
	}
}

var selectedUser = "";
function pickUser(username) {
	var i=0;
	while (i < usersInChat.length) {
    	if (usersInChat[i] != username) {
			document.getElementById('nickEntityContainer_' + usersInChat[i]).className = 'chatNickEntity';
		}
		i++;
	}
	document.getElementById('nickEntityContainer_'+username).className = 'selectedChatNickEntity';
	selectedUser = username;
}

function actUser() {
	if (selectedUser != "") {
		var action = document.getElementById('userAction').value;
		document.getElementById('textInput').value = '/' + action + " " + selectedUser;
		sendData();
	}
	document.getElementById('userAction').selectedIndex = 0;
}

function commandHelper(dataContent) {

	var helper = document.getElementById('commandsHelper');

	if (trim(dataContent) != "") {
		
		/* Show the helper */
		//helper.innerHTML = dataContent;
		
		//helper.style.position = 'absolute';
		//helper.style.top =  (findPosY(document.getElementById('textInput'))+3)+"px";
		//helper.style.left = (findPosX(document.getElementById('textInput'))+2)+"px";
		//helper.style.visibility = 'visible';
	}
	
	else {
		//helper.style.visibility = 'hidden';
		//helper.innerHTML = '';
	}
}

var tStart = null;
function onlineTimerUpdate() {
	if(!tStart) tStart = new Date();
	var tDate = new Date();
	var tDiff = tDate.getTime() - tStart.getTime();
	tDate.setTime(tDiff);
	document.getElementById('onlineTimer').innerHTML = "Online since " + tDate.getMinutes() + ":" + tDate.getSeconds();
	setTimeout("onlineTimerUpdate()", 1000);
}
	
/* ---------------------- AJAX ------------------------- */

/* Ajax function class */
/* Declarations */
var arAjx = new Array(1);
var arStops = new Array;



/* ajFetch function */
function ajFetch(url, destination, cycle, delay, noloading) {
	
	/* Execution timer */
	var timerOne = new Date();
	floatInt = timerOne.getTime();
	//
	
	var curInstance;
	if (cycle == null) {
		cycle = false;	
	}
	if (noloading == null) {
		noloading = false;	
	}
	
	if (arAjx.length == 1) {
		curInstance = 1;
		arAjx[1] = new Ajax;
	} else {
		var found = false;
		for (i=1;i<arAjx.length;i++) {
			if (arAjx[i].Is_Free()) {
				curInstance = i;
				found = true;
			}
		}
		
		if (!found) {
			arAjx.push(new Ajax);
			curInstance = arAjx.length;
			arAjx[curInstance] = new Ajax;
		}
	}
	
	if (noloading) { arAjx[curInstance].Set_Loading(false); }
	
	arAjx[curInstance].HTTP_Get(url, destination);
	
	if (arStops[destination] != true) {
		if (cycle) {
			setTimeout("ajFetch('"+url+"','"+destination+"',true,"+delay+");",delay);
		}
	} else {
		arStops[destination] = null;
	}
}

/* Ajax functions, objects, classes and callback */
function Ajax() {
	/* Declarations */
	/* Public methods */
	this.HTTP_Get = HTTP_Get;
	this.Is_Free = Is_Free;
	this.Set_Loading = Set_Loading;
		
	/* Private variables */
	var ajobj = XMLHTTP_object();
	var http_destobj = null;
	var free = true;
	var show_loading = true;

	/* Methods */
	function HTTP_Get(url, destination) {
		if (free && (url != null) && (destination != null) && ((ajobj.readyState == 0) || (ajobj.readyState == 4))) {
			http_destobj = destination;
			
			ajobj.open("GET", url, true);
			ajobj.onreadystatechange = HTTP_Get_CallBack;
			ajobj.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
			ajobj.send(null);
			free = false;
		} else {
			return false;
		}
	}
	
	/* Get CallBack (Handle received data) */
	function HTTP_Get_CallBack() {
		if (ajobj.readyState == 4) {
			var results = ajobj.responseText;
			
			if (typeof(results)=='string' && results != null && results != '') {
				/* Function callback evaluator */
				if (eval("typeof(" + http_destobj + ") == 'function'")) { 
					/* Function detected, pass data to function */
					eval(http_destobj + "(results);");
				} else {
					/* Not a function, pass data to the html object */
					if (typeof document.getElementById(http_destobj).innerHTML != "undefined") {
						document.getElementById(http_destobj).innerHTML = results;
					}
				}
			}
			free = true;
		}
	}
	
	/* Helpers functions */
	function Is_Free() {
		return free;	
	}
	
	function Set_Loading(value) {
		show_loading = value;
	}
	
	/* AJAX OBJECT */
	function XMLHTTP_object() {
	  var xmlhttp;
	  /*@cc_on
	  @if (@_jscript_version >= 5)
		try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
		  try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
			xmlhttp = false;
		  }
		}
	  @else
	  xmlhttp = false;
	  @end @*/
	  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		try {
		  xmlhttp = new XMLHttpRequest();
		} catch (e) {
		  xmlhttp = false;
		}
	  }
	  return xmlhttp;
	}
}

function ajStop(destination) {
	arStops[destination] = true;
}

/* --------------------- HELPERS ----------------------- */

/* Set Selection */
function setSelectionRange(input, selectionStart, selectionEnd) {
  if (input.setSelectionRange) {
    input.focus();
    input.setSelectionRange(selectionStart, selectionEnd);
  }
  else if (input.createTextRange) {
    var range = input.createTextRange();
    range.collapse(true);
    range.moveEnd('character', selectionEnd);
    range.moveStart('character', selectionStart);
    range.select();
  }
}

/* Object position gizmo */
function findPosX(obj) {
	var curleft = 0;
	if (obj.offsetParent) {
		while (obj.offsetParent) {
			curleft += obj.offsetLeft;
			obj = obj.offsetParent;
		}
	}
	else if (obj.x) curleft += obj.x;
	return curleft;
}

function findPosY(obj) {
	var curtop = 0;
	if (obj.offsetParent) {
		curtop += obj.offsetHeight;
		while (obj.offsetParent) {
			curtop += obj.offsetTop;
			obj = obj.offsetParent;
		}
	}
	else if (obj.y) {
		curtop += obj.y;
		curtop += obj.height;
	}
	return curtop;
}
	
/* Array pop gizmo */
function array_pop(array, itemname) {
	var i = 0;
	while (i < array.length) {
		if (array[i] == itemname) array.splice(i, 1);
		i++;
  	}
	return array;
}

/* URLencode/decode helper */
function urlDecode(str){
    str=str.replace(new RegExp('\\+','g'), ' ');
   	return unescape(str);
}
	
function urlEncode(str){
	str = escape(str);
	str=str.replace(new RegExp('\\+','g'), '%2b');
	str=str.replace(new RegExp('%20','g'), '+');
	return str;
}

/* Base64 Helpers */
var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
function encode64(input) {
	if (input != null && input != '' && input != ' ') {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		do {
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output + keyStr.charAt(enc1) + keyStr.charAt(enc2) + 
			keyStr.charAt(enc3) + keyStr.charAt(enc4);
		} while (i < input.length);
   		
		return output;
	}
}

function decode64(input) {
	var output = "";
	var chr1, chr2, chr3;
	var enc1, enc2, enc3, enc4;
	var i = 0;

	input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

	do {
		enc1 = keyStr.indexOf(input.charAt(i++));
		enc2 = keyStr.indexOf(input.charAt(i++));
		enc3 = keyStr.indexOf(input.charAt(i++));
		enc4 = keyStr.indexOf(input.charAt(i++));

		chr1 = (enc1 << 2) | (enc2 >> 4);
		chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
		chr3 = ((enc3 & 3) << 6) | enc4;

		output = output + String.fromCharCode(chr1);

		if (enc3 != 64) {
			output = output + String.fromCharCode(chr2);
		}
		if (enc4 != 64) {
			output = output + String.fromCharCode(chr3);
		}
	} while (i < input.length);
	
	return output;
}

/* trim helper */
function trim(str) {
	/* Removes white spaces on the beginning and on the end of a string */
	if (str != null && str != '') {
		while (str.charAt(0) == ' ')
			str = str.substring(1);
		while (str.charAt(str.length - 1) == ' ')
			str = str.substring(0, str.length - 1);
	}
	return str;
}

</script>
<style type="text/css">
<!--

/*
	New chat styles
*/
#chat_container {
	width: 855px;
	overflow: hidden;
}

#chat_header {
	width: 855px;
	height: 26px;
	background-image: url(modules/chat/images/header.gif);
	padding-left: 16px;
	padding-right: 16px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	line-height: 18px;
	color: #2F63B3;
}

#chat_nodes_wrapper {
	width: 855px;
	height: 21px;
	background-color: #BBD4F9;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #FFFFFF;
}

#chat_nodes {
	width: 800px;
	height: 21px;
	background-color: #BBD4F9;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #FFFFFF;
	clear: none;
	float: left;
}

#chat_nodes_options {
	width: 20px;
	height: 21px;
	background-color: #BBD4F9;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #FFFFFF;
	clear: none;
	float: right;
	cursor: pointer;
}

#chat_topic {
	width: 855px;
	height: 24px; 
	background-color: #BBD4F9; 
	border-bottom: 1px solid #2F63B3;
	padding-left: 8px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 24px;
	color: #2F63B3;
}

#chat_wrapper {
	width: 855px;
	height: 440px; 
	background-color:#DCE6FF;
	overflow: hidden;
}

.chatContentBlock { /* Main chat content block */
	width: 700px;
	height: 440px;
	overflow: -moz-scrollbars-vertical;
	overflow-y: scroll;
	overflow-x: hidden;
	padding-left: 5px;
	padding-right: 5px;
	padding-top: 0px;
	padding-bottom: 0px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000000;
	float: left;
	clear: none;
}

.chatContentBlockPrivate {
	width: 845px;
	height: 440px;
	overflow: -moz-scrollbars-vertical;
	overflow-y: scroll;
	overflow-x: hidden;
	padding-left: 5px;
	padding-right: 5px;
	padding-top: 0px;
	padding-bottom: 0px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #000000;
	float: left;
	clear: none;
}

.nickContent { /* Main nick list content block */
	width: 135px;
	height: 440px;
	overflow: -moz-scrollbars-vertical;
	overflow-y: scroll;
	overflow-x: hidden;
	padding-left: 5px;
	padding-right: 5px;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	float: right;
	clear: none;
	position: relative;
	visibility: visible;
}

.nickContentPrivate { 
	width: 1px;
	height: 1px;
	overflow: hidden;
	visibility: hidden;
	position: absolute;
}

#chat_toolbox {
	width: 855px;
	height:22px; 
	background-color:#A6C0E9;
	background-image: url(modules/chat/images/toolbox.gif);
	font-size: 1px;
	line-height: 1px;
}

#chat_tool {
	width: 16px;
	height: 22px;
	margin-left: 5px;
	border: none;
	cursor: pointer;
}

#chat_textbox {
	width: 855px;
	height:20px; 
	background-color:#DCE6FF;
}

#chat_footer {
	width: 855px;
	height:22px;
	background-image: url(modules/chat/images/footer.gif);
	background-repeat: repeat-x;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	line-height: 35px;
	color: #999999;
}

#textInput { /* This is the textbox */
	width: 855px;
	height: 20px;
	border-left: #CCCCCC 1px solid;
	border-right: #CCCCCC 1px solid;
	border-bottom: none;
	border-top: none;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #333333;
}

.enabledNode {
	width: 105px;
	height: 21px; 
	background-image: url(modules/chat/images/node_on.gif);
	clear: none;
	float: left;
	margin-left: 1px;
	line-height: 17px;
	text-align: center;
}

.disabledNode {
	width: 105px;
	height: 21px; 
	background-image: url(modules/chat/images/node_off.gif);
	clear: none;
	float: left;
	margin-left: 1px;
	line-height: 17px;
	text-align: center;
	cursor: pointer;
}

.noticeNode {
	width: 105px;
	height: 21px; 
	background-image: url(modules/chat/images/node_notify.gif);
	clear: none;
	float: left;
	margin-left: 1px;
	line-height: 17px;
	text-align: center;
	color: #000000;
	cursor: pointer;
}


/* Strings Styles */
#chat_system_message {
	color: #009900;
	font-weight: bold;
}

#chat_action_message {
	color: #993399;
	font-weight: bold;
}

#chat_echo_message {
	color: #CC9900;
	font-weight: bold;
}

#chat_error_message {
	color: #990000;
	font-weight: bold;
}

#chat_wallop_message {
	color: #CC0000;
	font-weight: bold;
}

#chat_text {
}

#chat_self_text {
}

#chat_self_nickname {
	color: #2F63B3;
	font-weight: bold;
}

#chat_nickname {
	color: #2F63B3;
}

#colorPicker {
	width: 3px;
	height: 20px;
	clear: none;
	float: left;
	margin-top: 1px;
}
-->
</style>

<div id="chat_container">
	<div id="chat_header">
		<div style="clear:none; float:left; width:720px;">&laquo; Go back to the channels list</div>
		<div id="onlineTimer" style="clear:none; float:left;">&nbsp;</div>
	</div>
	<div id="chat_nodes_wrapper">
		<div id="chat_nodes">
			<div id="nodeElement_channel" class="enabledNode" onclick="selectNode('channel');">&nbsp;</div>
		</div>
		<div id="chat_nodes_options">
			<img src="modules/chat/images/x.gif" title="Close Query" alt="Close Query" onclick="killNode();" />
		</div>
	</div>
	<div id="chat_topic">&nbsp;</div>
	<div id="chat_wrapper">
		<div id="chatContentBlock" class="chatContentBlock"><div id="ieBugFight"><img height="1" width="1" /></div></div>
		<div id="nickContent" class="nickContent">&nbsp;</div>
	</div>
	<div id="chat_toolbox">&nbsp;</div>
	<div id="chat_textbox"><input type="text" id="textInput" onkeydown="javascript:if(event.keyCode=='9') { keyEventHandler(event.keyCode); return false; void(0); }" onkeyup="javascipt:if(event.keyCode!='9') { keyEventHandler(event.keyCode); }" maxlength="500" /></div>
	<div id="chat_footer">&nbsp;</div>
</div>
<br />

<script language="javascript" type="text/javascript">
	launchTRITON();
	
	ajFetch('modules/chat/menus/tools.php', 'chat_toolbox', false, 0);
	
	window.onunload = quitChat;
	function quitChat() {
		document.getElementById('textInput').value='/quit';
		sendData();
	}
</script>

<script for="window" event="onunload" type="text/javascript">
	document.getElementById('textInput').value='/quit';
	sendData();
</script>