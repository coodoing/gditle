<?php

require_once 'GDRender.php';

$parser = new GDRender('input');
echo $parser->getInput();

$parser = new GDRender('<p>ABc<block style="font-style:italic">H</block></p>');
echo $parser->getInput();
echo $parser->getOutput();

$parser = new GDRender('<p>ABc<block><i><un>H</un></i></block></p>');
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