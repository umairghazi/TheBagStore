<?php

session_start();
$pageTitle = "All Products";
include("header.php");

//Pagination logic
$limit = 4;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $_GET['page'] = 1;
    $page = 1;
}
$start_from = ($page - 1) * $limit;
$products = $db->nonSaleProductsForPagination($start_from, $limit);
$pr = $db->getNonSaleProducts();
?>


<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>All Products</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="container">
        <div class="row">

            <?php
            foreach ($products as $product) {
                echo '<div class="col-md-3 col-sm-6">
                                <div class="single-shop-product">
                                    <div class="product-upper">
                                         <img src=' . $product["prod_image"] . ' alt="">
                                    </div>
                                    <h2><a href="singleProduct.php?prod_id=' . $product["prod_id"] . ' "> ' . $product["prod_name"] . '</a></h2>
                                    <div class="product-carousel-price">
                                    <ins>$'. $product["prod_price"] . '</ins><del></del>
                                    <span id="'.$product["prod_id"].'"><span id="items-left">'.$product["prod_quantity"].'</span> items left in inventory</span>
                                    </div>
                                    <div class="product-option-shop">
                                        <button data-prod-id="'.$product["prod_id"]. '" class="add_to_cart_button" onclick="cartFunctions.addToCart(this); cartFunctions.getItemsLeftFromCart(this);">Add to cart</button>
                                    </div>
                                </div>
                              </div>';
            }
            ?>
        </div>
    </div>
</div>


<?php

$total_records = count($pr);
$total_pages = ceil($total_records / $limit);
$pagLink = "<ul class='pagination'>";
for ($i = 1; $i <= $total_pages; $i++) {
    if ($_GET['page'] == $i) {
        $pagLink .= "<li class = 'active'><a href='allProducts.php?page=" . $i . "'>" . $i . "</a></li>";
    } else {
        $pagLink .= "<li><a href='allProducts.php?page=" . $i . "'>" . $i . "</a></li>";
    }
};
echo $pagLink . "</ul>";
?>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Login to access/add items to cart</h4>
            </div>
            <div class="modal-body">
                <p>You are not logged in. Please <a href="login.php">login</a> to add items to cart.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" id="noMoreItemsModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">No more items</h4>
            </div>
            <div class="modal-body">
                <p>There are no more items left in the stock.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php include "footer.php" ?>
</body>
</html>