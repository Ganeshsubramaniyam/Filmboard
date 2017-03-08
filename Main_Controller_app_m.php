<?php
include 'datafetch_app.php';
class Main_Controller {
    function __construct() {
        
    }
    function getPostsCards($search,$type,$startlimit)
    {
        $obj_db_data = new datafetch();
        $resultdata=$obj_db_data->displaypostcards($search,$type,$startlimit);
        $resultobj=array();
        if($resultdata == FALSE)
        {
            $resultobj=NULL;
        }
        else
        {
            $postlength=mysqli_num_rows($resultdata);
            for ($index = 0; $index < $postlength; $index++)
            {
                $result=mysqli_fetch_row($resultdata);
                array_push($resultobj,array(
                    'Id' => $result[0],
                    'Cardcontent' => $result[1],
                    'Cardimagesid' => $result[2],
                    'Cardvideosid' => $result[3],
                    'Cardextvidsite' => $result[4],
                    'Cardextvidtitle' => $result[5],
                    'Cardextvidurl' => $result[6],
                    'Cardextvidimage' => $result[7],
                    'Cardextviddesc' => $result[8],
                    'Name' => $result[9],
                    'Posteddate' => $result[10],
                    'Likecount' => $result[11],
                    'Unlikecount' => $result[12],
                    'Sharecount' => $result[13],
                    'Reportcount' => $result[14],
                    'Viewcount' => $result[15],
                    'Mystat' => $result[16],
                    'Postedby' => $result[17]
                    ));
            }
        }
        return json_encode($resultobj);
    }

    function getRadios($langfilter)
    {
        $obj_db_data = new datafetch();
        $resultdata = $obj_db_data->getradiolist($langfilter);
        $resultobj= array();
        if ($resultdata == FALSE) {
            $resultobj = NULL;
        } 
        else
        {
            $radioslength = mysqli_num_rows($resultdata);
            for ($i = 0; $i < $radioslength; $i++) {
                $result = mysqli_fetch_row($resultdata);
                array_push($resultobj,
                            array(
                            'Id' => $result[0],
                            'Name' => $result[1],
                            'Lang' => $result[3],
                            'Rate' => $result[5],
                            'Url' => $result[2]
                            ));
            }
        }
        return json_encode($resultobj);
    }
    
    function getVideos($inputvalue, $startlimit,$videotype)
    {
        $obj_db_data = new datafetch();
        $resultdata = $obj_db_data->getvideolist($inputvalue, $startlimit,$videotype);
        $resultobj= array();
        if ($resultdata == FALSE) {
            $resultobj = NULL;
        } 
        else
        {
            $radioslength = mysqli_num_rows($resultdata);
            for ($i = 0; $i < $radioslength; $i++) {
                $result = mysqli_fetch_row($resultdata);
                array_push($resultobj,
                            array(
                            'VideoId' => $result[0],
                            'VideoTitle' => $result[1],
                            'VideoDescription' => $result[2],
                            'VideoPoster' => $result[3],
                            'VideoType' => $result[4],
                            'VideoTags' => $result[5],
                            'UploadedDate' => $result[6],
                            'VideoViews' => $result[7]
                            ));
            }
        }
        return json_encode($resultobj);
    }
    
    function getAudios($inputvalue, $startlimit,$filter)
    {
        $obj_db_data = new datafetch();
        $resultdata = $obj_db_data->getaudios_m($inputvalue, $startlimit,$filter);
        $resultobj= array();
        if ($resultdata == FALSE) {
            $htmldata = "Connection Problem .. Pls Try again in 10 Seconds....";
        } 
        else
        {
            $audioslength = mysqli_num_rows($resultdata);
            for ($i = 0; $i < $audioslength; $i++) {
                $result = mysqli_fetch_row($resultdata);
                if(file_exists("Other Data/Images/Aud_$result[0]_share.jpg") == false)
                {
                    file_put_contents("Other Data/Images/Aud_$result[0]_share.jpg",$result[3]);
                }
                array_push($resultobj,
                            array(
                            'Title' => $result[1],
                            'AlbumId' => $result[0],
                            'Poster' => "http://www.funraaga.in/Other Data/Images/Aud_$result[0]_share.jpg",
                            'Views' => $result[7],
                            'AudType' => $result[3]
                            ));
            }
        }
        return json_encode($resultobj);
    }
    
    public function getTracksFromAlbumId($albumid) 
    {
        $obj_db_data = new datafetch();
        $resultdata = $obj_db_data->gettracksfromalbumid($albumid);
        $resultobj= array();
        if ($resultdata == FALSE) {
            $htmldata = "Connection Problem .. Pls Try again in 10 Seconds....";
        } 
        else
        {
            $trackslength = mysqli_num_rows($resultdata);
            for ($i = 0; $i < $trackslength; $i++) {
                $result = mysqli_fetch_row($resultdata);
                array_push($resultobj,
                            array(
                            'TrackName' => $result[1],
                            'TrackId' => $result[0],
                            'Views' => $result[2],
                            ));
            }
        }
        return json_encode($resultobj);
    }
    
    public function incrementRadioCount($radioid)
    {
        $obj_db_data=new datafetch();
        $resultdata=$obj_db_data->incrementradiocount($radioid);
        return $resultdata;
    }
    
    public function incrementVideoCount($videoid)
    {
        $obj_db_data=new datafetch();
        $resultdata=$obj_db_data->incrementvideocount($videoid);
        return $resultdata;
    }
    
    public function incrementAlbumCount($albumid)
    {
        $obj_db_data=new datafetch();
        $resultdata=$obj_db_data->incrementalbumcount($albumid);
        return $resultdata;
    }
   
    public function incrementTrackCount($trackid)
    {
        $obj_db_data=new datafetch();
        $resultdata=$obj_db_data->incrementtrackcount($trackid);
        return $resultdata;
    }
}

?>