<?php

class Module{
	
	private $mID;
	private $mName;
	private $mType;

	private $paragraphs;

	private $modules = array(
			'textfield'=>'m_txt_field',
			'image'=>'m_img',
			// ....
		);

	public function __construct($mname='textfiled', $mtype='0', $ps = array()){
		$this->mID = uniqid(rand());

		$this->mName = $mname;
		$this->mType = $mtype;
		$this->paragraphs = $ps;
	}

	

}