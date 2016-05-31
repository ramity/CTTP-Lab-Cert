<div id="banner">
  <!--
  Rest in Peace
    ||  ||
    \\()//
   //(__)\\
  ||      ||
  Spido, 2k16
  -->
    <div id="bannerinr">
        <div id="bannerlogo">
            <a href="http://localhost/">
                CTTP Calibration Application
            </a>
        </div>
        <?php
        if($secure_auth)
        {
        ?>
        <div id="bannerlogin">
            logged in as: <?php echo $secure_username;?>
        </div>
        <?php
        }
        else
        {
        ?>
        <a href="http://localhost/login.php">
            <div id="bannerlogin">
                login
            </div>
        </a>
        <?php
        }
        ?>
    </div>
</div>
