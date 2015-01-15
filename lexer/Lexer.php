<?php

require_once 'TokensAttribute.php';

class Lexer{

	/*
 	 * token tag  
 	 */
	protected $startTag = '<';// <&lt;
	protected $endTag = '>'; // &gt;

	/*
	 * debug or not
	 */
	protected $debug = false;
	/*
	 * strict the input or not
	 * <p /> tag instead of <p>...</p>
	 * suggested setting true
	 */
	protected $strictMode = true;
	/*
	 * tidify the output or not
	 * <p> without the </p> tag
	 * before or after the lex procedure ??
	 * suggested setting true
	 */	
	protected $tidify = true;

	/*
	 * scan the empty token or not
	 * suggested setting true
	 */
	protected $empty = true;

	/*
	 * options of the lexer
	 */
	protected $option = array();

	protected $input;
	protected $tokenMap = array();	

	public function __construct($in = ''){
		$this->input = $in;
	}

	protected function getTokenTags(){
		//return array_keys(TokensAttribute::$tokensNumber);
		return TokensAttribute::$tokenTags;
	}

	protected function getNextToken(){
		return $this;
	}

	/*
	 * tidyify the input string to make sure the $tokenmap correct.
	 */
	public function tidy(){
		//TODO
		return $this;
	}

	/*
	 * convert the token to token meta-data
	 */
	public function tokenMetaState(){
		//TODO
		return $this;
	}

	public function lex(){
		$str = $this->input;
		$len = strlen($str);
		$tagToken = $this->getTokenTags();

		$charArr = ''; // variable queues
		$tagArr = ''; // tag queues

		for($i = 0; $i < $len; $i++){
			$s = ($str[$i]);			
			// start 
			//if(empty($charArr) && empty($tagArr)){
			if(empty($tagArr)){
				if($s == $this->startTag){
					$tagArr .= ($s);
				}else{
					$charArr .= ($s);
				}
				continue;
			}
			// 
			if(!empty($tagArr)){
				if($s == $this->startTag){
					$charArr .= $tagArr;
					$tagArr = $s;
				}elseif($s == $this->endTag){
					$tagArr .= $s; // <pxxx>
					if(in_array($tagArr, $tagToken)){
						// get the tag, be careful about the order		
						if(!empty($charArr))	{
							// token attribute
							$tmp = array($charArr,'T_VARIABLE_',0);
							array_push($this->tokenMap,htmlspecialchars($charArr));//;	
						}	
						$tmp = array($tagArr,"$tagArr",1);
						array_push($this->tokenMap,htmlspecialchars($tagArr));								
						$tagArr = '';
						$charArr = '';
					}else{
						$charArr .= $tagArr;
						$tagArr = '';
					}
				}else{
					$tagArr .= $s;
				}
				continue;
			}
			$charArr .= $s;			
		}
		// post handler
		if(!empty($charArr)){
			$tmp = array($charArr,'T_VARIABLE_',0);
			array_push($this->tokenMap,htmlspecialchars($charArr));
			$charArr = '';
		}

		if(!empty($tagArr)){
			$tmp = array($tagArr,"$tagArr",1);
			array_push($this->tokenMap,htmlspecialchars($tagArr));
			$tagArr = '';
		}

		print_r($this->tokenMap);
		return $this->tokenMap;
	}	
}