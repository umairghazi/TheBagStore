<?php

session_start();
$pageTitle = "Home Page"; //setting page title to be used by header.php
include("header.php");
$products = $db->getAllProducts(); //get all products in products array

?>


<!--Design stuff - making page look good-->
<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo1">
                    <i class="fa fa-refresh"></i>
                    <p>30 Days return</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo2">
                    <i class="fa fa-truck"></i>
                    <p>Free shipping</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo3">
                    <i class="fa fa-lock"></i>
                    <p>Secure payments</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo promo4">
                    <i class="fa fa-gift"></i>
                    <p>New products</p>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End promo area -->

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Latest Products</h2>
                    <div class="product-carousel">
                <!--Print all the products on the index page-->
                        <?php
                            foreach ($products as $product) {
                                ?>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="<?php echo $product['prod_image'];?>" alt="">
<!--                                        <div class="product-hover">-->
<!--                                            <a href="#" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>-->
<!--                                                Add to cart</a>-->
<!--                                            <a href="product-detail.php?" class="view-details-link">-->
<!--                                                <i class="fa fa-link"></i>See details-->
<!--                                            </a>-->
<!--                                        </div>-->
                                    </div>
                                    <h3><?php echo $product['prod_model'] . " " . $product['prod_name']; ?></h3>

                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->


<?php include "footer.php"; ?>
</body>
</html>