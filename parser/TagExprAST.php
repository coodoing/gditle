<?php

require_once 'ExprAST.php';
require_once '../ditle/DVariable.php';

class TagExprAST extends ExprAST{
	
	protected $tag;

	protected $tagValue;

	protected $tagStyle;

	public function __construct($tag, $tagValue, $tagStyle){
		$this->tag = $tag;
		$this->tagValue = $tagValue;
		$this->tagStyle = $tagStyle;
	}
}