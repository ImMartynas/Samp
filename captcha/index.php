<?php 

session_start();

header('Content-type: image/gif');
$image = imagecreate(125,30); //Paveiksliuko fonas

$kod = '0123456789aAbBcCdDeEfFgGhHiIjJkKmlLmMnNoOpPrRsStTuUvVzZxX';
$kod = str_shuffle($kod);
$kod = substr($kod,0,7);
$_SESSION["kod"] = $kod;

$font = '5667.ttf';
imagecolorallocate($image,255,255,255);
$a=0;

for($i=0; $i < 7; $i++) {
$arr[$i] = substr($kod,$i,1);
$color=imagecolorallocate($image,129,129,129);
imagettftext($image, 15, rand(10,-9), $a+=13, rand(20,25), $color, $font, $arr[$i]);
}
imagegif($image);
imagedestroy($image); 


?>