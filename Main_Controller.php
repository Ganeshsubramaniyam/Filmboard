<?php

include 'datafetch.php';

class Main_Controller {

    function __construct() {
        
    }

    public function getvideos($var, $startlimit) {
        $urlbuttons = "";
        if (isset($_SESSION["currentpage"]) == true && $_SESSION["currentpage"] == "Videos.php") {
            $urlbuttons = "<div style='float:right;margin-bottom:25px;'><!-- <a href='subindex.php?videoupload=1' class='btn-sm'>Upload Videos</a> --></div>";
        } else {
            $urlbuttons = "<div style='float:right;margin-bottom:5px;'><a href='Videos.php' class='btn-sm'>View All Videos</a>  <a href='subindex.php?videoupload=1' class='btn-sm'>Upload Videos</a></div>";
        }
        if ($var == "") {
            $searchlabel = "<br /><div style='float:left;margin-left:5px;'><h3>Trending Videos</h3></div>";
        } else {
            $searchlabel = "<div style='float:left;margin-left:5px;'><h3>Showing results of '<b>$var</b>'</h3> </div>";
        }
        $loadbutton = "<div style='float:left;width:95%;height:50px;background-color:lightgray;margin-top:10px;margin-left:2.5%;'>"
                . "<div style='margin-top:5px;text-align:Center'>"
                . "<a class='btn-sm' style='line-height:40px' id='morevideo' onclick='loadmorevideos();' value='20'>Load More Videos</a>"
                . "</div>"
                . "<div class='clearfix'></div><br /><br />"
                . "</div>";
        $htmldata = "<div class='col-xs-12' style='margin-bottom:2%;'>
                                                        <h2>Videos</h2> 
                                                            <div class='videosearch'><form action='javascript:searchvideo();' method='post'><input type='text' placeholder='Search with Keywords' id='searchvidtext' name='searchvideotext' id='searchvideotxt'></input>
                                                            <a class='btn-sm' onclick='searchvideo();'>Search</a></form></div>
                                                            <br /><div class='videosearchtags'>Search Tags: 
                                                            <a href=Action_Page.php?Action=loadvideos&type=Songs>Songs</a> |
                                                            <a href=Action_Page.php?Action=loadvideos&type=Movies>Movies</a> |
                                                            <a href=Action_Page.php?Action=loadvideos&type=Trailers>Trailers</a> |
                                                            <a href=Action_Page.php?Action=loadvideos&type=MovieScenes>MovieScenes</a> |
                                                            <a href=Action_Page.php?Action=loadvideos&type=Controversial>Controversial</a> |
                                                            <a href=Action_Page.php?Action=loadvideos&type=BehindScenes>BehindScenes</a> </div>
                                                            <div class='clearfix'></div>
                                                            <div style='width:100%;margin-top:2%;'> $searchlabel $urlbuttons</div>"
                . "<div class='clearfix'></div>
                                                            <div class='videolist'>"
                . $this->getvideosfromdb($var, $startlimit,$_SESSION["videoplaylistid"])
                . "</div>";
        if ($var == "" && $_SESSION["currentpage"] != "index.php") {
            $htmldata = $htmldata . $loadbutton;
        }
        $htmldata = $htmldata . "</div>";
        return $htmldata;
    }

    public function getAudios($var) {
        $urlbuttons = "";
        if (isset($_SESSION["currentpage"]) == true && $_SESSION["currentpage"] == "Audios.php") {
            $urlbuttons = "<div style='float:right;margin-bottom:5px;'><a href='Audiosupload.php' class='btn-sm'>Upload Music</a></div>";
        } else {
            $urlbuttons = "<div style='float:right;margin-bottom:5px;'><a href='Audios.php' class='btn-sm'>View All Music</a>  <a href='Audiosupload.php' class='btn-sm'>Upload Music</a></div>";
        }
        if ($var == "") {
            $searchlabel = "<h3>Trending Music</h3>";
        } else {
            $searchlabel = "Showing results of '<b>$var</b>'";
        }
        $htmldata = "<div class='col-sm-12'>
                <h2>Music / Audios</h2>
                <div class='videosearch'>
                    <form action='javascript:searchaudio();' method='post'>
                        <input type='text' placeholder='Search Music and Audios' id='searchaidtext' style='text-indent:10px;' name='searchvideotext' id='searchvideotxt'></input>
                        <a class='btn-sm' onclick='searchvideo();'>Search</a>
                    </form>
                </div>
                <div style='margin-bottom:10px;' class='videosearchtags'>Search Tags: 
                        <a style='color:blue !important;text-decoration:underline;' href=Audios.php?search=Tamil>Tamil</a> |
                        <a style='color:blue !important;text-decoration:underline;' href=Audios.php?search=Telugu>Telugu</a> |
                        <a style='color:blue !important;text-decoration:underline;' href=Audios.php?search=Malayalam>Malayalam</a> |
                        <a style='color:blue !important;text-decoration:underline;' href=Audios.php?search=Kannada>Kannada</a> |
                        <a style='color:blue !important;text-decoration:underline;' href=Audios.php?search=Hindi>Hindi</a> |
                        <a style='color:blue !important;text-decoration:underline;' href=Audios.php?search=Marathi>Marathi</a>
                        </div>
                        <div class='clearfix'></div>
                        <div style='width:100%;margin-top:4%;'><div style='float:left;'>" . $searchlabel . "</div>"
                . $urlbuttons . "</div>
            </div>
            <div class='clearfix'></div>
            <div class='videolist' style='margin-top:0% !important;' id='audioalbums'>" .
                $this->GetAudiosFromDB($var, 0) .
                "</div>
            <div style='float:left;width:95%;height:50px;background-color:lightgray;margin-left:2.5%;margin-top:10px;'>
                <div style='margin-top:15px;text-align:Center'>
                    <a class='btn-sm' id='moreaudio' onclick='loadmoreaudios();' value='20'>Load More Music</a>
                </div>
            </div>
            <div class='clearfix'></div>
            <br /><br /><br /><br /><br /><br /><br /><br />
            <br />";
        return $htmldata;
    }

    public function getMyVideos() {
        $urlbuttons = "";
        $urlbuttons = "<div style='float:right;margin-bottom:5px;'><a href='subindex.php?videoupload=1' class='btn-sm'>Upload Videos</a></div>";
        $searchlabel = "Showing results of '<b>My Videos</b>'";
        $htmldata = "<div class='col-xs-12' style='text-align:center'>
                                                        <h1>Videos</h1> 
                                                            <div class='videosearch'><form action='javascript:searchvideo();' method='post'><input type='text' placeholder='Search Songs, Movies & others' id='searchvidtext' name='searchvideotext' id='searchvideotxt'></input>
                                                            <button class='btn-sm nopadding' onclick='searchvideo();'>Search</button></form></div>
                                                            <br /><div style='float:left;'>" . $searchlabel . "</div>"
                . $urlbuttons . "
                                                            <div class='videolist'>"
                . $this->getMyvideosfromdb()
                . "</div>
                                                        </div>";
        return $htmldata;
    }

    public function getvideosforplay($var) {
        $urlbuttons = "<div style='float:right;margin-bottom:10px;margin-top:-15px;'><a href='Videos.php' class='btn-sm'>View All Videos</a></div>";
        $htmldata = "<div class='col-xs-6'>
                        <h2>VIDEOS</h2></div>
                            <div class='videosearch' style='text-align:center'>
                                <form action='javascript:searchvideo();' method='post'>
                                    <input type='text' placeholder='Search with Keywords' id='searchvidtext' name='searchvideotext' id='searchvideotxt'></input>
                                    <a class='btn-sm' onclick='searchvideo();'>Search</a>
                                </form>
                            </div>
                            <div class='clearfix'></div>
                            <div class='col-sm-12' style='margin-top:2%;'><div class='col-sm-8'>" .
                $this->getVideoInfo($var) . "<hr style='color:black !important;' /></div>
                                    <div class='col-sm-4'>
                                <h2>Simillar Videos</h2>$urlbuttons<br /><div class='videolist' style='margin-top:20px;height:480px !important; overflow-y:scroll !important';>"
                . $this->getvideosfromdb($_SESSION["searchstring"], 0,$_SESSION["videoplaylistid"])
                . "</div></div></div></form></div>";
        return $htmldata;
    }

    public function getVideoInfo($param) {
        $vidinfo = new datafetch();
        $result_data = $vidinfo->getvideoinfo($param);
        $result = mysqli_fetch_row($result_data);
        $htmldata = "<div class='videoplayerdiv'>
                        <h1>" . $result[1] . "</h1>
                        <div style='margin-bottom:10px;-webkit-box-shadow: -1px 0px 15px 0px rgba(48, 50, 50, 0.5);-moz-box-shadow:-1px 0px 15px 0px rgba(48, 50, 50, 0.5);box-shadow:-1px 0px 15px 0px rgba(48, 50, 50, 0.5);padding-top:5px'>
                            <!-- <video id='my-video' controls preload='none' data-setup='{}' style='text-align:left !important;' poster='data:image/png;base64," . base64_encode($result[3]) . "'> 
                                <source src='other data/Video Files/" . $result[1] . ".mp4?t=10' type='video/mp4'> 
                                <source src='other data/Video Files/" . $result[1] . ".ogg' type='video/ogg'> 
                                <source src='other data/Video Files/" . $result[1] . ".webm' type='video/webm'> 
                            </video> -->
                            <div id='jp_container_1' class='jp-video jp-video-360p' role='application' aria-label='media player'>
                                <div class='jp-type-single'>
                                    <div id='jquery_jplayer_1' class='jp-jplayer'></div>
                                    <div class='jp-gui'>
                                        <div class='jp-video-play'>
                                            <button class='jp-video-play-icon' role='button' tabindex='0'>play</button>
                                        </div>
                                        <div class='jp-interface'>
                                            <div class='jp-progress'>
                                                <div class='jp-seek-bar'>
                                                    <div class='jp-play-bar'></div>
                                                </div>
                                            </div>
                                            <div class='jp-current-time' role='timer' aria-label='time'>&nbsp;</div>
                                            <div class='jp-duration' role='timer' aria-label='duration'>&nbsp;</div>
                                            <div class='jp-controls-holder'>
                                                <div class='jp-controls'>
                                                    <button class='jp-play' role='button' tabindex='0'>play</button>
                                                    <button class='jp-stop' role='button' tabindex='0'>stop</button>
                                                </div>
                                                <div class='jp-volume-controls'>
                                                    <button class='jp-mute' role='button' tabindex='0'>mute</button>
                                                    <button class='jp-volume-max' role='button' tabindex='0'>max volume</button>
                                                    <div class='jp-volume-bar'>
                                                        <div class='jp-volume-bar-value'></div>
                                                    </div>
                                                </div>
                                                <div class='jp-toggles'>
                                                    <button class='jp-repeat' role='button' tabindex='0'>repeat</button>
                                                    <button class='jp-full-screen' role='button' tabindex='0'>full screen</button>
                                                </div>
                                            </div>
                                            <!--<div class='jp-details'>
                                                <div class='jp-title' aria-label='title'>&nbsp;</div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class='jp-no-solution'>
                                        <span>Update Required</span>
                                        To play the media you will need to either update your browser to a recent version or update your <a href='http://get.adobe.com/flashplayer/' target='_blank'>Flash plugin</a>.
                                    </div>
                                </div>
                            </div>

                        </div>
                        <p style='margin-top:15px;text-indent:5px;text-align:left;'>
                            <b>No of Views : </b>" . $result[7] . "
                        </p>
                        <div class='' id='loveit' style='display:none'></div>
                        <div style='float:right !important;'>
                            <a class='btn-sm' href='Downloads_View.php?VideoId=$result[0]'>Download</a>
                        </div> 
                        <div id='shareitdiv' style='float:left;'>
                            <div style='float:left;margin-left:5px'>
                                        <a class='fa fa-facebook' href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=$param' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=$param','name','width=600,height=400')' target='popup'></a>
                            </div>
                            <div style='float:left;margin-left:5px'>
                                <a class='fa fa-twitter' href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vv.php?Vpl=$param' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vv.php?Vpl=$param','name','width=600,height=400')' target='popup'></a>
                            </div>
                            <div style='float:left;margin-left:5px'>
                                <a class='fa fa-google-plus' href='https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=$param' onclick='window.open('https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=$param','name','width=600,height=400')' target='popup'></a>
                            </div>
                        </div>
                    </div><br /><br /><br />";
        $_SESSION["Albumormovie"] = $result[2];
        $_SESSION["playingvideo"] = $result[0];
        return $htmldata;
    }

    public function GetVideoInfoForScript($param) {
        $vidinfo = new datafetch();
        $result_data = $vidinfo->getvideoinfo($param);
        $result = mysqli_fetch_row($result_data);
        $htmldata = "var heightval='';
                        if(screen.width >500)
                        {
                            heightval='360px';
                        }
                        else
                        {
                            heightval='100%';
                        }
                        $('#jquery_jplayer_1').jPlayer({
                                ready: function () {
                                        $('#jquery_jplayer_1').jPlayer('setMedia', {
                                                title: '$result[1]',
                                                m4v: 'other data/Video Files/$result[0].mp4',
                                                poster: 'other data/Images/Vid_$result[0]_share.jpg'
                                        });
                                },
                                swfPath: 'js/',
                                solution: 'flash, html',
                                supplied: 'webmv, ogv, m4v',
                                size: {
                                        width: '100%',
                                        height: heightval,
                                        cssClass: 'jp-video-360p'
                                },
                                useStateClassSkin: true,
                                autoBlur: false,
                                smoothPlayBar: true,
                                keyEnabled: true,
                                remainingDuration: true,
                                toggleDuration: true
                        });";
        return $htmldata;
    }

    public function getMetaTagsInfo($param) {
        $metadataobj = new datafetch();
        $result_data = $metadataobj->getvideoinfo($param);
        return $result_data;
    }

    public function getAlbumMetaTagsInfo($param) {
        $metadataobj = new datafetch();
        $result_data = $metadataobj->getalbuminfo($param);
        return $result_data;
    }

    public function getPostTagsInfo($param) {
        $metadataobj = new datafetch();
        $result_data = $metadataobj->getposttagsinfo($param);
        return $result_data;
    }

    public function getvideosfromdb($var1, $startlimit1,$videotype) {
        $object_data_fetchv = new datafetch();
        $result_datav = $object_data_fetchv->getvideolist($var1, $startlimit1,$videotype);
        $length = mysqli_num_rows($result_datav);
        $lock=0;
        if ($_SESSION["currentpage"] == "Videos.php") {
            $lock = 0;
        }
        else {
            $lock = 1;
        }
        /* else {
            $length = 8;
            $lock = 0;
        }*/
        $htmldatav = "";
        if ($result_datav == FALSE) {
            $htmldatav = "Connection Problem .. Pls Try again in 10 Seconds....";
        } else {
            for ($i = 0; $i < $length; $i++) {
                $resultv = mysqli_fetch_row($result_datav);
                if ($lock == 0) {
                    $htmldatav = $htmldatav . "<div class='videotiles'>"
                            . "<a href='javascript:popupwindow();' sourcefile='$resultv[0]' videotitle='$resultv[1]' noviews='$resultv[6]' poster='$resultv[3]' description='$resultv[2]' videotype='$resultv[4]' uploaddate='$resultv[5]'>"
                            . "<img src='$resultv[3]' width='100%' height='150' />"
                            . "</a>"
                            . "<div class='videotilesa'><a href='javascript:popupwindow();' sourcefile='$resultv[0]' videotitle='$resultv[1]'><p style='height:40px;overflow:hidden'>" . $resultv[1] . "</p></a></div>"
                            . "</div>";
                } else {
                    $htmldatav = $htmldatav . "<div class='videotiles'>"
                                                . "<a href='Vv.php?Vpl=$resultv[0]'>"
                                                    . "<img src='$resultv[3]' width='100%' height='150' />"
                                                . "</a>"
                                                . "<div class='videotilesa'>"
                                                    . "<a href='Vv.php?Vpl=$resultv[0]'>"
                                                    . "<p style='height:40px;overflow:hidden'>" . $resultv[1] . "</p>"
                                                    . "</a>"
                                                . "</div>"
                                            . "</div>";
                }
            }
        }
        return $htmldatav;
    }

    public function getMyvideosfromdb() {
        $object_data_fetchv = new datafetch();
        $result_datav = $object_data_fetchv->getmyvideos();
        $length = mysqli_num_rows($result_datav);
        $htmldatav = "";
        if ($result_datav == FALSE) {
            $htmldatav = "Connection Problem .. Pls Try again in 10 Seconds....";
        } else {
            for ($i = 0; $i < $length; $i++) {
                $resultv = mysqli_fetch_row($result_datav);
                if (file_exists("Other Data/Images/Vid_$resultv[1]_share.jpg") == false) {
                    $object_data_temp_fetchv = new datafetch();
                    $result_temp_datav = $object_data_temp_fetchv->getImageArt($resultv[1], 0);
                    $resultv_temp = mysqli_fetch_row($result_temp_datav);
                    file_put_contents("Other Data/Images/Vid_$resultv[1]_share.jpg", $resultv_temp[0]);
                }
                $htmldatav = $htmldatav . "<div class='videotiles'>"
                        . "<a href='#' data-bb='' sourcefile='other data/Video Files/" . $resultv[1] . ".mp4' rawfile='" . $resultv[1] . "' noviews='" . $resultv[12] . "' starcast='" . $resultv[5] . "' moviename='" . $resultv[4] . "' videotitle='" . $resultv[2] . "'>"
                        . "<img src='Other Data/Images/Vid_$resultv[1]_share.jpg' width='250' height='150' />"
                        . "</video>"
                        . "</a>"
                        . "<div><a  href='#' data-bb='' sourcefile='other data/Video Files/" . $resultv[1] . ".mp4' videotitle='" . $resultv[2] . "'><p>" . $resultv[2] . " - " . $resultv[4] . "</p></a></div>"
                        . "</div>";
            }
        }
        return $htmldatav;
    }

    public function videouploadform() {
        $langdata = $this->getLanguagesfromDB();
        $htmldata = "<h2>Upload a Video</h2> 
                        <div class='videolist1' id='videolist1'>
                        <form action='javascript:videothumnailselection();' onsubmit='javascript:videothumnailselection();return false;' id='uploadfrm' role='form'>
                            <div id='videouploaddetails'>
                                <div class='col-sm-6'>
                                    <div class='form-group'>
                                    <fieldset class='clearfix securityCheck'>
                                            <legend>
                                                    Video Information
                                            </legend>
                                            <div class='form-group'>
                                            <p style='color:brown'>  Max Video upload size is 124MB.</p>
                                        <label for='videoupload'>Video File</label>
                                        <input name='vidupload' class='form-control' type='file' id='videoupload'  placeholder=' Starcast' title='Please select a video file' accept='.mp4,.webem'/>
                                    </div>
                                <div class='form-group'>
                                        <label for='videoname'>Video Name</label>
                                        <input type='text' class='form-control' name='videoname' id='videoname' placeholder=' Video Name'  title='Please  Enter a video Name '/>
                                </div>
                                <div class='form-group'>
                                        <label for='videotype'>Video Type</label>
                                        <select class='form-control' name='vidtype' id='videotype' placeholder=' Movie or Album Name' title='Please Enter a Movie or Album Name' onchange='uploadselectcheck();'>
                                            <option value=''> -- Please Select the Video Type -- </option>
                                            <option value='Song'>Song</option>
                                            <option value='Movie Scenes'>Movie Scenes</option>
                                            <option value='Trailer'>Trailer/Teaser</option>
                                            <option value='Educational'>Educational</option>
                                            <option value='Others'>Others</option>
                                        </select>
                                </div>
                                <div class='form-group' id='movalb'>
                                        <label for='moviealbumname'>Movie or Album</label>
                                        <input name='moviealbumname' class='form-control' type='text' id='moviealbumname'  placeholder=' Movie or Album Name' title='Please Enter the Movie/Album Name'>
                                </div>
                                <div class='form-group'>
                                        <label for='starcast'>Tags</label>
                                        <input name='starcast' class='form-control' type='text' id='starcast'  placeholder=' Tags' title='Please  Enter the Tags in Video'>
                                </div>
                                <div class='form-group' id='rely'>
                                        <label for='releaseyear'>Release Year</label>
                                        <input name='releaseyear' class='form-control' type='text' id='releaseyear'  placeholder=' Year of Release' title='Please Enter the Year of Release'>
                                </div>
                                    </fieldset>
                            </div>


                        </div>
                        <div class='col-sm-5'>
                            <div class='form-group'>
                            <fieldset class='clearfix securityCheck'>
                                    <legend>
                                            Language
                                    </legend>
                                    <div class='form-group'>
                                            <select class='form-control' id='language' name='language' title='Please Select the Language'><option value=''>-- Select the language --</option>$langdata</select>
                                    </div>
                            </fieldset>
                            </div>
                            <div class='form-group'>
                            <fieldset class='clearfix securityCheck'>
                                    <legend>
                                            Age Restriction
                                    </legend>
                                    <div class='form-group'>
                                            <input type='radio' id='plus18' value='18p' name='agerestrict' /> 18+
                                            <input type='radio' id='allage' value='All' name='agerestrict' /> ALL
                                    </div>
                            </fieldset>
                            </div>
                            <div class='form-group'>
                            <fieldset class='clearfix securityCheck'>
                                    <legend>
                                            Security
                                    </legend>
                                    <div class='form-group'>
                                            <div class='g-recaptcha' data-sitekey='6LfJJiATAAAAALyQEy9w8osAqFZ_8_MKh1X2d_fM'></div>
                                    </div>
                            </fieldset>
                            </div>
                            <div class='form-group'>
                            <fieldset class='clearfix securityCheck'>
                                    <legend>
                                            License Aggrement
                                    </legend>
                                    <div class='form-group'>
                                            <input type='checkbox' id='license' name='license'> I accept the Terms and Conditions of FunRaaga.
                                    </div>
                            </fieldset>
                            </div>
                            <div class='result12'></div>
                            <button type='submit' class='btn-sm nopadding' >Upload</a>
                        </div>
                        </div>
                        <div class='col-xs-9' id='uploadvideothumbnail'>
                            <div class='form-group'>
                                <fieldset class='clearfix securityCheck'>
                                        <legend>
                                                Video Thumbnails
                                        </legend>
                                        <div class='form-group'>
                                            <div id='videlist'>
                                            </div>
                                        <label for='videopreview'>Video Preview</label><br />
                                            <video id='videoplay' width='600' height='320' controls autoplay></video>
                                    </div>
                                    <div class='form-group'>
                                        <label for='thumbnailpreview' style='margin-right:10px'>Thumbnail Selection</label>
                                        <button onclick='capture();' type='button' class='btn-sm nopadding'>Capture</button><br/><br />
                                        <canvas id='canvasimg' width='600' height='320'>

                                        </canvas>           
                                    </div>
                                </fieldset>
                                <br />
                                <a class='btn-sm' onclick='javascript:postdata();'>
                                    Publish
                                </a>
                            </div>
                            <br /><br /><br /><br />
                        </form>
                        </div>
                    </div>";
        return $htmldata;
    }

    public function postcardvideouploadform() {
        $htmldata = "<div class='col-xs-12'>
                        <form action='#' onsubmit='javascript:postdata();return false;' id='uploadfrm' role='form'>
                                <div class='videolisthome' style='margin-left:5%'>
                                                <div class='col-sm-12'>
                                                    <div class='form-group'>
                                                        <label for='videoupload'>Video File <span style='color:brown;'>(Max Video upload size is 124MB)</span></label>
                                                        <input name='vidupload' class='form-control' type='file' id='videoupload'  placeholder=' Starcast' title='Please select a video file' accept='.mp4,.webem'/>
                                                    </div>
                                                </div>
                                                <div class='clearfix'></div>
                                                <div class='col-sm-12'>
                                                    <div class='col-sm-12'>
                                                        <div class='form-group'>
                                                            <div id='videlist'>
                                                            </div>
                                                            <label for='videopreview'>Video Preview</label>
                                                            <video id='videoplay' width='100%' height='100%' controls></video>
                                                        </div>
                                                    </div>
                                                    <!-- <div class='col-sm-6'>
                                                        <div class='form-group'>
                                                            <label for='thumbnailpreview' style='margin-right:10px'>Thumbnail Selection</label>
                                                            <button onclick='capture();' type='button'>Capture</button><br/><br />
                                                            <canvas id='canvasimg' width='300' height='205'>
                                                           </canvas>			
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class='clearfix'></div>
                                                <div class='col-sm-12'>
                                                    <div class='col-sm-6'>
                                                        <div class='form-group'>
                                                        <label for='videoname'>Video Name</label>
                                                        <input type='text' class='form-control' name='videoname' id='videoname' placeholder=' Video Name'  title='Please  Enter a video Name ' style='margin:5px !important;' />
                                                    </div>
                                                    </div>
                                                    <div class='col-sm-6'>
                                                        <div class='form-group'>
                                                            <label for='starcast'>Tags</label>
                                                            <input name='starcast' class='form-control' type='text' id='starcast'  placeholder=' Tags' title='Please  Enter the Tags in Video' style='margin:5px !important;' >
                                                    </div>
                                                    </div>
                                                </div>
                                        </form>
                                </div>
                        </div>";
        return $htmldata;
    }

    public function getLanguagesfromDB() {
        $object_data_fetchv1 = new datafetch();
        $result_datav = $object_data_fetchv1->getlanguages();
        $htmldatav = "";
        if ($result_datav == FALSE) {
            $htmldatav = "Connection Problem .. Pls Try again in 10 Seconds....";
        } else {
            for ($i = 0; $i < mysqli_num_rows($result_datav); $i++) {
                $resultv = mysqli_fetch_row($result_datav);
                $htmldatav = $htmldatav . "<option value='$resultv[0]'>$resultv[0]</option>";
            }
        }
        return $htmldatav;
    }

    public function getvideostoapprove() {

        $htmldata = "<section>
                            <div class='videolist'>"
                . $this->getvideostoapprovefromdb()
                . "</div>
                       </section>";
        return $htmldata;
    }

    public function getvideostoapprovefromdb() {
        $object_data_fetchv1 = new datafetch();
        $result_datav = $object_data_fetchv1->getvideolisttoapprove();
        $htmldatav = "";
        if ($result_datav == FALSE) {
            $htmldatav = "Connection Problem .. Pls Try again in 10 Seconds....";
        } else {
            for ($i = 0; $i < mysqli_num_rows($result_datav); $i++) {
                $resultv = mysqli_fetch_row($result_datav);
                $htmldatav = $htmldatav . "<div class='videotiles' style='height:300px !important' id='$resultv[1]panel'>"
                        . "<a href='#' data-bb='' sourcefile='other data/Video Files/" . $resultv[1] . ".mp4' videotitle='" . $resultv[2] . "'>"
                        . "<img src='data:image/png;base64," . base64_encode($resultv[3]) . "' width='100%' height='150' />"
                        . "</video>"
                        . "</a>"
                        . "<div><a  href='#' data-bb='' sourcefile='other data/Video Files/" . $resultv[1] . ".mp4' videotitle='" . $resultv[2] . "'><p>" . $resultv[2] . " - " . $resultv[4] . "</p></a></div>"
                        . "<div><button class='btn-sm nopadding' onclick=sendRequestApproveorReject('" . $resultv[1] . "',true); >Approve</button>      <button onclick=sendRequestApproveorReject('" . $resultv[1] . "',false); class='btn-sm'>Decline</button></div>"
                        . "</div>";
            }
        }
        return $htmldatav;
    }

    public function getRadios($langfilter) {
        $sortbuttons = "<div class='radiofilter'>
                                <b>Language Filter</b><br />
                                <select id='radiolanguagefilter' style='width:75%;height:30px;margin-top:10px;' onchange='javascript:radiofilteronchange(this.value)'>
                                    <option value='none'>Select Language</option>
                                    <option value='Arabic'>Arabic</option>
                                    <option value='Bangla'>Bangla</option>
                                    <option value='English'>English</option>
                                    <option value='Ghazals'>Ghazals</option>
                                    <option value='Gujrat'>Gujrat</option>
                                    <option value='Hindi'>Hindi</option>
                                    <option value='Kannada'>Kannada</option>
                                    <option value='Lounge'>Lounge</option>
                                    <option value='Malayalam'>Malayalam</option>
                                    <option value='Marathi'>Marathi</option>
                                    <option value='Meditation'>Meditation</option>
                                    <option value='Punjabi'>Punjabi</option>
                                    <option value='Rap'>Rap</option>
                                    <option value='Rock'>Rock</option>
                                    <option value='Tamizh'>Tamizh</option>
                                    <option value='Telugu'>Telugu</option>
                                </select>
                            </div>";
        $returndata = "<h2>RADIO CHANNELS</h2>
                        <div class='container-innerbox'>
                            <div class='radioplayer'>
                                <p style='text-align:center'><label id='channelname'></label></p>
                                <audio controls='' class='topaudioplayer' id='radioplayer'>
                                        <source src='' type='audio/mp3'>
                                        <object type='application/x-shockwave-flash' data='/Resources/swfplayer.swf' width='200' height='20'>
                                        <param name='movie' value='/Resources/swfplayer.swf' />
                                        <param name='FlashVars' value='mp3=http://fileraja.com/Tamil/S/Sigaram_Thodu_160kbps/Takku_Takku-StarMusiQ.Com.mp3' />
                                        </object>
                                </audio>	
                                <p style='text-align:center;'><label id='radiostatus'></label></p>
                            </div>
                            $sortbuttons
                            <div style='clear:both'></div>
                            <div class='radiocontent'>"
                . $this->loadradiosfromdb($langfilter) .
                "<div style='clear:both'></div>" .
                "</div>
                        </div>";
        return $returndata;
    }

    public function loadradiosfromdb($radiofilter) {
        $obj_db_data = new datafetch();
        $resultdata = $obj_db_data->getradiolist($radiofilter);
        $htmldata = "";

        if ($resultdata == FALSE) {
            $htmldata = "Connection Problem .. Pls Try again in 10 Seconds....";
        } else {
            if ($_SESSION["currentpage"] == "index.php") {
                $radioslength = 6;
            } else {
                $radioslength = mysqli_num_rows($resultdata);
            }
            for ($i = 0; $i < $radioslength; $i++) {
                $result = mysqli_fetch_row($resultdata);
                $htmldata = $htmldata . " <section class='boxcontent'>
                                                <h3>" . $result[1] . "</h3>
                                                <p>Language : " . $result[3] . "</p>
                                                <p>Rating : " . $result[5] . "</p>
                                                <p class=''><a id='playbutton" . $result[0] . "' class='btn-sm' urlpath='" . $result[2] . "' fmname='" . $result[1] . "' >Play</a></p>
                                        </section>";
                if (($i % 2) == 0 && $i > 0) {
                    $htmldata = $htmldata . "<div class='separator-aside'></div>";
                }
            }
        }
        return $htmldata;
        //return $resultdata;
    }

    public function Loginstat() {
        if (!isset($_SESSION["userid"])) {
            header('Location:Login.php');
            //echo "<script>location.href='Login.php'</script>";
        }
    }

    public function adminloginstat() {
        $obj_admin = new datafetch();
        $result = $obj_admin->adminlogincheck($_SESSION["userid"]);
        if (mysqli_num_rows($result) == 0) {
            echo "<script>location.href='Login.php'</script>";
        }
    }

    public function Signupdata($name, $email, $password) {
        $obj = new datafetch();
        $res = $obj->signupform($name, $email, $password);
        return $res;
    }

    Public function videoApprovedata() {
        $obj1 = new datafetch();
        return $obj1->approvevideoupdate($_GET['Videoid'], $_GET['statusval']);
    }

    public function Logindata($emailaddr, $password) {
        $obj = new datafetch();
        $res = $obj->logincheck($emailaddr, $password);
        if (mysqli_num_rows($res) > 0) {
            $res_set = mysqli_fetch_row($res);
            $_SESSION["userid"] = $res_set[0];
            $_SESSION["username"] = $res_set[1];
            if (isset($_SESSION["currentpage"])) {
                echo $_SESSION["currentpage"];
            } else {
                echo "Home.php";
            }
        } else {
            echo "Failure";
        }
    }

    public function Logoffdata() {
        try {
            if (isset($_SESSION["userid"])) {
                unset($_SESSION["userid"]);
                unset($_SESSION["lastpage"]);
                unset($_SESSION["username"]);
                header("location: Home.php");
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function profiledetails($param) {
        $prfobj = new datafetch();
        $result_data = $prfobj->getprofiledetails($param);
        $result = mysqli_fetch_row($result_data);
        $returndata = "<div class='col-sm-12'>
                            <h2>Profile Details</h2>
                        </div>
                        <div  class='col-sm-12' id='profileinfopanel'>
                            
                                    <form action='#' onsubmit='javascript:updateprofileinfo(); return false;' id='profilefrm' role='form'>
                                        <div id='profilepanel'>
                                            <div class='form-group' style='text-align:center'>
                                                <label for='profileimg'>Profile Image</label><br />";
                
        if(file_exists('Other Data/Images/prof_img_'.$_SESSION["userid"].'.jpg') == TRUE)
        {
            $returndata=$returndata."<img id='profileimage' src='Other Data/Images/prof_img_".$_SESSION["userid"].".jpg' alt='Profile Image' style='width:150px;height:150px;' />";
        }
        else if(file_exists('Other Data/Images/prof_img_'.$_SESSION["userid"].'.pnh') == TRUE)
        {
            $returndata=$returndata."<img id='profileimage' src='Other Data/Images/prof_img_".$_SESSION["userid"].".png' alt='Profile Image' style='width:150px;height:150px;' />";
        }
        else
        {
            $returndata=$returndata."<img id='profileimage' src='Images/prof_img.png' alt='Profile Image' style='width:150px;height:150px;' />";
        }
                                  $returndata=$returndata."<input type='file' id='imgInp' style='margin-top:2%' />
                                            </div>
                                            <div class='form-group'>
                                                <label for='name'>Name</label>
                                                <input type='text' class='form-control' name='name' id='name' placeholder='Enter name'  title='Please enter your name (at least 2 characters)' value='$result[1]' />
                                            </div>
                                            <div class='form-group'>
                                                <label for='email'>Email/UserName</label>
                                                <input type='email' class='form-control' name='email' id='email' placeholder='Enter Email or UserName' title='Please enter a valid email address' value='$result[2]' />
                                            </div>
                                            <div class='form-group'>
                                                <label for='birthdate'>Birthdate</label>
                                                <input type='date' class='form-control' name='birthdate' id='birthdate' placeholder='Enter the Birthdate' title='Please enter the Birthdate' value='$result[4]' />
                                            </div>
                                            <div class='form-group'>
                                                <label for='gender'>Gender</label>
                                                <select class='form-control' name='gender' id='gender' placeholder='Select the Gender' title='Please Select the Gender'>
                                                    <option> -- Please Select the Gender -- </option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label for='mobileno'>MobileNo</label>
                                                <input type='tel' class='form-control' name='mobileno' id='mobileno' placeholder='Enter the Mobile No' title='Please enter a valid Mobile Number' value='$result[6]' />
                                            </div>
                                            <div class='form-group'>
                                                <label for='language'>Language Preferred</label>
                                                <input type='text' class='form-control' name='language' id='language' placeholder='Enter the Preferred Language' title='Please enter a valid Language' value='$result[7]' />
                                            </div>
                                            <script>$('#profilestatus').hide();</script>
                                            <div id='profilestatus' class='col-md-12' style='text-align: center;margin-bottom:2%;width:100% !important;margin-left:0% !important;'></div>
                                            <button name='submit' type='submit' class='btn-sm nopadding' id='submit'>
                                                Update Profile
                                            </button>
                                        </div>
                                    </form>
                                </div><br /><br />"
                                . "<div class='clearfix'></div>";

        return $returndata;
    }

    public function videoviewincrement($param) {
        $viewcountobj = new datafetch();
        $viewcountobj->Videoviewincrementdb($param);
    }

    public function AudioViewIncrement($param) {
        $viewcountobj = new datafetch();
        $viewcountobj->audioviewincrementdb($param);
    }

    public function UpdateProfileInfo($name, $email, $birthdate, $gender, $mobileno, $language,$imagedata) {
        $viewcountobj = new datafetch();
        $res = $viewcountobj->updateprofileinfodb($name, $email, $birthdate, $gender, $mobileno, $language,$imagedata);
        return $res;
    }

    public function InsertContactUs($name, $email, $phoneno, $comment) {
        $contactobj = new datafetch();
        $result_v = $contactobj->insertcontactusdb($name, $email, $phoneno, $comment);
        return $result_v;
    }

    public function PutSignupData($name, $email, $password) {
        $signupobj = new datafetch();
        $res = $signupobj->putsignupdatadb($name, $email, $password);
        if ($res == "Success") {
            
        } else {
            
        }
    }

    public function CreateMusicAlbum($name, $albumimage) {
        $albumcreateobj = new datafetch();
        $res = $albumcreateobj->createmusicalbum($name, $albumimage);
        $_SESSION["musicalbumid"] = $res;
        return $res;
    }

    public function InsertTrackInfo($name, $orgname, $albumid) {
        $instrackinfoobj = new datafetch();
        $res = $instrackinfoobj->inserttrackinfo($name, $orgname, $albumid, 0);
        return $res;
    }

    public function UpdateMusicAlbum($albumtype, $composername, $releaseyear, $language) {
        $updatemusicalbumobj = new datafetch();
        $albumid = $_SESSION["musicalbumid"];
        $res = $updatemusicalbumobj->updatemusicalbum($albumid, $albumtype, $composername, $releaseyear, $language);
        return $res;
    }

    public function GetAudiosFromDB($input, $startlimit) {
        $object_audio_fetchv = new datafetch();
        $audio_result_datav = $object_audio_fetchv->getaudios($input, $startlimit);
        $length = mysqli_num_rows($audio_result_datav);
        $lock = 0;
        $htmldatav = "";
        if ($audio_result_datav == FALSE) {
            $htmldatav = "Connection Problem .. Pls Try again in 10 Seconds....";
        } else {
            for ($i = 0; $i < $length; $i++) {
                $resultv = mysqli_fetch_row($audio_result_datav);
                if ($lock == 0) {
                    if (file_exists("Other Data/Images/Aud_$resultv[0]_share.png") == false) {
                        $object_data_temp_fetchv = new datafetch();
                        $result_temp_datav = $object_data_temp_fetchv->getImageArt($resultv[0], 1);
                        $resultv_temp = mysqli_fetch_row($result_temp_datav);
                        $imgdata = substr($resultv_temp[0], strpos($resultv_temp[0], ",") + 1);
                        file_put_contents("Other Data/Images/Aud_$resultv[0]_share.png", base64_decode($imgdata));
                    }
                    $htmldatav = $htmldatav . "<div class='audiotiles'>"
                            . "<img src='Other data/Images/Aud_$resultv[0]_share.png' width='100%' height='75%' />"
                            . "</a>"
                            . "<div class='audiotilesa' style='max-height:20px;overflow:hidden;'>"
                            . "<p style='margin:0px !important;text-align:left !important;'>" . $resultv[1] . " - " . $resultv[4] . "</p></div>"
                            . "<div style='margin-top:5px;'>"
                            . "<div style='float:left;'><button class='fa fa-play'  style='margin-left:5px;' onclick='javascript:playalbum($resultv[0],0);'></button></div>"
                            . "<div style='float:left;'><button class='fa fa-plus'  style='margin-left:5px;' onclick='javascript:playalbum($resultv[0],1);'></button></div>"
                            . "<div style='float:left;'><button class='fa fa-download'  style='margin-left:5px;' onclick='javascript:redirectdownloadpage($resultv[0]);'></button></div>"
                            . "<div style='float:right;margin-right:15px;'>$resultv[7] Hits</div></div>"
                            . "</div>";
                }
            }
        }
        return $htmldatav;
    }

    public function PlayMusicAlbum($albumid) {
        $resultdata = '';
        $playalbobj = new datafetch();
        $res = $playalbobj->playmusicalbum($albumid);
        $length = mysqli_num_rows($res);
        for ($i = 0; $i < $length; $i++) {
            $resultv = mysqli_fetch_row($res);
            $resultdata = $resultdata . "title : '$resultv[1]',mp3 : 'Other Data/Audio Files/$resultv[0].mp3',poster:'$resultv[2]'@!#$";
        }
        return $resultdata;
    }

    public function GetFilenames($param, $type) {
        $returndata = array();
        $objfilename = new datafetch();
        $contentdata = $objfilename->getfilenames($param, $type);
        for ($index = 0; $index < mysqli_num_rows($contentdata); $index++) {
            $res = mysqli_fetch_row($contentdata);
            if ($type == 0) {
                $returndata[$index] = $res[0] . ".mp4@" . str_replace(".mp4", "", $res[1]);
            } else {
                $returndata[$index] = $res[0] . ".mp3@" . str_replace(".mp3", "", $res[1]);
            }
        }
        return $returndata;
    }

    public function GetAlbumName($param) {
        $objfilename = new datafetch();
        $contentdata = $objfilename->getalbumname($param);
        $returndata = mysqli_fetch_row($contentdata);
        return $returndata[0];
    }

    public function GetVideoName($param) {
        $objfilename = new datafetch();
        $contentdata = $objfilename->getvideoname($param);
        $returndata = mysqli_fetch_row($contentdata);
        return $returndata[0];
    }

    public function GetFileInfoforDownload($param, $type) {
        $objdownload = new datafetch();
        $res = $objdownload->getfileinfofordownload($param, $type);
        $resultdata = mysqli_fetch_row($res);
        $htmldata = "<div class='col-xs-12'>
                                    <h2>Downloads</h2>
                                    <div class='videolist' id='downloadpagecontent' style='padding-top:0px !important'>
                                        <div class='col-sm-12'>
                                            <div class='col-sm-7'>
                                                <div class='videotiles1' id='posterimgdiv' style='width: 100% !important;height:100% !important;'>";
        if ($type == 0) {
            $htmldata = $htmldata . "<img id='posterimg' src='data:image/png;base64," . base64_encode($resultdata[4]) . "' width='100%' height='100%'>";
        } else {
            $htmldata = $htmldata . "<img src='$resultdata[4]' id='posterimg' width='100%' height='360px'>";
        }

        $htmldata = $htmldata . "</div>
                                            </div>
                                            <div class='col-sm-5'>
                                                <div class='videotiles1' style='width: 100% !important;height: 360px;padding:10px;'>
                                                    <div style='margin-top: 2%;border-bottom: 1px solid #ccc'>
                                                        <h2>File Information</h2>
                                                    </div>";
        if ($type == 0) {
            $htmldata = $htmldata . "<div class='downloadcontent'>
                                                        <b>File Name :</b> $resultdata[0] 
                                                    </div>
                                                    <div class='downloadcontent'>
                                                        <b>Movie or Album :</b> $resultdata[1]
                                                    </div>";
        } elseif ($type == 1) {
            $htmldata = $htmldata . "<div class='downloadcontent'>
                                                        <b>Album Name :</b> $resultdata[0] 
                                                    </div>
                                                    <div class='downloadcontent'>
                                                        <b>Composer Name :</b> $resultdata[1]
                                                    </div>";
        } else {
            
        }
        $htmldata = $htmldata . "<div class='downloadcontent'>
                                                        <b>Uploaded By :</b> $resultdata[3] 
                                                    </div>
                                                    <div class='downloadcontent'>
                                                        <b>Uploaded on :</b> $resultdata[2]
                                                    </div>
                                                    <div class='downloadcontent' id='googlecaptcha'>
                                                        <div class='form-group'>
                                                             <div class='g-recaptcha' data-sitekey='6LfJJiATAAAAALyQEy9w8osAqFZ_8_MKh1X2d_fM'></div>
                                                        </div>
                                                    </div>
                                                    <div class='downloadcontent'>";
        if ($type == 0) {
            $htmldata = $htmldata . "<a href='download_process.php?VideoId=$param&Type=0' class='btn-sm'>Download</a>";

            $htmldata = $htmldata . "<div style='text-align:center'>";
            $htmldata = $htmldata . "<div id='shortshareitdiv' style='float:left;'> 
                            <br />
                            <div style='float:right;margin-left:15px'><a class='fa fa-google-plus' href='https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=$param' onclick='window.open('https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=$param','name','width=600,height=400')' target='popup'></a> </div>
                            <div style='float:right;margin-left:15px'><a class='fa fa-twitter' href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vv.php?Vpl=$param' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vv.php?Vpl=$param','name','width=600,height=400')' target='popup'></a></div>
                            <div style='float:right;margin-left:15px'><a class='fa fa-facebook' href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=$param' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=$param','name','width=600,height=400')' target='popup'></a></div>
                            
                        </div>";
            $htmldata = $htmldata . "</div>";
        } elseif ($type == 1) {
            $htmldata = $htmldata . "<a href='download_process.php?AlbumId=$param&Type=1' class='btn-sm'>Download</a>";

            $htmldata = $htmldata . "<div style='text-align:center'>";


            $htmldata = $htmldata . "<div id='shortshareitdiv' style='float:left;padding-left:15px;text-align:left;'> 
                                    <br />
                                    <div style='float:right;margin-left:15px'><a class='fa fa-google-plus' href='https://plus.google.com/share?url=http://www.filmboard.in/Downloads_View.php?AlbumId=$param' onclick='window.open('https://plus.google.com/share?url=http://www.filmboard.in/Downloads_View.php?AlbumId=$param','name','width=600,height=400')' target='popup'></a> </div>
                                    <div style='float:right;margin-left:15px'><a class='fa fa-twitter' href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Downloads_View.php?AlbumId=$param' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Downloads_View.php?AlbumId=$param','name','width=600,height=400')' target='popup'></a></div>
                                    <div style='float:right;margin-left:15px'><a class='fa fa-facebook' href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Downloads_View.php?AlbumId=$param' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Downloads_View.php?AlbumId=$param','name','width=600,height=400')' target='popup'></a></div>
                                    
                                </div>";
            $htmldata = $htmldata . "</div>";
        } else {
            
        }

        $htmldata = $htmldata . "</div>
                                </div>
                                </div>";
        if ($type == 0) {
            $htmldata = $htmldata . "<div id='shareitdiv' style='float:left;'> 
                            <br /><div style='float:left;margin-left:5px'><a class='fa fa-facebook' href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=$param' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=$param','name','width=600,height=400')' target='popup'></a></div>
                            <div style='float:left;margin-left:5px'><a class='fa fa-twitter' href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vv.php?Vpl=$param' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vv.php?Vpl=$param','name','width=600,height=400')' target='popup'></a></div>
                            <div style='float:left;margin-left:5px'><a class='fa fa-google-plus' href='https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=$param' onclick='window.open('https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=$param','name','width=600,height=400')' target='popup'></a> </div>
                        </div>";
        } elseif ($type == 1) {
            $htmldata = $htmldata . "<div id='shareitdiv' style='float:left;padding-left:15px;text-align:left;'>
                                    <br />
                                    <div style='float:left;margin-left:5px'><a class='fa fa-facebook' href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Downloads_View.php?AlbumId=$param' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Downloads_View.php?AlbumId=$param','name','width=600,height=400')' target='popup'></a></div>
                                    <div style='float:left;margin-left:5px'><a class='fa fa-twitter' href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Downloads_View.php?AlbumId=$param' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Downloads_View.php?AlbumId=$param','name','width=600,height=400')' target='popup'></a></div>
                                    <div style='float:left;margin-left:5px'><a class='fa fa-google-plus' href='https://plus.google.com/share?url=http://www.filmboard.in/Downloads_View.php?AlbumId=$param' onclick='window.open('https://plus.google.com/share?url=http://www.filmboard.in/Downloads_View.php?AlbumId=$param','name','width=600,height=400')' target='popup'></a> </div>
                                </div>";
        }

        $htmldata = $htmldata . "<div class='clearfix'></div><br /><br /></div>
                                    </div>
                                </div>";
        return $htmldata;
    }

    public function SetPasswordReset($param) {
        $objpass = new datafetch();
        $res = $objpass->setpasswordreset($param);
        $tempret = "";
        if (mysqli_num_rows($res) == 1) {
            $result = mysqli_fetch_row($res);
            include("class.phpmailer.php"); //you have to upload class files "class.phpmailer.php" and "class.smtp.php"
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = "mail.filmboard.in";
            $mail->Username = "SupportTeam@filmboard.in";
            $mail->Password = "Ganesh@762";
            $mail->From = "SupportTeam@filmboard.in";
            $mail->FromName = "FilmBoard SupportTeam";
            $mail->AddAddress("$result[0]", "");
            $mail->Subject = "FilmBoard - Password Reset";
            $mail->Body = "<h2>Password Recovery</h2><br><p>Please find the below mentioned Login Credentials of Your Account in Filmboard.in</p><br><b>UserName : </b>$result[0] <br><b>Password : </b> $result[1] <br> "
                    . "<br><a href='www.filmboard.in/Login.php'>Click here to Login into Filmboard.in</a><br><br> Regards,<br>SupportTeam - Funraaga";
            $mail->WordWrap = 50;
            $mail->IsHTML(true);
            $str1 = "gmail.com";
            $str2 = strtolower("SupportTeam@filmboard.in");
            If (strstr($str2, $str1)) {
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                if (!$mail->Send()) {
                    //echo "Mailer Error: " . $mail->ErrorInfo;
                    //echo "<br><br> * Please double check the user name and password to confirm that both of them are correct. <br><br>";
                    //echo "* If you are the first time to use gmail smtp to send email, please refer to this link :http://www.smarterasp.net/support/kb/a1546/send-email-from-gmail-with-smtp-authentication-but-got-5_5_1-authentication-required-error.aspx?KBSearchID=137388";
                    $tempret = "Failure";
                } else {
                    //echo "Message has been sent";
                    $tempret = "Success";
                }
            } else {
                $mail->Port = 25;
                if (!$mail->Send()) {
                    //echo "Mailer Error: " . $mail->ErrorInfo;
                    //echo "<br><BR>* Please double check the user name and password to confirm that both of them are correct. <br>";
                    $tempret = "Failure";
                } else {
                    //echo "Message has been sent";
                    $tempret = "Success";
                }
            }
        } else {
            $tempret = "Failure";
        }

        return $tempret;
    }

    public function insertPostCard($postcontent, $previewurl, $previewurlimg, $previewurltitle, $previewurldesc, $previewurlsite) {
        $postcardobj = new datafetch();
        $imagesid = "";
        $videoid = "";
        if ($_SESSION["postcardimages"] != "") {
            $imagesid = $_SESSION["postcardimages"];
            $_SESSION["postcardimages"] = "";
        }
        if ($_SESSION["postcardvideo"] != "") {
            $videoid = $_SESSION["postcardvideo"];
            $_SESSION["postcardvideo"] = "";
        }
        $cstring = htmlspecialchars($postcontent, ENT_QUOTES) . " " . $previewurl . " " . htmlspecialchars($previewurldesc, ENT_QUOTES) . " " . $previewurlimg . " " . htmlspecialchars($previewurltitle, ENT_QUOTES) . " " . $previewurlsite;
        $checkval = $this->checkBannedWords($cstring);
        if ($checkval == true) {
            echo $postcardobj->insertpostcard(htmlspecialchars($postcontent, ENT_QUOTES), $previewurl, $previewurlimg, htmlspecialchars($previewurltitle, ENT_QUOTES), htmlspecialchars($previewurldesc, ENT_QUOTES), $previewurlsite, $imagesid, $videoid);
        } else {
            echo "The Data in the post card contains the Blocked/Banned/Censored words or links -- '" . $_SESSION["blockedword"] . "'";
        }
    }

    public function displayPostCards($search, $type,$startlimit) {
        $displaycardobj = new datafetch();
        $resultreturn = $displaycardobj->displaypostcards($search, $type,$startlimit);
        $length = mysqli_num_rows($resultreturn);
        $divcontainer = "";
        $sharedata="";
        $divcontainerleft = "<div class='postcardleft'>";
        $divcontainerright = "<div class='postcardright'>";
        
        if($type != 3 & $type != 1)
        {
            $divcontainerleft=$divcontainerleft."<div class='individual_postboxdiv'>
                <div style='float: left; width: 10%;'>";
            if(isset($_SESSION["userid"]))
            {
                if(file_exists("Other Data/Images/prof_img_".$_SESSION['userid'].".jpg") == TRUE)
                {
                    $divcontainerleft=$divcontainerleft. "<a href='MyAccount.php?type=profileinfo'><img src='Other Data/Images/prof_img_".$_SESSION['userid'].".jpg' alt='' class='postboxprofilephoto' /></a>";
                }
                else if(file_exists("Other Data/Images/prof_img_".$_SESSION['userid'].".png") == TRUE)
                {
                    $divcontainerleft=$divcontainerleft. "<a href='MyAccount.php?type=profileinfo'><img src='Other Data/Images/prof_img_".$_SESSION['userid'].".png' alt='' class='postboxprofilephoto' /></a>";
                }
                else
                {
                   $divcontainerleft=$divcontainerleft. "<a href='MyAccount.php?type=profileinfo'><img src='Images/prof_img.png' class='postboxprofilephoto' /></a>"; 
                }
            }
            else
            {
                $divcontainerleft=$divcontainerleft. "<img src='Images/prof_img.png' class='postboxprofilephoto' />";
            }
            $divcontainerleft=$divcontainerleft. "</div>
                <div style='float: left;width: 90%;'>";
            if(isset($_SESSION["userid"]))
            {
                $divcontainerleft=$divcontainerleft."<textarea class='postbox' id='postboxtext' placeholder='Write a card for your friends...'></textarea>";
            }
            else
            {
                $divcontainerleft=$divcontainerleft."<p style='margin-left:10px;'> Please Login for 'Writting a Card to your Friends.'</p>";
            }
            $divcontainerleft=$divcontainerleft." </div>
                <div class='clearfix'></div>";
            if(isset($_SESSION["userid"]))
            {
                $divcontainerleft=$divcontainerleft."<div id='photoupload' style='margin-top: 5px;'>
                    <form action='Imageupload.php' class='dropzone' id='file'>
                        <div class='dz-default dz-message'><span>Add Images to Uploads.</span></div>
                    </form>
                </div>
                <div class='clearfix'></div>
                <div class='linkpreviewloading' style='text-align: center'>
                    <img src='images/loading.gif' width='40' height='40' />
                </div>
                <div class='linkpreview' id='linkpreview'>
                    <a href='' id='linkpreviewurl'>
                        <div class='linkpreviewinline'>
                            <img src='' class='linkpreviewimg' id='linkpreviewimg'/>
                        </div>
                        <div class='linkpreviewtitle' id='linkpreviewtitle'></div>
                        <div class='linkpreviewdesc' id='linkpreviewdesc'></div>
                        <div class='linkpreviewsite' id='linkpreviewsite'></div>
                    </a>
                </div>";
            }
            
            $divcontainerleft=$divcontainerleft."<div class='clearfix'></div><br />
                                                    <div class='postboxdivcontents'>";
            if(isset($_SESSION["userid"]))
            {
                $divcontainerleft=$divcontainerleft."<div class='pull-left'>
                                                            <a href='#' class='pull-left' style='margin-right: 8px'><img src='images/add_image.png' class='postboxdivcontentsicons' onclick='showimagepanel();' /></a>
                                                            <!-- <a href='#' class='pull-left'><img src='images/add_video.png' class='postboxdivcontentsicons' onclick='showvideopanel();' /></a> -->
                                                        </div>
                                                        <div class='pull-right'><a href='#' class='btn-sm' onclick='loadpostcontentdata();'>Post Card</a></div>";
            }
            else
            {
                $divcontainerleft=$divcontainerleft."<div class='pull-right'><a href='Login.php' class='btn-sm' >Login</a></div>";
            }
            
            $divcontainerleft=$divcontainerleft."</div>
                                                    <div class='clearfix'></div>
                                                </div>";
        }
        
        for ($index = 0; $index < $length; $index++) {
            $htmldata = "";
            $result = mysqli_fetch_row($resultreturn);
            $playerhtml = "";
            if (strpos($result[6], "=") > 0) {
                $idpos = strrpos($result[6], "=");
                $idval = substr($result[6], $idpos + 1);
            } else {
                $idpos = strrpos($result[6], "/");
                $idval = substr($result[6], $idpos + 1);
                $idval = str_replace($result[6], "Vv.php?Vpl=", "");
            }

            if (strpos($result[6], "youtube")) {
                $playerhtml = "https://www.youtube.com/embed/$idval?rel=0&showinfo=0&iv_load_policy=3";
            } else {
                $playerhtml = "http://www.filmboard.in/Video Songs/$idval.mp4";
            }
            if(strpos($_SESSION["currentpage"],"Vp.php")  !== FALSE)
            {
                $htmldata = $htmldata . "<div class='col-sm-8'>";
            }
            $htmldata = $htmldata . "<div class='individual_postboxdiv'>";
            $htmldata = $htmldata . "<div class='postcarddp pull-left'>";
            if(file_exists("Other Data/Images/prof_img_".$result[17].".jpg") == TRUE)
            {
                $htmldata=$htmldata. "<a href='MyAccount.php?type=profileinfo'><img src='Other Data/Images/prof_img_".$result[17].".jpg' alt='' class='postboxprofilephoto' /></a>";
            }
            else if(file_exists("Other Data/Images/prof_img_".$result[17].".png") == TRUE)
            {
                $htmldata=$htmldata. "<a href='MyAccount.php?type=profileinfo'><img src='Other Data/Images/prof_img_".$result[17].".png' alt='' class='postboxprofilephoto' /></a>";
            }
            else
            {
               $htmldata=$htmldata. "<a href='MyAccount.php?type=profileinfo'><img src='Images/prof_img.png' class='postboxprofilephoto' /></a>"; 
            }
            
            $htmldata = $htmldata . "</div>
                                <div class='postcarddptitle pull-left'>
                                    $result[9]
                                </div>
                                <div class='postcarddate pull-left'>
                                    " . date_format(date_create($result[10]), 'jS F Y \a\t g:ia') . "
                                </div>
                                <div class='clearfix'></div>
                                <hr>
                                <div class='col-xs-12'>
                                    <div class='postcarddata'>";
            $postcontent = explode(" ", $result[1]);
            $postdata = "";
            for ($index1 = 0; $index1 < count($postcontent); $index1++) {
                if (strpos($postcontent[$index1], "http") > 0) {
                    $postdata = $postdata . "<a href='$postcontent[$index1]' target='_blank' style='text-decoration:underline !important;color:darkblue !important;'>$postcontent[$index1]</a> ";
                } elseif (strpos($postcontent[$index1], "#") === 0) {
                    $postdata = $postdata . "<a href='Home.php?tagsearch=" . str_replace("#", "", $postcontent[$index1]) . "' style='background-color:#dce6f8;text-decoration:underline !important;color:darkblue !important;'>$postcontent[$index1]</a> ";
                } else {
                    $postdata = $postdata . $postcontent[$index1] . " ";
                }
            }
            $htmldata = $htmldata . $postdata;
            $htmldata = $htmldata . "</div>";
            if ($result[2] != "" or $result[2] != null) {
                $htmldata = $htmldata . "<div id='slider'>
                                                        <a class='control_next'>></a>
                                                        <a class='control_prev'><</a>
                                                        <ul>";
                $imagesid = explode(",", $result[2]);
                for ($i = 0; $i < count($imagesid); $i++) {
                    if ($type == 1) {
                        $htmldata = $htmldata . "<li style='height:400px !important'>"
                                . "<a href='Other data/Images/Post_Img_$imagesid[$i]' target='_blank'><img class='postcardimages' src='Other data/Images/Post_Img_$imagesid[$i]' /></a>"
                                . "</li>";
                    } else {
                        $htmldata = $htmldata . "<li>"
                                . "<a href='Home.php?postid=$result[0]'><img class='postcardimages' src='Other data/Images/Post_Img_$imagesid[$i]' /></a>"
                                . "</li>";
                    }
                }
                $htmldata = $htmldata . "</ul>  
                                                      </div>";
            }
            if ($result[5] != "" or $result[5] != null) {
                $htmldata = $htmldata . "<div class='postcard'>
                                                        <a onclick='javascript:postcardplayerswitch($result[0]);'>
                                                            <div class='linkpreviewinline'>
                                                                <iframe id='ytplayer' type='text/html' width='480' height='300' src='$playerhtml' frameborder='0' allowfullscreen></iframe>
                                                            </div>
                                                            <div class='linkpreviewtitle'>
                                                                $result[5]
                                                            </div>
                                                            <div class='linkpreviewdesc'>
                                                                    $result[8]
                                                            </div>";
                if (strpos($_SESSION["currentpage"],"Vp.php")  !== FALSE) {
                    $htmldata = $htmldata . "<div class='linkpreviewsite'>
                                                                    No Of Views : $result[15]
                                                            </div>";
                } else {
                    /*$htmldata = $htmldata . "<div class='linkpreviewsite'>
                                            $result[4]
                                         </div>";*/
                }

                $htmldata = $htmldata . "</a>
                                                    </div>";
            }
            if (isset($_SESSION["userid"])) 
            {
                $htmldata = $htmldata . "<div class='col-xs-12 postcardsocial'>
                                        <div class='postcardlike pull-left btn-sm-rev' onclick='javascript:cardaction($result[0],1);'>";
                if($result[16]== "" || $result[16] == NULL || $result[16] !=1)
                {
                    $htmldata=$htmldata."<i class='fa fa-thumbs-o-up' id='i_like_$result[0]'></i><span id='span_like_$result[0]'>$result[11]</span>";
                }
                elseif($result[16] == 1)
                {
                    $htmldata=$htmldata."<i class='fa fa-thumbs-up' id='i_like_$result[0]'></i><span id='span_like_$result[0]'>$result[11]</span>";
                }
                                            
                $htmldata=$htmldata."</div>
                                    <div class='postcardunlike pull-left btn-sm-rev' onclick='javascript:cardaction($result[0],2);'>";
                if($result[16] == "" || $result[16] == NULL || $result[16] != 2)
                {
                    $htmldata=$htmldata."<i class='fa fa-thumbs-o-down' id='i_unlike_$result[0]'></i><span id='span_unlike_$result[0]'>$result[12]</span>";
                }
                elseif($result[16] == 2)
                {
                    $htmldata=$htmldata."<i class='fa fa-thumbs-down' id='i_unlike_$result[0]'></i><span id='span_unlike_$result[0]'>$result[12]</span>";
                }
                                        
                $htmldata=$htmldata."</div>";
                
                if (strpos($_SESSION["currentpage"],"Vp.php")  !== FALSE) {
                    $htmldata = $htmldata . "<div class='postcardreport pull-left btn-sm-rev' onclick='javascript:cardaction($result[0],4);'>";
                    if($result[16] == '' || $result[16]== NULL || $result[16]!=4)
                    {
                        $htmldata=$htmldata."<i class='fa fa-flag-o' id='i_report_$result[0]' ></i><span id='span_report_$result[0]'>$result[14]</span>";
                    }
                    elseif($result[16] == 4)
                    {
                        $htmldata=$htmldata."<i class='fa fa-flag' id='i_report_$result[0]' ></i><span id='span_report_$result[0]'>$result[14]</span>";
                    }
                    $htmldata=$htmldata."</div>";
                    
                    $htmldata = $htmldata . "<div class='col-xs-4 pull-right postcardsocialshareindividual'>"
                            . "<div class='socialshareicons'>"
                            . "<a href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                            . "<i class='fa fa-facebook'></i>"
                            . "</a>"
                            . "</div>"
                            . "<div class='socialshareicons'>"
                            . "<a href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                            . "<i class='fa fa-twitter'></i>"
                            . "</a>"
                            . "</div>"
                            . "<div class='socialshareicons'>"
                            . "<a href='https://plus.google.com/share?url=http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('https://plus.google.com/share?http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                            . "<i class='fa fa-google-plus'></i>"
                            . "</a>"
                            . "</div>"
                            . "</div>";
                } else {
                    $htmldata = $htmldata . "<div class='postcardshare pull-left btn-sm-rev' onclick='javscript:Sharepost($result[0]);'>
                                            <i class='fa fa-share' id='i_share_$result[0]' ></i><span id='span_share_$result[0]'>$result[13]</span>
                                        </div>";
                    $htmldata = $htmldata . "<div class='postcardreport pull-left btn-sm-rev' onclick='javascript:cardaction($result[0],4);'>";
                    if($result[16] == '' || $result[16]== NULL || $result[16]!=4)
                    {
                        $htmldata=$htmldata."<i class='fa fa-flag-o' id='i_report_$result[0]' ></i><span id='span_report_$result[0]'>$result[14]</span>";
                    }
                    elseif($result[16] == 4)
                    {
                        $htmldata=$htmldata."<i class='fa fa-flag' id='i_report_$result[0]' ></i><span id='span_report_$result[0]'>$result[14]</span>";
                    }
                    $htmldata=$htmldata."</div>";
                }
                
                                            
                $htmldata=$htmldata."</div>";
                
                $htmldata = $htmldata . "<div class='col-xs-12 postcardsocialshare'>"
                        . "<div class='socialshareicons'>"
                        . "<a href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                        . "<i class='fa fa-facebook'></i>"
                        . "</a>"
                        . "</div>"
                        . "<div class='socialshareicons'>"
                        . "<a href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                        . "<i class='fa fa-twitter'></i>"
                        . "</a>"
                        . "</div>"
                        . "<div class='socialshareicons'>"
                        . "<a href='https://plus.google.com/share?url=http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('https://plus.google.com/share?http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                        . "<i class='fa fa-google-plus'></i>"
                        . "</a>"
                        . "</div>"
                        . "</div>";
            }
            else
            {
                $htmldata = $htmldata . "<div class='col-xs-12 postcardsocial'>
                                            <div class='postcardlike pull-left btn-sm-rev' onclick='javascript:cardaction($result[0],0);'>
                                                <i class='fa fa-thumbs-o-up' id='i_like_$result[0]'></i><span id='span_like_$result[0]'>$result[11]</span>
                                            </div>
                                            <div class='postcardunlike pull-left btn-sm-rev' onclick='javascript:cardaction($result[0],1);'>
                                                <i class='fa fa-thumbs-o-down' id='i_unlike_$result[0]'></i><span id='span_unlike_$result[0]'>$result[12]</span>
                                            </div>";
                if (strpos($_SESSION["currentpage"],"Vp.php")  !== FALSE) {
                    $htmldata = $htmldata . "<div class='col-xs-6 pull-left postcardsocialshareindividual'>"
                            . "<div class='socialshareicons'>"
                            . "<a href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                            . "<i class='fa fa-facebook'></i>"
                            . "</a>"
                            . "</div>"
                            . "<div class='socialshareicons'>"
                            . "<a href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                            . "<i class='fa fa-twitter'></i>"
                            . "</a>"
                            . "</div>"
                            . "<div class='socialshareicons'>"
                            . "<a href='https://plus.google.com/share?url=http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('https://plus.google.com/share?http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                            . "<i class='fa fa-google-plus'></i>"
                            . "</a>"
                            . "</div>"
                            . "</div>";
                } else {
                    $htmldata = $htmldata . "<div class='postcardshare pull-left btn-sm-rev' onclick='javscript:Sharepost($result[0]);'>
                                            <i class='fa fa-share' id='i_share_$result[0]' ></i><span id='span_share_$result[0]'>$result[13]</span>
                                        </div>";
                }
                /*$htmldata = $htmldata . "<div class='postcardreport pull-right btn-sm-rev' onclick='javascript:cardaction($result[0],2);'>";
                if($result[16] == '' || $result[16]== NULL || $result[16]==0)
                {
                    $htmldata=$htmldata."<i class='fa fa-flag-o' id='i_report_$result[0]' ></i><span id='span_report_$result[0]'>$result[14]</span>";
                }
                elseif($result[16] == 2)
                {
                    $htmldata=$htmldata."<i class='fa fa-flag' id='i_report_$result[0]' ></i><span id='span_report_$result[0]'>$result[14]</span>";
                }
                                            
                $htmldata=$htmldata."</div>
                                </div>";*/
                $htmldata=$htmldata."</div>";
                $htmldata = $htmldata . "<div class='col-xs-12 postcardsocialshare'>"
                        . "<div class='socialshareicons'>"
                        . "<a href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                        . "<i class='fa fa-facebook'></i>"
                        . "</a>"
                        . "</div>"
                        . "<div class='socialshareicons'>"
                        . "<a href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                        . "<i class='fa fa-twitter'></i>"
                        . "</a>"
                        . "</div>"
                        . "<div class='socialshareicons'>"
                        . "<a href='https://plus.google.com/share?url=http://www.filmboard.in/Vp.php?pid=$search' onclick='window.open('https://plus.google.com/share?http://www.filmboard.in/Vp.php?pid=$search','name','width=600,height=400')' target='popup'>"
                        . "<i class='fa fa-google-plus'></i>"
                        . "</a>"
                        . "</div>"
                        . "</div>";
            }
            if(strpos($_SESSION["currentpage"],"Vp.php")  !== FALSE)
            {
                $htmldata = $htmldata . "</div>"
                                      . "<div class='clearfix'></div>"
                                      . "</div>"
                                      . "</div>"
                                      . "<div class='col-sm-4' id='gadssystem' style='border:5px solid #FF5511;'>"
                                      . "<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
                                            <!-- Filmboard_video_post_ad -->
                                            <ins class='adsbygoogle'
                                                 style='display:inline-block;width:250px;height:390px'
                                                 data-ad-client='ca-pub-8205498786717408'
                                                 data-ad-slot='7616212101'></ins>
                                            <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>"
                                      . "</div>"
                                      . "<div class='col-sm-4' id='gadsmobile style='border:5px solid #FF5511;'>"
                                      . "<script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
                                            <!-- filmboard_video_post_mobile_ad -->
                                            <ins class='adsbygoogle'
                                                 style='display:inline-block;width:320px;height:100px'
                                                 data-ad-client='ca-pub-8205498786717408'
                                                 data-ad-slot='3046411709'></ins>
                                            <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                            </script>"
                                      . "</div>";
            }
            else
            {
                $htmldata = $htmldata . "</div><div class='clearfix'></div></div>";
            }
            if($type == 3 || $type == 1)
            {
                $sharedata = $htmldata;
            }
            else
            {
                if($index %2 == 0)
                {
                    $divcontainerleft = $divcontainerleft. $htmldata;
                }
                else
                {
                    $divcontainerright = $divcontainerright . $htmldata;
                }
            }
            
        }
        if($type==3 || $type == 1)
        {
            $divcontainer=$sharedata;
            $divcontainer=$divcontainer."</div><div class='clearfix'></div>";
        }
        else
        {
            $divcontainerleft=$divcontainerleft."</div>";
            $divcontainerright=$divcontainerright."</div>";
            $divcontainer=$divcontainerleft.$divcontainerright;
            $divcontainer=$divcontainer."</div><div class='clearfix'></div>";
        }
        
        return $divcontainer;
    }

     public function displayMyPostCards() {
        $displaycardobj = new datafetch();
        $resultreturn = $displaycardobj->displaymypostcards($_SESSION["userid"]);
        $length = mysqli_num_rows($resultreturn);
        $type=1;
        $divcontainer = "";
        $divcontainerleft = "<div class='postcardleft'>";
        $divcontainerright = "<div class='postcardright'>";
        for ($index = 0; $index < $length; $index++) {
            $htmldata = "";
            $result = mysqli_fetch_row($resultreturn);
            $playerhtml = "";
            if (strpos($result[6], "=") > 0) {
                $idpos = strrpos($result[6], "=");
                $idval = substr($result[6], $idpos + 1);
            } else {
                $idpos = strrpos($result[6], "/");
                $idval = substr($result[6], $idpos + 1);
                $idval = str_replace($result[6], "Vv.php?Vpl=", "");
            }

            if (strpos($result[6], "youtube")) {
                $playerhtml = "https://www.youtube.com/embed/$idval?rel=0&showinfo=0&iv_load_policy=3";
            } else {
                $playerhtml = "http://www.filmboard.in/Video Songs/$idval.mp4";
            }
            $htmldata = $htmldata . "<div class='individual_postboxdiv'>";
            $htmldata = $htmldata . "<div class='postcarddp pull-left'>";
            if(isset($_SESSION["userid"]))
            {
                if(file_exists("Other Data/Images/prof_img_".$_SESSION['userid'].".jpg") == TRUE)
                {
                    $htmldata=$htmldata. "<a href='MyAccount.php?type=profileinfo'><img src='Other Data/Images/prof_img_".$_SESSION['userid'].".jpg' alt='' class='postboxprofilephoto' /></a>";
                }
                else if(file_exists("Other Data/Images/prof_img_".$_SESSION['userid'].".png") == TRUE)
                {
                    $htmldata=$htmldata. "<a href='MyAccount.php?type=profileinfo'><img src='Other Data/Images/prof_img_".$_SESSION['userid'].".png' alt='' class='postboxprofilephoto' /></a>";
                }
                else
                {
                   $htmldata=$htmldata. "<a href='MyAccount.php?type=profileinfo'><img src='Other Data/Images/prof_img.png' class='postboxprofilephoto' /></a>"; 
                }
            }
            else
            {
                $htmldata=$htmldata. "<img src='Other Data/Images/prof_img.png' class='postboxprofilephoto' />";
            }
            $htmldata = $htmldata . "</div>
                                <div class='postcarddptitle pull-left'>
                                    $result[9]
                                </div>
                                <div class='postcarddate pull-left'>
                                    " . date_format(date_create($result[10]), 'jS F Y \a\t g:ia') . "
                                </div>
                                <div class='clearfix'></div>
                                <hr>
                                <div class='col-xs-12'>
                                    <div class='postcarddata'>";
            $postcontent = explode(" ", $result[1]);
            $postdata = "";
            for ($index1 = 0; $index1 < count($postcontent); $index1++) {
                if (strpos($postcontent[$index1], "http") > 0) {
                    $postdata = $postdata . "<a href='$postcontent[$index1]' target='_blank' style='text-decoration:underline !important;color:darkblue !important;'>$postcontent[$index1]</a> ";
                } elseif (strpos($postcontent[$index1], "#") === 0) {
                    $postdata = $postdata . "<a href='Home.php?tagsearch=" . str_replace("#", "", $postcontent[$index1]) . "' style='background-color:#dce6f8;text-decoration:underline !important;color:darkblue !important;'>$postcontent[$index1]</a> ";
                } else {
                    $postdata = $postdata . $postcontent[$index1] . " ";
                }
            }
            $htmldata = $htmldata . $postdata;
            $htmldata = $htmldata    . "</div>";
            if ($result[2] != "" or $result[2] != null) {
                $htmldata = $htmldata . "<div id='slider'>
                                                        <a class='control_next'>></a>
                                                        <a class='control_prev'><</a>
                                                        <ul>";
                $imagesid = explode(",", $result[2]);
                for ($i = 0; $i < count($imagesid); $i++) {
                    if ($type == 1) {
                        $htmldata = $htmldata . "<li style='height:400px !important'>"
                                . "<a href='Other data/Images/Post_Img_$imagesid[$i]' target='_blank'><img class='postcardimages' src='Other data/Images/Post_Img_$imagesid[$i]' /></a>"
                                . "</li>";
                    } else {
                        $htmldata = $htmldata . "<li>"
                                . "<a href='Home.php?postid=$result[0]'><img class='postcardimages' src='Other data/Images/Post_Img_$imagesid[$i]' /></a>"
                                . "</li>";
                    }
                }
                $htmldata = $htmldata . "</ul>  
                                                      </div>";
            }
            if ($result[5] != "" or $result[5] != null) {
                $htmldata = $htmldata . "<div class='postcard'>
                                                        <a onclick='javascript:postcardplayerswitch($result[0]);'>
                                                            <div class='linkpreviewinline'>
                                                                <!-- <img class='linkpreviewimg' id='linkpreviewimg_$result[0]' src='$result[7]' /> -->
                                                                <iframe id='ytplayer' type='text/html' style='width:100%;height:100%;' src='$playerhtml' frameborder='0' allowfullscreen></iframe>
                                                            </div>
                                                            <div class='linkpreviewtitle'>
                                                                $result[5]
                                                            </div>
                                                            <div class='linkpreviewdesc'>
                                                                    $result[8]
                                                            </div>";
                if (strpos($_SESSION["currentpage"],"Vp.php")  !== FALSE) {
                    $htmldata = $htmldata . "<div class='linkpreviewsite'>
                                                                    No Of Views : $result[15]
                                                            </div>";
                } else {
                    /*$htmldata = $htmldata . "<div class='linkpreviewsite'>
                                            $result[4]
                                         </div>";*/
                }

                $htmldata = $htmldata . "</a>
                                                    </div>";
            }
            if (isset($_SESSION["userid"])) {
                $htmldata = $htmldata . "<div class='col-xs-12 postcardsocial'>
                                        <div class='postcardlike pull-left btn-sm-rev' onclick='javascript:cardaction($result[0],1);'>";
                if($result[16]== "" || $result[16] == NULL || $result[16] !=1)
                {
                    $htmldata=$htmldata."<i class='fa fa-thumbs-o-up' id='i_like_$result[0]'></i><span id='span_like_$result[0]'>$result[11]</span>";
                }
                elseif($result[16] == 1)
                {
                    $htmldata=$htmldata."<i class='fa fa-thumbs-up' id='i_like_$result[0]'></i><span id='span_like_$result[0]'>$result[11]</span>";
                }
                                            
                $htmldata=$htmldata."</div>
                                    <div class='postcardunlike pull-left btn-sm-rev' onclick='javascript:cardaction($result[0],2);'>";
                if($result[16] == "" || $result[16] == NULL || $result[16] != 2)
                {
                    $htmldata=$htmldata."<i class='fa fa-thumbs-o-down' id='i_unlike_$result[0]'></i><span id='span_unlike_$result[0]'>$result[12]</span>";
                }
                elseif($result[16] == 2)
                {
                    $htmldata=$htmldata."<i class='fa fa-thumbs-down' id='i_unlike_$result[0]'></i><span id='span_unlike_$result[0]'>$result[12]</span>";
                }
                                        
                $htmldata=$htmldata."</div>";
                $htmldata = $htmldata . "<div class='postcardshare pull-left btn-sm-rev' onclick='javscript:Sharepost($result[0]);'>
                                            <i class='fa fa-share' id='i_share_$result[0]' ></i><span id='span_share_$result[0]'>$result[13]</span>
                                        </div>";
                $htmldata = $htmldata . "<div class='postcardreport pull-right btn-sm-rev' onclick='javascript:cardaction($result[0],2);'>";
                if($result[16] == '' || $result[16]== NULL || $result[16]!=4)
                {
                    $htmldata=$htmldata."<i class='fa fa-flag-o' id='i_report_$result[0]' ></i><span id='span_report_$result[0]'>$result[14]</span>";
                }
                elseif($result[16] == 4)
                {
                    $htmldata=$htmldata."<i class='fa fa-flag' id='i_report_$result[0]' ></i><span id='span_report_$result[0]'>$result[14]</span>";
                }
                                            
                $htmldata=$htmldata."</div></div>";
                
                $htmldata = $htmldata . "<div class='col-xs-12 postcardsocialshare'>"
                        . "<div class='socialshareicons'>"
                        . "<a href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$result[0]' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vp.php?pid=$result[0]','name','width=600,height=400')' target='popup'>"
                        . "<i class='fa fa-facebook'></i>"
                        . "</a>"
                        . "</div>"
                        . "<div class='socialshareicons'>"
                        . "<a href='http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$result[0]' onclick='window.open('http://twitter.com/intent/tweet?status=A Tweet from FilmBoard+http://www.filmboard.in/Vp.php?pid=$result[0]','name','width=600,height=400')' target='popup'>"
                        . "<i class='fa fa-twitter'></i>"
                        . "</a>"
                        . "</div>"
                        . "<div class='socialshareicons'>"
                        . "<a href='https://plus.google.com/share?url=http://www.filmboard.in/Vp.php?pid=$result[0]' onclick='window.open('https://plus.google.com/share?http://www.filmboard.in/Vp.php?pid=$result[0]','name','width=600,height=400')' target='popup'>"
                        . "<i class='fa fa-google-plus'></i>"
                        . "</a>"
                        . "</div>"
                        . "</div>";
            }
            $htmldata = $htmldata . "</div><div class='clearfix'></div>
                        </div>";
            if($index %2 == 0)
            {
                $divcontainerleft = $divcontainerleft. $htmldata;
            }
            else
            {
                $divcontainerright = $divcontainerright . $htmldata;
            }
        }
        
        $divcontainerleft=$divcontainerleft."</div>";
        $divcontainerright=$divcontainerright."</div>";
        $divcontainer=$divcontainerleft.$divcontainerright;
        $divcontainer=$divcontainer."</div><div class='clearfix'>";
        return $divcontainer;
    }

    
    public function trendingCards() {
        $trendingobj = new datafetch();
        $resulttrend = $trendingobj->trendingcards();
        $htmldata = "";
        for ($index = 0; $index < mysqli_num_rows($resulttrend); $index++) {
            $result = mysqli_fetch_row($resulttrend);
            $htmldata = $htmldata . "<li>"
                    . "<a href='Vp.php?pid=$result[0]'>$result[1]</a>"
                    . "</li>";
        }
        return $htmldata;
    }
    public function suggestedPosts($id){
        $trendingobj = new datafetch();
        $resulttrend = $trendingobj->trendingcards();
        $htmldata = "<h1>Suggested Posts</h1>"
                    . "Note: Open the post card for viewing the videos in it"
                    . "<div class='clearfix'></div><br />";
        for ($index = 0; $index < mysqli_num_rows($resulttrend); $index++) {
            $result = mysqli_fetch_row($resulttrend);
            if($result[0]!=$id)
            {
                $htmldata = $htmldata."<div class='col-sm-6'>"
                                        ."<div class='individual_postboxdiv'>"
                                            . "<a href='Vp.php?pid=$result[0]' style='text-decoration:none;color:black;'><div>"
                                                . "<div class='postcarddptitle'>$result[9]</div><br />"
                                                  ."<div class='postcarddate pull-left' style='margin-left:3%'>" . date_format(date_create($result[10]), 'jS F Y \a\t g:ia') . "</div>"
                                                    . "<div class='clearfix'></div>"
                                                    . "<hr>"
                                                    . "<div class='col-sm-12'>$result[1]</div>"
                                                    . "<br /><br /><div class='clearfix'></div><br />"
                                                    . "<div style='float:right'>"
                                                        . "<a href='Vp.php?pid=$result[0]' class='btn-sm'> View Post</a>"
                                                    . "</div>"
                                                    . "<br />"
                                                . "</div>"
                                            . "</a>"
                                        . "</div>"
                                    . "</div>";
            }
        }
        return $htmldata;
    }
    
    public function suggestedVideos()
    {
        $htmldata = "<div class='col-xs-12' style='margin-bottom:2%;'>
                        <h2>Suggested Videos</h2> 
                            <div class='videolist'>"
                            . $this->getvideosfromdb("", 0,"")
                            . "</div></div>";
        
        return $htmldata;  
    }
    public function socialAction($itemid,$categorytype,$action) {
        $cardactobj = new datafetch();
        //$resultval = $cardactobj->cardaction($postid, $typeval);
        $resultval=$cardactobj->socialaction($itemid,$categorytype,$action,$_SESSION["userid"]);
        if ($resultval != "Failure") {
            return $cardactobj->socialcount($itemid);
        } else {
            return "Failure";
        }
    }

    public function checkBannedWords($checkstring) {
        $banwords = array(
            "4r5e", "5h1t", "5hit", "a55", "anal", "ar5e", "arrse",
            "arse", "ass", "ass-fucker", "asses", "assfucker", "assfukka", "asshole", "assholes",
            "asswhole", "a_s_s", "b!tch", "b00bs", "b17ch", "b1tch", "ballbag",
            "balls", "ballsack", "bastard", "beastial", "beastiality", "bellend", "bestial", "bestiality",
            "bi+ch", "biatch", "bitch", "bitcher", "bitchers", "bitches", "bitchin", "bitching",
            "bloody", "blow job", "blowjob", "blowjobs", "boiolas", "bollock", "bollok", "boner",
            "boob", "boobs", "booobs", "boooobs", "booooobs", "booooooobs", "breasts", "buceta",
            "bugger", "bum", "bunny fucker", "butt", "butthole", "buttmuch", "buttplug", "c0ck",
            "c0cksucker", "carpet muncher", "cawk", "chink", "cipa", "cl1t", "clit", "clitoris", "clits", "cnut", "cock", "cock-sucker",
            "cockface", "cockhead", "cockmunch", "cockmuncher", "cocks", "cocksuck", "cocksucked", "cocksucker",
            "cocksucking", "cocksucks", "cocksuka", "cocksukka", "cok", "cokmuncher", "coksucka", "coon",
            "cox", "crap", "cum", "cummer", "cumming", "cums", "cumshot", "cunilingus", "cunillingus", "cunnilingus",
            "cunt", "cuntlick", "cuntlicker", "cuntlicking", "cunts", "cyalis", "cyberfuc", "cyberfuck",
            "cyberfucked", "cyberfucker", "cyberfuckers", "cyberfucking", "d1ck",
            "damn", "dick", "dickhead", "dildo", "dildos", "dink", "dinks", "dirsa",
            "dlck", "dog-fucker", "doggin", "dogging", "donkeyribber",
            "doosh", "duche", "dyke", "ejaculate",
            "ejaculated", "ejaculates", "ejaculating", "ejaculatings",
            "ejaculation", "ejakulate", "fuck", "fucker", "f4nny", "fag", "fagging",
            "faggitt", "faggot", "faggs", "fagot", "fagots", "fags", "fanny",
            "fannyflaps", "fannyfucker", "fanyy", "fatass", "fcuk", "fcuker",
            "fcuking", "feck", "fecker", "felching", "fellate", "fellatio",
            "fingerfuck", "fingerfucked", "fingerfucker", "fingerfuckers", "fingerfucking",
            "fingerfucks", "fistfuck", "fistfucked", "fistfucker", "fistfuckers", "fistfucking",
            "fistfuckings", "fistfucks", "flange", "fook", "fooker",
            "fuck", "fucka", "fucked", "fucker", "fuckers", "fuckhead", "fuckheads", "fuckin", "fucking",
            "fuckings", "fuckingshitmotherfucker", "fuckme", "fucks", "fuckwhit", "fuckwit", "fudge packer", "fudgepacker",
            "fuk", "fuker", "fukker", "fukkin", "fuks", "fukwhit", "fukwit",
            "fux", "fux0r", "f_u_c_k", "gangbang", "gangbanged", "gangbangs", "gaylord", "gaysex",
            "goatse", "God", "god-dam", "god-damned", "goddamn", "goddamned",
            "hardcoresex", "hell", "heshe", "hoar", "hoare", "hoer",
            "homo", "hore", "horniest", "horny", "hotsex", "jack-off",
            "jackoff", "jap", "jerk-off", "jism", "jiz", "jizm",
            "jizz", "kawk", "knob", "knobead", "knobed", "knobend",
            "knobhead", "knobjocky", "knobjokey", "kock", "kondum", "kondums",
            "kummer", "kumming", "kums", "kunilingus", "l3i+ch",
            "l3itch", "labia", "lmfao", "lust", "lusting", "m0f0",
            "m0fo", "m45terbate", "ma5terb8", "ma5terbate", "masochist", "master-bate",
            "masterb8", "masterbat*", "masterbat3", "masterbate", "masterbation", "masterbations",
            "masturbate", "mo-fo", "mof0", "mofo", "mothafuck", "mothafucka", "mothafuckas",
            "mothafuckaz", "mothafucked", "mothafucker", "mothafuckers", "mothafuckin", "mothafucking",
            "mothafuckings", "mothafucks", "mother fucker", "motherfuck", "motherfucked", "motherfucker",
            "motherfuckers", "motherfuckin", "motherfucking", "motherfuckings", "motherfuckka",
            "motherfucks", "muff", "mutha", "muthafecker", "muthafuckker", "muther",
            "mutherfucker", "n1gga", "n1gger", "nazi", "nigg3r", "nigg4h", "nigga",
            "niggah", "niggas", "niggaz", "nigger", "niggers",
            "nob jokey", "nobhead", "nobjocky", "nobjokey", "numbnuts", "nutsack",
            "orgasim", "orgasims", "orgasm", "orgasms", "p0rn", "pawn",
            "pecker", "penis", "penisfucker", "phonesex", "phuck", "phuk",
            "phuked", "phuking", "phukked", "phukking", "phuks",
            "phuq", "pigfucker", "pimpis", "piss", "pissed", "pisser",
            "pissers", "pisses", "pissflaps", "pissin", "pissing", "pissoff", "poop",
            "porn", "porno", "pornography", "pornos", "prick", "pricks", "pron", "pube",
            "pusse", "pussi", "pussies", "pussy", "pussys", "rectum", "retard", "rimjaw",
            "rimming", "s hit", "s.o.b.", "sadist", "schlong", "screwing", "scroat",
            "scrote", "scrotum", "semen", "sex", "sh!+", "sh!t", "sh1t", "shag",
            "shagger", "shaggin", "shagging", "shemale", "shi+", "shit", "shitdick",
            "shite", "shited", "shitey", "shitfuck", "shitfull", "shithead", "shiting", "shitings",
            "shits", "shitted", "shitter", "shitters", "shitting", "shittings", "shitty", "skank",
            "slut", "sluts", "smegma", "smut", "snatch", "son-of-a-bitch", "spac", "spunk",
            "s_h_i_t", "t1tt1e5", "t1tties", "teets", "teez", "testical", "testicle",
            "tit", "titfuck", "tits", "titt", "tittie5", "tittiefucker", "titties", "tittyfuck",
            "tittywank", "titwank", "tosser", "turd", "tw4t", "twat", "twathead", "twatty",
            "twunt", "twunter", "v14gra", "v1gra", "vagina", "viagra", "vulva", "w00se", "wang",
            "wank", "wanker", "wanky", "whoar", "whore", "willies", "willy", "xrated",
            "24hentai.com", "3dbadgirls.com", "69games.xxx", "88fuck.com", "actual-porn.org",
            "adultfriendfinder.com", "adultvideofinder.com", "affiliates.perfectmatch.com", "alljapanesepass.com", "allofgfs.com",
            "alotporn.com", "amazon.com", "animephile.com", "anotherpornblog.tumblr.com", "apetube.com",
            "apina.biz", "avn.com", "awsum.me", "babe-lounge.com", "babepedia.com",
            "badjojo.com", "bangbrosnetwork.com", "befuck.com", "best-paypornsites.com",
            "bestpornstardb.com", "bigmouthfuls.com", "bootytape.com", "bravotube.net",
            "brazzersnetwork.com", "camcrush.com", "cams.com", "celebuzz.com",
            "chan.sankakucomplex.com", "crazycollegegfs.com", "daftporn.com", "dailee.com", "dansmovies.com", "daredorm.com", "ddfnetwork.com", "definebabe.com", "deviantclip.com",
            "digitalplayground.com", "dirtyrottenwhore.com", "drtuber.com", "ebaumsworld.com", "edenfantasys.com",
            "efukt.com", "elephanttube.com", "en.gay-lounge.net", "entnt.com", "eporner.com", "erooups.com",
            "erotica7.com", "eroxia.com", "evilangellive.com?AFNO=1-223279-2", "extremetube.com", "fakku.net", "fapdu.com",
            "femdom-tube.xxx", "findtubes.com", "forum.oneclickchicks.com", "forum.xnxx.com", "forumophilia.com", "freeones.com",
            "freudbox.com", "fuckuh.com", "funpic.hu", "fuskator.com", "fux.com", "gelbooru.com",
            "getiton.com", "gfrevenge.com", "h2porn.com", "hclips.com", "hdhentaisex.com",
            "hdporn.net", "hentai.tc", "hentai4manga.com", "hentai-foundry.com", "hentairules.net", "hentaischool.com",
            "hide-porn.winsite.com", "hollywoodlife.com", "hornymatches.com", "iknowthatgirl.com", "imagearn.com",
            "imlive.com", "inxporn.com", "iptorrents.com", "javhd.com", "joyourself.com", "justicehentai.com",
            "justjared.com", "justusboys.com", "keepersecurity.com", "keezmovies.com", "kindgirls.com", "laineygossip.com",
            "linkfame.com", "linkfame.com", "liveprivates.com", "lolhentai.net", "lustpin.com", "madthumbs.com",
            "mandatory.com", "maxim.com", "mediadetective.com", "menshealth.com", "mofosex.com", "mofosnetwork.com",
            "momsbangteens.com", "mt.livecamfun.com", "myhentai.tv", "mypornbible.com", "myporngay.com", "myxvids.com",
            "nakednews.com", "new.livejasmin.com", "new.xlovecam.com", "nostringsattached.com", "nudevista.com", "nurglesnymphs.com",
            "nuvid.com", "orgasm.com", "ovguide.com", "passion.com", "peachyforum.com", "perezhilton.com",
            "perfectgonzo.com", "pervclips.com", "pervsonpatrol.com", "phapit.com", "phun.org", "pinkcherryaffiliate.com",
            "planetsuzy.org", "playboyplus.com", "playforceone.com", "playporngames.com", "porn.com",
            "pornative.com", "pornbb.org", "pornbits.net", "porncor.com", "pornerbros.com",
            "pornheed.com", "pornhost.com", "pornhub.com", "pornication.com", "pornicom.com", "pornjog.com",
            "pornmaxim.com", "pornmd.com", "pornolab.net", "pornpin.com", "pornplanner.com", "pornprosnetwork.com", "pornrabbit.com",
            "porntitan.com", "pornusers.com",
            "porn-wanted.com", "privatefeeds.com", "proporn.com", "puffynetwork.com", "punchpin.com", "pussytorrents.org",
            "rarbg.com", "rivcams.com", "rk.com", "secure.hustler.com", "sexforums.com", "sexier.com",
            "sexyfuckgames.com", "simply-hentai.com", "slutload.com", "smutty.com", "spankbang.com", "spizoo.com",
            "streetblowjobs.com", "stripshow.com", "sunporno.com", "teamskeet.com", "thechive.com", "thegfnetwork.com",
            "thehollywoodgossip.com", "thenewporn.com", "the-pork.com", "thestripperexperience.com", "thongsaroundtheworld.com", "tjoob.com",
            "tnaflix.com", "topfreepornvideos.com", "totallynsfw.com", "track.braincash.com", "tube8.com", "tubegalore.com",
            "tubehentai.com", "twistysnetwork.com", "updatetube.com", "uselessjunk.com", "userporn.com", "videosz.com",
            "vintagepinupgirls.net", "vpornvideos.com", "wankoz.com", "webcams.com", "wetplace.com", "wickedpictures.com",
            "wtfpeople.com", "xbabe.com", "xdatenow.net", "xhamster.com", "xhookups.com", "xnxx.com",
            "xvideos.com", "xxxbunker.com", "xxxdating.com", "xxxymovies.com", "youjizz.com", "youporn.com", "youramateurporn.com",
            "yourlustmovies.com", "zimbio.com"
        );
        $retcheckval = true;
        foreach ($banwords as $bword) {
            if (strpos($checkstring, $bword) > 0) {
                $retcheckval = false;
                $_SESSION["blockedword"] = $bword;
                break;
            }
        }
        return $retcheckval;
    }

    public function postViewCountIncrement($param) {
        $increobj = new datafetch();
        $increobj->postviewcountincrement($param);
    }

    public function insertMoviesDb($title, $titleurl, $genere) {
        $moviedbobj = new datafetch();
        return $moviedbobj->insertmoviesdb($title, $titleurl, $genere);
    }

    public function insertMovieInfo($idval,$moviename, $moviedesc, $moviebanner, $director, $producer, $writter, $screenplay, $story, $starring, $musicdirector, $cinematographer, $editor, $productioncompany, $distributioncompany, $releasedate, $movieduration, $language, $budget, $boxofficecollection, $tracktable) {
        $movieobj = new datafetch();
        return $movieobj->insertmovieinfo($idval,$moviename, $moviedesc, $moviebanner, $director, $producer, $writter, $screenplay, $story, $starring, $musicdirector, $cinematographer, $editor, $productioncompany, $distributioncompany, $releasedate, $movieduration, $language, $budget, $boxofficecollection, $tracktable);
    }

    public function fetchAllUrls() {
        $urlobj = new datafetch();
        return $urlobj->fetchallurls();
    }

    public function updateParsedStatus($id) {
        $parseobj = new datafetch();
        return $parseobj->updateparsedstatus($id);
    }
    
    public function updateVideosInfo($videoid,$videotitle,$videodesc,$videoposter,$videotype,$videotags,$uploaddate,$viewcount)
    {
        $videoobj_m=new datafetch();
        return $videoobj_m->updatevideosinfo($videoid,$videotitle,$videodesc,$videoposter,$videotype,$videotags,$uploaddate,$viewcount);
    }
    public function truncateVideos()
    {
        $truncobj=new datafetch();
        return $truncobj->truncatevideos();
    }
    public function fetchMovieInfo($id) {
        $movieobj=new datafetch();
        $resultdata=$movieobj->fetchmovieinfo($id);
        $result=mysqli_fetch_row($resultdata);
        
        $htmldata="<div class='col-sm-12' style='background-color: #FFFFFF;' id='movieinfopanel'>
                        <div class='moviebannerdiv'>";
        if($result[2]!="")
        {
            $htmldata=$htmldata."<img src='$result[2]' class='moviebanner' />";
        }
        else 
        {    
            $htmldata=$htmldata."<img src='Images/Filmboard_logo.jpg' class='moviebanner' />";
        }
        
        $htmldata=$htmldata."</div>
                        <div class='moviecategory'>";
        
        if($result[17]!="")
        {
            $htmldata=$htmldata."<h1>$result[1] ($result[17])</h1>";
        }
        else 
        {
            $htmldata=$htmldata."<h1>$result[1]</h1>";
        }
                            
        $htmldata=$htmldata."<div class='moviecategory col-sm-6'>
                                <p>Information Courtesy: Wikipedia.org ( <a target='_blank' href='https://en.wikipedia.org$result[20]'>Link</a> ) </p>";
        if($result[16]!="")
        {
            $htmldata=$htmldata."<p><b>Release Date : </b>$result[16]</p>";
        }
        else 
        {
            $htmldata=$htmldata."";
        }
        if($result[15]!="")
        {
            $htmldata=$htmldata."<p><b>Duration :</b>$result[15]</p>";
        }
        else
        {
            $htmldata=$htmldata."";
        }
        if($result[18]!="")
        {
            $htmldata=$htmldata."<p><b>Budget : </b>$result[18]</p>";
        }
        else
        {
            $htmldata=$htmldata."";
        }

        $htmldata=$htmldata."</div>
                            <div class='moviecategory col-sm-3'>
                                <div class='movieinterest'>";
        if($result[24]==1)
        {
            $htmldata=$htmldata."<div class='movielike' onclick='javascript:moviesocialaction($id,1);'>
                                    <i class='fa fa-thumbs-up' id='i_like'></i>
                                    <span id='span_like'>$result[22]</span>
                                </div>
                                <div class='movieunlike' onclick='javascript:moviesocialaction($id,2);'>
                                    <i class='fa fa-thumbs-o-down' id='i_unlike'></i>
                                    <span id='span_unlike'>$result[23]</span>
                                </div>";
        }
        else if($result[24]==2)
        {
            $htmldata=$htmldata."<div class='movielike' onclick='javascript:moviesocialaction($id,1);'>
                                    <i class='fa fa-thumbs-o-up' id='i_like'></i>
                                    <span id='span_like'>$result[22]</span>
                                </div>
                                <div class='movieunlike' onclick='javascript:moviesocialaction($id,2);'>
                                    <i class='fa fa-thumbs-down' id='i_unlike'></i>
                                    <span id='span_unlike'>$result[23]</span>
                                </div>";
        }
        else
        {
            $htmldata=$htmldata."<div class='movielike' onclick='javascript:moviesocialaction($id,1);'>
                                    <i class='fa fa-thumbs-o-up' id='i_like'></i>
                                    <span id='span_like'>$result[22]</span>
                                </div>
                                <div class='movieunlike' onclick='javascript:moviesocialaction($id,2);'>
                                    <i class='fa fa-thumbs-o-down' id='i_unlike'></i>
                                    <span id='span_unlike'>$result[23]</span>
                                </div>";
        }
                                    
        $htmldata=$htmldata."</div>
                                <div class='clearfix'></div>
                                <div class='col-sm-12'><a href='#writereview' class='btn-sm'>Post / View Reviews</a></div>
                            </div>
                        </div>
                        <div class='clearfix'></div>
                        <div class='moviecategory '>
                            <h2><b>Movie Description</b></h2>";
        if($result[3]!="")
        {
            $htmldata=$htmldata."<p class='moviedesc' style='text-indent: 25px;text-align:justify;'>$result[3]</p>";
        }
        else 
        {
            $htmldata=$htmldata."";
        }
        
        $htmldata=$htmldata."</div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Starring</b></h2>
                            <p class='moviestarring'>$result[4]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Director</b></h2>
                            <p class='moviedirector'>$result[5]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Producer</b></h2>
                            <p class='movieproducer'>$result[6]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Production Company</b></h2>
                            <p class='movieproductioncompany'>$result[13]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Distribution Company</b></h2>
                            <p class='moviedistributioncompany'>$result[14]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Writter</b></h2>
                            <p class='moviewritter'>$result[7]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Story</b></h2>
                            <p class='moviestory'>$result[8]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>ScreenPlay</b></h2>
                            <p class='moviescreenplay'>$result[9]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Music Director</b></h2>
                            <p class='moviemusicdirector'>$result[10]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Cinematographer</b></h2>
                            <p class='moviecinematographer'>$result[11]</p>
                        </div>
                        <div class='moviecategory col-sm-4'>
                            <h2><b>Editor</b></h2>
                            <p class='movieeditor'>$result[12]</p>
                        </div>";
       if($result[19]!="<table class=tracklisttable></table>")
       {
           $htmldata=$htmldata."<div class='moviecategory  col-sm-12'>
                            <h2><b>Songs & Tracks Info</b></h2>
                            $result[19]
                        </div>";
       }
       $htmldata=$htmldata."<div class='col-sm-12' id='writereview' style='padding-top:5%;'>";
       if($result[21]!="")
       {
           $htmldata=$htmldata."<div class='col-sm-6'>
                                    <h2><b>Trailer or Teaser</b></h2>
                                    <iframe id='ytplayer' type= 'text/html' style='width:100%;height:100%;' src='$result[21]?rel=0&showinfo=0&iv_load_policy=3' frameborder='0' allowfullscreen></iframe>
                                </div>";
           if(isset($_SESSION["userid"]))
           {
               $htmldata=$htmldata."<div class='col-sm-6'>
                                    <h2><b>Post a Review or Comment</b></h2>
                                    <textarea id='postcomment'></textarea><br />
                                    <div style='float: right'><button class='btn-sm nopadding' onclick='javscript:insertmoviereview();'>Submit</button></div>
                                </div>";
           }
           else
           {
               $htmldata=$htmldata."<div class='col-sm-6'>
                                    <h2><b>Post a Review or Comment</b></h2>
                                    <p>Please login to post a Movie Review / Comment.</p>
                                    <div style='float: right'><button class='btn-sm nopadding' onclick='javscript:popuploginwindow();'>Login</button></div>
                                </div>";
           }
       }
       else
       {
           if(isset($_SESSION["userid"]))
           {
               $htmldata=$htmldata."<div class='col-sm-6'>
                                    <h2><b>Post a Review or Comment</b></h2>
                                    <textarea id='postcomment'></textarea><br />
                                    <div style='float: right'><button class='btn-sm nopadding' onclick='javscript:insertmoviereview();'>Submit</button></div>
                                </div>";
           }
           else
           {
               $htmldata=$htmldata."<div class='col-sm-6'>
                                    <h2><b>Post a Review or Comment</b></h2>
                                    <p>Please login to post a Movie Review / Comment.</p>
                                    <div style='float: right'><button class='btn-sm nopadding' onclick='javscript:popuploginwindow();'>Login</button></div>
                                </div>";
           }
       }
        $htmldata=$htmldata."<div class='clearfix'></div>
                            <br />
                            <div class='col-sm-12'>
                                <h2><b>View all Reviews or Comments</b></h2>
                            </div>
                            <div class='col-sm-12' id='moviereviews'></div>";
        $htmldata=$htmldata.$this-> getMovieReviewData($id);
        $htmldata=$htmldata."</div>";
        return $htmldata;
    }
    public function getMovieReviewData($movieid)
    {
        $movierev=new datafetch();
        $resultv=$movierev->getmoviereviews($movieid);
        $reviewdata="";
        for ($index = 0; $index < mysqli_num_rows($resultv); $index++) 
        {
            $result=mysqli_fetch_row($resultv);
            if($result[1]=="")
            {
                $reviewdata=$reviewdata."<div class='moviecategory col-sm-6'>
                                        <div class='col-sm-12'><h4><b style='color: blue;'>$result[3]</b></h4></div>
                                        <div class='col-sm-12' style='margin-top:-10px;'>Posted on : $result[2]</div>
                                        <div class='col-sm-12' style='margin-top:10px;'><p style='text-indent: 20px;'>$result[0]</p></div>
                                    </div>";
            }
            else
            {
                $reviewdata=$reviewdata."<div class='moviecategory col-sm-6'>
                                        <div class='col-sm-12'><h4><b style='color: blue;'>$result[3]</b></h4></div>
                                        <div class='col-sm-12' style='margin-top:-10px;'>Posted on : $result[2]</div>
                                        <div class='col-sm-12' style='margin-top:10px;'><p style='text-indent: 20px;'>$result[0]</p></div>
                                        <div class='col-sm-12' style='margin-top:10px;'><iframe id='ytplayer' type= 'text/html' style='width:100%;height:100%;' src='$result[1]?rel=0&showinfo=0&iv_load_policy=3' frameborder='0' allowfullscreen></iframe></div>
                                    </div>";
            }
        }
        return $reviewdata;
    }
    
    public function insertMovieReview($reviewdesc,$reviewurl)
    {
        $reviewobj=new datafetch();
        echo $reviewobj->insertmoviereview($_SESSION["movieid"],$reviewdesc,$reviewurl,$_SESSION["userid"]);
    }
    
    public function movieSearchData($moviename)
    {
        $movsearchobj=new datafetch();
        $res=$movsearchobj->moviesearchdata($moviename);
        $moviedata="";
        for ($index = 0; $index < mysqli_num_rows($res); $index++) {
            $result=mysqli_fetch_row($res);
            $moviedata=$moviedata."<div class='moviecategory col-sm-6'>
                                        <div class='col-sm-12' style='width:99%;margin-left:0.5%;background-color: #FFFFFF;'>
                                            <div class='col-sm-3'>
                                                <img src='$result[2]' style='margin-top:10px;width:100px;height:100px;' />
                                            </div>
                                            <div class='col-sm-9'>
                                                <div class='col-sm-12'>
                                                    <h1>
                                                        <a href='MovieInfo.php?movieid=$result[0]'><b style='color: blue;'>$result[1]</b></a>
                                                    </h1>
                                                </div>
                                                <div class='col-sm-12' style='margin-top:-15px;'>
                                                    <p style='text-indent: 20px;max-height:105px;overflow:hidden;'>$result[3]</p>
                                                </div>
                                                <div class='col-sm-12' style='margin-top:10px;padding-bottom:15px;'>
                                                    <a href='MovieInfo.php?movieid=$result[0]' class='btn-sm'>Visit Page</a>
                                                </div>
                                            </div>
                                        </div>   
                                    </div>";
        }
        return $moviedata;
    }
}

?>