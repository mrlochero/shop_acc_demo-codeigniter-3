<?php
$dir    = 'tmp/';
$files1 = scandir($dir);

foreach($files1 as $row) 
{
$filename=$dir.$row;
$img = imagecreatefromjpeg($filename);
header("Content-Type: image/jpeg");
imagejpeg($img, $filename, 50);

}
?>