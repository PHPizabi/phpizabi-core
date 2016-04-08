<!-- header --><!-- /header -->
{content}

<OBJ header>
<h3>{title}</h3>
<form method="post">
</OBJ header>

<OBJ q_textfield>
  <table width="100%">
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="300" align="right" valign="top"><strong>{question}</strong></td>
    <td width="10">&nbsp;</td>
    <td><input name="{question_code}" type="text" value="{default}" size="{charwidth}" maxlength="{maxlen}"></td>
  </tr>
  </table>
 </OBJ q_textfield>

<OBJ q_textarea>
  <table width="100%">
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="300" align="right" valign="top"><strong>{question}</strong></td>
    <td width="10">&nbsp;</td>
    <td><textarea name="{question_code}" cols="{charwidth}" rows="{lines}" maxlength="{maxlen}" value="{value}">{default}</textarea></td>
  </tr>
  </table>
</OBJ q_textarea>
 
<OBJ q_checkboxes>
  <table width="100%">
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="300" align="right" valign="top"><strong>{question}</strong></td>
    <td width="10">&nbsp;</td>
    <td>
		<LOOP options>
		<label><input type="checkbox" name="{question_code}[]" value="{value}"> {value}</label><br>
		</LOOP options>	</td>
  </tr>
  </table>
</OBJ q_checkboxes>

<OBJ q_radiobuttons>
  <table width="100%">
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="300" align="right" valign="top"><strong>{question}</strong></td>
    <td width="10">&nbsp;</td>
    <td>
		<LOOP options>
		<label><input name="{question_code}" type="radio" value="{value}" checked> 
		{value}<br></label>
		</LOOP options>		</td>
  </tr>
  </table>
</OBJ q_radiobuttons>
 
<OBJ q_dropdown>
  <table width="100%">
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="300" align="right" valign="top"><strong>{question}</strong></td>
    <td width="10">&nbsp;</td>
    <td>
		<select name="{question_code}">
		<LOOP options>
		<option value="{value}">{value}</option>
		</LOOP options>
        </select></td>
  </tr>
  </table>
</OBJ q_dropdown>

<OBJ end>
  <table width="100%">
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="300" align="right" valign="top">&nbsp;</td>
    <td width="10">&nbsp;</td>
    <td><input name="Submit" type="submit" id="Submit" value="[Submit {295}]"></td>
  </tr>
  <tr>
    <td align="right" valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
</form>
</OBJ end>


<ZONE completed enabled>
<h1>[Successful! {155}]</h1>
[Thank you for registering. Please check your emails for your activation code. {7661}]
</ZONE completed enabled>

<!-- footer --><!-- /footer -->