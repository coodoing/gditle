<?php

require_once 'TokensAttribute.php';

class Lexer{

	/*
 	 * lex tag 
 	 */
	protected $startTag = '<';// <&lt;
	protected $endTag = '>'; // &gt;

	/*
	 * debug or not
	 */
	protected $debug = false;
	/*
	 * strict 
	 */
	protected $strictMode = false;
	/*
	 * tidify the output or not
	 * before or after the lex function ??
	 */	
	protected $tidify = false;

	protected $input;
	protected $tokenMap = array();	

	public function __construct($in = ''){
		$this->input = $in;
	}

	protected function getTags(){
		return array_keys(TokensAttribute::$tokensNumber);
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
		$tagToken = $this->getTags();

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