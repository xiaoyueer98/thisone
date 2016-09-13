$(function () {
    var isChromeOr360 = !!window.chrome && !(!!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0);

    if (isChromeOr360) {
        $('#msg').show();
    }
    $('#launchfsLive').click(function () {
        var username=$('#username').val();
        var userpwd=$('#userpwd').val();
        var url=$('#playurl').val();
       // alert(url);
        //alert(username);
        //alert(userpwd);
         var strs= new Array(); //定义一数组
         strs=url.split("|"); //字符分割
         url =strs[0]+strs[1]+strs[2]+strs[3]+strs[4];  //推流地址
        window.launchCCLive(username, userpwd, url,function () {

            if (isChromeOr360) {
                return;
            }
            var c = confirm('您还没有下载客户端，点击确定按钮下载');
            if (c) {
                window.open('103.231.69.228/video/fslive/FSLive-setup.exe', '_target');
            }
        });
        window.open('103.231.69.228/video/fslive/FSLive-setup.exe', '_target');
    });

    // 进入页面
    // 如果安装客户端则自动启动
    // 如果没有安装客户端则点击下载
    $('#launch').click();


    $('#launch').click(function () {
        window.open('103.231.69.228/video/fslive/FSLive-setup.exe', '_target');
    });
});


