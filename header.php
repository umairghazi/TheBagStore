<?php

//use user email to fetch user id from database to manage sessions
$userEmail = "";
if (isset($_SESSION['email'])) {
    $userEmail = $_SESSION['email'];
} else {
    $userEmail = null;
}

//include db class for db functions
include("DB.class.php");
$db = new DB();
$countOfAllItems = count($db->getNonSaleProducts());
$countOfSaleItems = count($db->getSaleProducts());
$countOfCrIt = $db->getAllCartItem($userEmail);
$countOfCartItem= $countOfCrIt[0]['total'];
$totalAmountIC = $db->getTotalCartAmount($userEmail);
$totalAmountInCart= $totalAmountIC[0]['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-16">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle ?></title>

    <!--     Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet'
          type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--  Setting global javascript var called email which will be used to make ajax calls for database queries involving current user      -->

    <script>
        <?php if (isset($_SESSION['loggedIn'])) {
            $email = $_SESSION['email'];
            echo "var logged_in=true;";
            echo "var email =  '$email';";
        } else {
            echo "var logged_in=false;";
        }
        ?>
    </script>

</head>
<body>

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">

        <!--    The global header is printed dynamically with below code                -->
        <!--    The cart quantities and total values are printed through below code     -->
        <!--    If user is logged in, the header will show logout option and vice-versa -->

                    <?php
                    printLink("Home", "index.php");
                    printLink("Catalog (" . $countOfAllItems . ")", "allProducts.php");
                    printLink("On Sale (" . $countOfSaleItems . ")", "onSale.php");
                    printLink("About", "about.php");
                    printLink("Sign Up", "register.php");
                    printcart("Cart", "cart.php", $countOfCartItem, $totalAmountInCart);
                    printLink("Admin", "admin.php");
                    if (isset($_SESSION['loggedIn'])) {
                        printLink("Logout", "logout.php");
                    }else{
                        printLink("Login","login.php");
                    }
                    ?>
                </ul>
            </div>


            <?php

            function printCart($name, $href, $countOfCartItems, $totalAmount)
            {
                echo "<li ";
                if (checkCurrentLocation($href)) {
                    echo 'class = "active"';
                }
                echo ">";
                echo '<a ';
                if (checkCurrentLocation($href)) {
                    echo 'class = "active"';
                }
                echo ' href="' . $href . '">' . $name . ' - <span class="cart-amunt">$'. $totalAmount .'</span>
                            <i class="fa fa-shopping-cart"></i><span class="cart-quantity">
                            ' . $countOfCartItems . ' items</span></a></li>';
            }

            function printLink($name, $href)
            {
                echo "<li ";
                if (checkCurrentLocation($href)) {
                    echo 'class = "active"';
                }
                echo ">";

                echo '<a ';
                if (checkCurrentLocation($href)) {
                    echo 'class = "active"';
                }
                echo ' href="' . $href . '">' . $name . '</a></li>';
            }
//            If the page is current, then add a class to li to apply style to reflect current page
            function checkCurrentLocation($match)
            {
                if (strpos($_SERVER["SCRIPT_NAME"], $match) === false) {
                    return false;
                }
                return true;
            }

            ?>

        </div>
    </div>
</div>
