<?php

session_start();

if (!isset($_GET['prod_id'])) {
    header("Location:index.php");
}
$pageTitle = "Product Info";
include("header.php");

$product = $db->getSingleProduct($_GET['prod_id']);
$actualPrice = $product[0]['prod_price'];
$discount = $product[0]['prod_discount'];
$disPrice = $actualPrice - ($actualPrice * ($discount / 100));
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2><?php echo $product[0]['prod_name']; ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="product-images">
                    <div class="product-main-img">
                        <img src="<?php echo $product[0]['prod_image']; ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="product-inner">
                    <h2 class="product-name"><?php echo $product[0]['prod_model'] . " " . $product[0]['prod_name']; ?></h2>
                    <div class="product-inner-price">
                        <?php if ($discount == 0) {
                            echo "<ins>$" . $actualPrice . "</ins>";
                        } else {
                            echo "<ins>$" . $disPrice . "</ins> <del>$" . $actualPrice . "</del>";
                        } ?>
                    </div>

                    <button class="add_to_cart_button" type="submit" data-prod-id="<?php echo $_GET['prod_id']; ?>"
                            onclick="cartFunctions.addToCart(this); cartFunctions.getItemsLeftFromCart(this)">Add to cart
                    </button>


                    <div role="tabpanel">
                        <ul class="product-tab" role="tablist">
                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                                      data-toggle="tab">Description</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                <h2>Product Description</h2>
                                <p><?php echo $product[0]['prod_description']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
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