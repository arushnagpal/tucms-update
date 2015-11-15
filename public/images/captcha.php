<?php

session_start();
$code = rand(1000, 9999);
$_SESSION["code"] = $code;
$im = imagecreatetruecolor(50, 24);
$bg = imagecolorallocate($im, 232, 153, 128); //<span class="typhnb365qz4" id="typhnb365qz4_7" style="height: 13px;">background color</span> blue
$fg = imagecolorallocate($im, 255, 255, 255); //<span class="typhnb365qz4" id="typhnb365qz4_4" style="height: 13px;">text color</span> white
imagefill($im, 0, 0, $bg);
imagestring($im, 5, 5, 5, $code, $fg);
header("Cache-Control: no-cache, must-revalidate");
header('Content-type: image/png');
imagepng($im);
imagedestroy($im);
?>