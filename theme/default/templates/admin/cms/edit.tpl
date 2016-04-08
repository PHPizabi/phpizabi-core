<h2>Content Page Edition </h2>
<p>&nbsp;</p><p>&nbsp;</p>
<form method="post">
<table width="100%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td><strong>Editing content page {cms.pageName} </strong></td>
    <td align="right">
	<zone error writeLock>
    <p style="color:red"><strong>This content page or the containing folder is write protected. You won't be able to save your changes.</strong></p>
    </zone error writeLock>	</td>
  </tr>
  <tr>
    <td colspan="2"><textarea name="body[]" rows="30" class="fullwidth" id="body[]">{cms.pageContent}</textarea></td>
  </tr>
  <tr>
    <td colspan="2"><input name="textfield" type="text" value="{cms.url}" class="fullwidth"></td>
    </tr>
  <tr>
    <td height="30" colspan="2" bgcolor="#CCCCCC" style="padding-left:8px;"><input type="submit" name="Submit" value="Save Changes"></td>
  </tr>
</table>
</form>