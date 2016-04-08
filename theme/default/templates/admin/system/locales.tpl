<h2>Locales Settings </h2>
<br /><br />
<ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Short date time format: </strong></td>
    <td width="10">&nbsp;</td>
    <td><input name="LOCALE_SHORT_DATE_TIME" type="text" id="LOCALE_SHORT_DATE_TIME" value="{CONF.LOCALE_SHORT_DATE_TIME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Short date format: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_SHORT_DATE" type="text" id="LOCALE_SHORT_DATE" value="{CONF.LOCALE_SHORT_DATE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Short time format: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_SHORT_TIME" type="text" id="LOCALE_SHORT_TIME" value="{CONF.LOCALE_SHORT_TIME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Long date time format: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_LONG_DATE_TIME" type="text" id="LOCALE_LONG_DATE_TIME" value="{CONF.LOCALE_LONG_DATE_TIME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Long date format: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_LONG_DATE" type="text" id="LOCALE_LONG_DATE" value="{CONF.LOCALE_LONG_DATE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Long time format: </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="LOCALE_LONG_TIME" type="text" id="LOCALE_LONG_TIME" value="{CONF.LOCALE_LONG_TIME}" size="40" />
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Header time format: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_HEADER_TIME" type="text" id="LOCALE_HEADER_TIME" value="{CONF.LOCALE_HEADER_TIME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Header date time format: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_HEADER_DATE_TIME" type="text" id="LOCALE_HEADER_DATE_TIME" value="{CONF.LOCALE_HEADER_DATE_TIME}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Header date format: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_HEADER_DATE" type="text" id="LOCALE_HEADER_DATE" value="{CONF.LOCALE_HEADER_DATE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Monetary ISO 639 </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_MONETARY_ISO639" type="text" id="LOCALE_MONETARY_ISO639" value="{CONF.LOCALE_MONETARY_ISO639}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Monetary ISO 3166 </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_MONETARY_ISO3166" type="text" id="LOCALE_MONETARY_ISO3166" value="{CONF.LOCALE_MONETARY_ISO3166}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Monetary string format: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_MONETARY_STRINGFORMAT" type="text" id="LOCALE_MONETARY_STRINGFORMAT" value="{CONF.LOCALE_MONETARY_STRINGFORMAT}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Use ISO639:</strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOCALE_MONETARY_USEISO:639" value="1" {ck.LOCALE_MONETARY_USEISO:639}/> Use ISO639 </label></td>
    <td>* False: Use ISO3166 </td>
  </tr>
  <tr>
    <td><strong>Return flat values: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOCALE_MONETARY_RETURNFLAT" value="1" {ck.LOCALE_MONETARY_RETURNFLAT}/> Return flat unprocessed values</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Site languages: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_SITE_LANGUAGES" type="text" id="LOCALE_SITE_LANGUAGES" value="{CONF.LOCALE_SITE_LANGUAGES}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Allow language override: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOCALE_LANGUAGE_ALLOW_OVERRIDE" value="1" {ck.LOCALE_LANGUAGE_ALLOW_OVERRIDE}/> Allow language override</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Default language: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_SITE_DEFAULT_LANGUAGE" type="text" id="LOCALE_SITE_DEFAULT_LANGUAGE" value="{CONF.LOCALE_SITE_DEFAULT_LANGUAGE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Language pack location: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_LANGUAGEPACK_LOCATION" type="text" id="LOCALE_LANGUAGEPACK_LOCATION" value="{CONF.LOCALE_LANGUAGEPACK_LOCATION}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Try default language pack on error: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOCALE_LANGUAGEPACK_TRYDEFAULT_ON_ERROR" value="1" {ck.LOCALE_LANGUAGEPACK_TRYDEFAULT_ON_ERROR}/> Try default on error</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Cache pack on success: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOCALE_LANGUAGE_CACHE_ON_LOAD_SUCCESS" value="1" {ck.LOCALE_LANGUAGE_CACHE_ON_LOAD_SUCCESS}/> Use languages caching</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>System timezone: </strong></td>
    <td>&nbsp;</td>
    <td><input name="LOCALE_SYSTEM_TIMEZONE" type="text" id="LOCALE_SYSTEM_TIMEZONE" value="{CONF.LOCALE_SYSTEM_TIMEZONE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Force UTF8 header override: </strong></td>
    <td>&nbsp;</td>
    <td><label><input type="checkbox" name="LOCALE_FORCE_UTF8_HEADER_OVERRIDE" value="1" {ck.LOCALE_FORCE_UTF8_HEADER_OVERRIDE}/> Full UTF8 mode</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
