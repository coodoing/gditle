<?php

require_once 'RenderedImage.php';

class GDRender{

	/*
     * input string
	 */
	private $in;

	/*
     * params
	 */
	private $params;

	/*
     * output json_array
	 */
	private $out;

	public function __construct($in=''){
		$this->in = $in;
		if(empty($in)){
			$this->params = $this->initParams();
		}else{
			$this->params = $this->parseParams();
		}		
	}

	protected function initParams(){
	    $params = array();
	    $params['langs'] = 1;
	    $params['zindex'] = 1;
	    $params['module'] = 'models/textfield'; // render module type
	    $params['id'] = 'txt_guid_1'; //identify of this module
	    $params['rotation'] = array();

	    $params['image_width'] = '500';
	    $params['image_height'] = '400';
	    $params['text_color'] = '0,0,0';
	    $params['text_fontsize'] = '20';
	    $params['text_fontangle'] = '0';
	    $params['text_fontfamily'] = '../fonts/verdana.ttf';//'Vera.ttf';
	    $params['text_fontweight'] = '1'; //bold or not
	    $params['text_fontitalic'] = '1'; //italic or not
	    $params['text_fontunderline'] = 'true'; //underline or not
	    $params['text_align'] = 'center'; //

		return $params;
	}

	/**
	 * parse the input params
	 */
	protected function parseParams(){

	}

	protected function createImageFromAny($imagefile) { 
	    $type = exif_imagetype($imagefile); // [] if you don't have exif you could use getImageSize() 
	    $allowedTypes = array( 
	        1,  // [] gif 
	        2,  // [] jpg 
	        3,  // [] png 
	        6   // [] bmp 
	    ); 
	    if (!in_array($type, $allowedTypes)) { 
	        return false; 
	    } 
	    switch ($type) { 
	        case 1 : 
	            $im = @imageCreateFromGif($imagefile); 
	        	break; 
	        case 2 : 
	            $im = @imageCreateFromJpeg($imagefile); 
	        	break; 
	        case 3 : 
	            $im = @imageCreateFromPng($imagefile); 
	        	break; 
	        case 6 : 
	            $im = @imageCreateFromBmp($imagefile); 
	        	break; 
	        default:
	        	$im = error_image($imagefile);
	        	break;
	    }    
	    return $im;  
	} 

	protected function createImageFromJpeg($imgFile){
	    $im = @imagecreatefromjpeg($imgFile);

	    if(!$im){
	        $im  = imagecreatetruecolor(150, 30);
	        $bgc = imagecolorallocate($im, 255, 255, 255);
	        $tc  = imagecolorallocate($im, 0, 0, 0);

	        imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

	        imagestring($im, 1, 5, 5, 'Error loading ' . $imgFile, $tc);
	    }
	    return $im;
	}

	protected function createImageFromString($string){
	    $im  = imagecreatetruecolor(150, 30);
	    $bgColor = imagecolorallocate($im, 255, 255, 255);
	    $txtColor  = imagecolorallocate($im, 0, 0, 0);

	    imagefilledrectangle($im, 0, 0, 160, 30, $bgColor);

	    imagestring($im, 3, 5, 5, html_entity_decode($string), $txtColor);
	    return $im;
	}

	protected function createImageFromTF($string=''){
		$params = $this->params;
		$im = imagecreatetruecolor($params['image_width'], $params['image_height']);

		$bg_color = imagecolorallocate($im, 255, 255, 255);
		$shadow_color = imagecolorallocate($im, 0, 0, 0);

		$color = explode(',', $params['text_color']);
		$txt_color = imagecolorallocate($im, $color[0], $color[1], $color[2]);
		imagefilledrectangle($im, 0, 0, $params['image_width'], $params['image_height'], $bg_color);

		$text = $string;
		$font_family = $params['text_fontfamily'];//imageloadfont("Vera.ttf");
		$font_size = $params['text_fontsize'];
		$font_angle = $params['text_fontangle'];
		//$dimensions = imagettfbbox($font_size, 0, $font_family, $text);
		$dimensions = $this->calculateTextBox($font_size, 0, $font_family, $text);

		$x = 10;
		$y = 20;
		switch ($params['text_align']) {		
			case 'right':
				$x += ceil($params['image_width'] - $dimensions['width'] / 2);
				$y += ceil(($dimensions['height']) / 2);
				break;
			case 'center':
				$x += ceil(($params['image_width'] - $dimensions['width']) / 2);
				$y += ceil(($dimensions['height']) / 2);
				break;
			case 'left':
			default:
				# code...
				$x = $x;
				$y = $y;
				break;
		}

		switch ($params['text_fontweight']) {
			case '0':
				$this->boldText($im, $font_size, $font_angle,$x, $y, $txt_color, $font_family, $text);
				break;
			
			default:
				// Add some shadow to the text 
				imagettftext($im, $font_size, $font_angle, $x+1, $y+1, $shadow_color, $font_family, $text);			
				// Add the text
				imagettftext($im, $font_size, $font_angle, $x, $y, $txt_color, $font_family, $text);
				break;
		}

		return $im;
	}

	protected function boldText($image, $size, $angle, $x_cord, $y_cord, $color, $fontfile, $text) {  
		$_x = array(1, 0, 1, 0, -1, -1, 1, 0, -1); 
		$_y = array(0, -1, -1, 0, 0, -1, 1, 1, 1); 
		for($n=0;$n<=8;$n++) { 
		  imagettftext($image, $size, $angle, $x_cord+$_x[$n], $y_cord+$_y[$n], $color, $fontfile, $text); 
		} 
	}

	protected function italicText(){

	}	

	protected function underlineText(){

	}

	/**
	 * Calculates the *exact* bounding box (single pixel precision).
	 * It returns: 
	 *   left, top:  coordinates you will pass to imagettftext 
	 *   width, height: dimension of the image you have to create 
	 * 
	 * @param string $fontSize
	 * @param string $fontAngle
	 * @param string $fontFamily
	 * @param string $txt
	 *
	 * @return array an associative array with left, top, width, height, box keys
     */ 
	protected function calculateTextBox($fontSize,$fontAngle,$fontFamily,$txt) { 
	    $rect = imagettfbbox($fontSize,$fontAngle,$fontFamily,$txt); 

	    $minX = min(array($rect[0],$rect[2],$rect[4],$rect[6])); 
	    $maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6])); 
	    $minY = min(array($rect[1],$rect[3],$rect[5],$rect[7])); 
	    $maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7])); 
	    
	    return array( 
			"left"   => abs($minX) - 1, 
			"top"    => abs($minY) - 1, 
			"width"  => $maxX - $minX, 
			"height" => $maxY - $minY, 
			"box"    => $rect 
	    ); 
	}

	public function createImage($string){
		$img = $this->createImageFromTF($string);
		imagejpeg($img);
		imagedestroy($img);
	}

	public function getInput(){
		return $this->in;
	}

	public function getParams(){
		return $this->params;
	}

	public function getOutput(){
		return $this->out;
	}

	public function __destruct(){

	}

}