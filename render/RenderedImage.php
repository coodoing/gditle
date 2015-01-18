<?php

/**
 * Rendered Image class to describe the image created by the input
 */
class RenderedImage{	

	/*
     * guid of the component
	 */
	private $guid;

	private $module;
	private $langs;
	private $zindex;
	
	private $imageWidth;
	private $imageHeight;

	/*
	 * bold, italic underline
	 */
	private $fontsRule;
	/*
	 * notelist number, dotted, stars
	 */
	private $listRule;
	/*
	 * left, center, right
	 */
	private $posRule;

	public function __construct(){

	}

}