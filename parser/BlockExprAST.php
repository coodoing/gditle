<?php

class BlockExprAST{

	protected $lhsVar;
	protected $binary;
	protected $rhsVar;

	public function __construct($lhs, $bin, $rhs){
		$this->lhsVar = $lhs;
		$this->binary = $bin;
		$this->rhsVar = $rhs;
	}

	
}