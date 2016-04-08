<h2>Images Processing Configurations </h2>
<br /><br />

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><ZONE save success>
<span style="color:#FF0000;"><strong>System successfully saved your new settings</strong></span>
</ZONE save success>&nbsp;</td>
    <td align="right"><a href="?L=admin.miscs.picturescache">Pictures Cache Management</a> </td>
  </tr>
</table>
<br /><br />
<form method="post">
<table border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Enable GD processor: </strong></td>
    <td width="10">&nbsp;</td>
    <td><label>
      <input type="checkbox" name="IMAGE_ENABLE_PROCESSOR:GD" value="1" {ck.IMAGE_ENABLE_PROCESSOR:GD}/> 
      GD Enabled
</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Use GD2 </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="IMAGE_PROCESSOR:GD2" value="1" {ck.IMAGE_PROCESSOR:GD2}/> 
      GD2 Mode
</label></td>
    <td>* False: GD1 </td>
  </tr>
  <tr>
    <td><strong>Default pictures directory: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_DEFAULT_DIRECTORY" type="text" id="IMAGE_DEFAULT_DIRECTORY" value="{CONF.IMAGE_DEFAULT_DIRECTORY}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Enable processor debug mode: </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="IMAGE_PROCESSOR_DEBUG_MODE" value="1" {ck.IMAGE_PROCESSOR_DEBUG_MODE}/> 
      Enable debug mode
</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Force constrain proportions: </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="IMAGE_FORCE_CONSTRAIN_PROPORTIONS" value="1" {ck.IMAGE_FORCE_CONSTRAIN_PROPORTIONS}/> 
      Constrain proportions
</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Processing mode:</strong> </td>
    <td>&nbsp;</td>
    <td><select name="IMAGE_PROCESS_MODE" id="IMAGE_PROCESS_MODE">
      <option value="crop">Crop</option>
      <option value="resize">Resize</option>
      <option value="fill">Fill</option>
    </select>    </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Aspect ratio proportion value: </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input name="IMAGE_CONSTRAIN_PROPORTIONS_ASPECT_RATIO" type="text" id="IMAGE_CONSTRAIN_PROPORTIONS_ASPECT_RATIO" value="{CONF.IMAGE_CONSTRAIN_PROPORTIONS_ASPECT_RATIO}" size="40" />
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Max file size: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_MAX_FILE_SIZE" type="text" id="IMAGE_MAX_FILE_SIZE" value="{CONF.IMAGE_MAX_FILE_SIZE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Header string: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_HEADER_STRING" type="text" id="IMAGE_HEADER_STRING" value="{CONF.IMAGE_HEADER_STRING}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Default &quot;nopicture&quot; file: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_NOFILE_DEFAULT_FILE" type="text" id="IMAGE_NOFILE_DEFAULT_FILE" value="{CONF.IMAGE_NOFILE_DEFAULT_FILE}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Cache processed pictures: </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="IMAGE_CACHE_PROCESSED" value="1" {ck.IMAGE_CACHE_PROCESSED}/> 
      Enable caching
</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Cache flush use forward: </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="IMAGE_CACHE_DISPLAY:USE_FORWARD" value="1" {ck.IMAGE_CACHE_DISPLAY:USE_FORWARD}/> 
      Cache forward mode
</label></td>
    <td>* False: Cache stream mode </td>
  </tr>
  <tr>
    <td><strong>Use text stamp: </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="IMAGE_USE_STAMP_TEXT" value="1" {ck.IMAGE_USE_STAMP_TEXT}/> 
      Text stamp images
</label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Stamp text: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_TEXT" type="text" id="IMAGE_STAMP_TEXT" value="{CONF.IMAGE_STAMP_TEXT}" size="40" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Stamp text color: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_TEXT_COLOR" type="text" id="IMAGE_STAMP_TEXT_COLOR" value="{CONF.IMAGE_STAMP_TEXT_COLOR}" size="40" /></td>
    <td>* R,G,B </td>
  </tr>
  <tr>
    <td><strong>Stamp text size: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_TEXT_SIZE" type="text" id="IMAGE_STAMP_TEXT_SIZE" value="{CONF.IMAGE_STAMP_TEXT_SIZE}" size="40" /></td>
    <td>px</td>
  </tr>
  <tr>
    <td><strong>Stamp text location (Y) </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_TEXT_LOCATION_Y" type="text" id="IMAGE_STAMP_TEXT_LOCATION_Y" value="{CONF.IMAGE_STAMP_TEXT_LOCATION_Y}" size="40" /></td>
    <td>top, middle or bottom </td>
  </tr>
  <tr>
    <td><strong>Stamp text location (X) </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_TEXT_LOCATION_X" type="text" id="IMAGE_STAMP_TEXT_LOCATION_X" value="{CONF.IMAGE_STAMP_TEXT_LOCATION_X}" size="40" /></td>
    <td>left, middle or right </td>
  </tr>
  <tr>
    <td><strong>Stamp text Y padding: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_TEXT_PADDING_Y" type="text" id="IMAGE_STAMP_TEXT_PADDING_Y" value="{CONF.IMAGE_STAMP_TEXT_PADDING_Y}" size="40" /></td>
    <td>px</td>
  </tr>
  <tr>
    <td><strong>Stamp text X padding: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_TEXT_PADDING_X" type="text" id="IMAGE_STAMP_TEXT_PADDING_X" value="{CONF.IMAGE_STAMP_TEXT_PADDING_X}" size="40" /></td>
    <td>px</td>
  </tr>
  <tr>
    <td><strong>Use stamp drophilight: </strong></td>
    <td>&nbsp;</td>
    <td><label>
      <input type="checkbox" name="IMAGE_STAMP_TEXT_DROPHILIGHT" value="1" {ck.IMAGE_STAMP_TEXT_DROPHILIGHT} />
Enable drophilight </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Drophilight dephase: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_TEXT_DROPHILIGHT_DEPHASE" type="text" id="IMAGE_STAMP_TEXT_DROPHILIGHT_DEPHASE" value="{CONF.IMAGE_STAMP_TEXT_DROPHILIGHT_DEPHASE}" size="40" /></td>
    <td>px</td>
  </tr>
  <tr>
    <td><strong>Drophilight color: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_TEXT_DROPHILIGHT_COLOR" type="text" id="IMAGE_STAMP_TEXT_DROPHILIGHT_COLOR" value="{CONF.IMAGE_STAMP_TEXT_DROPHILIGHT_COLOR}" size="40" /></td>
    <td>* R,G,B </td>
  </tr>
  <tr>
    <td><strong>Image render quality: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_QUALITY" type="text" id="IMAGE_QUALITY" value="{CONF.IMAGE_QUALITY}" size="40" /></td>
    <td>* Integer 0 to 100 (%) </td>
  </tr>
  <tr>
    <td><strong>Maximum image width: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_MAX_WIDTH" type="text" id="IMAGE_MAX_WIDTH" value="{CONF.IMAGE_MAX_WIDTH}" size="40" /></td>
    <td>px</td>
  </tr>
  <tr>
    <td><strong>Default thumbnail width: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_THUMBNAILS_SIZE" type="text" id="IMAGE_THUMBNAILS_SIZE" value="{CONF.IMAGE_THUMBNAILS_SIZE}" size="40" /></td>
    <td>px</td>
  </tr>
  <tr>
    <td><strong>Text stamp min width threshold: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_STAMP_MINWIDTH" type="text" id="IMAGE_STAMP_MINWIDTH" value="{CONF.IMAGE_STAMP_MINWIDTH}" size="40" /></td>
    <td>px</td>
  </tr>
  <tr>
    <td><strong>Use watermark: </strong></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="IMAGE_USE_WATERMARK" value="1" {ck.IMAGE_USE_WATERMARK}/>
Enable watermark </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Watermark file: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_WATERMARK_FILE" type="text" id="IMAGE_WATERMARK_FILE" value="{CONF.IMAGE_WATERMARK_FILE}" size="40" /></td>
    <td>(PNG, in system/cache/pictures/) </td>
  </tr>
  <tr>
    <td><strong>Watermark padding: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_WATERMARK_PADDING" type="text" id="IMAGE_WATERMARK_PADDING" value="{CONF.IMAGE_WATERMARK_PADDING}" size="40" /></td>
    <td>px</td>
  </tr>
  <tr>
    <td><strong>Watermark resize factor: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_WATERMARK_RESIZE_FACTOR" type="text" id="IMAGE_WATERMARK_RESIZE_FACTOR" value="{CONF.IMAGE_WATERMARK_RESIZE_FACTOR}" size="40" /></td>
    <td>%</td>
  </tr>
  <tr>
    <td><strong>Watermark minimum image width:</strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_WATERMARK_MINWIDTH" type="text" id="IMAGE_WATERMARK_MINWIDTH" value="{CONF.IMAGE_WATERMARK_MINWIDTH}" size="40" /></td>
    <td>px</td>
  </tr>
  <tr>
    <td><strong>Watermark blend visibility: </strong></td>
    <td>&nbsp;</td>
    <td><input name="IMAGE_WATERMARK_BLEND_VISIBILITY" type="text" id="IMAGE_WATERMARK_BLEND_VISIBILITY" value="{CONF.IMAGE_WATERMARK_BLEND_VISIBILITY}" size="40" /></td>
    <td>%</td>
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
