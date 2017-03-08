<?php
session_start();
include 'Main_Controller.php';
if (isset($_GET["Action"])) {
    if ($_GET["Action"] == "logoff") {
        $logoff = new Main_Controller();
        $logoff->logoffdata();
    }

    if ($_GET["Action"] == "Approve") {
        $approveobj = new Main_Controller();
        $approveobj->videoApprovedata($_GET["Videoid"], $_GET["statusval"]);
    }

    if ($_GET["Action"] == "viewcount") {
        $viewobj = new Main_Controller();
        if (isset($_GET["vid"])) {
            $viewobj->videoviewincrement($_GET["vid"]);
        } else {
            $viewobj->AudioViewIncrement($_GET["aid"]);
        }
    }

    if ($_GET["Action"] == "profileinfo") {
        $profobj = new Main_Controller();
        echo $profobj->UpdateProfileInfo($_POST["name"], $_POST["email"], $_POST["birthdate"], $_POST["gender"], $_POST["phoneno"], $_POST["language"],$_POST["imagedata"]);
    }

    if ($_GET["Action"] == "Contact_us") {
        $contactobj = new Main_Controller();
        echo $contactobj->InsertContactUs($_POST["name"], $_POST["email"], $_POST["phoneno"], $_POST["comment"]);
    }

    if ($_GET["Action"] == "Signup") {
        $signup = new Main_Controller();
        echo $signup->Signupdata($_POST["name"], $_POST["email"], $_POST["password"]);
    }

    if ($_GET["Action"] == "login") {
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $loginobj = new Main_Controller();
            $loginobj->logindata($_POST["username"], $_POST["password"]);
        }
    }

    if ($_GET["Action"] == "getmorevideos") {
        $actionobj1 = new Main_Controller();
        echo $actionobj1->getvideosfromdb("", $_POST["startlimit"],$_SESSION["videoplaylistid"]);
    }

    if ($_GET["Action"] == "Albumcreation") {
        $albumcrtobj = new Main_Controller();
        echo $albumcrtobj->CreateMusicAlbum($_POST["albumname"], $_POST["albumart"]);
    }

    if ($_GET["Action"] == "Albumupdation") {
        $albumupdobj = new Main_Controller();
        echo $albumupdobj->UpdateMusicAlbum($_POST["albumname"], $_POST["composername"], $_POST["releaseyear"], $_POST["language"]);
    }

    if ($_GET["Action"] == "Playalbum") {
        $playalbumobj = new Main_Controller();
        echo $playalbumobj->PlayMusicAlbum($_POST["albumid"]);
    }

    if ($_GET["Action"] == "getmoreaudios") {
        $actionobj1 = new Main_Controller();
        echo $actionobj1->GetAudiosFromDB("", $_POST["startlimit"]);
    }

    if ($_GET["Action"] == "RecoverPassword") {
        $recoveractionobj = new Main_Controller();
        echo $recoveractionobj->SetPasswordReset($_POST["emailval"]);
    }

    if ($_GET["Action"] == "PostCard") {
        $postcardobj = new Main_Controller();
        echo $postcardobj->insertPostCard($_POST["postcontent"], $_POST["previewurl"], $_POST["previewurlimg"], $_POST["previewurltitle"], $_POST["previewurldesc"], $_POST["previewurlsite"]);
    }
    if ($_GET["Action"] == "viewpost") {
        $viewpostobj = new Main_Controller();
        echo $viewpostobj->displayPostCards($_POST["postid"],$_POST["typev"],1);
    }
    if ($_GET["Action"] == "cardsocialaction") {
        $cardactobj = new Main_Controller();
        if(isset($_SESSION["userid"])==false && $_POST["typeval"] != "3")
        {
            echo "redirectlogin";
        }
        else
        {
            echo $cardactobj->socialAction($_POST["postid"],0,$_POST["typeval"]);
        }
    }
    
    if ($_GET["Action"] == "MoviesDB") {
        $moviesdbobj = new Main_Controller();
        echo $moviesdbobj->insertMoviesDb($_POST["titleval"], $_POST["titleurlpath"], $_POST["genere"]);
    }
    if ($_GET["Action"] == "Movie") {
        $movieobj = new Main_Controller();
        echo $movieobj->insertMovieInfo($_POST["idmovieval"],$_POST["moviename"], $_POST["moviedesc"], $_POST["moviebanner"], $_POST["director"], $_POST["producer"], $_POST["writter"], $_POST["screenplay"], $_POST["story"], $_POST["starring"], $_POST["musicdirector"], $_POST["cinematographer"], $_POST["editor"], $_POST["productioncompany"], $_POST["distributioncompany"], $_POST["releasedate"], $_POST["movieduration"], $_POST["language"], $_POST["budget"], $_POST["boxofficecollection"], $_POST["tracktable"]);
    }
    if ($_GET["Action"] == "updatemovieparsed") {
        $movieobj = new Main_Controller();
        echo $movieobj->updateParsedStatus($_POST["idval"]);
    }
    
    if($_GET["Action"] == "loadvideos")
    {
        if($_GET["type"] == "Songs")
        {
            $_SESSION["videoplaylistid"]="Song";
            header("Location:Videos.php");
        }
        else if($_GET["type"] == "Movies")
        {
            $_SESSION["videoplaylistid"]="Movie";
            header("Location:Videos.php");
        }
        else if($_GET["type"] == "MovieScenes")
        {
            $_SESSION["videoplaylistid"]="MoviesScene";
            header("Location:Videos.php");
        }
        else if($_GET["type"] == "BehindScenes")
        {
            $_SESSION["videoplaylistid"]="BehindScene";
            header("Location:Videos.php");
        }
        else if($_GET["type"] == "Controversial")
        {
            $_SESSION["videoplaylistid"]="Controversial";
            header("Location:Videos.php");
        }
        else if($_GET["type"] == "Trailers")
        {
            $_SESSION["videoplaylistid"]="Trailer";
            header("Location:Videos.php");
        }
    }
    
    if($_GET["Action"] == "updateplaylist")
    {
        $videoobj=new Main_Controller();
        echo $videoobj->updateVideosInfo($_POST["videoid"],$_POST["videotitle"],$_POST["videodesc"],$_POST["videoposter"],$_POST["videotype"],$_POST["videotags"],$_POST["uploaddat"],$_POST["viewcount"]);
    }
    if($_GET["Action"] == "truncatevideos")
    {
        $truncobj=new Main_Controller();
        echo $truncobj->truncateVideos();
    }
    if($_GET["Action"] == "updatemoviereview")
    {
        $reviewobj=new Main_Controller();
        echo $reviewobj->insertMovieReview($_POST['revdesc'],$_POST['revurl']);
    }
    if($_GET["Action"] == "getmoviereviews")
    {
        $movrevobj=new Main_Controller();
        echo $movrevobj->getMovieReviewData($_SESSION["movieid"]);
    }
    if($_GET["Action"] == "searchmovie")
    {
        $movsearchobj=new Main_Controller();
        echo $movsearchobj->movieSearchData($_POST["movieval"]);
    }
    if($_GET["Action"]=="moviesocialaction")
    {
        $cardactobj = new Main_Controller();
        if(isset($_SESSION["userid"])==false)
        {
            echo "redirectlogin";
        }
        else
        {
            echo $cardactobj->socialAction($_POST["itemid"],1,$_POST["typeval"]);
        }
    }
}
?>