var myPlaylist = null;

$(document).ready(function ()
{
    $("#fileuploader").uploadFile({
        url: "Audioupload.php",
        fileName: "myfile"
    });
});

$(document).ready(function () {
    $(".radiocontent a").click(function () {
        var urlid = $(this).attr('id');
        var urlpath = $("#" + urlid).attr("urlpath");
        window.fmname = $("#" + urlid).attr("fmname");
        var audioelement = $("#radioplayer");
        if (urlpath.endsWith(".mp3") || urlpath.endsWith(".pls"))
        {
            audioelement[0].src = urlpath;
        } else
        {
            audioelement[0].src = urlpath + ";stream.mp3";
        }

        audioelement[0].play()
    });
    var radiostatus_fn = function () {
        var status_o = $("#radiostatus");
        var channel_name = $("#channelname");
        var player_id = $("#radioplayer")[0];
        var st_code = player_id.readyState;
        if (st_code >= 0 && st_code <= 3)
        {
            channel_name.text("Radio : " + window.fmname);
            status_o.text("Status : Buffering...");
        } else
        {
            status_o.text("");
        }
    };
    $("#radioplayer").on("loadstart", radiostatus_fn);
    $("#radioplayer").on("playing", radiostatus_fn);
});

/*
 window.onload = function () {
 (function localFileVideoPlayerInit(win) {
 var URL = win.URL || win.webkitURL,
 displayMessage = (function displayMessageInit() {
 var node = document.querySelector('#videlist');
 
 return function displayMessage(message, isError) {
 node.innerHTML = message;
 node.className = isError ? 'error' : 'info';
 };
 }()),
 playSelectedFile = function playSelectedFileInit(event) {
 var file = this.files[0];
 
 var type = file.type;
 
 var videoNode = document.querySelector('video');
 
 var canPlay = videoNode.canPlayType(type);
 
 canPlay = (canPlay === '' ? 'no' : canPlay);
 
 var message = 'Can play type:' + type + ': ' + canPlay;
 
 var isError = canPlay === 'no';
 displayMessage("", isError);
 if (isError) {
 displayMessage(message, isError);
 return;
 }
 
 var fileURL = URL.createObjectURL(file);
 
 videoNode.src = fileURL;
 },
 inputNode = document.querySelector('input');
 
 if (!URL) {
 displayMessage("Your browser is not supported!", true);
 
 return;
 }
 
 inputNode.addEventListener('change', playSelectedFile, false);
 }(window));
 }
 
 function capture()
 {
 var canvas = document.getElementById('canvasimg');
 var video = document.getElementById('videoplay');
 canvas.getContext('2d').drawImage(video, 0, 0, video.width, canvas.height);
 }
 */
function _(el) {
    return document.getElementById(el);
}
/*
 function postdata()
 {
 if ($("#videoname").val() != "" && $("#starcast").val() != "" && $("#videotype").val() != "" && $("#agerestrict").val() != "")
 {
 bootbox.dialog({title: "File Upload Status", message: '<div style="text-align:center">' +
 '<progress id="progressBar" value="0" max="100" style="width:300px;">' +
 '</progress>' +
 '<h3 id="status1"></h3>' +
 '<p id="loaded_n_total">' +
 '</div>'});
 $("#submit").hide();
 var videoname = $('#videoname').val();
 var MovieAlbumName = $('#moviealbumname').val();
 var starcast = $('#starcast').val();
 var Vidtyp = $('#videotype').val();
 var releaseyear = $('#releaseyear').val();
 var agerestric = $('input[name=agerestrict]:checked').val();
 var lang = $('#language').val();
 var canvas = document.getElementById('canvasimg');
 var dataUrl = canvas.toDataURL();
 var imagedata = dataUrl;
 var file = _("videoupload").files[0];
 //alert(file.name+" | "+file.size+" | "+file.type);
 var formdata = new FormData();
 formdata.append("videodata", file);
 formdata.append("videoname", videoname);
 formdata.append("moviealbumname", MovieAlbumName);
 formdata.append("starcast", starcast);
 formdata.append("videotype", Vidtyp);
 formdata.append("releaseyear", releaseyear);
 formdata.append("agerestrict", agerestric);
 formdata.append("lang", lang);
 formdata.append("imagedat", imagedata);
 var ajax = new XMLHttpRequest();
 ajax.upload.addEventListener("progress", progressHandler, false);
 ajax.addEventListener("load", completeHandler, false);
 ajax.addEventListener("error", errorHandler, false);
 ajax.addEventListener("abort", abortHandler, false);
 ajax.open("POST", "videoupload.php");
 ajax.send(formdata);
 }
 }
 
 function progressHandler(event) {
 //_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
 var percent = (event.loaded / event.total) * 100;
 _("progressBar").value = Math.round(percent);
 _("status1").innerHTML = Math.round(percent) + "% uploaded... please wait";
 }
 
 function completeHandler(event) {
 _("status1").innerHTML = event.target.responseText;
 _("progressBar").value = 0;
 }
 
 function errorHandler(event) {
 _("status1").innerHTML = "Video Upload has got failed. Please try after few Mins.";
 }
 
 function abortHandler(event) {
 _("status1").innerHTML = "Video Upload has got failed. Please try after few Mins.";
 }
 */

function searchvideo()
{
    var searchtxt = document.getElementById("searchvidtext");
    window.location = "Videos.php?search=" + searchtxt.value;
}

function searchaudio()
{
    var searchtxt = document.getElementById("searchaidtext");
    window.location = "Audios.php?search=" + searchtxt.value;
}

function SubmitContactus()
{
    var nameval = $("#name").val();
    var emailval = $("#email").val();
    var phonenoval = $("#phone").val();
    var commentsval = $("#comment").val();
    if (nameval !== "" && emailval !== "" && phonenoval !== "" && commentsval !== "")
    {
        $("#Contactusstatus").append("<div style='background-color:yellow;padding-left:10px;color:black;'>The Request Submission in Progress...</div>");
        $.post("Action_Page.php?Action=Contact_us",
                {
                    name: nameval,
                    email: emailval,
                    phoneno: phonenoval,
                    comment: commentsval
                },
                function (data, status)
                {
                    if (data == "Success")
                    {
                        $("#Contactusstatus")[0].innerHTML = "";
                        $("#Contactusstatus").append("<div class='successstatus'>The Request has been submitted to the FunRaaga Team.</div>");
                    } else
                    {
                        $("#Contactusstatus")[0].innerHTML = "";
                        $("#Contactusstatus").append("<div class='failurestatus'>Failed to submit the Request to the FunRaaga Team. Please try again later.</div>");
                    }
                    $("#Contactusstatus").show();
                });
    }
}

function albumcreation()
{
    var albumnam = $("#albumname").val();
    var imagedata1 = $("#albumartimg").attr('src');
    if (albumnam != "")
    {
        $("#albumcreationstatus")[0].innerHTML = "";
        $("#albumcreationstatus").append("<div style='background-color:yellow;padding-left:10px;margin-bottom:10px;color:black;'>The Album Creation in Progress...</div>");
        $.post("Action_Page.php?Action=Albumcreation",
                {
                    albumname: albumnam,
                    albumart: imagedata1
                },
                function (data, status)
                {
                    if (data != "Failure")
                    {
                        $("#albumidval").val(data);
                        $("#albumnameview").html(albumnam);
                        $("#albumcreationhome").hide();
                        $("#albumcreationcontent").show();
                        $("#albumcreationcontent").css("display", "inline-block");
                        $("#albumcreationcontent").css("padding-top", "30px");
                        $("#albumcreationcontent").css("padding-left", "10px");
                        $("#albumcreationcontent").css("width", "98%");
                    } else
                    {
                        $("#albumcreationstatus")[0].innerHTML = "";
                        $("#albumcreationstatus").append("<div class='failurestatus' style='margin-bottom:10px;border-radius:5px;'>The Album Already exits.</div>");
                    }
                    $("#albumcreationstatus").show();
                });
    }
}

function updatealbuminfo()
{
    $albtype = $("#albumtype").val();
    $compname = $("#composername").val();
    $relyear = $("#releaseyear").val();
    $lang = $("#language").val();
    $.post("Action_Page.php?Action=Albumupdation",
            {
                albumname: $albtype,
                composername: $compname,
                releaseyear: $relyear,
                language: $lang
            },
            function (data, status)
            {
                if (data == "Success")
                {
                    $("#trackuploadstatus")[0].innerHTML = "";
                    $("#trackuploadstatus").append("<div class='successstatus' style='margin-bottom:10px;border-radius:5px;'>The Tracks uploaded successfully to the Album.</div>");
                } else
                {
                    $("#trackuploadstatus")[0].innerHTML = "";
                    $("#trackuploadstatus").append("<div class='failurestatus' style='margin-bottom:10px;border-radius:5px;'>The Track failed to upload please try again later.</div>");
                }
                $("#trackuploadstatus").show();
            });
}


function showalbumart(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#albumartimg')
                    .attr('src', e.target.result)
                    .width(125)
                    .height(125);
        };
        $('#albumartimg').show();
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function () {

    myPlaylist = new jPlayerPlaylist({
        jPlayer: "#jquery_jplayer_1",
        cssSelectorAncestor: "#jp_container_1"
    }, [
        {
            title: "Add songs to Play",
            mp3: "other data/Audio Files/blank.mp3"
        }
    ], {
        playlistOptions: {
            autoPlay: true,
            shuffleonloop: true,
            loopOnPrevious: false,
            shuffleOnLoop: false,
            enableRemoveControls: false,
            displayTime: 'slow',
            addTime: 'fast',
            removeTime: 'fast',
            shuffleTime: 'slow'
        },
        nativeVideoControls: {
            ipad: /ipad/,
            iphone: /iphone/,
            android: /android/,
            blackberry: /blackberry/,
            iemobile: /iemobile/
        },
        swfPath: "../../dist/jplayer",
        supplied: "webmv, ogv, m4v, oga, mp3",
        useStateClassSkin: true,
        autoBlur: false,
        smoothPlayBar: true,
        keyEnabled: true,
        audioFullScreen: false
    });
    $("#jquery_jplayer_1").jPlayer("setMedia", {mp3: "other data/Audio Files/blank.mp3", title: "Add songs to Play"}).jPlayer("play").jPlayer("stop");
    myPlaylist.play();
    $(".jp-video-play").hide();
    $("#jquery_jplayer_1").bind($.jPlayer.event.play, function (event) {
        var current = myPlaylist.current;
        var playlist = myPlaylist.playlist;
        $.each(playlist, function (index, obj) {
            if (index == current) {
                if (obj.title.replace(".mp3", "") != "Add songs to Play")
                {
                    $("#currentsong").text("Playing : " + obj.title.replace(".mp3", ""));
                    $("#bannerposter").attr("Src", obj.poster);
                } else
                {
                    $("#currentsong").text(obj.title.replace(".mp3", ""));
                    $("#bannerposter").attr("Src", obj.poster);
                }

            }
        });
    });
});

function playalbumcontent(datar, typeval)
{
    if (datar != "")
    {
        if (typeval == 0)
        {
            var cssSelector = {jPlayer: "#jquery_jplayer_1", cssSelectorAncestor: "#jp_container_1"};
            var playlist = []; // Empty playlist
            var options = {swfPath: "/js", supplied: "ogv, m4v, oga, mp3"};
            myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
            var playlistcontent = datar.split("@!#$");
            for (i = 0; i < playlistcontent.length - 1; i++)
            {
                obj = eval('({' + playlistcontent[i] + '})');
                myPlaylist.add(
                        {
                            title: obj.title,
                            mp3: obj.mp3,
                            poster: obj.poster
                        });
            }
            myPlaylist.play(0);
        } else
        {
            if (myPlaylist.playlist.length == 0)
            {
                var cssSelector = {jPlayer: "#jquery_jplayer_1", cssSelectorAncestor: "#jp_container_1"};
                var playlist = []; // Empty playlist
                var options = {swfPath: "/js", supplied: "ogv, m4v, oga, mp3"};
                myPlaylist = new jPlayerPlaylist(cssSelector, playlist, options);
                var playlistcontent = datar.split("@!#$");
                for (i = 0; i < playlistcontent.length - 1; i++)
                {
                    obj = eval('({' + playlistcontent[i] + '})');
                    myPlaylist.add(
                            {
                                title: obj.title,
                                mp3: obj.mp3,
                                poster: obj.poster
                            });
                }
                myPlaylist.play();
            } else
            {
                var playlistcontent = datar.split("@!#$");
                for (i = 0; i < playlistcontent.length - 1; i++)
                {
                    obj = eval('({' + playlistcontent[i] + '})');
                    myPlaylist.add(
                            {
                                title: obj.title,
                                mp3: obj.mp3,
                                poster: obj.poster
                            });
                }
            }

        }

    } else
    {
        alert('Something went wrong. Please try again later....');
    }
}

function playalbum(input, type)
{
    $.post("Action_Page.php?Action=Playalbum",
            {
                albumid: input,
            },
            function (data, status)
            {
                playalbumcontent(data, type)
                $.ajax("Action_Page.php?Action=viewcount&aid=" + input);
            });
}

function redirectdownloadpage(albumvalid)
{
    window.location = "Downloads_View.php?AlbumId=" + albumvalid;
}

function repeatalbum()
{
    myPlaylist.repeat(true);
}

function shufflealbum()
{
    myPlaylist.shuffle(true, true);
    myPlaylist.next();
}

function showplaylist()
{
    var displayval = "<div style='width:100%;display:inline-block;overflow-y:scroll;'>"
    for (i = 0; i < myPlaylist.playlist.length; i++)
    {
        displayval = displayval + "<div  id='" + i + "div' style='width:100%;margin-top:2%;border-bottom:solid 1px lightgray;display:inline-block;'>\n\
                                        <div style='width:70%;float:left;height:25px;overflow:hidden;'>" + myPlaylist.playlist[i].title + "</div>\n\
                                        <div style='width:10%;float:left;'>\n\
                                            <button id='playlistplay' style='height:24px;margin-bottom:10px;border:0px;background-color:#eee;color:gray' class='fa fa-play' onclick='javascript:playplaylistsong(" + i + ")'></button>\n\
                                        </div>\n\
                                        <!--<div style='width:15%;float:right'>\n\
                                            <button id='playlistremovesong' style='border:0px;border-radius:10px;outline:none;background-color:#eee;color:gray;' class='icon-cancel' onclick='javascript:removeplaylistsong(" + i + ")'></button>\n\
                                        </div>-->\n\
                                    </div>";
    }
    displayval = displayval + "</div>";
    bootbox.dialog({
        message: displayval,
        title: "<h2>Playlist</h2>"
    });
}

function playplaylistsong(songid)
{
    myPlaylist.play(songid);
}

function removeplaylistsong(songremoveid)
{
    myPlaylist.remove(songremoveid);
    $("#" + songremoveid + "div").hide();
}

function uploadselectcheck()
{
    if ($("#videotype").val() == "Others")
    {
        $("#movalb").hide();
        $("#rely").hide();
    } else if ($("#videotype").val() == "Educational")
    {
        $("#movalb").hide();
        $("#rely").hide();
    } else
    {
        $("#movalb").show();
        $("#rely").show();
    }

}

function loadmorevideos()
{
    var stmlit = $("#morevideo").attr("value");
     if(stmlit == "")
     {
        stmlit=20;
     }
     $("#morevideo").text("Loading... Please Wait..")
     $.post("Action_Page.php?Action=getmorevideos",
     {
        startlimit: stmlit
     },
     function (data, status)
     {
        if (data != "")
        {
           $(".videolist").append(data);
           $("#morevideo").text("Load More Videos");
           $("#morevideo").attr("value",Number(stmlit) + 20)
        }
        else
        {
            $("#morevideo").text("No More Videos to load.");
           //$(".videolist").append("<div class='failurestatus'>No More videos to load.</div>");
        }
     });
    /*$("#modevideo").html("Loading...");
    var val = $("#morevideo").val();
    var playlistid = val.split(',')[0];
    var nptoken = val.split(',')[1];
    getVideosFromPlaylist(playlistid, nptoken);*/
}

function popupwindow()
{
    $(".videotiles a").click(function (e) {
        e.preventDefault();
        var titleval = $(this).attr('videotitle');
        var filename = $(this).attr('sourcefile');
        var posterval = $(this).attr('poster');
        var viewcount = "";
        var rawfile = $(this).attr('sourcefile');
        $.ajaxSetup({async: false});
        $.get(
                "https://www.googleapis.com/youtube/v3/videos?part=statistics&id=" + filename + "&key=AIzaSyCoeDyYhWFn42dbUCAtDZ_LVF0z0i8pqlE",
                {},
                function (data) {
                    viewcount = data.items[0].statistics.viewCount;
                }
        );
        var inserthtml = "<div class='videoplayer'>\n\
                    <div>\n\
                        <iframe id='ytplayer' type= 'text/html' style='width:100%;height:100%;' src='https://www.youtube.com/embed/" + filename + "?rel=0&showinfo=0&iv_load_policy=3' frameborder='0' allowfullscreen></iframe>\n\
                    </div>\n\
                    <!-- <div style='float:right !important;min-width:25%;margin-top:2%;'>\n\
                        <a class='btn-sm' href='Downloads_View.php?VideoId=" + rawfile + "'>Download</a>\n\
                    </div> --> \n\
                    <div style='border-top:solid 1px lightgrey;'>\n\
                        <hr>\n\
                        <div style='float:left'>\n\
                            <p style='margin-top:10px;text-align:left;'>\n\
                                <b>No of Views : </b> <b>" + viewcount + "</b>\n\
                            </p>\n\
                        </div>\n\
                        <div id='shareitdiv' style='float:right;text-align:left;'> \n\
                            <div style='float:right;margin-left:5px'>\n\
                                <a href='https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=" + rawfile + "' onclick='window.open('https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=" + rawfile + "','name','width=600,height=400')' target='popup'><i class='fa fa-google-plus'></i></a>\n\
                            </div>\n\
                            <div style='float:right;margin-left:5px'>\n\
                                <a href='http://twitter.com/intent/tweet?status=" + titleval + "+http://www.filmboard.in/Vv.php?Vpl=" + rawfile + "' onclick='window.open('http://twitter.com/intent/tweet?status=" + titleval + "+http://www.filmboard.in/Vv.php?Vpl=" + rawfile + "','name','width=600,height=400')' target='popup'><i class='fa fa-twitter'></i></a>\n\
                            </div>\n\
                            <div style='float:right;margin-left:5px'>\n\
                                <a href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=" + rawfile + "' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=" + rawfile + "','name','width=600,height=400')' target='popup'><i class='fa fa-facebook'></i></a>\n\
                            </div>\n\
                        </div>\n\
                    </div>";

        $.ajaxSetup({async: true});
        bootbox.dialog({
            onEscape: true,
            message: inserthtml,
            title: "<h2>" + $(this).attr('videotitle') + "</h2>"
        });
    });
}

function getVideoViewCount(videoid)
{
    var viewcount = "";
    $.ajaxSetup({async: false});
    $.get(
            "https://www.googleapis.com/youtube/v3/videos?part=statistics&id=" + videoid + "&key=AIzaSyCoeDyYhWFn42dbUCAtDZ_LVF0z0i8pqlE",
            {},
            function (data) {
                viewcount = data.items[0].statistics.viewCount;
            }
    );
    var inserthtml = "  <div style='padding-left:10px;padding-right:10px;'>\n\
                            <div style='float:left;margin-top:5px;'>\n\
                                <p style='margin-top:10px;text-align:left;'>\n\
                                    <b>No of Views : </b> <b>" + viewcount + "</b>\n\
                                </p>\n\
                            </div>\n\
                            <div id='shareitdiv' style='float:right;text-align:left;margin-top:10px;'> \n\
                                <div style='float:right;margin-left:5px'>\n\
                                    <a href='https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=" + videoid + "' onclick='window.open('https://plus.google.com/share?url=http://www.filmboard.in/Vv.php?Vpl=" + videoid + "','name','width=600,height=400')' target='popup'><i class='fa fa-google-plus'></i></a>\n\
                                </div>\n\
                                <div style='float:right;margin-left:5px'>\n\
                                    <a href='http://twitter.com/intent/tweet?status=" + videoid + "+http://www.filmboard.in/Vv.php?Vpl=" + videoid + "' onclick='window.open('http://twitter.com/intent/tweet?status=" + videoid + "+http://www.filmboard.in/Vv.php?Vpl=" + videoid + "','name','width=600,height=400')' target='popup'><i class='fa fa-twitter'></i></a>\n\
                                </div>\n\
                                <div style='float:right;margin-left:5px'>\n\
                                    <a href='http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=" + videoid + "' onclick='window.open('http://www.facebook.com/sharer/sharer.php?u=http://www.filmboard.in/Vv.php?Vpl=" + videoid + "','name','width=600,height=400')' target='popup'><i class='fa fa-facebook'></i></a>\n\
                                </div>\n\
                            </div>\n\
                        </div>";
    $.ajaxSetup({async: true});
    $(".videoplayviewcount").html(inserthtml);
}

/*function getVideosFromPlaylist(playlistid, nextpagetoken)
{
    var title, videoid, bannerval;
    var htmldata = "";
    var url = "";
    if (nextpagetoken == "undefined")
    {
        url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&playlistId=' + playlistid + '&key=AIzaSyCoeDyYhWFn42dbUCAtDZ_LVF0z0i8pqlE';
    } else
    {
        url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&pageToken=' + nextpagetoken + '&playlistId=' + playlistid + '&key=AIzaSyCoeDyYhWFn42dbUCAtDZ_LVF0z0i8pqlE'
    }
    $.get(
            url,
            {},
            function (data)
            {
                var npToken = data.nextPageToken;
                $.each(data.items, function (i, item) {
                    title = item.snippet.title;
                    if (title != "Deleted video" && item.snippet.description != "This video is unavailable." && title != "Private video" && item.snippet.description != "This video is private.")
                    {
                        videoid = item.snippet.resourceId.videoId;
                        bannerval = item.snippet.thumbnails.medium.url;
                        htmldata = "<div class='videotiles'>\n\
                            <a href='javascript:popupwindow();'sourcefile='" + videoid + "' noviews='' videotitle='" + title + "' poster='" + bannerval + "'>\n\
                                    <img src='" + bannerval + "' width='100%' height='150' />\n\
                            </a>\n\
                            <div class='videotilesa'>\n\
                                    <a  href='javascript:popupwindow();' sourcefile='" + videoid + "' videotitle='" + title + "'>\n\
                                            <p style='height:40px;overflow:hidden;'>" + title + "</p>\n\
                                    </a>\n\
                            </div>\n\
                        </div>";
                        $(".videolist").append(htmldata);
                    }
                })
                if (npToken != "" && npToken != "undefined" && npToken != null)
                {
                    $("#morevideo").val(playlistid + ',' + npToken);
                    $("#morevideo").html("Load More Videos");
                } else
                {
                    $("#morevideo").html("No More Videos");
                }
            }
    );
}
*/
function loadmoreaudios()
{
    $stmlit = $("#moreaudio").val();
    $("#moreaudio").text("Loading... Please Wait..");
    $.post("Action_Page.php?Action=getmoreaudios",
            {
                startlimit: $stmlit
            },
            function (data, status)
            {
                if (data != "")
                {
                    $(".videolist").empty();
                    $(".videolist").append(data);
                    $("#moreaudio").text("Load More Audios");
                    $("#moreaudio").val(+$stmlit + 20);
                    $('head script[src*="test.js"]').remove();
                    $('head').append("<script src=test.js><//script>");
                } else
                {
                    $(".videolist").append("<div class='failurestatus'>No More Audios to load. Please try again later.</div>");
                }

            });
}

function radiofilteronchange(lang)
{
    window.location = "Radios.php?Lang=" + lang;
}

function SignupForm()
{
    var nameval = $("#name").val();
    var emailval = $("#email").val();
    var passwordval = $("#password").val();
    var repasswordval = $("#retypepass").val();
    if (nameval !== "" && emailval !== "" && passwordval !== "")
    {
        if (passwordval == repasswordval)
        {
            $("#signupresult1").append("<div style='background-color:yellow;padding-left:10px;color:black;'>The Signup is in Progress...</div>");
            $.post("Action_Page.php?Action=Signup",
                    {
                        name: nameval,
                        email: emailval,
                        password: passwordval
                    },
                    function (data, status)
                    {
                        if (data === "Success")
                        {
                            $("#signupresult1")[0].innerHTML = "";
                            $("#signupresult1").append("<div style='background-color:lightgreen;padding-left:10px;color:white;'>The Account has been successfully Created. Please Login with your credentials.</div>");
                        } else
                        {
                            $("#signupresult1")[0].innerHTML = "";
                            $("#signupresult1").append("<div style='background-color:#B94A48;padding-left:10px;color:white !important;'>Failed to create an Account in FunRaanga.in. User already Exists or Invalid details supplied.</div>");
                        }
                        $("#signupresult1").show();
                    });
        }
    }
}

function cardaction(id, typedata)
{
    $.post("Action_Page.php?Action=cardsocialaction",
            {
                postid: id,
                typeval: typedata
            },
            function (data, status)
            {
                if (data == "redirectlogin")
                {
                    var loginhtml = "<div class='col-sm-12'>\n\
                                            <form action='#' onsubmit='javascript:SignupForm();\n\
                                                    return false;' id='signupfrm' role='form'>\n\
                                                <div class='col-sm-4' id='popupsignuppanel' style='display:none;' >\n\
                                                    <div class='form-group'>\n\
                                                        <label for='name'>Name</label>\n\
                                                        <input type='text' class='form-control' name='name' id='name' placeholder='Enter name'  title='Please enter your name (at least 2 characters)'/>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='email'>Email</label>\n\
                                                        <input type='email' class='form-control' name='email' id='email' placeholder='Enter email' title='Please enter a valid email address'/>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='password'>Password</label>\n\
                                                        <input name='password' class='form-control' type='password' id='password' size='30' value='' placeholder='Enter the Password' title='Please enter a valid Password(at least 8 characters)'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='retypepass'>Retype Password</label>\n\
                                                        <input name='retypepass' class='form-control' type='password' id='retypepass' size='30' value='' placeholder='Retype the Password' title='Please retype the Password.'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <div style='float: right;'><a href='javascript:popuppanelswitch();' > Go to Login Page</a></div>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <div id='signupresult1'>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <button name='submit' type='submit' class='btn-sm' id='submit' style='padding: 0px !important'>\n\
                                                        Signup\n\
                                                    </button>\n\
                                                </div>\n\
                                            </form>\n\
                                        </div>\n\
                                        <div class='clearfix'></div>\n\
                                        <div class='col-sm-12' id='popuploginpageform'>\n\
                                            <form method='post' onSubmit='javascript:popUpLoginForm(" + id + "," + typedata + ");\n\
                                                    return false;' id='loginfrm' role='form'>\n\
                                                <div id='popuploginpanel'>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='username'>Email Address</label>\n\
                                                        <input name='username' class='form-control' type='text' id='username' size='30' value='' placeholder='Enter your Email Address' title='Please enter your Email Address'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='password'>Password</label>\n\
                                                        <input name='password' class='form-control' type='password' id='password' size='30' value='' placeholder='Enter the Password' title='Please enter your Password.'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <div style='float: left;'><a href='Password_Recovery.php' > Forgot Password</a></div>\n\
                                                        <div style='float: right;'><a href='javascript:popuppanelswitch();' > SignUp a New Account</a></div>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <div class='loginresult'>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <div class='loginbutton'>\n\
                                                        <button name='submit' type='submit' class='btn-sm' id='submit' style='padding: 0px !important;'>\n\
                                                            Login\n\
                                                        </button>\n\
                                                    </div>\n\
                                                    <div class='loginloading' style='color:#FF5511;display:none;'>\n\
                                                        <div class='fa fa-spinner fa-3x fa-spin' ></div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </form>\n\
                                        </div>";
                    popupdialog = bootbox.dialog({
                        onEscape: true,
                        message: "<div class='videoplayer'>" + loginhtml + "</div>",
                        title: "<h2>Login/SignUp</h2>"
                    });

                } 
                else if (data != "Failure")
                {
                    var statc = data.split("-");
                    
                    if(typedata == '1')
                    {
                        var classname=$("#i_like_" + id).attr("class");
                        if(classname == "fa fa-thumbs-o-up")
                        {
                            $("#i_like_" + id).attr("class", "fa fa-thumbs-up");
                            $("#i_unlike_" + id).attr("class", "fa fa-thumbs-o-down");
                            $("#i_report_" + id).attr("class", "fa fa-flag-o");
                        }
                        else
                        {
                            $("#i_like_" + id).attr("class", "fa fa-thumbs-o-up");
                        }
                    }
                    else if(typedata == '2')
                    {
                        var classname=$("#i_unlike_" + id).attr("class");
                        if(classname == "fa fa-thumbs-o-down")
                        {
                            $("#i_unlike_" + id).attr("class", "fa fa-thumbs-down");
                            $("#i_like_" + id).attr("class", "fa fa-thumbs-o-up");
                            $("#i_report_" + id).attr("class", "fa fa-flag-o");
                        }
                        else
                        {
                            $("#i_unlike_" + id).attr("class", "fa fa-thumbs-o-down");
                        }
                    }
                    else if(typedata == '4')
                    {
                        var classname=$("#i_report_" + id).attr("class");
                        if(classname == "fa fa-flag-o")
                        {
                            $("#i_report_" + id).attr("class", "fa fa-flag");
                            $("#i_unlike_" + id).attr("class", "fa fa-thumbs-o-down");
                            $("#i_like_" + id).attr("class", "fa fa-thumbs-o-up");
                        }
                        else
                        {
                            $("#i_report_" + id).attr("class", "fa fa-flag-o");
                        }
                    }
                    $("#span_like_" + id).text(statc[0]);
                    $("#span_unlike_" + id).text(statc[1]);
                    $("#span_share_" + id).text(statc[2]);
                    $("#span_report_" + id).text(statc[3]);
                }
            }
    );
}

function moviesocialaction(id, typedata)
{
    $.post("Action_Page.php?Action=moviesocialaction",
            {
                itemid: id,
                typeval: typedata
            },
            function (data, status)
            {
                if (data == "redirectlogin")
                {
                    var loginhtml = "<div class='col-sm-12'>\n\
                                            <form action='#' onsubmit='javascript:SignupForm();\n\
                                                    return false;' id='signupfrm' role='form'>\n\
                                                <div class='col-sm-4' id='popupsignuppanel' style='display:none;' >\n\
                                                    <div class='form-group'>\n\
                                                        <label for='name'>Name</label>\n\
                                                        <input type='text' class='form-control' name='name' id='name' placeholder='Enter name'  title='Please enter your name (at least 2 characters)'/>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='email'>Email</label>\n\
                                                        <input type='email' class='form-control' name='email' id='email' placeholder='Enter email' title='Please enter a valid email address'/>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='password'>Password</label>\n\
                                                        <input name='password' class='form-control' type='password' id='password' size='30' value='' placeholder='Enter the Password' title='Please enter a valid Password(at least 8 characters)'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='retypepass'>Retype Password</label>\n\
                                                        <input name='retypepass' class='form-control' type='password' id='retypepass' size='30' value='' placeholder='Retype the Password' title='Please retype the Password.'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <div style='float: right;'><a href='javascript:popuppanelswitch();' > Go to Login Page</a></div>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <div id='signupresult1'>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <button name='submit' type='submit' class='btn-sm' id='submit' style='padding: 0px !important'>\n\
                                                        Signup\n\
                                                    </button>\n\
                                                </div>\n\
                                            </form>\n\
                                        </div>\n\
                                        <div class='clearfix'></div>\n\
                                        <div class='col-sm-12' id='popuploginpageform'>\n\
                                            <form method='post' onSubmit='javascript:popUpLoginForm(" + id + "," + typedata + ");\n\
                                                    return false;' id='loginfrm' role='form'>\n\
                                                <div id='popuploginpanel'>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='username'>Email Address</label>\n\
                                                        <input name='username' class='form-control' type='text' id='username' size='30' value='' placeholder='Enter your Email Address' title='Please enter your Email Address'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='password'>Password</label>\n\
                                                        <input name='password' class='form-control' type='password' id='password' size='30' value='' placeholder='Enter the Password' title='Please enter your Password.'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <div style='float: left;'><a href='Password_Recovery.php' > Forgot Password</a></div>\n\
                                                        <div style='float: right;'><a href='javascript:popuppanelswitch();' > SignUp a New Account</a></div>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <div class='loginresult'>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <div class='loginbutton'>\n\
                                                        <button name='submit' type='submit' class='btn-sm' id='submit' style='padding: 0px !important;'>\n\
                                                            Login\n\
                                                        </button>\n\
                                                    </div>\n\
                                                    <div class='loginloading' style='color:#FF5511;display:none;'>\n\
                                                        <div class='fa fa-spinner fa-3x fa-spin' ></div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </form>\n\
                                        </div>";
                    popupdialog = bootbox.dialog({
                        onEscape: true,
                        message: "<div class='videoplayer'>" + loginhtml + "</div>",
                        title: "<h2>Login/SignUp</h2>"
                    });

                } 
                
                else if (data != "Failure")
                {
                    var statc = data.split("-");
                    
                    if(typedata == '1')
                    {
                        var classname=$("#i_like").attr("class");
                        if(classname == "fa fa-thumbs-o-up")
                        {
                            $("#i_like").attr("class", "fa fa-thumbs-up");
                            $("#i_unlike").attr("class", "fa fa-thumbs-o-down");
                        }
                        else
                        {
                            $("#i_like").attr("class", "fa fa-thumbs-o-up");
                        }
                    }
                    else if(typedata == '2')
                    {
                        var classname=$("#i_unlike").attr("class");
                        if(classname == "fa fa-thumbs-o-down")
                        {
                            $("#i_unlike").attr("class", "fa fa-thumbs-down");
                            $("#i_like").attr("class", "fa fa-thumbs-o-up");
                        }
                        else
                        {
                            $("#i_unlike").attr("class", "fa fa-thumbs-o-down");
                        }
                    }
                    $("#span_like").text(statc[0]);
                    $("#span_unlike").text(statc[1]);
                }
            }
    );
}


function postcardplayerswitch(id)
{
    $("#linkpreviewimg_" + id).hide();
    $("#linkpreviewplayer_" + id).css("display", "Block");
}

function Sharepost(id)
{
    $.post("Action_Page.php?Action=viewpost",
            {
                postid: id,
                typev: 3
            },
            function (data, status)
            {
                $.post("Action_Page.php?Action=cardaction",
                        {
                            postid: id,
                            typeval: 3
                        },
                        function (data, status)
                        {
                            if (data == "Success")
                            {
                                var shareval = $("#span_share_" + id).text();
                                shareval = Number(shareval) + 1;
                                $("#span_share_" + id).text(shareval);
                            }
                        });
                var dialog = bootbox.dialog({
                    onEscape: true,
                    message: data,
                    closeButton: true
                });
            });
}

function LoginForm()
{
    var username = $("#username").val();
    var password = $("#password", $("#loginfrm")).val();
    ;
    if (username != "" && password != "")
    {
        $(".loginbutton").hide();
        $(".loginloading").show();
        $.post("Action_Page.php?Action=login",
                {
                    username: username,
                    password: password
                },
                function (data, status)
                {
                    if (data != "Failure")
                    {
                        location.href = data;
                    } else
                    {
                        $(".loginresult")[0].innerHTML = "";
                        $(".loginresult").append("<div style='background-color:#B94A48;padding:10px;color:white !important;margin:5px; border-radius:5px'>Failed to Login FunRaanga.in. Invalid Login Information supplied.</div>");
                        $(".loginbutton").show();
                        $(".loginloading").hide();
                    }
                });
    }
}

function popUpLoginForm(id, typedata)
{
    var username = $("#username").val();
    var password = $("#password", $("#loginfrm")).val();
    ;
    if (username != "" && password != "")
    {
        $(".loginbutton").hide();
        $(".loginloading").show();
        $.post("Action_Page.php?Action=login",
                {
                    username: username,
                    password: password
                },
                function (data, status)
                {
                    if (data != "Failure")
                    {
                        popupdialog.modal('hide');
                        if(id != null && id != "undefined" && id != "")
                        {
                            cardaction(id, typedata);
                        }
                        else
                        {
                            location.href=data;
                        }
                    } 
                    else
                    {
                        $(".loginresult")[0].innerHTML = "";
                        $(".loginresult").append("<div style='background-color:#B94A48;padding:10px;color:white !important;margin:5px; border-radius:5px'>Failed to Login FunRaanga.in. Invalid Login Information supplied.</div>");
                        $(".loginbutton").show();
                        $(".loginloading").hide();
                    }
                });
    }
}

function panelswitch()
{
    if ($("#signuppanel").is(":visible") == false)
    {
        $("#signuppanel").show();
        $("#loginpanel").hide();
    } else
    {
        $("#signuppanel").hide();
        $("#loginpanel").show();
    }
}

function popuppanelswitch()
{
    if ($("#popupsignuppanel").is(":visible") == false)
    {
        $("#popupsignuppanel").show();
        $("#popuploginpageform").hide();
    } else
    {
        $("#popupsignuppanel").hide();
        $("#popuploginpageform").show();
    }
}

$(document).ready(function () {
    $("#signuppanel").hide();
    $(".loginloading").hide();
    $("#uploadvideothumbnail").hide();
});

function videothumnailselection()
{
    $("#uploadvideothumbnail").show();
    $("#videouploaddetails").hide();
}

function showimagepanel()
{
    if ($("#photoupload").css("display") == "block")
    {
        $("#photoupload").hide();
    } else
    {
        $("#videouploaddiv").hide();
        $("#photoupload").show(function ()
        {
            $(this).animate({
                display: 'visible'
            }, 500, function ()
            {
            });
        });
    }

}

function showvideopanel()
{
    $("#photoupload").hide();
    $("#videouploaddiv").show(function ()
    {
        $(this).animate({
            display: 'visible'
        }, 500, function ()
        {
        });
    });

}

$(document).ready(function () {
    $("#photoupload").hide();
    $("#videouploaddiv").hide();
    $("textarea").hashtags();
    $("#linkpreview").hide();
    $(".linkpreviewloading").hide();
    $("#my-panel").hide();
    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;

    $('#slider').css({width: slideWidth, height: slideHeight});

    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: +slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    }
    ;

    function moveRight() {
        $('#slider ul').animate({
            left: -slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    }
    ;

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });
});

function loadpostcontentdata()
{
    var urlv = $("#linkpreviewurl").attr("href");
    var urlimg = $("#linkpreviewimg").attr("src");
    var urltitle = $("#linkpreviewtitle").text();
    var urldesc = $("#linkpreviewdesc").text();
    var urlsite = $("#linkpreviewsite").text();
    var postc = $("#postboxtext").val();
    $.post("Action_Page.php?Action=PostCard",
            {
                postcontent: postc,
                previewurl: urlv,
                previewurlimg: urlimg,
                previewurltitle: urltitle,
                previewurldesc: urldesc,
                previewurlsite: urlsite
            },
            function (data, status)
            {
                var timeout = 1500;
                var dialog = bootbox.dialog({
                    message: '<p class="text-center">' + data + '</p>',
                    closeButton: false
                });
                setTimeout(function () {
                    dialog.modal('hide');
                }, timeout);
                if (data === "Successfully posted the Card.")
                {
                    $("#linkpreviewurl").attr("href", "");
                    $("#linkpreviewimg").attr("src", "");
                    $("#linkpreviewtitle").text("");
                    $("#linkpreviewdesc").text("");
                    $("#linkpreviewsite").text("");
                    $("#postboxtext").val(" ");
                    $(".hashtag").hide();
                    $("#linkpreview").hide();
                }
            });
}

$(function () {
    "use strict";
    var url = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;

    $("#postboxtext").on("keyup", function (e) {
        var urls, output = "";
        var regexToken = /((ftp|https?:\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})/g;
        if (e.keyCode !== 8 && e.keyCode !== 9 && e.keyCode !== 13 && e.keyCode !== 32 && e.keyCode !== 46) {
            // Return is backspace, tab, enter, space or delete was not pressed.
            return;
        }

        while ((urls = regexToken.exec(this.value)) !== null) {
            output += urls[0] + ", ";
            if ($("#linkpreviewurl").attr("href") != urls[0])
            {
                $("#linkpreview").hide();
                $(".linkpreviewloading").show();
            }
            $.post("MetaTagLoader.php",
                    {
                        urlval: urls[0]
                    },
                    function (data, status)
                    {
                        if (data != null)
                        {
                            var returnobj = JSON.parse(data);
                            if (returnobj.og_title != null)
                            {
                                $("#linkpreviewtitle").text($.parseHTML(returnobj.og_title)[0].textContent);
                                $("#linkpreviewdesc").text($.parseHTML(returnobj.og_description)[0].textContent);
                                $("#linkpreviewsite").text(returnobj.og_site_name);
                                $("#linkpreviewimg").attr("src", returnobj.og_image);
                                $("#linkpreviewurl").attr("href", returnobj.og_url);
                                $("#linkpreview").show();
                                $(".linkpreviewloading").hide();
                            } else if (returnobj.twitter_title != null)
                            {
                                $("#linkpreviewtitle").text($.parseHTML(returnobj.twitter_title)[0].textContent);
                                $("#linkpreviewdesc").text($.parseHTML(returnobj.twitter_description)[0].textContent);
                                $("#linkpreviewsite").text(returnobj.twitter_site);
                                $("#linkpreviewimg").attr("src", returnobj.twitter_image);
                                $("#linkpreviewurl").attr("href", returnobj.twitter_url);
                                $("#linkpreview").show();
                                $(".linkpreviewloading").hide();
                            }
                        } else
                        {
                            $("#linkpreview").hide();
                            $(".linkpreviewloading").hide();
                        }
                    });
        }
        //console.log("URLS: " + output.substring(0, output.length - 2));
    });
});

function Scrapwebaddress(id, urlval)
{
    var titleurl;
    var titlename;
    var generetype;
    $("#btn_" + id).hide();
    $("#spinner" + id).show();
    if (urlval == '')
    {
        urlval = $("#Webaddress").val();
    }
    $.post("ScrapPageHtml.php",
            {
                url: urlval
            },
            function (data, status) {
                $("#pagedisplay").html("");
                $("#pagedisplay").html(data);
                if ($(".scraptype:checked").val() == "moviesdb")
                {
                    var maintable = $("#pagedisplay").find(".wikitable");
                    for (var i = 0; i < maintable.length; i++)
                    {
                        var tempobj = maintable[i];
                        $(tempobj).find("thead tr th:nth-child(1)").remove();
                        var trtempobj = $(tempobj).find("tbody tr");
                        for (var j = 0; j < trtempobj.length; j++)
                        {
                            if ($(trtempobj[j]).find("td").length == 8)
                            {
                                $(trtempobj[j]).find("td:nth-child(1),td:nth-child(2)").remove();
                            } else if ($(trtempobj[j]).find("td").length == 7)
                            {
                                $(trtempobj[j]).find("td:nth-child(1)").remove();
                            }
                            titleurl = $(trtempobj[j]).find("td:nth-child(1) a").attr("href");
                            titlename = $(trtempobj[j]).find("td:nth-child(1) a").text();
                            generetype = $(trtempobj[j]).find("td:nth-child(4)").text();
                            if (titlename.length > 0)
                            {
                                $.post("Action_Page.php?Action=MoviesDB",
                                        {
                                            titleval: titlename,
                                            titleurlpath: titleurl,
                                            genere: generetype
                                        },
                                        function (data, status) {

                                        });
                            }
                        }
                    }
                } else if ($(".scraptype:checked").val() == "movie")
                {
                    ScrapwebMovie(id, urlval);
                } else
                {

                }

            });
}

function ScrapwebMovie(id, urlval)
{
    if (id != '')
    {
        $("#btn_" + id).hide();
        $("#spinner_" + id).show();
    }
    if (urlval == '')
    {
        urlval = $("#Webaddress").val();
    }
    $.post("ScrapPageHtml.php",
            {
                url: urlval
            },
            function (data, status) {
                $("#pagedisplay").html("");
                $("#pagedisplay").html(data);
                var Moviename = "";
                var Moviebanner = "";
                var Moviedesc = "";
                var Starring = "";
                var Director = "";
                var Producer = "";
                var Writter = "";
                var Story = "";
                var Screenplay = "";
                var MusicDirector = "";
                var Cinematographer = "";
                var Editor = "";
                var ProductionCompany = "";
                var DistributionCompany = "";
                var MovieDuration = "";
                var ReleaseDate = "";
                var Language = "";
                var Budget = "";
                var BoxOfficeCollection = "";
                Moviename = $("#firstHeading").text().replace("(film)", "").replace(/'/g, '').replace(/"/g, '').replace(/\[.*?\]/g, '').trim();
                Moviedesc = $($("#mw-content-text p")[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\[.*?\]/g, '').trim();
                var infotable = $(".infobox")[0];
                var trinfotable = $(infotable).find("tr");
                var tracklisttable = $(".tracklist").find("tbody tr");
                for (var i = 0; i < trinfotable.length; i++)
                {
                    var thinfotable = $(trinfotable[i]).find("th");
                    var tdinfotable = $(trinfotable[i]).find("td");
                    if (tdinfotable.length == 1 && (i == 0 || i == 1))
                    {
                        var srcpath = $(tdinfotable).find("a img").attr("src");
                        if (typeof srcpath === 'undefined')
                        {
                            var headertilte = $(thinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                            if (headertilte.toLowerCase() == "directed by")
                            {
                                Director = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "produced by")
                            {
                                Producer = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "written by")
                            {
                                Writter = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "screenplay by")
                            {
                                Screenplay = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "story by")
                            {
                                Story = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "starring")
                            {
                                Starring = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "music by")
                            {
                                MusicDirector = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "cinematography")
                            {
                                Cinematographer = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "edited by")
                            {
                                Editor = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase().search("company") >= 0)
                            {
                                ProductionCompany = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "distributed by")
                            {
                                DistributionCompany = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "release dates" || headertilte.toLowerCase() == "release date")
                            {
                                ReleaseDate = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "running time" || headertilte.toLowerCase() == "duration")
                            {
                                MovieDuration = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "language")
                            {
                                Language = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "budget")
                            {
                                Budget = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                            } else if (headertilte.toLowerCase() == "box office")
                            {
                                BoxOfficeCollection = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                            }
                        } else
                        {
                            Moviebanner = "https:" + $(tdinfotable).find("a img").attr("src");
                        }

                    } else
                    {
                        var headertilte = $(thinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                        if (headertilte.toLowerCase() == "directed by")
                        {
                            Director = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "produced by")
                        {
                            Producer = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "written by")
                        {
                            Writter = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "screenplay by")
                        {
                            Screenplay = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "story by")
                        {
                            Story = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "starring")
                        {
                            Starring = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "music by")
                        {
                            MusicDirector = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "cinematography")
                        {
                            Cinematographer = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "edited by")
                        {
                            Editor = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase().search("company") >= 0)
                        {
                            ProductionCompany = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "distributed by")
                        {
                            DistributionCompany = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, ', ').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "release dates" || headertilte.toLowerCase() == "release date")
                        {
                            ReleaseDate = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "running time" || headertilte.toLowerCase() == "duration")
                        {
                            MovieDuration = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "language")
                        {
                            Language = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "budget")
                        {
                            Budget = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                        } else if (headertilte.toLowerCase() == "box office")
                        {
                            BoxOfficeCollection = $(tdinfotable[0]).text().replace(/'/g, '').replace(/"/g, '').replace(/\r?\n/g, '').replace(/\[.*?\]/g, '').trim();
                        }
                    }
                }
                var tracktable = "<table class='tracklisttable'>";
                for (var j = 0; j < tracklisttable.length; j++)
                {
                    var tdtracklisttable = $(tracklisttable[j]).find("td");
                    if (tdtracklisttable.length > 2)
                    {
                        tracktable = tracktable + "<tr>";
                        for (var k = 0; k < tdtracklisttable.length; k++)
                        {
                            tracktable = tracktable + "<td>" + $(tdtracklisttable[k]).text().trim() + "</td>";
                        }
                        tracktable = tracktable + "</tr>"
                    }
                }
                tracktable = tracktable + "</table>";
                tracktable = tracktable.replace(/'/g, '');
                tracktable = tracktable.replace(/"/g, '');
                if (Moviename.length > 0)
                {
                    $.post("Action_Page.php?Action=Movie",
                            {
                                idmovieval:id,
                                moviename: Moviename,
                                moviedesc: Moviedesc,
                                moviebanner: Moviebanner,
                                director: Director,
                                producer: Producer,
                                writter: Writter,
                                screenplay: Screenplay,
                                story: Story,
                                starring: Starring,
                                musicdirector: MusicDirector,
                                cinematographer: Cinematographer,
                                editor: Editor,
                                productioncompany: ProductionCompany,
                                distributioncompany: DistributionCompany,
                                releasedate: ReleaseDate,
                                movieduration: MovieDuration,
                                language: Language,
                                budget: Budget,
                                boxofficecollection: BoxOfficeCollection,
                                tracktable: tracktable
                            },
                            function (data, status) {
                                if (data.replace(/\r?\n/g, '') == "1" && id != '')
                                {
                                    $.post("Action_Page.php?Action=updatemovieparsed",
                                            {
                                                idval: id
                                            },
                                            function (data, status)
                                            {
                                                if (data >= 1)
                                                {
                                                    $("#scrappanelid_" + id).remove();
                                                }

                                            });
                                }
                            });
                }

            });
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profileimage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);

    }
}

$("#imgInp").change(function () {
    readURL(this);
});

function updateprofileinfo()
{
    $("#profilestatus").html("");
    var nameval = $("#name").val();
    var emailval = $("#email").val();
    var phonenoval = $("#mobileno").val();
    var genderval = $("#gender").val();
    var birthdateval = $("#birthdate").val();
    var languageval = $("#language").val();
    var image_data = $("#profileimage").attr("src");
    if (nameval !== "" && emailval !== "" && phonenoval !== "" && genderval !== "" && birthdateval !== "" && languageval !== "")
    {
        $.post("Action_Page.php?Action=profileinfo",
                {
                    name: nameval,
                    email: emailval,
                    birthdate: birthdateval,
                    gender: genderval,
                    phoneno: phonenoval,
                    language: languageval,
                    imagedata: image_data
                },
                function (data, status)
                {
                    if (data == "Success")
                    {
                        $("#profilestatus").html("<div class='successstatus'>The Profile Information has been Updated Successfully.</div>");
                    } else
                    {
                        $("#profilestatus").html("<div class='failurestatus'>Failed to update the Profile Information. Please try again later.</div>");
                    }
                    $("#profilestatus").show();
                }
        );
    }
}

function insertmoviereview()
{
    var urls, output = "";
    var reviewdata=$("#postcomment").val();
    var regexToken = /((ftp|https?:\/\/)[\-\w@:%_\+.~#?,&\/\/=]+)|((mailto:)?[_.\w-]+@([\w][\w\-]+\.)+[a-zA-Z]{2,3})/g;
    while ((urls = regexToken.exec(reviewdata)) !== null)
    {
        output += urls[0];
    }
    var reviewurl=output;
    
    $.post("Action_Page.php?Action=updatemoviereview",
                            {
                                revdesc:reviewdata,
                                revurl:reviewurl
                            },
                            function (data, status)
                            {
                                if (data == "Success")
                                {
                                    var timeout = 1500;
                                    var dialog = bootbox.dialog({
                                                    message: '<p class="text-center">Movie Review Posted Successfully.</p>',
                                                    closeButton: false
                                                });
                                    setTimeout(function () {
                                        dialog.modal('hide');
                                    }, timeout);
                                   $("#postcomment").val(""); 
                                   $.post("Action_Page.php?Action=getmoviereviews",
                                   {},
                                   function(data,status)
                                   {
                                        $("#moviereviews").html("");
                                        $("#moviereviews").html(data);
                                   });
                                }
                                else
                                {
                                    var timeout = 1500;
                                    var dialog = bootbox.dialog({
                                                    message: '<p class="text-center">Failed to Post Movie Review.Please try again. </p>',
                                                    closeButton: false
                                                });
                                    setTimeout(function () {
                                        dialog.modal('hide');
                                    }, timeout);
                                }
                            }
                    );
}

function popuploginhtml()
{
    var popuploginhtmldata = "<div class='col-sm-12'>\n\
                                            <form action='#' onsubmit='javascript:SignupForm();\n\
                                                    return false;' id='signupfrm' role='form'>\n\
                                                <div class='col-sm-4' id='popupsignuppanel' style='display:none;' >\n\
                                                    <div class='form-group'>\n\
                                                        <label for='name'>Name</label>\n\
                                                        <input type='text' class='form-control' name='name' id='name' placeholder='Enter name'  title='Please enter your name (at least 2 characters)'/>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='email'>Email</label>\n\
                                                        <input type='email' class='form-control' name='email' id='email' placeholder='Enter email' title='Please enter a valid email address'/>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='password'>Password</label>\n\
                                                        <input name='password' class='form-control' type='password' id='password' size='30' value='' placeholder='Enter the Password' title='Please enter a valid Password(at least 8 characters)'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='retypepass'>Retype Password</label>\n\
                                                        <input name='retypepass' class='form-control' type='password' id='retypepass' size='30' value='' placeholder='Retype the Password' title='Please retype the Password.'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <div style='float: right;'><a href='javascript:popuppanelswitch();' > Go to Login Page</a></div>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <div id='signupresult1'>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <button name='submit' type='submit' class='btn-sm' id='submit' style='padding: 0px !important'>\n\
                                                        Signup\n\
                                                    </button>\n\
                                                </div>\n\
                                            </form>\n\
                                        </div>\n\
                                        <div class='clearfix'></div>\n\
                                        <div class='col-sm-12' id='popuploginpageform'>\n\
                                            <form method='post' onSubmit='javascript:popUpLoginForm(&quot;&quot;,&quot;&quot;);\n\
                                                    return false;' id='loginfrm' role='form'>\n\
                                                <div id='popuploginpanel'>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='username'>Email Address</label>\n\
                                                        <input name='username' class='form-control' type='text' id='username' size='30' value='' placeholder='Enter your Email Address' title='Please enter your Email Address'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <label for='password'>Password</label>\n\
                                                        <input name='password' class='form-control' type='password' id='password' size='30' value='' placeholder='Enter the Password' title='Please enter your Password.'>\n\
                                                    </div>\n\
                                                    <div class='form-group'>\n\
                                                        <div style='float: left;'><a href='Password_Recovery.php' > Forgot Password</a></div>\n\
                                                        <div style='float: right;'><a href='javascript:popuppanelswitch();' > SignUp a New Account</a></div>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <div class='loginresult'>\n\
                                                    </div>\n\
                                                    <br />\n\
                                                    <div class='loginbutton'>\n\
                                                        <button name='submit' type='submit' class='btn-sm' id='submit' style='padding: 0px !important;'>\n\
                                                            Login\n\
                                                        </button>\n\
                                                    </div>\n\
                                                    <div class='loginloading' style='color:#FF5511;display:none;'>\n\
                                                        <div class='fa fa-spinner fa-3x fa-spin' ></div>\n\
                                                    </div>\n\
                                                </div>\n\
                                            </form>\n\
                                        </div>";
    return popuploginhtmldata;
}

function popuploginwindow()
{
    var popuphtml = popuploginhtml();
    popupdialog = bootbox.dialog({
                        onEscape: true,
                        message: "<div class='videoplayer'>" + popuphtml + "</div>",
                        title: "<h2>Login/SignUp</h2>"
                    });
}

function searchmovies()
{
    var movname=$("#moviename").val();
    if(movname != "")
    {
        $.post("Action_Page.php?Action=searchmovie",
        {
            movieval:movname
        },
        function(data,status){
           $("#moviesearchresults").html("<h2>Search results for "+movname+"</h2>");
           $("#moviesearchresults").append(data);
        });
    }
}