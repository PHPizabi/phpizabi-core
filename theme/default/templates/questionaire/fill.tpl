<!-- header --><!-- /header -->
<ZONE main questionaire>
{content}
</ZONE main questionaire>
<ZONE main saved>
[Thank you for completing the questionaire, your profile has been updated. {7500}]
</ZONE main saved>

<OBJ header>
<h3>{title}</h3>
<form method="post">
</OBJ header>

<OBJ q_textfield>
  <table>
  <tr>
    <td>{question}</td>
    <td>&nbsp;</td>
    <td><input name="{question_code}" type="text" value="{default}" size="{charwidth}" maxlength="{maxlen}"></td>
  </tr>
  </table>
 </OBJ q_textfield>

<OBJ q_textarea>
  <table>
  <tr>
    <td>{question}</td>
    <td>&nbsp;</td>
    <td><textarea name="{question_code}" cols="{charwidth}" rows="{lines}" maxlength="{maxlen}" value="{value}">{default}</textarea></td>
  </tr>
  </table>
</OBJ q_textarea>
 
<OBJ q_checkboxes>
  <table>
  <tr>
    <td>{question}</td>
    <td>&nbsp;</td>
    <td>
		<LOOP options>
		<label><input type="checkbox" name="{question_code}[]" value="{value}"> {value}</label><br>
		</LOOP options>
	</td>
  </tr>
  </table>
</OBJ q_checkboxes>

<OBJ q_radiobuttons>
  <table>
  <tr>
    <td>{question}</td>
    <td>&nbsp;</td>
    <td>
		<LOOP options>
		<label><input name="{question_code}" type="radio" value="{value}" checked> 
		{value}<br></label>
		</LOOP options>
		</td>
  </tr>
  </table>
</OBJ q_radiobuttons>
 
<OBJ q_dropdown>
  <table>
  <tr>
    <td>{question}</td>
    <td>&nbsp;</td>
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
<input name="Submit" type="submit" id="Submit" value="[Submit {295}]">
</form>
</OBJ end>
<!-- footer --><!-- /footer -->