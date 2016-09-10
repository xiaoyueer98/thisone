$(function () {
    var isChromeOr360 = !!window.chrome && !(!!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0);

    if (isChromeOr360) {
        $('#msg').show();
    }
    $('#starlive').click(function () {
        var username=$('#uname').val();
        var userpwd=$('#upwd').val();
        var url=$('#playurl').val();

        var strs= new Array(); //定义一数组
        strs=url.split("|"); //字符分割
        url =strs[0]+strs[1]+strs[2]+strs[3]+strs[4];  //推流地址
        alert(url);
        //  if (!userId || !roomId) {
        //      return alert('userId & roomId is empty');
        // }

        // var publishName = $.trim($('#publishName').val());
        // var publishPassword = $.trim($('#publishPassword').val());
        window.launchCCLive(username, userpwd, url,function () {

            if (isChromeOr360) {
                return;
            }
            var c = confirm('您还没有下载客户端，点击确定按钮下载');
            if (c) {
                window.open('http://dl.csslcloud.net/client/windows/CCLive3.2.0.exe', '_target');
            }
        });
        window.open('http://dl.csslcloud.net/client/windows/CCLive3.2.0.exe', '_target');
    });

    // 进入页面
    // 如果安装客户端则自动启动
    // 如果没有安装客户端则点击下载
    $('#launch').click();


    $('#download').click(function () {
        window.open('http://dl.csslcloud.net/client/windows/CCLive3.2.0.exe', '_target');
    });
});


