<?php

/**
 * A paragraph( or just a line) is the array of the strings
 *
 */
class DParagraph{
	
	/*
     * paragraph = string, string, string, ...
	 */
	private $pstrings; 

	/*
	 * paragraph = block , block , block, ...
	 */
	private $pblocks;

	private $plen;

	private $font;
	private $position;
	private $notelist;

	public function __construct($strings = array(), $blocks = array(), $len = 0 ){
		$this->pstrings = $strings;
		$this->pblocks = $blocks;
		$this->plen = $len;

		$this->strings = $strings;
		$this->strings = $strings;
		$this->strings = $strings;
	}
}