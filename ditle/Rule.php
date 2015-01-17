<?php

require_once 'FontRule.php';
require_once 'PositionRule.php';
require_once 'ListRule.php';

/** 
 * Base rule class which contains the basic rule provided 
 */
class Rule{

	protected $fontRule;

	protected $positionRule;

	protected $listRule;

	public function __construct($font = null, $pos = null, $list = null){
		
		$this->fontRule = $font; //new FontRule($font);
		$this->positionRule = $pos; //new PositionRule($pos);
		$this->fontRule = $list; //new ListRule($list);
	}

	public function getFontRule(){
		return $this->fontRule;
	}	

	public function getPositionRule(){
		return $this->positionRule;
	}

	public function getListRule(){
		return $this->listRule;
	}
}