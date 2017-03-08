<?php
include 'Main_Controller.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Flim Board - A library of Movie Industry,Movies,Music,Actors and Entertainment</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#FF5511">
        <link rel="shortcut icon" href="images/Filmboard_logo.ico">
        
        <!-- CSS | STYLE -->

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="css/linecons.css" />
        <link rel="stylesheet" type="text/css" href="css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="css/colors.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="css/jplayer.blue.monday.css" rel="stylesheet" type="text/css"/>
        <link href="css/file_upload.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/dropzone_image_upload.css" />
        <link href="css/jquery.hashtags.css" rel="stylesheet" type="text/css"/>
        <!-- Scripts | Js Files -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/default.js"></script>
        <script type="text/javascript" src="js/watch.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/bootbox.js"></script>
        <script src="js/LoadFunctions_Sub.js" type="text/javascript"></script>
        <script src="js/File_Upload.js" type="text/javascript"></script>
        <script src="js/autosize.min.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script src="js/watch.js" type="text/javascript"></script>
        <script src="js/default.js" type="text/javascript"></script>
        <script src="js/modernizr-2.6.1.min.js" type="text/javascript"></script>
        <script src="js/dropzone_image_upload.js" type="text/javascript"></script>
        <script src="js/jplayer.playlist.js" type="text/javascript"></script>
        <script src="js/jquery.autosize.js" type="text/javascript"></script>
        <script src="js/jquery.hashtags.js" type="text/javascript"></script>
        <script src="js/jquery.jplayer.js" type="text/javascript"></script>
        <script src="js/Form_Validator.js" type="text/javascript"></script>
        <script src="js/dropzone_image_upload.js"></script>
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
                    <a id="my-link"><i class="fa fa-bars"></i></a>
                    <div class="smallbrandname"><h1>FILM BOARD</h1></div>
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
                        <h1>Flim Board</h1>
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
                        <div class="logoname"><a href="Home.php">FilmBoard.in</a></div>
                        <div class="news-scroll">
                            <span><i class="fa fa-line-chart"></i>TRENDING : </span>
                            <ul id="marquee" class="marquee">
                                <?php
                                    $trendobj=new Main_Controller();
                                    echo $trendobj->trendingCards();
                                ?>
                            </ul>
                        </div>
                        <?php
                        if(isset($_SESSION["userid"]))
                        {
                            $headerlogin="<div style='float: right;right: 15px;' class='drpdown'> 
                                    <div class='drpbtn'>
                                        <div class='alignleft'>";
                            if(file_exists('Other Data/Images/prof_img_'.$_SESSION["userid"].'.jpg') == TRUE)
                            {
                                $headerlogin=$headerlogin.'<img src="Other Data/Images/prof_img_'.$_SESSION["userid"].'.jpg" alt="" class="loginpanelimg" />';
                            }
                            else if(file_exists('Other Data/Images/prof_img_'.$_SESSION["userid"].'.pnh') == TRUE)
                            {
                                $headerlogin=$headerlogin.'<img src="Other Data/Images/prof_img_'.$_SESSION["userid"].'.png" alt="" class="loginpanelimg" />';
                            }
                            else
                            {
                               $headerlogin=$headerlogin.'<img src="Images/prof_img.png" alt="" class="loginpanelimg" />'; 
                            }
                            $headerlogin= $headerlogin."</div>
                                        <div class='alignleft' style='width: auto;padding-top: 5px;padding-right: 10px;'>
                                            <h3 style='color:white'>Ganesh</h3>
                                        </div>
                                        <div class='alignleft' style='width: auto;color: white'><i class='fa fa-sort-down'></i>
                                            <div class='drpdown-content'>
                                                <div style='width: 100%;height: 25px;'><a href='MyAccount.php?type=profileinfo'>Profile Info</a></div>
                                                <div style='width: 100%;height: 25px;'><a href='MyAccount.php?type=myposts'>My Posts</a></div>
                                                <div style='width: 100%;height: 25px;margin-bottom: 20px'><a href='Action_Page.php?Action=logoff'>Signout</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                            echo $headerlogin;
                        }
                        else
                        {
                            /*echo "<div style='float: right;right: 15px;' class='drpdown'> 
                                    <div class='drpbtn'>
                                        <div class='alignleft' style='width: auto;padding-top: 5px;padding-right: 10px;margin-top:5%; margin-bottom:5%;width:100px;padding-left:20px;'>
                                            <h3 style='color:white;font-size:16px !important;z-index:999;-webkit-box-shadow: -1px 0px 15px 0px rgba(48, 50, 50, 0.5);    -moz-box-shadow: -1px 0px 15px 0px rgba(48, 50, 50, 0.5);    box-shadow: -1px 0px 15px 0px rgba(48, 50, 50, 0.5);'><a href='Login.php' style='line-height:0px !important;height:auto !important;'>Login</a></h3>
                                        </div>
                                    </div>
                                </div>";*/
                        }
                        ?>
                        
                        <!-- End Recent Activity -->
                    </div>
                </div>
                <!-- End Header -->

                <!-- hs-content-wrapper -->
                <div class="hs-content-wrapper">
                    <!-- About section -->
                    <div class="hs-content container-box" id="bodycontainer" tabindex="1">
                        <div class="hs-inner">
