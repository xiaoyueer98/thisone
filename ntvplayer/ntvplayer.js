/***********************************************************
 * Copyright 2013 北京云视睿博传媒科技有限公司.  All Rights Reserved.
 * The Initial Developer of the Original Code is Adobe Systems Incorporated.
 * Portions created by Adobe Systems Incorporated are Copyright (C) 2010 Adobe Systems
 * Incorporated. All Rights Reserved.
 * Version2.0 Released on 2013-12-11  
 * Note:   
 *    1) escape the source_url parameter.
 **********************************************************/
/**
*streamType can be "live" or ""
*/
function play(width,height,source_url,stream_type,autoplay)
{
	loadntvplayer(width,height,source_url,stream_type,autoplay);
}

function loadntvplayer(width,height,source_url,stream_type,autoplay)
{
		
      // Collect query parameters in an object that we can
      // forward to SWFObject:
    
      var urlPara = escape(source_url);
      
      //alert(urlPara);
      
      var pqs = new ParsedQueryString();
      var parameterNames = pqs.params(false);
      
      var parameters = {
          src: urlPara,
          autoPlay: autoplay,
          streamType: stream_type,
          controlBarMode: "floating",
bufferTime: 1, 
initialBufferTime: 0.1, 
expandedBufferTime: 1, 
liveBufferTime: 0.2, 
liveDynamicStreamingBufferTime: 0.2, 
          //controlBarAutoHide: false,
          playButtonOverlay: true,
          showVideoInfoOverlayOnStartUp: true,
          javascriptCallbackFunction: "onJavaScriptBridgeCreated"	
      };
      
      for (var i = 0; i < parameterNames.length; i++) {
          var parameterName = parameterNames[i];
          parameters[parameterName] = pqs.param(parameterName) ||
          parameters[parameterName];
      }
      
      if (parameters.hasOwnProperty("logFilter"))
      {
      	org.osmf.player.debug.filter = parameters.logFilter;
      	delete parameters.logFilter;
      	document.getElementById("logFilter").value = org.osmf.player.debug.filter;
      }
      
      var wmodeValue = "direct";
      var wmodeOptions = ["direct", "opaque", "transparent", "window"];
      if (parameters.hasOwnProperty("wmode"))
      {
      	if (wmodeOptions.indexOf(parameters.wmode) >= 0)
      	{
      		wmodeValue = parameters.wmode;
      	}	            	
      	delete parameters.wmode;
      }
      
      // Embed the player SWF:	            
      swfobject.embedSWF(
				"ntvplayer/StrobeMediaPlayback.swf"
				, "ntvplayer"
				, width
				, height
				, "10.1.0"
				, "ntvplayer/expressInstall.swf"
				, parameters
				, {
		          allowFullScreen: "true",
		          wmode: wmodeValue,
		          streamType: stream_type,
		          controlBarMode: "floating"
		      }
				, {
		          name: "ntvplayer"
		      }
			);
}
