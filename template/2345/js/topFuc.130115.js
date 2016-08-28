//vellen 2013-01-08
var xSuggest = {
	canLoad : '',
	data : '',
	keyword : '',
	oAjax : '',
	oSugList : {},
	eSugLayer : 'search_result',
	eThink : 'think_m',
	eKeyword : 'keyword',
	aTvType : ['电影','电视剧','动漫','综艺'],
	delay : 200,
	timeout : '',
	sugCurrent : 0,
	sugVideoCSS : ['A', 'B', 'C', 'D', 'E', 'F'],
	sugMax : 5,
	
	init : function(){
		this.regEvent();
	},

	cache : {
		data : {},
		add : function(key, val){
			this.data[key] = val;
		},
		
		get : function(key){
			return this.data[key] || '';
		},
		
		remove : function(key){
			this.data[key] = null;
		}
		
	},
	
	regEvent : function(){
		var _self = this;
		this.eKeyword = Fn(this.eKeyword);
		this.eKeyword.keyup(function(){
			_self.keyword = this.value;
			_self.doKeyup();
		}).blur(function(){
			_self.keyword = this.value;
			if (this.value == '') {
				Fn(this).css({'color':'#999'});
				_self.eKeyword.value(default_search_word);
			}
		}).focus(function(){
			_self.keyword = this.value;
			if (_self.keyword == default_search_word){
				Fn(this).css({'color':'#333'});
				_self.eKeyword.value('');
				_self.keyword = '';
			}
			_self.show();
		})
	},
	
	doKeyup : function(){
		var e = Fn.event.get(), _self = this;
		if (this.timeout) clearTimeout(this.timeout);
		if (e.keyCode > 111 && e.keyCode < 138) return; //F1~F12
		if (e.keyCode == 37 || e.keyCode == 39) return; //LEFT~RIGHT
		if (e.keyCode == 27) return this.hide(); //ESC
		if (e.keyCode == 38 || e.keyCode == 40 ) return this.doUpDnlist(e.keyCode);
		this.timeout = setTimeout(function(){_self.show();}, this.delay)
	},
	
	doUpDnlist : function(mode){
		switch(mode * 1){
			case 38 :
				var sn = this.sugCurrent < 1 ? this.data.length - 1 : this.sugCurrent - 1
				break;
			case 40 :
				var sn = this.sugCurrent >= this.data.length - 1 ? 0 : this.sugCurrent + 1
				break;
		}
		this.setSearchValue(sn);
		this.doSelSugList(sn);
	},

	setSearchValue : function(sn){
		this.eKeyword.value(this.data[sn]['title']);
	},

	hide : function(){
		Fn(this.getSugLayer()).hide();
	},
	
	show : function(){
		this.sugMode = Fn.obj(this.eThink) ? 'detail' : 'index';
		var data = this.cache.get(this.keyword);
		if (this.keyword == '') return this.hide();
		if (!data){
			this.get();
		}else{
			this.data = data;
			this.doSugList();
		}
	},
	
	getSugLayer : function(){
		return Fn.obj(this.eThink) ? this.eThink : this.eSugLayer;
	},

	doSugList : function(){
		if (this.oAjax) this.oAjax.abort();
		if (this.data.length < 1) return this.hide();
		var html = this.parseList(), vhtml = '', _self = this;
		Fn(this.getSugLayer()).html(html).show();
		this.oSugList = Fn('sugList').tag('a');
		if (this.sugMode == 'index'){
			this.parseVideoList(0);
			this.setListCss(0);
			Fn(this.oSugList).each(function(){
				Fn(this).mouseover(function(){
					var sn = this.id.replace('video', '');
					_self.doSelSugList(sn);
				})
			})
		}
	},

	jsonp : function(keyword, data){
		if (!this.canLoad) return false;
		this.data = data;
		this.doSugList();
		this.cache.add(keyword, data);
		this.clearScript();
	},

	clearScript : function(){
		var head = Fn(document.head);
		head.tag('script').each(function(){
			if (this.src.indexOf('/moviecore/server/search/') >0){
				if (this.parentNode){  
					this.parentNode.removeChild(this);  
				}else{
					head[0].removeChild(this);
				}
			}
		});
	},

	get : function(){
		var _self = this;
		if (!this.keyword) return false;
		this.canLoad = true;
		if (location.host == 'v.2345.com' || location.host == 'tv.2345.com'){
			if (this.oAjax) this.oAjax.abort();
			var keyword = this.keyword;
			this.oAjax = Fn.ajax({
				query : '/moviecore/server/search/?q=' + this.keyword + '&ctl=think&querytype=suggest',
				onsucc : function(data){
					if (!data.length) return _self.hide();
					data = data.evalJSON();
					_self.jsonp(keyword, data);
					_self.canLoad = false;
				}
			});
		}else{
			this.clearScript();
			var keyword = this.keyword;
			Fn.loadScript('http://tv.2345.com/moviecore/server/search/?q=' + encodeURI(this.keyword) + '&ctl=think&querytype=jsonp', function(){
				_self.jsonp(keyword, jsonp_sug_data)
			});
		}
	},

	doSelSugList : function(sn){
		this.setListCss(sn);
		this.parseVideoList(sn);
	},

	parseVideoList : function(sn){
		if (this.sugMode == 'detail') return false;
		var html = '', videoCss = '', data = this.data[sn];
		var csssn = sn <= 5 ? sn : 5;
		var videoCss = 'association_video' + this.sugVideoCSS[csssn * 1];
		concat.append('<div class="association_video ', videoCss, '"><p class="pic"><a title="', data.title, '" href="', data.xqurl, '"><img alt="', data.title, '" width="89" height="119" src="', data.img, '"></a>');
		concat.append(this.aTvType[data.type-1], '</p><div class="association_video_xq"><p class="name"><a href="' + data.xqurl + '">', this.hiLight(data.title, this.keyword), '</a></p>');
		if(data.actor) concat.append("<p class='clearfix'><em>主演：</em><span>", data.actor, "</span></p>");
		if(data.stype) concat.append('<p><em>类型：</em>', data.stype, '</p>');
		if(data.year) concat.append('<p><em>上映：</em>', data.year, '</p>');
		if(data.id > 0){
			concat.append('<p><a class="playVideoBtn" target="_blank" title="', data.title, '" href="', data.xqurl, '"></a></p>');
		}else{
			concat.append('<p><a class="checkMoreBtn" target="_blank" title="', data.title, '" href="http://so.v.2345.com/search_', data.title, '"></a></p>');
		}
		Fn('sugListAsso').html(concat.out()).show();
	},
	
	setListCss : function(sn){
		var _self = this;
		this.oSugList.each(function(o, i){
			if (i == sn){
				_self.sugCurrent = sn * 1;
				Fn(this).addClass('cut').removeClass('hover_fot');
			}else{
				Fn(this).addClass('hover_fot').removeClass('cut');
			}
		});
	},

	parseList : function(){
		var _self = this;
		Fn(this.data).each(function(o, i){
			var xqurl = 'http://so.v.2345.com/search_' + this.title + '/';
			concat.append('<a href="', xqurl,'" target="_blank" id="video'+i+'" title="', this.title, '">'+ _self.hiLight(this.title.substring(0, 11), _self.keyword), '</a>');
		});
		var html = concat.out();
		switch(this.sugMode){
			case 'detail' :
				concat.append('<div id="sugList">', html);
				concat.append('</div><div class="clear"></div>');
				break;
			case 'index' :
				concat.append('<div class="association_menu" id="sugList">', html)
				concat.append('</div><div class="association_r"><div class="association_main" id="sugListAsso"></div></div><div class="clear"></div>');
				break;
		}
		return concat.out();
	},

	hiLight : function(str, tostr){
		return str.replace(tostr, '<i>' + tostr + '</i>');
	}
}

//Fn.ready(function(){
//	xSuggest.init();
//});

xSuggest.init();

Array.prototype.remove = function (dx) {
	if(isNaN(dx)||dx > this.length){
		return false;
	}
	for(var i=0,n=0;i<this.length;i++) {
		if(this[i]!=this[dx]) {
			this[n++]=this[i];
		}
	}
	this.length -= 1;
};



function filter(keyword){
	var limited = ['_','<','>','[',']','{','}','`','!',';','|','；',':','：','-','$','《','》','#','.',',','，','\'','\'','"',"'","~","@","$","%","^","&","*","/","+","=","?"];
	var limit_count=limited.length;
	for(var i=0;i<limit_count;i++)
	{
		keyword = keyword.replace(eval('/\\'+limited[i]+'/ig'), '');
	}
	return keyword;
}

function getActionUrl() {
	var url = "http://so.v.2345.com/search_";
	var keyword = Fn("keyword").value();
	keyword = filter(keyword);
	if (keyword == ''){
		alert('请输入您想查找的关键字');
		return false;
	}
	if (location.href.indexOf('search') != -1 && keyword != "") {
		m.g("search_form").target = "_self";
	}
	url += keyword;

	url += "/";

	return url;
}


function hasClass(a, c) {
	var b = new RegExp("(\\s|^)" + c + "(\\s|$)");
	return a.className.match(b)
}

function addClass(a, b) {
	if (!hasClass(a, b)) {
		a.className += " " + b
	}
}
function removeClass(obj, className) {
	if (obj.className != "") {
		var re_ = new RegExp("\\b" + className + "\\b\\s*", "");
		obj.className = obj.className.replace(re_, "");
	}
}
function fnShowRecord(){
	if(m.g("storageIframe") == undefined){
		var iframe = document.createElement("iframe");	
		iframe.id="storageIframe";
		document.getElementById("vheader").appendChild(iframe);
		iframe.style.display="none";
	}else{
		var iframe = m.g("storageIframe");
	}
	iframe.src = "http://v.2345.com/storage.html?action=init";
	m.g("historyContent").style.display="";
	m.g("headerHistoryBtn").className="headerHistoryBtn headerHistorySelected";
} 
function fnCloseRecord(){
	m.g("historyContent").style.display="none";
	m.g("headerHistoryBtn").className="headerHistoryBtn";
}

function fnToggleRecord(){
	if($('#historyContent').css('display') == 'none'){
		$('#headerHistoryBtn').addClass('headerHistorySelected');
		$('#historyContent').css('display','block');
		$('#historyList').css('display','block');
		getRecordList();
		
	}else{
		$('#headerHistoryBtn').removeClass('headerHistorySelected');
		$('#historyContent').css('display','none');
		$('#historyList').css('display','none');
	}
}


//获取 cookie 数据

function getRecordList()
{
	PlayRecordsListStr = unescape(jfunescape(getCookies("gxhis")));
	var PlayRecordsList = '';
	
	PlayRecordsList += '<ul class="ulHistoryList clearfix">';
	var arr=PlayRecordsListStr.split("ttt");
	
				for(var i=0;i<arr.length;i++)
				{
					var act=arr[i].split('ddd');
					
					if(act[0] != "" )
					{
						
						//cc='<div class="list"><a href="'+act[1]+'" title="'+act[0]+'" class="title">'+act[0].substr(0,10)+'</a><a href="'+act[1]+'"  style="color:#4E8000;">继续观看</a></div>'+cc;
						//PlayRecordsList+= "<li onmouseover=\"this.className='liHover'\" onmouseout=\"this.className=''\"><a target=_blank class=name href=\"" + act[1] + "\"" + " title=\"" + act[0] + "\"><span class=\"sName\">" + act[0] + "</span><span class=\"sTime\"></span></a></li>";
						PlayRecordsList+= '<li onmouseover="this.className=&quot;liHover&quot;" onmouseout="this.className=&quot;&quot;" class=""><a href="'+act[1]+'" target="_blank"><span class="sName">'+act[0]+'</span></a></li>';
					}
				}
				PlayRecordsList += '</ul>';
				
	$('#historyList').html(PlayRecordsList);			
	//alert(PlayRecordsList);
}

document.onclick = function(){
    //隐藏层代码
	//fnToggleRecord();
		//$('#headerHistoryBtn').removeClass('headerHistorySelected');
		//$('#historyContent').css('display','none');
		//$('#historyList').css('display','none');
};
 
	$("#headerHistoryBtn").click(function(event){
		
		var e=window.event || event;
		if(e.stopPropagation){
			e.stopPropagation();
		}else{
			
			e.cancelBubble = true;
		}
	});
 
 
 /*
document.getElementById('headerHistoryBtn').onclick = function(oEvent){
    //取消冒泡
    oEvent = oEvent || window.event;
    if(document.all){
        oEvent.cancelBubble = true;
    }else{
        oEvent.stopPropagation();
    }
};
*/


function getCookies(name) {//与asp互通
    var offset, cookieValue="";
    var search = name + "=";
	//alert(document.cookie);
    if (document.cookie.length > 0) {
        offset = document.cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = document.cookie.indexOf("&", offset);
            if (end == -1) {
				end = document.cookie.indexOf(";", offset);
            }
            if (end == -1) {
                end = document.cookie.length;
            }
            cookieValue = document.cookie.substring(offset, end);
        }
    }
    return cookieValue;
}

function jfunescape(pstr) {
	var TempStr=pstr;
	TempStr=TempStr.replace(/%7C/g,"|")
	TempStr=TempStr.replace(/%3A/g,":")
	TempStr=TempStr.replace(/%2E/g,".")
	TempStr=TempStr.replace(/%2F/g,"/")
	TempStr=TempStr.replace(/%25/g,"%")
	return TempStr
}


function fnDelRecord(num){
	m.g("storageIframe").src = "http://v.2345.com/storage.html?action=del&num="+num;
}
function fnTrunRecord(){
	m.g("storageIframe").src = "http://v.2345.com/storage.html?action=trun";
}
function fnAddRecord(oid,type,url,title){
	if(m.g("storageIframe") == undefined){
		var iframe = document.createElement("iframe");	
		iframe.id="storageIframe";
		document.getElementById(oid).appendChild(iframe);
		iframe.style.display="none";
	}else{
		var iframe = m.g("storageIframe");
	}
	var current = arguments[4] ? arguments[4] : 0;
	var id = arguments[5] ? arguments[5] : 0;
	var last = arguments[6] ? arguments[6] : 0;
	var jishu = arguments[7] ? arguments[7] : 0;
	iframe.src = "http://v.2345.com/storage.html?action=add&url="+escape(url)+"&title="+escape(title)+"&type="+type+"&current="+current+"&id="+id+"&last="+last+"&jishu="+jishu;
}
if (m.g('historyList')){
	window.onload=function(){
		m.g('historyList').onclick=function(e){
	        if(window.event){
	        	window.event.cancelBubble = true;
	        } else {
	            e.stopPropagation();
	        }
		};
	}
}