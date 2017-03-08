<?php
if (session_id() == '') {
    session_start();
}
$_SESSION["currentpage"]="Home.php";
$_SESSION["pagecategory"] = "Home";
include 'Master_Page_Sub.php';
$obj1 = new Main_Controller();
//$obj1->Loginstat();
$_SESSION["postcardimages"] = "";
$_SESSION["postcardvideo"] = "";
$_SESSION["postcardstartlimit"] = 0;
$videouploadc = $obj1->postcardvideouploadform();
?>
<div class="col-sm-12">
    <h2>Recent Posts</h2>
</div>
<div class="col-xs-12" id="postcardcontents"> 
    <?php
    if (isset($_GET["tagsearch"])) {
        echo $obj1->displayPostCards($_GET["tagsearch"], 2,0);
    } else if (isset($_GET["postid"])) {
        echo $obj1->displayPostCards($_GET["postid"], 1,0);
    } else {
        ?>
<!--    <div class="postcardleft" style="background: none !important;">
            <div class="postboxdiv">
                <div style="float: left; width: 10%;">
                    <a href="#"><img src="images/Funraaga_72x72.jpg" class="postboxprofilephoto" /> </a>
                </div>
                <div style="float: left;width: 90%;">
                    <textarea class="postbox" id="postboxtext" placeholder="Write a card for your friends..."></textarea>
                </div>
                <div class="clearfix"></div>
                <div id="photoupload" style="margin-top: 5px;">
                    <form action="Imageupload.php" class="dropzone" id="file">
                        <div class="dz-default dz-message"><span>Add Images to Uploads.</span></div>
                    </form>
                </div>
                <div class="clearfix"></div>
                <div id="videouploaddiv">
                    <?php //echo $videouploadc; ?>
                </div>
                <div class="clearfix"></div>
                <div class="linkpreviewloading" style="text-align: center">
                    <img src="images/loading.gif" width="40" height="40" />
                </div>
                <div class="linkpreview" id="linkpreview">
                    <a href="" id="linkpreviewurl">
                        <div class="linkpreviewinline">
                            <img src="" class="linkpreviewimg" id="linkpreviewimg"/>
                        </div>
                        <div class="linkpreviewtitle" id="linkpreviewtitle"></div>
                        <div class="linkpreviewdesc" id="linkpreviewdesc"></div>
                        <div class="linkpreviewsite" id="linkpreviewsite"></div>
                    </a>
                </div>

                <div class="clearfix"></div><br />

                <div class="postboxdivcontents">
                    <div class="pull-left">
                        <a href="#" class="pull-left" style="margin-right: 8px"><img src="images/add_image.png" class="postboxdivcontentsicons" onclick="showimagepanel();" /></a>
                         <a href="#" class="pull-left"><img src="images/add_video.png" class="postboxdivcontentsicons" onclick="showvideopanel();" /></a> 
                    </div>
                    <div class="pull-right"><a href="#" class="btn-sm" onclick="loadpostcontentdata();">Post Card</a></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div> 
-->

    <?php
    if(isset($_SESSION["postcardstartlimit"]))
    {
        echo $obj1->displayPostCards("", 0,$_SESSION["postcardstartlimit"]);
    }
    else
    {
        echo $obj1->displayPostCards("", 0,0);
    }
    
}
?>

</div>
    <?php
    include 'Master_Page_footer.php';
    ?>