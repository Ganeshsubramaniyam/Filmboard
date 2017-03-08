<?php
if (session_id() == '') {
    session_start();
}
$_SESSION["currentpage"] = "Password_Recovery.php";
$_SESSION["pagecategory"] = "Account";

include 'Master_Page_Sub.php';
?>
<div class="col-sm-12" id='signuppageform'>
    <h2>Password Recovery</h2>
</div>
<div class="col-sm-12" id="loginpageform">
    <form method="post" action="javascript:recoverpassword();" id="loginfrm" role="form">
        <div id="loginpanel">
            <div class="form-group">
                <label for="username">Email Address</label>
                <input name="username" class="form-control" type="text" id="username" size="30" value="" placeholder="Enter the Email Address" title="Please enter your UserName or Email Address">
            </div>
            <div class="loginresult">
            </div>
            <br />
            <button name="submit" type="submit" class="btn-sm" id="submit" style="padding:5px !important; width: auto !important;">
                Recover Password
            </button>
        </div>
    </form>

    <script>
        function recoverpassword()
        {
            var email = $("#username").val();
            if (email != "")
            {
                $.post("Action_Page.php?Action=RecoverPassword",
                        {
                            emailval: email
                        }, function (data, status)
                {
                    if (data == "Success")
                    {
                        $(".loginresult").empty();
                        $(".loginresult").append("<div style='background-color:green;padding-left:10px;color:white !important;'>Password Details has been sent to " + email + " .</div>");
                    }
                    else
                    {
                        $(".loginresult").empty();
                        $(".loginresult").append("<div style='background-color:#B94A48;padding-left:10px;color:white !important;'>No Account Linked to this Email Address.</div>");
                    }
                });
            }
            else
            {
                $(".loginresult").empty();
                $(".loginresult").append("<div style='background-color:#B94A48;padding-left:10px;color:white !important;'>Email Address Required.</div>");
            }
        }
    </script>

    <?php
    include 'Master_Page_footer.php';
    ?>