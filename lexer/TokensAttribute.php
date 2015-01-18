<?php

/**
  * common token attribute as priority, number , etc
  */
class TokensAttribute{	
	
	const T_PARA_SYMBOL = 'p';
	const T_BLOCK_SYMBOL = 'block';
	const T_BOLD_SYMBOL = 'b';
	const T_ITALIC_SYMBOL = 'i';
	const T_UNDERLINE_SYMBOL = 'un';
	const T_VARIBLE_SYMBOL = '__var__';

	const T_PARA_START = '<p>';
	const T_BLOCK_START = '<block>';
	const T_BOLD_START = '<b>';
	const T_ITALIC_START = '<i>';
	const T_UNDERLINE_START = '<un>';

	const T_PARA_END = '</p>';
	const T_BLOCK_END = '</block>';
	const T_BOLD_END = '</b>';
	const T_ITALIC_END = '</i>';
	const T_UNDERLINE_END = '</un>';

	/*
	 * minmax order of token : p > block > b > i > un > __var__
	 * default to set true
	 */
	public static $minmax = true;

	/*
	 * token group
	 */
	public static $tokenGroup = array(
		'var'=>1,
		'tag'=>2,
		);

	/**
     * Matched open and closed quotes.
     *
     * @var array
     */
    public static $specialQuotes = array(
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

	/*
     * supported token symbols
	 */
	public static $tokenSymbols = array(
		self::T_PARA_SYMBOL,
		self::T_BLOCK_SYMBOL,
		self::T_BOLD_SYMBOL,
		self::T_ITALIC_SYMBOL,
		self::T_UNDERLINE_SYMBOL,
		self::T_VARIBLE_SYMBOL,
		);

	/*
 	 * token tags
	 */
	public static $tokenTags = array(
		self::T_PARA_START,
		self::T_BLOCK_START,
		self::T_BOLD_START,
		self::T_ITALIC_START,
		self::T_UNDERLINE_START,
		self::T_PARA_END,
		self::T_BLOCK_END,
		self::T_BOLD_END,
		self::T_ITALIC_END,
		self::T_UNDERLINE_END,
		);

	/*
	 * token full name
	 */
	public static $tokenUniversal = array(		
		self::T_PARA_SYMBOL=>'paragraph',
		self::T_BLOCK_SYMBOL=>'span',
		self::T_BOLD_SYMBOL=>'bold',
		self::T_ITALIC_SYMBOL=>'italic',
		self::T_UNDERLINE_SYMBOL=>'underline',		
		);

	/*
	 * token number,  0x01, 0x10, 0x20, ...
	 */
	public static $tokensNumber = array(
		self::T_PARA_START => '200',
		self::T_PARA_END => '201',
		self::T_BLOCK_START => '202',
		self::T_BLOCK_END => '203',
		self::T_BOLD_START => '204',
		self::T_BOLD_END => '205',
		self::T_ITALIC_START => '206',
		self::T_ITALIC_END => '207',
		self::T_UNDERLINE_START => '208',
		self::T_UNDERLINE_END => '209',
		);

	/*
 	 * token priority, 0x01, 0x10, 0x20, ...
	 */
	public static $tokensPriorityReverse = array(

		self::T_PARA_START => 0x00,
		self::T_PARA_END => 0x00,
		self::T_BLOCK_START => 0x10,
		self::T_BLOCK_END => 0x10,
		self::T_BOLD_START => 0x20,
		self::T_BOLD_END => 0x20,
		self::T_ITALIC_START => 0x30,
		self::T_ITALIC_END => 0x30,
		self::T_UNDERLINE_START => 0x40,
		self::T_UNDERLINE_END => 0x40,

		);

	/*
 	 * token priority reverse, 0xff, 0xfe, 0xfd, ...
	 */
	public static $tokensPriority = array(

		self::T_PARA_START => 0xff,
		self::T_PARA_END => 0xff,
		self::T_BLOCK_START => 0xfe,
		self::T_BLOCK_END => 0xfe,
		self::T_BOLD_START => 0xfd,
		self::T_BOLD_END => 0xfd,
		self::T_ITALIC_START => 0xfc,
		self::T_ITALIC_END => 0xfc,
		self::T_UNDERLINE_START => 0xfb,
		self::T_UNDERLINE_END => 0xfb,

		);

	/*
	 * token pair map
	 * <p> - </p>
	 */
	public static $tokenPairMap = array(
		self::T_PARA_START=>self::T_PARA_END,
		self::T_BLOCK_START=>self::T_BLOCK_END,
		self::T_BOLD_START=>self::T_BOLD_END,
		self::T_ITALIC_START=>self::T_ITALIC_END,
		self::T_UNDERLINE_START=>self::T_UNDERLINE_END,
		);

	/*
	 * token-symbol map
	 * <p> - p
	 * </p> - p
	 */
	public static $tokenSymbolMap = array(
		self::T_PARA_START => self::T_PARA_SYMBOL,
		self::T_PARA_END => self::T_PARA_SYMBOL,
		self::T_BLOCK_START => self::T_BLOCK_SYMBOL,
		self::T_BLOCK_END => self::T_BLOCK_SYMBOL,
		self::T_BOLD_START => self::T_BOLD_SYMBOL,
		self::T_BOLD_END => self::T_BOLD_SYMBOL,
		self::T_ITALIC_START => self::T_ITALIC_SYMBOL,
		self::T_ITALIC_END => self::T_ITALIC_SYMBOL,
		self::T_UNDERLINE_START => self::T_UNDERLINE_SYMBOL,
		self::T_UNDERLINE_END => self::T_UNDERLINE_SYMBOL,
		);

	public static function getSupportedTokens(){
		return self::$tokenSymbols;
	}
}