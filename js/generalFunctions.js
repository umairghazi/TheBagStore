/**
 * Created by umairghazi on 3/12/16.
 */


var ajaxFunctions = (function(){

    return {
        ajaxCall : function(type,url,data,callback){
            $.ajax({
                type: type,
                async   : true,
                cache   : false,
                url     : url,
                data    : data,
                dataType: "json",
                success : callback
            });
        }
    }
})();
