<?php
$imagesDir = __DIR__.'BlockFromScratch/Icons/';
$content = file_get_contents($imagesDir.$_GET['requested']);
$content = base64_encode($content);

$data = "data:image/png;base64,{$content}";

header('Content-Type: image/png');
echo base64_decode($data);
?>