<?php

class DOMParser{
	
	/**
	 * instance of domnode
	 */
	protected $node;

	/**
	 * instance of dom
	 */
	protected $dom;

	/**
	 * raw input 
	 */
	protected $rawIn;

	/**
	 * traverse method
	 * 0 : dfs
	 * 1 : bfs
	 */
	protected $traverse;

	/**
	 * tidynode visited or not
	 */
	protected $visited = array();

	/**
	 * tidynode nodes Map
	 * finded node map
	 */
	protected $allNodesMap = array();

	/**
	 * tidynode map
	 * finded node map
	 */
	protected $findedNodesMap = array();

	/**
	 * node's level map
	 */
	protected $levelNodeMap = array();

	public function __construct($string){

		$this->rawIn = $string;
		if(!function_exists('tidy_parse_string')){
			exit('tidy module not exist');
		}else{
			$this->parse();
		} 
		print_r($this->getLevelKChildNodes($this->dom, 2));

		$this->traverse = 0;
	}

	public function __destruct(){
		//TODO
		$this->clearDom();
	}

	public function getDom(){
		return $this->dom;
	}

	protected function clearDom(){

	}

	public function find($selectorString, $idx = 0){

		$selectors = $this->parseSelectors($selectorString);
		if($this->traverse == 0){
			//$this->dfsTraverse($this->dom);
			$this->dfsFind($selectors, $this->dom, $idx);
		}else{
			//$this->bfsTraverse($this->dom);
			$this->bfsFind($selectors, $this->dom, $idx);
		}
	}

	/**
	 * DFS find
	 */
	protected function dfsFind($selectors, $node, $idx){
		$this->setVisited($node);
		if(!empty($node->child)){
			foreach($node->child as $_current){
				/**tidyNode*/
				if(!$this->isVisited($_current)){
					$this->dfsFind($selectors, $_current, $idx);
					$md5_node = $this->md5Node($_current);
					$this->allNodesMap[$md5_node] = $_current;			
					//echo $_current->value . "\n";		
					$this->searchNodeBySelectors($selectors, $_current);
				}
			}
		}
		if(empty($this->findedNodesMap)){
			return null;
		}else{
			$count = count($this->findedNodesMap);
			if($idx >= $count){
				return $this->findedNodesMap[0];
			}
			if($idx < 0){
				$idx = $count + $idx;
				return $this->findedNodesMap[$idx];
			}
			foreach($this->findedNodesMap as $key=>$val){
				echo $val->value;
			}
			return $this->findedNodesMap[$idx];
		}
		return 'unmatched';
		//echo $node->value . "\n";
	}

	/**
	 * BFS find
	 */
	protected function bfsFind($selector, $node, $idx){
		//TODO
	}

	/**
	 * 
	 */
	protected function searchNodeBySelectors($selectors, $node){
		$flag = true;
		foreach($selectors as $key => $val){
			$selector = $selectors[$key];
			$ret = $this->searchNodeBySelector($selector, $node);		
			$flag = $ret;	
		}
		if($flag){
			$md5_node = $this->md5Node($node);
			//$this->findedNodesMap[$md5_node] = $node;	
			$this->findedNodesMap[] = $node;	
		}
	}

	/**
	 * search node by the specified array selector
	 *  more efficient by the level search.
	 * 
	 *  selector[0]					node
	 *  selector[1]			node_1   	  node_1
	 *  selector[2]	   node_2  node_2   node_2   node_2
	 *  ...			   ...
	 */
	protected function searchNodeBySelector($selector, $node){
		if(!empty($selector)){
			$flag = true;
			$currrent_node = $node;

			//foreach($selector as $_selector){	
			for($i=0; $i < count($selector); $i++){
				/**capitable with the selector structure*/				
				$ret = $this->searchNode($selector, $currrent_node);
				//print_r(json_encode($ret)."\n");

				if($ret == false){
					$flag = false;
					break;
				}else{
					/*if(!empty($currrent_node)){
						$child_node = $currrent_node->child;
						foreach ($child_node as $k => $v) {
							echo 'xx';
							if(!empty($v->attribute)){
								$this->searchNode($selector[$i], $v);
							}
							
						}
					}*/
					continue;
				}
				
			}
			return $flag;				
		}
	}

	/**
	 * get the level-k's child nodes
	 * 
	 *       0					node
	 *       1			node_1   	  node_1
	 *  	 2	   node_2  node_2   node_2   node_2
	 *  ...			   ...
	 */
	protected function getLevelKChildNodes($node, $levelK){
			
			foreach($node->child as $val){				
				$this->getLevelKChildNodes($val);
				echo $val->value."\n";				
			}

			$child_node = array();
			if(!empty($node)){
				foreach($node->child as $val){
					$_child_node = $this->getLevelKChildNodes($val, $levelK-1);
					$child_node[] = $_child_node;
				}
			}			
		}
		
	}

	/**
	 * search node by the selector
	 */
	protected function searchNode(array $selector, tidyNode $node){
		list ( $tag, $key, $val, $exp, $no_key ) = $selector; 

		$pass = true;
		if ($tag == '*' && !$key) {
			exit('selector style error ');
		}

		if ($tag && $tag != $node->name && $tag !== '*') {
			$pass = false;
		}

		if ($pass && $key) {
			if ($no_key) {
				if (isset ( $node->attribute [$key] )) {
					$pass = false;
				}
			} else {
				if ($key != "plaintext" && ! isset ( $node->attribute [$key] )) {
					$pass = false;
				}
			}
		}

		if ($pass && $key && $val && $val != '*') {
			if ($key == "plaintext") {
				$node_value = $this->getNodeText($node);
			} else {
				$node_value = $node->attribute[$key];
			}
			$match = $this->attributeMatch( $exp, $val, $node_value );
			if (! $match && strcasecmp ( $key, 'class' ) == 0) {
				foreach ( explode ( ' ', $node->attribute [$key] ) as $k ) {
					if (! empty ( $k )) {
						$match = $this->attributeMatch ( $exp, $val, $k );
						if ($match) {
							break;
						}
					}
				}
			}
			if (! $match) {
				$pass = false;
			}
		}
		if ($pass) {
			return $node;
		} else {
			return false;
		}
	}

	public function getNodeText($name){
		if(!empty($node)){
			return $node->value;			
		}
	}

	/**
	 * get attribute of the node
	 */
	public function getNodeAttribute($node){
		if(!empty($node)){
			return $node->attribute;
		}
	}

	/**
	 * Parse the tidy node's attribute to specified Selector structure
	 * https://github.com/sabberworm/PHP-CSS-Parser/blob/master/lib/Sabberworm/CSS/Parser.php
	 *
	 */
	protected function parseNodeAttribute($node){
		if(!empty($node)){
			// TODO 
			$attribute = $node->attribute;
			return $attribute;
		}
	}

	/**
	 * dfs traverse
	 * http://en.wikipedia.org/wiki/Depth-first_search
	 *
	 * 1  procedure DFS(G,v):
	 * 2      label v as discovered
	 * 3      for all edges from v to w in G.adjacentEdges(v) do
	 * 4          if vertex w is not labeled as discovered then
	 * 5              recursively call DFS(G,w)
	 *
	 */
	protected function dfsTraverse($node){
		$this->setVisited($node);
		if(!empty($node->child)){
			foreach($node->child as $_current){
				/**tidyNode*/
				if(!$this->isVisited($_current)){
					$this->dfsTraverse($_current);
					echo $_current->value."\n";
				}
			}
		}
		//echo $_current->value."\n";
	}

	/**
	 * bfs traverse
	 * http://en.wikipedia.org/wiki/Breadth-first_search
	 *
	 */
	protected function bfsTraverse($node){		

		$queue = array();
		$this->setVisited($node);
		/**be careful about the queue structure*/
		array_unshift($queue, $node); 
		while(!empty($queue)){
			$pop_node = array_pop($queue);
			echo $pop_node->value."\n";

			if(!empty($pop_node->child)){
				foreach($pop_node->child as $_current){
					if(!$this->isVisited($_current)){
						$this->setVisited($_current);
						array_unshift($queue, $_current);
					}
				}
			}
		}

	}

	/**
	 * get tidynody object from the md5 hash
	 */
	protected function getNodeByMd5Hash($node){
		$md5_node = $this->md5Node($node);
		if(!empty($this->allNodesMap)){
			return $this->allNodesMap[$md5_node];
		}
		return null;
	}

	/**
	 * md5 hash the node object
	 */
	protected function md5Node($node){
		//md5(serialize($node->value));
		return md5(serialize($node));
	}

	protected function isVisited($node){
		/**make the node's key */
		$node_key = md5(serialize($node));
		if(isset($this->visited[$node_key])){
			return $this->visited[$node_key];
		}
		return false;
	}

	protected function setVisited($node){
		$node_key = md5(serialize($node));
		//$node_key = md5(serialize($node->value));
		$this->visited[$node_key] = true;
	}

	/**
	 * use tidy to parse string 
	 */
	public function parse(){

		$this->dom = $this->preParse();

		$tidy = new tidy();
		/**doesn't support user-defined tags such as <block> <un>*/
		$tidy->parseString($this->dom, array(), 'utf8');
		$this->dom = $tidy->body();

		$this->dom = $this->postParse();

		print_r($this->dom);
		return $this->dom;		
	}

	/**
	 * tidify the input dom string
	 */
	protected function preParse(){
		$string = $this->tidify($this->rawIn);
		return $string;
	}

	/**
	 * only return the content of tidyNode without html/body tag
	 */
	protected function postParse(){
		$dom = $this->dom;
		if(!empty($dom->child)){
			//return $dom->child;
		}
		return $dom;
	}

	/**
	 * tidify the input string to remove the noise tag as script, style, comment etc
	 *
	 */
	protected function tidify($string){		

		$string = preg_replace('~<!\[CDATA\[(.*?)\]\]>~is', '', $string);
        $string = preg_replace('~<!--(.*?)-->~is', '', $string);
        $string = preg_replace('~<!DOCTYPE.*?>~is', '', $string);
        $string = preg_replace("'<\s*script[^>]*[^/]>(.*?)<\s*/\s*script\s*>'is", '', $string);
        $string = preg_replace("'<\s*script\s*>(.*?)<\s*/\s*script\s*>'is", '', $string);
        $string = preg_replace("'<\s*style[^>]*[^/]>(.*?)<\s*/\s*style\s*>'is", '', $string);
        $string = preg_replace("'<\s*style\s*>(.*?)<\s*/\s*style\s*>'is", '', $string);

        return $string;
	}

	/**
	 * attribute match function
	 */
	protected function attributeMatch($exp, $pattern, $node_value) {
		$pattern = strtolower($pattern);
		$node_value = strtolower($node_value);

		switch ($exp) {
			case '=' :
				return ($node_value === $pattern);
			case "~=":
				$node_array = explode(" ", $node_value);
				if(in_array($pattern, $node_array)){
					return true;
				}else{
					return false;
				}
			case "|=":
				//return preg_match ( "/" . preg_quote ( $pattern, '/' ) . '(-)' . "/", $node_value );;
				if($pattern === $node_value || preg_match("/^$pattern\-/", $node_value)){
					return true;
				}else{
					return false;
				}
			case '!=' :
				return ($node_value !== $pattern);
			case '^=' :
				return preg_match ( "/^" . preg_quote ( $pattern, '/' ) . "/", $node_value );
			case '$=' :
				return preg_match ( "/" . preg_quote ( $pattern, '/' ) . "$/", $node_value );
			case '*=' :
				if ($pattern [0] == '/') {
					return preg_match ( $pattern, $node_value );
				}
				return preg_match ( "/" . $pattern . "/i", $node_value );
		}
		return false;
	}

	/**
	 * parse the selectors, same as simple_html_dom.php
	 *
	 * https://developer.mozilla.org/en-US/docs/Web/CSS/Reference
	 * http://www.w3.org/TR/css3-selectors/
	 * https://developer.mozilla.org/en-US/docs/Web/CSS/Attribute_selectors
	 *
	 *Basic Selectors:
	 *	Type selectors elementname       p
	 *	Class selectors .classname       p.class
	 *	ID selectors #idname             p#id
	 *	Universal selectors * ns|* *|*   *[lang^=en]
	 *	Attribute selectors  (?:([~|!*^$]?=)[\"']?(.*?)[\"']?)   [attr=value][attr~=value][attr|=value][attr^=value][attr$=value][attr*=value]
	 *
	 * #TODO user-defined selector parser
	 *  Combinators:
	 *	Adjacent sibling selectors A + B
	 *	General sibling selectors A ~ B
	 *	Child selectors A > B
	 *	Descendant selectors A Basic
	 *
	 */
	public function parseSelectors($selector){
		
		// pattern of CSS selectors, modified from mootools
		$pattern = "/([\w-:\*]*)(?:\#([\w-]+)|\.([\w-]+))?(?:\[@?(!?[\w-:]+)(?:([~|!*^$]?=)[\"']?(.*?)[\"']?)?\])?([\/, ]+)/is";
		preg_match_all($pattern, trim($selector).' ', $matches, PREG_SET_ORDER);

		$selectors = array ();
		$result = array ();
		//print_r($matches);

		foreach ( $matches as $m ) {
			$m [0] = trim ( $m [0] );
			if ($m [0] === '' || $m [0] === '/' || $m [0] === '//')
				continue;
			if ($m [1] === 'tbody')
				continue;
			list ( $tag, $key, $val, $exp, $no_key ) = array ($m [1], null, null, '=',false);
			if (! empty ( $m [2] )) {
				$key = 'id';
				$val = $m [2];
			}
			if (! empty ( $m [3] )) {
				$key = 'class';
				$val = $m [3];
			}
			if (! empty ( $m [4] )) {
				$key = $m [4];
			}
			if (! empty ( $m [5] )) {
				$exp = $m [5];
			}
			if (! empty ( $m [6] )) {
				$val = $m [6];
			}
			// convert to lowercase
			$tag = strtolower ( $tag );
			$key = strtolower ( $key );
			// elements that do NOT have the specified attribute
			if (isset ( $key [0] ) && $key [0] === '!') {
				$key = substr ( $key, 1 );
				$no_key = true;
			}
			$result [] = array ($tag, $key, $val, $exp, $no_key);
			if (trim ( $m [7] ) === ',') {
				$selectors [] = $result;
				$result = array ();
			}
		}
		if (count ( $result ) > 0){
			$selectors [] = $result;
		}

		print_r($selectors);
		return $selectors;
	}
}