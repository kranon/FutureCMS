var def_color1 = "menupoz";
var act_color1 = "menupoz2";
var def_color = "menupoz_1";
var act_color = "menupoz_2";
var wysokosc_menu_level_1 = 36;
var przesuniecie_level_1 = 0;

var wysokosc_submenulink = 1;
var przesuniecie_submenulink = -1;

var last;
var obji = new Array(5);
var objj = new Array(5);

var mTimer = null;

function showOpis( s ){
    var oid = 'w'+s.options[s.selectedIndex].value;
    hideall();
    if( document.getElementById(oid) )
      linkuj(oid);

}

function setTimer(){
     clearTimeout(mTimer);
     mTimer = setTimeout("hide()" , 60000 );
}

function setFastTimer(){
     clearTimeout(mTimer);
     mTimer = setTimeout("hide()" , 500 );
}

function seth(objs, c, id, h){
   setTimer();
   unset(c);
   hide(c);
   obji[c] = objs;
   objj[c] = id;

   objs.className = act_color;

   show(id, h, 'sublink');
   setTimer();
}

function unset(c){
   setFastTimer();
   if( obji[c] != null )
      obji[c].className = def_color;
}

function setp(c, id, h, mode){
  hide();
  setTimer();
  for (var i = 0;i<obji.length;i++)
  {
    if( obji[i] != null )
      obji[i].className = def_color;
  }

  show(id, h, mode);

  if( objj[c] != null ){
     document.getElementById(objj[c]).className = def_color1;
     document.getElementById('h'+objj[c]).className = def_color1;
  }

  document.getElementById(id).className = act_color1;
  document.getElementById('h'+id).className = act_color1;
  objj[c] = id;
}

function unsetp(id, c){
  setFastTimer();
}

function show(id, h, mode){
   divmenu = 'm'+id;
   obj = document.getElementById(divmenu);
   if( obj ){
     pos = getAnchorPosition(id);
     if( mode=='sublink' ){
     	if( document.getElementById('ma'+h) ){
     		 if( document.getElementById('ma'+h).clientWidth > 0 )
				ww = document.getElementById('ma'+h).clientWidth;
		     else if( document.getElementById('ma'+h).offsetWidth )
				ww = document.getElementById('ma'+h).clientWidth;
	     	 document.getElementById(divmenu).style.left = parseFloat(parseFloat(document.getElementById('ma'+h).style.left) + parseFloat(ww)+przesuniecie_submenulink)+'px';
	     	 document.getElementById(divmenu).style.top = parseFloat(parseFloat(pos.y)-parseFloat(wysokosc_submenulink))+'px';
     	}
     }else if( mode=='center' ){
     	document.getElementById(divmenu).style.display='block';
     	document.getElementById(divmenu).style.left= parseFloat(pos.x+przesuniecie_level_1-(document.getElementById(divmenu).clientWidth/2)+(document.getElementById(id).clientWidth/2)+1)+'px';
     } else if( mode=='right' ){
     	document.getElementById(divmenu).style.display='block';
     	document.getElementById(divmenu).style.left= parseFloat(pos.x+przesuniecie_level_1-document.getElementById(divmenu).clientWidth+document.getElementById(id).clientWidth+1)+'px';
     } else {
     	document.getElementById(divmenu).style.left= parseFloat(pos.x+przesuniecie_level_1)+'px';
     	document.getElementById(divmenu).style.top= parseFloat(pos.y+wysokosc_menu_level_1)+'px';
   	 }
     document.getElementById(divmenu).style.display='block';
     setTimer();
   }
}

function hide(c) {
  if( c > 0 ){
  	 if(objj[c] && document.getElementById('m'+objj[c]) )
  	 	document.getElementById('m'+objj[c]).style.display = 'none';

  } else {
     var Nodes = document.getElementsByTagName('div')
     var max = Nodes.length
     for(var i=0;i<max;i++) {
                 var nodeObj = Nodes.item(i);
                 if(nodeObj.id.indexOf('ma')!=-1 ) {
                    nodeObj.style.display = 'none';
                 }
     }
  }
}

function czysc(o){
  for (var i=0; i<o.length;i++) {
      if( o[i].type!= 'hidden' && o[i].type!= 'submit' && o[i].type!= 'button'){
        o[i].value = "";
      }
  }
}

function go(url){
  document.location.href = url;
}

function go_form(f, url){
   f.action = url;
   f.submit();
}

function selecturl(s) {
	var gourl = s.options[s.selectedIndex].value;	document.location.href = gourl;
}

function otworz( host, url, tytul, szer, wys, extra_foto ){
    if (parseInt(szer) > 800 || parseInt(wys) > 800){
        NoweOkienko=window.open(url, tytul);
    } else{
		if( extra_foto )
			wys = parseInt(wys)+50;
		if( parseInt(szer) < 150 )
			szer = 350;

        config='left=100,top=100,width='+szer+',height='+wys+',innerheight='+wys+',innerwidth='+szer+',toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no';
        NoweOkienko=window.open('', tytul, config);
        NoweOkienko.document.open();
        NoweOkienko.document.write('<HTML>');
        NoweOkienko.document.write('<HEAD>');
        NoweOkienko.document.write('<TITLE>'+tytul+'</TITLE>');
        NoweOkienko.document.write('</HEAD>');
        NoweOkienko.document.write('<body style="padding: 0px; margin: 0px;" bgcolor="#ffffff">');
        if( extra_foto )
			NoweOkienko.document.write('<table height="50" cellpadding="0" cellspacing="0" width="100%"><tr><td><img src="'+host+'/logo.gif"></td><td align="right"><img src="'+host+'/'+extra_foto+'"></td></tr></table>');
        NoweOkienko.document.write('<div align="center"><A HREF=# onclick="javascript:self.close();"><IMG SRC="'+host+'/'+url+'" BORDER=0 ALT="Zamknij"></A></div>');
        NoweOkienko.document.write('</BODY>');
        NoweOkienko.document.write('</HTML>');
        NoweOkienko.document.close();
        NoweOkienko.focus();
    }
}
function otworz_url(url){
    config='left=100,top=100,width=250,height=370,innerheight=350,innerwidth=250,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes';
    NoweOkienko=window.open(url, '', config);
}

function getAnchorPosition(anchorname) {
	// This function will return an Object with x and y properties
	var useWindow=false;
	var coordinates=new Object();
	var x=0,y=0;
	// Browser capability sniffing
	var use_gebi=false, use_css=false, use_layers=false;
	if (document.getElementById) { use_gebi=true; }
	else if (document.all) { use_css=true; }
	else if (document.layers) { use_layers=true; }
	// Logic to find position
 	if (use_gebi && document.all) {
		x=AnchorPosition_getPageOffsetLeft(document.all[anchorname]);
		y=AnchorPosition_getPageOffsetTop(document.all[anchorname]);
		}
	else if (use_gebi) {
		var o=document.getElementById(anchorname);
		x=AnchorPosition_getPageOffsetLeft(o);
		y=AnchorPosition_getPageOffsetTop(o);
		}
 	else if (use_css) {
		x=AnchorPosition_getPageOffsetLeft(document.all[anchorname]);
		y=AnchorPosition_getPageOffsetTop(document.all[anchorname]);
		}
	else if (use_layers) {
		var found=0;
		for (var i=0; i<document.anchors.length; i++) {
			if (document.anchors[i].name==anchorname) { found=1; break; }
			}
		if (found==0) {
			coordinates.x=0; coordinates.y=0; return coordinates;
			}
		x=document.anchors[i].x;
		y=document.anchors[i].y;
		}
	else {
		coordinates.x=0; coordinates.y=0; return coordinates;
		}
	coordinates.x=x;
	coordinates.y=y;
	return coordinates;
	}

// getAnchorWindowPosition(anchorname)
//   This function returns an object having .x and .y properties which are the coordinates
//   of the named anchor, relative to the window
function getAnchorWindowPosition(anchorname) {
	var coordinates=getAnchorPosition(anchorname);
	var x=0;
	var y=0;
	if (document.getElementById) {
		if (isNaN(window.screenX)) {
			x=coordinates.x-document.body.scrollLeft+window.screenLeft;
			y=coordinates.y-document.body.scrollTop+window.screenTop;
			}
		else {
			x=coordinates.x+window.screenX+(window.outerWidth-window.innerWidth)-window.pageXOffset;
			y=coordinates.y+window.screenY+(window.outerHeight-24-window.innerHeight)-window.pageYOffset;
			}
		}
	else if (document.all) {
		x=coordinates.x-document.body.scrollLeft+window.screenLeft;
		y=coordinates.y-document.body.scrollTop+window.screenTop;
		}
	else if (document.layers) {
		x=coordinates.x+window.screenX+(window.outerWidth-window.innerWidth)-window.pageXOffset;
		y=coordinates.y+window.screenY+(window.outerHeight-24-window.innerHeight)-window.pageYOffset;
		}
	coordinates.x=x;
	coordinates.y=y;
	return coordinates;
	}

// Functions for IE to get position of an object
function AnchorPosition_getPageOffsetLeft (el) {
	var ol=el.offsetLeft;
	while ((el=el.offsetParent) != null) { ol += el.offsetLeft; }
	return ol;
	}
function AnchorPosition_getWindowOffsetLeft (el) {
	return AnchorPosition_getPageOffsetLeft(el)-document.body.scrollLeft;
	}
function AnchorPosition_getPageOffsetTop (el) {
	var ot=el.offsetTop;
	while((el=el.offsetParent) != null) { ot += el.offsetTop; }
	return ot;
	}
function AnchorPosition_getWindowOffsetTop (el) {
	return AnchorPosition_getPageOffsetTop(el)-document.body.scrollTop;
	}

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function sortp(s, k){
    var gourl = s.options[s.selectedIndex].value;
	if( k )
    	document.location.href= k+"&sort="+gourl;
	else
    	document.location.href= "?sort="+gourl;
}

function getcheck(a, b){
   if( a.checked )
     hideall("block", b);
   else
     hideall("none", b);
}

function hideall(all, b) {
                        var Nodes = document.getElementsByTagName('table')
                        var max = Nodes.length
                        for(var i=0;i<max;i++) {
                                var nodeObj = Nodes.item(i);
                                if(nodeObj.id.indexOf(b)!=-1) {
                                   nodeObj.style.display = all;
                                }
                        }
}
function hideallt(all, ids, tag) {
                        var Nodes = document.getElementsByTagName(tag)
                        var max = Nodes.length
                        for(var i=0;i<max;i++) {
                                var nodeObj = Nodes.item(i);
                                if(nodeObj.id.indexOf(ids)!=-1) {
                                   nodeObj.style.display = all;
                                }
                        }
}

function zaplataSelect(){
	document.zamow.action = location.href+"&nc=1";
	document.zamow.submit();
}

function mailer(pre, dom, c, mpre, mdom){
	document.write("<a href='mailto:"+pre+"@"+dom+"' "+c+">"+mpre+(mdom ? "@"+mdom : "")+"</a>");
}

function DmsImageBox(){
	this.init = function (){
		if (!document.getElementsByTagName){ return; }
		var anchors = document.getElementsByTagName('a');
		for (var i=0; i<anchors.length; i++){
			var anchor = anchors[i];
			var relAttribute = String(anchor.getAttribute('rel'));
			if (anchor.getAttribute('href') && (relAttribute.match('DmsImageBox'))){
				anchor.onclick = function () {return DmsImageBox.start(this);}
			}
		}

		var objOverlay = document.createElement("div");
		objOverlay.setAttribute('id','overlay');
		objOverlay.style.display = 'none';
		objOverlay.setAttribute('align','center');
		objOverlay.style.left = '0px';
		objOverlay.style.top = '0px';
		objOverlay.style.filer = 'alpha(opacity=60)';
		objOverlay.style.opacity = '0.6';
		objOverlay.style.width = '100%';
		objOverlay.style.height = '500px';
		objOverlay.style.zIndex = '90';
		objOverlay.style.position = 'absolute';
		objOverlay.style.background = '#000000';

		objOverlay.onclick = function() { DmsImageBox.end(); return false; }
		var objInside = document.createElement("div");
		document.body.appendChild(objOverlay);

		objInside.setAttribute('id','inside');
		objInside.style.display = 'none';
		objInside.setAttribute('align','center');
		objInside.style.background = '#ffffff';
		objInside.style.top = '10px';
		objInside.style.marginBottom = '10px';
		objInside.style.position = 'absolute';
		objInside.style.padding = '10px';
		objInside.style.zIndex = '91';
		document.body.appendChild(objInside);

	}
	this.loadingInfo = function(){
		var arrayPageSize = getPageSize();
		hideSelectBoxes();
		document.getElementById('overlay').style.height = arrayPageSize[1]+'px';
		document.getElementById('inside').style.width = '150px';
		document.getElementById('inside').style.height = '150px';

		arrayPageScroll = getPageScroll();
		s = arrayPageScroll[1]+10;
		document.getElementById('inside').style.top = s+'px';

		document.getElementById('inside').innerHTML = '<table cellpadding=0 cellspacing=0 width=100% height=100%><tr><td valign=middle align=center><img src="/grafika/loading.gif" border=0></td></tr></table>';
		opacity('overlay', 0, 60, 500);
		x = Math.round(arrayPageSize[2]/2) - 75;
		document.getElementById('inside').style.left = x+'px';
		opacity('inside', 0, 100, 200);
	}
	this.start = function (obj){
		bigImg = obj.getAttribute('href');
		imgPreloader = new Image();
		this.loadingInfo();
		imgPreloader.onload= function() {
			opacity('inside', 100, 0, 100);
			DmsImageBox.showImage(bigImg, this.width, this.height);
		}
		imgPreloader.src = bigImg;
		return false;
	}
	this.showImage = function (src, width, height){
		var arrayPageSize = getPageSize();
		x = Math.round(arrayPageSize[2]/2) - Math.round(width/2);
		document.getElementById('inside').style.left = x+'px';
		document.getElementById('inside').style.width = width+'px';
		document.getElementById('inside').style.height = height+'px';
		arrayPageScroll = getPageScroll();
		s = arrayPageScroll[1]+10;
		document.getElementById('inside').style.top = s+'px';
		document.getElementById('inside').innerHTML = '<table cellpadding=0 cellspacing=0 width=100% height=100%><tr><td valign=middle align=center><img onClick="DmsImageBox.end();" style="cursor: pointer;" border=0 src="'+src+'" border=0></td></tr></table>';
		opacity('inside', 0, 100, 500);
		var arrayPageSize = getPageSize();
		document.getElementById('overlay').style.height = arrayPageSize[1]+'px';
	}
	this.end = function (){
		opacity('inside', 100, 0, 100);
		opacity('overlay', 60, 0, 100);
		showSelectBoxes();
	}
}

function getPageSize(){

	var xScroll, yScroll;

	if (window.innerHeight && window.scrollMaxY) {
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}

	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}

	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else {
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){
		pageWidth = windowWidth;
	} else {
		pageWidth = xScroll;
	}


	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight)
	return arrayPageSize;
}
function getPageScroll(){

	var yScroll;

	if (self.pageYOffset) {
		yScroll = self.pageYOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
		yScroll = document.documentElement.scrollTop;
	} else if (document.body) {// all other Explorers
		yScroll = document.body.scrollTop;
	}

	arrayPageScroll = new Array('',yScroll)
	return arrayPageScroll;
}
function opacity(id, opacStart, opacEnd, millisec) {
    //speed for each frame
    var speed = Math.round(millisec / 100);
    var timer = 0;

    //determine the direction for the blending, if start and end are the same nothing happens
    if(opacStart > opacEnd) {
        for(i = opacStart; i >= opacEnd; i--) {
            setTimeout("changeOpac(" + i + ",'" + id + "')",(timer * speed));
            timer++;
        }
    } else if(opacStart < opacEnd) {
        for(i = opacStart; i <= opacEnd; i++)
            {
            setTimeout("changeOpac(" + i + ",'" + id + "')",(timer * speed));
            timer++;
        }
    }
}

//change the opacity for different browsers
function changeOpac(opacity, id) {
    var object = document.getElementById(id).style;
    object.opacity = (opacity / 100);
    object.MozOpacity = (opacity / 100);
    object.KhtmlOpacity = (opacity / 100);
    object.filter = "alpha(opacity=" + opacity + ")";
	object.display = 'block';
	if( opacity == 0 )
		document.getElementById(id).style.display = 'none';
}
function showSelectBoxes(){
	selects = document.getElementsByTagName("select");
	for (i = 0; i != selects.length; i++) {
		selects[i].style.visibility = "visible";
	}
}
function hideSelectBoxes(){
	selects = document.getElementsByTagName("select");
	for (i = 0; i != selects.length; i++) {
		selects[i].style.visibility = "hidden";
	}
}

var DmsImageBox = new DmsImageBox();
function initDmsImageBox(){
	DmsImageBox.init();
}
window.onload= initDmsImageBox;


var ji = 1;
function insertSwf(plik, width, height){
 rnd = width+height+ji;
 ji++;
 document.write('<div id="f'+rnd+'" style="width:'+width+';height:'+height+'px"></div>');

 document.getElementById('f'+rnd).innerHTML = (
     '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" WIDTH="' + width + '" HEIGHT="' + height + '"><PARAM NAME=movie VALUE="' + plik + '"><PARAM NAME=quality VALUE=high><PARAM NAME=wmode VALUE=transparent><PARAM NAME=bgcolor VALUE=#FFFFFF><EMBED src="' + plik + '" quality=high wmode="transparent" bgcolor=#FFFFFF WIDTH="' + width + '" HEIGHT="'
         + height
         + '" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></EMBED></OBJECT>');

}

//-->

$(document).ready(function(){
	$('.feedback').fancybox();
	$('#feedback_form').submit(function(){
		var name = $(this).find('#name').val();
		var email = $(this).find('#email').val();
		var message = $(this).find('#message').val();

		if (name && email && message){
			var data = $(this).serialize();
			$.ajax({
				type: "POST",
				url: "/core/feedback.php",
				data: data,
				success: function(msg){
					alert(msg);

				}
			});

		}
		else{
			alert('Все поля обязательны');
		}


		return false;
	});
});





