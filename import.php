<?php
require_once('config.php');

require_once(generate_path('bend/modules/auth.php'));
require_once(generate_path('bend/modules/protected.php'));
require_once(generate_path('bend/modules/forms.php'));
?>
<!DOCTYPE>
<html>
    <head>
        <title>CTTP Calibration Application</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php generate_url('css/main.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php generate_url('css/import.css');?>">
    </head>
    <body>
        <?php require_once(generate_path('bend/blocks/sidebar.php'));?>
        <?php require_once(generate_path('bend/blocks/banner.php'));?>
        <div id="container">
            <div id="containerinr">
                <div class="containerobj">
                    <form id="uploadmodule" action="<?php generate_url('import.php');?>" method="post">
                        <div id="uploadheader">Select file for conversion</div>
                        <div id="uploadbar">
                          <?php
                          echo '<div class="label">Select a year</div>';
                          echo '<select class="plate" name="file_year">';
                          echo '<option disabled selected value> -- select an option -- </option>';
                          foreach($o=scandir(generate_path("bend/file_storage/AMRL Equipment Calibrations/")) as $oitem)
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
                            foreach($o=scandir(generate_path("bend/file_storage/AMRL Equipment Calibrations/".$_POST['file_year']." Equipment Calibrations/")) as $oitem)
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
                            $path = generate_path("bend/file_storage/AMRL Equipment Calibrations/".$_POST['file_year']." Equipment Calibrations/".$_POST['file_name']);
                            echo '<div class="label">Select a sheet</div>';
                            echo '<select class="plate" name="sheet_selection">';
                            require_once(generate_path('bend/PHPExcelReader/PHPExcel/IOFactory.php'));
                            try
                            {
                              $objPHPExcel = PHPExcel_IOFactory::load($path);
                            }
                            catch(Exception $e)
                            {
                              die('Error loading file "'.pathinfo($path,PATHINFO_BASENAME).'": '.$e->getMessage());
                            }
                            $sheets = $objPHPExcel->getSheetNames();
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
                          if(isset($_POST['sheet_selection'])&&!empty($_POST['sheet_selection']))
                          {
                            echo '<div class="label">Select a calibration</div>';
                            echo '<select class="plate" name="excel-format">';
                            $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);

                            $st=$db->prepare("SELECT * FROM `calibrations`");
                            $st->execute();
                            $c_data=$st->fetchAll();
                            echo '<option disabled selected value> -- select an option -- </option>';
                            for($z=0;$z<count($c_data);$z++)
                            {
                              if(isset($_POST['excel-format'])&&!empty($_POST['excel-format'])&&$_POST['excel-format']==str_replace('&','"',$c_data[$z]['id']))
                              {
                                echo '<option value="'.str_replace('"','&',$c_data[$z]['id']).'" selected>'.$c_data[$z]['name'].'</option>';
                              }
                              else
                              {
                                echo '<option value="'.str_replace('"','&',$c_data[$z]['id']).'">'.$c_data[$z]['name'].'</option>';
                              }
                            }
                            echo '</select>';

                            //change post_sheet_selection back to quote to properly load the file
                            $_POST['sheet_selection']=str_replace('&','"',$_POST['sheet_selection']);
                          }
                          ?>
                          <input id="uploadsubmit" type="submit" name="form-submit">
                      </div>
                      <?php
                      if(isset($_POST['excel-format']))
                      {
                        $sheetData = $objPHPExcel->getSheetByName($_POST['sheet_selection'])->toArray(null,true,true,true);
                        echo '<table class="excel">';
                        echo '<tbody>';
                        $list='';
                        $keys='';
                        $locked=[];
                        for($z=0;$z<count($form[$_POST['excel-format']]);$z++)
                        {
                          if(isset($form[$_POST['excel-format']][$z]['xl'])&&!empty($form[$_POST['excel-format']][$z]['xl']))
                          {
                            $keys.=$form[$_POST['excel-format']][$z]['name'].', ';
                            $list.='?,';
                            echo '<tr>';
                            echo '<td>'.$form[$_POST['excel-format']][$z]['name'].'</td>';
                            if(strpos($form[$_POST['excel-format']][$z]['xl'],'+')!==false)
                            {
                              $xlvalues=explode('+',$form[$_POST['excel-format']][$z]['xl']);
                              $col=[];
                              $row=[];
                              $result=true;
                              echo '<td>';
                              for($x=0;$x<count($xlvalues);$x++)
                              {
                                if(strpos($xlvalues[$x],',')!==false||
                                  strpos($xlvalues[$x],'(')!==false||
                                  strpos($xlvalues[$x],')')!==false||
                                  strpos($xlvalues[$x],'/')!==false)
                                {
                                  echo $xlvalues[$x];
                                }
                                else
                                {
                                  echo '[';
                                  echo $col[$x]=preg_replace('/[0-9]/','',$xlvalues[$x]);
                                  echo ',';
                                  echo $row[$x]=intval(preg_replace('/[^0-9]+/','',$xlvalues[$x]),10);
                                  echo ']';
                                }
                              }
                              echo '</td>';
                            }
                            else
                            {
                              echo '<td>[';
                              echo $col=preg_replace('/[0-9]/','',$form[$_POST['excel-format']][$z]['xl']);
                              echo ',';
                              echo $row=intval(preg_replace('/[^0-9]+/','',$form[$_POST['excel-format']][$z]['xl']),10);
                              echo ']</td>';
                            }
                            if(count($col)===1)
                            {
                              if(isset($sheetData[$row][$col])&&!empty($sheetData[$row][$col]))
                              {
                                if($form[$_POST['excel-format']][$z]['name']==='result')
                                {
                                  if(strtolower($sheetData[$row][$col])=='pass')
                                  {
                                    $sheetData[$row][$col]='1';
                                    array_push($locked,'1');
                                  }
                                  elseif(strtolower($sheetData[$row][$col])=='fail')
                                  {
                                    $sheetData[$row][$col]='0';
                                    array_push($locked,'0');
                                  }
                                  echo '<td>';
                                  echo htmlentities($sheetData[$row][$col]);
                                  echo '</td>';
                                }
                                elseif($form[$_POST['excel-format']][$z]['name']==='calibration_date')
                                {
                                  if(strpos($sheetData[$row][$col],'-'))
                                  {
                                    $bits=explode('-',$sheetData[$row][$col]);
                                  }
                                  elseif(strpos($sheetData[$row][$col],'/'))
                                  {
                                    $bits=explode('/',$sheetData[$row][$col]);
                                  }
                                  else
                                  {
                                    die($sheetData[$row][$data].' Was not handled correctly. [#2k3j4go8d7fykjdhasf]');
                                  }

                                  //get calibration_day for calibration_due + calibration_last
                                  if(count($bits)==3)
                                  {
                                    #$bits[0] - month
                                    #$bits[1] - day
                                    #$bits[2] - year
                                    $calibration_day=$bits[1];
                                  }
                                  else
                                  {
                                    die('Bits did not have 3 array values [#jklhw3rkjas8diyf2k3jnr]');
                                  }

                                  array_push($locked,htmlentities($sheetData[$row][$col]));
                                  echo '<td>';
                                    echo htmlentities($sheetData[$row][$col]);
                                  echo '</td>';
                                }
                                elseif($form[$_POST['excel-format']][$z]['name']==='calibration_due'||$form[$_POST['excel-format']][$z]['name']==='calibration_last')
                                {
                                  //Ref: http://stackoverflow.com/questions/2754765/how-to-reformat-date-in-php#answer-2754777
                                  $value=9;
                                  $month_intials=
                                  [
                                    'Jan.',
                                    'Feb.',
                                    'Mar.',
                                    'Apr.',
                                    'Aug.',
                                    'Sept.',
                                    'Oct.',
                                    'Nov.',
                                    'Dec.'
                                  ];
                                  $month_actual=
                                  [
                                    'January',
                                    'February',
                                    'March',
                                    'April',
                                    'August',
                                    'September',
                                    'october',
                                    'November',
                                    'December'
                                  ];

                                  for($y=0;$y<count($month_intials);$y++)
                                  {
                                    if(strpos($sheetData[$row][$col],$month_intials[$y])!==false)
                                    {
                                      $value=$y;
                                    }
                                  }

                                  if($value!==9)
                                  {
                                    $sheetData[$row][$col]=str_replace($month_intials[$value],$month_actual[$value],$sheetData[$row][$col]);
                                  }

                                  if(strpos($sheetData[$row][$col],' ')!==false)
                                  {
                                    $bits=explode(' ',$sheetData[$row][$col]);
                                    //[0] month
                                    //[1] year
                                    if(strlen($bits[1])==2&&count($bits)==2)
                                    {
                                      $sheetData[$row][$col]=$bits[0].' 20'.$bits[1];
                                    }
                                  }

                                  if(strpos($sheetData[$row][$col],' ')!==false)
                                  {
                                    $date=DateTime::createFromFormat('M Y',$sheetData[$row][$col])->format("m/$calibration_day/Y");
                                    $sheetData[$row][$col]=$date;

                                    array_push($locked,htmlentities($sheetData[$row][$col]));
                                  }
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
                            }
                            else
                            {
                              $data='';
                              for($x=0;$x<count($xlvalues);$x++)
                              {
                                if(strpos($xlvalues[$x],',')!==false||
                                  strpos($xlvalues[$x],'(')!==false||
                                  strpos($xlvalues[$x],')')!==false||
                                  strpos($xlvalues[$x],'/')!==false)
                                {
                                  $data.=$xlvalues[$x];
                                }
                                else
                                {
                                  if(isset($sheetData[$row[$x]][$col[$x]])&&!empty($sheetData[$row[$x]][$col[$x]]))
                                  {
                                    $data.=htmlentities($sheetData[$row[$x]][$col[$x]]);
                                  }
                                  else
                                  {
                                    $data.='NOT GIVEN';
                                  }
                                }
                              }
                              array_push($locked,$data);
                              echo '<td>'.$data.'</td>';
                            }
                            echo '</tr>';
                          }
                        }
                        echo '</tbody>';
                        echo '</table>';
                        //INSERT DATA
                        try
                        {
                          //die('no entry for you');
                          $rolled=false;

                          #INSERT NEW ENTRY FOR REFERENCE

                          $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);

                          $db->beginTransaction();

                          $st=$db->prepare("INSERT INTO `main` (table_number) VALUES(:tablename)");
                          $st->bindParam('tablename',$_POST['excel-format']);
                          $st->execute();

                          #GET THE VALUE OF THE NEW ENTRY

                          $st=$db->prepare("SELECT * FROM `main` ORDER BY id DESC LIMIT 0 , 1");
                          $st->execute();
                          $sr=$st->fetchAll();

                          #last second additions

                          $keys.='main_id';
                          $list.='?';
                          array_push($locked,$sr[0]['id']);

                          if($_POST['file_year']!==date('Y'))
                          {
                            $keys.=', display';
                            $list.=',?';
                            array_push($locked,'2');
                          }

                          $tablename=$_POST['excel-format'];

                          $st=$db->prepare("INSERT INTO `$tablename`($keys) VALUES($list)");
                          $result=$st->execute($locked);

                          $db->commit();

                          if($result)
                          {
                            echo '<div class="notif-g">Success</div>';
                            echo '<a href="http://localhost/view.php?viewitem='.$sr[0]['id'].'&table='.$tablename.'">';
                              echo '<div class="notif-b">View calibration entry</div>';
                            echo '</a>';
                            echo '<a href="http://localhost/view.php?removeitem='.$sr[0]['id'].'&table='.$tablename.'">';
                              echo '<div class="notif-r">Delete calibration entry</div>';
                            echo '</a>';
                          }
                          else
                          {
                            $rolled=true;
                            $db->rollBack();
                            $dba->rollBack();
                          }
                        }
                        catch(PDOException $e)
                        {
                          if(!$rolled)
                          {
                            $db->rollBack();
                            $dba->rollBack();
                          }
                          echo $e->getMessage();
                        }
                      }
                    ?>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
