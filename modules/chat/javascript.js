/* SaveNotepad */
function saveNotepad() {
	ajFetch('?proc_footer_element=notepad&notepad_body=' + urlEncode(document.getElementById('notepad_body').value), 'footer_elements', false, 0);
}

function notepadStateChange() {
	document.getElementById('notepad_save_button').className='submit';
	document.getElementById('notepad_save_button').disabled=false;
}

/* TABS */
// Prevents tabs flicker //
document.write('<style type="text/css">.tabber{display:none;}<\/style>');
/*==================================================
  $Id: tabber.js,v 1.9 2006/04/27 20:51:51 pat Exp $
  tabber.js by Patrick Fitzgerald pat@barelyfitz.com

  Documentation can be found at the following URL:
  http://www.barelyfitz.com/projects/tabber/

  License (http://www.opensource.org/licenses/mit-license.php)

  Copyright (c) 2006 Patrick Fitzgerald

  Permission is hereby granted, free of charge, to any person
  obtaining a copy of this software and associated documentation files
  (the "Software"), to deal in the Software without restriction,
  including without limitation the rights to use, copy, modify, merge,
  publish, distribute, sublicense, and/or sell copies of the Software,
  and to permit persons to whom the Software is furnished to do so,
  subject to the following conditions:

  The above copyright notice and this permission notice shall be
  included in all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
  EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
  NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS
  BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN
  ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
  CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
  SOFTWARE.
  ==================================================*/

function tabberObj(argsObj)
{
  var arg; /* name of an argument to override */

  /* Element for the main tabber div. If you supply this in argsObj,
     then the init() method will be called.
  */
  this.div = null;

  /* Class of the main tabber div */
  this.classMain = "tabber";

  /* Rename classMain to classMainLive after tabifying
     (so a different style can be applied)
  */
  this.classMainLive = "tabberlive";

  /* Class of each DIV that contains a tab */
  this.classTab = "tabbertab";

  /* Class to indicate which tab should be active on startup */
  this.classTabDefault = "tabbertabdefault";

  /* Class for the navigation UL */
  this.classNav = "tabbernav";

  /* When a tab is to be hidden, instead of setting display='none', we
     set the class of the div to classTabHide. In your screen
     stylesheet you should set classTabHide to display:none.  In your
     print stylesheet you should set display:block to ensure that all
     the information is printed.
  */
  this.classTabHide = "tabbertabhide";

  /* Class to set the navigation LI when the tab is active, so you can
     use a different style on the active tab.
  */
  this.classNavActive = "tabberactive";

  /* Elements that might contain the title for the tab, only used if a
     title is not specified in the TITLE attribute of DIV classTab.
  */
  this.titleElements = ['h2','h3','h4','h5','h6'];

  /* Should we strip out the HTML from the innerHTML of the title elements?
     This should usually be true.
  */
  this.titleElementsStripHTML = true;

  /* If the user specified the tab names using a TITLE attribute on
     the DIV, then the browser will display a tooltip whenever the
     mouse is over the DIV. To prevent this tooltip, we can remove the
     TITLE attribute after getting the tab name.
  */
  this.removeTitle = true;

  /* If you want to add an id to each link set this to true */
  this.addLinkId = false;

  /* If addIds==true, then you can set a format for the ids.
     <tabberid> will be replaced with the id of the main tabber div.
     <tabnumberzero> will be replaced with the tab number
       (tab numbers starting at zero)
     <tabnumberone> will be replaced with the tab number
       (tab numbers starting at one)
     <tabtitle> will be replaced by the tab title
       (with all non-alphanumeric characters removed)
   */
  this.linkIdFormat = '<tabberid>nav<tabnumberone>';

  /* You can override the defaults listed above by passing in an object:
     var mytab = new tabber({property:value,property:value});
  */
  for (arg in argsObj) { this[arg] = argsObj[arg]; }

  /* Create regular expressions for the class names; Note: if you
     change the class names after a new object is created you must
     also change these regular expressions.
  */
  this.REclassMain = new RegExp('\\b' + this.classMain + '\\b', 'gi');
  this.REclassMainLive = new RegExp('\\b' + this.classMainLive + '\\b', 'gi');
  this.REclassTab = new RegExp('\\b' + this.classTab + '\\b', 'gi');
  this.REclassTabDefault = new RegExp('\\b' + this.classTabDefault + '\\b', 'gi');
  this.REclassTabHide = new RegExp('\\b' + this.classTabHide + '\\b', 'gi');

  /* Array of objects holding info about each tab */
  this.tabs = new Array();

  /* If the main tabber div was specified, call init() now */
  if (this.div) {

    this.init(this.div);

    /* We don't need the main div anymore, and to prevent a memory leak
       in IE, we must remove the circular reference between the div
       and the tabber object. */
    this.div = null;
  }
}


/*--------------------------------------------------
  Methods for tabberObj
  --------------------------------------------------*/


tabberObj.prototype.init = function(e)
{
  /* Set up the tabber interface.

     e = element (the main containing div)

     Example:
     init(document.getElementById('mytabberdiv'))
   */

  var
  childNodes, /* child nodes of the tabber div */
  i, i2, /* loop indices */
  t, /* object to store info about a single tab */
  defaultTab=0, /* which tab to select by default */
  DOM_ul, /* tabbernav list */
  DOM_li, /* tabbernav list item */
  DOM_a, /* tabbernav link */
  aId, /* A unique id for DOM_a */
  headingElement; /* searching for text to use in the tab */

  /* Verify that the browser supports DOM scripting */
  if (!document.getElementsByTagName) { return false; }

  /* If the main DIV has an ID then save it. */
  if (e.id) {
    this.id = e.id;
  }

  /* Clear the tabs array (but it should normally be empty) */
  this.tabs.length = 0;

  /* Loop through an array of all the child nodes within our tabber element. */
  childNodes = e.childNodes;
  for(i=0; i < childNodes.length; i++) {

    /* Find the nodes where class="tabbertab" */
    if(childNodes[i].className &&
       childNodes[i].className.match(this.REclassTab)) {
      
      /* Create a new object to save info about this tab */
      t = new Object();
      
      /* Save a pointer to the div for this tab */
      t.div = childNodes[i];
      
      /* Add the new object to the array of tabs */
      this.tabs[this.tabs.length] = t;

      /* If the class name contains classTabDefault,
	 then select this tab by default.
      */
      if (childNodes[i].className.match(this.REclassTabDefault)) {
	defaultTab = this.tabs.length-1;
      }
    }
  }

  /* Create a new UL list to hold the tab headings */
  DOM_ul = document.createElement("ul");
  DOM_ul.className = this.classNav;
  
  /* Loop through each tab we found */
  for (i=0; i < this.tabs.length; i++) {

    t = this.tabs[i];

    /* Get the label to use for this tab:
       From the title attribute on the DIV,
       Or from one of the this.titleElements[] elements,
       Or use an automatically generated number.
     */
    t.headingText = t.div.title;

    /* Remove the title attribute to prevent a tooltip from appearing */
    if (this.removeTitle) { t.div.title = ''; }

    if (!t.headingText) {

      /* Title was not defined in the title of the DIV,
	 So try to get the title from an element within the DIV.
	 Go through the list of elements in this.titleElements
	 (typically heading elements ['h2','h3','h4'])
      */
      for (i2=0; i2<this.titleElements.length; i2++) {
	headingElement = t.div.getElementsByTagName(this.titleElements[i2])[0];
	if (headingElement) {
	  t.headingText = headingElement.innerHTML;
	  if (this.titleElementsStripHTML) {
	    t.headingText.replace(/<br>/gi," ");
	    t.headingText = t.headingText.replace(/<[^>]+>/g,"");
	  }
	  break;
	}
      }
    }

    if (!t.headingText) {
      /* Title was not found (or is blank) so automatically generate a
         number for the tab.
      */
      t.headingText = i + 1;
    }

    /* Create a list element for the tab */
    DOM_li = document.createElement("li");

    /* Save a reference to this list item so we can later change it to
       the "active" class */
    t.li = DOM_li;

    /* Create a link to activate the tab */
    DOM_a = document.createElement("a");
    DOM_a.appendChild(document.createTextNode(t.headingText));
    DOM_a.href = "javascript:void(null);";
    DOM_a.title = t.headingText;
    DOM_a.onclick = this.navClick;

    /* Add some properties to the link so we can identify which tab
       was clicked. Later the navClick method will need this.
    */
    DOM_a.tabber = this;
    DOM_a.tabberIndex = i;

    /* Do we need to add an id to DOM_a? */
    if (this.addLinkId && this.linkIdFormat) {

      /* Determine the id name */
      aId = this.linkIdFormat;
      aId = aId.replace(/<tabberid>/gi, this.id);
      aId = aId.replace(/<tabnumberzero>/gi, i);
      aId = aId.replace(/<tabnumberone>/gi, i+1);
      aId = aId.replace(/<tabtitle>/gi, t.headingText.replace(/[^a-zA-Z0-9\-]/gi, ''));

      DOM_a.id = aId;
    }

    /* Add the link to the list element */
    DOM_li.appendChild(DOM_a);

    /* Add the list element to the list */
    DOM_ul.appendChild(DOM_li);
  }

  /* Add the UL list to the beginning of the tabber div */
  e.insertBefore(DOM_ul, e.firstChild);

  /* Make the tabber div "live" so different CSS can be applied */
  e.className = e.className.replace(this.REclassMain, this.classMainLive);

  /* Activate the default tab, and do not call the onclick handler */
  this.tabShow(defaultTab);

  /* If the user specified an onLoad function, call it now. */
  if (typeof this.onLoad == 'function') {
    this.onLoad({tabber:this});
  }

  return this;
};


tabberObj.prototype.navClick = function(event)
{
  /* This method should only be called by the onClick event of an <A>
     element, in which case we will determine which tab was clicked by
     examining a property that we previously attached to the <A>
     element.

     Since this was triggered from an onClick event, the variable
     "this" refers to the <A> element that triggered the onClick
     event (and not to the tabberObj).

     When tabberObj was initialized, we added some extra properties
     to the <A> element, for the purpose of retrieving them now. Get
     the tabberObj object, plus the tab number that was clicked.
  */

  var
  rVal, /* Return value from the user onclick function */
  a, /* element that triggered the onclick event */
  self, /* the tabber object */
  tabberIndex, /* index of the tab that triggered the event */
  onClickArgs; /* args to send the onclick function */

  a = this;
  if (!a.tabber) { return false; }

  self = a.tabber;
  tabberIndex = a.tabberIndex;

  /* Remove focus from the link because it looks ugly.
     I don't know if this is a good idea...
  */
  a.blur();

  /* If the user specified an onClick function, call it now.
     If the function returns false then do not continue.
  */
  if (typeof self.onClick == 'function') {

    onClickArgs = {'tabber':self, 'index':tabberIndex, 'event':event};

    /* IE uses a different way to access the event object */
    if (!event) { onClickArgs.event = window.event; }

    rVal = self.onClick(onClickArgs);
    if (rVal === false) { return false; }
  }

  self.tabShow(tabberIndex);

  return false;
};


tabberObj.prototype.tabHideAll = function()
{
  var i; /* counter */

  /* Hide all tabs and make all navigation links inactive */
  for (i = 0; i < this.tabs.length; i++) {
    this.tabHide(i);
  }
};


tabberObj.prototype.tabHide = function(tabberIndex)
{
  var div;

  if (!this.tabs[tabberIndex]) { return false; }

  /* Hide a single tab and make its navigation link inactive */
  div = this.tabs[tabberIndex].div;

  /* Hide the tab contents by adding classTabHide to the div */
  if (!div.className.match(this.REclassTabHide)) {
    div.className += ' ' + this.classTabHide;
  }
  this.navClearActive(tabberIndex);

  return this;
};


tabberObj.prototype.tabShow = function(tabberIndex)
{
  /* Show the tabberIndex tab and hide all the other tabs */

  var div;

  if (!this.tabs[tabberIndex]) { return false; }

  /* Hide all the tabs first */
  this.tabHideAll();

  /* Get the div that holds this tab */
  div = this.tabs[tabberIndex].div;

  /* Remove classTabHide from the div */
  div.className = div.className.replace(this.REclassTabHide, '');

  /* Mark this tab navigation link as "active" */
  this.navSetActive(tabberIndex);

  /* If the user specified an onTabDisplay function, call it now. */
  if (typeof this.onTabDisplay == 'function') {
    this.onTabDisplay({'tabber':this, 'index':tabberIndex});
  }

  return this;
};

tabberObj.prototype.navSetActive = function(tabberIndex)
{
  /* Note: this method does *not* enforce the rule
     that only one nav item can be active at a time.
  */

  /* Set classNavActive for the navigation list item */
  this.tabs[tabberIndex].li.className = this.classNavActive;

  return this;
};


tabberObj.prototype.navClearActive = function(tabberIndex)
{
  /* Note: this method does *not* enforce the rule
     that one nav should always be active.
  */

  /* Remove classNavActive from the navigation list item */
  this.tabs[tabberIndex].li.className = '';

  return this;
};


/*==================================================*/


function tabberAutomatic(tabberArgs)
{
  /* This function finds all DIV elements in the document where
     class=tabber.classMain, then converts them to use the tabber
     interface.

     tabberArgs = an object to send to "new tabber()"
  */
  var
    tempObj, /* Temporary tabber object */
    divs, /* Array of all divs on the page */
    i; /* Loop index */

  if (!tabberArgs) { tabberArgs = {}; }

  /* Create a tabber object so we can get the value of classMain */
  tempObj = new tabberObj(tabberArgs);

  /* Find all DIV elements in the document that have class=tabber */

  /* First get an array of all DIV elements and loop through them */
  divs = document.getElementsByTagName("div");
  for (i=0; i < divs.length; i++) {
    
    /* Is this DIV the correct class? */
    if (divs[i].className &&
	divs[i].className.match(tempObj.REclassMain)) {
      
      /* Now tabify the DIV */
      tabberArgs.div = divs[i];
      divs[i].tabber = new tabberObj(tabberArgs);
    }
  }
  
  return this;
}


/*==================================================*/


function tabberAutomaticOnLoad(tabberArgs)
{
  /* This function adds tabberAutomatic to the window.onload event,
     so it will run after the document has finished loading.
  */
  var oldOnLoad;

  if (!tabberArgs) { tabberArgs = {}; }

  /* Taken from: http://simon.incutio.com/archive/2004/05/26/addLoadEvent */

  oldOnLoad = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = function() {
      tabberAutomatic(tabberArgs);
    };
  } else {
    window.onload = function() {
      oldOnLoad();
      tabberAutomatic(tabberArgs);
    };
  }
}


/*==================================================*/


/* Run tabberAutomaticOnload() unless the "manualStartup" option was specified */

if (typeof tabberOptions == 'undefined') {

    tabberAutomaticOnLoad();

} else {

  if (!tabberOptions['manualStartup']) {
    tabberAutomaticOnLoad(tabberOptions);
  }

}

//////////////////////////// TEMP DEBUG /////////////////////////
function showDebug() {
	var debugDiv = document.getElementById('debug'); 
	if (debugDiv.style.visibility == 'hidden') {
		debugDiv.style.visibility = 'visible';
	} 
	
	else debugDiv.style.visibility = 'hidden';
}

function clearDebug() {
	document.getElementById('debug').innerHTML = '<table width="100%" border="0"> <tr> <td><h2>DO NOT REPORT!</h2></td><td align="right"><a href="javascript:clearDebug();">Clear</a></td></tr></table>';
	document.getElementById('debugLink').innerHTML = '<a href="javascript:showDebug();">Debug</a>';
	var debugDiv = document.getElementById('debug');
	debugDiv.style.visibility = 'hidden';
}

/* URL POPPER */
function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=1,width=600,height=550');");
}

function showUserPicture(pictureFile) {
	document.getElementById('shadeWrapper').style.visibility = 'visible';
	document.getElementById('noShadeContent').style.visibility = 'visible';
	document.getElementById('dynamicUserPictureViewer').src = 'system/image.php?file=' + pictureFile + '&width=400';
}

function hideUserPicture() {
	document.getElementById('shadeWrapper').style.visibility = 'hidden';
	document.getElementById('noShadeContent').style.visibility = 'hidden';
}

/* Ranking */
function rankEval(hoverState, objectNumber) {
	
	if (objectNumber > 0) {
		
		for (i=1; i <= objectNumber; i++) {
			document.getElementById('voteObject'+i).className = 'votehover';
		}
		
		if (objectNumber+1 < 5) {
			for (i=objectNumber+1; i<=5; i++) {
				document.getElementById('voteObject'+i).className = 'voteclear';
			}
		}
		
		document.getElementById('voteInt').innerHTML = objectNumber + '/5';
		
	} else {
		for (i=1; i<=5; i++) {
			document.getElementById('voteObject'+i).className = 'voteclear';
		}
		document.getElementById('voteInt').innerHTML = '';
	}
}
	
/* BOOKMARK */
function bookmark(title, url) {
  if (document.all) window.external.AddFavorite(url, title);
  else if (window.sidebar) window.sidebar.addPanel(title, url, "");
}

/* LANE */
var paused = false;

function resumeLane() {
	document.getElementById("laneContainer").innerHTML = "";
	paused = false;
}

function launchLANE() {
	ajFetch('?L=lane.lane&chromeless=1','displayLaneContent', true, 30000);
}

function displayLaneContent(dataContent) {
	
	if (dataContent != '') {
		document.getElementById("laneContainer").innerHTML = dataContent;
		paused = true;
	}
}

/* TRITON */
var pin = Math.random();
var tritonProcState = false;

function launchTRITON() {
	if (!tritonProcState) {
		ajFetch('?L=chat.dac&chromeless=1&pin=' + pin, 'appendChatContent', true, 3000);
		document.getElementById('textInput').focus();
		tritonProcState = true;
	}
}

var usersInChat = new Array;
var stringBuffer = '';
var stringBufferActual = '';

function appendChatContent(dataContent) {
	/* Explode the data content at each carriage return */
	streamLines = dataContent.split('\n');
	
	/* Run through each lines */
	for (var n=0; n < streamLines.length; n++) {
		
		/* Don't act if the streamLine is blank */
		if (trim(streamLines[n]) != '') {
		
			/* Split the line into content chunks, divided by ":" */
			contentArray = streamLines[n].split(':');
			
			/* Data innput modes switching */
			switch(contentArray[0]) {
				
				/* CHATCONTENT MODE */
				case 'CHATCONTENT':
					var chatContainer = document.getElementById('chatContent');
					
					if (chatContainer.innerHTML.length > 5120) {
						chatContainer.removeChild(chatContainer.childNodes[0]);
					}
					
					chatContainer.innerHTML += urlDecode(contentArray[1]);
					scrollDown();
				break;
				
				case 'NICKLIST':
					document.getElementById('nickList').innerHTML = urlDecode(contentArray[1]);
				break;
				
				case 'NICKLISTPUSH':
					if (!document.getElementById('nickElement_'+contentArray[1])) {
						/* Push an element into the nicklist */
						var containerElement = document.getElementById('nickList');
						var newNickContainer = document.createElement('div');
						newNickContainer.setAttribute('id', 'nickElement_'+contentArray[1]);
						newNickContainer.innerHTML = urlDecode(contentArray[2]);
						containerElement.appendChild(newNickContainer);
						
						usersInChat.push(contentArray[1]);
					}
					
				break;
				
				case 'NICKLISTPOP':
					/* Pop an element off the nicklist */
					if (document.getElementById('nickElement_'+contentArray[1])) {
						var containerElement = document.getElementById('nickList');
						containerElement.removeChild('nickElement_'+contentArray[1]);
					}
					
					array_pop(usersInChat, contentArray[1]);
					
				break;
				
				case 'TOPIC':
					document.getElementById('topicHandle').innerHTML = urlDecode(contentArray[1]);
				break;

				case 'HEADER':
					document.getElementById('topicHeader').innerHTML = urlDecode(contentArray[1]);
				break;
				
				default:
					document.getElementById('debug').innerHTML += streamLines[n] + " ";
					
					/* 2b removed */
					var debuglen = document.getElementById('debugLink').innerHTML.length;
					document.getElementById('debugLink').innerHTML = '<a href="javascript:showDebug();">Debug (' + debuglen + ')</a>';
				break;
			}
		}
	}
}

function selectNode(node) {
	document.getElementById('debug').innerHTML += "Selected node: " + node + "<br />";
}

/* KeyCodes handler */
function keyEventHandler(key) {
	
	/* This is called when a key has been pressed in the text area */
	switch (key) {
		case 9: /* Tab key */
			
			i=0;
			
			var textField = document.getElementById('textInput');
			if (textField.value != "") {
				
				words = textField.value.split(' ');
				var wordLen = words[words.length-1].length;
				var wholeLen = document.getElementById('textInput').value.length;
				
				if (trim(words[words.length-1]) != "") {
				
					while (key < usersInChat.length) {
						if (words[words.length-1].toLowerCase() == usersInChat[i].substr(0, wordLen).toLowerCase()) {
							textField.value += usersInChat[i].substr(wordLen, usersInChat[i].length-wordLen).toLowerCase() + " ";
							break;
						}
						i++;
					}
				}
		  	}
			void(0);
		break;

		case 13: /* Return key */
			sendData();
		break;
		
		case 37: /* Left Arrow */
			// 
		break;
		
		case 38: /* Up Arrow */
			stringBufferActual = document.getElementById('textInput').value;
			document.getElementById('textInput').value = stringBuffer;
		break;	
		
		case 39: /* Right Arrow */
			//
		break;
		
		case 40: /* Down Arrow */
			document.getElementById('textInput').value = stringBufferActual;
		break;
		
		default:
			data = document.getElementById('textInput').value;
			if (data.substr(0, 1) == "/") {
				ajFetch('?L=chat.comhelper&chromeless=1&str=' + urlEncode(data), 'commandHelper', false, 0);
				document.getElementById('textInput').focus();
			}
			
			else {
				
				var helper = document.getElementById('commandsHelper');
				helper.style.visibility = 'hidden';
				helper.innerHTML = '';
				
				document.getElementById('textInput').focus();
			}
		break;
	}
}

/* Send data from textInput element */
function sendData() {
	data = document.getElementById('textInput').value;

	/* Don't act if data is null */
	if (data != null && trim(data) != '') {

		stringBuffer = data;

		//data = data.replace('+', '&#43');
		
		/* encode and send the channel (ch), encode and send the text content (txt) */
		ajFetch('?L=chat.dac&chromeless=1&pin=' + pin + '&sendChatData=' + urlEncode(data), 'appendChatContent', false, 0);

		/* Clear the textInput value */
		document.getElementById('textInput').value = '';
		
		/* Hide the command helper */
		setTimeout("document.getElementById('commandsHelper').style.visibility = 'hidden';", 500);
		
	}
}

/* Scrolls the content div to its end */
function scrollDown() {
	content = document.getElementById('chatContent');
	content.scrollTop = content.scrollHeight;
}

function detachChat() {
	ajStop('appendChatContent');
	document.getElementById('detachedInfoDiv').style.visibility = 'visible';
	document.getElementById('chatBlockWrapper').style.visibility = 'hidden';	
	
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open('?L=chat.chatroom&channel=general&chromeless=1', '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=500,height=700');");
}

var selectedUser = "";

function pickUser(username) {

	var i=0;
	while (i < usersInChat.length) {
    	if (usersInChat[i] != username) {
			document.getElementById('nickEntityContainer_' + usersInChat[i]).className = 'chatNickEntity';
		}
		i++;
	}
	document.getElementById('nickEntityContainer_'+username).className = 'selectedChatNickEntity';
	selectedUser = username;
}

function actUser() {
	if (selectedUser != "") {
		var action = document.getElementById('userAction').value;
		document.getElementById('textInput').value = '/' + action + " " + selectedUser;
		sendData();
	}
	document.getElementById('userAction').selectedIndex = 0;
}

function commandHelper(dataContent) {

	var helper = document.getElementById('commandsHelper');

	if (trim(dataContent) != "") {
		
		/* Show the helper */
		helper.innerHTML = dataContent;
		
		helper.style.position = 'absolute';
		helper.style.top =  (findPosY(document.getElementById('textInput'))+3)+"px";
		helper.style.left = (findPosX(document.getElementById('textInput'))+2)+"px";
		helper.style.visibility = 'visible';
	}
	
	else {
		helper.style.visibility = 'hidden';
		helper.innerHTML = '';
	}
}
	
/* ---------------------- AJAX ------------------------- */

/* Ajax function class */
/* Declarations */
var arAjx = new Array(1);
var arStops = new Array;



/* ajFetch function */
function ajFetch(url, destination, cycle, delay, noloading) {
	
	/* Execution timer */
	var timerOne = new Date();
	floatInt = timerOne.getTime();
	//
	
	var curInstance;
	if (cycle == null) {
		cycle = false;	
	}
	if (noloading == null) {
		noloading = false;	
	}
	
	if (arAjx.length == 1) {
		curInstance = 1;
		arAjx[1] = new Ajax;
	} else {
		var found = false;
		for (i=1;i<arAjx.length;i++) {
			if (arAjx[i].Is_Free()) {
				curInstance = i;
				found = true;
			}
		}
		
		if (!found) {
			arAjx.push(new Ajax);
			curInstance = arAjx.length;
			arAjx[curInstance] = new Ajax;
		}
	}
	
	if (noloading) { arAjx[curInstance].Set_Loading(false); }
	
	if (paused) {
		arAjx[curInstance].HTTP_Get(url+"&pause=1", destination);
	} else {
		arAjx[curInstance].HTTP_Get(url, destination);
	}
	
	if (arStops[destination] != true) {
		if (cycle) {
			setTimeout("ajFetch('"+url+"','"+destination+"',true,"+delay+");",delay);
		}
	} else {
		arStops[destination] = null;
	}
}

/* Ajax functions, objects, classes and callback */
function Ajax() {
	/* Declarations */
	/* Public methods */
	this.HTTP_Get = HTTP_Get;
	this.Is_Free = Is_Free;
	this.Set_Loading = Set_Loading;
		
	/* Private variables */
	var ajobj = XMLHTTP_object();
	var http_destobj = null;
	var free = true;
	var show_loading = true;

	/* Methods */
	function HTTP_Get(url, destination) {
		if (free && (url != null) && (destination != null) && ((ajobj.readyState == 0) || (ajobj.readyState == 4))) {
			http_destobj = destination;
			
			ajobj.open("GET", url, true);
			ajobj.onreadystatechange = HTTP_Get_CallBack;
			ajobj.setRequestHeader("If-Modified-Since", "Sat, 1 Jan 2000 00:00:00 GMT");
			ajobj.send(null);
			free = false;
		} else {
			return false;
		}
	}
	
	/* Get CallBack (Handle received data) */
	function HTTP_Get_CallBack() {
		if (ajobj.readyState == 4) {
			var results = ajobj.responseText;
			
			if (typeof(results)=='string' && results != null && results != '') {
				/* Function callback evaluator */
				if (eval("typeof(" + http_destobj + ") == 'function'")) { 
					/* Function detected, pass data to function */
					eval(http_destobj + "(results);");
				} else {
					/* Not a function, pass data to the html object */
					if (typeof document.getElementById(http_destobj).innerHTML != "undefined") {
						document.getElementById(http_destobj).innerHTML = results;
					}
				}
			}
			free = true;
		}
	}
	
	/* Helpers functions */
	function Is_Free() {
		return free;	
	}
	
	function Set_Loading(value) {
		show_loading = value;
	}
	
	/* AJAX OBJECT */
	function XMLHTTP_object() {
	  var xmlhttp;
	  /*@cc_on
	  @if (@_jscript_version >= 5)
		try {
		  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
		  try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		  } catch (E) {
			xmlhttp = false;
		  }
		}
	  @else
	  xmlhttp = false;
	  @end @*/
	  if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		try {
		  xmlhttp = new XMLHttpRequest();
		} catch (e) {
		  xmlhttp = false;
		}
	  }
	  return xmlhttp;
	}
}

function ajStop(destination) {
	arStops[destination] = true;
}

/* --------------------- HELPERS ----------------------- */

/* Set Selection */
function setSelectionRange(input, selectionStart, selectionEnd) {
  if (input.setSelectionRange) {
    input.focus();
    input.setSelectionRange(selectionStart, selectionEnd);
  }
  else if (input.createTextRange) {
    var range = input.createTextRange();
    range.collapse(true);
    range.moveEnd('character', selectionEnd);
    range.moveStart('character', selectionStart);
    range.select();
  }
}

/* Object position gizmo */
function findPosX(obj) {
	var curleft = 0;
	if (obj.offsetParent) {
		while (obj.offsetParent) {
			curleft += obj.offsetLeft;
			obj = obj.offsetParent;
		}
	}
	else if (obj.x) curleft += obj.x;
	return curleft;
}

function findPosY(obj) {
	var curtop = 0;
	if (obj.offsetParent) {
		curtop += obj.offsetHeight;
		while (obj.offsetParent) {
			curtop += obj.offsetTop;
			obj = obj.offsetParent;
		}
	}
	else if (obj.y) {
		curtop += obj.y;
		curtop += obj.height;
	}
	return curtop;
}
	
/* Array pop gizmo */
function array_pop(array, itemname) {
	var i = 0;
	while (i < array.length) {
		if (array[i] == itemname) array.splice(i, 1);
		i++;
  	}
	return array;
}

/* URLencode/decode helper */
function urlDecode(str){
    str=str.replace(new RegExp('\\+','g'), ' ');
   	return unescape(str);
}
	
function urlEncode(str){
	str = escape(str);
	str=str.replace(new RegExp('\\+','g'), 'PPP910918271');
	str=str.replace(new RegExp('%20','g'), '+');
	return str;
}

/* Base64 Helpers */
var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
function encode64(input) {
	if (input != null && input != '' && input != ' ') {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		do {
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);

			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;

			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}

			output = output + keyStr.charAt(enc1) + keyStr.charAt(enc2) + 
			keyStr.charAt(enc3) + keyStr.charAt(enc4);
		} while (i < input.length);
   		
		return output;
	}
}
function decode64(input) {
	var output = "";
	var chr1, chr2, chr3;
	var enc1, enc2, enc3, enc4;
	var i = 0;

	input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

	do {
		enc1 = keyStr.indexOf(input.charAt(i++));
		enc2 = keyStr.indexOf(input.charAt(i++));
		enc3 = keyStr.indexOf(input.charAt(i++));
		enc4 = keyStr.indexOf(input.charAt(i++));

		chr1 = (enc1 << 2) | (enc2 >> 4);
		chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
		chr3 = ((enc3 & 3) << 6) | enc4;

		output = output + String.fromCharCode(chr1);

		if (enc3 != 64) {
			output = output + String.fromCharCode(chr2);
		}
		if (enc4 != 64) {
			output = output + String.fromCharCode(chr3);
		}
	} while (i < input.length);
	
	return output;
}

/* trim helper */
function trim(str) {
	/* Removes white spaces on the beginning and on the end of a string */
	if (str != null && str != '') {
		while (str.charAt(0) == ' ')
			str = str.substring(1);
		while (str.charAt(str.length - 1) == ' ')
			str = str.substring(0, str.length - 1);
	}
	return str;
}