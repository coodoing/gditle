<?php

require_once 'ExprAST.php';
require_once 'TagExprAST.php';
require_once 'VariableExprAST.php';
require_once 'BlockExprAST.php';

/**
 * Use the block-expr-ast to replace the combination array of lhs-expr-ast, binary-expr-ast, $rhs-expr-ast
 * bc. 
 * $lhs = new VaribleExprAST(..)
 * $bin = new BinaryExprAST(..)
 * $lhs = new VaribleExprAST(..)
 *
 * $combinationArray = array($lhs, $bin, $rhs);
 * 
 * $block = new BlockExprAST($lhs, $bin, $rhs);
 */
class BlockExprAST extends ExprAST{

	protected $lhsVar;
	protected $binary;
	protected $rhsVar;

	public function __construct($lhs, $bin, $rhs){
		$this->lhsVar = $lhs;
		$this->binary = $bin;
		$this->rhsVar = $rhs;
	}
}