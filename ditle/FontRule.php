<?php

require_once 'FontRule.php';

class FontRule{
	
	private $fontName;

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

	public function __construct(){
		if(!empty($defaultChar)){
			$this->fontColor = $defaultChar['fontColor'];
			$this->fontSize = $defaultChar['fontSize'];
			$this->fontAngle = $defaultChar['fontAngle'];
			$this->fontFamily = $defaultChar['fontFamily'];

			$this->fontBold = $defaultChar['fontBold'];
			$this->fontItalic = $defaultChar['fontItalic'];
			$this->fontUnderline = $defaultChar['fontUnderline'];
		}else{
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

	///////////////////
	// Fluent Interface

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

	// magic method of __toString()
	public function __toString(){
		echo 'font magic';
	}

}