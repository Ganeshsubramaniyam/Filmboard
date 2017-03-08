<?php
if (session_id() == '') {
    session_start();
}
if(isset($_SESSION["userid"]))
{
    if(isset($_SESSION["currentpage"]))
    {
        echo "<script type='text/javascript'> window.location = '".$_SESSION["currentpage"]."' </script>"; 
    }
    else
    {
        echo '<script type="text/javascript"> window.location = "Home.php" </script>'; 
    }
    
}
$_SESSION["pagecategory"] = "Account";
include 'Master_Page_Sub.php';
?>
<div class="col-sm-12" id='signuppageform'>
    <h2 class="noSubtitle">Login or SignUp</h2>
</div>
<div class="col-sm-12">
    <form action="#" onsubmit="javascript:SignupForm();
            return false;" id="signupfrm" role="form">
        <div class="col-sm-4" id="signuppanel">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"  title="Please enter your name (at least 2 characters)"/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" title="Please enter a valid email address"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" class="form-control" type="password" id="password" size="30" value="" placeholder="Enter the Password" title="Please enter a valid Password(at least 8 characters)">
            </div>
            <div class="form-group">
                <label for="retypepass">Retype Password</label>
                <input name="retypepass" class="form-control" type="password" id="retypepass" size="30" value="" placeholder="Retype the Password" title="Please retype the Password.">
            </div>
            <div class="form-group">
                <div style="float: right;"><a href="javascript:panelswitch();" > Go to Login Page</a></div>
            </div>
            <br />
            <div id="signupresult1">
            </div>
            <br />
            <button name="submit" type="submit" class="btn-sm" id="submit" style="padding: 0px !important">
                Signup
            </button>
        </div>
    </form>
</div>
<div class="clearfix"></div>
<div class="col-sm-12" id="loginpageform">
    <form method="post" onSubmit="javascript:LoginForm();
            return false;" id="loginfrm" role="form">
        <div id="loginpanel">
            <div class="form-group">
                <label for="username">Email Address</label>
                <input name="username" class="form-control" type="text" id="username" size="30" value="" placeholder="Enter your Email Address" title="Please enter your Email Address">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input name="password" class="form-control" type="password" id="password" size="30" value="" placeholder="Enter the Password" title="Please enter your Password.">
            </div>
            <div class="form-group">
                <div style="float: left;"><a href="Password_Recovery.php" > Forgot Password</a></div>
                <div style="float: right;"><a href="javascript:panelswitch();" > SignUp a New Account</a></div>
            </div>
            <br />
            <div class="loginresult">

            </div>
            <br />
            <div class="loginbutton">
                <button name="submit" type="submit" class="btn-sm" id="submit" style="padding: 0px !important;">
                    Login
                </button>
            </div>
            <div class="loginloading" style="color:#FF5511;">
                <div class="fa fa-spinner fa-3x fa-spin"></div>
            </div>

        </div>
    </form>
</div>
    <?php
    include 'Master_Page_footer.php';
    ?>