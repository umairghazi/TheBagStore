<?php

session_start();
$pageTitle = "login";
include "header.php";
if(isset($_SESSION['loggedIn'])){
    echo "You are already logged in";
}
else {
    ?>

    <div class="container">
        <div class="row">
            <div id="login-form-wrap">
                <form>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                               placeholder="Password">
                    </div>
                    <div class="form-group">
                        <p class="help-block"></p>
                    </div>
                    <div class="form-group">
                        <p class="info">Not a member? <a href="register.php">Register Here</a></p>
                    </div>
                    <button type="button" class="btn btn-default" onclick="loginFunctions.loginUser();">Login</button>
                </form>
            </div>
        </div>
    </div>
    <?php
}
include "footer.php";
?>
<script>
    $(document).ready(function(){
        $("#email").focus();
    });
</script>
