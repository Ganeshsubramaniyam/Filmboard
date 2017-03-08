<?php
if (session_id() == '') {
    session_start();
}
$_SESSION["pagecategory"] = "Account";
$_SESSION["currentpage"] = "WebScrapper.php";
include 'Master_Page_Sub.php';
if (isset($_GET["autofetch"]) && $_GET["autofetch"] == "1") {
    $autofetch = new Main_controller();
    $autofetch->Loginstat();
    $autofetch->adminloginstat();
    $resultret = $autofetch->fetchAllUrls();
    for ($index = 0; $index < mysqli_num_rows($resultret); $index++) {
        $result = mysqli_fetch_row($resultret);
        ?>

<div style="width: 100%; height: 40px;margin: 20px;" id="scrappanelid_<?php echo $result[0]; ?>">
            <div style="float: left;margin-left: 20px;width: 10%;">Id : <?php echo $result[0]; ?></div>
            <div style="float: left;margin-left: 20px;width: 40%;"><?php echo $result[1]; ?></div>
            <div style="float: right;margin-left: 20px;width: 20%;"><button id="btn_<?php echo $result[0]; ?>" class="btn-sm nopadding" onclick="javascript:ScrapwebMovie(<?php echo $result[0]; ?>, 'https://en.wikipedia.org<?php echo $result[2]; ?>')">Scrap</button></div>
            <div class="fa fa-spinner fa-3x fa-spin" id="spinner_<?php echo $result[0]; ?>"></div>
        </div>
<script>
$("#spinner_<?php echo $result[0]; ?>").hide();
</script>
        <?php
    }
    ?>
    <div class="col-sm-12" style="height: 100px;visibility: hidden" id="pagedisplay">

    </div>
    <?php
} else {
    ?>
    <div class="col-sm-12" id='signuppageform'>
        <h2 class="noSubtitle">Web Scrapping</h2>
    </div>
    <div class="col-sm-12">
        <div id="loginpanel">
            <div class="form-group">
                <label for="scraptype">Scrap Type</label><br />
                <input type="radio" name="scraptype" class="scraptype" value="movie">Scrap a Movie</input>
                <input type="radio" name="scraptype" class="scraptype" value="profile">Scrap a profile</input>
                <input type="radio" name="scraptype" class="scraptype" value="moviesdb">Scrap Movies by year</input>

            </div>
            <div class="form-group">
                <label for="Webaddress">Website Address</label>
                <input name="Webaddress" class="form-control" type="text" id="Webaddress" size="30" value="" placeholder="Enter the Website Address" title="Please the Website Address">
            </div>
            <div class="clearfix"></div>

            <div class="loginbutton">
                <button class="btn-sm nopa
    dding" id="scrap" onclick="javascript:Scrapwebaddress('', '');">
                    Scrap 
                </button>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-12" style="margin-top: 5%;" id="pagedisplay">

            </div>
        </div>
        <?php
    }
    ?>
    <?php
    include 'Master_Page_footer.php';
    ?>