﻿/***********************************************************
 * Copyright 2016 方讯技术(北京)有限公司.  All Rights Reserved.
 * The Initial Developer of the Original Code is Adobe Systems Incorporated.
 * Portions created by Adobe Systems Incorporated are Copyright (C) 2010 Adobe Systems
 * Incorporated. All Rights Reserved.
 * Version2.0 Released on 2016-01-15  
 * Note:   
 *    1) escape the source_url parameter.
 **********************************************************/
/**
*streamType can be "live" or ""
*/

function play_flv(w, h, url, livemode, tl)
{
   var autoplay = true;            //is_autoplay();
   var usejw    = true;            //is_jwplayer();
   set_captions(livemode,tl);
   if(usejw && livemode!="live")
   {
   		jwplayer('fxplayer').setup({
        file:   url,
        image:  'jwplayer/jwplayer.jpg',
        title:  tl ,
        width:  w,
        height: h,
        autostart: autoplay,
        startparam: 'start'
     });
     playbyjw = true;
  }
  else
  {
  	jwplayer('fxplayer').setup({
        file:   url,
        image:  'jwplayer/jwplayer.jpg',
        title:  tl ,
        width:  w,
        height: h,
        autostart: autoplay
     });
     playbyjw = true;
  }
  
}
   
function close_player()
{
	if(playbyjw)
	{
	  jwplayer().stop();
	}
}
   
function getUrlParam(name) 
{ 
	var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); 
	var r = window.location.search.substr(1).match(reg); 
	if (r != null) 
	{
		return unescape(r[2]);
	}
	else
	{
		return null; 
	}
} 

function playVod(url,title)
{
	var h = 480;
	var w = 640;
	play_flv(w,h,url,"",title);
}
    
function playLive(url,title)
{
	var h = 480;
	var w = 640;
  play_flv(w,h,url,"live",title);
}

function playHTML5(url,title)
{
    var app   = "<?php echo $app;?>";
    var stream= "<?php echo $stream;?>";
    var fmt   = "<?php echo $format;?>";
    var h5    = "<?php echo $h5;?>";
    if(h5!="" || fmt=="hls"){
      var h5url = "../players/h5player/?application=" + app + "&stream=" + stream + "&url=" + escape(url) + "&title=" + escape(title);
	    location.href = h5url;
    }
    
	var text = "<video src=\"" + url + "\" controls=\"controls\" autoplay=\"autoplay\" width=\"640px\" height=\"360px\">";  //
    text = text + "<font color='#FFFFFF'>Your browser does not support the HTML5 video tag!</font>";
  text = text + "</video>";

  var doc = "<body bgcolor=\"#000000\">" + 
            "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" height=\"100%\" >" +
  	      "<tr>" +
  		  "<td align=\"center\">"  + 
  		  text +
  		  "</td></tr></table></body>";
  
	fxplayer.innerHTML = text;
}
    
function playHLS(url,title) {
  set_captions("vod",title);
  //location.href = url;
  playHTML5(url,title);
}
    
function playMP4(url,title)
{
  set_captions("vod",title);
  playHTML5(url,title);
}
    
    
function gen_rtmp_live_url(host,app,stream,token,port)
{
    var url   = "rtmp://"  + host + ":" + port + "/" + app + "/" + stream;
		var npos = host.indexOf(":");
		if(npos>0)
		{
			url = "rtmp://"  + host.substr(0,npos) + "/" + app + "/" + stream;
		}

    if(token!="")
    {
        url = url + "?token=" + token;
    }
    else{
    	url = url + "?token=";
    }
    return url;
}
    
function gen_flv_vod_url(host,app,stream,ver,token)
{
    var url  = "http://"  + host + "/sps/" + app + "/" + stream + ".flv?ver=" + ver;
    if(token!="")
    {
        url = url + "&token=" + token;
    }
    return url;
}
    
function gen_mp4_url(host,app,stream,ver,token)
{
    //var   url= "http://" + host + "/media/mp4/" + app + "/" + stream + "/" + stream;
    var   url= "http://" + host + "/mp4/" + app + "/" + stream + "/" + stream;
    if(ver>=0)
    {
       url = url + "_v" + ver;
    }
    url    = url  + ".mp4";
    if(token!="")
    {
        url = url + "?token=" + token;
    }else{
    	url = url + "?token=";
    }
    return url;
}
    
function gen_hls_url(host,app,stream,ver,token)
{
	var d = new Date();
	var url  = "http://"  + host + "/m3u8/" + app + "/" + stream + ".m3u8?from=mgr";
	if(ver!=null)
	{
	   url = url + "&ver=" + ver;
	}
	if(token!="")
    {
        url = url + "&token=" + token;
    }
	return url;
}

function InitDoc()
{
   var url    = getUrlParam("media_url");
   var app    = getUrlParam("ns");
   var stream = getUrlParam("id");
   var live   = getUrlParam("live");
   var host   = getUrlParam("host");
   var ver    = getUrlParam("ver");
   var format = getUrlParam("format");
   var tl     = "<?php echo $title;?>";//getUrlParam("title");
   var port   = getUrlParam("port");
   var token  = "<?php echo $token;?>";
   
   var autoplay = is_autoplay();
   var jwplayer = is_jwplayer();
   
   var  uid     = getUrlParam("uid");
   if(uid=="" || uid==null)
   {
	   uid     = fx_uuid(16,16);
   }
   
   if(url!="" && url!=null)
   {
   		return play_stream(url);
   }
   
   if(app==null || stream==null)
 	 {
			fxplayer.innerHTML= "<font color=\"#FFFFFF\">Load stream error!</font>";
			return;
   }

   if(tl==null || tl=="")
   {
       tl = app + " - " + stream;
   }

   if(port==null || port=="")
   {
       port = "1935";
   }
   
	if(host==null)
	{
		host  = document.location.host;
	}
	
	if(ver==null)
	{
	      ver="-1";
	}
	
	if(format==null)
	{
	     format="flv";
	}
   
   if(live=="1")
   {
     if(format=="flv"){
   	    url  = gen_rtmp_live_url(host,app,stream,token,port);
   	    url  = url + "&live=" + live + "&uid=" + uid + "&sid=" + uid;       
   	    playLive(url,tl);
   	 }
   	 else if(format=="hls"){
   	    url = gen_hls_url(host,app,stream,null,token);
   	 		url  = url +  "&live=" + live + "&uid=" + uid + "&sid=" + uid;  
   	    playHLS(url,tl);
   	 }
   }
   else
   {
      if(format=="flv")
      {
         url = gen_flv_vod_url(host,app,stream,ver,token);
         url  = url + "&uid=" + uid + "&sid=" + uid;  
         playVod(url,tl);
      }
      else if(format=="mp4")
      {
          url = gen_mp4_url(host,app,stream,ver,token);
          url  = url + "&uid=" + uid + "&sid=" + uid;  
          playMP4(url,tl);
      }
      else if(format=="hls")
      {
          url = gen_hls_url(host,app,stream,ver,token);
          url  = url + "&uid=" + uid + "&sid=" + uid;  
          playHLS(url,tl); 
      }
   }
   window.focus();
}

function play_stream(para)
{
  var url = para;
	if(url=="" || url==null)
	{
	    url = form2.media_url.value;
	    if(url=="" || url==null)
  	{
  		return;
  	}
	    location.href = "autoplayer.php?media_url=" + escape(url);
	    return;
	}
	
	form2.media_url.value = url;
	if(url.indexOf('.m3u8')>=0)
	{
		playHLS(url,"");	
	}
	else if(url.indexOf('.flv')>=0)
	{
		playVod(url,"");
	}
	else if(url.indexOf('.mp4')>=0)
	{
		playMP4(url,"");
	}
	else
	{
		playLive(url,"Living stream");
	}
}

function fx_uuid(len, radix) {

    var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');
    var uuid = [], i;
    radix = radix || chars.length;

    if (len) {
      for (i = 0; i < len; i++) uuid[i] = chars[0 | Math.random()*radix];
    } else {
      var r;
      uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
      uuid[14] = '4';
      for (i = 0; i < 36; i++) {
        if (!uuid[i]) {
          r = 0 | Math.random()*16;
          uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r];
        }
      }
    }

    return uuid.join('');

}