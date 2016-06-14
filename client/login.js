(function ($) {

    'use strict';

    var l = function(){
        var url = $("meta[name=LoginServer]").attr("content");
        $.ajax({
            type:"get",
            url:url+"/user.php",
            dataType:"jsonp",
            jsonp: "callbackparam",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
            jsonpCallback:"success_jsonpCallback",//自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名
            success:function(resp){
                if(resp.islogin && resp.data){
                    window.postMessage({type:'LOGIN',user:resp.data},'*');
                }else{
                    var ref = encodeURI(window.location.href);
                    window.location.href = url+'?ref='+ref;
                }
            }
        });
    };

   l();


}(jQuery));
