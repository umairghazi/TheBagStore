<?php
/* CODE TAKEN FROM W3-SCHOOLS Updated accordingly */
date_default_timezone_set('America/New_York');

$fileName='img/none.jpg';
$msg ='';
if (isset($files["products_image"]["name"]) && !empty($files["products_image"]["name"])) {
   $target_dir = "";
   $date = new DateTime();
   $fileName = "img/".$date->getTimestamp().".".pathinfo($files["products_image"]["name"], PATHINFO_EXTENSION);
   
   $target_file = $target_dir.$fileName;
   $uploadOk = 1;
   $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
   

   // Check if image file is a actual image or fake image

   $check = getimagesize($files["products_image"]["tmp_name"]);
   if ($check !== false) {
     $msg.= " File is an image - " . $check["mime"] . ".";
     $uploadOk = 1;
  }
  else {
     $msg.= " File is not an image.";
     $uploadOk = 0;
  }

   // Check if file already exists

  if (file_exists($target_file)) {
     $msg.= " Sorry, file already exists.";
     $uploadOk = 0;
  }

   // Check file size

  if ($files["products_image"]["size"] > 500000) {
     $msg.= " Sorry, your file is too large.";
     $uploadOk = 0;
  }

   // Allow certain file formats

  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
     $msg.= " Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
     $uploadOk = 0;
  }

   // Check if $uploadOk is set to 0 by an error

  if ($uploadOk == 0) {
     $msg.= " Sorry, your file was not uploaded.";

      // if everything is ok, try to upload file

  }
  else {
   if (move_uploaded_file($files["products_image"]["tmp_name"], $target_file)) {
     $msg.= " The file " . basename($files["products_image"]["name"]) . " has been uploaded.";
  }
  else {
     $msg.= " Sorry, there was an error uploading your file.";
  }
}
}

?>