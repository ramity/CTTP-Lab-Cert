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
  echo '<b>Form '.$key.'</b><br><br>';
  echo 'CREATE TABLE IF NOT EXISTS`'.$key.'`<br>';
  echo '(<br>';
  echo '`id` int(11) NOT NULL AUTO_INCREMENT,<br>';
  echo '`main_id` int(11) NOT NULL,<br>';
  foreach($data as $key_a=>$data_a)
  {
    if(isset($data[$key_a]['sql'])&&!empty($data[$key_a]['sql']))
    {
      echo $data[$key_a]['sql'].',';
      echo '<br>';
    }
  }
  echo '`result` int(1) NOT NULL,<br>';
  echo "`display` int(1) NOT NULL DEFAULT '1',<br>";
  echo 'PRIMARY KEY (`id`)<br>';
  echo ');<br>';
  echo '<br>';
}
