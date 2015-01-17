<?php

require_once 'ExprAST.php';
require_once '../ditle/DVariable.php';

class TagExprAST extends ExprAST{
	
	
	protected $tagMeta;
	protected $tagRule;

	public function __construct($tagMeta, $tagRule = ''){
		$this->tagMeta = $tagMeta;
		$this->tagRule = $tagRule;
	}
}