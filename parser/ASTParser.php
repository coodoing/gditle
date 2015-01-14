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
	protected $tokens; 

	public function __construct($in = ''){
		$this->in = $in;
	}

	public function astParse(){
		$count = count($this->tokens);

	}

	public function splitP(){

	}
}