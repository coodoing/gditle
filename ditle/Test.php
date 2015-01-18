<?php

require_once 'Config.php';
require_once 'TagGenerator.php';

$img = new TagGenerator('img');
$img->src('../img/bold.png')->alt('Example image');
echo (string) $img;



