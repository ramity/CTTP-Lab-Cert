<?php
require_once('C:/wamp/www/bend/pass.php');
require_once('C:/wamp/www/bend/modules/auth.php');
require_once('C:/wamp/www/bend/modules/protected.php');
require_once('C:/wamp/www/bend/modules/forms.php');
require_once('C:/wamp/www/bend/modules/input_functions.php');

$view_table=true;
$error=false;
$error_array=[];
$update=false;

if(check_get('edititem')||check_get('viewitem')||check_get('removeitem')||check_get('undoitem'))
  $view_table=false;
else
  $view_table=true;
?>
<!DOCTYPE>
<html>
  <head>
    <title>CTTP Calibration Application</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/css/inputform.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/css/view.css"/>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <!--JQuery UI-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  </head>
  <body>
    <?php require_once('C:/wamp/www/bend/blocks/sidebar.html');?>
    <?php require_once('C:/wamp/www/bend/blocks/banner.php');?>
    <div id="container">
      <div id="containerinr">
        <form class="searchmodule" action="http://localhost/search.php" method="post">
          <div class="searchmoduleheader">Calibration Search Engine</div>
          <div class="searchmodulelabel">Equipment ID</div>
          <input class="searchmodule" type="text" name="equipment_id" value="<?php
            if(isset($_POST['equipment_id'])&&!empty($_POST['equipment_id']))
            {
              echo $_POST['equipment_id'];
            }
          ?>">

          <div class="searchmodulelabel">Manufactuerer</div>
          <input class="searchmodule" type="text" name="manufacturer" value="<?php
          if(isset($_POST['manufacturer'])&&!empty($_POST['manufacturer']))
          {
              echo $_POST['manufacturer'];
            }
          ?>">

          <div class="searchmodulelabel">Model Number</div>
          <input class="searchmodule" type="text" name="model_number" value="<?php
            if(isset($_POST['model_number'])&&!empty($_POST['model_number']))
            {
              echo $_POST['model_number'];
            }
          ?>">

          <div class="searchmodulelabel">Serial Number</div>
          <input class="searchmodule" type="text" name="serial_number" value="<?php
            if(isset($_POST['serial_number'])&&!empty($_POST['serial_number']))
            {
              echo $_POST['serial_number'];
            }
          ?>">

          <div class="searchmodulelabel">Uark ID</div>
          <input class="searchmodule" type="text" name="uark_id" value="<?php
            if(isset($_POST['uark_id'])&&!empty($_POST['uark_id']))
            {
              echo $_POST['uark_id'];
            }
          ?>">

          <div class="searchmodulelabel">Location</div>
          <input class="searchmodule" type="text" name="location" value="<?php
            if(isset($_POST['location'])&&!empty($_POST['location']))
            {
              echo $_POST['location'];
            }
          ?>">

          <div class="searchmodulelabel">Performed By</div>
          <input class="searchmodule" type="text" name="performed_by" value="<?php
            if(isset($_POST['performed_by'])&&!empty($_POST['performed_by']))
            {
              echo $_POST['performed_by'];
            }
          ?>">

          <div class="searchmodulelabel">Year</div>
          <?php
          echo '<select class="searchmodule" name="calibration_year">';
          echo '<option disabled selected value></option>';
          foreach($o=scandir("bend/file_storage/AMRL Equipment Calibrations/") as $oitem)
          {
            if(strpos($oitem,'Equipment Calibrations')!==false)
            {
              $bits=explode(' Equipment Calibrations',$oitem);
              if(isset($_POST['calibration_year'])&&!empty($_POST['calibration_year'])&&$_POST['calibration_year']==$bits[0])
              {
                echo '<option value="'.$bits[0].'" selected>'.$bits[0].'</option>';
              }
              else
              {
                echo '<option value="'.$bits[0].'">'.$bits[0].'</option>';
              }
            }
          }
          echo '</select> ';
          ?>
          <input type="submit" name="searchmodulesubmit" class="searchmodulebutton" value="Search">
        </form>
        <table class="list">
          <caption>Searched Calibrations</caption>
          <tbody>
            <tr>
              <th>Pass/Fail</th>
              <th>Equipment Id</th>
              <th>Date performed</th>
              <th>Performed By</th>
              <th>Status</th>
              <th>Commands</th>
            </tr>
            <?php
            if(isset($_POST['searchmodulesubmit'])&&!empty($_POST['searchmodulesubmit']))
            {
              $search_status=false;
              $search_where_criteria='';
              $search_execute_array=[];

              if(isset($_POST['equipment_id'])&&!empty($_POST['equipment_id']))
              {
                $search_status=true;
                $search_where_criteria.='equipment_id=? AND ';
                array_push($search_execute_array,$_POST['equipment_id']);
              }
              elseif(isset($_POST['manufacturer'])&&!empty($_POST['manufacturer']))
              {
                $search_status=true;
                $search_where_criteria.='manufacturer=? AND ';
                array_push($search_execute_array,$_POST['manufacturer']);
              }
              elseif(isset($_POST['model_number'])&&!empty($_POST['model_number']))
              {
                $search_status=true;
                $search_where_criteria.='model_number=? AND ';
                array_push($search_execute_array,$_POST['model_number']);
              }
              elseif(isset($_POST['serial_number'])&&!empty($_POST['serial_number']))
              {
                $search_status=true;
                $search_where_criteria.='serial_number=? AND ';
                array_push($search_execute_array,$_POST['serial_number']);
              }
              elseif(isset($_POST['uark_id'])&&!empty($_POST['uark_id']))
              {
                $search_status=true;
                $search_where_criteria.='uark_id=? AND ';
                array_push($search_execute_array,$_POST['uark_id']);
              }
              elseif(isset($_POST['location'])&&!empty($_POST['location']))
              {
                $search_status=true;
                $search_where_criteria.='location=? AND ';
                array_push($search_execute_array,$_POST['location']);
              }
              elseif(isset($_POST['performed_by'])&&!empty($_POST['performed_by']))
              {
                $search_status=true;
                $search_where_criteria.='performed_by=? AND ';
                array_push($search_execute_array,$_POST['performed_by']);
              }
              elseif(isset($_POST['calibration_year'])&&!empty($_POST['calibration_year']))
              {
                $search_status=true;
                $search_where_criteria.='calibration_year=? AND ';
                array_push($search_execute_array,$_POST['calibration_year']);
              }
              else
              {
                //Do nothing
              }

              if($search_status)
              {

                try
                {
                  $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                  $st=$db->prepare("SELECT * FROM `calibrations`");
                  $st->execute();
                  $sr=$st->fetchAll();

                  //removes space + AND + space
                  $search_where_criteria=substr($search_where_criteria,0,-5);

                  foreach($sr as $data)
                  {
                    $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);

                    $t_tn=$data['id'];

                    $st=$db->prepare("SELECT * FROM `$t_tn` WHERE $search_where_criteria AND display=1 ORDER BY id DESC");
                    $st->execute($search_execute_array);
                    $sr=$st->fetchAll();

                    echo 'iteration<br>';

                    if(empty($sr))
                      continue;

                    echo '<tr class="item">';

                    if($sr[0]['result'])
                      echo '<td class="pass">P</td>';
                    else
                      echo '<td class="fail">F</td>';

                    echo '<td>'.$sr[0]['equipment_id'].'</td>';
                    echo '<td>'.$sr[0]['calibration_date'].'</td>';
                    echo '<td>'.$sr[0]['performed_by'].'</td>';

                    if($sr[0]['display'])
                      echo '<td>Live</td>';
                    else
                      echo '<td>Deleted</td>';

                    echo '<td>';
                    echo '<a href="http://localhost/view.php?viewitem='.$t_id.'&table='.$t_tn.'">View</a>';
                    echo '<a href="http://localhost/view.php?edititem='.$t_id.'&table='.$t_tn.'">Edit</a>';

                    if($sr[0]['display'])
                      echo '<a href="http://localhost/view.php?removeitem='.$t_id.'&table='.$t_tn.'">Remove</a>';
                    else
                      echo '<a href="http://localhost/view.php?undoitem='.$t_id.'&table='.$t_tn.'">Undo</a>';

                    echo '</td>';
                    echo '</tr>';
                  }
                }
                catch(PDOException $e)
                {
                    echo $e->getMessage();
                }
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
