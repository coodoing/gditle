<?php

use tidyNode;
use tidy;

class DOMParser{
	
	protected $node;

	protected $dom;

	public function __construct($string){
		$this->dom = $string;

		if(function_exists('tidy_parse)string')){
			exit;
		}else{

		}
	}

	public function __destruct(){

	}

	public function find(){

	}

	/**
	 * parse the 
	 */
	public function parse($string){
		$string = $this->tidify($string);

		$tidy = new tidy();
		$tidy->parseString($string, array(), 'utf8');
		$this->dom = $tidy->html();
	}

	protected function tidify($string){		
		$string = preg_replace('~<!\[CDATA\[(.*?)\]\]>~is', '', $string);
        $string = preg_replace('~<!--(.*?)-->~is', '', $string);
        $string = preg_replace('~<!DOCTYPE.*?>~is', '', $string);
        return $string;
	}

	/**
	 * parse the selectors
	 * 
	 */
	protected function parseSelectors(){

	}
}