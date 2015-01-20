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

	public function __construct($string){

		$this->rawIn = $string;
		if(!function_exists('tidy_parse_string')){
			exit('tidy module not exist');
		}else{
			//$this->dom = $this->parse();
			$this->parse();
		} 

		$this->traverse = 0;
	}

	public function __destruct(){
		//TODO
	}

	public function getDom(){
		return $this->dom;
	}

	public function find($selectorString, $idx = 0){

		$selectors = $this->parseSelectors($selectorString);
		if($this->traverse == 0){
			//$this->dfsTraverse($this->dom);
			$this->dfsFind($selectors, $this->dom, $idx);
			//print_r($this->allNodesMap);
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
					$this->searchNodeSelector($selectors, $_current, $idx);
				}
			}
		}		
		//echo $node->value . "\n";
	}

	/**
	 * BFS find
	 */
	protected function bfsFind($selector, $node, $idx){
		//TODO

	}

	protected function searchNodeSelector($selectors, $_current, $idx){
		foreach($selectors as $key => $val){
			$selector = $selectors[$key];



		}
	}

	/**
	 * parse the tidy node's attribute
	 */
	protected function parseNodeAttribute($node){
		if(!empty($node)){

			// TODO 
			$attribute = $node->attribute;
			return $attribute;
		}
	}

	/**
	 * string match function 
	 * test if str1 is the substr of str2 or not
	 */
	protected function stringMatch($str1, $str2){
		//TODO

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

		//print_r($this->dom);
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
	 * get attribute of the 
	 */
	public function getAttributeByName($name, $idx = 0){

		if(isset($this->dom->name)){
			return $this->dom->attribute;
		}
	}

	public function getElementByName($name){

		if($this->dom->name == $name){
			return $this->dom->value;			
		}
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
	 * #TODO
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