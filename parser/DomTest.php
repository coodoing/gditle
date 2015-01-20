<?php

require_once 'DOMParser.php';

//$str = '<p class="blank">test<span>mmm</span>block</p> <p> second </p>';
$str = '<p class="blank" id="p++">start<span lang="en">mmm</span>end</p>';
$parser = new DOMParser($str);

$selector = $parser->parseSelectors('p#blank p');
//$selector = $parser->parseSelectors('span[lang="jp"]');
//$selector = $parser->parseSelectors('p+span[lang="en"]');
//$selector = $parser->parseSelectors('a[href], ul[class]');

$selector = $parser->parseSelectors('p#blank span');

//$element = $parser->getAttributeByName('p');

$dom = $parser->getDom();
//echo json_encode($dom);

$parser->find('');