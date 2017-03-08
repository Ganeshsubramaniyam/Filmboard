<?php
if (session_id() == '') {
    session_start();
}
$_SESSION["currentpage"]="Radios.php";
$_SESSION["pagecategory"]="Radios";
include 'Master_Page_Sub.php';
$obj1 = new Main_Controller();
if(isset($_GET["Lang"]))
{
    echo $obj1->getRadios($_GET["Lang"]);
}
else
{
    echo $obj1->getRadios("Tamizh");
}
include 'Master_Page_footer.php';
?>