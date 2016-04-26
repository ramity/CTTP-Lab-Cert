<?php require_once('C:/wamp/bend/modules/auth.php');?>

<!DOCTYPE>
<html>
    <head>
        <title>Demo</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
    </head>
    <body>
        <?php require_once('C:/wamp/bend/blocks/sidebar.html');?>
        <?php require_once('C:/wamp/bend/blocks/banner.php');?>
        <div id="container">
            <div id="containerinr">
                <div class="containerobj" style="padding-bottom:20px;background-color:#fff;">
                    <div class="containerheader">Actions</div>
                    <a href="http://localhost/view.php">
                      <div class="containeritem">View</div>
                    </a>
                    <a href="http://localhost/upload.php">
                      <div class="containeritem">Upload</div>
                    </a>
                    <a href="http://localhost/input.php">
                      <div class="containeritem">Input</div>
                    </a>
                    <a href="http://localhost/files.php">
                      <div class="containeritem">Files</div>
                    </a>
                    <div class="containerheader">Book versions</div>
                    <div class="containeritem">
                        <a href="http://localhost/book.php">
                            Complete Book
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
