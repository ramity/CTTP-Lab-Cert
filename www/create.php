<?php
//START DEFINED POST VARIABLES
require_once('C:/wamp/www/bend/pass.php');
require_once('C:/wamp/www/bend/modules/auth.php');
require_once('C:/wamp/www/bend/modules/protected.php');
require_once('C:/wamp/www/bend/modules/forms.php');
require_once('C:/wamp/www/bend/modules/input_functions.php');
//END DEFINED POST VARIABLES
function width($text,$xl)
{
  if(empty($text))
  {
    $box = imagettfbbox(15,0,'C:/wamp/www/font/arial.ttf',$xl);
    return $text_width = $box[0] + $box[2];
  }
  {
    $box = imagettfbbox(15,0,'C:/wamp/www/font/arial.ttf',$text);
    return $text_width = $box[0] + $box[2];
  }
}
?>
<!DOCTYPE html>
  <head>
    <title>CTTP Calibration Application</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/css/create.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="http://localhost/js/keydrown.min.js"></script>
    <script src="http://localhost/js/create.js"></script>
  </head>
  <body>
    <?php require_once('C:/wamp/www/bend/blocks/banner.php');?>
    <div id="container-touch">
      <form id="filebar" action="http://localhost/create.php" method="post">
        <?php
        echo '<select class="plate" name="file_year">';
        echo '<option disabled selected value>Year</option>';
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
          echo '<select class="plate" name="file_name">';
          echo '<option disabled selected value>File</option>';
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
          echo '<option disabled selected value>Sheet</option>';
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
        <input class="submit" type="submit" name="form-submit">
      </form>
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

        foreach($sheetData as $key=>$row)
        {
          if($max<=count($row))
          {
            $max=count($row);
          }
        }

        $cell_widths=array();

        echo '<script>';
        echo 'window.max='.$max.';';

        echo 'window.conv_array=[';
        foreach($sheetData as $key=>$row)
        {
          echo "[";
          for($z=0;$z<$max;$z++)
          {
            if(isset($row[$abc[$z]]))
            {
              $cell_widths[$key][$z]=width(htmlentities($row[$abc[$z]],ENT_QUOTES),$abc[$z]);
            }
            else
            {
              $cell_widths[$key][$z]=width('',$abc[$z]);
            }

            if($z==$max-1)
            {
              if(!empty($row[$abc[$z]]))
              {
                echo '[';
                  echo '"'.htmlentities($row[$abc[$z]],ENT_QUOTES).'"';
                echo ']],';
              }
              else
              {
                echo '[]],';
              }
            }
            else
            {
              if(!empty($row[$abc[$z]]))
              {
                echo '[';
                echo '"'.htmlentities($row[$abc[$z]],ENT_QUOTES).'"';
                echo '],';
              }
              else
              {
                echo '[],';
              }
            }
          }
        }
        echo '];';

        $cell_widths_max=array();
        $cell_widths_padding=10;

        foreach($cell_widths as $row)
        {
          for($x=0;$x<count($row);$x++)
          {
            if(empty($cell_widths_max[$x]))
            {
              $cell_widths_max[$x]=$row[$x]+$cell_widths_padding;
            }
            else
            {
              if($row[$x]>$cell_widths_max[$x])
              {
                $cell_widths_max[$x]=$row[$x]+$cell_widths_padding;
              }
            }
          }
        }

        echo 'window.col_widths=[';

        $col_width=0;

        for($x=0;$x<count($cell_widths_max);$x++)
        {
          if($x==count($cell_widths_max)-1)
          {
            $col_width+=$cell_widths_max[$x];

            echo "['".$cell_widths_max[$x]."']";
          }
          else
          {
            $col_width+=$cell_widths_max[$x];

            echo "['".$cell_widths_max[$x]."'],";
          }
        }

        echo '];';

        echo 'window.canvas_width='.$col_width.';';
        echo 'window.canvas_height='.(count($sheetData)*25).';';

        echo '</script>';
        //var_dump($cell_widths_max);
        //echo '<br>';
        //var_dump($cell_widths);
      ?>
      <div id="spreadsheet_main">
        <div <?php echo 'style="width:'.($col_width+40).'px"';?>>
          <div id="spacer"></div>
          <div id="col_holder" <?php echo 'style="width:'.$col_width.'px"';?>>
            <?php
            for($x=0;$x<count($cell_widths_max);$x++)
            {
              echo '<div class="col_item" id="col_header_'.$abc[$x].'" style="width:'.($cell_widths_max[$x]-1).'px">'.$abc[$x].'</div>';
            }
            ?>
          </div>
        </div>
        <div <?php echo 'style="width:'.($col_width+40).'px;height:'.(count($sheetData)*25).'px"';?>>
          <div id="row_holder" <?php echo 'style="height:'.(count($sheetData)*25).'px"';?>>
            <?php
            for($x=1;$x<count($sheetData)+1;$x++)
            {
              echo '<div class="row_item" id="row_header_'.$x.'">'.$x.'</div>';
            }
            ?>
          </div>
          <canvas id="container">Your browser does not support the canvas tag.</canvas>
        </div>
      </div>
      <?php
      }
      ?>
    </div>
  </body>
</html>
