<?php

/*
 display format of paragraph
*/
class PgDisplay{
	
	/*
     * normal, numbering, bullet, stars, etc
	 */
	private $pdName;

	/*
     * 0, 1, 2, 3, 
	 */
	private $pdType;

	public function __construct($pdType = '0', $pdName = 'normal'){

		$this->pdType = $pdType;
		$this->pdName = $pdName;
	}
}