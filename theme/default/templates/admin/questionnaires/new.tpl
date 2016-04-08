<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="250"><h2>Create a new questionnaire</h2></td>
    <td width="15">&nbsp;</td>
    <td align="right"><span class="text_redNotice">{questionaire}</span></td>
  </tr>
  <tr>
    <td colspan="3">
		<strong>
		<ZONE step namequestionaire>
		Name your Questionnaire		</ZONE step namequestionaire>
		
		<ZONE step addquestion>
		Add a Question		</ZONE step addquestion>
		
		<ZONE step setquestion>
		Set field parameters		</ZONE step setquestion>
		
		<ZONE step showquestionaire>
		Your Questionnaire so far		</ZONE step showquestionaire>
		
		<ZONE step savequestionaire>
		Saving Questionnaire		</ZONE step savequestionaire>
		</strong>	</td>
  </tr>
  <tr>
    <td colspan="3" class="cell_line">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><br>
      <br>
      <br>
	
	

	
	
	  <ZONE action create>
	    <h4>Name this questionnaire</h4><br>
	    Please give a name to this questionnaire. This name will be shown as the questionnaire (group) title where the questionnaire will be used.
	    <br>
	    <br>
	    <br />
  <form method="post">
    <table width="100%" border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td><strong>Questionnaire name: </strong></td>
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
  <h4>Your Questionnaire so far</h4><br>
        This is the questionnaire you have built so far. At this point you may add more questions, re-order them, remove questions, 
        save the questionnaire or start over. Note that your questionnaire will not be saved until you press the save button. <br>
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


      <ZONE action savequestionaire>
        <h4>Save Questionnaire</h4><br>
  <ZONE save success>
    Your questionnaire has been successfully saved. You may leave this page, add more questions to your saved questionnaire or create a new questionnaire. If you change this questionnaire, don't forget to save it again once you're done.<br>
  </ZONE save success>
  <ZONE save failed>
    There has been an error trying to save your questionnaire. Please make sure that the system is allowed to write in the cache directory. You must correct this problem and press the save button again in order to save your questionnaire.<br>
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
        <h4>Add a Question to this questionnaire</h4><br>
        Write your question as you want it to appear in the questionnaire. Don't forget to add a question mark if you need one. The field type defines the way the user can answer the question. </p>
        <p>text field, single text line that a user types in his/her answer.<br />
    text area, multiple line text area that a user types in his/her answer.<br />
    CheckBoxes, user selects one or all of the possible answers <br />
    Radio Buttons, user can only select one possible answer<br />
    DropDown Menus, user can only select one possible answer</p>
  <form method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="0">
    <tr>
      <td><strong>Question:</strong></td>
      <td><input name="question" type="text" id="question" size="60"></td>
    </tr>
    <tr>
      <td><strong>Field type: </strong></td>
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
        The field parameters on Free Form fields defines the way the field will appear on the questionnaire. The field parameters on a pre-populated fields define its possible answers. 
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
              <td><strong>Default value: </strong></td>
          <td><input name="default" type="text" id="default" size="40"></td>
          <td>Pre-populate the field with this default value</td>
        </tr>
            <tr>
              <td><strong>Characters width: </strong></td>
          <td><input name="charwidth" type="text" id="charwidth" size="10"></td>
          <td>Defines the field width</td>
        </tr>
            <tr>
              <td><strong>Maximum characters: </strong></td>
          <td><input name="maxlen" type="text" id="maxlen" size="10"></td>
          <td>Defines the maximum value lenght</td>
        </tr>
            </table>
	  </ZONE fieldopts textfield>
        <ZONE fieldopts textarea>
          <br>
          <table width="100%" border="0" cellpadding="0" cellspacing="2" id="textarea">
            <tr>
              <td><strong>Default value: </strong></td>
          <td><input name="default" type="text" id="default" size="40"></td>
          <td>Pre-populate the field with this default value</td>
        </tr>
            <tr>
              <td><strong>Characters width: </strong></td>
          <td><input name="charwidth" type="text" id="charwidth" size="10"></td>
          <td>Defines the field width</td>
        </tr>
            <tr>
              <td><strong>Lines:</strong></td>
          <td><input name="lines" type="text" id="lines" size="10"></td>
          <td>Defines de field height </td>
        </tr>
            <tr>
              <td><strong>Maximum characters: </strong></td>
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
              <td><strong>Answers: (one per line) </strong></td>
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
