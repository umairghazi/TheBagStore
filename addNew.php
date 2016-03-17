<?php
/**
 * Created by IntelliJ IDEA.
 * User: umairghazi
 * Date: 3/15/16
 * Time: 11:10 PM
 */

session_start();
$pageTitle = "Add New Product";
include("header.php");
include("php/generalUtils.php");
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = "";
}
if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] != "admin") {
    echo "You need to log in as administrator to access this page. Please logout and log back in again as administrator.";
    exit();
}

if($_POST) {
    $msg = '';
    $resArr = array();
    $resArr['items'] = array();
    $arr = array();
    if (isset($_POST["submit"])) {
        $arr = $_POST;
        $keyVals = array("products_quantity:i", "products_model",
            "products_price:d", "products_discount:i:ex",
            "products_name", "products_description",
            "products_url");
        $resArr = checkArrValues($keyVals, $_POST);

    }
    if (!$resArr['resultBol']) {

        $msg .= "Validations Failed";
    } else {
        /* Sale Item Constraint */
        $insertCons = true;
        if (intval($_POST['products_discount']) > 0) {
            $saleItems = count($db->getSaleItems());
            if ($saleItems >= 5) {
                $msg .= "Sale Items Can't be more than 5.Reduce Discount to 0";
                $insertCons = false;
            }

        }
        /* Sale Item Constraint End */
    }
    if ($insertCons = true) {
        $id = $db->insertNewItem($_POST, $_FILES);
            if (intval($id) > -1) {
            $msg .= "Product inserted successfully";
        }else {
            $msg .= "Something wrong at Inserted id:" . $id;
        }

    }
    echo $msg;
}

?>

<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Insert Product</legend>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_name">Product Name</label>
                        <div class="controls">
                            <input id="products_name" name="products_name" type="text" placeholder="Product Name"
                                   class="input-xlarge" value="">
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_model">Product Model</label>
                        <div class="controls">
                            <input id="products_model" name="products_model" type="text" placeholder="Model Number"
                                   class="input-xlarge" value="">
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_quantity">Product Quantity</label>
                        <div class="controls">
                            <input id="products_quantity" name="products_quantity" type="text"
                                   placeholder="Product Quantity" class="input-xlarge" required="" value="">
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_price">Product Price</label>
                        <div class="controls">
                            <input id="products_price" name="products_price" type="text" placeholder="Product Price"
                                   class="input-xlarge" required="" value="">
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_discount">Product Discount</label>
                        <div class="controls">
                            <input id="products_discount" name="products_discount" type="text"
                                   placeholder="Product Discount" class="input-xlarge" value="">
                            <p class="help-block"></p>
                        </div>
                    </div>


                    <!-- Textarea -->
                    <div class="control-group">
                        <label class="control-label" for="products_description">Product Description</label>
                        <div class="controls">
                            <textarea id="products_description" name="products_description"></textarea>
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <!-- Prepended text-->
                    <div class="control-group">
                        <label class="control-label" for="products_url">Product Url</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">http://</span>
                                <input id="products_url" name="products_url" class="input-xlarge"
                                       placeholder="Product Url" type="text" required="" value="">
                                <p class="help-block"></p>
                            </div>

                        </div>
                    </div>

                    <!-- File Button -->
                    <div class="control-group">
                        <label class="control-label" for="products_image">Product Image</label>
                        <div class="controls">
                            <input id="products_image" name="products_image" class="input-file" type="file"/>
                            <p class="help-block"></p>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="control-group">
                        <label class="control-label" for="submit"></label>
                        <div class="controls">
                            <button id="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>
</div>
