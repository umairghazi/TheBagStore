/**
 * Created by umairghazi on 3/14/16.
 */


var cartFunctions = (function () {

    return {

        addToCart:function(domEle){
            if(logged_in === false){
                $('#myModal').modal({
                   show : true
                });
            }else{
                var prod_id = $(domEle).data('prod-id');
                this.addToCartAjax(email,prod_id);
            }
        },

        emptyCart: function(){
            this.emptyCartAjax(email);
        },

        emptyCartAjax: function(email){
            ajaxFunctions.ajaxCall("GET","php/emptyCart.php",{data:email},this.emptyCartCallback);
        },

        emptyCartCallback: function(jsonObj){
          console.log(jsonObj);
        },

        addToCartAjax:function(email,prod_id){
            ajaxFunctions.ajaxCall("GET","php/addToCartService.php",{data:email+"|"+prod_id},this.addToCartCallback);
        },

        addToCartCallback: function(jsonObj){
            console.log(jsonObj);
            if(jsonObj.noMoreItems == true){
                console.log("no more");
                $('#noMoreItemsModal').modal({
                    show : true
                });
            }
            if(jsonObj.addedToCart == true){
                console.log("added to cart");
            }
        },

        getItemsLeftFromCart : function (domEle) {
            var prod_id = $(domEle).data('prod-id');
            this.getItemsLeftFromCartAjax(email,prod_id);
        },

        getItemsLeftFromCartAjax: function(email,prod_id){
            ajaxFunctions.ajaxCall("GET","php/getItemsLeftService.php",{data:email+"|"+prod_id},this.getItemsLeftCallback);
        },

        getItemsLeftCallback : function(jsonObj){
            //document.getElementById("items-left").innerHTML = jsonObj.itemsLeft - 1;
            var itemsLeft = jsonObj.itemsLeft - 1;
            var prod_id = jsonObj.prod_id;
            $('#'+ prod_id).html(itemsLeft + " items left in the inventory");
            $('.cart-amunt').html("$"+jsonObj.totalAmountInCart);
            $('.cart-quantity').html(" " + jsonObj.totalQuantityInCart + " items");

        },

        removeFromCart: function(domEle){
            var prod_id = $(domEle).data('prod-id');
            this.removeFromCartAjax(email,prod_id);

        },

        removeFromCartAjax: function(email,prod_id){
            ajaxFunctions.ajaxCall("GET","php/removeFromCartService.php",{data:email+"|"+prod_id},this.removeFromCartCallback);
        },

        removeFromCartCallback:function(jsonObj){
            if(jsonObj.deleted == true){
                var prod_id = jsonObj.prod_id;
                $("#cart-item"+prod_id).remove();
            }
        }

    };

})();