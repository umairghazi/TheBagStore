<?php
/**
 * Created by IntelliJ IDEA.
 * User: umairghazi
 * Date: 3/15/16
 * Time: 3:41 PM
 */


require_once("../DB.class.php");
$data = $_REQUEST['data'];
exit(removeItemsFromCart($data));


function removeItemsFromCart($data){
    $db = new DB();
    list($email, $prod_id) = explode("|", $data);
    $returnVal = array();
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

    $queryString = "SELECT quantity FROM cart WHERE user_id = ? AND prod_id = ?";
    if ($stmt = $db->connection->prepare($queryString)) {
        $stmt->bind_param("ss", $user_id, $prod_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($quantity);
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $quan = array("quantity" => $quantity);
            }
        }
            if ($quan['quantity'] == 0) {
            $returnVal['noItem'] = true;
        } else {
            $queryString = "DELETE FROM cart WHERE user_id = ? AND prod_id = ?";
            if ($stmt = $db->connection->prepare($queryString)) {
                $stmt->bind_param("ss", $user_id, $prod_id);
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->affected_rows;
            }
            if ($numRows > 0) {
                $returnVal['deleted'] = true;
                $returnVal['prod_id'] = $prod_id;
                if ($stmt = $db->connection->prepare($queryString)) {
                    $stmt->bind_param("ss", $quan['quantity'], $prod_id);
                    $stmt->execute();
                    $stmt->store_result();
                    $numRows = $stmt->affected_rows;
                }
            }
        }
    }
    return json_encode($returnVal);

}