<?php

class Position{
	
	/*
     * left, center, right
	 */
	private $posName;

	/*
     * 0, 1, 2, 
	 */
	private $posType;

	public function __construct($posType = '2', $posName = 'right'){

		$this->posType = $posType;
		$this->posName = $posName;
	}

}