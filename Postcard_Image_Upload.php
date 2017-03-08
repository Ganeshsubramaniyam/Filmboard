<?php
include 'Main_Controller.php';
session_start();
$output_dir = "other data/Images/";
if (isset($_FILES["file"])) {
    $ret = array();
    $albumid=$_SESSION["postid"];
    $trackinsertobj=new Main_Controller();
    $error = $_FILES["file"]["error"];
    if (!is_array($_FILES["file"]["name"])) { //single file
        $fileName = $_FILES["file"]["name"];
        $key = '';
            $keys = array_merge(range(0, 9), range('a', 'z'));
            for ($i = 0; $i < 18; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $key="Post_".$key;
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["file"]["tmp_name"], $output_dir . $key.".".$ext);
        $ret[] = $fileName;
        //echo $trackinsertobj->InsertTrackInfo($key,$fileName,$albumid,0);
    }
}
?>