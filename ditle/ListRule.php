<?php

/**
 * Display rule of paragraph
 */
class ListRule{
	
	/*
     * normal, numbering, bullet, stars, etc
	 */
	private $liName;

	/*
     * 0, 1, 2, 3, 
	 */
	private $liType;

	public function __construct($list){
		if(empty($list)){
			$liType = '0';
			$liName = 'normal';
			$this->liType = $liType;
			$this->liName = $liName;
		}else{
			//TODO

		}
		
	}
}