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

	public function __construct($font, $pos, $list){
		
		$this->fontRule = new FontRule($font);
		$this->positionRule = new PositionRule($pos);
		$this->fontRule = new ListRule($list);
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