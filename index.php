<?php
require_once('config.php');

require_once(generate_path('bend/modules/auth.php'));
?>
<!DOCTYPE>
<html>
    <head>
        <title>CTTP Calibration Application</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
    </head>
    <body>
        <?php require_once('C:/wamp/www/bend/blocks/sidebar.html');?>
        <?php require_once('C:/wamp/www/bend/blocks/banner.php');?>
        <div id="container">
            <div id="containerinr">
                <div class="containerobj" style="padding-bottom:20px;background-color:#fff;">
                    <div class="containerheader">Actions</div>

                    <a href="http://localhost/amrl/index.php">
                      <div class="containeritem">AMRL</div>
                    </a>

                    <a href="http://localhost/create.php">
                      <div class="containeritem">Create</div>
                    </a>

                    <a href="http://localhost/files.php">
                      <div class="containeritem">Files</div>
                    </a>

                    <a href="http://localhost/import.php">
                      <div class="containeritem">Import</div>
                    </a>

                    <a href="http://localhost/input.php">
                      <div class="containeritem">Input</div>
                    </a>

                    <a href="http://localhost/search.php">
                      <div class="containeritem">Search</div>
                    </a>

                    <a href="http://localhost/view.php">
                      <div class="containeritem">View</div>
                    </a>

                    <div class="containerheader">Book versions</div>

                    <a href="http://localhost/book.php">
                      <div class="containeritem">Complete Book [Depreciated] (use AMRL)</div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
