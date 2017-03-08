<?php
if (session_id() == '') {
    session_start();
}
$_SESSION["currentpage"]="Vp.php?pid=".$_GET["pid"];
$_SESSION["pagecategory"]="Home";
include 'Main_Controller.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="shortcut icon" href="images/Filmboard_logo.ico">
        
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

        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-72895382-1', 'auto');
            ga('send', 'pageview');

        </script>
        
        <!-- page level ads -->
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
          (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8205498786717408",
            enable_page_level_ads: true
          });
        </script>
        
        <!-- Embedded Scripts -->
        
        <script data-cfasync="false">
            (function(r,e,E,m,b){E[r]=E[r]||{};E[r][b]=E[r][b]||function(){
            (E[r].q=E[r].q||[]).push(arguments)};b=m.getElementsByTagName(e)[0];m=m.createElement(e);
            m.async=1;m.src=("file:"==location.protocol?"https:":"")+"//s.reembed.com/G-1yKORX.js";
            b.parentNode.insertBefore(m,b)})("reEmbed","script",window,document,"api");
      </script>
        
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
        if (isset($_GET["pid"]) == true) {
            $title="";
            $videofile="";
            $imagefile="";
            $description="";
            $obj1 = new Main_Controller();
            $obj1->postViewCountIncrement($_GET["pid"]);
            $result_v = $obj1->getPostTagsInfo($_GET["pid"]);
            $result = mysqli_fetch_row($result_v);
            if($result[4]!="")
            {
                $title = $result[4];
                $description=$result[7];
                $videofile=$result[5];
                $imagefile=$result[6];
            }
            else
            {
                $title = "FilmBoard PostCard";
                $description=$result[1];
                $videofile="";
            }
            $keywords = "Filmboard.in,Filmboard,songs,videos,trailers,music,audios,radios,box office,statistics,$result[1],$result[4],$result[7]";
            
            echo "<!-- for Google --> ";
            echo "<meta name='description' content='$description'>\n";
            echo "<meta name='keywords' content='$keywords'>\n";
            //echo "<meta name='author' content='Ganesh Subramaniyam' />";
            echo "<meta name='copyright' content='FilmBoard'>";
            echo "<meta name='thumbnail' content='$imagefile'>";
            echo "<meta name='application-name' content='Filmboard'>";
            echo "<meta name='siteurl' content='Filmboard.in'>";

            echo "<!-- for Facebook -->";
            echo "<meta property='fb:app_id' content='1782636968639856'>";
            echo "<meta property='fb:page_id' content='608301642661332'>";
            echo "<meta property='og:site_name' content='Filmboard.in'>";
            echo "<meta property='og:url' content='http://www.filmboard.in/Vp.php?pid=".$_GET["pid"]."'>";
            echo "<meta property='og:title' content='$title'>";
            echo "<meta property='og:image' content='$imagefile'>";
            echo "<meta property='og:description' content='$description '>";
            echo "<meta property='og:type' content='video'>";

            echo "<!-- for Twitter -->";
            echo "<meta name='twitter:card' content='summary_large_image'>";
            echo "<meta name='twitter:site' content='Filmboard.in'>";
            echo "<meta name='twitter:title' content='$title'>";
            echo "<meta name='twitter:description' content='$description'>";
            echo "<meta name='twitter:image' content='$imagefile'>";

            echo "<title>$title - Filmboard.in - Complete Entertainment with all Radios, Videos and Audios.</title>";
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
                    <div class="smallbrandname"><h1>Film Board</h1></div>
                    <div class="img-wrap">
                        <?php
                        if(isset($_SESSION["userid"]))
                        {
                            if(file_exists('Other Data/Images/prof_img_'.$_SESSION["userid"].'.jpg') == TRUE)
                            {
                                echo '<a href="MyAccount.php?type=profileinfo"><img src="Other Data/Images/prof_img_'.$_SESSION["userid"].'.jpg" alt="" width="150" height="150" /></a>';
                            }
                            else if(file_exists('Other Data/Images/prof_img_'.$_SESSION["userid"].'.png') == TRUE)
                            {
                                echo '<a href="MyAccount.php?type=profileinfo"><img src="Other Data/Images/prof_img_'.$_SESSION["userid"].'.png" alt="" width="150" height="150" /></a>';
                            }
                            else
                            {
                               echo '<a href="MyAccount.php?type=profileinfo"><img src="Images/prof_img.png" alt="" width="150" height="150" /></a>'; 
                            }
                        }
                        else
                        {
                            echo '<img src="images/Filmboard_logo.jpg" alt="" width="150" height="150" />';
                        }
                        ?>
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
                        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS & MOVIES</span><span class='fa fa-film'></span> </a>";
                        echo "<a href='MovieInfo.php'><span class='menu_name'>MOVIE REVIEWS</span><span class='fa fa-indent'></span> </a>";
                        echo "<a href='Audios.php'><span class='menu_name'>MUSIC ALBUMS</span><span class='fa fa-music'></span> </a>";
                        //echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
                        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
                    } else if ($_SESSION["pagecategory"] == "Radios") {
                        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
                        echo "<a href='Radios.php' class='active-sec'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
                        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS & MOVIES</span><span class='fa fa-film'></span> </a>";
                        echo "<a href='MovieInfo.php'><span class='menu_name'>MOVIE REVIEWS</span><span class='fa fa-indent'></span> </a>";
                        echo "<a href='Audios.php'><span class='menu_name'>MUSIC ALBUMS</span><span class='fa fa-music'></span> </a>";
                        //echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
                        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
                    } else if ($_SESSION["pagecategory"] == "Videos") {
                        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
                        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
                        echo "<a href='Videos.php'  class='active-sec'><span class='menu_name'>VIDEOS & MOVIES</span><span class='fa fa-film'></span> </a>";
                        echo "<a href='MovieInfo.php'><span class='menu_name'>MOVIE REVIEWS</span><span class='fa fa-indent'></span> </a>";
                        echo "<a href='Audios.php'><span class='menu_name'>MUSIC ALBUMS</span><span class='fa fa-music'></span> </a>";
                        //echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
                        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
                    }
                    elseif ($_SESSION["pagecategory"] == "Moviesinfo") {
                        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
                        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
                        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS & MOVIES</span><span class='fa fa-film'></span> </a>";
                        echo "<a href='MovieInfo.php'  class='active-sec'><span class='menu_name'>MOVIE REVIEWS</span><span class='fa fa-indent'></span> </a>";
                        echo "<a href='Audios.php'><span class='menu_name'>MUSIC ALBUMS</span><span class='fa fa-music'></span> </a>";
                        //echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
                        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
                    }
                    else if ($_SESSION["pagecategory"] == "Audios") {
                        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
                        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
                        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS & MOVIES</span><span class='fa fa-film'></span> </a>";
                        echo "<a href='MovieInfo.php'><span class='menu_name'>MOVIE REVIEWS</span><span class='fa fa-indent'></span> </a>";
                        echo "<a href='Audios.php' class='active-sec'><span class='menu_name'>MUSIC ALBUMS</span><span class='fa fa-music'></span> </a>";
                        //echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
                        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
                    } else if ($_SESSION["pagecategory"] == "Account") {
                        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
                        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
                        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS & MOVIES</span><span class='fa fa-film'></span> </a>";
                        echo "<a href='MovieInfo.php'><span class='menu_name'>MOVIE REVIEWS</span><span class='fa fa-indent'></span> </a>";
                        echo "<a href='Audios.php'><span class='menu_name'>MUSIC ALBUMS</span><span class='fa fa-music'></span> </a>";
                        //echo "<a href='MyAccount.php' class='active-sec'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
                        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
                    } else if ($_SESSION["pagecategory"] == "ContactUs") {
                        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
                        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
                        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS & MOVIES</span><span class='fa fa-film'></span> </a>";
                        echo "<a href='MovieInfo.php'><span class='menu_name'>MOVIE REVIEWS</span><span class='fa fa-indent'></span> </a>";
                        echo "<a href='Audios.php'><span class='menu_name'>MUSIC ALBUMS</span><span class='fa fa-music'></span> </a>";
                        //echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
                        echo "<a href='ContactUs.php' class='active-sec'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
                    }
                    ?>
                </nav>
                <!-- end menu-->
                <!-- social icons -->
                <div class="aside-footer">
                    <a href="https://www.facebook.com/FilmBoardinc/"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/Filmboard_Inc"><i class="fa fa-twitter"></i></a>
                    <a href="https://plus.google.com/100494564162631162873/"><i class="fa fa-google-plus"></i></a>
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
                                <?php
                                    $trendobj=new Main_Controller();
                                    echo $trendobj->trendingCards();
                                ?>
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
                            <div class="col-xs-12" id="postcardcontents">
                                <div class='col-sm-12'><h2>View Post</h2>
                                <?php
                                $obj1=new Main_Controller();
                                echo $obj1->displayPostCards($_GET["pid"], 1,0);
                                echo $obj1->suggestedPosts($_GET["pid"]);
                                echo "<div class='clearfix'></div><br />"
                                ?>
                            </div>
                            
                            <?php
                            include 'Master_Page_footer.php';
                            ?>