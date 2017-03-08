<?php

class datafetch {

    public $con;
    public $dbserver;
    public $username;
    public $password;
    public $dbname;
    public $query;

    function __construct() {
        /* $this->dbserver = "localhost";
          $this->username = "root";
          $this->password = "";
          $this->dbname = "funraaga"; */

        $this->dbserver = "MYSQL5005.Smarterasp.net";
        $this->username = "9b0406_fm";
        $this->password = "vasusubramaniyam";
        $this->dbname = "db_9b0406_fm";
    }

    public function getradiolist($langfilter) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            if ($langfilter == "") {
                $this->query = "select * from radioslist order by radioname";
            } else {
                $this->query = "select * from radioslist where Language='$langfilter' order by radioname";
            }

            $resultset = mysqli_query($con, $this->query);
            //$result = mysqli_fetch_row($resultset);
            return $resultset;
        }
    }

    public function getvideolist($inputvalue, $startlimit, $videotype) {
            $inputvalue_arr = explode(" ", $inputvalue);
            $vidinputvalue = "";
            $viddescvalue = "";
            $videotypevalue = "";
            $videotagvalue = "";
            $endlimt = 20;
            for ($i = 0; $i < count($inputvalue_arr); $i++) {
                if ($i == count($inputvalue_arr) - 1) {
                    $vidinputvalue = $vidinputvalue . $inputvalue_arr[$i] . "%";
                    $videotypevalue = $videotypevalue . $inputvalue_arr[$i] . "%";
                    $viddescvalue = $viddescvalue . $inputvalue_arr[$i] . "%";
                    $videotagvalue = $videotagvalue . $inputvalue_arr[$i] . "%";
                } else {
                    $vidinputvalue = $vidinputvalue . $inputvalue_arr[$i] . "%' or VideoName like '%";
                    $videotypevalue = $videotypevalue . $inputvalue_arr[$i] . "%' or VideoTupe like '%";
                    $viddescvalue = $viddescvalue . $inputvalue_arr[$i] . "%' or VideoDescription like '%";
                    $videotagvalue = $videotagvalue . $inputvalue_arr[$i] . "%' or VideoTags like '%";
                }
            }
            $con = mysqli_connect($this->dbserver, $this->username, $this->password);
            if (!$con) {
                return FALSE;
            } else {
                mysqli_select_db($con, $this->dbname);
                if ($inputvalue == "") {
                    $this->query = "select * from videolist where VideoType = '$videotype' ORDER BY UploadedDate DESC LIMIT $startlimit,$endlimt";
                } else {
                    $this->query = "select * from videolist where VideoTitle like '%" . $vidinputvalue . "' or VideoType like '%" . $videotypevalue . "' or VideoDescription like '%" . $viddescvalue . "' or VideoTags like '%" . $videotagvalue . "'";
                }
                $resultset = mysqli_query($con, $this->query);
                return $resultset;
            }
        }
   
    public function getaudios($inputvalue, $startlimit) {
        $inputvalue_arr = explode(" ", $inputvalue);
        $albumvalue = "";
        $composervalue = "";
        $langvalue = "";
        $endlimt = $startlimit + 20;
        $startlimit = 0;
        for ($i = 0; $i < count($inputvalue_arr); $i++) {
            if ($i == count($inputvalue_arr) - 1) {
                $albumvalue = $albumvalue . $inputvalue_arr[$i] . "%";
                $composervalue = $composervalue . $inputvalue_arr[$i] . "%";
                $langvalue = $langvalue . $inputvalue_arr[$i] . "%";
            } else {
                $albumvalue = $albumvalue . $inputvalue_arr[$i] . "%' or AlbumName like '%";
                $composervalue = $composervalue . $inputvalue_arr[$i] . "%' or ComposerName like '%";
                $langvalue = $langvalue . $inputvalue_arr[$i] . "%' or Language like '%";
            }
        }
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            if ($inputvalue == "") {
                //$this->query = "select * from albumlist ORDER BY Hits DESC LIMIT $startlimit,$endlimt";
                $this->query = "select AlbumId,AlbumName,CreatedBy,AlbumType,ComposerName,ReleaseYear,Language,Hits from albumlist ORDER BY ReleaseYear DESC,CreatedOn DESC LIMIT $startlimit,$endlimt";
            } else {
                $this->query = "select AlbumId,AlbumName,CreatedBy,AlbumType,ComposerName,ReleaseYear,Language,Hits from albumlist where AlbumName like '%" . $albumvalue . "' or ComposerName like '%" . $composervalue . "' or Language like '%" . $langvalue . "' ORDER BY ReleaseYear DESC,Hits DESC";
            }
            $resultset = mysqli_query($con, $this->query);
            return $resultset;
        }
    }

    public function getaudios_m($inputvalue, $startlimit, $filter) {
        $inputvalue_arr = explode(" ", $inputvalue);
        $albumvalue = "";
        $composervalue = "";
        $langvalue = "";
        $endlimt = $startlimit + 20;
        $startlimit = 0;
        for ($i = 0; $i < count($inputvalue_arr); $i++) {
            if ($i == count($inputvalue_arr) - 1) {
                $albumvalue = $albumvalue . $inputvalue_arr[$i] . "%";
                $composervalue = $composervalue . $inputvalue_arr[$i] . "%";
                $langvalue = $langvalue . $inputvalue_arr[$i] . "%";
            } else {
                $albumvalue = $albumvalue . $inputvalue_arr[$i] . "%' or AlbumName like '%";
                $composervalue = $composervalue . $inputvalue_arr[$i] . "%' or ComposerName like '%";
                $langvalue = $langvalue . $inputvalue_arr[$i] . "%' or Language like '%";
            }
        }
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            if ($inputvalue == "") {
                if ($filter == 1) {
                    $this->query = "select AlbumId,AlbumName,CreatedBy,AlbumType,ComposerName,ReleaseYear,Language,Hits from albumlist ORDER BY Hits DESC LIMIT $startlimit,$endlimt";
                } else {
                    $this->query = "select AlbumId,AlbumName,CreatedBy,AlbumType,ComposerName,ReleaseYear,Language,Hits from albumlist ORDER BY ReleaseYear DESC,CreatedOn DESC LIMIT $startlimit,$endlimt";
                }
            } else {
                $this->query = "select AlbumId,AlbumName,CreatedBy,AlbumType,ComposerName,ReleaseYear,Language,Hits from albumlist where AlbumName like '%" . $albumvalue . "' or ComposerName like '%" . $composervalue . "' or Language like '%" . $langvalue . "' ORDER BY ReleaseYear DESC,Hits DESC";
            }
            $resultset = mysqli_query($con, $this->query);
            return $resultset;
        }
    }

    public function getmyvideos($userid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select * from videolist where uploadedby=$userid";
            $resultset = mysqli_query($con, $this->query);
            return $resultset;
        }
    }

    public function getvideolisttoapprove() {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select * from videolist where approved =0";
            $resultset = mysqli_query($con, $this->query);
            return $resultset;
        }
    }

    public function getvideoinfo($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select VideoId,VideoName,MovieOrAlbum,StarCast,VideoType,ReleaseYear,Language,NoOfHits from videolist where VideoId like '$param'";
            $resultset = mysqli_query($con, $this->query);
            return $resultset;
        }
    }

    public function getalbuminfo($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select * from Albumlist where AlbumId=$param";
            $resultset = mysqli_query($con, $this->query);
            return $resultset;
        }
    }

    public function getposttagsinfo($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select cardid,cardcontent,cardimagesid,cardvideosid,cardextvidtitle,cardextvidurl,cardextvidimage,cardextviddesc from postcarddata where cardid=$param";
            $resultset = mysqli_query($con, $this->query);
            return $resultset;
        }
    }

    public function logincheck($username, $password) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "Select * from userdetails where username='" . $username . "' and password='" . $password . "'";
            $result = mysqli_query($con, $this->query);
            return $result;
        }
    }

    public function signupform($name, $emailaddr, $password) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "insert into userdetails(name,username,password,birthdate,gender,mobileno,Language,createddate) values('" . $name . "','" . $emailaddr . "','" . $password . "','','','','','" . date("Y-m-d h:i:sa") . "')";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }

    public function approvevideoupdate($videoid, $status) {
        $query = "";
        if ($status == "true") {
            $query = "update videolist SET Approved=18 where videoid='$videoid'";
        } else {
            $query = "update videolist SET Approved=7 where videoid='$videoid'";
        }
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = $query;
            $result = mysqli_query($con, $this->query);
            return $result;
        }
    }

    public function adminlogincheck($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "Select * from adminuser where userid=" . $param;
            $result = mysqli_query($con, $this->query);
            return $result;
        }
    }

    public function Videoviewincrementdb($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "Update videolist set `NoOfHits`=`NoOfHits`+1 where VideoId like '" . $param . "'";
            $result = mysqli_query($con, $this->query);
        }
    }

    public function postviewcountincrement($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "Update postcarddata set `viewcount`=`viewcount`+1 where cardid=$param";
            $result = mysqli_query($con, $this->query);
        }
    }

    public function audioviewincrementdb($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "Update albumlist set `Hits`=`Hits`+1 where AlbumId like '" . $param . "'";
            $result = mysqli_query($con, $this->query);
        }
    }

    public function getprofiledetails($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select * from userdetails where sno=$param";
            $result = mysqli_query($con, $this->query);
        }
        return $result;
    }

    public function getlanguages() {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select * from Languages";
            $result = mysqli_query($con, $this->query);
        }
        return $result;
    }

    public function updateprofileinfodb($name, $email, $birthdate, $gender, $mobileno, $language,$userid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $imgdata = $imagedata;
            if (strpos($imagedata, 'image/jpeg') !== false) {
                $file = "prof_img_$userid.jpg";
            } else {
                $file = "prof_img_$userid.png";
            }
            $this->query = "update userdetails set name='$name',username='$email',birthdate='$birthdate',gender='$gender',mobileno='$mobileno',language='$language',createddate='" . date("Y-m-d h:i:sa") . "' where sno=$userid";
            $result = mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
                //return $this->query;
            }
        }
    }

    public function insertcontactusdb($name, $email, $phoneno, $comment) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "insert into contactus(Name,Email,Phoneno,Comments,SubmittedDate,Status) values('" . $name . "','" . $email . "','" . $phoneno . "','" . $comment . "','" . date("Y-m-d H:i:s") . "',0)";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }

    public function putsignupdatadb($name, $email, $password) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "insert into userdetails(name,username,password,createddate) values('" . $name . "','" . $email . "','" . $password . "','" . date("Y-m-d H:i:s") . "')";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }

    public function createmusicalbum($name, $albumimage,$userid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        $albumid = '';
        $keys = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        for ($i = 0; $i < 9; $i++) {
            $albumid .= $keys[array_rand($keys)];
        }
        if (!$con) {
            return "Failure";
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "Select * from albumlist where AlbumName = '$name'";
            $ress = mysqli_query($con, $this->query);
            if (mysqli_num_rows($ress) == 0) {
                $this->query = "insert into albumlist(AlbumId,AlbumName,AlbumArt,Hits,CreatedBy,CreatedOn) values($albumid,'$name','$albumimage',0,$userid,'" . date("Y-m-d H:i:s") . "')";
                mysqli_query($con, $this->query);
                if (mysqli_affected_rows($con) > 0) {
                    return "$albumid";
                } else {
                    return "Failure";
                }
            } else {
                return "Failure";
            }
        }
    }

    public function inserttrackinfo($name, $orgname, $albumid, $hits) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return "Failure";
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "insert into tracklist(TrackName,TrackOrgName,AlbumId,Hits) values('$name','$orgname',$albumid,$hits)";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }

    public function updatemusicalbum($albumid, $albumtype, $composername, $releaseyear, $language) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return "Failure";
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "update albumlist set AlbumType='$albumtype', ComposerName='$composername', ReleaseYear=$releaseyear, Language='$language' where AlbumId=$albumid";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }

    public function PlayMusicAlbum($input) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return "Failure";
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "SELECT t.trackname, t.trackorgname, a.albumart FROM tracklist t, albumlist a WHERE t.albumid =$input AND a.albumid =$input";
            $ress = mysqli_query($con, $this->query);
            return $ress;
        }
    }

    public function getfilenames($param, $type) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            if ($type == 0) {
                $this->query = "select VideoId,VideoName from videolist where VideoId='$param'";
                $result = mysqli_query($con, $this->query);
                return $result;
            } else if ($type == 1) {
                $this->query = "select TrackName,TrackOrgName from tracklist where Albumid=$param";
                $result = mysqli_query($con, $this->query);
                return $result;
            } else if ($type == 2) {
                $this->query = "select TrackName,TrackOrgName from tracklist where TrackName='$param'";
                $result = mysqli_query($con, $this->query);
                return $result;
            }
        }
    }

    public function getalbumname($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select AlbumName from Albumlist where AlbumId=$param";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }

    public function getvideoname($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select VideoName from Videolist where VideoId='$param'";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }

    public function getfileinfofordownload($param, $type) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            if ($type == 0) {
                $this->query = "select v.VideoName,v.MovieOrAlbum,v.UploadedDate,u.name,v.ImagePrint from videolist v,UserDetails u where v.VideoId='$param' and v.uploadedby=u.sno";
                $result = mysqli_query($con, $this->query);
                return $result;
            } else if ($type == 1) {
                $this->query = "select a.AlbumName,a.ComposerName,a.createdOn,u.name,a.albumart from albumlist a,Userdetails u where a.Albumid=$param and a.createdby=u.sno";
                $result = mysqli_query($con, $this->query);
                return $result;
            } else if ($type == 2) {
                $this->query = "select TrackName,TrackOrgName from tracklist where TrackName='$param'";
                $result = mysqli_query($con, $this->query);
                return $result;
            }
        }
    }

    public function SetPasswordReset($param) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select username,Password from userdetails where username='$param'";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }

    public function getImageArt($id, $type) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            if ($type == 0) {
                mysqli_select_db($con, $this->dbname);
                $this->query = "Select ImagePrint from videolist where Videoid='$id'";
                $res = mysqli_query($con, $this->query);
                return $res;
            } else {
                mysqli_select_db($con, $this->dbname);
                $this->query = "Select AlbumArt from albumlist where AlbumId=$id";
                $res = mysqli_query($con, $this->query);
                return $res;
            }
        }
    }

    public function gettracksfromalbumid($albumid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "Select TrackName,TrackOrgName,Hits from tracklist where AlbumId=$albumid";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }

    public function incrementradiocount($radioid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "update radioslist set visits=visits+1 where id=$radioid";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }

    public function incrementvideocount($videoid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "update videolist set NoOfHits=NoOfHits+1 where Videoid='$videoid'";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }

    public function incrementalbumcount($albumid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "update albumlist set Hits=Hits+1 where Albumid=$albumid";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }

    public function incrementtrackcount($trackid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "update tracklist set Hits=Hits+1 where Trackid=$trackid";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }

    public function insertpostcard($postcontent, $previewurl, $previewurlimg, $previewurltitle, $previewurldesc, $previewurlsite, $imagesid, $videoid,$userid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        $con1 = mysqli_connect($this->dbserver, $this->username, $this->password);
        $con2 = mysqli_connect($this->dbserver, $this->username, $this->password);
        $con3 = mysqli_connect($this->dbserver, $this->username, $this->password);
        $con4 = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            mysqli_select_db($con1, $this->dbname);
            mysqli_select_db($con2, $this->dbname);
            mysqli_select_db($con3, $this->dbname);
            mysqli_select_db($con4, $this->dbname);
            $key = '';
            $keys = array_merge(range(0, 5), range(6, 9));

            for ($i = 0; $i < 12; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $this->query = "insert into postcarddata("
                    . "cardid,cardcontent,cardimagesid,cardvideosid,cardextvidsite,cardextvidtitle,cardextvidurl,cardextvidimage,cardextviddesc,postedby,posteddate,reportflag,viewcount)"
                    . " values($key,'$postcontent','$imagesid','$videoid','$previewurlsite','$previewurltitle','$previewurl','$previewurlimg','$previewurldesc',$userid,'" . date("Y-m-d h:i:sa") . "',0,0)";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                $this->query = "insert into sociallike values($key,0)";
                mysqli_query($con1, $this->query);
                $this->query = "insert into socialunlike values($key,0)";
                mysqli_query($con2, $this->query);
                $this->query = "insert into socialshare values($key,0)";
                mysqli_query($con3, $this->query);
                $this->query = "insert into socialreport values($key,0)";
                mysqli_query($con4, $this->query);
                return "Successfully posted the Card.";
            } else {
                return "Failed to post the Card. Please try again sometime.";
            }
        }
    }

    public function displaypostcards($search, $type, $startlmt) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        $startlimit = $startlmt;
        $endlimit = 0;
        if (!$con) {
            return FALSE;
        } else {
            $endlimit=$startlimit+20;
            mysqli_select_db($con, $this->dbname);
            if ($type == 0) {
                $this->query = "SELECT "
                        . "pc.cardid, pc.cardcontent, pc.cardimagesid, pc.cardvideosid, "
                        . "pc.cardextvidsite, pc.cardextvidtitle, pc.cardextvidurl,"
                        . "pc.cardextvidimage,pc.cardextviddesc, ud.name, pc.posteddate,"
                        . "sl.likecount,su.unlikecount,ss.sharecount,sr.reportcount,pc.viewcount,"
                        . "(SELECT socialtype from socialactivity WHERE itemid=pc.cardid and userid=ud.sno),pc.postedby "
                        . "FROM postcarddata pc, userdetails ud,sociallike sl,socialunlike su,socialshare ss,socialreport sr "
                        . "WHERE pc.postedby = ud.sno "
                        . "and sl.itemid=pc.cardid and su.itemid=pc.cardid and ss.itemid=pc.cardid and sr.itemid=pc.cardid "
                        . "Order by pc.posteddate DESC LIMIT $startlimit,$endlimit";
            } else if ($type == 1) {
                $this->query = "SELECT "
                        . "pc.cardid, pc.cardcontent, pc.cardimagesid, pc.cardvideosid, "
                        . "pc.cardextvidsite, pc.cardextvidtitle, pc.cardextvidurl,"
                        . "pc.cardextvidimage,pc.cardextviddesc, ud.name, pc.posteddate,"
                        . "sl.likecount,su.unlikecount,ss.sharecount,sr.reportcount,pc.viewcount,"
                        . "(SELECT socialtype from socialactivity WHERE itemid=pc.cardid and userid=ud.sno),pc.postedby "
                        . "FROM postcarddata pc, userdetails ud,sociallike sl,socialunlike su,socialshare ss,socialreport sr "
                        . "WHERE pc.cardid=$search and pc.postedby = ud.sno "
                        . "and sl.itemid=pc.cardid and su.itemid=pc.cardid and ss.itemid=pc.cardid and sr.itemid=pc.cardid";
            } elseif ($type == 3) {
                $this->query = "SELECT "
                        . "pc.cardid, pc.cardcontent, pc.cardimagesid, pc.cardvideosid, "
                        . "pc.cardextvidsite, pc.cardextvidtitle, pc.cardextvidurl,"
                        . "pc.cardextvidimage,pc.cardextviddesc, ud.name, pc.posteddate,"
                        . "sl.likecount,su.unlikecount,ss.sharecount,sr.reportcount,pc.viewcount,"
                        . "(SELECT socialtype from socialactivity WHERE itemid=pc.cardid and userid=ud.sno),pc.postedby "
                        . "FROM postcarddata pc, userdetails ud,sociallike sl,socialunlike su,socialshare ss,socialreport sr "
                        . "WHERE pc.cardid=$search and pc.postedby = ud.sno "
                        . "and sl.itemid=pc.cardid and su.itemid=pc.cardid and ss.itemid=pc.cardid and sr.itemid=pc.cardid";
            } else {
                $this->query = "SELECT "
                        . "pc.cardid, pc.cardcontent, pc.cardimagesid, pc.cardvideosid, "
                        . "pc.cardextvidsite, pc.cardextvidtitle, pc.cardextvidurl,"
                        . "pc.cardextvidimage,pc.cardextviddesc, ud.name, pc.posteddate,"
                        . "sl.likecount,su.unlikecount,ss.sharecount,sr.reportcount,pc.viewcount,"
                        . "(SELECT socialtype from socialactivity WHERE itemid=pc.cardid and userid=ud.sno),pc.postedby "
                        . "FROM postcarddata pc, userdetails ud,sociallike sl,socialunlike su,socialshare ss,socialreport sr "
                        . "WHERE pc.cardcontent like '%$search%' and pc.postedby = ud.sno "
                        . "and sl.itemid=pc.cardid and su.itemid=pc.cardid and ss.itemid=pc.cardid and sr.itemid=pc.cardid";
            }
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }

    public function displaymypostcards($userid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "SELECT "
                    . "pc.cardid, pc.cardcontent, pc.cardimagesid, pc.cardvideosid, "
                    . "pc.cardextvidsite, pc.cardextvidtitle, pc.cardextvidurl,"
                    . "pc.cardextvidimage,pc.cardextviddesc, ud.name, pc.posteddate,"
                    . "sl.likecount,su.unlikecount,ss.sharecount,sr.reportcount,pc.viewcount,"
                    . "(SELECT socialtype from socialactivity WHERE itemid=pc.cardid and userid=ud.sno) "
                    . "FROM postcarddata pc, userdetails ud,sociallike sl,socialunlike su,socialshare ss,socialreport sr "
                    . "WHERE pc.postedby = $userid and pc.postedby = ud.sno "
                    . "and sl.itemid=pc.cardid and su.itemid=pc.cardid and ss.itemid=pc.cardid and sr.itemid=pc.cardid "
                    . "Order by pc.posteddate DESC";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }

    public function trendingcards() {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        $startlimit = 0;
        $endlimit = 10;
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "SELECT "
                    . "pc.cardid, pc.cardcontent, pc.cardimagesid, pc.cardvideosid, "
                    . "pc.cardextvidsite, pc.cardextvidtitle, pc.cardextvidurl,"
                    . "pc.cardextvidimage,pc.cardextviddesc, ud.name, pc.posteddate "
                    . "FROM postcarddata pc, userdetails ud WHERE pc.postedby = ud.sno "
                    . "Order by pc.posteddate DESC LIMIT $startlimit,$endlimit";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }

    public function cardaction($postid, $type,$userid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            if ($type == 3) {
                $this->query = "update socialshare set sharecount=sharecount+1 where itemid=$postid";
                mysqli_query($con, $this->query);
                if (mysqli_affected_rows($con) > 0) {
                    return "Success";
                }
            } else {
                $socialreturn = $this->cardactioncheck($postid, $userid, $type);
            }


            if ($type == 0) {
                return $this->cardactionlike($socialreturn, $postid, $userid);
            } else if ($type == 1) {
                return $this->cardactionunlike($socialreturn, $postid, $userid);
            } else if ($type == 2) {
                return $this->cardactionreport($socialreturn, $postid, $userid);
            }
        }
    }

    public function cardactioncheck($postid, $userid, $type) {
        $con1 = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con1) {
            return FALSE;
        } else {
            mysqli_select_db($con1, $this->dbname);
            $this->query1 = "select * from socialactivity where itemid=$postid and userid=$userid order by socialtype ASC";
            $res1 = mysqli_query($con1, $this->query1);
            return $res1;
        }
    }

    public function cardactionlike($socialreturn, $postid, $userid) {
        $con1 = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con1) {
            return "Failure";
        } else {
            mysqli_select_db($con1, $this->dbname);
            if (mysqli_num_rows($socialreturn)) {
                $socialcheck = mysqli_fetch_row($socialreturn);
                if ($socialcheck[1] == 0) {
                    $this->query = "update sociallike set likecount=likecount-1 where itemid=$postid";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1) > 0) {
                        $this->query = "delete from socialactivity where itemid=$postid and userid=$userid";
                        mysqli_query($con1, $this->query);
                        if (mysqli_affected_rows($con1)) {
                            return "false-false-false";
                        }
                    }
                } else if ($socialcheck[1] == 1) {
                    $this->query = "update sociallike sl,socialunlike su set sl.likecount=sl.likecount+1,su.unlikecount=su.unlikecount-1 where sl.itemid=$postid and sl.itemid=su.itemid";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1) > 0) {
                        $this->query = "delete from socialactivity where itemid=$postid and userid=$userid";
                        mysqli_query($con1, $this->query);
                        $this->query = "insert into socialactivity values($postid,0,$userid)";
                        mysqli_query($con1, $this->query);
                        if (mysqli_affected_rows($con1)) {
                            return "true-false-false";
                        }
                    }
                } else if ($socialcheck[1] == 2) {
                    $this->query = "update sociallike sl,socialreport sr set sl.likecount=sl.likecount+1,sr.reportcount=sr.reportcount-1 where sl.itemid=$postid and sl.itemid=sr.itemid";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1) > 0) {
                        $this->query = "delete from socialactivity where itemid=$postid and userid=$userid";
                        mysqli_query($con1, $this->query);
                        $this->query = "insert into socialactivity values($postid,0,$userid)";
                        mysqli_query($con1, $this->query);
                        if (mysqli_affected_rows($con1)) {
                            return "true-false-false";
                        }
                    }
                }
            } else {
                $this->query = "update sociallike set likecount=likecount+1 where itemid=$postid";
                mysqli_query($con1, $this->query);
                if (mysqli_affected_rows($con1) > 0) {
                    $this->query = "insert into socialactivity values($postid,0,$userid)";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1)) {
                        return "true-false-false";
                    }
                }
            }
        }
    }

    public function cardactionunlike($socialreturn, $postid, $userid) {
        $con1 = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con1) {
            return "Failure";
        } else {
            mysqli_select_db($con1, $this->dbname);
            if (mysqli_num_rows($socialreturn) == 1) {
                $socialcheck = mysqli_fetch_row($socialreturn);
                if ($socialcheck[1] == 0) {
                    $this->query = "update sociallike sl,socialunlike su set su.unlikecount=su.unlikecount+1,sl.likecount=sl.likecount-1 where su.itemid=$postid and su.itemid=sl.itemid";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1) > 0) {
                        $this->query = "delete from socialactivity where itemid=$postid and userid=$userid";
                        mysqli_query($con1, $this->query);
                        $this->query = "insert into socialactivity values($postid,1,$userid)";
                        mysqli_query($con1, $this->query);
                        if (mysqli_affected_rows($con1)) {
                            return "false-true-false";
                        }
                    }
                } else if ($socialcheck[1] == 1) {
                    $this->query = "update socialunlike unlikecount=unlikecount-1 where itemid=$postid";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1) > 0) {
                        $this->query = "delete from socialactivity where itemid=$postid and userid=$userid";
                        mysqli_query($con1, $this->query);
                        if (mysqli_affected_rows($con1)) {
                            return "false-false-false";
                        }
                    }
                } else if ($socialcheck[1] == 2) {
                    $this->query = "update socialunlike set unlikecount=unlikecount+1 where itemid=$postid";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1) > 0) {
                        $this->query = "delete from socialactivity where itemid=$postid and userid=$userid";
                        mysqli_query($con1, $this->query);
                        $this->query = "insert into socialactivity values($postid,1,$userid)";
                        if (mysqli_affected_rows($con1)) {
                            return "false-true-true";
                        }
                    }
                }
            } else if (mysqli_num_rows($socialreturn) == 2) {
                $this->query = "update socialunlike set unlikecount=unlikecount-1 where itemid=$postid";
                mysqli_query($con1, $this->query);
                if (mysqli_affected_rows($con1) > 0) {
                    $this->query = "delete from socialactivity where itemid=$postid and userid=$userid and socialtype=1";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1)) {
                        return "false-false-true";
                    }
                }
            } else {
                $this->query = "update socialunlike set unlikecount=unlikecount+1 where itemid=$postid";
                mysqli_query($con1, $this->query);
                if (mysqli_affected_rows($con1) > 0) {
                    $this->query = "insert into socialactivity values($postid,1,$userid)";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1)) {
                        return "false-true-false";
                    }
                }
            }
        }
    }

    public function cardactionreport($socialreturn, $postid, $userid) {
        $con1 = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con1) {
            return "Failure";
        } else {
            mysqli_select_db($con1, $this->dbname);
            if (mysqli_num_rows($socialreturn)) {
                $socialcheck = mysqli_fetch_row($socialreturn);
                if ($socialcheck[1] == 0) {
                    $this->query = "update sociallike sl,socialreport sr set sl.likecount=sl.likecount-1,sr.reportcount=sr.reportcount+1 where sr.itemid=$postid and sr.itemid=sl.itemid";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1) > 0) {
                        $this->query = "delete from socialactivity where itemid=$postid and userid=$userid";
                        mysqli_query($con1, $this->query);
                        $this->query = "insert into socialactivity values($postid,2,$userid)";
                        if (mysqli_affected_rows($con1)) {
                            return "false-false-true";
                        }
                    }
                } else if ($socialcheck[1] == 1) {
                    $this->query = "update socialreport set reportcount=reportcount+1 where itemid=$postid";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1) > 0) {
                        $this->query = "insert into socialactivity values($postid,2,$userid)";
                        mysqli_query($con1, $this->query);
                        if (mysqli_affected_rows($con1)) {
                            return "false-false-true";
                        }
                    }
                } else if ($socialcheck[1] == 2) {
                    $this->query = "update socialreport set reportcount=reportcount-1 where itemid=$postid";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1) > 0) {
                        $this->query = "delete from socialactivity where itemid=$postid and userid=$userid";
                        mysqli_query($con1, $this->query);
                        if (mysqli_affected_rows($con1)) {
                            return "false-false-false";
                        }
                    }
                }
            } else if (mysqli_num_rows($socialreturn) == 2) {
                $this->query = "update socialreport set reportcount=reportcount-1 where itemid=$postid";
                mysqli_query($con1, $this->query);
                if (mysqli_affected_rows($con1) > 0) {
                    $this->query = "delete from socialactivity where itemid=$postid and userid=$userid and type=2";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1)) {
                        return "false-true-false";
                    }
                }
            } else {
                $this->query = "update socialreport set reportcount=reportcount+1 where itemid=$postid";
                mysqli_query($con1, $this->query);
                if (mysqli_affected_rows($con1) > 0) {
                    $this->query = "insert into socialactivity values($postid,2,$userid)";
                    mysqli_query($con1, $this->query);
                    if (mysqli_affected_rows($con1)) {
                        return "false-false-true";
                    }
                }
            }
        }
    }

}

?>
