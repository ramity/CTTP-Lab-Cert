<?php
$font = 'C:/wamp/www/font/arial.ttf';

echo '<style>@font-face {
    font-family: myFirstFont;
    src: url(http://localhost/font/Arial.ttf);
}</style>';

$box = imagettfbbox(15,0,$font,'Something works and stuff');

echo '<div style="font-family:myFirstFont;font-size:15px;float:left;">Something works and stuff</div>';

echo $text_width = $box[0] + $box[2];

print_r($box);
?>
