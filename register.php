<?php

session_start();
if(isset($_SESSION['userId'])){

} else {
}
$pageTitle = "Sign Up";
include "header.php";
?>


<div class="container" xmlns="http://www.w3.org/1999/html">
    <div class="row">
        <div id="login-form-wrap">
            <form>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" ">
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" >
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" >
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" >
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password" >
                </div>
                <div class="form-group">
                    <p class="help-block"></p>
                </div>
                <button type="button" class="btn btn-default" id="submitButton" onclick="registerFunctions.confirmPasswordAndRegister();">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php
    include "footer.php";
?>
<script>
    $(document).ready(function(){
        $("#email").focus();
    });
</script>
