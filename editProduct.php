<?php


session_start();
$pageTitle = "Edit Product";
include("header.php");
include("php/generalUtils.php");
if (!isset($_SESSION['role'])) {  //Initialize session variable to avoid no index error
    $_SESSION['role'] = "";
}
if (!isset($_SESSION['loggedIn']) || $_SESSION['role'] != "admin") { //if the user role is not admin, then print follwing message
    echo "You need to log in as administrator to access this page. Please logout and log back in again as administrator.";
    exit();
}



$msg='';
$resArr = array();
$resArr['items'] = array();

if(!isset($_GET['pid']))
{

    die("No value Passed");
}

$arr = $db->getSingleProduct($_GET['pid']);
$arr = $arr[0];

if(empty($arr)){
    die("Wrong Id Passed!");
}

if(isset($_POST["submit"])) {
    $keyVals = array("prod_quantity:i", "prod_model",
        "prod_price:d", "prod_discount:i:ex",
        "prod_name", "prod_description",
        "prod_url");

//    $resArr = checkArrValues($keyVals, $_POST);
//    if (!$resArr['resultBol']) {
//        $msg .= "Validations Failed";
//    } else {
        $keys = array_keys($_POST);//to correct
        unsetByVal($keys, 'submit');

        $items = array();

        foreach ($keys as $key) {
            $items[$key] = $_POST[$key];
        }

        $pid['key'] = 'prod_id';
        $pid['value'] = $_GET['pid'];
        $insertCons = true;
        $saleIt = $db->getSaleItems();
        $saleItems = $saleIt['count'];

        if (intval($_POST['prod_discount']) > 0) {
            if ($saleItems == 5) {
                $msg .= "Sale Items Can't be more than 5. Reduce Discount to 0";
                $insertCons = false;
            }

        } else {
            if ($saleItems == 3) {
                $msg .= "Sale Items Can't be less than 3. Can't set Discount to 0";
                $insertCons = false;
            }
        }
        /* Sale Item Constraint End */


        if ($insertCons) {
            $i = $db->editProduct($items, $_FILES, $pid);
            if (intval($i) < -1)
            $msg .= "Something wrong at :" . $i;
        }


    echo $msg;
}
?>

<?php
    $product = $db->getSingleProduct($_GET['pid']);
    $product = $product[0];
?>


<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <form class="form-horizontal" action="" method="post" enctype= "multipart/form-data">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Edit Product</legend>


                            <input type="hidden" id="products_id" name="prod_id" type="text" placeholder="Product Id" class="input-xlarge"  value="<?php echo $product['prod_id'];  ?>">

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_name">Product Name</label>
                        <div class="controls">
                            <input id="products_name" name="prod_name" type="text" placeholder="Product Name" class="input-xlarge"  value="<?php echo $product['prod_name'];  ?>">
                            <p class="help-block"><?php echo $product['prod_name'];  ?></p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_model">Model Number</label>
                        <div class="controls">
                            <input id="products_model" name="prod_model" type="text" placeholder="Model Number" class="input-xlarge" value="<?php echo $product['prod_model'];  ?>">
                            <p class="help-block"><?php echo $product['prod_model'];  ?></p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_quantity">Product Quantity</label>
                        <div class="controls">
                            <input id="products_quantity" name="prod_quantity" type="text" placeholder="Product Quantity" class="input-xlarge" required="" value="<?php echo $product['prod_quantity'];  ?>">
                            <p class="help-block"><?php echo $product['prod_quantity'];  ?></p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_price">Product Price</label>
                        <div class="controls">
                            <input id="products_price" name="prod_price" type="text" placeholder="Product Price" class="input-xlarge" required="" value="<?php echo $product['prod_price'];  ?>">
                            <p class="help-block"><?php echo $product['prod_price'];  ?></p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="products_discount">Product Discount</label>
                        <div class="controls">
                            <input id="products_discount" name="prod_discount" type="text" placeholder="Product Discount" class="input-xlarge" value="<?php echo $product['prod_discount'];  ?>">
                            <p class="help-block"><?php echo $product['prod_discount'];  ?></p>
                        </div>
                    </div>


                    <!-- Textarea -->
                    <div class="control-group">
                        <label class="control-label" for="products_description">Product Description</label>
                        <div class="controls">
                            <textarea id="products_description" name="prod_description"><?php echo $product['prod_description'];  ?></textarea>
                            <p class="help-block"><?php echo $product['prod_description'];  ?></p>
                        </div>
                    </div>

                    <!-- Prepended text-->
                    <div class="control-group">
                        <label class="control-label" for="products_url">Product Url</label>
                        <div class="controls">
                            <div class="input-prepend">
                                <span class="add-on">http://</span>
                                <input id="products_url" name="prod_url" class="input-xlarge" placeholder="Product Url" type="text" required="" value="<?php echo $product['prod_url'];  ?>">
                                <p class="help-block"><?php echo $product['prod_url'];  ?></p>
                            </div>

                        </div>
                    </div>

                    <!-- File Button -->
                    <div class="control-group">
                        <label class="control-label" for="products_image">Product Image</label>
                        <div class="controls">
                            <input id="products_image" name="prod_image" class="input-file" type="file" />
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

