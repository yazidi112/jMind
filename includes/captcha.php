<?php
session_start();
header("Content-Type: image/png");

function random($car) {
	$string = "";
	$chaine = "abAcdefghijkl0mDSp8qrs4tuv7wx1y";
	srand((double)microtime()*1000000);
	for($i=0; $i<$car; $i++) {
		$string .= $chaine[rand()%strlen($chaine)];
	}

	 
	return $string;
}

$_SESSION['cnx']['captcha']=random(6);

$im = @imagecreate(110, 35)
    or die("Impossible d'initialiser la bibliothèque GD");
$background_color = imagecolorallocate($im, 0, 0, 0);
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 8, 8, 8,  $_SESSION['cnx']['captcha'], $text_color);
imagepng($im);
imagedestroy($im);
?>