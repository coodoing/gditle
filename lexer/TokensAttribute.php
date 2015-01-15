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

	protected $debug = false;

	/*
	 * token group
	 */
	public static $tokenGroup = array(
		'varible'=>1,
		'tag'=>2,
		);

	/*
 	 * token list
	 */
	public static $tokensList = array(
		T_PARA_START,
		T_BLOCK_START,
		T_BOLD_START,
		T_ITALIC_START,
		T_UNDERLINE_START,
		T_PARA_END,
		T_BLOCK_END,
		T_BOLD_END,
		T_ITALIC_END,
		T_UNDERLINE_END,
		);

	/*
 	 * token priority, 0x01, 0x10, 0x20, ...
	 */
	public static $tokensPriority = array(
		T_PARA_START => '200',
		T_PARA_END => '201',
		T_BLOCK_START => '202',
		T_BLOCK_END => '203',
		T_BOLD_START => '204',
		T_BOLD_END => '205',
		T_ITALIC_START => '206',
		T_ITALIC_END => '207',
		T_UNDERLINE_START => '208',
		T_UNDERLINE_END => '209',
		);

	/*
	 * token pair
	 */
	public static $tokenPair = array(

		T_PARA_START=>T_PARA_END,
		T_BLOCK_START=>T_BLOCK_END,
		T_BOLD_START=>T_BOLD_END,
		T_ITALIC_START=>T_ITALIC_END,
		T_UNDERLINE_START=>T_UNDERLINE_END,
		);

	/*
     * supported token symbols
	 */
	public static $tokenSymbols = array(
		T_PARA_SYMBOL,
		T_BLOCK_SYMBOL,
		T_BOLD_SYMBOL,
		T_ITALIC_SYMBOL,
		T_UNDERLINE_SYMBOL,
		);
}