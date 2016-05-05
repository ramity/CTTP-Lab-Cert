<?php
//START DEFINED POST VARIABLES
require_once('C:/wamp/www/bend/pass.php');
require_once('C:/wamp/www/bend/modules/auth.php');
require_once('C:/wamp/www/bend/modules/protected.php');
require_once('C:/wamp/www/bend/modules/forms.php');
require_once('C:/wamp/www/bend/modules/input_functions.php');
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
    <?php require_once('C:/wamp/www/bend/blocks/sidebar.html');?>
    <?php require_once('C:/wamp/www/bend/blocks/banner.php');?>
    <div id="container">
      <div id="containerinr">
        <table id="output">

        </table>
        <div id="tools">
          <div class="tool-item" id="create-new-item">Create item</div>
          <div class="tool-item" id="add-designation">Add designation</div>
          <div class="tool-item" id="output-php">Output to php array</div>
          <div class="tool-item" id="clear-form">Clear form</div>
          <div id="fixedtoolbar">
            <div class="fixedtoolbaritem" id="fixed-clear-form">-</div>
            <div class="fixedtoolbaritem" id="fixed-output-php">^</div>
            <div class="fixedtoolbaritem" id="fixed-add-designation">D</div>
            <div class="fixedtoolbaritem" id="fixed-create-new-item">+</div>
          </div>
        </div>
        <div id="display"></div>
      </div>
    </div>
  </body>
</html>
