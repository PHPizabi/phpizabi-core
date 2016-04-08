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
	
	define('SYS_JOIN', '<span id="chat_system_message">*** %s has joined #%s</span>');
	define('SYS_PART', '<span id="chat_system_message">*** %s has left #%s [Joined #%s]</span>');
	define('SYS_QUIT', '<span id="chat_system_message">*** %s has left the network [Quit]</span>');
	define('SYS_TIMEOUT', '<span id="chat_system_message">*** %s has left the network [Ping Timeout]</span>');
	define('SYS_GHOST', '<span id="chat_system_message">*** %s has left the network [User Flip/Flop]</span>');
	define('SYS_NICK', '<span id="chat_system_message">*** %s is now known as %s</span>');
	define('SYS_KICK', '<span id="chat_system_message">*** %s has been kicked from channel #%s [Requested by %s]</span>');
	define('SYS_OP', '<span id="chat_system_message">*** %s is now a channel operator [Requested by %s]</span>');
	define('SYS_DOP', '<span id="chat_system_message">*** %s is no longer a channel operator [Requested by %s]</span>');
	define('SYS_VOICE', '<span id="chat_system_message">*** %s is now voiced in this channel [Requested by %s]</span>');
	define('SYS_DEVOICE', '<span id="chat_system_message">*** %s is no longer voiced in this channel [Requested by %s]</span>');
	define('SYS_MUTE', '<span id="chat_system_message">*** %s is now muted in this channel [Requested by %s]</span>');
	define('SYS_DEMUTE', '<span id="chat_system_message">*** %s is no longer muted in this channel [Requested by %s]</span>');
	define('SYS_TOPIC', '<span id="chat_system_message">*** %s has set the channel topic [%s]</span>');
	define('SYS_MODE', '<span id="chat_system_message">*** %s has set modes %s for channel #%s</span>');

	define('ECHO_SET_AWAY', '<span id="chat_echo_message">*** You have been marked as being away</span>');
	define('ECHO_UNSET_AWAY', '<span id="chat_echo_message">*** You are no longer marked as being away</span>');
	define('ECHO_B64', '<span id="chat_echo_message">*** Base64 encoding result: %s</span>');
	define('ECHO_B64D', '<span id="chat_echo_message">*** Base64 decoding result: %s</span>');
	define('ECHO_MD5', '<span id="chat_echo_message">*** MD5 encoding result: %s</span>');
	define('ECHO_COLOR', '<span id="chat_echo_message">*** Text color set to %s</span>');
	define('ECHO_PONG', '<span id="chat_echo_message">*** Pong!</span>');
	define('ECHO_TIME', '<span id="chat_echo_message">*** Server time: %s</span>');
	define('ECHO_DNS', '<span id="chat_echo_message">*** DNS resolve result for %s: %s</span>');
	define('ECHO_DNSERR', '<span id="chat_echo_message">*** Unable to resolve %s</span>');
	define('ECHO_CHANINFO', '<span id="chat_echo_message">*** Channel modes for channel #%s: %s</span>');
	define('ECHO_BSTAT', '<span id="chat_echo_message">*** System buffer lenght: %s Kb</span>');
	define('ECHO_WHOIS', '<span id="chat_echo_message">*** Whois information for %s:<br />*** Host: %s &lt;%s&gt;<br />*** Age: %s<br />*** Gender: %s<br />*** User ID: %s<br />*** Logged in on: %s</span>');
	define('ECHO_HELP_COMMANDS', '<span id="chat_echo_message">*** Available commands: %s</span>');
	define('ECHO_MODES', '<span id="chat_echo_message">*** Available modes on this system:<br />%s</span>');
	define('ECHO_LIST', '<span id="chat_echo_message">*** Channels on this network:<br />%s</span>');

	define('ACTION', '<span id="chat_action_message">* %s %s</span>');
	define('ACTION_BEAT', '<span id="chat_action_message">* %s beats %s in the leg with a %s</span>');
	define('ACTION_SLAP', '<span id="chat_action_message">* %s slaps %s around a bit with a %s</span>');
	define('ACTION_KISS', '<span id="chat_action_message">* %s kisses %s lightly on the %s</span>');
	
	define('WALLOP', '<span id="chat_wallop_message">%s wallop: </span> %s');
	define('WALLOP_SIMON', '<b><span id="chat_wallop_message">System wallop:</span> %s used simonsays against %s in #%s</b>');
	define('WALLOP_GHOST', '<b><span id="chat_wallop_message">System wallop:</span> %s has gone vapor in #%s [Ghosted]</b>');
	define('WALLOP_RESPAWN', '<b><span id="chat_wallop_message">System wallop:</span> %s self-reconstructed in #%s [Respawned]</b>');
	
	define('ERR_NOSUCHNICKCHAN', '<span id="chat_error_message">*** %s: No such nick or channel</span>');
	define('ERR_NOSUCHNICK', '<span id="chat_error_message">*** %s: No such nick</span>');
	define('ERR_NOSUCHCHAN', '<span id="chat_error_message">*** #%s: No such channel</span>');
	define('ERR_NOSUCHSERVER', '<span id="chat_error_message">*** %s: No such server</span>');
	define('ERR_NOEXTMSG', '<span id="chat_error_message">*** #%s: Cannot send to channel</span>');
	define('ERR_MODERATED', '<span id="chat_error_message">*** #%s: Cannot send to channel [moderated]</span>');
	define('ERR_MUTED', '<span id="chat_error_message">*** #%s: Cannot send to channel [muted]</span>');
	define('ERR_NORECIPIENT', '<span id="chat_error_message">*** %s: No recipient given (%s)</span>');
	define('ERR_NOTEXT', '<span id="chat_error_message">*** %s: No text to send</span>');
	define('ERR_NOCOMMAND', '<span id="chat_error_message">*** %s: No such command</span>');
	define('ERR_NONICK', '<span id="chat_error_message">*** No nickname given</span>');
	define('ERR_NICKFORMAT', '<span id="chat_error_message">*** Erroneous nickname %s</span>');
	define('ERR_RESERVEDNICK', '<span id="chat_error_message">*** Can not use reserved nickname %s</span>');
	define('ERR_CHANNELFORMAT', '<span id="chat_error_message">*** Erroneous channel name</span>');
	define('ERR_NICKINUSE', '<span id="chat_error_message">*** Nickname is already in use</span>');
	define('ERR_NICKFLOOD', '<span id="chat_error_message">*** Nickname change too fast. Throttled</span>');
	define('ERR_TARGETFLOOD', '<span id="chat_error_message">*** %s: Target change too fast. Throttled</span>');
	define('ERR_PARAMCOUNT', '<span id="chat_error_message">*** Not enough parameters. Use /help %s</span>');
	define('ERR_KLINE', '<span id="chat_error_message">*** You are banned from this server</span>');
	define('ERR_GLINE', '<span id="chat_error_message">*** You are banned from this network</span>');
	define('ERR_CHANNELFULL', '<span id="chat_error_message">*** Can not join channel #%s (channel is full)</span>');
	define('ERR_CHANNELINVITE', '<span id="chat_error_message">*** Can not join channel #%s (invite only)</span>');
	define('ERR_CHANNELBAN', '<span id="chat_error_message">*** Can not join channel #%s (you are banned)</span>');
	define('ERR_CHANNELKEY', '<span id="chat_error_message">*** Can not join channel #%s (requires the correct key)</span>');
	define('ERR_WRONGKEY', '<span id="chat_error_message">*** Can not join channel #%s (wrong key)</span>');
	define('ERR_CHANNELADMIN', '<span id="chat_error_message">*** Can not join channel #%s (administrators only)</span>');
	define('ERR_JOINCHANNEL', '<span id="chat_error_message">*** Can not join channel #%s</span>');
	define('ERR_NOACCESS', '<span id="chat_error_message">*** Permission denied: Insufficient privileges</span>');
	define('ERR_CHANOP', '<span id="chat_error_message">*** %s: You are not channel operator</span>');
	define('ERR_OPPROTECT', '<span id="chat_error_message">*** Can not kick, ban or deop an administrator</span>');
	define('ERR_GUEST', '<span id="chat_error_message">*** Guests are not allowed in this channel [#%s +g]</span>');
	define('ERR_KICKED', '<span id="chat_error_message">*** You have been kicked from channel #%s</span>');
	
	define('OBJ_TOPIC', '#%s [%s] [+%s] %s');
	
	define('OBJ_NICKLIST_OP', '<div style="float:left; clear:left; height:26px; width:112px; border-bottom: 1px solid #BBD4F9; padding-top: 2px; padding-bottom: 2px;"><a href="?L=users.profile&id=%s" target="_blank"><img src="system/image.php?file=%s&width=24" name="picture" hspace="2" align="left" id="picture" /></a><span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: red; font-weight:bold;">%s</span><br /><span style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #999999;">Op, %s y/o</span></div><br />');

	define('OBJ_NICKLIST_VOICE', '<div style="float:left; clear:left; height:26px; width:112px; border-bottom: 1px solid #BBD4F9; padding-top: 2px; padding-bottom: 2px;"><a href="?L=users.profile&id=%s" target="_blank"><img src="system/image.php?file=%s&width=24" name="picture" hspace="2" align="left" id="picture" /></a><span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: blue; font-weight:bold;">%s</span><br /><span style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #999999;">Voice, %s y/o</span></div><br />');
	
	define('OBJ_NICKLIST_USER', '<div style="float:left; clear:left; height:26px; width:112px; border-bottom: 1px solid #BBD4F9; padding-top: 2px; padding-bottom: 2px;"><a href="?L=users.profile&id=%s" target="_blank"><img src="system/image.php?file=%s&width=24" name="picture" hspace="2" align="left" id="picture" /></a><span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight:bold;">%s</span><br /><span style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #999999;">%s, %s y/o</span></div><br />');

	define('OBJ_NICKLIST_MUTE', '<div style="float:left; clear:left; height:26px; width:112px; border-bottom: 1px solid #BBD4F9; padding-top: 2px; padding-bottom: 2px;"><a href="?L=users.profile&id=%s" target="_blank"><img src="system/image.php?file=%s&width=24" name="picture" hspace="2" align="left" id="picture" /></a><span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: orange; font-weight:bold;">%s</span><br /><span style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #999999;">Muted, %s y/o</span></div><br />');
	
	define('OBJ_NICKLIST_AWAY', '<div style="float:left; clear:left; height:26px; width:112px; border-bottom: 1px solid #BBD4F9; padding-top: 2px; padding-bottom: 2px;"><a href="?L=users.profile&id=%s" target="_blank"><img src="system/image.php?file=%s&width=24" name="picture" hspace="2" align="left" id="picture" /></a><span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: gray; font-weight:bold;">%s</span><br /><span style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #999999;">Away, %s y/o</span></div><br />');
	
	define('OBJ_NICKLIST_GHOST', '<div style="float:left; clear:left; height:26px; width:112px; border-bottom: 1px solid #BBD4F9; padding-top: 2px; padding-bottom: 2px;"><a href="?L=users.profile&id=%s" target="_blank"><img src="system/image.php?file=%s&width=24" name="picture" hspace="2" align="left" id="picture" /></a><span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: white; font-weight:bold;">%s</span><br /><span style="font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #999999;">Ghosted, %s y/o</span></div><br />');

?>