<!-- header --><!-- /header --><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
	<!-- leftpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td><h1>[Upload Pictures {7230}] </h1></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td bgcolor="#DCE6FF">
<ZONE cropBlock enabled>
<!--==================================================================================\\
//        module : Cropper                                                            \\
//       version : 1.3                                                                \\
//          date : 2005-08-12                                                         \\
//        author : Michael van Ouwerkerk - www.speedingrhino.com                      \\
//     copyright : Copyright (c) 2005 Michael van Ouwerkerk                           \\
//     licensing : GNU General Public License (version 2)                             \\
//   description : A graphical user interface for cropping images.                    \\
//====================================================================================\\
//    2005-08-12 : version 1.3 - Michael van Ouwerkerk                                \\
//               : Now officially distributed under the GNU General Public License.   \\
//===================================================================================-->

<script type="text/javascript">

Toolkit = {};

Toolkit.Events = {
	addListener : function( object, eventName, listener, thisObj ) {
		if( thisObj == null || thisObj == undefined ) thisObj = window;
		if( !object[ eventName + "listeners" ] ) this._prepareForListeners( object, eventName );
		var listeners = object[ eventName + "listeners" ];
		var setListener = true;
		for( var i = 0; setListener && i < listeners.length; i++ ) {
			if( listeners[ i ][ 0 ] == listener && listeners[ i ][ 1 ] == thisObj ) {
				setListener = false;
			}
		}
		if( setListener ) listeners[ listeners.length ] = [ listener, thisObj ];
		return false;
	},
	
	removeListener : function( object, eventName, listener, thisObj ) {
		if( thisObj == null || thisObj == undefined ) thisObj = window;
		var listeners = object[ eventName + "listeners" ];
		if( listeners ) {
			for( var i = 0; i < listeners.length; i++ ) {
				if( listeners[ i ][ 0 ] == listener && listeners[ i ][ 1 ] == thisObj ) {
					for( var j = i; j < listeners.length - 1; j++ ) {
						listeners[ j ] = listeners[ j + 1 ];
					}
					listeners.length--;
					break;
				}
			}
		}
		return false;
	},
	
	clearListeners : function( object, eventName ) {
		object[ eventName + "listeners" ] = [];
		return false;
	},
	
	_prepareForListeners : function( object, eventName ) {
		object[ eventName + "listeners" ] = [];
		if( typeof object[ eventName ] == "function" ) {
			object[ eventName + "listeners" ][ 0 ] = [ object[ eventName ], object ];
		}
		object[ eventName ] = function() {
			var i;
			
			// Copy the arguments array, because sometimes it's read-only.
			// If there are 0 arguments make sure the first argument becomes a reference 
			// to the patched window.event object. If there is 1 argument and it's an event 
			// object (as it should be), patch it as well.
			var argumentsCopy = [];
			for( i = 0; i < arguments.length; i++ ) argumentsCopy[ i ] = arguments[ i ];
			if( arguments.length == 0 && window.event ) {
				argumentsCopy[ 0 ] = Toolkit.Events._patchEvent( window.event, this );
			}
			else if( arguments[ 0 ] && typeof arguments[ 0 ] == "object" 
									&& arguments[ 0 ].toString().search( /event/i ) != -1 ) {
				argumentsCopy[ 0 ] = Toolkit.Events._patchEvent( arguments[ 0 ], this );
			}
			
			// Make a copy of the listeners array and execute that, so it cannot be 
			// modified during execution by addListener or removeListener calls.
			var listeners = this[ eventName + "listeners" ];
			var listenersCopy = [];
			for( i = 0; i < listeners.length; i++ ) listenersCopy[ i ] = listeners[ i ];
			for( i = 0; i < listenersCopy.length; i++ ) {
				listenersCopy[ i ][ 0 ].apply( listenersCopy[ i ][ 1 ], argumentsCopy );
			}
		};
	},
	
	_patchEvent : function( evt, currentTarget ) {
		if( !evt.target ) evt.target = evt.srcElement;
		if( !evt.currentTarget ) evt.currentTarget = currentTarget;
		if( typeof evt.layerX == "undefined" ) evt.layerX = evt.offsetX;
		if( typeof evt.layerY == "undefined" ) evt.layerY = evt.offsetY;
		if( typeof evt.clientX == "undefined" ) evt.clientX = evt.pageX;
		if( typeof evt.clientY == "undefined" ) evt.clientY = evt.pageY;
		if( !evt.stopPropagation ) {
			evt.stopPropagation = function() { this.cancelBubble = true; };
		}
		if( !evt.preventDefault ) {
			evt.preventDefault = function() { this.returnValue = false; };
		}
		return evt;
	}
}

// apply prototype - modified from http://youngpup.net/projects/dhtml/listener/listener.js
if( !Function.prototype.apply ) {
	Function.prototype.apply = function( thisObj, params ) {
		if( thisObj == null || thisObj == undefined ) thisObj = window;
		if( !params ) params = [];
		var args = [];
		for( var i = 0; i < params.length; i++ ) {
			args[ args.length ] = "params[" + i + "]";
		}
		thisObj.__method__ = this;
		var returnValue = eval( "thisObj.__method__(" + args.join( "," ) + ");" );
		thisObj.__method__ = null;
		return returnValue;
	};
}
// end

</script>

<script type="text/javascript">
var Cropper = {
	// Element properties.
	idCropImage : "cropImage",
	imgW : 0,
	imgH : 0,
	imgSrc : "",
	idContainer : "cropImageContainer",
	idShield : "divShield",
	idImageCropSelection : "imageCropSelection",
	
	// Others
	snapDistance : 5,
	selection : null,
	localCoord : null,
	oldGlobalCoord : {x : 0, y : 0},
	initialGlobalCoord : null,
	globalOffsetX : 0,
	globalOffsetY : 0,
	initialGlobalDragCoord : null,
	initialDragLeft : 0,
	initialDragTop : 0,
	pseudoEvent : {},
	key : 0,
	
	init : function(){
		// Initiating the HTML elements.
		var cropImage = document.getElementById(this.idCropImage);
		var container = document.getElementById("cropImageContainer");
		this.imgW = cropImage.offsetWidth;
		this.imgH = cropImage.offsetHeight;
		this.imgSrc = cropImage.src;
		this.createSelection();
		var imageCropSelection = document.getElementById(this.idImageCropSelection);

		// Setting event listeners.
		Toolkit.Events.addListener(container, "onmousedown", Cropper.startSelection, Cropper);
		Toolkit.Events.addListener(container, "onmouseup", Cropper.onmouseup, Cropper);
		Toolkit.Events.addListener(document, "onmouseup", Cropper.onmouseup, Cropper);
		Toolkit.Events.addListener(document, "onmousemove", Cropper.onmousemove, Cropper);
		Toolkit.Events.addListener(imageCropSelection, "onmousedown", Cropper.startDragSelection, Cropper);
		Toolkit.Events.addListener(container, "onclick", Cropper.onclick, Cropper);

		document.getElementById("cropForm").imageW.value = this.imgW;
		document.getElementById("cropForm").imageH.value = this.imgH;
		
		// Resetting all values because especially the form might still contain old information.
		this.reset();
		cropImage = null;
		container = null;
		imageCropSelection = null;
	},
	
	startSelection : function(e){
		e.preventDefault();
		e.stopPropagation();
		if(this.selection.getVisibility() != "visible"){
			this.localCoord = {x : e.layerX + 1, y : e.layerY + 1};
			this.initialGlobalCoord = {x : e.clientX, y : e.clientY};
			this.oldGlobalCoord.x = e.clientX;
			this.oldGlobalCoord.y = e.clientY;
			this.selection.draw(e.layerX, e.layerY, 1, 1);
			this.selection.track = true;
		}
		return false;
	},

	onmouseup : function(e){
		e.preventDefault();
		e.stopPropagation();
		var shieldElm = document.getElementById(this.idShield);
		if(this.selection.track){
			if(this.initialGlobalCoord.x == e.clientX && this.initialGlobalCoord.y == e.clientY) this.reset();
			else{
				this.adjustInitialSelection(e);
				shieldElm.style.visibility = "visible";
				this.selection.setCursor("default");
				this.oldGlobalCoord.x = e.clientX;
				this.oldGlobalCoord.y = e.clientY;
			}
		}
		else if(e.target.id == this.idShield || e.target.id == this.idCropImage) this.reset();
		this.selection.track = false;
		this.selection.drag = false;
		shieldElm = null;
		return false;
	},
	
	onmousemove : function(e){
		if(this.selection.track || this.selection.drag){
			e.preventDefault();
			this.pseudoEvent.clientX = e.clientX;
			this.pseudoEvent.clientY = e.clientY;
			if(this.selection.track) this.adjustInitialSelection(this.pseudoEvent);
			else if(this.selection.drag) this.adjustSelectionDrag(this.pseudoEvent);
		}
		this.oldGlobalCoord.x = e.clientX;
		this.oldGlobalCoord.y = e.clientY;
		return false;
	},
	
	startDragSelection : function(e){
		e.preventDefault();
		this.initialGlobalDragCoord = {x : e.clientX, y : e.clientY};
		this.initialDragLeft = this.selection.getLeft();
		this.initialDragTop = this.selection.getTop();
		this.selection.drag = true;
		return false;
	},
	
	onclick : function(e){
		e.preventDefault();
		e.stopPropagation();
		return false;
	},
	
	adjustSelectionDrag : function(e){
		// Getting position and size.
		var left = this.initialDragLeft + e.clientX - this.initialGlobalDragCoord.x;
		var top = this.initialDragTop + e.clientY - this.initialGlobalDragCoord.y;
		var width = this.selection.getWidth();
		var height = this.selection.getHeight();
		
		// Adjusting position to account for edge snapping.
		var leftEdge = left;
		if(leftEdge < 0 || leftEdge <= this.snapDistance && !this.ctrlKey) left = 0;
		var topEdge = top;
		if(topEdge < 0 || topEdge <= this.snapDistance && !this.ctrlKey) top = 0;
		var rightEdge = this.imgW - width - left;
		if(rightEdge < 0 || rightEdge <= this.snapDistance && !this.ctrlKey) left += rightEdge;
		var bottomEdge = this.imgH - height - top;
		if(bottomEdge < 0 || bottomEdge <= this.snapDistance && !this.ctrlKey) top += bottomEdge;
		
		// Drawing the selection.
		this.selection.moveTo(left, top);
		this.setForm(left, top);
	},
	
	adjustInitialSelection : function(e){

		var invertedHor = (e.clientX - (this.initialGlobalCoord.x + this.globalOffsetX) < 0) ? true : false;
		var invertedVer = (e.clientY - (this.initialGlobalCoord.y + this.globalOffsetY) < 0) ? true : false;
		var width = Math.abs(e.clientX - (this.initialGlobalCoord.x + this.globalOffsetX));
		var height = Math.abs(e.clientY - (this.initialGlobalCoord.y + this.globalOffsetY));
		var left = this.localCoord.x + this.globalOffsetX;
		var top = this.localCoord.y + this.globalOffsetY;
		if(invertedHor) left -= width;
		if(invertedVer) top -= height;
		
		// Limiting and snapping to image edges.
		var leftEdge = left;
		if(leftEdge < 0 || leftEdge <= this.snapDistance && !this.ctrlKey){
			width += leftEdge;
			left = 0;
		}
		
		var topEdge = top;
		if(topEdge < 0 || topEdge <= this.snapDistance && !this.ctrlKey){
			height += topEdge;
			top = 0;
		}
		
		var rightEdge = this.imgW - width - left;
		if(rightEdge < 0 || rightEdge <= this.snapDistance && !this.ctrlKey) width += rightEdge;
		var bottomEdge = this.imgH - height - top;
		if(bottomEdge < 0 || bottomEdge <= this.snapDistance && !this.ctrlKey) height += bottomEdge;
		
		// ENFORCE DIGITAL PICTURES PROPORTIONS (0.75 / 3.33333~)
		if(width > Math.round(width * 0.75)){
			if(invertedHor) left += width - height;
			width = Math.round(height / 0.75);
		}
		if(height > Math.round(height / 0.75)){
			if(invertedVer) top += height - width;
			height = Math.round(width * 0.75);
		}
		
		// Drawing the selection.
		this.selection.draw(left, top, width, height);
		this.setForm(left, top, width, height);
	},

	setForm : function(selectionX, selectionY, selectionW, selectionH){
		document.getElementById("cropForm").cropX.value = selectionX;
		document.getElementById("cropForm").cropY.value = selectionY;
		if(arguments.length > 2){
			document.getElementById("cropForm").cropW.value = selectionW;
			document.getElementById("cropForm").cropH.value = selectionH;
		}
	},
	
	createSelection : function(){
		var container = document.getElementById("cropImageContainer");
		
		this.selection = {
			left : undefined,
			top : undefined,
			width : undefined,
			height : undefined,
			idLeft : "divSelectionLeft",
			idTop : "divSelectionTop",
			idRight : "divSelectionRight",
			idBottom : "divSelectionBottom",
			visible : false
		};
		
		var top = document.createElement("div");
		top.id = this.selection.idTop;
		top.className = "divSelectionHor";
		container.appendChild(top);

		var right = document.createElement("div");
		right.id = this.selection.idRight;
		right.className = "divSelectionVer";
		container.appendChild(right);

		var bottom = document.createElement("div");
		bottom.id = this.selection.idBottom;
		bottom.className = "divSelectionHor";
		container.appendChild(bottom);

		var left = document.createElement("div");
		left.id = this.selection.idLeft;
		left.className = "divSelectionVer";
		container.appendChild(left);
		
		var image = document.createElement("img");
		image.id = this.idImageCropSelection;
		image.src = this.imgSrc;
		container.appendChild(image);
		
		var shield = document.createElement("div");
		shield.id = this.idShield;
		shield.style.width = this.imgW + "px";
		shield.style.height = this.imgH + "px";
		container.appendChild(shield);
		
		this.selection.setVisibility = function(vis) {
			document.getElementById(this.idLeft).style.visibility = vis;
			document.getElementById(this.idTop).style.visibility = vis;
			document.getElementById(this.idRight).style.visibility = vis;
			document.getElementById(this.idBottom).style.visibility = vis;
			document.getElementById(Cropper.idImageCropSelection).style.visibility = vis;
			this.visibility = vis;
		};
		
		this.selection.setCursor = function(cursor){
			document.getElementById(this.idLeft).style.cursor = cursor;
			document.getElementById(this.idTop).style.cursor = cursor;
			document.getElementById(this.idRight).style.cursor = cursor;
			document.getElementById(this.idBottom).style.cursor = cursor;
			document.getElementById(Cropper.idImageCropSelection).style.cursor = cursor;
		};
		
		this.selection.setLeft = function(left){ this.left = left; };
		this.selection.setTop = function(top){ this.top = top; };
		this.selection.setWidth = function(width){ this.width = width; };
		this.selection.setHeight = function(height){ this.height = height; };

		this.selection.getVisibility = function(){ return this.visibility; };
		this.selection.getLeft = function(){ return this.left; };
		this.selection.getTop = function(){ return this.top; };
		this.selection.getWidth = function(){ return this.width; };
		this.selection.getHeight = function(){ return this.height; };
		
		this.selection.draw = function(left, top, width, height){
			this.left = left;
			this.top = top;
			this.width = width;
			this.height = height;

			var elmImageCropSelection = document.getElementById(Cropper.idImageCropSelection);
			var elmLeft = document.getElementById(this.idLeft);
			var elmTop = document.getElementById(this.idTop);
			var elmRight = document.getElementById(this.idRight);
			var elmBottom = document.getElementById(this.idBottom);
			
			elmLeft.style.left = left + "px";
			elmTop.style.left = left + "px";
			elmRight.style.left = left + width - 1 + "px";
			elmBottom.style.left = left + "px";
			
			elmLeft.style.top = top + "px";
			elmTop.style.top = top + "px";
			elmRight.style.top = top + "px";
			elmBottom.style.top = top + height - 1 + "px";
			
			elmLeft.style.height = height + "px";
			elmTop.style.width = width + "px";
			elmRight.style.height = height + "px";
			elmBottom.style.width = width + "px";
			
			var clip = "rect(" + top + "px, " + (left + width) + "px, " + (top + height) + "px, " + left + "px)";
			elmImageCropSelection.style.clip = clip;
			
			this.setVisibility("visible");
			elmImageCropSelection = null;
			elmLeft = null;
			elmTop = null;
			elmRight = null;
			elmBottom = null;
		};
		
		this.selection.moveTo = function(left, top){
			var width = this.getWidth();
			var height = this.getHeight();
			var elmImageCropSelection = document.getElementById(Cropper.idImageCropSelection);
			var elmLeft = document.getElementById(this.idLeft);
			var elmTop = document.getElementById(this.idTop);
			var elmRight = document.getElementById(this.idRight);
			var elmBottom = document.getElementById(this.idBottom);
			
			this.left = left;
			this.top = top;
			
			elmLeft.style.left = left + "px";
			elmTop.style.left = left + "px";
			elmRight.style.left = left + width - 1 + "px";
			elmBottom.style.left = left + "px";
			
			elmLeft.style.top = top + "px";
			elmTop.style.top = top + "px";
			elmRight.style.top = top + "px";
			elmBottom.style.top = top + height - 1 + "px";

			var clip = "rect(" + top + "px, " + (left + width) + "px, " + (top + height) + "px, " + left + "px)";
			elmImageCropSelection.style.clip = clip;
			
			elmImageCropSelection = null;
			elmLeft = null;
			elmTop = null;
			elmRight = null;
			elmBottom = null;
		};

		this.selection.reset = function(){
			this.left = undefined;
			this.top = undefined;
			this.width = undefined;
			this.height = undefined;
			this.setVisibility("hidden");
			this.setCursor("crosshair");
			this.track = false;
			this.drag = false;
		};
		container = null;
	},
		
	reset : function(){
		this.localCoord = null;
		this.initialGlobalCoord = null;
		this.setForm("", "", "", "");
		this.selection.reset();
		document.getElementById(this.idShield).style.visibility = "hidden";
		this.altKey = false;
		this.ctrlKey = false;
		this.shiftKey = false;
	}
};

// IE win memory cleanup.
if (window.attachEvent) {
    var cearElementProps = [
        'onmousedown',
        'onmouseup',
		'onmousemove',
        'onclick',
		'onkeydown',
		'onkeyup',
		
        'onmousedownlisteners',
        'onmouseuplisteners',
		'onmousemovelisteners',
        'onclicklisteners',
		'onkeydownlisteners',
		'onkeyuplisteners'
	];

    window.attachEvent("onunload",
		function(){
			var el;
			for(var d = document.all.length;d--;){
				el = document.all[d];
				for(var c = cearElementProps.length;c--;){
					el[cearElementProps[c]] = null;
				}
			}
			window.onload = null;
			window.onloadlisteners = null;
			document.onmousemove = null;
			document.onmousemovelisteners = null;
			Cropper = null;
		}
	);
}

Toolkit.Events.addListener(window, "onload", Cropper.init, Cropper);
// end
</script>

<style type="text/css">
<!--
#divCropImageBorder {
	border:			1px solid #000;
}
#cropImageContainer {
	position:		relative;
	left:			0;
	top:			0;
	z-index:		1;
	cursor:			crosshair;
	background:		#000;
}
#cropImage {
	display:		block;
	position:		relative;
	left:			0;
	top:			0;
	z-index:		3;
	cursor:			crosshair;
}
.divSelectionHor {
	position:		absolute;
	left:			0;
	top:			0;
	width:			1px;
	height:			1px;
	font:			1px/1px verdana, sans-serif;
	background-color:#6699CC;
	z-index:		10;
	cursor:			crosshair;
	visibility:		hidden;
}
.divSelectionVer {
	position:		absolute;
	left:			0;
	top:			0;
	width:			1px;
	height:			1px;
	font:			1px/1px verdana, sans-serif;
	background-color:#6699CC;
	z-index:		10;
	cursor:			crosshair;
	visibility:		hidden;
}
#imageCropSelection {
	position:		absolute;
	left:			0px;
	top:			0px;
	display:		block;
	overflow:		hidden;
	z-index:		9;
	visibility:		hidden;
}

#divShield {
	position:		absolute;
	left:			0;
	top:			0;
	background:		#6699CC;
	z-index:		4;
	cursor:			default;
	visibility:		hidden;
	filter:			alpha(opacity=50);
	opacity:		0.5;
	-moz-opacity:	0.5;
}
-->
</style>

<h2><br />
  [Crop your Picture {7235}] </h2>
<p>[Your photograph needs to be   cropped to meet our photograph aspect ratio requirements. Please left click the   image, hold and drag, then release to form the selection. You may then click on   the box and move it around to adjust the image the way you want it. If you are   unsatisifed with your selection you may click &quot;start over&quot; and try it again.   Once you are satisfied, click the &quot;submit&quot; button. {7240}] </p>

<br /><br />
<!-- breadcrumbs -->
<!-- /breadcrumbs -->
<form id="cropForm" action="" method="post">
<table cellpadding="0" cellspacing="5" border="0">
<tr>
	<td>
	  <div id="divCropImageBorder">
	    <div id="cropImageContainer">
		  <!-- <img id="cropImage" src="system/cache/temp/724_image 009.jpg" alt=""> -->
		  <img id="cropImage" src="system/cache/temp/{image.fileName}" alt="">		</div>
	  </div>	</td>
	</tr>
<tr>
  <td><input type="hidden" name="Xwidth" id="imageW" />
    <input type="hidden" name="Xheight" id="imageH" />
    <input type="hidden" name="x" id="cropX" />
    <input type="hidden" name="y" id="cropY" />
    <input type="hidden" name="width" id="cropW" />
    <input type="hidden" name="height" id="cropH" />
    <button type="button" onclick="Cropper.reset();" class="submit">[Start Over {7245}] </button>
    <input type="submit" name="Submit" value="[Save {640}]" class="submit" /></td>
  </tr>
</table>
</form>
</ZONE cropBlock enabled>
<ZONE cropBlock success>
<h1>[Success! {315}] </h1>
<p>[Your picture has successfully been cropped. Please wait {7250}] </p>
</ZONE cropBlock success></td>
      </tr>
      <tr>
        <td height="10" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
      </tr>
      <tr>
        <td height="2" colspan="2" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="2" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
    </table><!-- /leftpane -->
	</td>
    <td width="290" valign="top"><!-- rightpane -->
<!-- /rightpane -->&nbsp;</td>
  </tr>
</table>
<!-- footer --><!-- /footer -->