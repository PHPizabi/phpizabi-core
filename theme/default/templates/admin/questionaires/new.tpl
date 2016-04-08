<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h1>Create a new questionaire</h1></td>
    <td width="15">&nbsp;</td>
    <td align="right"><span class="text_redNotice">{questionaire}</span></td>
  </tr>
  <tr>
    <td colspan="3">
		<h4>
		<ZONE step namequestionaire>
		Name your Questionaire
		</ZONE step namequestionaire>
		
		<ZONE step addquestion>
		Add a Question
		</ZONE step addquestion>
		
		<ZONE step setquestion>
		Set field parameters
		</ZONE step setquestion>
		
		<ZONE step showquestionaire>
		Your Questionaire so far
		</ZONE step showquestionaire>
		
		<ZONE step savequestionaire>
		Saving Questionaire
		</ZONE step savequestionaire>
		</h4>
	</td>
  </tr>
  <tr>
    <td colspan="3" class="cell_line"><img src="[THEME_PATH]/images/spacer.gif" alt="Spacer" width="1" height="1" /></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="250" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><h2>What is a questionaire?</h2></td>
        </tr>
        <tr>
          <td valign="middle">A questionaire is a group of questions that is used for different purposes on your site. This can be a part of the registration process, a poll or a public census. The questionaire contains as many questions as you want. Depending on the field type you choose for each question, there may be prepopulated answers to the questions.</td>
        </tr>
      </table>
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="cell_line"><img src="[THEME_PATH]/images/spacer.gif" alt="Spacer" width="1" height="1" /></td>
        </tr>
        <tr>
          <td><h2>Tip</h2></td>
        </tr>
        <tr>
          <td valign="middle">You should keep your questionaires organized by creating a different questionaire for different questions groups. Eg.: Life Style questions should be created in the Life Style questionaire. </td>
        </tr>
      </table>
      <br>
    <br></td>
    <td width="10">&nbsp;</td>
    <td valign="top">
	
	

	
	
	<ZONE action create><h4>Name this questionaire</h4><br>
	Please give a name to this questionaire. This name will be shown as the questionaire (group) title where the questionaire will be used.
    <br>
    <br>
    <br />
<form method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr>
      <td>Questionaire name: </td>
      <td><input name="name" type="text" id="name" size="60"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Submit"></td>
    </tr>
  </table>
</form>
</ZONE action create>

<ZONE action showquestionaire>
<h4>Your Questionaire so far</h4><br>
This is the questionaire you have built so far. At this point you may add more questions, re-order them, remove questions, 
save the questionaire or start over. Note that your questionaire will not be saved until you press the save button. <br>
<br>
{qlist}

<br>
<br>
<br>
<form method="post">
<input name="addquestion" type="submit" id="addquestion" value="Add a question"> 
<input name="SubmitSave" type="submit" id="SubmitSave" value="Save"> 
<input name="reset" type="submit" id="reset" value="Start over">
</form>
</ZONE action showquestionaire>


<ZONE action savequestionaire><h4>Save Questionaire</h4><br>
<ZONE save success>
Your questionaire has been successfully saved. You may leave this page, add more questions to your saved questionaire or create a new questionaire. If you change this questionaire, don't forget to save it again once you're done.<br>
</ZONE save success>
<ZONE save failed>
There has been an error trying to save your questionaire. Please make sure that the system is allowed to write in the cache directory. You must correct this problem and press the save button again in order to save your questionaire.<br>
</ZONE save failed>
<br>
<br>
<form method="post">
<input name="addquestion" type="submit" id="addquestion" value="Add a question">
<input name="reset" type="submit" id="reset" value="Create New">
</form>
<p>
</ZONE action savequestionaire>
  
  
<ZONE action addquestion>
  <h4>Add a Question to this questionaire</h4><br>
  Write your question as you want it to appear in the questionaire. Don't forget to add a question mark if you need one. The field type defines the way the user can answer the question. </p>
<p>text field, single text line that a user types in his/her answer.<br />
  text area, multiple line text area that a user types in his/her answer.<br />
  CheckBoxes, user selects one or all of the possible answers <br />
  Radio Buttons, user can only select one possible answer<br />
  DropDown Menus, user can only select one possible answer</p>
<form method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td>Question:</td>
    <td><input name="question" type="text" id="question" size="60"></td>
  </tr>
  <tr>
    <td>Field type: </td>
    <td><select name="fieldtype" id="fieldtype">
      <option value="textfield" selected>Text Field</option>
      <option value="textarea">Text Area</option>
      <option value="checkboxes">Checkboxes</option>
      <option value="radiobuttons">Radio Buttons</option>
      <option value="dropdown">Dropdown Menu</option>
    </select>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="SubmitQuestion" type="submit" id="SubmitQuestion" value="Submit"></td>
  </tr>
</table>
</form>
</ZONE action addquestion>

<ZONE action set_question_extras> 
  <h4>Set field parameters</h4>
  <br>
  The field parameters on Free Form fields defines the way the field will appear on the questionaire. The field parameters on a pre-populated fields define its possible answers. 
  <br>
  <br>
  <br>
  <form method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td><strong>{question} ({fieldtype})    </strong></td>
  </tr>
  <tr>
    <td>
	<ZONE fieldopts textfield>
	<table width="100%" border="0" cellpadding="0" cellspacing="2" id="textfield">
      <tr>
        <td>Default value: </td>
        <td><input name="default" type="text" id="default" size="40"></td>
        <td>Pre-populate the field with this default value</td>
      </tr>
      <tr>
        <td>Characters width: </td>
        <td><input name="charwidth" type="text" id="charwidth" size="10"></td>
        <td>Defines the field width</td>
      </tr>
      <tr>
        <td>Maximum characters: </td>
        <td><input name="maxlen" type="text" id="maxlen" size="10"></td>
        <td>Defines the maximum value lenght</td>
      </tr>
    </table>
	</ZONE fieldopts textfield>
	<ZONE fieldopts textarea>
	<br>
    <table width="100%" border="0" cellpadding="0" cellspacing="2" id="textarea">
      <tr>
        <td>Default value: </td>
        <td><input name="default" type="text" id="default" size="40"></td>
        <td>Pre-populate the field with this default value</td>
      </tr>
      <tr>
        <td>Characters width: </td>
        <td><input name="charwidth" type="text" id="charwidth" size="10"></td>
        <td>Defines the field width</td>
      </tr>
      <tr>
        <td>Lines:</td>
        <td><input name="lines" type="text" id="lines" size="10"></td>
        <td>Defines de field height </td>
      </tr>
      <tr>
        <td>Maximum characters: </td>
        <td><input name="maxlen" type="text" id="maxlen" size="10"></td>
        <td>Defines the maximum value lenght</td>
      </tr>
    </table>
	</ZONE fieldopts textarea>
	<ZONE fieldopts populated>
   This field is a pre-populated type. Type possible answers to this question in the field below. Separate them with a linefeed (return).<br>
   <br>
   <br>
    <table width="100%" border="0" cellpadding="0" cellspacing="2" id="populated">
      <tr>
        <td>Answers: (one per line) </td>
        <td><textarea name="options" cols="40" rows="5" id="options"></textarea></td>
      </tr>
    </table>
	</ZONE fieldopts populated></td>
  </tr>
  <tr>
    <td><input name="SubmitFieldOpts" type="submit" id="SubmitQuestion2" value="Submit"></td>
  </tr>
</table>
</form>
</ZONE action set_question_extras></td>
  </tr>
</table>
