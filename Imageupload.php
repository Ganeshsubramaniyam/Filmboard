<?php

include 'Main_Controller.php';
session_start();
$output_dir = "Other Data/Images/";
if (isset($_FILES["file"])) {
    $ret = array();
    $error = $_FILES["file"]["error"];
    if (!is_array($_FILES["file"]["name"])) { //single file
        $fileName = $_FILES["file"]["name"];
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
        for ($i = 0; $i < 18; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if($_SESSION["postcardimages"]=="")
        {
            $_SESSION["postcardimages"] = $key . "." . $ext;
        }
        else
        {
            $_SESSION["postcardimages"] = $_SESSION["postcardimages"] . "," . $key . "." . $ext;
        }
        
        $key = "Post_Img_" . $key;


        move_uploaded_file($_FILES["file"]["tmp_name"], $output_dir . $key . "." . $ext);
        $_SESSION['CardUploads'] = $key;
    }
}
?>