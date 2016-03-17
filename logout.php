<?php

if(isset($_COOKIE['loggedIn'])){
    setcookie('loggedIn',"",1,'/');
}
session_start();
$pageTitle = "Logout";
include "header.php";
unset($_SESSION['loggedIn']);
echo "You are logged out";

session_destroy();
