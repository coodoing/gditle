<?php

require_once 'ExprAST.php';
require_once '../ditle/DVariable.php';

class VariableExprAST extends ExprAST{
	
	protected $varible;

	public function __construct($var){
		$this->varible = new DVariable($var);
	}

	public function getVarible(){
		return $this->varible;
	}

}