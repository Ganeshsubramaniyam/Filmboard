<?php
if(session_id()=='')
{
    session_start();
}
$_SESSION["currentpage"]="MyAccount.php?type=profileinfo";
$_SESSION["pagecategory"]="Account";
include 'Master_Page_Sub.php';
$obj1 = new Main_Controller();
if(isset($_SESSION["userid"]) == false)
{
    echo "<script>location.href='Login.php'</script>";
}
//$obj1->Loginstat();
if (isset($_SESSION["userid"]) && isset($_GET["type"]) && $_GET["type"] == "profileinfo") {
    echo $obj1->profiledetails($_SESSION["userid"]);
} 
elseif (isset($_GET["type"]) and $_GET["type"] == "myposts")
{
    echo $obj1->displayMyPostCards();
}
else
{
    echo $obj1->profiledetails($_SESSION["userid"]);
}
include 'Master_Page_footer.php';
?>