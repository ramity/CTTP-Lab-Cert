<?php
require_once('bend/configmanager.php');
require_once('bend/pass.php');
require_once('bend/modules/auth.php');
?>
<!DOCTYPE>
<html>
    <head>
        <title>CTTP Calibration Application</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <?php require_once('bend/blocks/sidebar.php');?>
        <?php require_once('bend/blocks/banner.php');?>
        <div id="container">
            <div id="containerinr">
                <div class="containerobj" style="padding-bottom:20px;background-color:#fff;">
                    <div class="containerheader">Actions</div>

                    <a href="amrl/index.php">
                      <div class="containeritem">AMRL</div>
                    </a>

                    <a href="create.php">
                      <div class="containeritem">Create</div>
                    </a>

                    <a href="files.php">
                      <div class="containeritem">Files</div>
                    </a>

                    <a href="import.php">
                      <div class="containeritem">Import</div>
                    </a>

                    <a href="input.php">
                      <div class="containeritem">Input</div>
                    </a>

                    <a href="search.php">
                      <div class="containeritem">Search</div>
                    </a>

                    <a href="view.php">
                      <div class="containeritem">View</div>
                    </a>

                    <div class="containerheader">Book versions</div>

                    <a href="book.php">
                      <div class="containeritem">Complete Book [Depreciated] (use AMRL)</div>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
