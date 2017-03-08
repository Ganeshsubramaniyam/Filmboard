<?php
if(session_id() == '')
{
    session_start();
}
$_SESSION["currentpage"] = "Videos.php";
$_SESSION["pagecategory"]="Videos";
include 'Master_Page_Sub.php';

$_SESSION["videocount"] = "50";

if(isset($_SESSION["videoplaylistid"]) == false)
{
    $_SESSION["videoplaylistid"]="Song";
}
if (isset($_GET["search"]) == true) {
    $obj1 = new Main_Controller();
    echo $obj1->getVideos($_GET["search"],0);
}
else {
    $obj1 = new Main_Controller();
    echo $obj1->getVideos("",0);
}

include 'Master_Page_footer.php';
?>
