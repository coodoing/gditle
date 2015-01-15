<?php

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
	 * '<p>' 
	 */
	protected $tokenValue; 
	/*
	 * used for binary expression ( tag or varible)
	 * tag
	 */
	protected $tokenGroup; 
	/*
	 * token priority
	 */
	protected $tokenPriority; 

	public function __construct($tokenSymbol, $tokenTag, $tokenValue, $tokenGroup, $tokenPriority){
		$this->tokenSymbol = $tokenSymbol;
		$this->tokenTag = $tokenTag;
		$this->tokenValue = $tokenValue;
		$this->tokenGroup = $tokenGroup;
		$this->tokenPriority = $tokenPriority;
	}

	public function getTokenSymbol(){
		return $this->tokenSymbol;
	}

	public function getTokenTag(){
		return $this->tokenTag;	
	}

	public function getTokenValue(){
		return $this->tokenValue;
	}

	public function getTokenGroup(){
		return $this->tokenGroup;
	}

	public function getTokenPriority(){
		return $this->tokenPriority;
	}

	public function getTokenMeta(){
		return $this;
	}
}