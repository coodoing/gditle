<?php

require_once 'FontRule.php';

class DVariable{
	private $vari;

	private $font;

	public function __construct($vari){
		$this->vari = $vari;
		$font = new FontRule;
	}
	
	public function __toString(){
		
	}

	public function toJson(){
		return json_encode($this);
	}
}