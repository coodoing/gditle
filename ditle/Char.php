<?php

class Char{
	private $char;

	private $font;

	public function __construct($char){
		$this->char = $char;
		$font = new Font;
	}
	
	public function toJson(){
		return json_encode($this);
	}
}