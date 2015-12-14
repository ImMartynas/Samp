<?php //laikas ant paveiksliuko
header("Content-type:image/png");
$image = imagecreatefrompng("2.png");
if (isset($_GET['user'])) {
$vartotojas=$_GET['user'];
}
$laikas = date("H:i:s");
$color = imagecolorallocate($image,149,184,41);
         imagestring($image, 35, 53, 9, "Vartotojo informacija: $vartotojas", $color);
		 imagestring($image, 20, 24, 19, "XP: 123", $color);
		 imagestring($image, 20, 23, 29, "Pinigai: 324", $color);		 //imagestring(paveiksliukas,tekstoDydis,X,Y,Tekstas,Spalva);
         imagepng($image);
         imagedestroy($image); ?>