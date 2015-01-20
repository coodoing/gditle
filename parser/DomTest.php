<?php

require_once 'DOMParser.php';

$str = '<p class="blanket" id="pid">start<span lang="en">mmm</span>end</p>';
$style = 'p.blanket span';

$parser = new DOMParser($str);
$parser->find($style);

$selector = $parser->parseSelectors('p');
$selector = $parser->parseSelectors('p#pid'); //match wrong id='p++'
$selector = $parser->parseSelectors('p.blank');
$selector = $parser->parseSelectors('*[lang="en"]');
$selector = $parser->parseSelectors('span[lang]');
$selector = $parser->parseSelectors('span[lang="en"]');
$selector = $parser->parseSelectors('span[lang~="en"]');
$selector = $parser->parseSelectors('span[lang|="en"]');
$selector = $parser->parseSelectors('span[lang^="en"]');
$selector = $parser->parseSelectors('span[lang$="en"]');
$selector = $parser->parseSelectors('span[lang*="en"]');
$selector = $parser->parseSelectors('![lang]');
$selector = $parser->parseSelectors('[style=*]');
$selector = $parser->parseSelectors('span[style=*]');

$selector = $parser->parseSelectors('p+span[lang="en"]');
$selector = $parser->parseSelectors('a[href], ul[class]');