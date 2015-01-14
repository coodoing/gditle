<?php

require_once 'Lexer.php';

$str = '<p>ABc<block><i>yuestg</i></block></p>';
$temp = '<p><pasdga<b<b><un>sdg>ftftft<china>TRRd<i>435325</i></un></b><block>asdg</block>';//'<p><psdgasFFF';
$lexer = new Lexer($temp);

$keywords = preg_split("/[\s,]+/", "hypertext language, programming");
//print_r($keywords);

$lexer->lex();