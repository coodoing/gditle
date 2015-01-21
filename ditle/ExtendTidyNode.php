<?php

require_once 'Rule.php';

/**
 * Extended TidyNode 
 */
class ExtendTidyNode{
	
	protected $rule;

	protected $node;

	protected $level;

	protected $md5Hash;

	protected $type;

	public function __construct($_rule, $_node, $_level, $_md5, $_type){
		$this->rule = $_rule;
		$this->node = $_node;
		$this->level = $_level;
		$this->md5Hash = $_md5;
		$this->type = $_type;
	}

	public function getExtNode(){
		return $this;
	}

	public function getBaseNode(){
		return $this->node;
	}
	
	
}