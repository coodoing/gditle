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

	public function getFont(){
		return $this;
	}

}