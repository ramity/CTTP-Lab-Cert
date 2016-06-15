<?php
require_once('bend/configmanager.php');
require_once('bend/pass.php');
require_once('bend/modules/auth.php');

if(isset($_POST['login_subm'])&&!empty($_POST['login_subm']))
{
  if(isset($_POST['login_name'])&&!empty($_POST['login_name']))
  {
    if(isset($_POST['login_pass'])&&!empty($_POST['login_pass']))
    {
      if(ctype_alnum($_POST['login_name']))
      {
        test_input();
      }
      else
        $lerror='Username contains illegal characters';
    }
    else
      $lerror='Password is undefined';
  }
  else
    $lerror='Username is undefined';
}
function test_input()
{
  try
  {
    $db=new PDO("mysql:host=localhost;dbname=auth",$GLOBALS['user'],$GLOBALS['pass']);
    $st=$db->prepare("SELECT * FROM users WHERE username=?");
    $st->execute(array($_POST['login_name']));
    $rs=$st->fetchAll();
    if(!empty($rs))
    {
      if(password_verify($_POST['login_pass'],$rs[0]['hash']))
      {
        setcookie('AUTH',$rs[0]['id'].'+'.$rs[0]['hash'],time()+(60*60*24*31),'/','',0,1);

        header('Location: index.php');
        exit;
      }
      else
      {
        $lerror='Username/Password combination is incorrect';
      }
    }
    else
    {
      $lerror='Username/Password combination is incorrect';
    }
  }
  catch(PDOException $e)
  {
    echo $e->getMessage();
  }
}
?>
<!DOCTYPE>
<html>
  <head>
      <title>CTTP Calibration Application</title>
      <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
      <link rel="stylesheet" type="text/css" href="css/main.css">
  </head>
  <body>
    <?php require_once('bend/blocks/sidebar.php');?>
    <?php require_once('bend/blocks/banner.php');?>
    <div id="container">
      <div id="containerinr">
        <div class="containerobj">
          <form action="login.php" method="post" id="login">
            <input type="text" class="logininput" name="login_name" placeholder="Username" autocomplete="off">
            <input type="password" class="logininput" name="login_pass" placeholder="Password">
            <div class="loginrow">
              <input type="checkbox" name="login_cbox"> Remember me
            </div>
            <input type="submit" class="loginsubmit" name="login_subm">
          </form>
          <?php
          if(isset($lerror)&&!empty($lerror))
          {
            $lerror;
          }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
