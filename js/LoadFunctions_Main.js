
$(document).ready(function () {
    $(".radiocontent input[type='button']").click(function () {
        var urlid = $(this).attr('id');
        var urlpath = $("#" + urlid).attr("urlpath");
        window.fmname = $("#" + urlid).attr("fmname");
        var audioelement = $("#radioplayer");
        audioelement[0].src = urlpath + ";stream.mp3";
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
        }
        else
        {
            status_o.text("");
        }
    };
    $("#radioplayer").on("loadstart", radiostatus_fn);
    $("#radioplayer").on("playing", radiostatus_fn);
});
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
            displayMessage("Your browser is not " +
                    "<a href='http://caniuse.com/bloburls'>supported</a>!", true);

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

function _(el) {
    return document.getElementById(el);
}
function postdata()
{

    if ($('#license').is(":checked") == false)
    {
        alert("Please Accept the License Aggrement");
    }
    else
    {
        bootbox.dialog({title: "File Upload Status", message: '<div style="text-align:center">' +
                    '<progress id="progressBar" value="0" max="100" style="width:300px;">' +
                    '</progress>' +
                    '<h3 id="status1"></h3>' +
                    '<p id="loaded_n_total">' +
                    '</div>'});
        var videoname = $('#videoname').val();
        var MovieAlbumName = $('#moviealbumname').val();
        var starcast = $('#starcast').val();
        var Vidtyp = $('#videotype').val();
        var releaseyear = $('#releaseyear').val();
        var agerestric = $('#agerestrict').val();
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

function searchvideo()
{
    var searchtxt = document.getElementById("searchvidtext");
    window.location = "Videos.php?search=" + searchtxt.value;
}
function updateprofileinfo()
{
    var nameval = $("#name").val();
    var emailval = $("#email").val();
    var phonenoval = $("#mobileno").val();
    var genderval = $("#gender").val();
    var birthdateval = $("#birthdate").val();
    var languageval = $("#language").val();
    if (nameval !== "" && emailval !== "" && phonenoval !== "" && genderval !== "" && birthdateval !== "" && languageval !== "")
    {
        $.post("Action_Page.php?Action=profileinfo",
                {
                    name: nameval,
                    email: emailval,
                    birthdate: birthdateval,
                    gender: genderval,
                    phoneno: phonenoval,
                    language: languageval
                },
        function (data, status)
        {
            if (data == "Success")
            {
                $("#profilestatus").append("<div class='successstatus'>The Profile Information has been Updated Successfully.</div>");
            }
            else
            {
                $("#profilestatus").append("<div class='failurestatus'>Failed to update the Profile Information. Please try again later.</div>");
            }
            $("#profilestatus").show();
        }
        );
    }
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
            }
            else
            {
                $("#Contactusstatus")[0].innerHTML = "";
                $("#Contactusstatus").append("<div class='failurestatus'>Failed to submit the Request to the FunRaaga Team. Please try again later.</div>");
            }
            $("#Contactusstatus").show();
        });
    }
}
function uploadselectcheck()
{
    if ($("#videotype").val() == "Others")
    {
        $("#movalb").hide();
        $("#rely").hide();
    }
    else if ($("#videotype").val() == "Educational")
    {
        $("#movalb").hide();
        $("#rely").hide();
    }
    else
    {
        $("#movalb").show();
        $("#rely").show();
    }

}
function loadmorevideos()
{
    $stmlit = $("#morevideo").val();
    $("#morevideo").text("Loading... Please Wait..")
    $.post("Action_Page.php?Action=getmorevideos",
            {
                startlimit: $stmlit
            },
    function (data, status)
    {
        if (data != "")
        {
            $(".videolist").empty();
            $(".videolist").append(data);
            $("#morevideo").text("Load More Videos");
            $("#morevideo").val(+$stmlit + 20);
            $('head script[src*="test.js"]').remove();
            $('head').append("<script src=test.js><//script>");
        }
        else
        {
            $(".videolist").append("<div class='failurestatus'>No More videos to load. Please try again later.</div>");
        }

    });
}
function loadmoreaudios()
{
    $stmlit = $("#moreaudio").val();
    $("#moreaudio").text("Loading... Please Wait..")
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
        }
        else
        {
            $(".videolist").append("<div class='failurestatus'>No More Audios to load. Please try again later.</div>");
        }

    });
}
