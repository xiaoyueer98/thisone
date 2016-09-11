var BOSH_SERVICE = '/http-bind/';
var connection = null;
var nick = null;
var room = null;
var jid = null;
var pwd = null;

function log(msg) 
{
    $('#log').append('<div></div>').append(document.createTextNode(msg));
}

function add_msg(msg){
	$("#chat .window").append('<div>').append(msg).append('</div>');
}

function onConnect(status)
{
   if (status == Strophe.Status.CONNECTING) {
			log('IM is connecting.');
    } else if (status == Strophe.Status.CONNFAIL) {
			log('IM failed to connect.');
    } else if (status == Strophe.Status.DISCONNECTING) {
			log('IM is disconnecting.');
    } else if (status == Strophe.Status.DISCONNECTED) {
			log('Strophe is disconnected.');
    } else if (status == Strophe.Status.CONNECTED) {
	   log('IM is connected.');
		connection.muc.init(connection);
		//connection.addHandler(onMessage, null, 'message', null, null,  null); 
		alert("nick:" + nick);
		connection.muc.join(room + "@conference.v.8dage.cn", nick, MucMessageReceived);
		
		/*
	    $("#nicheng").val(nick);
	    $('#nc').get(0).value=nick;
	    
	    $.post("nicheng.php",{
	        nick:nick
	    },function(a,b){
		    $("#bg").show();
		    $("#window").show();
			});	
			*/
    }
}

function onMessage(msg) {
    var to = msg.getAttribute('to');
    var from = msg.getAttribute('from');
    var type = msg.getAttribute('type');
    var elems = msg.getElementsByTagName('body');

    if (type == "chat" && elems.length > 0) {
			var body = elems[0];
			log('ECHOBOT: I got a message from ' + from + ': ' + 
			    Strophe.getText(body));
    }

    // we must return true to keep the handler alive.  
    // returning false would remove it after it finishes.
    return true;
}

//���շ���Ի���Ϣ
function MucMessageReceived(msg){
//	log("get group chat message��", Strophe.serialize(msg));
    var to = msg.getAttribute('to');
    var from = msg.getAttribute('from');
    var type = msg.getAttribute('type');
    var elems = msg.getElementsByTagName('body');

    log("recv type:" + type + "\n");
    if (type == "groupchat" && elems.length > 0) {
			var body = elems[0];
			var fr = from.split("/");
			var nick = fr[1].split("@");
			add_msg(nick[0] + ': ' + replace_em(Strophe.getText(body)));
			log(nick[0] + ': ' + replace_em(Strophe.getText(body)));
			var div  = $("#chat .window").get(0);
			div.scrollTop = div.scrollHeight;
		}
		return true;
}

function ListMember(){
	log("get member list");
}

function SuccessCb(msg){
	log("success...");
}

function ErrorCb(msg){
	log("error...");
}

function getParam() {
	room = "mytest";
	jid = "fanson";
	pwd = "fanson";
}
  
function replace_em(str){
	str = str.replace(/\</g,'&lt;');
	str = str.replace(/\>/g,'&gt;');
	str = str.replace(/\n/g,'<br/>');
	str = str.replace(/\[em_([0-9]*)\]/g,'<img src="/video/template/default/arclist/$1.gif" border="0" />');
	return str;
}
  
$(document).ready(function () {
		getParam();

	alert("room:" + room);
	alert("jid:" + jid);
	alert("pwd：" + pwd);
    connection = new Strophe.Connection(BOSH_SERVICE);
    nick = jid;

    //连接到服务器
    connection.connect(jid + "@v.8dage.cn", pwd, onConnect);
    
    //初始化表情
	$('.emotion').qqFace({
		id : 'facebox', 
		assign:'content', 
		path:'/video/template/default/arclist/'	//�����ŵ�·��
	});

		
	$('#send').bind('click', function(){
		var content =  $('#content').get(0).value;
		alert(content);
	    connection.muc.groupchat(room + "@conference.v.8dage.cn", content, '');
	    $('#content').get(0).value = "";
	});	
    
    $("#btn_member").bind('click', function(){
    	connection.muc.admin(room + "@conference.v.8dage.cn", jid + "@v.8dage.cn", 'admin', '', ListMember);
    	connection.muc.member(room + "@conference.v.8dage.cn", jid + "@v.8dage.cn", 'member', '', ListMember);
    });
          
    $('#btn_room').bind('click', function(){
    	connection.muc.createInstantRoom(room + "@conference.v.8dage.cn", SuccessCb, ErrorCb);
    });
});
