<?php
if(session_id()=='')
{
    session_start();
}
$_SESSION["currentpage"] = "Audios.php";
$_SESSION["pagecategory"]="Audios";
include 'Master_Page_Sub.php';
$obj1 = new Main_Controller();
if(isset($_GET["search"]))
{
    echo $obj1->getAudios($_GET["search"]);
}
else
{
    echo $obj1->getAudios("");
}
include 'Master_Page_footer.php';
?>
<div class="musicplayer" >
    <div class="col-sm-9" id="musicplayerloc">
         <div id="jp_container_1" class="jp-video jp-video-270p" role="application" aria-label="media player">
            <div class="jp-type-playlist">
                <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                <div class="jp-gui">
                    <!--<div class="jp-video-play">
                            <button class="jp-video-play-icon" role="button" tabindex="0">play</button>
                    </div>-->
                    <div style="width: 100%;float: right;background-color: #eee;border: solid 2px #FF5511;border-radius: 5px;">
                        <div class="jp-interface">
                            <div style="width: 20%;float: left;padding-left: 5px;padding-top: 2px;">
                                <img id='bannerposter'src="images/Funraaga_72x72.jpg" width="100%" height="90px" />
                            </div>
                            <div style="width: 80%;float: right">
                                <label id="currentsong" style="overflow: hidden !important;height: 22px;">Click the below Play Button </label>
                                <div class="jp-progress">
                                <div class="jp-seek-bar">
                                    <div class="jp-play-bar"></div>
                                </div>
                            </div>
                            <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                            <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                            <div class="jp-controls-holder">
                                <div class="jp-controls">
                                    <button class="jp-previous" role="button" tabindex="0">previous</button>
                                    <button class="jp-play" role="button" tabindex="0">play</button>
                                    <button class="jp-next" role="button" tabindex="0">next</button>
                                    <button class="jp-stop" role="button" tabindex="0">stop</button>
                                </div>
                                <div class="jp-volume-controls">
                                    <button class="jp-mute" role="button" tabindex="0">mute</button>
                                    <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                    <div class="jp-volume-bar">
                                        <div class="jp-volume-bar-value"></div>
                                    </div>
                                </div>
                                <div class="jp-toggles" style="margin-top: 10px !important">
                                    <!--<button class="jp-repeat1" role="button" tabindex="0" onclick="javascript:repeatalbum();">repeat</button>-->
                                    <button class="jp-shuffle1" role="button" tabindex="0" onclick="javascript:shufflealbum();">shuffle</button>
                                    <button class="fa fa-list-ul" style="text-indent: 0px;background-color: transparent;color: grey" role="button" tabindex="0" onclick="javascript:showplaylist();"></button>
                                </div>
                            </div>
                            <div class="jp-playlist">
                                <ul>
                                        <li>&nbsp;</li>
                                </ul>
                            </div>
                            <div class="jp-details">
                                <div class="jp-title" aria-label="title">&nbsp;</div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="jp-no-solution">
                    <span>Update Required</span>
                    To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                </div>
            </div>
        </div>
    </div>
</div>
