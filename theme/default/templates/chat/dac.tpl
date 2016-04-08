<OBJ userText>
  <p><span style="color:#2f63b3"><i>{timestamp}</i> {nickname} [said: {3040}] </span> 
  <span style="padding-left:5px;">{body}</span></p>
</OBJ userText>

<OBJ selfUserText>
  <p><span style="color:#2f63b3"><strong><i>{timestamp}</i> {nickname} [said: {3040}]</strong></span><span style="padding-left:5px;">{body}</span></p>
</OBJ selfUserText>

<OBJ actionText>
  <p style="color:#990066"><strong><i>{timestamp}</i> {nickname} {body}</strong></p>
</OBJ actionText>

<OBJ privateMessage>
  <p><span style="color:#CC9900"><strong><i>{timestamp}</i> {nickname} [whisper: {3045}] </strong></span> 
  <span style="padding-left:5px;">{body}</span></p>
</OBJ privateMessage>

<OBJ systemMessage>
  <p><span style="color:#339900"><strong><i>{timestamp}</i> {body}</strong></span></p>
</OBJ systemMessage>

<OBJ echoString>
  <p><span style="color:#FF9900"><strong><i>{timestamp}</i> {body}</strong></span></p>
</OBJ echoString>

<OBJ wallopMessage>
  <p><span style="color:#FF3333"><strong><i>{timestamp}</i> {nickname} [wallop: {3050}]</strong></span>
  <span style="padding-left:5px;">{body}</span></p>
</OBJ wallopMessage>

<!-- NICK LIST STUFF -->

<OBJ nickListHeader>
  <div style="clear:both; border-bottom: solid 1px #BBD4F9; padding: 2px; background-color:#DCE6FF;">
    <h6>{count.channel} [users in this channel {3055}] </h6>
	<h6>{count.total} [total users {3060}]</h6>
  </div>
</OBJ nickListHeader>
<OBJ offchatUser>
  <div class="chatNickEntity" id="nickEntityContainer_{user.username}" onclick="pickUser('{user.username}');">
    <a href="javascript:showUserPicture('{user.mainpicture}');">
      <img src="system/image.php?file={user.mainpicture}&width=30" alt="[Picture {150}]" hspace="2" border="0" id="picture" align="left" />
	</a>
    <a href="?L=users.profile&amp;id={user.id}" target="_blank">{user.username}</a><br />
	<h5>[{user.gender}, {user.age}y {3065}]</h5>
</div>
</OBJ offchatUser>

<OBJ onchatUser>
  <div class="chatNickEntity" id="nickEntityContainer_{user.username}" onclick="pickUser('{user.username}');">
    <a href="javascript:showUserPicture('{user.mainpicture}');">
      <img src="system/image.php?file={user.mainpicture}&width=30" alt="[Picture {150}]" hspace="2" border="0" id="picture" align="left" />
	</a>
    <strong><a href="?L=users.profile&amp;id={user.id}" target="_blank">{user.username}</a></strong><br />
	<h5>[{user.gender}, {user.age}y {3065}]</h5>
</div>
</OBJ onchatUser>