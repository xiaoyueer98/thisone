var UserId=0;
function fnSoFocus() {
	var val = $("#searchForm #keyword").val();
	if (val == '请在此处输入影片片名或演员名称。') {
		$("#searchForm #keyword").val('');
	}
}
function fnSoBlur() {
	var val = $("#searchForm #keyword").val();
	if (val == '') {
		$("#searchForm #keyword").val("请在此处输入影片片名或演员名称。");
	}
}
function clickCount() {
	var val = $("#searchForm #keyword").val();
	if (val == '' || val == '请在此处输入影片片名或演员名称。') {
		$("#searchForm #keyword").val("请在此处输入影片片名或演员名称。");
		return false;
	}
	return true;
}



   function CheckAdd(name,ckname,url,num){
        var result=VgetCookie(ckname);
        var str;
        if(result==null){
          result="";
        }
       if(num!=''){
          name=name+' '+num;
        }
        str=name+"ddd"+url+"ttt";
        if(result.indexOf(name)>=0){ //删除同片历史记录
              result= result.replace(str,"");
        }
          result=str+result;
          VSetCookie(ckname,result);
   }

	function VgetCookie(name)//取cookies函数        
	{
		var arr = document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
		if(arr != null) return unescape(arr[2]); return null;
	}

	function VSetCookie(name,value)
	{
		var Days = 30; //cookie 将被保存 30 天
		var exp  = new Date();   //new Date("December 31, 9998");
		exp.setTime(exp.getTime() + Days*24*60*60*1000);
		document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
	}


function setCookie(name, value, ihour) {
	var iH = ihour || 1;
	var exp = new Date;
	exp.setTime(exp.getTime() + iH * 60 * 60 * 1000);
	document.cookie = name + ("=" + escape(value) + ";expires=" + exp.toGMTString() + ";path=/;");
}

function getCookie(name) {
	var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
	if (arr != null) {
		return unescape(arr[2]);
	}
	return null;
}
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
/*
顶部展示浏览记录
*/
function ToggleRecord(){
	$("#historyContent").toggle();
	$("#headerHistoryBtn").toggleClass("headerHistorySelected");
}

//清除记录(0为清除，序号为删除指定)
function TrunRecord(Movie_i)
{
	document.getElementById('historyList').innerHTML="<ul class=\"ulHistoryList clearfix\"><div></div></ul>";
	if(Movie_i==0)
	{
		if(!isNaN(getCookies("UserId")))
		{
			UserId=Number(getCookies("UserId"));
		}
		if(UserId>0)
		{
			$.get("/user/ajax.asp?time="+Math.random(), {action:"del1", t: 1});
		}
		//setCookies("", "AspPlayRecordsList");
		setCookie("PlayRecordsList", " ", 0.001);
	}
}

function addPlayRecords(NameText,PlayUrl,Note) {
	var PlayRecordsList=getCookie("PlayRecordsList");
	if (PlayRecordsList=="" || PlayRecordsList==" " || PlayRecordsList==null || PlayRecordsList.length<10)
	{
		setCookie("PlayRecordsList", ""+NameText+"|"+PlayUrl+"|"+Note+"", 999999);
	}
	else if(PlayRecordsList.indexOf("|") > 0)
	{
		var TempStr=PlayRecordsList;
		if(PlayRecordsList.indexOf("||") > 0)
		{
			TempStr="";
			var ListSplit=PlayRecordsList.split("||");
			var j=0,isOne=0;
			var t;
			for(j=0;j<ListSplit.length;j++){
				if(ListSplit[j].indexOf("|") > 0)
				{
					if(ListSplit[j].indexOf(NameText+"|") == -1)
					{
						t=ListSplit[j].split('|');
						TempStr+=""+t[0]+"|"+t[1]+"|"+t[2]+"||";
					}
				}
			}
			TempStr=""+NameText+"|"+PlayUrl+"|"+Note+"||"+TempStr;
		}
		else if(PlayRecordsList.indexOf(""+NameText+"|")==-1){
			TempStr=""+NameText+"|"+PlayUrl+"|"+Note+"||"+PlayRecordsList;
		}
		else if(PlayRecordsList.indexOf(""+NameText+"|"+PlayUrl)!=-1&&PlayRecordsList.indexOf("||")==-1){
			TempStr=""+NameText+"|"+PlayUrl+"|"+Note;
		}
		setCookie("PlayRecordsList", TempStr, 999999);
	}
	else
	{
		setCookie("PlayRecordsList", " ", 0.001);
	}
	var UserId=0;
	if(!isNaN(getCookies("UserId")))
	{
		UserId=Number(getCookies("UserId"));
	}
	if(UserId>0)
	{
		$.get("/user/ajax.asp?t="+Math.random(), {action:"addPlayRecords", mId: play_vid, NameText: escape(NameText), PlayUrl: PlayUrl, Note: escape(Note)});
	}
	//alert(UserId);
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

function PlayRecords() {
	var PlayRecordsList="<ul class=\"ulHistoryList clearfix\">";
	var PlayRecordsListStr;
	PlayRecordsListStr=unescape(jfunescape(getCookies("gxhis")));
	if(PlayRecordsListStr=="")
	{
		PlayRecordsListStr=getCookie("PlayRecordsList");
	}
	else if(PlayRecordsListStr=="-1")
	{
		TrunRecord(0);
		PlayRecordsListStr="";
	}
	
	
	if (PlayRecordsListStr!="" &&PlayRecordsListStr!=" " && PlayRecordsListStr!=null)
	{
		
		var arr=PlayRecordsListStr.split("ttt");
			//if(arr.length>6)
			//{
				for(var i=0;i<arr.length;i++)
				{
					var act=arr[i].split('ddd');
					
					if(act[0] != "" )
					{
						
						//cc='<div class="list"><a href="'+act[1]+'" title="'+act[0]+'" class="title">'+act[0].substr(0,10)+'</a><a href="'+act[1]+'"  style="color:#4E8000;">继续观看</a></div>'+cc;
						PlayRecordsList+= "<li onmouseover=\"this.className='liHover'\" onmouseout=\"this.className=''\"><a target=_blank class=name href=\"" + act[1] + "\"" + " title=\"" + act[0] + "\"><span class=\"sName\">" + act[0] + "</span><span class=\"sTime\"></span></a></li>";
					}
				}
			//}
		/*
		var ListSplit=PlayRecordsListStr.split("||");
		var Fori=ListSplit.length;
		var t;
		if (Fori>10)
		{
			Fori=10;
		}
		var j=0;
		for(j=0;j<Fori;j++){
			if(ListSplit[j].length>0){
				if(ListSplit[j].indexOf("|") > 0)
				{
					t=ListSplit[j].split('|');
					if(t.length>0&&t[0].length>0)
					{
						PlayRecordsList+= "<li onmouseover=\"this.className='liHover'\" onmouseout=\"this.className=''\"><a target=_blank class=name href=\"" + t[1] + "\"" + " title=\"" + t[0] + "\"><span class=\"sName\">" + t[0] + "</span><span class=\"sTime\">" + t[2] + "</span></a></li>";
					}
				}
			}
		}
		*/
	}
	document.getElementById("historyList").innerHTML= PlayRecordsList+"</ul><!--"+PlayRecordsListStr+"-->";
}


function randomOrder(targetArray)
{
    var arrayLength = targetArray.length
    var tempArray1 = new Array();
    for (var i = 0; i < arrayLength; i ++)
    {
        tempArray1 [i] = i
    }
    var tempArray2 = new Array();
    for (var i = 0; i < arrayLength; i ++)
    {
        tempArray2 [i] = tempArray1.splice (Math.floor (Math.random () * tempArray1.length) , 1)
    }
    var tempArray3 = new Array();
    for (var i = 0; i < arrayLength; i ++)
    {
        tempArray3 [i] = targetArray[tempArray2[i]]
    }
    return tempArray3
}
function Rmingxing(_type) {
	var arrlist = new Array()
	arrlist=["孙红雷","谢霆锋","黄晓明","刘烨","韩庚","文章","张东健","冯绍峰","范冰冰","章子怡","秋瓷炫","董璇","赵薇","杨幂","高圆圆","刘亦菲","周星驰","古天乐","林永健","黄渤","葛优","范伟","郭德纲","郭涛","梁朝伟","周润发","刘德华","陈奕迅","吴奇隆","陈建斌","林志颖","周星驰","林青霞","金喜善","吕丽萍","刘晓庆","蒋雯丽","舒淇","海清","周迅","李连杰","甄子丹","章子怡","李小龙","李冰冰","林青霞","成龙","吴京","林正英","张国荣","刘青云","李冰冰","徐静蕾","陈道明","姚晨","姜文","章子怡","霍思燕","范冰冰","林志玲","苍井空","巩新亮","舒淇","郝蕾","田朴珺","潘粤明","张馨予","周杰伦","林依晨","陈柏霖","李晨","董洁","吴奇隆","林峰","刘恺威","文章","冯绍峰","胡歌","林志颖","黄宗泽","刘诗诗","杨幂","李小璐","马苏","马伊琍","孙俪","范冰冰","苗圃","吴秀波","张嘉译","孙红雷","王志文","陈建斌","于荣光","张国立","尤勇","袁莉","蔡少芬","林心如","宋慧乔","金喜善","高圆圆","秦海璐","殷桃","赵本山","pong","宋丹丹","刘雪华","张铁林","刘佩琦","刘晓庆","王姬"];
	var ShowHtml="";
	var NewArrlist = new Array();
	NewArrlist=randomOrder(arrlist);
	var maxNum=9;
	if(_type==1||_type==2)
	{
		maxNum=12;
	}
	for(var i=0;i<maxNum;i++)
	{
		if(_type==1||_type==2)
		{
			//http://www.eku24.com/index.php?s=video/search/wd/%E7%BD%97%E5%AE%B6%E8%8B%B1
			ShowHtml+="<a href=\"/index.php?s=video/search/wd/="+NewArrlist[i]+"\" target=\"_blank\" title=\""+NewArrlist[i]+"\">"+NewArrlist[i]+"</a>";
			ShowHtml+="<em>|</em>";
		}
		else{
			ShowHtml+="<span><a href=\"/index.php?s=video/search/wd/"+NewArrlist[i]+"\" target=\"_blank\" title=\""+NewArrlist[i]+"\">"+NewArrlist[i]+"</a></span>";
		}
	}
	if(_type==1||_type==2)
	{
		$('.filter_select_con #mingxing').html(ShowHtml+"<a href=\"javascript:Rmingxing(1);\">换一换</a>");
	}
	else
	{
		$('#mingxing dd').html(ShowHtml);
	}
}
function desc(a, b, c) {
				if (c.className.indexOf('_on') == -1) {
					if (a == 0) {
						document.getElementById('desc_' + b).className = 'desc';
						c.className = 'asc asc_on';
					} else {
						document.getElementById('asc_' + b).className = 'asc';
						c.className = 'desc desc_on';
					}
					document.getElementById('play_' + b).innerHTML = '<ul'+(b=="999"?" class=\"Dlist\"":"")+'>' + document.getElementById('play_' + b).getElementsByTagName('ul')[0].innerHTML.toLowerCase().split('</li>').reverse().join('</li>').substring(5) + '</li></ul>';
				}
}

function getPageGoUrl(maxPage,pageDiv,type,listpagename){
	var str,goUrl
	var url=location.href
	pageNum=$(".page input:input").val();
	if (pageNum.length==0||isNaN(pageNum)){alert('输入页码非法');return false;}
	if(pageNum>maxPage){pageNum=maxPage;}
	if(pageNum<1){pageNum=1;}
	if(url.lastIndexOf("/")==(url.length-1)){url+=listpagename}
	str=(pageNum==1)?'':pageNum;
	goUrl=regexpSplice(url,/(http:\/\/\S+?)[\d]*(\.html|\.htm|\.shtml|\.shtm|\.asp)/,str);
	location.href=goUrl;
}

function regexpSplice(url,pattern,spanstr) {
   pattern.exec(url);
   return (RegExp.$1+spanstr+ RegExp.$2);
}