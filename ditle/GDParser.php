<?php

class GDParser{
	
	/*
     * guid of the component
	 */
	private $guid;

	private $module;
	private $langs;
	private $zindex;
	
	private $imageWidth;
	private $imageHeight;

	/////////////////////////
	// ordered by priority
	/*
	 * bold, italic underline
	 * values : 000
	 */
	private $fontsRule;
	/*
	 * list number, dotted, stars
	 * values : 000
	 */
	private $listRule;
	/*
	 * left, center, right
	 * values : 000
	 */
	private $posRule;	
	
	/*
     * input string
	 */
	private $in;

	/*
     * output json_array
	 */
	private $out;

	public function __construct($in='', $out = array()){
		$this->in = $in;
	}

	public function getInput(){
		return $this->in;
	}

	public function getOutput(){
		return $this->out;
	}


	///////////////////////////////


	public function parse(){
		
	}

	public function render(){
		
	}

	public function tidy(){

	}

	public function setRistricted(){

	}
}