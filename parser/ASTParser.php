<?php

require_once 'BinaryExprAST.php';
require_once 'TagExprAST.php';
require_once 'VariableExprAST.php';
require_once 'BlockExprAST.php';
require_once '../lexer/TokenMeta.php';
require_once '../lexer/TokensAttribute.php';

require_once '../ditle/Rule.php';
require_once '../ditle/FontRule.php';
require_once '../ditle/ListRule.php';
require_once '../ditle/PositionRule.php';

/**
 * Class to generate the AST based on the token array(set)
 *  
 * For more info http://llvm-tutorial-cn.readthedocs.org/en/latest/chapter-2.html
 *
 */
class ASTParser{

	/**
	 * parse method used in the class
	 * 0: regular parse method
	 * 1: Binary expression by operator-precedence parser 
	 * suggested setting 0
	 */
	protected $parseMethod ; 

	/**
	 * combinate the variable use the block or the array
	 * 0 : array
	 * 1 : block
	 */
	protected $varBlock;
	
	/*
	 * input string
	 */
	protected $in;
	/*
	 * lexer input array 
	 */
	protected $inArray; 

	public function __construct($in = '', $inArray = array()){
		$this->in = $in;
		$this->inArray = $inArray;

		$this->parseMethod = 0;
		$this->varBlock = 1;
	}

	/**
	 * operator-precedence parser 
	 */
	public function astParse(){

		if($this->parseMethod == 1){
			$start = $this->parsePrimary(0);
			$startMeta = new TokenMeta($start);
			$priority = $startMeta->getTokenPriority();
			//echo $startMeta->getTokenValue();		
			$this->primaryParseExpression($priority, 1, $start);
		}else{
			$this->parseToParenth();
			$this->parseExpression();
		}
	}

	/**
	 * Parse the tokens to varible format with parenthesis
	 */
	protected function parseToParenth(){
		$tagArr = array();
		$varArr = array();

		$source = $this->inArray;
		$len = $this->getParseArrayLength();

		$flag = 0;

		for($i=0; $i<$len; $i++){
			$current = $source[$i];
			$currentMeta = $this->parsePrimaryTokenMetaByObj($current);

			if($currentMeta->getTokenGroup() == 2){
				// even empty string will push into the array to make sure the following procedure
				if($flag == 0){
					array_push($varArr, $current);
				}else{
					$flag = 0;
				}				
			}else{
				if(empty($tagArr)){						
					array_push($tagArr, $current);
				}else{
					$lastIdx = count($tagArr)-1;
					$last = $tagArr[$lastIdx];
					$comp = $this->priorityComparision($last, $current);

					if($comp == 1){
						array_push($tagArr, $current);
					}elseif($comp == 0){
						$lastTag = array_pop($tagArr);
						if(!empty($varArr)){
							$lastVar = array_pop($varArr);
						}else{
							$lastVar = '';
						}

						/************************************/
						/**
						 * combination algorithm
						 */
						$binary = $this->combineBinaryExpr($lastTag, $lastVar, $current, null);

						/*pre combination or not*/
						$_lhs = '';
						if(!empty($varArr)){
							$_lhs = array_pop($varArr);
						}

						/*post combination or not*/
						$_rhs = '';
						if($i+1 < $len){
							$next = $source[$i+1];
							$nextMeta = $this->parsePrimaryTokenMetaByObj($next);
							if(!empty($next) && $nextMeta->getTokenGroup() == 2){
								$_rhs = $next;
								$flag = 1;
							}
						}
					
						$combination = $_lhs . $binary['var'] . $_rhs; 

						array_push($varArr, $combination);
					}else{
						trigger_error("Input exception");
						exit;
					}
				}
			}
		}

		if(empty($varArr)){
			$parseRet = '';
		}else{
			$parseRet = array_pop($varArr);
		}

		var_dump($parseRet);
		return $parseRet;
	}

	protected function parseExpression(){
		$tagArr = array();
		$varArr = array();
		$binaryExprArr = array(); // ast combination of the tagToken and varToken

		$source = $this->inArray;
		$len = $this->getParseArrayLength();

		for($i=0; $i<$len; $i++){
			$current = $source[$i];
			$currentMeta = $this->parsePrimaryTokenMetaByObj($current);

			if($currentMeta->getTokenGroup() == 2){
				// even empty string will push into the array to make sure the following procedure
				array_push($varArr, $current);						
			}else{
				if(empty($tagArr)){						
					array_push($tagArr, $current);
				}else{
					$lastIdx = count($tagArr)-1;
					$last = $tagArr[$lastIdx];
					$comp = $this->priorityComparision($last, $current);

					if($comp == 1){
						array_push($tagArr, $current);
					}elseif($comp == 0){
						$lastTag = array_pop($tagArr);
						if(!empty($varArr)){
							$lastVar = array_pop($varArr);
						}else{
							$lastVar = '';
						}

						/************************************/
						/**
						 * combination algorithm
						 */
						/** the first time into the binaryExprArr*/
						$_block = null;
						if(!empty($binaryExprArr)){
							$_block = array_pop($binaryExprArr);
						}
						$binary = $this->combineBinaryExpr($lastTag, $lastVar, $current, $_block);

						if(!empty($tagArr)){							
							$_tag = $tagArr[count($tagArr)-1];
							$_tagRule = $this->parseTagTokenRule($_tag);
						}

						$_lhsExpr = null;
						if(!empty($varArr)){
							$_lhs = array_pop($varArr);
							$_lhsExpr = new VariableExprAST($_lhs, $_tagRule->getFontRule());
						}

						$_rhsExpr = null;
						if($i+1 < $len){
							$next = $source[$i+1];
							$nextMeta = $this->parsePrimaryTokenMetaByObj($next);
							if(!empty($next) && $nextMeta->getTokenGroup() == 2){								
								$_rhsExpr = new VariableExprAST($next, $_tagRule->getFontRule());
							}
						}

						if($this->varBlock == 1){
							$combinationExpr = new BlockExprAST($_lhsExpr, $binary['expr'], $_rhsExpr);	
						}
						else{
							$combinationExpr = array($_lhsExpr, $binary['expr'], $_rhsExpr);
						}
						/** final process */
						if(empty($_lhsExpr) && empty($_rhsExpr)){
							$combinationExpr = $binary['expr'];
						}						
						array_push($binaryExprArr, $combinationExpr);
					}else{
						trigger_error("Input exception");
						exit;
					}
				}
			}
		}

		print_r($binaryExprArr);
		if(empty($binaryExprArr)){
			$parseRet = '';
		}else{
			$parseRet = array_pop($binaryExprArr);
		}	
		return $parseRet;
	}

	/**
	 * comination of binary expr
	 * @param string $startTagToken
	 * @param string $varToken
	 * @param string $endTagToken
	 *
	 * @return BinaryExprAST
	 */
	protected function combineBinaryExpr($startTagToken, $varToken, $endTagToken, $block){
		$var = '(' . $startTagToken . $varToken . $endTagToken . ')';
		$expr = array();
		
		$startTagMeta = $this->parsePrimaryTokenMetaByObj($startTagToken);
		$endTagMeta = $this->parsePrimaryTokenMetaByObj($endTagToken);

		$tagRule = $this->parseTagTokenRule($startTagToken);
		$startTagExpr = new TagExprAST($startTagMeta, $tagRule);
		$endTagExpr = new TagExprAST($endTagMeta);

		$varExpr = new VariableExprAST($varToken, $tagRule->getFontRule());
		if(empty($block)){
			$block = new BlockExprAST($varExpr, null, null);
		}		
		$expr = new BinaryExprAST($startTagExpr, $block, $endTagExpr);
		return array(
			'var'=>$var,
			'expr' => $expr,
			);
	}

	/**
	 * priority comparision of $last and $current
	 * 
	 * @param string $lastToken
	 * @param string $currentToken
	 * @return integer -1, 0, 1
	 * 1  : push the $current to the stack
	 * 0  : pop out the $last of the stack when the tags are sysmtric
	 * -1 : input exception
	 */
	protected function priorityComparision($lastToken, $currentToken){
		$lastMeta = $this->parsePrimaryTokenMetaByObj($lastToken);
		$currentMeta = $this->parsePrimaryTokenMetaByObj($currentToken);

		if($lastMeta->getTokenPriority() > $currentMeta->getTokenPriority()){
			return 1;
		}elseif($lastMeta->getTokenPriority() == $currentMeta->getTokenPriority()){
			if(TokensAttribute::$tokenPairMap[$lastMeta->getTokenTag()] == $currentMeta->getTokenTag()){
				return 0;
			}else{
				return 1;
			}
		}else{
			return -1;
		}
	}

	/**
	 * parse the tagtoken as '<p style = "color:0,131,125">' to get the style element
	 * @param string $tagToken
	 * @return Rule  
	 */
	protected function parseTagTokenRule($tagToken){
		//TODO
		$font = new FontRule;
		$rule = new Rule($font);
		return $rule;
	}

	/**
	 * primary parse expression 
	 * 
	 * @param string $maxPrecedence max priority util now, min_precedence
	 * @param integer $nextPos next tokens' position, lookahead-peek next token
	 * @param string $currentTok The current token element, lhs	  
	 */
	public function primaryParseExpression($maxPrecedence, $nextPos, $currentTok = ''){
		$lhs = $currentTok;
		$lookahead = $this->parsePrimary($nextPos);
		$meta = new TokenMeta($lookahead);
		$precedence = $meta->getTokenPriority();
		//assert(json_encode($lhs));
		//assert(json_encode($meta->getTokenPriority()));
		//assert(0x10);
		$firstWhilePos = $nextPos;
		if(!empty($meta)){
			while($precedence < $maxPrecedence){
				$varible = $lookahead;

				$rhs = $this->getAdvancedRightToken($firstWhilePos+1);

				$lookahead = $this->parsePrimary($firstWhilePos+2);
				$meta =  new TokenMeta($lookahead);

				$secondWhilePos = $firstWhilePos+2;
				if(!empty($meta)){
					while($lookahead->getTokenPriority()<=$varible->getTokenPriority()){
						$this->parseExpression($rhs, $lookahead->getTokenPriority());
						$lookahead = $this->parsePrimary($secondWhilePos+2);
					}
				}
				$lhs = '(' . $lhs . $varible . $rhs . ')';
			}
			return $lhs;
		}
		return '';

		return $lhs;
	}

	protected function getAdvancedRightToken($nextPos){
		$rhs = $this->parsePrimary($nextPos);
		return $rhs;
	}

	protected function parsePrimary($idx = 0){
		return $this->inArray[$idx];
	}

	protected function parsePrimaryTokenMeta($idx){
		$tok = $this->parsePrimary($idx);
		$meta = new TokenMeta($tok);
		return $meta;
	}

	protected function parsePrimaryTokenMetaByObj($tok){
		$meta = new TokenMeta($tok);
		return $meta;
	}

	protected function getParseArrayLength(){
		return count($this->inArray);
	}

	/**
	 * Cache the AST of the input string or array
	 */
	protected function cache(){
		//TODO
	}
}