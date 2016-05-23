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
    <title>CTTP Calibration Application</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/css/create.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/css/import.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="http://localhost/js/keydrown.min.js"></script>
    <script src="http://localhost/js/create.js"></script>
  </head>
  <body>
    <?php require_once('C:/wamp/www/bend/blocks/banner.php');?>
    <div id="container">
      <div id="containerinr">
        <form id="uploadmodule" action="http://localhost/create.php" method="post">
            <div id="uploadheader">Select file for conversion</div>
            <div id="uploadbar">
              <?php
              echo '<div class="label">Select a year</div>';
              echo '<select class="plate" name="file_year">';
              echo '<option disabled selected value> -- select an option -- </option>';
              foreach($o=scandir("bend/file_storage/AMRL Equipment Calibrations/") as $oitem)
              {
                if(strpos($oitem,'Equipment Calibrations')!==false)
                {
                  $bits=explode(' Equipment Calibrations',$oitem);
                  if(isset($_POST['file_year'])&&!empty($_POST['file_year'])&&$_POST['file_year']==$bits[0])
                  {
                    echo '<option value="'.$bits[0].'" selected>'.$bits[0].'</option>';
                  }
                  else
                  {
                    echo '<option value="'.$bits[0].'">'.$bits[0].'</option>';
                  }
                }
              }
              echo '</select>';
              if(isset($_POST['file_year'])&&!empty($_POST['file_year']))
              {
                echo '<div class="label">Select a file</div>';
                echo '<select class="plate" name="file_name">';
                echo '<option disabled selected value> -- select an option -- </option>';
                foreach($o=scandir("bend/file_storage/AMRL Equipment Calibrations/".$_POST['file_year']." Equipment Calibrations/") as $oitem)
                {
                  if($oitem!=='.'&&$oitem!=='..')
                  {
                    if(isset($_POST['file_name'])&&!empty($_POST['file_name'])&&$_POST['file_name']==$oitem)
                    {
                      echo '<option value="'.$oitem.'" selected>'.$oitem.'</option>';
                    }
                    else
                    {
                      echo '<option value="'.$oitem.'">'.$oitem.'</option>';
                    }
                  }
                }
                echo '</select>';
              }
              if(isset($_POST['file_name'])&&!empty($_POST['file_name']))
              {
                $path="bend/file_storage/AMRL Equipment Calibrations/".$_POST['file_year']." Equipment Calibrations/".$_POST['file_name'];
                echo '<div class="label">Select a sheet</div>';
                echo '<select class="plate" name="sheet_selection">';
                require_once('C:/wamp/www/bend/PHPExcelReader/PHPExcel/IOFactory.php');
                try
                {
                  $objPHPExcel = PHPExcel_IOFactory::load($path);
                }
                catch(Exception $e)
                {
                  die('Error loading file "'.pathinfo($path,PATHINFO_BASENAME).'": '.$e->getMessage());
                }
                $sheets=$objPHPExcel->getSheetNames();
                echo '<option disabled selected value> -- select an option -- </option>';
                foreach($sheets as $data)
                {
                  if(isset($_POST['sheet_selection'])&&!empty($_POST['sheet_selection'])&&$_POST['sheet_selection']==str_replace('"','&',$data))
                  {
                    echo '<option value="'.str_replace('"','&',$data).'" selected>'.$data.'</option>';
                  }
                  else
                  {
                    echo '<option value="'.str_replace('"','&',$data).'">'.$data.'</option>';
                  }
                }
                echo '</select>';
              }
              ?>
              <input id="uploadsubmit" type="submit" name="form-submit">
          </div>
          <?php
          if(isset($_POST['sheet_selection'])&&!empty($_POST['sheet_selection']))
          {
            if(strpos($_POST['sheet_selection'],'&')!==false)
            {
              $_POST['sheet_selection']=str_replace('&','"',$_POST['sheet_selection']);
            }

            $sheetData = $objPHPExcel->getSheetByName($_POST['sheet_selection'])->toArray(null,true,true,true);
            $max=0;
            $abc=range('A','Z');
            $col_contains=[];

            foreach($sheetData as $key=>$row)
            {
              if($max<count($row))
              {
                $max=count($row);
              }
            }

            echo '<table>';
              echo '<tr>';
                echo '<th></th>';

                for($z=0;$z<$max;$z++)
                {
                  echo '<th>'.$abc[$z].'</th>';
                }

              echo '</tr>';
              foreach($sheetData as $key=>$row)
              {
                echo '<tr>';
                  echo '<td>';
                    echo $key;
                  echo '</td>';
                  for($z=0;$z<$max;$z++)
                  {
                    if(!empty($row[$abc[$z]]))
                    {
                      echo '<td class="bind" id="'.$abc[$z].$key.'">';
                        echo $row[$abc[$z]];
                      echo '</td>';
                    }
                    else
                    {
                      echo '<td class="bind null" id="'.$abc[$z].$key.'">';
                        echo $row[$abc[$z]];
                      echo '</td>';
                    }
                  }
                echo '</tr>';
              }
            echo '</table>';

          }
          ?>
        </form>
      </div>
    </div>
  </body>
</html>
