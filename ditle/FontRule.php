<?php

require_once 'FontRule.php';
require_once 'Config.php';

/**
 * Font rule of the varible or block
 */
class FontRule{
	
	private $fontName;

	private $fontColor;
	private $fontSize;
	private $fontAngle;
	private $fontFamily;

	/**
	 * 0: normal, 1: bold
	 */
	private $fontBold;
	/**
	 * 0: normal, 1: italic
	 */
	private $fontItalic;
	/**
	 * 0: normal, 1: underline
	 */
	private $fontUnderline;

	public function __construct($font = array()){
		if(empty($font)){
			global $defaultChar;
			$this->fontColor = $defaultChar['fontColor'];
			$this->fontSize = $defaultChar['fontSize'];
			$this->fontAngle = $defaultChar['fontAngle'];
			$this->fontFamily = $defaultChar['fontFamily'];

			$this->fontBold = $defaultChar['fontBold'];
			$this->fontItalic = $defaultChar['fontItalic'];
			$this->fontUnderline = $defaultChar['fontUnderline'];
		}else{
			//TODO
			
		}
	}

	public function isFontBold(){
		return (boolean) $this->fontBold;
	}

	public function isFontItalic(){
		return (boolean) $this->fontItalic;
	}

	public function isFontUnderline(){
		return (boolean) $this->fontUnderline;
	}

	public function getFont(){
		return $this;
	}

	///////////////////// Fluent Interface
	public function setFontBold(){
		$this->fontBold = 1;
		return $this;
	}

	public function setFontItalic(){
		$this->fontBold = 1;
		return $this;
	}

	public function setFontUnderline(){
		$this->fontBold = 1;
		return $this;
	}

	public function getFontName(){
		return $this->fontName;
	}

	public function getFontColor(){
		return $this->fontColor;
	}

	public function getFontSize(){
		return $this->fontSize;
	}

	public function getFontAngle(){
		return $this->fontAngle;
	}

	public function getFontFamily(){
		return $this->fontFamily;
	}

	public function getFontBold(){
		return $this->fontBold;
	}

	public function getFontItalic(){
		return $this->fontItalic;
	}

	public function getFontUnderline(){
		return $this->fontFamily;
	}

	/**
	 * magic method of __toString()
	 */ 
	public function __toString(){
		echo 'font magic';
	}

}