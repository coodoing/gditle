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
	
	/*
	 * input string
	 */
	protected $in;
	/*
	 * lexer input array 
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

		$start = $this->parsePrimary(0);
		$startMeta = new TokenMeta($start);
		$priority = $startMeta->getTokenPriority();
		//echo $startMeta->getTokenValue();		
		$this->parseExpression($priority, 1, $start);
	}

	/**
	 * primary parse expression 
	 * 
	 * @param string $maxPrecedence max priority util now, min_precedence
	 * @param integer $nextPos next tokens' position, lookahead-peek next token
	 * @param string $currentTok The current token element, lhs	  
	 */
	public function parseExpression($maxPrecedence, $nextPos, $currentTok = ''){
		$lhs = $currentTok;
		$lookahead = $this->parsePrimary($nextPos);
		$meta = new TokenMeta($lookahead);//$this->tokenMeta->getTokenMeta($lookahead);
		$precedence = $meta->getTokenPriority();
		echo (json_encode($lhs).'<br>');
		//assert(json_encode($meta->getTokenPriority()));
		//assert(0x10);
		if(!empty($meta)){
			while($precedence < $maxPrecedence){
				$varible = $lookahead;

				$rhs = $this->getAdvancedRightToken($nextPos+1);

				$lookahead = $this->parsePrimary($nextPos+2);
				$meta =  new TokenMeta($lookahead);

				if(!empty($meta)){
					while(){

					}
				}

			}
		}

		return $lhs;
	}

	protected function getAdvancedRightToken($nextPos){
		$rhs = $this->parsePrimary($nextPos);
		return $rhs;
	}

	protected function parsePrimary($i = 0){
		return $this->inArray[$i];
	}

	public function splitP(){

	}
}