/**
 * Created by umairghazi on 3/12/16.
 */

var registerFunctions = (function () {
    return {

        confirmPasswordAndRegister : function (){
            var pass    = $("#password").val();
            var rePass  = $("#confirmPassword").val();
            if(pass !== rePass){
                $(".help-block").show();
                $(".help-block").addClass("error");
                $(".help-block").html("The entered passwords don't match");
            }
            else{
                $(".help-block").hide();
                this.registerUser();
            }
        },

        registerUser: function () {
            var email      = $("#email").val();
            var password   = $("#password").val();
            var firstName  = $("#firstName").val();
            var lastName   = $("#lastName").val();
            this.registerAjax(email,password,firstName,lastName);
        },

        registerAjax : function(email,password,firstName,lastName){
            ajaxFunctions.ajaxCall("GET","php/registerService.php",{data:email +"|"+password +"|"+ firstName +"|"+ lastName },this.registerCallback);
        },

        registerCallback : function(jsonObj){
            console.log(jsonObj);
            if(jsonObj.registerStatus == true){
                $(".help-block").show();
                $(".help-block").removeClass('error');
                $(".help-block").addClass("success");
                $(".help-block").html("User registered successfully. Redirecting in 3 seconds or please <a href='login.php'>login</a> to continue");
                setTimeout(function(){location.href="login.php"} , 3000);
            } else if(jsonObj.userExists == true){
                $(".help-block").show();
                $(".help-block").addClass("error");
                $(".help-block").html("Email already exists. Please choose a different email to register");
            } else if(jsonObj.fieldEmpty == true){
                $(".help-block").show();
                $(".help-block").addClass("error");
                $(".help-block").html("You are required to fill in all the data");
            }
        }
    }

})();