</div>
<br>
</div>
</div>
</div>
</div>
<div id="my-panel" style="display: none;">
    <?php
    if ($_SESSION["pagecategory"] == "Home") {
        echo "<a href='Home.php' class='active-sec'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
        echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
        echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
    } else if ($_SESSION["pagecategory"] == "Radios") {
        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
        echo "<a href='Radios.php' class='active-sec'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
        echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
        echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
    } else if ($_SESSION["pagecategory"] == "Videos") {
        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
        echo "<a href='Videos.php'  class='active-sec'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
        echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
        echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
    } else if ($_SESSION["pagecategory"] == "Audios") {
        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
        echo "<a href='Audios.php' class='active-sec'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
        echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
    } else if ($_SESSION["pagecategory"] == "Account") {
        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
        echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
        echo "<a href='MyAccount.php' class='active-sec'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
        echo "<a href='ContactUs.php'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
    } else if ($_SESSION["pagecategory"] == "ContactUs") {
        echo "<a href='Home.php'><span class='menu_name'>HOME</span><span class='fa fa-home'></span> </a>";
        echo "<a href='Radios.php'><span class='menu_name'>RADIO CHANNELS</span><span class='fa fa-headphones'></span> </a>";
        echo "<a href='Videos.php'><span class='menu_name'>VIDEOS</span><span class='fa fa-film'></span> </a>";
        echo "<a href='Audios.php'><span class='menu_name'>MUSIC &amp; ALBUMS</span><span class='fa fa-music'></span> </a>";
        echo "<a href='MyAccount.php'><span class='menu_name'>ACCOUNT</span><span class='fa fa-user'></span> </a>";
        echo "<a href='ContactUs.php' class='active-sec'><span class='menu_name'>CONTACT US</span><span class='fa fa-newspaper-o'></span> </a>";
    }
    ?>
</div>
<script>
    $("#bodycontainer").focus();
    $("#bodycontainer").css("margin-top", "25px");
</script>
<script>
    var popupdialog;
    $("#my-link").click(function () {
        if ($("#my-panel").is(":visible"))
        {
            $("#my-panel").hide("slide", {direction: "left"}, 200);
        } else
        {
            $("#my-panel").show("slide", {direction: "left"}, 200);
        }

    });

    $('#postboxtext').focus(function ()
    {
        $(this).animate({
            height: '90px'
        }, 500, function () {
            // Animation complete.
        });
    });

</script>
</body>
</html>
