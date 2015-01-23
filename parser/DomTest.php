<?php

require_once 'DOMParser.php';

$str = '<p class="blanket" id="pid">start<span lang="en">en</span><span country="uk">uk</span>end</p>';
$style = 'p.blanket';

$parser = new DOMParser($str);
$parser->find('span');
$parser->find('p#pid');
$parser->find('p.blanket');
$parser->find('span[lang=en]');

/*$selector = $parser->parseSelectors('p');
$selector = $parser->parseSelectors('p#pid'); //match errror id='p++'
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
$selector = $parser->parseSelectors('a[href], ul[class]');*/