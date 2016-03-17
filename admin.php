<?php

session_start();
$pageTitle = "Admin";
include("header.php");
if (!isset($_SESSION['role'])) {  //Initialize session variable to avoid no index error
    $_SESSION['role'] = "";
}
if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] != "admin") { //if the user role is not admin, then print follwing message
    echo "You need to log in as administrator to access this page. Please logout and log back in again as administrator.";
    exit();
}
//   Pagination logic.
$limit = 4;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $_GET['page'] = 1;
    $page = 1;
}
$start_from = ($page - 1) * $limit;
$products = $db->prodsForPagination($start_from, $limit);
$pr = $db->getAllProducts();


?>

<!--Page title area-->
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Admin options</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="col-lg-10">
            <div class="product-content-right">
                <div class="woocommerce">
                    <a href="addNew.php" class="btn btn-warning">Add New Product</a>
                    <table cellspacing="0" class="shop_table cart">
                        <thead>
                        <tr>
                            <th class="product-remove">Product Name</th>
                            <th class="product-remove">Product Quantity</th>
                            <th class="product-thumbnail">Product Model</th>
                            <th class="product-name">Image</th>
                            <th class="product-price">Product Price</th>
                            <th class="product-price">Discount (%)</th>
<!--                            <th class="product-quantity">Product Description</th>-->
                            <th class="product-subtotal">Product URL</th>
                            <th class="product-subtotal">Edit</th>
                            <th class="product-subtotal">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Print all the products in a table -->
                        <?php
                        foreach ($products as $product) {
                            ?>
                            <tr class="cart_item" id="cart-item<?php echo $product['prod_id']; ?>">
                                <!--                                <td class="product-remove">-->
                                <!--                                    <a title="Remove this item" class="remove" href="" data-prod-id="-->
                                <?php //echo $product['prod_id'] ?><!--"onclick="adminFunctions">×</a>-->
                                <!--                                </td>-->

                                <td class="product-name">
                                    <a href="singleProduct.php?prod_id=<?php echo $product['prod_id']; ?>"><?php echo $product['prod_name']; ?></a>
                                </td>
                                <td class="product-quantity">
                                    <?php echo $product['prod_quantity']; ?>
                                </td>
                                <td class="product-model">
                                    <?php echo $product['prod_model']; ?>
                                </td>
                                <td class="product-thumbnail">
                                    <a href="singleProduct.php?prod_id=<?php echo $product['prod_id']; ?>"><img
                                            width="145" height="145"
                                            alt="poster_1_up"
                                            class="shop_thumbnail"
                                            src="<?php echo $product['prod_image']; ?>"></a>
                                </td>
                                <td class="product-price">
                                    <?php echo $product['prod_price']; ?>
                                </td>
                                <td class="product-discount">
                                    <?php echo $product['prod_discount']; ?>
                                </td>
<!--                                <td class="product-description">-->
<!--                                    --><?php //echo $product['prod_description']; ?>
<!--                                </td>-->
                                <td class="product-url">
                                    <?php echo $product['prod_url']; ?>
                                </td>
                                <td><a data-pid="<?php echo $product['prod_id'] ?>" class="editProduct btn btn-info"
                                       href="editProduct.php?pid=<?php echo $product['prod_id'] ?>">Edit</a></td>

                                <td><a data-pid="<?php echo $product['prod_id'] ?>" class="deleteProduct btn btn-warning"
                                       href="#">Remove</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                    <?php
                    //Pagination ul li items to allow particular page selection
                    $total_records = count($pr);
                    $total_pages = ceil($total_records / $limit);
                    $pagLink = "<ul class='pagination'>";
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($_GET['page'] == $i) {
                            $pagLink .= "<li class = 'active'><a href='admin.php?page=" . $i . "'>" . $i . "</a></li>";
                        } else {
                            $pagLink .= "<li><a href='admin.php?page=" . $i . "'>" . $i . "</a></li>";
                        }
                    };
                    echo $pagLink . "</ul>";
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php" ?>


