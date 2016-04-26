<?php
//START DEFINED POST VARIABLES
require_once('C:/wamp/bend/pass.php');
require_once('C:/wamp/bend/modules/auth.php');
require_once('C:/wamp/bend/modules/protected.php');
require_once('C:/wamp/bend/modules/forms.php');
require_once('C:/wamp/bend/modules/input_functions.php');
//END DEFINED POST VARIABLES
?>
<!DOCTYPE>
<html>
  <head>
    <title>Demo</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/css/create.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="http://localhost/js/create.js"></script>
  </head>
  <body>
    <?php require_once('C:/wamp/bend/blocks/sidebar.html');?>
    <?php require_once('C:/wamp/bend/blocks/banner.php');?>
    <div id="container">
      <div id="containerinr">
        <div id="output">

        </div>
        <div id="tools">
          <div class="tool-item" id="create-new-item">Create item</div>
          <div class="tool-item" id="output-php">Output to php array</div>
        </div>
        <div id="display">

        </div>
      </div>
    </div>
  </body>
</html>
