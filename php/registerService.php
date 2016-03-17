<?php
/**
 * Created by IntelliJ IDEA.
 * User: umairghazi
 * Date: 3/12/16
 * Time: 12:48 PM
 */

require_once("../DB.class.php");
require_once("generalUtils.php");
$data = $_REQUEST['data'];
exit(registerUser($data));



function registerUser($data) {
    list($email, $password, $firstname, $lastname) = explode("|", $data);
    $returnVal['registerStatus'] = false;
    $returnVal['email'] = $email;
    if(empty($email) || empty($password) || empty($firstname) || empty($lastname)){
        $returnVal['fieldEmpty'] = true;
        return json_encode($returnVal);
    }
    $email = sanitizeString($email);
    $password = sanitizeString($password);
    $password = sha1($password);
    $firstname = sanitizeString($firstname);
    $lastname = sanitizeString($lastname);

    $returned = insertUser($email, $password, $firstname, $lastname);
    if ($returned == "userExists") {
        $returnVal['userExists'] = true;
    }elseif($returned > 0){
        $returnVal['registerStatus'] = true;
    }
    return json_encode($returnVal);
}

function insertUser($email, $password, $firstname, $lastname)
{
    $db = new DB();
    $queryString = "SELECT 1 FROM users WHERE user_email = ?";
    if ($stmt = $db->connection->prepare($queryString)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) { //check if a user already exists
            $returnVal = "userExists";
        } else {                   // else insert the new user into database
            $queryString = "INSERT into users (first_name,last_name,user_email,password) VALUES (?,?,?,?)";
            $numRows = "-1";
            if ($stmt = $db->connection->prepare($queryString)) {
                $stmt->bind_param("ssss", $firstname, $lastname, $email, $password);
                $stmt->execute();
                $stmt->store_result();
                $numRows = $stmt->affected_rows;
            }
            $returnVal = $numRows;
        }
        return $returnVal;
    }
}
