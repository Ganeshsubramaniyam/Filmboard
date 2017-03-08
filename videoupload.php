<?php
if (isset($_SESSION["userid"]) == false) {
    session_start();
}
ini_set('upload_max_filesize', '1024M');
ini_set('post_max_size', '1024M');
ini_set('max_input_time', 18000);
ini_set('max_execution_time', 18000);

$fileName = $_FILES["videodata"]["name"]; // The file name
$fileTmpLoc = $_FILES["videodata"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["videodata"]["type"]; // The type of file it is
$fileSize = $_FILES["videodata"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["videodata"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button.";
    exit();
}
$key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < 18; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    
$ext = pathinfo($fileName, PATHINFO_EXTENSION);
if(isset($_SESSION["postcardvideo"]))
    {
        $_SESSION["postcardvideo"]=$key.".".$ext;
    }
if(move_uploaded_file($fileTmpLoc, "other data/video songs/".$key.".".$ext)){
    $ageval=$_POST["agerestrict"];
    if($ageval=="18p")
    {
        $age=1;
    }
    else 
    {
        $age=0;    
    }
    $imgdata=$_POST["imagedat"];  
    $file = $key. '.png';
    // remove "data:image/png;base64,"
    $uri = substr($imgdata,strpos($imgdata,",")+1);
    // save to file
    file_put_contents($file, base64_decode($uri));
    
    $sql="insert into videolist(VideoId,VideoName,ImagePrint,MovieorAlbum,StarCast,VideoType,ReleaseYear,AgeRestrict,Language,UploadedBy,UploadedDate,NoOfHits,NoOfLikes,NoOfComments,NoOfShares,NoOfDownloads) values(:videoid,:videoname,:image,:moviename,:startc,:videotype,:releaseyear,:age,:lang,:upby,:updat,:nohits,:nolikes,:nocom,:noshare,:nodown)";
    $defaulval=0;
    include 'datafetch.php';
    $objec=new datafetch();
    // INSERT with named parameters
    $conn = new PDO("mysql:host=$objec->dbserver;dbname=$objec->dbname", "$objec->username", "$objec->password");
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(":videoid",$key);
    $stmt->bindValue(":videoname",$_POST["videoname"]);
    $stmt->bindValue(":image",file_get_contents($file));
    $stmt->bindValue(":moviename",$_POST["moviealbumname"]);
    $stmt->bindValue(":startc",$_POST["starcast"]);
    $stmt->bindValue(":videotype",$_POST["videotype"]);
    $stmt->bindValue(":releaseyear",$_POST["releaseyear"]);
    $stmt->bindValue(":age",$age);
    $stmt->bindValue("lang",$_POST["lang"]);
    $stmt->bindValue(":upby",$_SESSION["userid"]);
    $stmt->bindValue(":updat",date("Y-m-d h:i:sa"));
    $stmt->bindValue(":nohits",$defaulval);
    $stmt->bindValue(":nolikes",$defaulval);
    $stmt->bindValue(":nocom",$defaulval);
    $stmt->bindValue(":noshare",$defaulval);
    $stmt->bindValue(":nodown",$defaulval);
    $stmt->execute();
    $affected_rows = $stmt->rowCount();
    unlink($file);
    if($affected_rows>0)
    {
        echo "$fileName upload is complete. <br /><br /><p> The Video is sent to the Support Team for Approval.</p>";
    }
    else 
    {
        echo "Video Upload has got failed. Please try after few Mins.";
    }
    
} else {
    echo "Video Upload has got failed. Please try after few Mins.";
}
?>