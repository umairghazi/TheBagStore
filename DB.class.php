<?php


class DB
{

    public $connection;

    function __construct()
    {
        require_once("dbInfo.php");
        $this->connection = new mysqli($host, $user, $pass, $db);
        $this->connection->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
        if ($this->connection->connect_error) {
            echo "connection failed " . mysqli_connect_error();
            die();
        }
    }

    function getAllProducts()
    {
        $data = array();
        if ($stmt = $this->connection->prepare("select * from products")) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pr_id, $pr_quantity, $pr_model, $pr_image, $pr_price, $pr_discount, $pr_ordered, $pr_name, $pr_description, $pr_url, $pr_viewed);

            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data[] = array("prod_id" => $pr_id,
                        "prod_quantity" => $pr_quantity,
                        "prod_model" => $pr_model,
                        "prod_image" => $pr_image,
                        "prod_price" => $pr_price,
                        "prod_discount" => $pr_discount,
                        "prod_ordered" => $pr_ordered,
                        "prod_name" => $pr_name,
                        "prod_description" => $pr_description,
                        "prod_url" => $pr_url);
                }
            }
        }
        return $data;
    }//getAllProducts

    function getNonSaleProducts()
    {
        $data = array();
        if ($stmt = $this->connection->prepare("select * from products WHERE prod_discount = 0")) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pr_id, $pr_quantity, $pr_model, $pr_image, $pr_price, $pr_discount, $pr_ordered, $pr_name, $pr_description, $pr_url, $pr_viewed);

            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data[] = array("prod_id" => $pr_id,
                        "prod_quantity" => $pr_quantity,
                        "prod_model" => $pr_model,
                        "prod_image" => $pr_image,
                        "prod_price" => $pr_price,
                        "prod_discount" => $pr_discount,
                        "prod_ordered" => $pr_ordered,
                        "prod_name" => $pr_name,
                        "prod_description" => $pr_description,
                        "prod_url" => $pr_url);
                }
            }
        }
        return $data;
    }

    function nonSaleProductsForPagination($start_from, $limit)
    {
        $data = array();
        if ($stmt = $this->connection->prepare("select * from products WHERE prod_discount = 0 ORDER BY prod_id ASC LIMIT ?,?")) {
            $stmt->bind_param("ss", $start_from, $limit);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pr_id, $pr_quantity, $pr_model, $pr_image, $pr_price, $pr_discount, $pr_ordered, $pr_name, $pr_description, $pr_url, $pr_viewed);

            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data[] = array("prod_id" => $pr_id,
                        "prod_quantity" => $pr_quantity,
                        "prod_model" => $pr_model,
                        "prod_image" => $pr_image,
                        "prod_price" => $pr_price,
                        "prod_discount" => $pr_discount,
                        "prod_ordered" => $pr_ordered,
                        "prod_name" => $pr_name,
                        "prod_description" => $pr_description,
                        "prod_url" => $pr_url);
                }
            }
        }
        return $data;
    }

    function prodsForPagination($start_from, $limit)
    {
        $data = array();
        if ($stmt = $this->connection->prepare("select * from products ORDER BY prod_id ASC LIMIT ?,?")) {
            $stmt->bind_param("ss", $start_from, $limit);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pr_id, $pr_quantity, $pr_model, $pr_image, $pr_price, $pr_discount, $pr_ordered, $pr_name, $pr_description, $pr_url, $pr_viewed);

            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data[] = array("prod_id" => $pr_id,
                        "prod_quantity" => $pr_quantity,
                        "prod_model" => $pr_model,
                        "prod_image" => $pr_image,
                        "prod_price" => $pr_price,
                        "prod_discount" => $pr_discount,
                        "prod_ordered" => $pr_ordered,
                        "prod_name" => $pr_name,
                        "prod_description" => $pr_description,
                        "prod_url" => $pr_url);
                }
            }
        }
        return $data;
    }

    function getSingleProduct($id)
    {
        $data = array();
        if ($stmt = $this->connection->prepare("select * from products WHERE prod_id = ?")) {
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pr_id, $pr_quantity, $pr_model, $pr_image, $pr_price, $pr_discount, $pr_ordered, $pr_name, $pr_description, $pr_url, $pr_viewed);

            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data[] = array("prod_id" => $pr_id,
                        "prod_quantity" => $pr_quantity,
                        "prod_model" => $pr_model,
                        "prod_image" => $pr_image,
                        "prod_price" => $pr_price,
                        "prod_discount" => $pr_discount,
                        "prod_ordered" => $pr_ordered,
                        "prod_name" => $pr_name,
                        "prod_description" => $pr_description,
                        "prod_url" => $pr_url);
                }
            }
        }
        return $data;
    }

    function getSaleProducts()
    {
        $data = array();
        if ($stmt = $this->connection->prepare("select * from products WHERE prod_discount > 0")) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pr_id, $pr_quantity, $pr_model, $pr_image, $pr_price, $pr_discount, $pr_ordered, $pr_name, $pr_description, $pr_url, $pr_viewed);

            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data[] = array("prod_id" => $pr_id,
                        "prod_quantity" => $pr_quantity,
                        "prod_model" => $pr_model,
                        "prod_image" => $pr_image,
                        "prod_price" => $pr_price,
                        "prod_discount" => $pr_discount,
                        "prod_ordered" => $pr_ordered,
                        "prod_name" => $pr_name,
                        "prod_description" => $pr_description,
                        "prod_url" => $pr_url);
                }
            }
        }
        return $data;
    }

    function saleProdsForPagination($start_from, $limit)
    {
        $data = array();
        if ($stmt = $this->connection->prepare("select * from products WHERE prod_discount > 0 ORDER BY prod_id ASC LIMIT ?,? ")) {
            $stmt->bind_param("ss", $start_from, $limit);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pr_id, $pr_quantity, $pr_model, $pr_image, $pr_price, $pr_discount, $pr_ordered, $pr_name, $pr_description, $pr_url, $pr_viewed);

            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data[] = array("prod_id" => $pr_id,
                        "prod_quantity" => $pr_quantity,
                        "prod_model" => $pr_model,
                        "prod_image" => $pr_image,
                        "prod_price" => $pr_price,
                        "prod_discount" => $pr_discount,
                        "prod_ordered" => $pr_ordered,
                        "prod_name" => $pr_name,
                        "prod_description" => $pr_description,
                        "prod_url" => $pr_url);
                }
            }
        }
        return $data;
    }


    function getAllCartItemDetails($user_email)
    {

        $data = "";
        $queryString = "SELECT user_id FROM users WHERE user_email = ?";
        if ($stmt = $this->connection->prepare($queryString)) {
            $stmt->bind_param("s", $user_email);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($user_id);
            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data = array("user_id" => $user_id);
                }
            }
        }
        $user_id = $data["user_id"];
        $cartArray = array();
        if ($stmt = $this->connection->prepare("SELECT prod_image, prod_name, prod_price, prod_discount, cart.prod_id, cart.quantity FROM products INNER JOIN cart on products.prod_id = cart.prod_id WHERE cart.user_id = ?;")) {
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pr_image, $pr_name, $pr_price, $pr_discount, $pr_id, $pr_quantity);
            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $cartArray[] = array("prod_image" => $pr_image,
                        "prod_name" => $pr_name,
                        "prod_price" => $pr_price,
                        "prod_discount" => $pr_discount,
                        "prod_quantity" => $pr_quantity,
                        "prod_id" => $pr_id);
                }
            }
        }
        return $cartArray;
    }


    function getAllCartItem($user_email)
    {

        if ($user_email == null) {
            return 0;
        }
        $user_id = "";
        if ($stmt = $this->connection->prepare("select user_id FROM users WHERE user_email = ?")) {
            $stmt->bind_param("s", $user_email);
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
        if ($stmt = $this->connection->prepare("select sum(quantity) from cart WHERE user_id = ?;")) {
            $stmt->bind_param("s", $user_id['userId']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($sumOfQuantity);
            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data[] = array("total" => $sumOfQuantity);
                }
            }
        }
        return $data;

//        $data = array();
//        if ($stmt = $this->connection->prepare("select * from cart")) {
//            $stmt->execute();
//            $stmt->store_result();
//            $stmt->bind_result($user_id, $pr_id, $quantity);
//            if ($stmt->num_rows > 0) {
//                while ($stmt->fetch()) {
//                    $data[] = array("user_id" => $user_id,
//                        "prod_id" => $pr_id,
//                        "quantity" => $quantity
//                    );
//                }
//            }
//        }
    }

    function getTotalCartAmount($user_email)
    {
        if ($user_email == null) {
            return 0;
        }
        $user_id = "";
        if ($stmt = $this->connection->prepare("select user_id FROM users WHERE user_email = ?")) {
            $stmt->bind_param("s", $user_email);
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
        if ($stmt = $this->connection->prepare("select sum(prod_price * cart.quantity) from products inner join cart on cart.prod_id = products.prod_id WHERE user_id = ?;")) {
            $stmt->bind_param("s", $user_id['userId']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($sumOfAmount);
            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data[] = array("total" => $sumOfAmount);
                }
            }
        }
        return $data;
    }

    function getSaleItems()
    {
        $data = array();
        if ($stmt = $this->connection->prepare("select count(*) FROM products WHERE prod_discount > 0")) {
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($count);
            if ($stmt->num_rows > 0) {
                while ($stmt->fetch()) {
                    $data = array("count" => $count);
                }
            }
        }
        return $data;
    }

    function insertNewItem($items, $files)
    {
        $query = "INSERT INTO products SET prod_quantity=?, prod_model=?,
		prod_image=?, prod_price=?,prod_discount=?,
		prod_ordered=0, prod_name=?, prod_description=?, prod_url=?,
		prod_viewed=0";
        $return = -1;
        if ($stmt = $this->connection->prepare($query)) {
            $fileName = '';
            include_once("php/upload_file.php");
            $stmt->bind_param("issddsss", $items['products_quantity'], $items['products_model'],
                $fileName, $items['products_price'], $items['products_discount'],
                $items['products_name'], $items['products_description'], $items['products_url']);
            if ($stmt->execute()) {
                $return = $stmt->insert_id;
            } else {
                $return = -2;
            }
            $stmt->close();

        }
        return $return;
    }

    function deleteProduct($prod_id){

        $query = "DELETE FROM cart WHERE prod_id=?";
        if ($stmt = $this->connection->prepare($query)) {
            $stmt->bind_param("s",$prod_id);
            $stmt->execute();
        }

        $query  = "DELETE FROM products WHERE prod_id=?";
        if ($stmt = $this->connection->prepare($query)) {
            $stmt->bind_param("s",$prod_id);
            if($stmt->execute()){
                return 1;
            }else{
                return -1;
            }
        }
    }



    function editProduct($items,$files,$id){
        if (count($items) > 0 ) {
            $file_name='';
            include_once 'php/upload_file.php';
        }
        $file_name = "";
        if(isset($files) && !empty($files))// Supports only one file.
        {
            foreach ($files as $key => $value) {
                if(isset($value['name']) && !empty($value['name']) && $this->isImage($value['type']) )
                {
                    $items[$key]=$file_name;
                    break;
                }
            }
        }

        $keys = array_keys($items);
        $query = 'UPDATE products SET prod_name=?, prod_model=?, prod_quantity=?, prod_price=?, prod_discount=?,
                                      prod_description=?, prod_url=? WHERE prod_id= ?';
        $numRows = "";
        if($stmt = $this->connection->prepare($query)){
            $stmt->bind_param('ssidssis',$items["prod_name"],$items["prod_model"],$items["prod_quantity"],
                $items["prod_price"],$items["prod_discount"],$items["prod_description"],$items["prod_url"],$items["prod_id"]);
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->affected_rows;
        }
        return $numRows;
    }

    function isImage($mimeType)
    {
        $allowedMimeTypes=array("image/jpeg","image/png","image/bmp","image/jpg","image/gif");

        foreach ($allowedMimeTypes as $allowedMimeType ) {
            if($mimeType==$mimeType)
            {
                return true;
            }
            return false;
        }

    }

    function refValues($arr){
        if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }

}