<?php

function getAngle($m, $h) {
	$baseAngle = (((12 - $h) * 5) + $m) * 6;
	if ($baseAngle > 360) $baseAngle -= 360;
	$offsetAngle = (($m / 60) * 5) * 6;
	$result = $baseAngle - $offsetAngle;
	echo "Base angle = ".$baseAngle."</br>";
	echo "Offset angle = ".$offsetAngle."</br>";
	echo "result = ".$result."</br>";
	return $result <= 180 ? abs($result) : abs(360 - $result);
}

$m = 51;
$h = 1;
echo "<b>refact h - $h, m - $m; deg = ".getAngle($m, $h)."</b></br>";

$m = 54;
$h = 2;
echo "<b>refact h - $h, m - $m; deg = ".getAngle($m, $h)."</b></br>";


for ($i = 0; $i <= 100; $i++) {
	$h = rand(1,12);
	$m = rand(0,60);
	echo "<b>h - $h, m - $m; deg = ".getAngle($m, $h)."</b></br>";
}

?>