<?php

class Lexer{

	const T_PARA = 'p';
	const T_BLOCK = 'block';
	const T_BOLD = 'b';
	const T_ITALIC = 'i';
	const T_UNDERLINE = 'un';
	const T_VARIABLE_ = 'var';
	protected $debug = false;

	/*
 	 * token identify numbering 
	 */
	protected $tokensNumber = array(
		'<p>' => '200',
		'</p>' => '201',
		'<block>' => '202',
		'</block>' => '203',
		'<b>' => '204',
		'</b>' => '205',
		'<i>' => '206',
		'</i>' => '207',
		'<un>' => '208',
		'</un>' => '209',
		);

	/*
	 * token pair
	 */
	protected $tokenPair = array(

		'<p>'=>'</p>',
		'<block>'=>'</block>',
		'<b>'=>'</b>',
		'<i>'=>'</i>',
		'<un>'=>'</un>',
		);

	/*
     * token priority
	 */
	protected $tokenPriority = array(

		T_PARA => 0x01,
		T_BLOCK => 0x10,
		T_BOLD => 0x20,
		T_ITALIC => 0x30,
		T_UNDERLINE => 0x40,
		T_VARIABLE_ => 0x50,
		);
	/*
     * supported token symbols
	 */
	protected $tokenSymbols = array(
		T_PARA,
		T_BLOCK,
		T_BOLD,
		T_ITALIC,
		T_UNDERLINE,
		);

	protected $startTag = '<';// <&lt;
	protected $endTag = '>'; // &gt;

	protected $input;
	protected $tokenMap = array();	

	public function __construct($in = ''){
		$this->input = $in;
	}

	protected function getTags(){
		return array_keys($this->tokensNumber);
	}

	protected function getNextToken(){
		return $this;
	}

	protected function tidy(){

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