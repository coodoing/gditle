<?php

require_once 'Lexer.php';

$str = '<p>ABc<block><i>yuestg</i></block></p>';
$temp = '<p><block style="font-size="12px""><pasdga<b<b><un>sdg>ftftft<china>TRRd<i>435325</i></un></b><block>asdg</block></block></p>';//'<p><psdgasFFF';
$temp = '<p>Abc<block>readline_callback_handler_install(prompt, callback)</block><block>terwyui</block><block>iconv_strlen(str)</block>"cc"</p>';

$temp = '<p style="asd">objext</p>';

$p_tag = 'p';

preg_match("/^<(\/)?$p_tag(\w)*>/",'<p style="asdg">',$matches);
print_r($matches);
$lexer = new Lexer($temp);

//$keywords = preg_split("/[\s,]+/", "hypertext language, programming");
//print_r($keywords);

$lexer->lex();