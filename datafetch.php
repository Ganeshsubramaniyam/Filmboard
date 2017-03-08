<?php

class datafetch {

    public $con;
    public $dbserver;
    public $username;
    public $password;
    public $dbname;
    public $query;

    function __construct() {
        /*$this->dbserver = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "funraaga";*/

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

    public function getvideolist($inputvalue, $startlimit,$videotype) {
        //if ($_SESSION["currentpage"] == "Videos.php") {
            $inputvalue_arr = explode(" ", $inputvalue);
            $vidinputvalue = "";
            $viddescvalue = "";
            $videotypevalue = "";
            $videotagvalue = "";
            $endlimt = 20;
            if($inputvalue != "")
            {
                for ($i = 0; $i < count($inputvalue_arr); $i++) {
                    if ($i == count($inputvalue_arr) - 1) {
                        $vidinputvalue = $vidinputvalue . $inputvalue_arr[$i] . "%";
                        $videotypevalue = $videotypevalue . $inputvalue_arr[$i] . "%";
                        $viddescvalue = $viddescvalue . $inputvalue_arr[$i] . "%";
                        $videotagvalue = $videotagvalue. $inputvalue_arr[$i]."%";
                    } else {
                        $vidinputvalue = $vidinputvalue . $inputvalue_arr[$i] . "%' or VideoName like '%";
                        $videotypevalue = $videotypevalue . $inputvalue_arr[$i] . "%' or VideoTupe like '%";
                        $viddescvalue = $viddescvalue . $inputvalue_arr[$i] . "%' or VideoDescription like '%";
                        $videotagvalue = $videotagvalue. $inputvalue_arr[$i]."%' or VideoTags like '%";
                    }
                }
            }
            $con = mysqli_connect($this->dbserver, $this->username, $this->password);
            if (!$con) {
                return FALSE;
            } else {
                mysqli_select_db($con, $this->dbname);
                if ($inputvalue == "" && $videotype != "") {
                    $this->query = "select * from videolist where VideoType = '$videotype' ORDER BY UploadedDate DESC LIMIT $startlimit,$endlimt";
                }
                else if($inputvalue == "" && $videotype == "")
                {
                    $this->query = "select * from videolist ORDER BY UploadedDate DESC LIMIT $startlimit,$endlimt";
                }
                else {
                    $this->query = "select * from videolist where VideoTitle like '%" . $vidinputvalue . "' or VideoType like '%" . $videotypevalue . "' or VideoDescription like '%" . $viddescvalue . "' or VideoTags like '%".$videotagvalue."'";
                }
                $resultset = mysqli_query($con, $this->query);
                return $resultset;
            }
        //} 
        /*else {
            $inputvalue_arr = explode("?", $inputvalue);
            $starinputvalue = "";
            $movalbinputvalue = "";
            $typeinputvalue = "";
            $endlimt = $startlimit + 20;
            $startlimit = 0;
            for ($i = 0; $i < count($inputvalue_arr); $i++) {
                if ($i == count($inputvalue_arr) - 1) {
                    $typeinputvalue = $typeinputvalue . $inputvalue_arr[$i] . "%";
                    $movalbinputvalue = $movalbinputvalue . $inputvalue_arr[$i] . "%";
                    $starinputvalue = $starinputvalue . $inputvalue_arr[$i] . "%";
                } else {
                    $typeinputvalue = $typeinputvalue . $inputvalue_arr[$i] . "%' or VideoType like '%";
                    $movalbinputvalue = $movalbinputvalue . $inputvalue_arr[$i] . "%' or MovieorAlbum like '%";
                    $starinputvalue = $starinputvalue . $inputvalue_arr[$i] . "%' or StarCast like '%";
                }
            }
            $con = mysqli_connect($this->dbserver, $this->username, $this->password);
            if (!$con) {
                return FALSE;
            } else {
                mysqli_select_db($con, $this->dbname);
                $this->query = "select SNO,Videoid,VideoName,NoOfDownloads,MovieorAlbum,Starcast,VideoType,ReleaseYear,AgeRestrict,language,UploadedBy,UploadedDate,NoOfHits from videolist where approved !=0 and approved !=7 and (MovieOrAlbum like '%" . $movalbinputvalue . "' or StarCast like '%" . $starinputvalue . "' or VideoType like '%" . $typeinputvalue . "') ORDER BY UploadedDate DESC";
                $resultset = mysqli_query($con, $this->query);
                return $resultset;
            }
        }*/
    }

    public function getvideolist_m($inputvalue, $startlimit, $filter) {
        if ($inputvalue == "Songs" or $inputvalue == "songs") {
            $inputvalue = "Song";
        }
        $inputvalue_arr = explode(" ", $inputvalue);
        $vidinputvalue = "";
        $starinputvalue = "";
        $movalbinputvalue = "";
        $typeinputvalue = "";
        $langvalue = "";
        $endlimt = $startlimit + 20;
        for ($i = 0; $i < count($inputvalue_arr); $i++) {
            if ($i == count($inputvalue_arr) - 1) {
                $vidinputvalue = $vidinputvalue . $inputvalue_arr[$i] . "%";
                $typeinputvalue = $typeinputvalue . $inputvalue_arr[$i] . "%";
                $movalbinputvalue = $movalbinputvalue . $inputvalue_arr[$i] . "%";
                $starinputvalue = $starinputvalue . $inputvalue_arr[$i] . "%";
                $langvalue = $langvalue . $inputvalue_arr[$i] . "%";
            } else {
                $vidinputvalue = $vidinputvalue . $inputvalue_arr[$i] . "%' or VideoName like '%";
                $typeinputvalue = $typeinputvalue . $inputvalue_arr[$i] . "%' or VideoType like '%";
                $movalbinputvalue = $movalbinputvalue . $inputvalue_arr[$i] . "%' or MovieorAlbum like '%";
                $starinputvalue = $starinputvalue . $inputvalue_arr[$i] . "%' or StarCast like '%";
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
                    $this->query = "select SNO,Videoid,VideoName,NoOfDownloads,MovieorAlbum,Starcast,VideoType,ReleaseYear,AgeRestrict,language,UploadedBy,UploadedDate,NoOfHits from videolist where approved !=0 and approved !=7 ORDER BY NoOfHits DESC LIMIT $startlimit,$endlimt";
                } else {
                    $this->query = "select SNO,Videoid,VideoName,NoOfDownloads,MovieorAlbum,Starcast,VideoType,ReleaseYear,AgeRestrict,language,UploadedBy,UploadedDate,NoOfHits from videolist where approved !=0 and approved !=7 ORDER BY UploadedDate DESC LIMIT $startlimit,$endlimt";
                }
            } else {
                $this->query = "select SNO,Videoid,VideoName,NoOfDownloads,MovieorAlbum,Starcast,VideoType,ReleaseYear,AgeRestrict,language,UploadedBy,UploadedDate,NoOfHits from videolist where approved !=0 and approved !=7 and (VideoName like '%" . $vidinputvalue . "' or MovieOrAlbum like '%" . $movalbinputvalue . "' or StarCast like '%" . $starinputvalue . "' or VideoType like '%" . $typeinputvalue . "' or Language like '%" . $langvalue . "')";
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

    public function getmyvideos() {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select * from videolist where uploadedby=" . $_SESSION["userid"];
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

    public function uploadvideodetails($videoid, $videoname, $imagedata, $maname, $stars, $composeby, $release, $ageres) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "insert into videolist values('$videoid','$videoname','$imagedata','$maname','$stars',$composeby','$release',$ageres," . $_SESSION["userid"] . ",'" . date("Y-m-d h:i:sa") . "',0,0,0,0,0,0";
            $result = mysqli_query($con, $this->query);
            return $result;
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

    public function updateprofileinfodb($name, $email, $birthdate, $gender, $mobileno, $language,$imagedata) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $imgdata=$imagedata;
            if (strpos($imagedata, 'image/jpeg') !== false) {
                $file = "prof_img_".$_SESSION["userid"]. '.jpg';
            }
            else
            {
                $file = "prof_img_".$_SESSION["userid"]. '.png';
            }
            // remove "data:image/png;base64,"
            $uri = substr($imgdata,strpos($imgdata,",")+1);
            // save to file
            file_put_contents("Other Data/Images/".$file, base64_decode($uri));
            $this->query = "update userdetails set name='$name',username='$email',birthdate='$birthdate',gender='$gender',mobileno='$mobileno',language='$language',createddate='".date("Y-m-d h:i:sa")."' where sno=" . $_SESSION["userid"];
            $result = mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                //return "Failure";
                return $this->query;
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

    public function createmusicalbum($name, $albumimage) {
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
                $this->query = "insert into albumlist(AlbumId,AlbumName,AlbumArt,Hits,CreatedBy,CreatedOn) values($albumid,'$name','$albumimage',0," . $_SESSION['userid'] . ",'" . date("Y-m-d H:i:s") . "')";
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

    public function insertpostcard($postcontent, $previewurl, $previewurlimg, $previewurltitle, $previewurldesc, $previewurlsite, $imagesid, $videoid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $key = '';
            $keys = array_merge(range(0,5), range(6,9));

            for ($i = 0; $i < 12; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $this->query = "insert into postcarddata("
                    . "cardid,cardcontent,cardimagesid,cardvideosid,cardextvidsite,cardextvidtitle,cardextvidurl,cardextvidimage,cardextviddesc,postedby,posteddate,reportflag,viewcount)"
                    . " values($key,'$postcontent','$imagesid','$videoid','$previewurlsite','$previewurltitle','$previewurl','$previewurlimg','$previewurldesc'," . $_SESSION["userid"] . ",'" . date("Y-m-d h:i:sa") . "',0,0)";
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                $this->query="insert into sociallike values($key,0,0);";
                $this->query= $this->query."insert into socialunlike values($key,0,0);";
                $this->query=$this->query."insert into socialshare values($key,0,0);";
                $this->query=$this->query."insert into socialreport values($key,0,0);";
                $this->query=$this->query."insert into socialactivity values($key,0,0,".$_SESSION["userid"].");";
                mysqli_multi_query($con, $this->query);
                return "Successfully posted the Card.";
            } else {
                return "Failed to post the Card. Please try again sometime.";
            }
        }
    }

    public function displaypostcards($search, $type,$startlmt) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        $startlimit = $startlmt;
        $endlimit = 0;
        if (!$con) {
            return FALSE;
        } else {
            if ($_SESSION["postcardstartlimit"] == 0) {
                $startlimit = $_SESSION["postcardstartlimit"];
                $endlimit = $startlimit + 20;
                $_SESSION["postcardstartlimit"] = $endlimit + 1;
            } else {
                $startlimit = $_SESSION["postcardstartlimit"];
                $endlimit = $startlimit + 20;
                $_SESSION["postcardstartlimit"] = $endlimit + 1;
            }
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
            }
            elseif ($type == 3) {
                $this->query = "SELECT "
                        . "pc.cardid, pc.cardcontent, pc.cardimagesid, pc.cardvideosid, "
                        . "pc.cardextvidsite, pc.cardextvidtitle, pc.cardextvidurl,"
                        . "pc.cardextvidimage,pc.cardextviddesc, ud.name, pc.posteddate,"
                        . "sl.likecount,su.unlikecount,ss.sharecount,sr.reportcount,pc.viewcount,"
                        . "(SELECT socialtype from socialactivity WHERE itemid=pc.cardid and userid=ud.sno),pc.postedby "
                        . "FROM postcarddata pc, userdetails ud,sociallike sl,socialunlike su,socialshare ss,socialreport sr "
                        . "WHERE pc.cardid=$search and pc.postedby = ud.sno "
                        . "and sl.itemid=pc.cardid and su.itemid=pc.cardid and ss.itemid=pc.cardid and sr.itemid=pc.cardid";
            }
            else {
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
        } 
        else
        {
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

    public function insertmoviesdb($title, $titleurl, $genere) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);

            $this->query = "insert into moviesdb(moviename,movieurl,genere,parsed) values('$title','$titleurl','$genere',0)";
            mysqli_query($con, $this->query);
            return mysqli_affected_rows($con);
        }
    }

    public function insertmovieinfo($idval,$moviename, $moviedesc, $moviebanner, $director, $producer, $writter, $screenplay, $story, $starring, $musicdirector, $cinematographer, $editor, $productioncompany, $distributioncompany, $releasedate, $movieduration, $language, $budget, $boxofficecollection, $tracktable) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);

            $this->query = "insert into movielist("
                    . "movieid,moviename,moviebanner,moviedesc,starring,director,producer,"
                    . "writter,story,screenplay,musicdirector,cinematographer,editor,productioncompany,"
                    . "distributioncompany,movieduration,releasedate,language,budget,tracktable,postedby,posteddate) "
                    . "values($idval,'$moviename','$moviebanner','$moviedesc','$starring','$director','$producer',"
                    . "'$writter','$story','$screenplay','$musicdirector','$cinematographer','$editor',"
                    . "'$productioncompany','$distributioncompany','$movieduration','$releasedate','$language','$budget',"
                    . "'$tracktable'," . $_SESSION["userid"] . ",'" . date("Y-m-d h:i:sa") . "');";
            $this->query= $this->query."insert into socialactivity values($idval,1,0,".$_SESSION["userid"].");";
            $this->query= $this->query."insert into sociallike values($idval,1,0);";
            $this->query= $this->query."insert into socialunlike values($idval,1,0);";
            $this->query= $this->query."insert into socialshare values($idval,1,0);";
            $this->query= $this->query."insert into socialreport values($idval,1,0);";
            try {
                mysqli_multi_query($con, $this->query);
                return 1;
            } catch (Exception $exc) {
                return 0;
            }
        }
    }

    public function fetchallurls() {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "select id,moviename,movieurl from moviesdb where parsed=0";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }

    public function updateparsedstatus($id) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "update moviesdb set parsed=1 where id=$id";
            mysqli_query($con, $this->query);
            return mysqli_affected_rows($con);
        }
    }
    public function truncatevideos()
    {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "Truncate table videolist";
            mysqli_query($con, $this->query);
        }
    }
    public function updatevideosinfo($videoid,$videotitle,$videodesc,$videoposter,$videotype,$videotags,$uploaddate,$viewcount)
    {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            $uploaddate=str_replace("T"," ",$uploaddate);
            $uploaddate=str_replace("Z","",$uploaddate);
            $videotitle=htmlspecialchars($videotitle,ENT_QUOTES);
            $videodesc=htmlspecialchars($videodesc,ENT_QUOTES);
            $videotags=htmlspecialchars($videotags,ENT_QUOTES);
            $this->query = "insert into videolist(VideoId,VideoTitle,VideoDescription,VideoPoster,VideoType,VideoTags,UploadedDate,NoOfViews) values('$videoid','$videotitle','$videodesc','$videoposter','$videotype','$videotags','$uploaddate','$viewcount')";
            mysqli_query($con, $this->query);
            if(mysqli_affected_rows($con) > 0)
            {
                return "Success";
            }
            else {
                return $this->query;
            }
        }
    }
    
    public function fetchmovieinfo($id) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "SELECT ml.movieid,ml.moviename,ml.moviebanner,ml.moviedesc,ml.starring,"
                            . "ml.director,ml.producer, ml.writter,ml.story,ml.screenplay,ml.musicdirector,"
                            . "ml.cinematographer,ml.editor, ml.productioncompany,ml.distributioncompany,"
                            . "ml.movieduration,ml.releasedate,ml.language, ml.budget,ml.tracktable,"
                            . "md.movieurl,ml.trailerurl,sl.likecount,su.unlikecount,"
                            . "(SELECT socialtype from socialactivity WHERE itemid=48 and categorytype=1 and userid=7) "
                            . "from movielist ml , moviesdb md ,sociallike sl,socialunlike su "
                            . "WHERE ml.movieid=$id and ml.movieid=md.id and sl.itemid=ml.movieid and su.itemid=ml.movieid";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }
    public function insertmoviereview($movieid,$reviewdesc,$reviewurl,$postedby)
    {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "insert into moviereview(movieid,reviewdescription,reviewurl,postedby,posteddate) "
                            . "values($movieid,'$reviewdesc','$reviewurl',$postedby,'".date("Y-m-d h:i:sa")."')";
            mysqli_query($con, $this->query);
            if(mysqli_affected_rows($con) > 0)
            {
                return "Success";
            }
            else 
            {
                return "Failure";
            }
        }
    }
    public function getmoviereviews($movieid) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "SELECT mr.reviewdescription,mr.reviewurl,mr.posteddate,ud.name FROM moviereview mr,userdetails ud WHERE mr.movieid=$movieid and mr.postedby=ud.sno";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }
    public function moviesearchdata($moviename) {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "SELECT movieid,moviename,moviebanner,moviedesc FROM `movielist` WHERE moviename LIKE '%$moviename%'";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }
    
    public function socialcheck($itemid,$categorytype,$userid)
    {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "SELECT * from socialactivity where itemid=$itemid and categorytype=$categorytype and userid=$userid";
            $res = mysqli_query($con, $this->query);
            return $res;
        }
    }
    
    public function socialaction($itemid,$categorytype,$action,$userid)
    {
        $actionstatus=0;
        $resultdata= $this->socialcheck($itemid,$categorytype,$userid);
            $result=mysqli_fetch_row($resultdata);
            if($result[2]==1)
            {
                if($action==1)
                {
                    $actionstatus=0;
                }
                else
                {
                    $actionstatus=1;
                }
            }
            else if($result[2]==2)
            {
                if($action==2)
                {
                    $actionstatus=0;
                }
                else
                {
                    $actionstatus=1;
                }
            }
            else if($result[2]==4)
            {
                if($action==4)
                {
                    $actionstatus=0;
                }
                else
                {
                    $actionstatus=1;
                }
            }
            else
            {
                $actionstatus=1;
            }
        
        if($result[2]==1 && $action==2)
        {
            $this->sociallike($itemid,$categorytype,0);
        }
        else if($result[2]==1 && $action==4)
        {
            $this->sociallike($itemid,$categorytype,0);
        }
        else if($result[2]==2 && $action==1)
        {
            $this->socialunlike($itemid,$categorytype,0);
        }
        else if($result[2]==2 && $action==4)
        {
            $this->socialunlike($itemid,$categorytype,0);
        }
        else if($result[2]==4 && $action==1)
        {
            $this->socialreport($itemid,$categorytype,0);
        }
        else if($result[2]==4 && $action==2)
        {
            $this->socialreport($itemid,$categorytype,0);
        }
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            if($actionstatus==0)
            {
                $this->query = "update socialactivity set socialtype=0 where itemid=$itemid and categorytype=$categorytype and userid=$userid";
            }
            else
            {
                $this->query = "update socialactivity set socialtype=$action where itemid=$itemid and categorytype=$categorytype and userid=$userid";
            }
            mysqli_query($con, $this->query);
        }
        
        
        if($action == 1)
        {
            return $this->sociallike($itemid,$categorytype,$actionstatus);
        }
        else if($action == 2)
        {
            return $this->socialunlike($itemid,$categorytype,$actionstatus);
        }
        else
        {
            return $this->socialreport($itemid,$categorytype,$actionstatus);
        }
    }
    
    public function sociallike($itemid,$categorytype,$actionstatus)
    {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            if($actionstatus==1)
            {
                $this->query = "update sociallike set likecount=likecount+1 where itemid=$itemid and categorytype=$categorytype";
            }
            else
            {
                $this->query = "update sociallike set likecount=likecount-1 where itemid=$itemid and categorytype=$categorytype";
            }
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }
    public function socialunlike($itemid,$categorytype,$actionstatus)
    {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            if($actionstatus==1)
            {
                $this->query = "update socialunlike set unlikecount=unlikecount+1 where itemid=$itemid and categorytype=$categorytype";
            }
            else
            {
                $this->query = "update socialunlike set unlikecount=unlikecount-1 where itemid=$itemid and categorytype=$categorytype";
            }
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }
    
    public function socialreport($itemid,$categorytype,$actionstatus)
    {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return FALSE;
        } else {
            mysqli_select_db($con, $this->dbname);
            if($actionstatus==1)
            {
                $this->query = "update socialreport set reportcount=reportcount+1 where itemid=$itemid and categorytype=$categorytype";
            }
            else
            {
                $this->query = "update socialreport set reportcount=reportcount-1 where itemid=$itemid and categorytype=$categorytype";
            }
            mysqli_query($con, $this->query);
            if (mysqli_affected_rows($con) > 0) {
                return "Success";
            } else {
                return "Failure";
            }
        }
    }
    public function socialcount($itemid)
    {
        $con = mysqli_connect($this->dbserver, $this->username, $this->password);
        if (!$con) {
            return false;
        } else {
            mysqli_select_db($con, $this->dbname);
            $this->query = "SELECT sl.likecount,su.unlikecount,sh.sharecount,sr.reportcount from sociallike sl,socialunlike su,socialshare sh,socialreport sr WHERE sl.Itemid=$itemid and su.itemid=sl.itemid and sh.itemid=sl.itemid and sr.itemid=sl.itemid";
            $res = mysqli_query($con, $this->query);
            $result=mysqli_fetch_row($res);
            return $result[0]."-".$result[1]."-".$result[2]."-".$result[3];
        }
    }
    
    
    
}

?>
