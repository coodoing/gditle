<?php

require_once 'Config.php';
require_once 'GDParser.php';
require_once 'TagGenerator.php';

echo 'test <br>';

$parser = new GDParser('input');
echo $parser->getInput();

$parser = new GDParser('<p>ABc<block style="font-style:italic">H</block></p>');
echo $parser->getInput();
echo $parser->getOutput();

$img = new TagGenerator('img');
$img->src('../img/bold.png')->alt('Example image');
echo (string) $img;

$parser = new GDParser('<p>ABc<block><i><un>H</un></i></block></p>');
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

