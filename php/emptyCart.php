<?php
/**
 * Created by IntelliJ IDEA.
 * User: umairghazi
 * Date: 3/15/16
 * Time: 9:19 PM
 */


require_once("../DB.class.php");
$data = $_REQUEST['data'];

exit(emptyCart($data));
function emptyCart($email){
    $db = new DB();
    $queryString = "SELECT user_id FROM users WHERE user_email = ?";
    if ($stmt = $db->connection->prepare($queryString)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        if ($stmt->num_rows > 0) {
            while ($stmt->fetch()) {
                $result = array("user_id" => $user_id);
            }
        }
    }
    $user_id = $result['user_id'];

    $queryString = "DELETE FROM cart WHERE user_id = ?";
    if ($stmt = $db->connection->prepare($queryString)) {
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->affected_rows;
        }
    $returnVal["deleted"] = $num_rows;
    return json_encode($num_rows);
}

