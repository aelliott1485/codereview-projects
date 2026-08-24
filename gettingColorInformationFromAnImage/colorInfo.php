<?php
include 'Image.php';

$image = new Image('FGC.png');
$topThree = $image->getTop();
$image->showTop();
echo $image->getMostCommon();
echo '<pre>', print_r($topThree, true), '</pre>';
$image->showAll();