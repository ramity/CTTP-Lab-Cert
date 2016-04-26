<?php
//START DEFINED POST VARIABLES
require_once('C:/wamp/bend/pass.php');
require_once('C:/wamp/bend/modules/auth.php');
require_once('C:/wamp/bend/modules/protected.php');
require_once('C:/wamp/bend/modules/forms.php');
require_once('C:/wamp/bend/modules/input_functions.php');
//END DEFINED POST VARIABLES

foreach($form as $key=>$data)
{
  echo '<br><b>Form '.$key.'</b><br><br>';
  foreach($data as $key=>$data_a)
  {
    if(isset($data[$key]['sql'])&&!empty($data[$key]['sql']))
    {
      echo $data[$key]['sql'].',';
      echo '<br>';
    }
  }
}
