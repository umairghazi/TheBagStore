<?php
/**
 * Created by IntelliJ IDEA.
 * User: umairghazi
 * Date: 3/12/16
 * Time: 5:26 PM
 */


require_once("../DB.class.php");
require_once("generalUtils.php");
$data = $_REQUEST['data'];

exit(loginUser($data));

function loginUser($data) {

    list($email, $password) = explode("|", $data);
    $returnVal['validLogin'] = false;
    if(empty($email) || empty($password)){
        $returnVal['emptyVals'] = true;
        return json_encode($returnVal);
    }
    $email = sanitizeString($email);
    $password = sanitizeString($password);
    $password = sha1($password);

    $db = new DB();
    $queryString = "SELECT user_id,first_name,last_name,user_email,role FROM users WHERE user_email = ? AND password = ?";
    if ($stmt = $db->connection->prepare($queryString)) {
        $stmt->bind_param("ss", $email,$password);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id,$first_name,$last_name,$user_email,$role);
        if ($stmt->num_rows > 0) { //email and password matched
            while ($stmt->fetch()) {
                $data = array("user_id"    =>$user_id,
                              "first_name" =>$first_name,
                              "last_name"  =>$last_name,
                              "user_email" =>$user_email,
                              "role"       =>$role);
            }
//            echo $data['user_id'];

            $returnVal['validLogin'] = true;
            session_start();
            $_SESSION['loggedIn'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $data['role'];
            setcookie("loggedIn",date("F j, Y, g:i a"),0,'/');
        } else {
            $returnVal['validLogin'] = false;
            $_SESSION['loggedIn'] = false;
        }
    }
    return json_encode($returnVal);
}

