/**
 * Created by umairghazi on 3/12/16.
 */


var loginFunctions = (function () {
    return {

        loginUser: function () {
            var email      = $("#email").val();
            var password   = $("#password").val();
            this.loginAjax(email,password);
        },

        loginAjax : function(email,password){
            ajaxFunctions.ajaxCall("GET","php/loginService.php",{data:email +"|"+password},this.loginCallback);
        },

        loginCallback : function(jsonObj){
            if(jsonObj.validLogin == true){
                window.location = "index.php";
            } else if(jsonObj.validLogin == false && jsonObj.emptyVals == true){
                    $(".help-block").show();
                    $(".help-block").addClass("error");
                    $(".help-block").html("Please enter both username and password");
            } else{
                $(".help-block").show();
                $(".help-block").addClass("error");
                $(".help-block").html("Email/Password is incorrect");
            }
        }
    }

})();