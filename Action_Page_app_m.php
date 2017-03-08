<?php

include 'Main_Controller_app_m.php';
if (isset($_GET["Action"])) {

    if ($_GET["Action"] == "getRadioList") {
        $RadioObj = new Main_Controller();
        if (isset($_GET["Lang"])) {
            echo $RadioObj->getRadios($_GET["Lang"]);
        } else {
            echo $RadioObj->getRadios("Tamizh");
        }
    } 
    
    else if($_GET["Action"] == "getPostCards"){
        $PostObj = new Main_Controller();
        echo $PostObj->getPostsCards($_GET["search"],$_GET["type"],$_GET["startlimit"],$_GET["endlimit"]);
    }
    
    else if ($_GET["Action"] == "getVideoList") {
        $videobj = new Main_Controller();
        if (isset($_GET["Filtertype"])) {
            echo $videobj->getVideos("", $_GET["Startlimit"], $_GET["Filtertype"]);
        } else {
            echo $videobj->getVideos("", $_GET["Startlimit"], 0);
        }
    } 
    
    else if ($_GET["Action"] == "getAlbumList") {
        $audioobj = new Main_Controller();
        if (isset($_GET["Filtertype"])) {
            echo $audioobj->getAudios("", $_GET["Startlimit"], $_GET["Filtertype"]);
        } else {
            echo $audioobj->getAudios("", $_GET["Startlimit"], 0);
        }
    } 
    
    else if ($_GET["Action"] == "getAlbumTracks") {
        $tracksobj = new Main_Controller();
        echo $tracksobj->getTracksFromAlbumId($_GET["AlbumId"]);
    } 
    
    else if ($_GET["Action"] == "radioCountIncrement") {
        $incradobj = new Main_Controller();
        echo $incradobj->incrementRadioCount($_GET["RadioId"]);
    } 
    
    else if ($_GET["Action"] == "videoCountIncrement") {
        $incvidobj = new Main_Controller();
        echo $incvidobj->incrementVideoCount($_GET["VideoId"]);
    } 
    
    else if ($_GET["Action"] == "albumCountIncrement") {
        $incaudobj = new Main_Controller();
        echo $incaudobj->incrementAlbumCount($_GET["AlbumId"]);
    } 
    
    else if ($_GET["Action"] == "trackCountIncrement") {
        $inctrackobj = new Main_Controller();
        echo $inctrackobj->incrementTrackCount($_GET["TrackId"]);
    }
}
?>