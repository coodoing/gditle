<?php

use tidyNode;
use tidy;

class DOMParser{
	
	/**
	 * instance of domnode
	 */
	protected $node;

	/**
	 * instance of dom
	 */
	protected $dom;

	public function __construct($string){

		if(!function_exists('tidy_parse_string')){
			exit('tidy module not exist');
		}else{
			$this->dom = $this->parse($string);
		}
	}

	public function __destruct(){

	}

	public function find(){

	}

	public function getElement(){
		
	}

	/**
	 * use tidy to parse string 
	 */
	public function parse($string){
		$string = $this->preParse($string);

		$tidy = new tidy();
		$tidy->parseString($string, array(), 'utf8');
		$this->dom = $tidy->body();

		$this->dom = $this->postParse($this->dom);

		print_r($this->dom);
	}

	protected function preParse($string){
		$string = $this->tidify($string);
		return $string;
	}

	protected function postParse($dom){
		return $dom;
	}

	/**
	 * tidify the input string to remove the noise tag as script, style, comment etc
	 *
	 */
	protected function tidify($string){		

		$string = preg_replace('~<!\[CDATA\[(.*?)\]\]>~is', '', $string);
        $string = preg_replace('~<!--(.*?)-->~is', '', $string);
        $string = preg_replace('~<!DOCTYPE.*?>~is', '', $string);
        $string = preg_replace("'<\s*script[^>]*[^/]>(.*?)<\s*/\s*script\s*>'is", '', $string);
        $string = preg_replace("'<\s*script\s*>(.*?)<\s*/\s*script\s*>'is", '', $string);
        $string = preg_replace("'<\s*style[^>]*[^/]>(.*?)<\s*/\s*style\s*>'is", '', $string);
        $string = preg_replace("'<\s*style\s*>(.*?)<\s*/\s*style\s*>'is", '', $string);

        return $string;
	}

	/**
	 * parse the selectors
	 * same as simple_html_dom.php
	 */
	protected function parseSelectors($selector){
		
		// pattern of CSS selectors, modified from mootools
		$pattern = "/([\w-:\*]*)(?:\#([\w-]+)|\.([\w-]+))?(?:\[@?(!?[\w-:]+)(?:([!*^$]?=)[\"']?(.*?)[\"']?)?\])?([\/, ]+)/is";
		preg_match_all($pattern, trim($selector).' ', $matches, PREG_SET_ORDER);

		$selectors = array ();
		$result = array ();

		var_dump($matches);

		foreach ( $matches as $m ) {
			$m [0] = trim ( $m [0] );
			if ($m [0] === '' || $m [0] === '/' || $m [0] === '//')
				continue;
			if ($m [1] === 'tbody')
				continue;
			list ( $tag, $key, $val, $exp, $no_key ) = array ($m [1], null, null, '=',false);
			if (! empty ( $m [2] )) {
				$key = 'id';
				$val = $m [2];
			}
			if (! empty ( $m [3] )) {
				$key = 'class';
				$val = $m [3];
			}
			if (! empty ( $m [4] )) {
				$key = $m [4];
			}
			if (! empty ( $m [5] )) {
				$exp = $m [5];
			}
			if (! empty ( $m [6] )) {
				$val = $m [6];
			}
			// convert to lowercase
			$tag = strtolower ( $tag );
			$key = strtolower ( $key );
			// elements that do NOT have the specified attribute
			if (isset ( $key [0] ) && $key [0] === '!') {
				$key = substr ( $key, 1 );
				$no_key = true;
			}
			$result [] = array ($tag, $key, $val, $exp, $no_key);
			if (trim ( $m [7] ) === ',') {
				$selectors [] = $result;
				$result = array ();
			}
		}
		if (count ( $result ) > 0){
			$selectors [] = $result;
		}
		return $selectors;
	}
}