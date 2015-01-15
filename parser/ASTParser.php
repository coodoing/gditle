<?php

require_once 'BinaryExprAST.php';
require_once 'TagExprAST.php';
require_once 'VariableExprAST.php';
require_once '../lexer/TokenMeta.php';
require_once '../lexer/TokensAttribute.php';

/*
 * http://llvm-tutorial-cn.readthedocs.org/en/latest/chapter-2.html
 */
class ASTParser{
	
	protected $in;
	/*
	 * include by 
	 */
	protected $inArray; 

	protected $tokenMeta;

	public function __construct($in = '', $inArray = array()){
		$this->in = $in;
		$this->inArray = $inArray;
		//$this->tokenMeta = new TokenMeta();
	}

	/*
	 * operator-precedence parser 
	 */
	public function astParse(){

		$start = $this->parsePrimary($this->inArray, 0);
		$startMeta = new TokenMeta($start);
		$priority = $startMeta->getTokenPriority();
		//echo $startMeta->getTokenValue();		
		$this->parseExpression($priority, $start, 1);
	}

	/**
	 * primary parse expression 
	 * 
	 * @param string $minPrecedence min priority util now, min_precedence
	 * @param integer $nextPos next tokens' position, lookahead-peek next token
	 * @param string $currentToken The current token element, lhs	  
	 */
	public function parseExpression($minPrecedence, $nextPos, $currentToken = ''){
		$nextTok = $this->parsePrimary($this->inArray, $nextPos);
		$meta = new TokenMeta($nextTok);//$this->tokenMeta->getTokenMeta($nextTok);
		$nextPriority = $meta->getTokenPriority();
		//assert(json_encode($nextTok));
		//assert(json_encode($meta->getTokenPriority()));
		//assert(0x10);
		if(!empty($meta)){
			while($nextPriority>=$minPrecedence){
				$varible = $nextTok;

				
			}
		}
	}

	protected function parsePrimary($arr = array(), $i = 0){
		return $arr[$i];
	}

	public function splitP(){

	}
}