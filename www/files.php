<?php
require_once('C:/wamp/www/bend/modules/auth.php');
require_once('C:/wamp/www/bend/modules/protected.php');

if(isset($_GET['b'])&&!empty($_GET['b']))
{
    $fileurl="C:/wamp/www/bend/file_storage/".html_entity_decode($_GET['b'])."/";
    $addb=false;
}
else
{
    $fileurl="C:/wamp/www/bend/file_storage/";
    $addb=true;
}
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
                    <form action="http://localhost/view.php" method="get" id="viewsearch">
                        <input type="text" class="viewsearch" placeholder="Currently not implemented" name="b_search" disabled>
                        <input type="submit" class="viewsubmit" name="viewsubmit" disabled>
                    </form>
                </div>
                <div class="containerobj">
                    <div class="containerlist">
                        <div class="containerlistheader">
                            <div class="containerlistitemname">File name</div>
                            <div class="containerlistitemdesc">Description</div>
                            <div class="containerlistitemdate">Last edited</div>
                        </div>
                        <?php
                        $o=scandir($fileurl);
                        foreach($o as &$oitem)
                        {
                            if(is_dir("$fileurl$oitem")&&$oitem!=='.'&&$oitem!=='..')
                            {
                                echo '<a href="';
                                echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                                if($addb)
                                    echo '?b=';
                                else
                                    echo '/';
                                echo htmlentities($oitem);
                                echo '">';
                            }
                            echo '<div class="containerlistrow">';
                            echo '<div class="containerlistitemname">'.$oitem.'</div>';
                            if(is_dir("$fileurl$oitem"))
                                echo '<div class="containerlistitemdesc">Directory</div>';
                            else
                            {
                                if(strpos($oitem,'.'))
                                {
                                    $bits=explode('.',$oitem);
                                    echo '<div class="containerlistitemdesc">.'.$bits[1].' file</div>';
                                }
                                else
                                {
                                    echo '<div class="containerlistitemdesc">file</div>';
                                }
                            }
                            echo '<div class="containerlistitemdate">';
                            echo gmdate("m-d-Y H:i:s",filemtime("$fileurl$oitem"));
                            echo '</div>';
                            echo '</div>';
                            if(is_dir("$fileurl$oitem"))if(is_dir("$fileurl$oitem")&&$oitem!=='.'&&$oitem!=='..')
                            {
                                echo '</a>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
