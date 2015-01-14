<?php

require_once 'ExprAST.php';
require_once '../ditle/DVariable.php';

class VariableExprAST extends ExprAST{
	
	protected $varible;

	public function __construct(){
		$this->varible = new DVarible;
	}

	public function getVarible(){
		return $this->varible;
	}

}