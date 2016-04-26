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
    <link rel="stylesheet" type="text/css" href="http://localhost/css/inputform.css">
    <?php
    if(check_get('form'))
      echo '<script src="http://localhost/js/'.$_GET['form'].'.js"></script>';
    ?>
  </head>
  <body>
    <?php require_once('C:/wamp/bend/blocks/sidebar.html');?>
    <?php require_once('C:/wamp/bend/blocks/banner.php');?>
    <div id="container">
      <div id="containerinr">
        <?php
        if($selection_menu)
        {
        ?>
          <div class="inputrowbigheader">
            Calibration Sheets
          </div>
          <div class="containerobj">
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Aggregate Calibrations</div>
              <div class="inputrow">
                <a href="http://localhost/input.php?form=2">
                  <div class="selectionlabel">Mechanical Splitter Calibration Input</div>
                </a>
              </div>
              <div class="inputrow">
                <a href="http://localhost/input.php?form=1">
                  <div class="selectionlabel">Sieve Shaker Calibration Input</div>
                </a>
              </div>
              <div class="inputrow">
                <a href="http://localhost/input.php?form=3">
                  <div class="selectionlabel">Cone and Tamper Calibration Input</div>
                </a>
              </div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Digital Caliper Calibration</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Hot Mix Calibration Sheets</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Nuclear Gauge (Leak Test)</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Oven Calibration</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Scale Calibration</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Sieve Calibration (8)</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Sieve Calibration (12)</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Soils Calibration Sheets</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Straight Edge Calibration</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Thermometer Calibration</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Timer Calibration</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Vacuum Gauge Calibration</div>
            </div>
          </div>
          <div class="containerobj">
            <div class="inputrowbigheader">Outside Calibrations</div>
          </div>
          <!--
            <div class="inputrow">
              <div class="selectionlabel">Cone and Tamper Calibration</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">CoreLok - ???</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">CoreLok 1/2</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Digital Caliper Calibration</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Fine Agg. Angularity Calibration</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Gyratory Compactor Calibration Sheets</div>
              <div class="inputrow">
                <div class="selectionlabel">Pine Gyratory Compactor Calibration</div>
              </div>
              <div class="inputrow">
                <div class="selectionlabel">Pine Gyratory Compactor - Full Verification Calibration</div>
              </div>
              <div class="inputrow">
                <div class="selectionlabel">Gyratory Mold Calibration</div>
              </div>
              <div class="inputrow">
                <div class="selectionlabel">Pine G Series Bottom Plates Calibration</div>
              </div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Liquid Limit Device and Grooving Tool Calibration</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Mold Calibration (any size)</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Oven Calibration</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Proctor Hammer Calibration (regular/modified)</div>
            </div>
            <div class="inputrowgroup">
              <div class="inputrowgroupheader">Scale (G#) Calibration Sheets</div>
              <div class="inputrow">
                <div class="selectionlabel">Scale Calibration Instructions (Reference)</div>
              </div>
              <div class="inputrow">
                <div class="selectionlabel">Scale G1 Calibration</div>
              </div>
              <div class="inputrow">
                <div class="selectionlabel">Scale G2 Calibration</div>
              </div>
              <div class="inputrow">
                <div class="selectionlabel">Scale G5 Calibration</div>
              </div>
              <div class="inputrow">
                <div class="selectionlabel">Scale G20 Calibration</div>
              </div>
              <div class="inputrow">
                <div class="selectionlabel">Scale G100 Calibration</div>
              </div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Sieve Calibration</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Straight Edge Calibration</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Thermometer Calibration</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Timer Calibration</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Vacuum Gauge Calibration</div>
            </div>
          </div>
          <div class="containerobj">
            <div class="inputrowbigheader">
              Verification Sheets
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Pine G1 Compactor Calibration Verification</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Pine G2 Compactor Calibration Verification</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Pine Gyratory Compactor Calibration Verification</div>
            </div>
          </div>
          <div class="containerobj">
            <div class="inputrowbigheader">
              Maintenance Sheets
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Default Maintenance Log</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Pump Maintenance Log</div>
            </div>
          </div>
          <div class="containerobj">
            <div class="inputrowbigheader">
              Maintenance Items
            </div>
            <div class="inputrow">
              <div class="selectionlabel">G1 Compactory</div>
            </div>
            <div class="inputrow">
              <div class="selectionlabel">G2 Compactory</div>
            </div>
          </div>
          <div class="containerobj">
            <div class="inputrowbigheader">
              Leak Test Logs
            </div>
            <div class="inputrow">
              <div class="selectionlabel">Nuclear Devices</div>
            </div>
          </div>
        -->
        <?php
        }
        else
        {
          echo '<a href="http://localhost/input.php"><div id="backbutton">Back to form selection</div></a>';
          //START FORM=# COND
          generate_form($_GET['form'],$form[$_GET['form']],$error,$error_array);
        }
        ?>
      </div>
    </div>
  </body>
</html>
