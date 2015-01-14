<?php

require_once 'ASTParser.php';

$str = '<p>ABc<block><i>yuestg</i></block></p>';
$parser = new ASTParser($str);

$keywords = preg_split("/[\s,]+/", "hypertext language, programming");
print_r($keywords);

$block = preg_split('/<block>+/',$str);
//var_dump($block);

$tokenMap = array(
	'<p>',
	'Abc',
	'<block>',
	'<i>',
	'efgF',
	'</i>',
	'</block>',
	'""',
	'</p>',
	);

