<?php
if (session_id() == '') {
    session_start();
}
$_SESSION["currentpage"] = "ContactUs.php";
$_SESSION["pagecategory"] = "ContactUs";
include 'Master_Page_Sub.php';
?>
<div class="col-sm-12">
    <h2>Contact us</h2>
</div>
<div id="Contactusstatus" class="col-md-6" style="text-align: center;"></div>
<script>$("#Contactusstatus").hide();</script>
<div class="col-sm-12" style="padding: 5px !important;" >
    <div id='Contactusdivbody'>
        <form action="#" onsubmit="javascript:SubmitContactus();return false;" id="contactfrm" role="form">
            <div class="col-sm-5">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"  title="Please enter your name (at least 2 characters)"/>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" title="Please enter a valid email address"/>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input name="phone" class="form-control required digits" type="tel" id="phone" size="30" value="" placeholder="Enter email phone" title="Please enter a valid phone number (at least 10 characters)">
                </div>
            </div>
            <div class="col-sm-7">
                <div class="form-group">
                    <label for="comments">Comments</label>
                    <textarea style="background: white !important;" name="comment" class="form-control" id="comment" cols="3" rows="5" placeholder="Enter your message…" title="Please enter your message (at least 10 characters)"></textarea>
                </div>
                <fieldset class="clearfix securityCheck">
                    <legend>
                        Security
                    </legend>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LfJJiATAAAAALyQEy9w8osAqFZ_8_MKh1X2d_fM"></div>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-8">
                <div class="result"></div><br />
                <button name="submit" type="submit" class="btn-sm nopadding" id="submit">
                    Submit
                </button>

            </div>
        </form>
    </div>

    <?php
    include 'Master_Page_footer.php';
    ?>