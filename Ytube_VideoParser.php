<?php

if (session_id() == '') {
    session_start();
}
$_SESSION["pagecategory"] = "Account";
include 'Master_Page_Sub.php';
?>
<script>
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
        $.ajaxSetup({async: true});
        return viewcount;
    }
    
    function getVideoInfo(videoid)
    {
        var returndata=[];
        $.ajaxSetup({async: false});
        $.get(
                "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" + videoid + "&key=AIzaSyCoeDyYhWFn42dbUCAtDZ_LVF0z0i8pqlE",
                {},
                function (data) {
                    returndata[0] = data.items[0].snippet.publishedAt;
                    returndata[1] = data.items[0].snippet.tags.toString();
                }
        );
        $.ajaxSetup({async: true});
        return returndata;
    }

    function getVideosFromPlaylist(playlistid, nextpagetoken,videotype)
    {
        var title, videoid, bannerval, uploaddate, noviews, description,tags;
        var url = "";
        var npToken = "";
        $.ajaxSetup({async :false});
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
                    npToken = data.nextPageToken;
                    $.ajaxSetup({async: false});
                    $.each(data.items, function (i, item) {
                        if (item.snippet.title != "Deleted video" && item.snippet.description != "This video is unavailable." && title != "Private video" && item.snippet.description != "This video is private.")
                        {
                            videoid = item.snippet.resourceId.videoId;
                            title = item.snippet.title;
                            bannerval = item.snippet.thumbnails.medium.url;
                            var returndata=getVideoInfo(videoid)
                            uploaddate = returndata[0];
                            description = item.snippet.description;
                            noviews = getVideoViewCount(videoid);
                            tags=returndata[1];
                            $.post(
                                    "Action_Page.php?Action=updateplaylist",
                                    {
                                        videoid:videoid,
                                        videotitle:title,
                                        videodesc: description,
                                        videoposter:bannerval,
                                        videotype:videotype,
                                        videotags:tags,
                                        uploaddat: uploaddate,
                                        viewcount: noviews
                                    },
                                    function(data1){
                                        if(data1 == "Success")
                                        {
                                            var vidcount=$("#totalval").val();
                                            $("#totalval").val(Number(vidcount)+1);
                                        }
                                        
                                    });
                        }
                    })
                    
                    if (npToken != "" && npToken != "undefined" && npToken != null)
                    {
                        getVideosFromPlaylist(playlistid, npToken,videotype);
                    }
                    else
                    {
                        $("#loadstatus").hide();
                    }
                }
        );
    }
    function intiategetVideosFromPlaylist(playlistid, nextpagetoken,videotype)
    {
        $("#totalval").val("0");
        $("#loadstatus").show();
        getVideosFromPlaylist(playlistid, nextpagetoken,videotype);
        
    }
    
    function truncatevideos()
    {
        $.post("Action_Page.php?Action=truncatevideos",{},function(data){});
    }
    
</script>
<div><h2>Video playlists:</h2><br /><br />
    <div id='parsestatus'> No Of Videos Loaded : 
        <input id="totalval" value="0"></input>
        <div id="loadstatus" class="fa fa-spinner fa-3x fa-spin" ></div>
    </div><br /><br />
    <button class="btn-sm nopadding" onclick="javascript:truncatevideos();">Truncate</button>
    <br /><br />
    <button class="btn-sm nopadding" onclick="javascript:intiategetVideosFromPlaylist('PLZA492z2996T2sI314ks94qWFMJOrK5yg','','Song');">Songs</button>
    <button class="btn-sm nopadding" onclick="javascript:intiategetVideosFromPlaylist('PLZA492z2996TNfha7m-1K8OylsR9P494p','','Movie');">Movies</button>
    <button class="btn-sm nopadding" onclick="javascript:intiategetVideosFromPlaylist('PLZA492z2996Q9hlflkJgnc8pLted9e07o','','Trailer');">Trailers</button>
    <button class="btn-sm nopadding" onclick="javascript:intiategetVideosFromPlaylist('PLZA492z2996Qb_Ar61eVkTO_rk6yNe6FP','','MoviesScene');">MovieScenes</button>
    <button class="btn-sm nopadding" onclick="javascript:intiategetVideosFromPlaylist('PLZA492z2996SWGg-TrJ_Ag0SDvTbFjjb3','','Controversial');">Controversial</button>
    <button class="btn-sm nopadding" onclick="javascript:intiategetVideosFromPlaylist('PLZA492z2996QUeX-XUn2u2cTJjcEGCUG8','','BehindScene');">BehindScenes</button> 
</div>
<script>
    $("#loadstatus").hide();
</script>
<?php

include 'Master_Page_footer.php';
?>