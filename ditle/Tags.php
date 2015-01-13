<?php

/*
 * supported parse tags right now
 */
class Tags{

	/**
     * Matched open and closed quotes.
     *
     * @var array
     */
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

    /**
     * used tags without the css style attributes.
     *
     * @var array
     */
    // 
	private $tags = array(
			'p'=>'paragraph',
			'block'=>'span',
			'b'=>'bold',
			'i'=>'italic',
			'un'=>'underline',
			
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