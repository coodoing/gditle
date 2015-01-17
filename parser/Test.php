<?php

require_once 'ASTParser.php';

$keywords = preg_split("/[\s,]+/", "hypertext language, programming");
//print_r($keywords);

$str = '<p>ABc<block><i>yuestg</i></block></p>';
$tokenMap = array(
	'dssd',
	'<p>',
	'Abc',
	'<block>',
	'readline_callback_handler_install(prompt, callback)',
	'</block>',
	'<block>',
	'terwyui',
	'</block>',
	'<block>',
	'iconv_strlen(str)',
	'</block>',
	'"cc"',
	'</p>',
	);

// right parse
// rec parse
$tokenMap = array(
	'<p>',
	//'pdesc',
	'<block>',
	'block_desc',
	'<b>',
	'u>u<LLLLL',
	'</b>',
	//'start',
	'</block>',
	'end',
	/*'<block>',
	'china',
	'</block>',
	'<un>',
	'beijing',
	'</un>',
	'p_end',*/
	'</p>'
	);
$parser = new ASTParser($str, $tokenMap);
//print_r($tokenMap);
$parser->astParse();

