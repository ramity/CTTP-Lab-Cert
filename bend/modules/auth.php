<?php
$secure_auth=false;
$secure_username;
require_once('C:/wamp/bend/pass.php');
if(isset($_COOKIE['AUTH'])&&!empty($_COOKIE['AUTH']))
{
    try
    {
        $db=new PDO("mysql:host=localhost;dbname=auth",$GLOBALS['user'],$GLOBALS['pass']);
        $st=$db->prepare("SELECT * FROM users WHERE id=? AND hash=?");
        $bits=explode('+',$_COOKIE['AUTH']);
        $afix=str_replace('%24','$',$bits[1]);
        $bfix=str_replace('%2F','/',$afix);
        $st->execute(array($bits[0],$bfix));
        $rs=$st->fetchAll();
        if(!empty($rs))
        {
            $secure_auth=true;
            $secure_username=$rs[0]['username'];
        }
        else
        {
            $secure_auth=false;
            unset($_COOKIE['AUTH']);
            setcookie('AUTH',null,-1,'/');
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
?>
