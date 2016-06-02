<?php
//rgb(x,y,z)
for($z=0;$z<255;$z++)
{
  echo '<div style="float:left;width:425px">';
  for($y=0;$y<255;$y++)
  {
    echo '<div style="float:left;">';
    for($x=0;$x<255;$x++)
    {
      echo '<div style="width:25px;height:25px;float:left;background-color:rgb('.($x).','.($y).','.($z).')"></div>';
    }
    echo '</div>';
  }
  echo '</div>';
}
?>
