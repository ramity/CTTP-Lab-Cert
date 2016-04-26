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
                        <select>
                            <?php
                            $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
                            $st=$db->prepare("SELECT * FROM `calibrations`");
                            $st->execute();
                            $data=$st->fetchAll();
                            for($z=0;$z<count($data);$z++)
                            {
                              echo "<option>".$data[$z]['name']."</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" name="form-submit">
                        <?php
                        if(isset($_POST['form-submit']))
                        {
                          require_once('C:/wamp/bend/PHPExcelReader/PHPExcel/IOFactory.php');
                          echo '<br>';
                          try
                          {
                            $objPHPExcel = PHPExcel_IOFactory::load($_POST['file_name']);
                          }
                          catch(Exception $e)
                          {
                            die('Error loading file "'.pathinfo($_POST['file_name'],PATHINFO_BASENAME).'": '.$e->getMessage());
                          }
                          echo '<pre style="text-align:left">';
                          $sheetData = $objPHPExcel->getSheetByName('Sieve Shaker - RoTap 2')->toArray(null,true,true,true);
                          echo $objPHPExcel->getSheetByName('Sieve Shaker - RoTap 2')->getHighestRow();
                          print_r($sheetData);
                          echo '</pre>';
                          foreach($form['1'] as $data)
                          {
                            if(isset($data['xl'])&&!empty($data['xl']))
                            {
                              echo $data['label'];
                              echo ' : [';
                              echo $col=preg_replace('/[0-9]/','',$data['xl']);
                              echo $row=intval(preg_replace('/[^0-9]+/','',$data['xl']),10);
                              echo '] = ';
                              echo htmlentities($sheetData[$row][$col]);
                              echo '<br>';
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
