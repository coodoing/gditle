<?php

require_once 'DOMParser.php';

$str = '<p class="blanket" id="p++">start<span lang="en">mmm</span>end</p>';
$selector = 'p.blanket span';

$parser = new DOMParser($str);
//$selector = $parser->parseSelectors('p#blank p');
$selector = $parser->parseSelectors('span[lang="en"]');
//$selector = $parser->parseSelectors('p+span[lang="en"]');
//$selector = $parser->parseSelectors('a[href], ul[class]');

//$selector = $parser->parseSelectors($selector);

$parser->find($selector);