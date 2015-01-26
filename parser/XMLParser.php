<?php

use DomDocument;
use DomNode;

class XMLParser{

	public function extractAttributes( $html, array $options ) {
		$document = $this->createDocument( $html );
		$options = Hash::normalize( $options, [ ]);
		$data = [ ];
		foreach ( $options as $name => $required ) {
			$tags = $document->getElementsByTagName( $name );
			$required = Hash::normalize(( array )$required, '' );
			$data[ $name ] = [ ];
			foreach ( $tags as $Tag ) {
				if ( $Tag->hasAttributes( )) {
					$attributes = $this->extractAttributesFromTag(
						$Tag,
						$required
					);
					if ( !empty( $attributes )) {
						$data[ $name ][ ] = $attributes;
					}
				}
			}
		}
		return $data;
	}

	protected function createDocument( $html ) {
		$reporting = error_reporting( 0 );
		$html = $this->fixCharset( $html );
		$document = DomDocument::loadHTML( $html );
		error_reporting( $reporting );
		if ( $document === false ) {
			throw new Exception( 'Unable to load HTML document.' );
		}
		return $document;
	}

	/**
	 *	If necessary, fixes the given HTML's charset to work with the current
	 *	version of Libxml (used by DomDocument). Older versions of Libxml
	 *	recognize only
	 *
	 *      <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
	 *
	 *  from HTML4, and not the new HTML5 form:
	 *
	 *      <meta charset="utf-8">
	 *
	 *  with the result that parsed strings can have funny characters.
	 *
	 */
	protected function fixCharset( $html ) {
		// The fix is from https://github.com/glenscott/dom-document-charset/blob/master/DOMDocumentCharset.php
		if ( LIBXML_VERSION < 20800 && stripos($html, 'meta charset') !== false ) {
			$html = preg_replace( '/<meta charset=["\']?([^"\']+)"/i',
					              '<meta http-equiv="Content-Type" content="text/html; charset=$1"',
					              $html );
		}
		return $html;
	}

	/**
	 *	Extracts attributes from the given tag.
	 *
	 */
	protected function extractAttributesFromTag( DOMNode $Tag, array $required ) {
		$attributes = [ ];
		foreach ( $Tag->attributes as $name => $Attribute ) {
			if ( !empty( $required )) {
				if ( isset( $required[ $name ])) {
					$pattern = $required[ $name ];
					if ( $pattern && !preg_match( $pattern, $Attribute->value )) {
						return [ ];
					}
				} else {
					continue;
				}
			}
			$attributes[ $name ] = $Attribute->value;
		}
		$diff = array_diff_key( $required, $attributes );
		return empty( $diff )
			? $attributes
			: [ ];
	}
}