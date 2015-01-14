<?php

class DVariable{
	private $vari;

	private $font;

	public function __construct($vari){
		$this->vari = $vari;
		$font = new Font;
	}
	
	public function __toString(){
		
	}

	public function toJson(){
		return json_encode($this);
	}
}