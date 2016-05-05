<?php
require_once('C:/wamp/www/bend/modules/auth.php');
require_once('C:/wamp/www/bend/modules/protected.php');
require_once('C:/wamp/www/bend/modules/forms.php');
?>
<!DOCTYPE>
<html>
    <head>
        <title>Demo</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
    </head>
    <body>
        <?php require_once('C:/wamp/www/bend/blocks/sidebar.html');?>
        <?php require_once('C:/wamp/www/bend/blocks/banner.php');?>
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
                          require_once('C:/wamp/www/bend/PHPExcelReader/PHPExcel/IOFactory.php');
                          try
                          {
                            $objPHPExcel = PHPExcel_IOFactory::load($_POST['file_name']);
                          }
                          catch(Exception $e)
                          {
                            die('Error loading file "'.pathinfo($_POST['file_name'],PATHINFO_BASENAME).'": '.$e->getMessage());
                          }

                          $sheets=$objPHPExcel->getSheetNames();
                          echo '<select name="sheet-selection">';
                          foreach($sheets as $data)
                          {
                            echo '<option value="'.$data.'">'.$data.'</option>';
                          }
                          echo '</select>';
                          echo '<br>';
                          if(isset($_POST['sheet-selection']))
                          {
                            $sheetData = $objPHPExcel->getSheetByName($_POST['sheet-selection'])->toArray(null,true,true,true);
                            echo '<table style="width:100%">';
                            echo '<tbody>';
                            $list='';
                            $keys='';
                            $locked=[];
                            for($z=0;$z<sizeof($form[$_POST['excel-format']]);$z++)
                            {
                              if(isset($form[$_POST['excel-format']][$z]['xl'])&&!empty($form[$_POST['excel-format']][$z]['xl']))
                              {
                                $keys.=$form[$_POST['excel-format']][$z]['name'].', ';
                                $list.='?,';
                                echo '<tr>';
                                echo '<td>'.$form[$_POST['excel-format']][$z]['name'].'</td>';
                                echo '<td>[';
                                echo $col=preg_replace('/[0-9]/','',$form[$_POST['excel-format']][$z]['xl']);
                                echo ',';
                                echo $row=intval(preg_replace('/[^0-9]+/','',$form[$_POST['excel-format']][$z]['xl']),10);
                                echo ']</td>';
                                if(isset($sheetData[$row][$col])&&!empty($sheetData[$row][$col]))
                                {
                                  if($form[$_POST['excel-format']][$z]['name']=='result')
                                  {
                                    if(strtolower($sheetData[$row][$col])==='pass')
                                    {
                                      $sheetData[$row][$col]='1';
                                      array_push($locked,'1');
                                    }
                                    elseif(strtolower($sheetData[$row][$col])==='fail')
                                    {
                                      $sheetData[$row][$col]='0';
                                      array_push($locked,'0');
                                    }
                                    echo '<td>';
                                    echo htmlentities($sheetData[$row][$col]);
                                    echo '</td>';
                                  }
                                  elseif($form[$_POST['excel-format']][$z]['name']=='calibration_date')
                                  {
                                    $date=strtotime($sheetData[$row][$col]);
                                    $calibration_day=date('d',$date);
                                    array_push($locked,htmlentities($sheetData[$row][$col]));
                                    echo '<td>';
                                    echo htmlentities($sheetData[$row][$col]);
                                    echo '</td>';
                                  }
                                  elseif($form[$_POST['excel-format']][$z]['name']=='calibration_due'||$form[$_POST['excel-format']][$z]['name']=='calibration_last')
                                  {
                                    //Ref: http://stackoverflow.com/questions/2754765/how-to-reformat-date-in-php#answer-2754777
                                    $date=DateTime::createFromFormat('M Y',$sheetData[$row][$col]);
                                    $output=$date->format("m/$calibration_day/Y");
                                    $sheetData[$row][$col]=$output;
                                    array_push($locked,htmlentities($sheetData[$row][$col]));
                                    echo '<td>';
                                    echo htmlentities($sheetData[$row][$col]);
                                    echo '</td>';
                                  }
                                  else
                                  {
                                    array_push($locked,htmlentities($sheetData[$row][$col]));
                                    echo '<td>';
                                    echo htmlentities($sheetData[$row][$col]);
                                    echo '</td>';
                                  }
                                }
                                else
                                {
                                  array_push($locked,'NOT GIVEN');
                                  echo '<td>';
                                  echo 'NOT GIVEN';
                                  echo '</td>';
                                }
                                echo '</tr>';
                              }
                            }
                            //INSERT DATA
                            try
                            {
                              //INSERT NEW ENTRY FOR REFERENCE
                              $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                              $st=$db->prepare("INSERT INTO `main` (table_number) VALUES(:tablename)");
                              $st->bindParam('tablename',$_POST['excel-format']);
                              $st->execute();

                              //GET THE VALUE OF THE NEW ENTRY
                              $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                              $st=$db->prepare("SELECT * FROM `main` ORDER BY id DESC LIMIT 0 , 1");
                              $st->execute();
                              $sr=$st->fetchAll();


                              $keys.='main_id';
                              $list.='?';
                              array_push($locked,$sr[0]['id']);

                              //print_r($locked);

                              $tablename=$_POST['excel-format'];

                              $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                              $st=$db->prepare("INSERT INTO `$tablename`($keys) VALUES($list)");
                              $result=$st->execute($locked);

                              if($result)
                              {
                                echo '<br>Success';
                              }

                              //header("Location: http://localhost/view.php");
                            }
                            catch(PDOException $e)
                            {
                              echo $e->getMessage();
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
