<?php

require_once 'TokensAttribute.php';

class TokenMeta{	
	/*
	 * T_BLOCK_SYMBOL, p
	 */
	protected $tokenSymbol; 
	/*
	 * T_BLOCK_START, <p>
	 */
	protected $tokenTag; 
	/*
	 * '<p style="color:0,100,200">' 
	 */
	protected $tokenValue; 
	/*
	 * used for binary expression ( tag or varible)
	 * 1 : tag
	 * 2 : variable
	 */
	protected $tokenGroup; 
	/*
	 * token priority
	 */
	protected $tokenPriority; 

	/*
	 * token position
	 */
	protected $tokenPos;

	/*
	 * function overloading unable in PHP
	 */
	public function __construct($token = '', $tokenSymbol='', $tokenTag='', $tokenValue='', $tokenGroup='', $tokenPriority=''){
		if(!empty($token)){
			$this->genTokenMetaFromToken($token);
		}else{
			$this->tokenSymbol = $tokenSymbol;
			$this->tokenTag = $tokenTag;
			$this->tokenValue = $tokenValue;
			$this->tokenGroup = $tokenGroup;
			$this->tokenPriority = $tokenPriority;
		}
	}

	public function setTokenSymbol($symbol){
		$this->tokenSymbol = $symbol;
		return $this;
	}

	public function getTokenSymbol(){
		return $this->tokenSymbol;
	}

	public function setTokenTag($tag){
		$this->tokenTag = $tag;
		return $this;
	}

	public function getTokenTag(){
		return $this->tokenTag;	
	}

	public function setTokenValue($value){
		$this->tokenValue = $value;
		return $this;
	}

	public function getTokenValue(){
		return $this->tokenValue;
	}

	public function setTokenGroup($group){
		$this->tokenGroup = $group;
		return $this;
	}

	public function getTokenGroup(){
		return $this->tokenGroup;
	}

	public function setTokenPriority($priority){
		$this->tokenPriority = $priority;
		return $this;
	}

	public function getTokenPriority(){
		return $this->tokenPriority;
	}

	public function setTokenPos($pos){
		$this->tokenPos = $pos;
		return $this;
	}

	public function getTokenPos(){
		return $this->pos;
	}

	public function getTokenMeta($token = array()){
		return $this;
	}

	protected function genTokenMetaFromToken($token = array()){
		//TODO
		$tokenTags = TokensAttribute::$tokenTags;
		if(in_array($token, $tokenTags)){
			$symbol = TokensAttribute::$tokenSymbolMap[$token];
			// preg_match
			$tag = $token;
			$value = $token;
			$group = 1;//TokensAttribute::$tokenGroup['tag'];
			$priority = TokensAttribute::$tokensPriority[$token];

			/*
			 * fluent interface
			 */
			$this->setTokenSymbol($symbol)->setTokenTag($tag)->setTokenValue($value)->setTokenGroup($group)->setTokenPriority($priority);
		}else{
			$symbol = TokensAttribute::T_VARIBLE_SYMBOL;
			$tag = $token;
			$value = $token;
			$group = 2;//TokensAttribute::$tokenGroup['var'];
			$priority = 0; // largest proirity

			/*
			 * fluent interface
			 */
			$this->setTokenSymbol($symbol)->setTokenTag($tag)->setTokenValue($value)->setTokenGroup($group)->setTokenPriority($priority);
		}
	}
}