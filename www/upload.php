<?php
require_once('C:/wamp/bend/modules/auth.php');
require_once('C:/wamp/bend/modules/protected.php');
require_once('C:/wamp/bend/modules/forms.php');
?>
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
                <div class="containerobj">
                    <form id="uploadmodule" action="http://localhost/upload.php" method="post">
                        <div id="uploadheader">Upload file for conversion</div>
                        <input type="text" name="file_name">
                        <label>Type of equipment:</label>
                        <select name="excel-format">
                            <?php
                            $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                            $st=$db->prepare("SELECT * FROM `calibrations`");
                            $st->execute();
                            $c_data=$st->fetchAll();
                            for($z=0;$z<count($c_data);$z++)
                            {
                              echo '<option value="'.$c_data[$z]['id'].'">'.$c_data[$z]['name'].'</option>';
                            }
                            ?>
                        </select>
                        <input type="submit" name="form-submit">
                        <?php
                        if(isset($_POST['form-submit']))
                        {
                          require_once('C:/wamp/bend/PHPExcelReader/PHPExcel/IOFactory.php');

                          try
                          {
                            $objPHPExcel = PHPExcel_IOFactory::load($_POST['file_name']);
                          }
                          catch(Exception $e)
                          {
                            die('Error loading file "'.pathinfo($_POST['file_name'],PATHINFO_BASENAME).'": '.$e->getMessage());
                          }

                          $sheets=$objPHPExcel->getSheetNames();
                          //print_r($sheets);
                          echo '<select name="sheet-selection">';
                          foreach($sheets as $data)
                          {
                            echo '<option value="'.$data.'">'.$data.'</option>';
                          }
                          echo '</select>';
                          echo '<br>';
                          if(isset($_POST['sheet-selection']))
                          {
                            echo '<pre style="text-align:left">';
                            echo $_POST['sheet-selection'];
                            $sheetData = $objPHPExcel->getSheetByName($_POST['sheet-selection'])->toArray(null,true,true,true);
                            echo $objPHPExcel->getSheetByName($_POST['sheet-selection'])->getHighestRow();
                            print_r($sheetData);
                            echo '</pre>';
                            echo '<table style="width:100%">';
                            echo '<tbody>';
                            foreach($_POST['excel-format'] as $data)
                            {

                              if(isset($data['xl'])&&!empty($data['xl']))
                              {
                                echo '<tr>';
                                echo '<td>'.$data['name'].'</td>';
                                echo '<td>[';
                                echo $col=preg_replace('/[0-9]/','',$data['xl']);
                                echo $row=intval(preg_replace('/[^0-9]+/','',$data['xl']),10);
                                echo ']</td>';
                                if(isset($sheetData[$row][$col])&&!empty($sheetData[$row][$col]))
                                {
                                  echo '<td>';
                                  echo htmlentities($sheetData[$row][$col]);
                                  echo '</td>';
                                }
                                else
                                {
                                  echo '<td>';
                                  echo 'NOT GIVEN';
                                  echo '</td>';
                                }
                                echo '</tr>';
                              }
                            }
                          }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
