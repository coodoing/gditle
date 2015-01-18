<?php

require_once 'GDRender.php';


$render = new GDRender('<p>ABc<block style="font-style:italic">H</block></p>');
//echo $render->getInput();

$render = new GDRender('<p>ABc<block><i><un>H</un></i></block></p>');
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

header('Content-Type: image/jpeg');
$render = new GDRender();
$render->createImage('Testing code');