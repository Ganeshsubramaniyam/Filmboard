<?php
if(session_id()=='')
{
    session_start();
}
$_SESSION["currentpage"]="subindex.php?videoupload=1";
include 'Master_Page_Sub.php';
$obj1 = new Main_Controller();
$obj1->Loginstat();
if (isset($_GET['videoupload'])) {
    if ($_GET['videoupload'] == 1) {
        echo $obj1->videouploadform();
    }
}
include 'Master_Page_Footer.php';
?>