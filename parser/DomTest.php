<?php

require_once 'DOMParser.php';

//$str = '<p class="blank">test<span>mmm</span>block</p> <p> second </p>';
$str = '<p class="blank">test<span lang="en-us">mmm</span>block</p>';
$parser = new DOMParser($str);

$selector = $parser->parseSelectors('p#blank p');
//$selector = $parser->parseSelectors('span[lang="en-us"]');
//$selector = $parser->parseSelectors('p+span[lang="en-us"]');

$element = $parser->getAttributeByName('p');