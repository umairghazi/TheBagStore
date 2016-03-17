<?php
/**
 * Created by IntelliJ IDEA.
 * User: umairghazi
 * Date: 3/14/16
 * Time: 4:32 AM
 */


require_once("../DB.class.php");
$data = $_REQUEST['data'];

exit(addToCart($data));

function addToCart($data){
    list($email, $prod_id) = explode("|", $data);
    $db = new DB();
    $queryString = "SELECT user_id FROM users WHERE user_email = ?";
    if ($stmt = $db->connection->prepare($queryString)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $data = array("user_id" => $user_id);
            }
        }
    }
    $user_id = $data['user_id'];


    $quant = array();
    $returnVal = "";
    $queryString = "SELECT prod_quantity FROM products WHERE prod_id = ?";
    if ($stmt = $db->connection->prepare($queryString)) {
        $stmt->bind_param("s", $prod_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($quantity);
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $quant = array("quantity" => $quantity);
            }
        }
        if($quant["quantity"] < 1){
            $returnVal["noMoreItems"] = true;
            return json_encode($returnVal);
        }
    }



    $queryString = "SELECT quantity FROM cart WHERE user_id = ? AND prod_id = ?";
    if ($stmt = $db->connection->prepare($queryString)) {
        $stmt->bind_param("ss", $user_id,$prod_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($quantity);
        if($stmt->num_rows > 0){
            while($stmt->fetch()){
                $quan = array("quantity"=>$quantity);
            }
        }
        if ($quan == 0) {
            $queryString = "INSERT into cart (user_id,prod_id,quantity) VALUES (?,?,1)";
            if ($stmt = $db->connection->prepare($queryString)) {
                $stmt->bind_param("ss", $user_id, $prod_id);
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->affected_rows;
            }
            if($numRows > 0){
                $returnVal['addedToCart'] = true;
                $queryString = "UPDATE products SET prod_quantity = prod_quantity - 1 WHERE prod_id = ?";
                if ($stmt = $db->connection->prepare($queryString)) {
                    $stmt->bind_param("s", $prod_id);
                    $stmt->execute();
                }
            }else{
                $returnVal['addedToCart'] = false;
            }
            return json_encode($returnVal);
        }else{
            $queryString = "UPDATE cart SET quantity = quantity + 1 WHERE user_id=? AND prod_id = ?";
            if ($stmt = $db->connection->prepare($queryString)) {
                $stmt->bind_param("ss", $user_id, $prod_id);
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->affected_rows;
            }
            if($numRows > 0){
                $returnVal['addedToCart'] = true;
                $queryString = "UPDATE products SET prod_quantity = prod_quantity - 1 WHERE prod_id=?";
                if ($stmt = $db->connection->prepare($queryString)) {
                    $stmt->bind_param("s", $prod_id);
                    $stmt->execute();
                }
            }else{
                $returnVal['addedToCart'] = false;
            }
            return json_encode($returnVal);
        }
    }
}