<?php
$im = imagecreatetruecolor(300, 150);
$black = imagecolorallocate($im, 0, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);

// Set the background to be white
imagefilledrectangle($im, 0, 0, 299, 299, $white);

// Path to our font file
$font = 'arial.ttf';

// First we create our bounding box for the first text
$bbox = imagettfbbox(15,0, $font,'Powered by PHP ' . phpversion());

print_r($bbox);
// This is our cordinates for X and Y
?>
