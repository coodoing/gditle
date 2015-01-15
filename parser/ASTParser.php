<?php

require_once 'BinaryExprAST.php';
require_once 'TagExprAST.php';
require_once 'VariableExprAST.php';

/*
 * http://llvm-tutorial-cn.readthedocs.org/en/latest/chapter-2.html
 */
class ASTParser{
	
	protected $in;
	/*
	 * include by 
	 */
	protected $inArray; 

	public function __construct($in = '', $inArray = array()){
		$this->in = $in;
		$this->inArray = $inArray;
	}

	/*
	 * operator-precedence parser 
	 */
	public function astParse(){
		$count = count($this->inArray);
		echo $count;
		
		$start = $this->parsePrimary($this->inArray, 0);
		$this->parseExpression($start, 0, 1);
	}

	public function parseExpression($element, $precedence, $next){
		$tok = $this->inArray[$next];

	}

	public function getTokenDetail($to){
		$tokens = array_keys($this->tokensNumber);
		if(in_array($to, $tokens)){

		}
	}

	protected function parsePrimary($arr = array(), $i = 0){
		return $arr[$i];
	}

	public function splitP(){

	}
}