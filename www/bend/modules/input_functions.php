<?php
function generate_form($id,$array,$error,$array_error)
{
  echo '<form action="http://localhost/input.php?form='.$id.'" method="post" id="input">';
  echo '<div class="containerobj">';
  for($z=0;$z<count($array);$z++)
  {
    if(isset($array[$z]['tag'])&&!empty($array[$z]['tag']))
    {
      if($array[$z]['tag']=='div')
      {
        echo '<div class="'.$array[$z]['class'].'">'.$array[$z]['value'].'</div>';
      }
      else
      {
        if($error&&$array_error[$z])
        {
          echo '<div class="inputrowerror">';
          echo '<div class="errormessage">'.$array_error[$z].'</div>';
        }
        else
        {
          echo '<div class="inputrow">';
        }
        echo '<div class="inputlabel">'.$array[$z]['label'].'</div>';
        if($array[$z]['tag']=='text')
        {
          if($error&&!$array_error[$z])
            echo '<input class="inputtext" placeholder="'.$array[$z]['input_placeholder'].'" name="'.$array[$z]['name'].'" autocomplete="off" value="'.$_POST[$array[$z]['name']].'">';
          else
          {
            if(isset($array[$z]['value'])&&!empty($array[$z]['value']))
              echo '<input class="inputtext" placeholder="'.$array[$z]['input_placeholder'].'" name="'.$array[$z]['name'].'" autocomplete="off" value="'.$array[$z]['value'].'">';
            else
              echo '<input class="inputtext" placeholder="'.$array[$z]['input_placeholder'].'" name="'.$array[$z]['name'].'" autocomplete="off">';
          }
        }
        elseif($array[$z]['tag']=='select')
        {
          echo '<select class="inputselect" name="'.$array[$z]['name'].'">';
          for($x=0;$x<count($array[$z]['options']);$x++)
          {
            if($x==0)
              echo '<option selected="selected" value="'.$array[$z]['options'][$x]['value'].'">'.$array[$z]['options'][$x]['display_value'].'</option>';
            else
              echo '<option value="'.$array[$z]['options'][$x]['value'].'">'.$array[$z]['options'][$x]['display_value'].'</option>';
          }
          echo '</select>';
          $array[$z]['options'];
        }
        echo '<div class="inputdesc" id="data-'.$z.'">'.$array[$z]['description'].'</div>';
        echo '</div>';
      }
    }
  }
  echo '</div>';
  echo '<input class="inputsubmit" type="submit" value="Submit form" name="submit-'.$id.'">';
  echo '</form>';
}
function generate_edit_form($main_id,$tableid,$array,$error,$array_error,$data)
{
  echo '<form action="http://localhost/view.php?edititem='.$main_id.'&table='.$tableid.'" method="post" id="input">';
  echo '<div class="containerobj">';
  for($z=0;$z<count($array);$z++)
  {
    if(isset($array[$z]['tag'])&&!empty($array[$z]['tag']))
    {
      if($array[$z]['tag']=='div')
      {
        echo '<div class="'.$array[$z]['class'].'">'.$array[$z]['value'].'</div>';
      }
      else
      {
        if($error&&$array_error[$z])
        {
          echo '<div class="inputrowerror">';
          echo '<div class="errormessage">'.$array_error[$z].'</div>';
        }
        else
        {
          echo '<div class="inputrow">';
        }
        echo '<div class="inputlabel">'.$array[$z]['label'].'</div>';
        if($array[$z]['tag']=='text')
        {
          if($error&&!$array_error[$z])
            echo '<input class="inputtext" placeholder="'.$array[$z]['input_placeholder'].'" name="'.$array[$z]['name'].'" autocomplete="off" value="'.$_POST[$array[$z]['name']].'">';
          else
            echo '<input class="inputtext" placeholder="'.$array[$z]['input_placeholder'].'" name="'.$array[$z]['name'].'" autocomplete="off" value="'.$data[0][$array[$z]['name']].'">';
        }
        elseif($array[$z]['tag']=='select')
        {
          echo '<select class="inputselect" name="'.$array[$z]['name'].'">';
          for($x=0;$x<count($array[$z]['options']);$x++)
          {
            if($array[$z]['options'][$x]['value']==$data[0][$array[$z]['name']])
              echo '<option selected="selected" value="'.$array[$z]['options'][$x]['value'].'">'.$array[$z]['options'][$x]['display_value'].'</option>';
            else
              echo '<option value="'.$array[$z]['options'][$x]['value'].'">'.$array[$z]['options'][$x]['display_value'].'</option>';
          }
          echo '</select>';
          $array[$z]['options'];
        }
        echo '<div class="inputdesc">'.$array[$z]['description'].'</div>';
        echo '</div>';
      }
    }
  }
  echo '</div>';
  echo '<input class="inputsubmit" type="submit" value="Update form" name="submit-'.$tableid.'">';
  echo '</form>';
}
function generate_view_form($main_id,$tableid,$array,$data)
{
  echo '<div class="viewermodulenav">';
  echo '<div class="viewermodulenavitemmain">Commands:</div>';

  $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
  $st=$db->prepare("SELECT * FROM `calibrations` WHERE id=$tableid");
  $st->execute();
  $t_sr=$st->fetchAll();

  echo '<a href="http://localhost/input.php?form='.$tableid.'" title="Create a new '.$t_sr[0]['name'].' calibration entry">';
    echo '<div class="viewermodulenavitem">New calibration entry</div>';
  echo '</a>';
  echo '<a href="http://localhost/view.php?edititem='.$main_id.'&table='.$tableid.'" title="Edit current calibration data">';
    echo '<div class="viewermodulenavitem">Edit current calibration</div>';
  echo '</a>';
  echo '<a href="http://localhost/view.php?removeitem='.$main_id.'&table='.$tableid.'" title="Delete current calibration data">';
    echo '<div class="viewermodulenavitemdelete">Delete current calibration</div>';
  echo '</a>';
  echo '</div>';
  echo '<table class="viewermodule" id="attach-'.$main_id.'">';
    echo '<thead>';
      echo '<tr>';
        echo '<th>Name</th>';

        if($t_sr[0]['format']=='Complex')
        {
          for($a=0;$a<$t_sr[0]['format_number'];$a++)
          {
            echo '<th>['.$a.'] Value</th>';
          }
        }
        else
        {
          echo '<th>Value</th>';
        }

        echo '<th>Description</th>';
      echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
      echo '<tr>';
        echo '<td>Calibration ID</td>';

        if($t_sr[0]['format']=='Complex')
        {
          for($x=0;$x<$t_sr[0]['format_number'];$x++)
          {
            echo '<td>';
              echo $data[0]['main_id'];
            echo '</td>';
          }
        }
        else
        {
          echo '<td>';
            echo $data[0]['main_id'];
          echo '</td>';
        }

        echo '<td>Auto generated ID of calibration</td>';
      echo '</tr>';

      echo '<tr>';
        echo '<td>';
          echo 'Calibration Name';
        echo '</td>';

        if($t_sr[0]['format']=='Complex')
        {
          for($x=0;$x<$t_sr[0]['format_number'];$x++)
          {
            echo '<td>';
              echo $t_sr[0]['name'];
            echo '</td>';
          }
        }
        else
        {
          echo '<td>';
            echo $t_sr[0]['name'];
          echo '</td>';
        }

        echo '<td>Name of the calibration sheet used</td>';
      echo '</tr>';

      for($z=0;$z<count($array);$z++)
      {
        if(isset($array[$z]['tag'])&&!empty($array[$z]['tag']))
        {
          if($array[$z]['tag']=='text')
          {
            echo '<tr id="'.$z.'">';
              echo '<td>'.$array[$z]['label'].'</td>';

              if(strpos($data[0][$array[$z]['name']],',')!==false)
              {
                if($t_sr[0]['format']=='Complex')
                {
                  $bits=explode(',',$data[0][$array[$z]['name']]);
                  for($x=0;$x<count($bits);$x++)
                  {
                    if(strpos($bits[$x],',')!==false)
                    {

                    }
                    else
                    {
                      echo '<td>';
                        echo '['.$x.'] = ';
                        echo ltrim(rtrim($bits[$x]));
                      echo '</td>';
                    }
                  }
                }
                else
                {
                  for($x=0;$x<$t_sr[0]['format_number'];$x++)
                  {
                    echo '<td>';
                      echo ltrim(rtrim($data[0][$array[$z]['name']]));
                    echo '</td>';
                  }
                }
              }
              else
              {
                for($x=0;$x<$t_sr[0]['format_number'];$x++)
                {
                  echo '<td>';
                    echo ltrim(rtrim($data[0][$array[$z]['name']]));
                  echo '</td>';
                }
              }

              echo '<td>'.$array[$z]['description'].'</td>';
            echo '</tr>';
          }
          elseif($array[$z]['tag']=='select')
          {
            echo '<tr id="'.$z.'">';
              echo '<td>';
                echo $array[$z]['label'];
              echo '</td>';
            echo '<td>';

            for($x=0;$x<count($array[$z]['options']);$x++)
            {
              if($array[$z]['options'][$x]['value']==$data[0][$array[$z]['name']])
              {
                echo $array[$z]['options'][$x]['value'];
              }
            }
            echo '</td>';
            echo '</td>';
          }
        }
      }

      echo '<tr>';
        echo '<td>Result</td>';

        if($t_sr[0]['format']=='Complex')
        {
          for($x=0;$x<$t_sr[0]['format_number'];$x++)
          {
            echo '<td>';

              if($data[0]['result'])
              {
                echo 'Passed';
              }
              else
              {
                echo 'Failed';
              }

            echo '</td>';
          }
        }
        else
        {
          echo '<td>';

            if($data[0]['result'])
            {
              echo 'Passed';
            }
            else
            {
              echo 'Failed';
            }

          echo '</td>';
        }

        echo '<td>If the calibration passed or failed</td>';
      echo '</tr>';
    echo '</tbody>';
  echo '</table>';
}
//START REQUIRED INTERNAL FUNCTIONS
function check_post_submit($input)
{
  if(isset($_POST[$input])&&!empty($_POST[$input]))
    return true;
  else
    return false;
}
function check_post($input)
{
  if(isset($_POST[$input])&&!empty($_POST[$input])||$_POST[$input]=="0")
    return true;
  else
    return false;
}
function check_post_array($array)
{
  for($z=0;$z<count($array);$z++)
  {
    if(isset($array[$z]['required'])&&!empty($array[$z]['required']))
    {
      if(!check_post($array[$z]['name']))
        return false;
    }
  }
  return true;
}
function check_get($input)
{
  if(isset($_GET[$input])&&!empty($_GET[$input]))
    return true;
  else
    return false;
}
function find_post_error_array($array)
{
  $error_list=[];
  for($z=0;$z<count($array);$z++)
  {
    if(isset($array[$z]['required']))
    {
      if($array[$z]['required'])
      {
        if(!check_post($array[$z]['name'])&&$array[$z]['required'])
          $error_list[$z]=$array[$z]['name']." is not defined";
        else
          $error_list[$z]=0;
      }
      else
        $error_list[$z]=0;
    }
  }
  return $error_list;
}
//END REQUIRED INTERNAL FUNCTIONS
?>
