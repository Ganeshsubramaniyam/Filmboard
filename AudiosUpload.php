<?php
if (session_id() == '') {
    session_start();
}
$_SESSION["lastpage"] = "AudiosUpload.php";
$_SESSION["pagecategory"] = "Audios";
include 'Master_Page_Sub.php';

$obj1 = new Main_Controller();
$obj1->Loginstat();
?>
<div class='col-xs-12'>
    <h2>Upload Music</h2><br />
    <div style="margin-left: 5%;">
        <div class="col-sm-12" id="albumcreationhome">
            <form action="javascript:albumcreation();" id="albumcreateform" role="form">
                <div class="col-sm-4" id="albumcreation">
                    <div id="albumcreationstatus"></div>
                    <div class="clearfix"></div>
                    <div class='form-group'>
                        <label for='albumname'> Create a Album/Song Name</label>
                        <input type='text' class='form-control' name='albumname' id='albumname' placeholder=' Album or Song Name'  title='Please  Enter a Album or Song Name '/>
                    </div>
                    <div class="clearfix"></div>
                    <div class='form-group'>
                        <label for='albumart'>Album Art</label>
                        <input type="file" id="albumart" onchange="showalbumart(this);" name="albumart" title='Please select the Album art for the Album or Song' accept="image/gif, image/jpeg, image/png" />
                        <br /><img id='albumartimg' style="display: none"></img>
                    </div>
                    <br />
                    <div class="form-group">
                        <input type="submit" class="btn-sm nopadding" value="Create Album" />
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
        <div id="albumcreationcontent" class="col-sm-12" style="display: none">
            <form action="javascript:updatealbuminfo();" id="musicuploadform" role="form">
                <div class="col-sm-4" >
                    <div class="form-group">
                        <label>Album Name </label><br /> 
                        <u><label id="albumnameview" style="text-decoration: underline;text-indent: 30px;font-weight: normal;"></label></u>
                    </div>
                    <div class='form-group'>
                        <label for='albumtype'>Album Type</label>
                        <select class='form-control' name='albumtype' id='albumtype' placeholder=' Album Type' title='Please Select the Album Type'>
                            <option value=''> -- Please Select the Album Type -- </option>
                            <option value='Movie Album'>Movie Album</option>
                            <option value='Composer Album'>Composer Album</option>
                            <option value='Devotional'>Devotional</option>
                            <option value='Patriotism'>Others</option>
                        </select>
                    </div>
                    <div class='form-group' id='movalb'>
                        <label for='composername'>Composer Name</label>
                        <input name='composername' class='form-control' type='text' id='composername'  placeholder=' Composer Name' title='Please Enter the Composer Name'>
                    </div>
                    <div class='form-group'>
                        <label for='releaseyear'>Year of Release</label>
                        <input name='releaseyear' class='form-control' type='text' id='releaseyear'  placeholder=' Release Year' title='Please Enter the Release Year of the Album or Song'>
                    </div>
                    <div class='form-group'>
                        <label for='language'>Language</label>
                        <input name='language' class='form-control' type='text' id='language'  placeholder=' Language' title='Please Enter the Language of the Album or Song'>
                    </div>
                    <br />
                </div>
                <div class="col-sm-7" id="albumfileupload">
                    <div style="height: 250px !important; border-bottom: dotted 1px black;width: 102%;overflow-y: auto">
                        <div id="fileuploader">Upload</div>
                    </div>
                    <br />
                    * Click the 'Commit Album' button only after the completion of file upload.<br />
                    * Fully filled blue bar indicates File Uploaded Successfully .<br />
                    <div class="clearfix"></div><br />
                    <div id="trackuploadstatus" class="col-sm-9"></div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <input type="submit" class="btn-sm nopadding" value="Commit Album" />
                        <input type="hidden" id="albumidval" value="" />
                    </div>
                </div>
            </form>
        </div>
        <br /><br /><br /><br /><br /><br />
    </div>
</form>
</div>
<?php
include 'Master_Page_Footer.php';
?>