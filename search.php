<?php
require_once('bend/configmanager.php');
require_once('bend/pass.php');
require_once('bend/modules/auth.php');
require_once('bend/modules/protected.php');
require_once('bend/modules/forms.php');
require_once('bend/modules/input_functions.php');

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
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/inputform.css"/>
    <link rel="stylesheet" type="text/css" href="css/view.css"/>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <!--JQuery UI-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  </head>
  <body>
    <?php require_once('bend/blocks/sidebar.php');?>
    <?php require_once('bend/blocks/banner.php');?>
    <div id="container">
      <div id="containerinr">
        <?php
        if(isset($_GET['alpha'])&&!empty($_GET['alpha'])&&$_GET['alpha'])
        {
          echo '<form class="searchmodule" action="search.php?alpha=true" method="post">';
        }
        else
        {
          echo '<form class="searchmodule" action="search.php?alpha=true" method="post">';
        }

          $search_status=false;
          $search_where_criteria='';
          $search_execute_array=[];

          if(isset($_POST['equipment_id'])&&!empty($_POST['equipment_id']))
          {
            $search_status=true;
            $search_where_criteria.='equipment_id=? AND ';
            array_push($search_execute_array,$_POST['equipment_id']);
          }
          if(isset($_POST['manufacturer'])&&!empty($_POST['manufacturer']))
          {
            $search_status=true;
            $search_where_criteria.='manufacturer=? AND ';
            array_push($search_execute_array,$_POST['manufacturer']);
          }
          if(isset($_POST['model_number'])&&!empty($_POST['model_number']))
          {
            $search_status=true;
            $search_where_criteria.='model_number=? AND ';
            array_push($search_execute_array,$_POST['model_number']);
          }
          if(isset($_POST['serial_number'])&&!empty($_POST['serial_number']))
          {
            $search_status=true;
            $search_where_criteria.='serial_number=? AND ';
            array_push($search_execute_array,$_POST['serial_number']);
          }
          if(isset($_POST['uark_id'])&&!empty($_POST['uark_id']))
          {
            $search_status=true;
            $search_where_criteria.='uark_id=? AND ';
            array_push($search_execute_array,$_POST['uark_id']);
          }
          if(isset($_POST['location'])&&!empty($_POST['location']))
          {
            $search_status=true;
            $search_where_criteria.='location=? AND ';
            array_push($search_execute_array,$_POST['location']);
          }
          if(isset($_POST['performed_by'])&&!empty($_POST['performed_by']))
          {
            $search_status=true;
            $search_where_criteria.='performed_by=? AND ';
            array_push($search_execute_array,$_POST['performed_by']);
          }
          if(isset($_POST['calibration_date'])&&!empty($_POST['calibration_date']))
          {
            $search_status=true;
            $search_where_criteria.='calibration_date=? AND ';
            array_push($search_execute_array,$_POST['calibration_date']);
          }

          if(isset($_GET['alpha'])&&!empty($_GET['alpha'])&&$_GET['alpha'])
          {
            $con=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);

            $state=$con->prepare("SELECT * FROM `calibrations`");
            $state->execute();
            $values=$state->fetchAll();

            $array_equipment_id=[];
            $array_manufacturer=[];
            $array_model_number=[];
            $array_serial_number=[];
            $array_uark_id=[];
            $array_location=[];
            $array_performed_by=[];
            $array_calibration_date=[];

            if($search_status)
            {
              $search_where_criteria=substr($search_where_criteria,0,-5);
            }

            foreach($values as $resulta)
            {
              $table_id=$resulta['id'];

              if($search_status)
              {
                $state=$con->prepare("SELECT equipment_id, manufacturer, model_number, serial_number, uark_id, location, performed_by, calibration_date FROM `$table_id` WHERE $search_where_criteria");
                $state->execute($search_execute_array);
              }
              else
              {
                $state=$con->prepare("SELECT equipment_id, manufacturer, model_number, serial_number, uark_id, location, performed_by, calibration_date FROM `$table_id`");
                $state->execute();
              }

              $values=$state->fetchAll();

              foreach($values as $resultb)
              {
                //equipment_id
                if(empty($array_equipment_id))
                {
                  array_push($array_equipment_id,$resultb['equipment_id']);
                }
                else
                {
                  //if it isn't found in array - insert it into the array
                  if(!in_array($resultb['equipment_id'],$array_equipment_id))
                  {
                    array_push($array_equipment_id,$resultb['equipment_id']);
                  }
                }

                //manufacturer
                if(empty($array_manufacturer))
                {
                  array_push($array_manufacturer,$resultb['manufacturer']);
                }
                else
                {
                  //if it isn't found in array - insert it into the array
                  if(!in_array($resultb['manufacturer'],$array_manufacturer))
                  {
                    array_push($array_manufacturer,$resultb['manufacturer']);
                  }
                }

                //module_number
                if(empty($array_model_number))
                {
                  array_push($array_model_number,$resultb['model_number']);
                }
                else
                {
                  //if it isn't found in array - insert it into the array
                  if(!in_array($resultb['model_number'],$array_model_number))
                  {
                    array_push($array_model_number,$resultb['model_number']);
                  }
                }

                if(empty($array_serial_number))
                {
                  array_push($array_serial_number,$resultb['serial_number']);
                }
                else
                {
                  //if it isn't found in array - insert it into the array
                  if(!in_array($resultb['serial_number'],$array_serial_number))
                  {
                    array_push($array_serial_number,$resultb['serial_number']);
                  }
                }

                if(empty($array_uark_id))
                {
                  array_push($array_uark_id,$resultb['uark_id']);
                }
                else
                {
                  //if it isn't found in array - insert it into the array
                  if(!in_array($resultb['uark_id'],$array_uark_id))
                  {
                    array_push($array_uark_id,$resultb['uark_id']);
                  }
                }

                if(empty($array_location))
                {
                  array_push($array_location,$resultb['location']);
                }
                else
                {
                  //if it isn't found in array - insert it into the array
                  if(!in_array($resultb['location'],$array_location))
                  {
                    array_push($array_location,$resultb['location']);
                  }
                }

                if(empty($array_performed_by))
                {
                  array_push($array_performed_by,$resultb['performed_by']);
                }
                else
                {
                  //if it isn't found in array - insert it into the array
                  if(!in_array($resultb['performed_by'],$array_performed_by))
                  {
                    array_push($array_performed_by,$resultb['performed_by']);
                  }
                }

                if(empty($array_calibration_date))
                {
                  array_push($array_calibration_date,$resultb['calibration_date']);
                }
                else
                {
                  //if it isn't found in array - insert it into the array
                  if(!in_array($resultb['calibration_date'],$array_calibration_date))
                  {
                    array_push($array_calibration_date,$resultb['calibration_date']);
                  }
                }
              }
            }

            //debug
            if(0)
            {
              print_r($array_equipment_id);
              echo '<br><br>';
              print_r($array_manufacturer);
              echo '<br><br>';
              print_r($array_model_number);
              echo '<br><br>';
              print_r($array_serial_number);
              echo '<br><br>';
              print_r($array_uark_id);
              echo '<br><br>';
              print_r($array_location);
              echo '<br><br>';
              print_r($array_performed_by);
              echo '<br><br>';
              print_r($array_calibration_date);
            }
            ?>
            <!--ALPHA SEARCH MODULE-->
            <div class="searchmoduleheader">Calibration Search Engine <a style="float:right" href="search.php?alpha=true', false);?>">Click here to enable auto-complete search [alpha]</a></div>

            <?php
            echo '<div class="searchmodulelabel">Equipment ID</div>';
            echo '<select class="searchmodule" name="equipment_id">';
              echo '<option disabled selected value></option>';
              foreach($array_equipment_id as $data)
              {
                if(isset($_POST['equipment_id'])&&!empty($_POST['equipment_id']))
                {
                  echo '<option value="'.htmlspecialchars($data).'" selected>'.($data).'</option>';
                }
                else
                {
                  echo '<option value="'.htmlspecialchars($data).'">'.($data).'</option>';
                }
              }
            echo '</select> ';

            echo '<div class="searchmodulelabel">Manufacturer</div>';
            echo '<select class="searchmodule" name="manufacturer">';
              echo '<option disabled selected value></option>';
              foreach($array_manufacturer as $data)
              {
                if(isset($_POST['manufacturer'])&&!empty($_POST['manufacturer']))
                {
                  echo '<option value="'.htmlspecialchars($data).'" selected>'.$data.'</option>';
                }
                else
                {
                  echo '<option value="'.htmlspecialchars($data).'">'.$data.'</option>';
                }
              }
            echo '</select> ';

            echo '<div class="searchmodulelabel">Model Number</div>';
            echo '<select class="searchmodule" name="model_number">';
              echo '<option disabled selected value></option>';
              foreach($array_model_number as $data)
              {
                if(isset($_POST['model_number'])&&!empty($_POST['model_number']))
                {
                  echo '<option value="'.htmlspecialchars($data).'" selected>'.$data.'</option>';
                }
                else
                {
                  echo '<option value="'.htmlspecialchars($data).'">'.$data.'</option>';
                }
              }
            echo '</select> ';

            echo '<div class="searchmodulelabel">Serial Number</div>';
            echo '<select class="searchmodule" name="serial_number">';
              echo '<option disabled selected value></option>';
              foreach($array_serial_number as $data)
              {
                if(isset($_POST['serial_number'])&&!empty($_POST['serial_number']))
                {
                  echo '<option value="'.htmlspecialchars($data).'" selected>'.$data.'</option>';
                }
                else
                {
                  echo '<option value="'.htmlspecialchars($data).'">'.$data.'</option>';
                }
              }
            echo '</select> ';

            echo '<div class="searchmodulelabel">Uark ID</div>';
            echo '<select class="searchmodule" name="uark_id">';
              echo '<option disabled selected value></option>';
              foreach($array_uark_id as $data)
              {
                if(isset($_POST['uark_id'])&&!empty($_POST['uark_id']))
                {
                  echo '<option value="'.htmlspecialchars($data).'" selected>'.$data.'</option>';
                }
                else
                {
                  echo '<option value="'.htmlspecialchars($data).'">'.$data.'</option>';
                }
              }
            echo '</select> ';

            echo '<div class="searchmodulelabel">Location</div>';
            echo '<select class="searchmodule" name="location">';
              echo '<option disabled selected value></option>';
              foreach($array_location as $data)
              {
                if(isset($_POST['location'])&&!empty($_POST['location']))
                {
                  echo '<option value="'.htmlspecialchars($data).'" selected>'.$data.'</option>';
                }
                else
                {
                  echo '<option value="'.htmlspecialchars($data).'">'.$data.'</option>';
                }
              }
            echo '</select> ';

            echo '<div class="searchmodulelabel">Performed by</div>';
            echo '<select class="searchmodule" name="performed_by">';
              echo '<option disabled selected value></option>';
              foreach($array_performed_by as $data)
              {
                if(isset($_POST['performed_by'])&&!empty($_POST['performed_by']))
                {
                  echo '<option value="'.htmlspecialchars($data).'" selected>'.$data.'</option>';
                }
                else
                {
                  echo '<option value="'.htmlspecialchars($data).'">'.$data.'</option>';
                }
              }
            echo '</select> ';

            echo '<div class="searchmodulelabel">Calibration Date</div>';
            echo '<select class="searchmodule" name="calibration_date">';
              echo '<option disabled selected value></option>';
              foreach($array_calibration_date as $data)
              {
                if(isset($_POST['calibration_date'])&&!empty($_POST['calibration_date']))
                {
                  echo '<option value="'.htmlspecialchars($data).'" selected>'.$data.'</option>';
                }
                else
                {
                  echo '<option value="'.htmlspecialchars($data).'">'.$data.'</option>';
                }
              }
            echo '</select> ';
          }
          else
          {
            ?>
            <!--STANDARD SEARCH MODULE-->
            <div class="searchmoduleheader">Calibration Search Engine <a style="float:right;" href="search.php?alpha=true');?>">Click here to enable auto-complete search [alpha]</a></div>
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
            echo '<select class="searchmodule" name="calibration_date">';
            echo '<option disabled selected value></option>';
            foreach($o=scandir("bend/file_storage/AMRL Equipment Calibrations/") as $oitem)
            {
              if(strpos($oitem,'Equipment Calibrations')!==false)
              {
                $bits=explode(' Equipment Calibrations',$oitem);
                if(isset($_POST['calibration_date'])&&!empty($_POST['calibration_date'])&&$_POST['calibration_date']==$bits[0])
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
          }
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
              try
              {
                $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                $st=$db->prepare("SELECT * FROM `calibrations`");
                $st->execute();
                $sr=$st->fetchAll();

                foreach($sr as $data)
                {
                  $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);

                  $t_tn=$data['id'];

                  if($search_status)
                  {
                    $st=$db->prepare("SELECT * FROM `$t_tn` WHERE $search_where_criteria ORDER BY main_id DESC");
                    $st->execute($search_execute_array);
                  }
                  else
                  {
                    $st=$db->prepare("SELECT * FROM `$t_tn` ORDER BY main_id DESC");
                    $st->execute();
                  }

                  $sr=$st->fetchAll();

                  foreach($sr as $ref)
                  {
                    if(empty($ref))
                      continue;

                    echo '<tr class="item">';

                    if($ref['result'])
                      echo '<td class="pass">P</td>';
                    else
                      echo '<td class="fail">F</td>';

                    echo '<td>'.$ref['equipment_id'].'</td>';
                    echo '<td>'.$ref['calibration_date'].'</td>';
                    echo '<td>'.$ref['performed_by'].'</td>';

                    if($ref['display']==1)
                    {
                      echo '<td>Live</td>';
                    }
                    elseif($ref['display']==2)
                    {
                      echo '<td>Archived</td>';
                    }
                    else
                    {
                      echo '<td>Deleted</td>';
                    }

                    echo '<td>';
                      echo '<a href="view.php?viewitem='.$ref['main_id'].'&table='.$t_tn.'">View</a>';
                      echo '<a href="view.php?edititem='.$ref['main_id'].'&table='.$t_tn.'">Edit</a>';

                      if($ref['display'])
                        echo '<a href="view.php?removeitem='.$ref['main_id'].'&table='.$t_tn.'">Remove</a>';
                      else
                        echo '<a href="view.php?undoitem='.$ref['main_id'].'&table='.$t_tn.'">Undo</a>';

                    echo '</td>';
                    echo '</tr>';
                  }
                }
              }
              catch(PDOException $e)
              {
                  echo $e->getMessage();
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
