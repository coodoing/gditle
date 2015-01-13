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
	private $fontColor;
	private $fontSize;
	private $fontAngle;
	private $fontFamily;

	/*
	 * 0: normal, 1: bold
	 */
	private $fontBold;
	/*
	 * 0: normal, 1: italic
	 */
	private $fontItalic;
	/*
	 * 0: normal, 1: underline
	 */
	private $fontUnderline;

	/////////////////////////
	// ordered by priority
	/*
	 * bold, italic underline
	 * values : 000
	 */
	private $fonts;
	/*
	 * list number, dotted, stars
	 * values : 000
	 */
	private $paragraph;
	/*
	 * left, center, right
	 * values : 000
	 */
	private $position;	
	
	private $in;
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

	public function parse(){
		
	}

	public function render(){
		
	}

}