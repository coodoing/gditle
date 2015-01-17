<?php

require_once 'ExprAST.php';
require_once 'TagExprAST.php';
require_once 'VariableExprAST.php';

class BinaryExprAST extends ExprAST{

	protected $startTag;
	protected $endTag;

	protected $vari;

	public function __construct($start, $var, $end){
		
		$this->startTag = $start;
		$this->vari = $var;
		$this->endTag = $end;
	}
	
}