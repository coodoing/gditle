<?php

class Char{
	private $char;

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
			$fontColor = $defaultChar['fontColor'];
			$fontSize = $defaultChar['fontSize'];
			$fontAngle = $defaultChar['fontAngle'];
			$fontFamily = $defaultChar['fontFamily'];

			$fontBold = $defaultChar['fontBold'];
			$fontItalic = $defaultChar['fontItalic'];
			$fontUnderline = $defaultChar['fontUnderline'];
		}else{

		}
	}

	public function toJson(){
		return json_encode($this);
	}
}