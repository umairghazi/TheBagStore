<?php

session_start();
$pageTitle = "Shopping cart";
include("header.php");
if (!isset($_SESSION['loggedIn'])) {
    echo "You need to logged in to check your cart items.";
    exit();
}

    $cartItems = $db->getAllCartItemDetails($userEmail);
    $finalAmount = "";

?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="col-md-12">
            <div class="product-content-right">
                <div class="woocommerce">
                    <table cellspacing="0" class="shop_table cart">
                        <thead>
                        <tr>
                            <th class="product-remove">Remove</th>
                            <th class="product-thumbnail">Image</th>
                            <th class="product-name">Product</th>
                            <th class="product-price">Price</th>
                            <th class="product-price">Discounted Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-subtotal">Total</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        foreach ($cartItems as $cartItem) {
                            $actualPrice = $cartItem['prod_price'];
                            $discount = $cartItem['prod_discount'];
                            $disPrice = $actualPrice - ($actualPrice * ($discount / 100));
                            $finalAmount += $cartItem['prod_quantity'] * $disPrice;
                            ?>
                            <tr class="cart_item" id="cart-item<?php echo $cartItem['prod_id']; ?>">
                                <td class="product-remove">
                                    <a title="Remove this item" class="remove" href="" data-prod-id="<?php echo $cartItem['prod_id'] ?>"onclick="cartFunctions.removeFromCart(this)">×</a>
                                </td>

                                <td class="product-thumbnail">
                                    <a href="singleProduct.php?prod_id=<?php echo $cartItem['prod_id']; ?>"><img width="145" height="145"
                                                                     alt="poster_1_up"
                                                                     class="shop_thumbnail"
                                                                     src="<?php echo $cartItem['prod_image']; ?>"></a>
                                </td>

                                <td class="product-name">
                                    <a href="singleProduct.php?prod_id=<?php echo $cartItem['prod_id']; ?>"><?php echo $cartItem['prod_name']; ?></a>
                                </td>

                                <td class="product-price">
                                    <span class="amount"><?php echo $actualPrice; ?></span>
                                </td>

                                <td class="product-price">
                                    <span class="amount"><?php echo $disPrice; ?></span>
                                </td>

                                <td class="product-quantity">
                                    <div class="quantity buttons_added">
                                        <p><?php echo $cartItem['prod_quantity']; ?></p>
                                    </div>
                                </td>

                                <td class="product-subtotal">
                                    <span class="amount">$<?php echo $cartItem['prod_quantity'] * $disPrice ?></span>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                    <div class="cart_totals ">
                        <h2>Cart Totals</h2>

                        <table cellspacing="0">
                            <tbody>

                            <tr class="order-total">
                                <th>Order Total</th>
                                <td><strong><span class="amount"></span></strong>$<?php echo $finalAmount; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                <button class="btn btn-danger" onclick="cartFunctions.emptyCart()">Empty cart</button>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include "footer.php" ?>

</body>
</html>