<?php
include 'Main_Controller.php';
session_start();
$output_dir = "other data/Audio Files/";
if (isset($_FILES["myfile"])) {
    $ret = array();
    $albumid=$_SESSION["musicalbumid"];
    $trackinsertobj=new Main_Controller();
//	This is for custom errors;	
    /* 	$custom_error= array();
      $custom_error['jquery-upload-file-error']="File already exists";
      echo json_encode($custom_error);
      die();
     */
    
    $error = $_FILES["myfile"]["error"];
    //You need to handle  both cases
    //If Any browser does not support serializing of multiple files using FormData() 
    if (!is_array($_FILES["myfile"]["name"])) { //single file
        $fileName = $_FILES["myfile"]["name"];
        $key = '';
            $keys = array_merge(range(0, 9), range('a', 'z'));
            for ($i = 0; $i < 18; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $key.".".$ext);
        $ret[] = $fileName;
        echo $trackinsertobj->InsertTrackInfo($key,$fileName,$albumid,0);
    } else {  //Multiple files, file[]
        $fileCount = count($_FILES["myfile"]["name"]);
        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES["myfile"]["name"][$i];
            $key = '';
            $keys = array_merge(range(0, 9), range('a', 'z'));
            for ($i = 0; $i < 18; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $key.".".$ext);
            $ret[] = $fileName;
            echo $trackinsertobj->InsertTrackInfo($key,$fileName,$albumid,0);
        }
    }
    //echo json_encode($ret);
}
?>