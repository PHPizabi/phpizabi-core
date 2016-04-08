<h2>GeoLocalisation Settings </h2>
<br /><br />
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Provider URL: </strong></td>
    <td width="10">&nbsp;</td>
    <td><input name="GEOLOC_PROVIDER_URL" type="text" id="GEOLOC_PROVIDER_URL" value="{CONF.GEOLOC_PROVIDER_URL}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Provider port: </strong></td>
    <td>&nbsp;</td>
    <td><input name="GEOLOC_PROVIDER_PORT" type="text" id="GEOLOC_PROVIDER_PORT" value="{CONF.GEOLOC_PROVIDER_PORT}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Username:</strong></td>
    <td>&nbsp;</td>
    <td><input name="GEOLOC_USERNAME" type="text" id="GEOLOC_USERNAME" value="{CONF.GEOLOC_USERNAME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Password:</strong></td>
    <td>&nbsp;</td>
    <td><input name="GEOLOC_PASSWORD" type="password" id="GEOLOC_PASSWORD" value="{CONF.GEOLOC_PASSWORD}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Stream marker:  </strong></td>
    <td>&nbsp;</td>
    <td><input name="GEOLOC_STREAM_MARKER" type="text" id="GEOLOC_STREAM_MARKER" value="{CONF.GEOLOC_STREAM_MARKER}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Allow updates on :</strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="GEOLOC_ALLOW_UPDATE:CITY" value="1" {ck.GEOLOC_ALLOW_UPDATE:CITY}/> Allow city value update </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="GEOLOC_ALLOW_UPDATE:STATE" value="1" {ck.GEOLOC_ALLOW_UPDATE:STATE}/>
      Allow state value update </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="GEOLOC_ALLOW_UPDATE:COUNTRY" value="1" {ck.GEOLOC_ALLOW_UPDATE:COUNTRY}/>
      Allow country value update</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="GEOLOC_ALLOW_UPDATE:ZIPCODE" value="1" {ck.GEOLOC_ALLOW_UPDATE:ZIPCODE}/>
      Allow zipcode value update</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Post data:</strong> </td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="GEOLOC_POST:CITY" value="1" {ck.GEOLOC_POST:CITY}/>
      Post city data</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="GEOLOC_POST:STATE" value="1" {ck.GEOLOC_POST:STATE}/>
      Post state data </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="GEOLOC_POST:COUNTRY" value="1" {ck.GEOLOC_POST:COUNTRY}/>
      Post country data </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="GEOLOC_POST:ZIPCODE" value="1" {ck.GEOLOC_POST:ZIPCODE}/>
      Post zipcode data </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Strapping:</strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="GEOLOC_STRAPON_REGISTER" value="1" {ck.GEOLOC_STRAPON_REGISTER}/>
      Strap on registration</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="GEOLOC_STRAPON_ZIPCHANGE" value="1" {ck.GEOLOC_STRAPON_ZIPCHANGE}/>
      Strap on zip change </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="Submit" value="Submit" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
