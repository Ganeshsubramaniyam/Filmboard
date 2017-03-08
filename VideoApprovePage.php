<?php
include 'Master_Page_sub.php';
$obj1 = new Main_Controller();
$obj1->Loginstat();
$obj1->adminloginstat();
?>

<section id="Contactus" class="slice" >
    <div class="container">
        <div class="row" >
            <div class="col-sm-12">
                <h1 class="noSubtitle">Videos Approve Page for Admin</h1>
            </div>
            <div>
                <?php
                echo $obj1->getvideostoapprove();
                ?>
            </div>
        </div>
    </div>
</section>

<script>
    function sendRequestApproveorReject(vid, status)
    {
        $.ajax({
            url: 'Action_Page.php?Action=Approve&Videoid=' + vid + '&statusval=' + status,
            type: 'GET',
            contentType: 'application/json;charset=utf-8',
            success: function (data1)
            {
                $("#" + vid + "panel").hide();
            }
        });
    }
</script>
<?php
include 'Master_Page_Footer.php';
?>
