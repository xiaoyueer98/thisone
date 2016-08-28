/**
 * Created by gg on 2015/12/10.
 */
window.onload = function(){
    var index = 1;
    var timer= null;
    var i = 0;
    var largeContainer = $(".box"),
        largeContainerWidth = $(".box").width();
        $(".img_con img").width(largeContainerWidth);
    var imgWidth = $(".img_con img").width();
        imgHeight = $(".img_con img").height(),
        largeContainerHeight = $(".box").height(imgHeight),
        container = $(".container"),
        ImgLength = $(".img_con img").length;
        container.css({left:-largeContainerWidth}); 
    var $pipe = $( ".box>div" );
    var firstImgCon = $(".img_con").first(),
        lastImgCon = $(".img_con").last();
        firstImgCon.clone(true).appendTo(container);
        lastImgCon.clone(true).prependTo(container);
        $(".container").width($(".img_con img").length*$(".box").width());
    var $nav = $( ".nav_list li" );
    $(".navBtn .nav_r,.navBtn .nav_l").css({"top":imgHeight/2});
    var $pipeItem = $(".box .container div");
    function slide(i){
        var ImgLength = $(".img_con img").length;
        if( i === 0 ){
            setNavFocus( $nav.eq( 4 ) );
        }else if( i === $pipeItem.length - 1 ){
            setNavFocus( $nav.eq( 0 ) );
        }else{
            setNavFocus( $nav.eq( i - 1 ) );
        }
        container.animate({left:-i*largeContainerWidth},200,function(){
            if(i == 0) {
                container.css({"left": (ImgLength-2) * -largeContainerWidth});
                index = ImgLength-2; 
            }else if( i == ImgLength-1 ){
                container.css({"left":-largeContainerWidth});
                index = 1;
            }
        });
    };;

    $(".nav_r").click(function(){
        if( !container.is( ":animated" ) ){
            slide( ++index );
        }
    });
    $(".nav_l").click(function(){
        if( !container.is( ":animated" ) ){
            slide( --index );
        }
    });
    function setNavFocus( $obj ){
        $obj.addClass( "active" ).siblings().removeClass( "active" );
    };
    $nav.on( "click", function(){
        var i = $( this ).index() + 1;
        slide( i );
        index = i;
        setNavFocus($(this))
    });
    $(".banner").on( "mouseover", function(){
        clearInterval( timer );
        $(".navBtn span").show();
    }).on("mouseout", function(){
        $(".navBtn span").hide();
        setTimer();
    });
    function setTimer(){
        timer = setInterval(function(){
            $(".nav_r").trigger("click");
        },1000)
    };
    setTimer();


    /*----tab切换----*/

    var $tabBtn = $(".bn_nav li");
    var $banListWidth = $(".ban_r_list .list_con ul").width();
   // alert($banListWidth);
    $tabBtn.click(function(){
        var index = $(this).index();
        $(".ban_r_list .list_con").animate({left:index*-$banListWidth});
        $(this).addClass("m").siblings().removeClass("m");
    })




    /*-------------------------------------*/
    $(".con_l_nav li").click(function(){
        $(this).addClass("m").siblings().removeClass("m");
        var index = $(this).index();
        $(this).parents(".con_head").next().find("ul").eq(index).show().siblings().hide();
    })

    /*-------------------------------------*/
    $(".video_nav li").click(function(){
        $(this).addClass("m").siblings().removeClass("m");
        var index = $(this).index();
        $("._video_b .con_list>div").eq(index).show().siblings().hide();
    })

    /*-------------------------------------*/
    $(".videolive .con_l_nav li").click(function(){
        $(this).addClass("m").siblings().removeClass("m");
        var index = $(this).index();
        $(this).parents(".con_head").next().find(".ul_con").eq(index-1).show().siblings().hide();
    })
}