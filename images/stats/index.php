<?php 

session_start();

header('Content-type: image/gif');
$image = '<img src="/web/wb/template/images/logo.png" alt="captcha"/>'; //Paveiksliuko fonas


$font = 'MyriadPro.ttf';
imagecolorallocate($image,255,255,255);
$a=0;

for($i=0; $i < 7; $i++) {
$arr[$i] = substr($kod,$i,1);
$color=imagecolorallocate($image,129,129,129);
imagettftext('<img src="/web/wb/template/images/logo.png" alt="captcha"/>', 15, rand(10,-9), $a+=13, rand(20,25), $color, $font, "lol");
}
imagegif('<img src="/web/wb/template/images/logo.png" alt="captcha"/>');
imagedestroy('<img src="/web/wb/template/images/logo.png" alt="captcha"/>'); 


?>