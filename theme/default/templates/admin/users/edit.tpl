<h2>Edit User</h2>
<p><a href="?L=admin.users.chpass&amp;id={user.id}">Change Password</a> | <a href="?L=admin.raw.rawedit&amp;table=users&amp;id={user.id}">Edit Raw Data</a><br />
  <br />
</p>

<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>User ID: </strong></td>
    <td colspan="2">{user.id}</td>
  </tr>
  <tr>
    <td><strong>Last activity / Last login: </strong></td>
    <td colspan="2">{user.last_load} / {user.last_login}</td>
  </tr>
  <tr>
    <td><strong>Username:</strong></td>
    <td colspan="2"><input name="username" type="text" id="username" value="{user.username}" /></td>
  </tr>
  <tr>
    <td><strong>Email address: </strong></td>
    <td colspan="2"><input name="email" type="text" id="email" value="{user.email}" size="50" /></td>
  </tr>
  <tr>
    <td><strong>City, State, Country: </strong></td>
    <td colspan="2"><input name="city" type="text" id="city" value="{user.city}" />
    <input name="state" type="text" id="state" value="{user.state}" />
    <input name="country" type="text" id="country" value="{user.country}" /></td>
  </tr>
  <tr>
    <td><strong>Zipcode:</strong></td>
    <td colspan="2"><input name="zipcode" type="text" id="zipcode" value="{user.zipcode}" /></td>
  </tr>
  <tr>
    <td><strong>Latitude, Longitude: </strong></td>
    <td colspan="2"><input name="latitude" type="text" id="latitude" value="{user.latitude}" />
    <input name="longitude" type="text" id="longitude" value="{user.longitude}" /></td>
  </tr>
  <tr>
    <td><strong>Timezone: </strong></td>
    <td colspan="2"><input name="timezone" type="text" id="timezone" value="{user.timezone}" /></td>
  </tr>
  <tr>
    <td><strong>Birthdate:</strong></td>
    <td colspan="2"><input name="birthdate" type="text" id="birthdate" value="{user.birthdate}" /> 
    (m/d/yyyy)</td>
  </tr>
  <tr>
    <td><strong>Gender:</strong></td>
    <td colspan="2"><input name="gender" type="text" id="gender" value="{user.gender}" /></td>
  </tr>
  <tr>
    <td><strong>Language:</strong></td>
    <td colspan="2"><input name="language" type="text" id="language" value="{user.language}" /></td>
  </tr>
  <tr>
    <td><strong>Quote:</strong></td>
    <td colspan="2"><input name="quote" type="text" id="quote" value="{user.quote}" size="50" /></td>
  </tr>
  <tr>
    <td valign="top"><strong>Header:</strong></td>
    <td colspan="2"><textarea name="header" cols="50" rows="5" id="header">{user.header}</textarea></td>
  </tr>
  <tr>
    <td><strong>Profile data: </strong></td>
    <td>{d.profiledata} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=profile_data">Clear profile data </a></td>
  </tr>
  <tr>
    <td><strong>Pictures:</strong></td>
    <td>{d.pictures} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=pictures">Clear pictures data </a></td>
  </tr>
  <tr>
    <td><strong>Main picture: </strong></td>
    <td>{user.mainpicture}</td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=mainpicture">Clear main picture entry </a></td>
  </tr>
  <tr>
    <td><strong>Contacts:</strong></td>
    <td>{d.contacts} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=contacts">Clear contacts list </a></td>
  </tr>
  <tr>
    <td><strong>Relationship requests: </strong></td>
    <td>{d.relationship_requests} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=relationship_requests">Clear relationship requests </a></td>
  </tr>
  <tr>
    <td><strong>Blocks:</strong></td>
    <td>{d.block} Kb</td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=block">Clear blocks list </a></td>
  </tr>
  <tr>
    <td><strong>Profile views: </strong></td>
    <td>{d.profile_views} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=profile_views">Clear profile views </a></td>
  </tr>
  <tr>
    <td><strong>Profile votes: </strong></td>
    <td>{d.profile_votes} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=profile_votes">Clear all votes </a></td>
  </tr>
  <tr>
    <td><strong>Pictures votes: </strong></td>
    <td>{d.pictures_votes} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=pictures_votes">Clear all votes </a></td>
  </tr>
  <tr>
    <td><strong>Favorites:</strong></td>
    <td>{d.favorites} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=favorites">Clear favorites </a></td>
  </tr>
  <tr>
    <td><strong>Nudges:</strong></td>
    <td>{d.nudges} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=nudges">Clear nudges </a></td>
  </tr>
  <tr>
    <td><strong>Settings:</strong></td>
    <td>{d.settings} Kb </td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=settings">Reset user settings </a></td>
  </tr>
  <tr>
    <td><strong>Disabled until: </strong></td>
    <td>{user.disable_until}</td>
    <td><a href="?L=admin.users.edit&amp;id={user.id}&amp;clear=disable_until">Reset</a></td>
  </tr>
  <tr>
    <td><strong>Account type ID, Expiration </strong></td>
    <td colspan="2"><input name="account_type" type="text" id="account_type" value="{user.account_type}" />
    <input name="account_expire" type="text" id="account_expire" value="{user.account_expire}" /></td>
  </tr>
  <tr>
    <td><strong>Registered on, Reference: </strong></td>
    <td colspan="2">{user.registration_date}, {user.registration_reference} </td>
  </tr>
  <tr>
    <td><strong>Email verified: </strong></td>
    <td colspan="2"><input name="email_verified" type="checkbox" id="email_verified" value="1" {c.email_verified} />
Email address has been verified</td>
  </tr>
  <tr>
    <td><strong>Active:</strong></td>
    <td colspan="2"><label>
      <input name="active" type="checkbox" id="active" value="1" {c.active} />
    Account is active</label></td>
  </tr>
  <tr>
    <td><strong>Administrative account:</strong></td>
    <td colspan="2">
	<label><input name="is_administrator" type="checkbox" id="is_administrator" value="1" {c.is_administrator} />
	User is administrator</label></td>
  </tr>
  <tr>
    <td><strong>Moderator account:</strong> </td>
    <td colspan="2">
	<label><input name="is_moderator" type="checkbox" id="is_moderator" value="1" {c.is_moderator} />
User is moderator</label> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="submit" name="Submit" value="Save Changes" class="submit"></td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
