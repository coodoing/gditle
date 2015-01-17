<?php

require_once 'Rule.php';
require_once 'FontRule.php';

class DVariable{

	private $vari;

	private $fontRule;

	public function __construct($vari, $fontRule = null){
		$this->vari = $vari;
		$this->fontRule = $fontRule;
	}
	
	public function __toString(){
		
	}

	public function toJson(){
		return json_encode($this);
	}
}