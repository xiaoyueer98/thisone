(function (window) {
    function _registerEvent(target, eventType, cb) {
        if (target.addEventListener) {
            target.addEventListener(eventType, cb);
            return {
                remove: function () {
                    target.removeEventListener(eventType, cb);
                }
            };
        } else {
            target.attachEvent(eventType, cb);
            return {
                remove: function () {
                    target.detachEvent(eventType, cb);
                }
            };
        }
    }

    function _createHiddenIframe(target, uri) {
        var iframe = document.createElement("iframe");
        iframe.src = uri;
        iframe.id = "hiddenIframe";
        iframe.style.display = "none";
        target.appendChild(iframe);

        return iframe;
    }

    function openUriWithHiddenFrame(uri, failCb, successCb) {

        var timeout = setTimeout(function () {
            failCb();
            handler.remove();
        }, 750);

        var iframe = document.querySelector("#hiddenIframe");
        if (!iframe) {
            iframe = _createHiddenIframe(document.body, "about:blank");
        }

        var handler = _registerEvent(window, "blur", onBlur);

        function onBlur() {
            clearTimeout(timeout);
            handler.remove();
            successCb();
        }

        iframe.contentWindow.location.href = uri;
    }

    function openUriWithTimeoutHack(uri, failCb, successCb) {

        var timeout = setTimeout(function () {
            failCb();
            handler.remove();
        }, 750);

        //handle page running in an iframe (blur must be registered with top level window)
        var target = window;
        while (target != target.parent) {
            target = target.parent;
        }

        function onBlur() {
            clearTimeout(timeout);
            handler.remove();
            successCb();
        }

        var handler = _registerEvent(target, "blur", onBlur);

        window.location = uri;
    }

    function openUriUsingFirefox(uri, failCb, successCb) {
        var iframe = document.querySelector("#hiddenIframe");

        if (!iframe) {
            iframe = _createHiddenIframe(document.body, "about:blank");
        }

        try {
            iframe.contentWindow.location.href = uri;
            successCb();
        } catch (e) {
            if (e.name == "NS_ERROR_UNKNOWN_PROTOCOL") {
                failCb();
            }
        }
    }

    function openUriUsingIEInOlderWindows(uri, failCb, successCb) {
        if (getInternetExplorerVersion() === 10) {
            openUriUsingIE10InWindows7(uri, failCb, successCb);
        } else if (getInternetExplorerVersion() === 9 || getInternetExplorerVersion() === 11) {
            openUriWithHiddenFrame(uri, failCb, successCb);
        } else {
            openUriInNewWindowHack(uri, failCb, successCb);
        }
    }

    function openUriUsingIE10InWindows7(uri, failCb, successCb) {
        var timeout = setTimeout(failCb, 750);
        window.addEventListener("blur", function () {
            clearTimeout(timeout);
            successCb();
        });

        var iframe = document.querySelector("#hiddenIframe");
        if (!iframe) {
            iframe = _createHiddenIframe(document.body, "about:blank");
        }
        try {
            iframe.contentWindow.location.href = uri;
        } catch (e) {
            failCb();
            clearTimeout(timeout);
        }
    }

    function openUriInNewWindowHack(uri, failCb, successCb) {
        var myWindow = window.open('', '', 'width=0,height=0');

        myWindow.document.write("<iframe src='" + uri + "'></iframe>");

        setTimeout(function () {
            try {
                myWindow.location.href;
                myWindow.setTimeout("window.close()", 750);
                successCb();
            } catch (e) {
                myWindow.close();
                failCb();
            }
        }, 750);
    }

    function openUriWithMsLaunchUri(uri, failCb, successCb) {
        navigator.msLaunchUri(uri,
            successCb,
            failCb
        );
    }

    function checkBrowser() {
        var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
        return {
            isOpera: isOpera,
            isFirefox: typeof InstallTrigger !== 'undefined',
            isSafari: Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0,
            isChrome: !!window.chrome && !isOpera,
            isIE: /*@cc_on!@*/false || !!document.documentMode, // At least IE6,
            isLieBao: /lbbrowser/.test(navigator.userAgent.toLowerCase())
        }
    }

    function getInternetExplorerVersion() {
        var rv = -1;
        if (navigator.appName === "Microsoft Internet Explorer") {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null)
                rv = parseFloat(RegExp.$1);
        } else if (navigator.appName === "Netscape") {
            var ua = navigator.userAgent;
            var re = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
            if (re.exec(ua) != null) {
                rv = parseFloat(RegExp.$1);
            }
        }
        return rv;
    }

    function generateLaunchProtocol(username, userpwd) {
        // var uri = 'cclive://' + userId + '/' + roomId;
        //
        // if (publishName && publishPassword) {
        //     var pn = encodeURIComponent(publishName);
        //     if (window.attachEvent) {
        //         pn = encodeURIComponent(pn);
        //     }
        //
        //     uri = uri + '/' + pn + '/' + encodeURIComponent(publishPassword);
        // }
        var uri =document.getElementById('playurl').value;
        var strs= new Array(); //定义一数组
        strs=uri.split("|"); //字符分割
        url =strs[0]+strs[1]+strs[2]+strs[3]+strs[4];  //推流地址

        return uri;
    }

    window.launchCCLive = function (username, userpwd, url, failCb, successCb) {
        var uri = generateLaunchProtocol(username, userpwd);
        function failCallback() {
            failCb && failCb();
        }

        function successCallback() {
            successCb && successCb();
        }

        var browser = checkBrowser();
        // 猎豹浏览器 openUriWithHiddenFrame
        if (!browser.isLieBao && navigator.msLaunchUri) {
            openUriWithMsLaunchUri(uri, failCallback, successCallback);
        } else {
            if (browser.isFirefox) {
                openUriUsingFirefox(uri, failCallback, successCallback);
            } else if (browser.isChrome) {
                openUriWithTimeoutHack(uri, failCallback, successCallback);
            } else if (browser.isLieBao) {
                openUriWithHiddenFrame(uri, failCallback, successCallback);
            } else if (browser.isIE) {
                openUriUsingIEInOlderWindows(uri, failCallback, successCallback);
            } else {
                //not supported, implement please
            }
        }
    }
}(window));