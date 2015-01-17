<?php

require_once 'ExprAST.php';
require_once '../ditle/DVariable.php';

class VariableExprAST extends ExprAST{
	
	protected $varible;

	public function __construct($var, $fontRule = null){
		$this->varible = new DVariable($var, $fontRule);
	}

	public function getVarible(){
		return $this->varible;
	}

}