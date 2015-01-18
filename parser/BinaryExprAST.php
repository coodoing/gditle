<?php

require_once 'ExprAST.php';
require_once 'TagExprAST.php';
require_once 'VariableExprAST.php';
require_once 'BlockExprAST.php';

class BinaryExprAST extends ExprAST{

	protected $startTag;

	protected $block;

	protected $endTag;	

	/*protected $vari;
	protected $nextBinary;*/
	public function __construct($start, $block, $end){		
		$this->startTag = $start;
		$this->block = $block;
		$this->endTag = $end;
	}	
}