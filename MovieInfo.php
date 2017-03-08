<?php
if (session_id() == '') {
    session_start();
}
$_SESSION["pagecategory"] = "Moviesinfo";
if(isset($_GET["movieid"]))
{
    $_SESSION["currentpage"] = "MovieInfo.php?movieid=".$_GET["movieid"];
}
else
{
    $_SESSION["currentpage"] = "MovieInfo.php";
}

include 'Master_Page_Sub.php';
?>
<div class="col-sm-12" id='signuppageform'>
    <h2 class="noSubtitle">Movie Info</h2>
</div>
<?php
if(isset($_GET["movieid"]))
{
    $_SESSION["movieid"]=$_GET["movieid"];
    $movieobj=new Main_Controller();
    echo $movieobj->fetchmovieinfo($_GET["movieid"]);
}
else
{
?>
<div class="col-sm-12">
    <form onsubmit="javascript:searchmovies();return false;">
        <div class="col-sm-10"><input type="text" id="moviename" class="form-control" placeholder="Enter any Movie Name." /></div>
        <div class="col-sm-2"><input type="submit" onclick="javascript:searchmovies();return false;" value="Search" class="btn-sm nopadding" /></div>
    </form>
</div>
<div class="clearfix"></div>
<br />
<br />
<div class="col-sm-12" id="moviesearchresults">
    
</div>
<?php
}
include 'Master_Page_footer.php';
?>