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
        <link rel="stylesheet" type="text/css" href="http://localhost/css/display.css"/>
        <!--JQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <!--JQuery UI-->
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <?php
        if(check_get('edititem'))
        {
        ?>
        <script>
        $(function(){
          $("input[name=calibration_date],input[name=calibration_due]").datepicker({
            inline: true,
            showOtherMonths: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
          });
        });
        </script>
        <?php
        }
        if(check_get('viewitem'))
        {
          echo '<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/jq-2.2.0,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.css"/>';
          echo '<script type="text/javascript" src="https://cdn.datatables.net/t/dt/jq-2.2.0,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.js"></script>';
          echo "<script>$(document).ready(function()
          {
            $('#attach-".$_GET['viewitem']."').DataTable({
              'bSort': false,
              dom: 'Bfrtip',
              buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
              'pageLength': 17
            });
          });</script>";
          echo '<style>div#attach-'.$_GET['viewitem'].'_wrapper{width:100%;}</style>';
        }
        if(check_get('edititem')&&check_get('table'))
          echo '<script src="http://localhost/js/'.$_GET['table'].'.js"></script>';
        ?>
    </head>
    <body>
        <?php require_once('C:/wamp/www/bend/blocks/sidebar.html');?>
        <?php require_once('C:/wamp/www/bend/blocks/banner.php');?>
        <div id="container">
            <div id="containerinr">
              <?php
              if($view_table)
              {
              ?>
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
                <caption>Recent Calibrations</caption>
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
                  try
                  {
                    $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                    $st=$db->prepare("SELECT * FROM `main`");
                    $st->execute();
                    $sr=$st->fetchAll();
                    foreach($sr as $data)
                    {
                      $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);

                      $t_tn=$data['table_number'];
                      $t_id=$data['id'];

                      $st=$db->prepare("SELECT * FROM `$t_tn` WHERE main_id=$t_id AND display=1 ORDER BY id DESC");
                      $st->execute();
                      $sr=$st->fetchAll();

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
                  ?>
                </tbody>
              </table>

              <table class="list">
                <caption>Due Equipment Calibrations</caption>
                <tbody>
                  <tr>
                    <th>Days till</th>
                    <th>Equipment Id</th>
                    <th>Calibration Type</th>
                    <th>Date Due</th>
                    <th>Calibration Interval</th>
                    <th>Commands</th>
                  </tr>
                  <?php
                  try
                  {
                    $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                    $st=$db->prepare("SELECT * FROM `main`");
                    $st->execute();
                    $sr=$st->fetchAll();
                    foreach($sr as $data)
                    {
                      $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                      $t_tn=$data['table_number'];
                      $t_id=$data['id'];
                      $st=$db->prepare("SELECT * FROM `$t_tn` WHERE display=1 AND main_id=$t_id");
                      $st->execute();
                      $sr=$st->fetchAll();
                      if(!empty($sr))
                      {
                        $now=time();
                        $then=strtotime($sr[0]['calibration_due']);
                        $date_diff=$then-$now;
                        $days_till=floor($date_diff/(60*60*24));

                        echo '<tr class="item">';

                        if($days_till>14)
                          echo '<td class="due_safe">'.$days_till.'</td>';
                        elseif($days_till<14&&$days_till>7)
                          echo '<td class="due_warning">'.$days_till.'</td>';
                        elseif($days_till<7)
                          echo '<td class="due_late">'.$days_till.'</td>';

                        echo '<td>'.$sr[0]['equipment_id'].'</td>';

                        $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                        $st=$db->prepare("SELECT * FROM `calibrations` WHERE id=$t_tn");
                        $st->execute();
                        $t_sr=$st->fetchAll();

                        echo '<td>'.$t_sr[0]['name'].'</td>';
                        echo '<td>'.$sr[0]['calibration_due'].'</td>';

                        $then=strtotime($sr[0]['calibration_due']);
                        $now=strtotime($sr[0]['calibration_date']);
                        $date_diff=abs($then-$now);
                        $cal_int=floor($date_diff/(60*60*24));

                        echo '<td>'.$cal_int.' days</td>';

                        echo '<td>';
                        echo '<a href="http://localhost/view.php?viewitem='.$t_id.'&table='.$t_tn.'">View</a>';
                        echo '<a href="http://localhost/input.php?form='.$t_tn.'">Create</a>';
                        echo '<a href="http://localhost/view.php?removeitem='.$t_id.'&table='.$t_tn.'">Remove</a>';
                        echo '</td>';
                        echo '</tr>';
                      }
                    }
                  }
                  catch(PDOException $e)
                  {
                      echo $e->getMessage();
                  }
                  ?>
                </tbody>
              </table>

              <table class="list">
                <caption>Removed Calibrations</caption>
                <tbody>
                  <tr>
                    <th>Pass/Fail</th>
                    <th>Calibration Id</th>
                    <th>Equipment Id</th>
                    <th>Date performed</th>
                    <th>Performed By</th>
                    <th>Commands</th>
                  </tr>
                  <?php
                  try
                  {
                    $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                    $st=$db->prepare("SELECT * FROM `main`");
                    $st->execute();
                    $sr=$st->fetchAll();
                    foreach($sr as $data)
                    {
                      $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                      $t_tn=$data['table_number'];
                      $t_id=$data['id'];
                      $st=$db->prepare("SELECT * FROM `$t_tn` WHERE main_id=$t_id AND display=0");
                      $st->execute();
                      $sr=$st->fetchAll();
                      if(!empty($sr))
                      {
                        echo '<tr class="item">';
                        if($sr[0]['result'])
                          echo '<td class="pass">P</td>';
                        else
                          echo '<td class="fail">F</td>';
                        echo '<td>'.$t_id.'</td>';
                        echo '<td>'.$sr[0]['equipment_id'].'</td>';
                        echo '<td>'.$sr[0]['calibration_date'].'</td>';
                        echo '<td>'.$sr[0]['performed_by'].'</td>';
                        echo '<td>';
                        echo '<a href="http://localhost/view.php?viewitem='.$t_id.'&table='.$t_tn.'">View</a>';
                        echo '<a href="http://localhost/view.php?undoitem='.$t_id.'&table='.$t_tn.'">Undo</a>';
                        echo '</td>';
                        echo '</tr>';
                      }
                    }
                  }
                  catch(PDOException $e)
                  {
                      echo $e->getMessage();
                  }
                  ?>
                </tbody>
              </table>
              <?php
              }
              else
              {
                if(check_get('viewitem')&&check_get('table'))
                {
                  $t_tn=$_GET['table'];
                  $t_id=$_GET['viewitem'];
                  $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                  $st=$db->prepare("SELECT * FROM `$t_tn` WHERE main_id=$t_id");
                  $st->execute();
                  $data=$st->fetchAll();
                  generate_view_form($_GET['viewitem'],$_GET['table'],$form[$_GET['table']],$data);
                }
                elseif(check_get('edititem')&&check_get('table'))
                {
                  $t_tn=$_GET['table'];
                  $t_id=$_GET['edititem'];
                  for($z=1;$z<=count($form);$z++)
                  {
                    if(check_post_submit('submit-'.$z))
                    {
                      if(check_post_array($form[$z]))
                      {
                        try
                        {
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
                            $list.=$key.'=?,';
                          }

                          $keys=substr($keys,0,-2);//remove ', '
                          $list=substr($list,0,-1);//remove last ','

                          $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                          $st=$db->prepare("UPDATE `$t_tn` SET $list WHERE main_id=$t_id");
                          $st->execute($locked);

                          $update=true;
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
                  $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                  $st=$db->prepare("SELECT * FROM `$t_tn` WHERE main_id=$t_id");
                  $st->execute();
                  $data=$st->fetchAll();
                  echo '<a href="http://localhost/view.php?viewitem='.$t_id.'&table='.$t_tn.'"><div id="backbutton">Back to view</div></a>';
                  if($update)
                    echo '<div class="noticemessage">Update successful</div>';
                  generate_edit_form($_GET['edititem'],$_GET['table'],$form[$_GET['table']],$error,$error_array,$data);
                }
                elseif(check_get('removeitem')&&check_get('table'))
                {
                  $t_tn=$_GET['table'];
                  $t_id=$_GET['removeitem'];
                  $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                  $st=$db->prepare("UPDATE `$t_tn` SET display=0 WHERE main_id=$t_id");
                  $st->execute();
                  header('Location:http://localhost/view.php');
                }
                elseif(check_get('undoitem')&&check_get('table'))
                {
                  $t_tn=$_GET['table'];
                  $t_id=$_GET['undoitem'];
                  $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                  $st=$db->prepare("UPDATE `$t_tn` SET display=1 WHERE main_id=$t_id");
                  $st->execute();
                  header('Location:http://localhost/view.php');
                }
              }
              ?>
            </div>
        </div>
    </body>
</html>
