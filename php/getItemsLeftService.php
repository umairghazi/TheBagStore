<?php
/**
 * Created by IntelliJ IDEA.
 * User: umairghazi
 * Date: 3/15/16
 * Time: 11:01 AM
 */

require_once("../DB.class.php");
$data = $_REQUEST['data'];

exit(getItemsLeft($data));

function getItemsLeft($data){
    $db = new DB();
    list($email, $prod_id) = explode("|", $data);
    $returnVal = "";
    $queryString = "SELECT prod_quantity FROM products WHERE prod_id = ?";
    if ($stmt = $db->connection->prepare($queryString)) {
        $stmt->bind_param("s", $prod_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($itemsLeft);
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $returnVal['itemsLeft'] = $itemsLeft;
                $returnVal['prod_id'] = $prod_id;

            }
        }
    }

    if($email == null){
        $returnVal['totalAmountInCart'] = null;
        $returnVal['totalQuantityInCart'] = null;
    }
    $user_id = "";
    if ($stmt = $db->connection->prepare("select user_id FROM users WHERE user_email = ?")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $user_id = array("userId" => $user_id);
            }
        }
    }
    $data = array();
    if ($stmt = $db->connection->prepare("select sum(prod_price * cart.quantity) from products inner join cart on cart.prod_id = products.prod_id WHERE user_id = ?;")) {
        $stmt->bind_param("s", $user_id['userId']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($sumOfAmount);
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $data = array("total" => $sumOfAmount);
            }
        }
    }
    $returnVal['totalAmountInCart'] = $data["total"];

    if ($stmt = $db->connection->prepare("select sum(quantity) from cart WHERE user_id = ?;")) {
        $stmt->bind_param("s", $user_id['userId']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($sumOfQuantity);
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $data = array("quantity" => $sumOfQuantity);
            }
        }
    }
    $returnVal['totalQuantityInCart'] = $data["quantity"];
    return json_encode($returnVal);

    }
