<?php
 $array=array(10,20,10,50,80,100,40,10);
 $count=count($array);
 $max=max($array);
 $line='';
 foreach($array as $x=>$y)
 {
  $line.="$x,$y ";
 }
 ?>
 <svg height="200px" width="200px" viewBox="0 0 <?=$count-1?> <?=$max?>" preserveAspectRatio="none">
  <polyline style="stroke:red;stroke-width:1px;" points="<?=trim($line)?>">
 </svg>
