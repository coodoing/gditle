<?php

class String{
	
	private $string;
	private $len;

	private $blocks;

	/*
     * default fonts
	 */
	private $font;

	public function __construct($string='', $len= 0, $blocks = array()){
		$this->string = $string;
		$this->len = $len;
		$this->blocks = $blocks;
	}
}