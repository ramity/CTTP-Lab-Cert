<?php
//START DEFINED POST VARIABLES
require_once('C:/wamp/bend/pass.php');
require_once('C:/wamp/bend/modules/auth.php');
require_once('C:/wamp/bend/modules/protected.php');
require_once('C:/wamp/bend/modules/forms.php');
require_once('C:/wamp/bend/modules/input_functions.php');
//END DEFINED POST VARIABLES

//START CONDITIONAL VARIABLE DECLARATION
$selection_menu=true;
$error=false;
$error_array=[];

if(check_get('form'))
  $selection_menu=false;
else
  $selection_menu=true;
//END CONDITIONAL VARIABLE DECLARATION

//START POST SUBMIT CHECKS
for($z=1;$z<count($form);$z++)
{
  if(check_post_submit('submit-'.$z))
  {
    if(check_post_array($form[$z]))
    {
      try
      {
        //INSERT NEW ENTRY FOR REFERENCE
        $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
        $st=$db->prepare("INSERT INTO `main` (table_number) VALUES($z)");
        $st->execute();

        //GET THE VALUE OF THE NEW ENTRY
        $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
        $st=$db->prepare("SELECT * FROM `main` ORDER BY id DESC LIMIT 0 , 1");
        $st->execute();
        $sr=$st->fetchAll();

        $keys='';
        $list='';
        array_pop($_POST);

        //ITS A PUN BECAUSE ITS GOING TO BE $_POST WITHOUT KEYS.
        $locked=[];
        //LAUGH, DAMN YOU

        foreach($_POST as $key => $data)
        {
          array_push($locked,$data);
          $keys.=$key.', ';
          $list.='?,';
        }

        $keys.='main_id';
        $list.='?';
        array_push($locked,$sr[0]['id']);

        //$keys=substr($keys,0,-2);//remove ', '
        //$list=substr($list,0,-1);//remove last ','

        echo 'yes<br>';
        if($z==1)
        {
          echo 'hl3confirmed<br>';
          $result=1;
          $datas=[];
          array_push($datas,$_POST['data_b']);
          array_push($datas,$_POST['data_c']);
          array_push($datas,$_POST['data_d']);
          array_push($datas,$_POST['data_e']);
          array_push($datas,$_POST['data_f']);
          array_push($datas,$_POST['data_g']);
          array_push($datas,$_POST['data_h']);
          print_r($datas);
          foreach($datas as $array)
          {
            if(($array/$_POST['data_a'])>(substr($_POST['data_i'],0,-1)/100))
              $result=0;
          }
          $keys.=', result';
          $list.=',?';
          array_push($locked,$result);
          echo $keys.'<br>';
          echo $list.'<br>';
          print_r($locked);
          echo '<br>';
          echo 'Result: '.$result;
        }

        print_r($locked);

        $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
        $st=$db->prepare("INSERT INTO `$z`($keys) VALUES($list)");
        $st->execute($locked);

        header("Location: http://localhost/view.php");
      }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
    }
    else
    {
      $error=true;
      $error_array=find_post_error_array($form[$z]);
    }
  }
}
//END POST SUBMIT CHECKS
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
        <form action="http://localhost/create.php?step=1" method="post" id="create">
          <input id="form_text" name="form_text" class="hidden">
          <div id="functionholder">
            <div id="functions">
              <div class="functionheader">Calibration creation shortcut functions</div>
              <div class="button" id="add_des_inf">Add designation inf.</div>
              <div class="button" id="add_item">Create item</div>
              <div class="button" id="add_header">Create header</div>
              <div class="button" id="add_item">Create item</div>
              <div class="button" id="add_item">Create item</div>
            </div>
          </div>
          <div id="display">
            <div class="displayheader">Display</div>
          </div>
          <div id="content"></div>
          <input class="create_submit" name="create_submit_1" type="submit">
        </form>
      </div>
    </div>
  </body>
</html>
