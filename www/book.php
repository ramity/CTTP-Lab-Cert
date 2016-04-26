<?php
require_once('C:/wamp/bend/pass.php');
require_once('C:/wamp/bend/modules/auth.php');
require_once('C:/wamp/bend/modules/protected.php');
require_once('C:/wamp/bend/modules/forms.php');
require_once('C:/wamp/bend/modules/input_functions.php');
?>
<!DOCTYPE>
<html>
  <head>
    <title>Demo</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="http://localhost/css/view.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/jq-2.2.0,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/t/dt/jq-2.2.0,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.11,af-2.1.1,b-1.1.2,b-colvis-1.1.2,b-flash-1.1.2,b-html5-1.1.2,b-print-1.1.2,cr-1.3.1,fc-3.2.1,fh-3.1.1,kt-2.1.1,r-2.0.2,rr-1.1.1,sc-1.4.1,se-1.1.2/datatables.min.js"></script>
  </head>
  <body>
    <?php require_once('C:/wamp/bend/blocks/banner.php');?>
    <div id="container">
      <div id="containerinr">
        <?php
        $db=new PDO("mysql:host=localhost;dbname=calibration_data",$GLOBALS['user'],$GLOBALS['pass']);
        $st=$db->prepare("SELECT * FROM `main`");
        $st->execute();
        $sr=$st->fetchAll();

        $pages=0;
        for($z=0;$z<count($sr);$z++)
        {
          $main_id=$sr[$z]['id'];
          $table_number=$sr[$z]['table_number'];
          $st=$db->prepare("SELECT id FROM `$table_number` WHERE main_id=$main_id AND display=1 AND result=1");
          $st->execute();
          $sra=$st->fetchAll();

          if(!empty($sra))
          {
            $pages++;
          }
        }

        echo '<div id="pages" style="width:'.(1440*($pages)).'px;position:relative">';

        for($z=0;$z<=$pages;$z++)
        {
          $main_id=$sr[$z]['id'];
          $table_number=$sr[$z]['table_number'];
          $st=$db->prepare("SELECT * FROM `$table_number` WHERE main_id=$main_id AND display=1 AND result=1");
          $st->execute();
          $sra=$st->fetchAll();

          if(!empty($sra))
          {
            $st=$db->prepare("SELECT * FROM `calibrations` WHERE id=$table_number");
            $st->execute();
            $t_sr=$st->fetchAll();
            echo '<div class="page" id="page-id-'.$z.'">';
            echo "<script>$(document).ready(function()
            {
              $('#attach-".$main_id."').DataTable({
                'bSort': false,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                pageLength: 17
              });
            });</script>";
            echo '<style>div#attach-'.$main_id.'_wrapper{width:100%;margin-bottom:10px;}</style>';
            generate_view_form($main_id,$table_number,$form[$table_number],$sra);
            echo '</div>';
          }
        }
        echo '</div>';
        echo '<script>
        window.current_page=0;
        $(window).load(function(){
          $("div#toolbarpagenumber").text((current_page+1)+" / "+'.$pages.');
        });
        window.onkeydown=function(e)
        {
          var code = e.keyCode ? e.keyCode : e.which;
          if(code===37)
            page_left();
          if(code===39)
            page_right();
        }
        function page_left()
        {
          if(current_page>=1)
          {
            current_page--;
            $("div#pages").stop().animate({right:(current_page*1440)+"px"},750);
            $("div#toolbarpagenumber").text((current_page+1)+" / "+'.$pages.');
          }
        }
        function page_right()
        {
          if(current_page<'.($pages-1).')
          {
            current_page++;
            $("div#pages").stop().animate({right:(current_page*1440)+"px"},750);
            $("div#toolbarpagenumber").text((current_page+1)+" / "+'.$pages.');
          }
        }
        </script>';
        ?>
      </div>
    </div>
    <div id="toolbarpagenumber"></div>
    <div id="toolbarnavleft"><</div>
    <div id="toolbarnavright">></div>
    <script>
    $('div#toolbarnavleft').click(function(){
      page_left();
    });
    $('div#toolbarnavright').click(function(){
      page_right();
    });
    </script>
  </body>
</html>
