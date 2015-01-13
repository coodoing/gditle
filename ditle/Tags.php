<?php

/*
 * supported parse tags right now
 */
class Tags{
	
	// unuse the css style attributes
	private $tags = array(
			'p'=>'paragraph',
			'block'=>'span',
			'b'=>'bold',
			'i'=>'italic',
			'un'=>'underline',

		);

    private $quotes = array(
        '"' => '"',
        "'" => "'",
        '(' => ')',
        '{' => '}',
        '[' => ']',
        '«' => '»',
        '»' => '«',
        '‹' => '›',
        '›' => '‹',
        '„' => '“',
        '‚' => '‘',
        '‘' => '’',
        '”' => '“',
    );

    private $attributes = array();

	public function __construct(){

	}

	public function getSupportTags(){
		return $this->tags;
	}

	public function getQuotes(){
		return $this->quotes;
	}
}