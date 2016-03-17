<?php
/**
 * Created by IntelliJ IDEA.
 * User: umairghazi
 * Date: 3/16/16
 * Time: 8:41 AM
 */

require_once("../DB.class.php");

$products_id = "";
$user_id = "";


if (isNotEmpty('products_id')) {
    $products_id = $_GET['products_id'];
} else {
    echo 0;
    exit(0);
}

function isNotEmpty($val)
{
    if (isset($_GET[$val]) && trim($_GET[$val]) != '') {
        return true;
    }
    return false;
}

$db = new DB();
$arr = $db->getAllProducts();
$saleItems = $db->getSaleItems();
$countOfSaleItems = $saleItems['count'];
$insertCons = true;
if (intval($arr[0]['prod_discount']) > 0) {
    if ($countOfSaleItems <= 3) {
        $insertCons = false;
    }
}

if ($insertCons) {
    echo($db->deleteProduct($products_id));
    die();
} else {
    die("-2");
}