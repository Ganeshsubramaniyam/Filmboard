<?php
if (session_id() == '') {
    session_start();
}
$_SESSION["currentpage"] = "Downloads_View.php";
if (isset($_GET["VideoId"])) {
    $_SESSION["pagecategory"] = "Videos";
} else {
    $_SESSION["pagecategory"] = "Audios";
}
include 'Main_Controller.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="shortcut icon" href="images/favicon.ico">

        <!-- CSS | STYLE -->

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/linecons.css" />
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/colors.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="css/jplayer.blue.monday.css" rel="stylesheet" type="text/css"/>
        <!-- Scripts | Js Files -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/default.js"></script>
        <script type="text/javascript" src="js/watch.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/bootbox.js"></script>
        <script type="text/javascript" src="test.js"></script>
        <script src="js/LoadFunctions_Sub.js" type="text/javascript"></script>
        <script src="js/AnimOnScroll.js" type="text/javascript"></script>
        <script src="js/File_Upload.js" type="text/javascript"></script>
        <script src="js/Form_Validator.js" type="text/javascript"></script>
        <script src="js/autosize.min.js" type="text/javascript"></script>
        <script src="js/classie.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script src="js/masonry.pkgd.min.js" type="text/javascript"></script>
        <script src="js/watch.js" type="text/javascript"></script>
        <script src="js/modernizr.custom.js" type="text/javascript"></script>
        <script src="js/default.js" type="text/javascript"></script>
        <script src="js/modernizr-2.6.1.min.js" type="text/javascript"></script>
        <script src="js/dropzone_image_upload.js" type="text/javascript"></script>
        <script src="js/imagesloaded.js" type="text/javascript"></script>
        <script src="js/jplayer.playlist.js" type="text/javascript"></script>
        <script src="js/jquery.autosize.js" type="text/javascript"></script>
        <script src="js/jquery.hashtags.js" type="text/javascript"></script>
        <script src="js/jquery.jplayer.js" type="text/javascript"></script>

        <!-- CSS | Google Fonts -->

        <link href='http://fonts.googleapis.com/css?family=Montserrat:400' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:200,400,300,500,600' rel='stylesheet' type='text/css'>

        <noscript>
        <style>
            @media screen and (max-width: 755px) {
                .hs-content-scroller {
                    overflow: visible;
                }
            }

        </style>
        </noscript>
<?php
if (isset($_GET["AlbumId"])) {

    $obj1 = new Main_Controller();
    $result_v = $obj1->getAlbumMetaTagsInfo($_GET["AlbumId"]);
    $result = mysqli_fetch_row($result_v);
    //file_put_contents("Other Data/Images/social_$result[0]_share.jpg",$result[3]);
    echo "<!-- for Google --> ";
    echo "<meta name='description' content='$result[1] - Music Album($result[6]) Composed by $result[4]' />\n";
    echo "<meta name='keywords' content='Funraaga.in,Complete Entertainment,Radios,Videos,Music, Audios.' />\n";
    echo "<meta name='author' content='Ganesh Subramaniyam' />";
    echo "<meta name='copyright' content='Funraaga.in' />";
    echo "<meta name='thumbnail' content='http://www.funraaga.in/Other%20Data/Images/Aud_$result[0]_share.png'";
    echo "<meta name='application-name' content='Funraaga' />";

    echo "<!-- for Facebook -->";
    echo "<meta property='fb:app_id' content='1782636968639856' />";
    echo "<meta property='fb:page_id' content='608301642661332'";
    echo "<meta property='og:site_name' content='FunRaaga'>";
    echo "<meta property='og:url' content='http://www.funraaga.in/Downloads_View?AlbumId=" . $result[0] . " />";
    echo "<meta property='og:title' content='$result[1] - Music Album($result[6]) Composed by $result[4]' />";
    echo "<meta property='og:image' content='http://www.funraaga.in/Other%20Data/Images/Aud_$result[0]_share.png' />";
    echo "<meta property='og:description' content='Funraaga.in - Complete Entertainment with all Radios, Videos and Audios. ' />";
    echo "<meta property='og:type' content='video' />";

    echo "<!-- for Twitter -->";
    echo "<meta name='twitter:card' content='summary' />";
    echo "<meta name='twitter:site' content='Funraaga.in' />";
    echo "<meta name='twitter:title' content='$result[1] - Music Album($result[6]) by $result[4]' />";
    echo "<meta name='twitter:description' content='Funraaga.in - Complete Entertainment with all Radios, Videos and Audios.' />";
    echo "<meta name='twitter:image' content='http://www.funraaga.in/Other%20Data/Images/Aud_$result[0]_share.png' />";
    echo "<title>$result[1] - Music Album($result[6]) Composed by $result[4].</title>";
} elseif (isset($_GET["VideoId"])) {
    $obj1 = new Main_Controller();
    $result_v = $obj1->getMetaTagsInfo($_GET["VideoId"]);
    $result = mysqli_fetch_row($result_v);
    //file_put_contents("Other Data/Images/social_$result[0]_share.jpg",$result[3]);
    echo "<!-- for Google --> ";
    echo "<meta name='description' content='$result[2] - $result[4] - $result[6]' />\n";
    echo "<meta name='keywords' content='Funraaga.in,Complete Entertainment,Radios,Videos, Audios.' />\n";
    echo "<meta name='author' content='Ganesh Subramaniyam' />";
    echo "<meta name='copyright' content='Funraaga.in' />";
    echo "<meta name='thumbnail' content='http://www.funraaga.in/Other%20Data/Images/Vid_$result[1]_share.jpg'";
    echo "<meta name='application-name' content='Funraaga' />";

    echo "<!-- for Facebook -->";
    echo "<meta property='fb:app_id' content='1782636968639856' />";
    echo "<meta property='fb:page_id' content='608301642661332'";
    echo "<meta property='og:site_name' content='FunRaaga'>";
    echo "<meta property='og:url' content='http://www.funraaga.in/Downloads_View.php?VideoId=" . $result[1] . "' />";
    $videotype = "";
    if ($result[6] == "Song") {
        $videotype = "Video Song";
    } elseif (strstr($result[6], "Trailer")) {
        $videotype = "";
    }
    echo "<meta property='og:title' content='$result[2] - $result[4] $videotype' />";
    echo "<meta property='og:image' content='http://www.funraaga.in/Other%20Data/Images/social_share.jpg' />";
    echo "<meta property='og:description' content='Funraaga.in - Complete Entertainment with all Radios, Videos and Audios. ' />";
    echo "<meta property='og:type' content='video' />";

    echo "<!-- for Twitter -->";
    echo "<meta name='twitter:card' content='summary' />";
    echo "<meta name='twitter:site' content='Funraaga.in' />";
    echo "<meta name='twitter:title' content='$result[2] - $result[4] - $result[6]' />";
    echo "<meta name='twitter:description' content='Funraaga.in - Complete Entertainment with all Radios, Videos and Audios.' />";
    echo "<meta name='twitter:image' content='http://www.funraaga.in/Other%20Data/Images/social_share.jpg' />";
    echo "<title>$result[2] - $result[4] $result[6] - Funraaga.in - Complete Entertainment with all Radios, Videos and Audios.</title>";
}
?>
    </head>
    <body>
        <!-- Page preloader -->
        <div id="page-loader">
            <canvas id="demo-canvas"></canvas>
        </div>
        <!-- container -->
        <div id="hs-container" class="hs-container">
            <aside class="hs-menu" id="hs-menu">
                <!-- <canvas id="demo-canvas"></canvas> -->

                <!-- Profil Image-->
                <div class="hs-headline">
                    <a id="my-link" href="#my-panel"><i class="fa fa-bars"></i></a>
                    <div class="smallbrandname"><h1>FILM FACTORY</h1></div>
                    <div class="img-wrap">
                        <img src="images/prof_img.jpg" alt="" width="150" height="150" />
                    </div>
                    <div class="profile_info">
                        <h1>Film Board</h1>
                        <!-- <h4>WEB DESIGNER</h4>
                        <h6><span class="fa fa-location-arrow"></span>&nbsp;&nbsp;&nbsp;San Francisco , CA</h6>-->
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="separator-aside"></div>
                <!-- End Profil Image-->

                <!-- menu -->
                <nav>
<?php
if ($_SESSION["pagecategory"] == "Home") {
    echo "<a href='Home.php' class='active-sec'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
    echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
    echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
    echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
    echo "<a href='Account.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
    echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
} else if ($_SESSION["pagecategory"] == "Radios") {
    echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
    echo "<a href='Radios.php' class='active-sec'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
    echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
    echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
    echo "<a href='Account.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
    echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
} else if ($_SESSION["pagecategory"] == "Videos") {
    echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
    echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
    echo "<a href='Videos.php'  class='active-sec'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
    echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
    echo "<a href='Account.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
    echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
} else if ($_SESSION["pagecategory"] == "Audios") {
    echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
    echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
    echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
    echo "<a href='Audios.php' class='active-sec'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
    echo "<a href='Account.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
    echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
} else if ($_SESSION["pagecategory"] == "Account") {
    echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
    echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
    echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
    echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
    echo "<a href='Account.php' class='active-sec'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
    echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
} else if ($_SESSION["pagecategory"] == "ContactUs") {
    echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
    echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
    echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
    echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
    echo "<a href='Account.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
    echo "<a href='ContactUs.php' class='active-sec'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
}
?>
                    <!-- <a href="Home.php"><span class="menu_name">HOME</span><span class="fa fa-home"></span> </a>
                    <a href="Radios.php"><span class="menu_name">RADIO CHANNELS</span><span class="fa fa-headphones"></span> </a>
                    <a href="Videos.php"><span class="menu_name">VIDEOS</span><span class="fa fa-film"></span> </a>
                    <a href="Audios.php"><span class="menu_name">MUSIC &amp; ALBUMS</span><span class="fa fa-music"></span> </a>
                    <a href="Account.php"><span class="menu_name">ACCOUNT</span><span class="fa fa-user"></span> </a>
                    <a href="Contact_us.php"><span class="menu_name">CONTACT US</span><span class="fa fa-newspaper-o"></span> </a>
                    <a href="#section7"><span class="menu_name">WORKS</span><span class="fa fa-archive"></span> </a>
                    <a href="#section8"><span class="menu_name">CONTACT</span><span class="fa fa-paper-plane"></span> </a> -->
                </nav>
                <!-- end menu-->
                <!-- social icons -->
                <div class="aside-footer">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-whatsapp"></i></a>
                </div>
                <!-- end social icons -->
            </aside>
            <!-- End sidebar -->

            <!-- Go To Top Button -->
            <a href="#hs-menu" class="hs-totop-link"><i class="fa fa-chevron-up"></i></a>
            <!-- End Go To Top Button -->

            <!-- hs-content-scroller -->
            <div class="hs-content-scroller">
                <!-- Header -->
                <div id="header_container">
                    <div id="header">
                        <div class="logoname"><a href="#">FilmBoard.in</a></div>
                        <div class="news-scroll">
                            <span><i class="fa fa-line-chart"></i>RECENT ACTIVITY : </span>
                            <ul id="marquee" class="marquee">
                                <li>
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa.</li>
                                <li>
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa.
                                </li>
                                <li>
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa.
                                </li>
                                <li>
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa.
                                </li>
                                <li>
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa.
                                </li>
                                <li>
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Fusce tincidunt adipiscing,massa.
                                </li>
                            </ul>
                        </div>
                        <!-- End Recent Activity -->
                    </div>
                </div>
                <!-- End Header -->

                <!-- hs-content-wrapper -->
                <div class="hs-content-wrapper">
                    <!-- About section -->
                    <div class="hs-content container-box" id="bodycontainer" tabindex="1">
                        <div class="hs-inner">

<?php
$downobj = new Main_Controller();
if (isset($_GET['VideoId'])) {
    echo $downobj->GetFileInfoforDownload($_GET["VideoId"], 0);
}
if (isset($_GET['AlbumId'])) {
    echo $downobj->GetFileInfoforDownload($_GET["AlbumId"], 1);
}
include 'Master_Page_Footer.php';
?>