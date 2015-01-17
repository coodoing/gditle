<?php

require_once 'BinaryExprAST.php';
require_once 'TagExprAST.php';
require_once 'VariableExprAST.php';
require_once '../lexer/TokenMeta.php';
require_once '../lexer/TokensAttribute.php';

/*
 * http://llvm-tutorial-cn.readthedocs.org/en/latest/chapter-2.html
 */
class ASTParser{

	/*
	 * 0: regular parsing
	 * 1: Binary expression : operator-precedence parser 
	 * suggested setting 0
	 */
	protected $parseMethod ; 
	
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
	}

	/*
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
			$this->parseExpression();
		}
	}

	protected function parseExpression(){
		$tagArr = array();
		$varArr = array();
		$binaryArr = array(); // combination of the tagToken and varToken
		$exprArr = array(); // ast 

		$source = $this->inArray;
		for($i=0; $i<count($source); $i++){
			$current = $source[$i];
			$meta = $this->parsePrimaryTokenMeta($i);

			if($meta->getTokenGroup() == 2){
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
						$binary = $this->combineBinaryExpr($lastTag, $lastVar, $current);
						array_push($varArr, $binary['var']);
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

	/**
	 * comination of binary expr
	 */
	protected function combineBinaryExpr($startTagToken, $varToken, $endTagToken){
		$var = '(' . $startTagToken . $varToken . $endTagToken . ')';
		$expr = array();

		$varExpr = new VariableExprAST($varToken);
		$startTagMeta = $this->parsePrimaryTokenMetaByObj($startTagToken);
		$endTagMeta = $this->parsePrimaryTokenMetaByObj($endTagToken);

		$startTagExpr = new TagExprAST($startTagMeta->getTokenSymbol(), $startTagToken, $this->getTagTokenStyle($startTagToken));
		$endTagExpr = new TagExprAST($endTagMeta->getTokenSymbol(), $endTagToken, $this->getTagTokenStyle($endTagToken));

		$expr = new BinaryExprAST($varExpr, $startTagExpr, $endTagExpr);
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
	 * 0  : pop out the $last of the stack
	 * -1 : input exception
	 */
	protected function priorityComparision($lastToken, $currentToken){
		$lastMeta = $this->parsePrimaryTokenMetaByObj($lastToken);
		$currentMeta = $this->parsePrimaryTokenMetaByObj($currentToken);

		if($lastMeta->getTokenPriority() > $currentMeta->getTokenPriority()){
			return 1;
		}elseif($lastMeta->getTokenPriority() == $currentMeta->getTokenPriority()){
			return 0;
		}else{
			return -1;
		}
	}

	protected function getTagTokenStyle(){
		//TODO
		return '';
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
		$meta = new TokenMeta($lookahead);//$this->tokenMeta->getTokenMeta($lookahead);
		$precedence = $meta->getTokenPriority();
		//echo (json_encode($lhs).'<br>');
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
}