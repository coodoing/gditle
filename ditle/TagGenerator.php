<?php

/**
 * Textile - A Humane Web Text Generator.
 *
 * @link https://github.com/textile/php-textile
 */
/*
 * Copyright (c) 2014, Netcarver https://github.com/netcarver
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *
 * * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * * Neither the name Textile nor the names of its contributors may be used to
 * endorse or promote products derived from this software without specific
 * prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */
class TagGenerator{

    /**
     * The name of the tag.
     *
     * @var string
     */
    protected $tag;

    /**
     * Whether the tag is self-closing.
     *
     * @var bool
     */
    protected $selfclose;

    /**
     * The attribute array stored in the bag.
     *
     * @var array
     */
    protected $attribute;

    /**
     * Constructor.
     *
     * @param string $name        The tag name
     * @param array  $attributes  An array of attributes
     * @param bool   $selfclosing Whether the tag is self-closing
     */
    public function __construct($name, array $attribute = null, $selfclosing = true){
        $this->tag = $name;
        $this->attribute = (array) $attribute;
        $this->selfclose = $selfclosing;        
    }

    /**
     * Adds a value to the bag.
     *
     * Empty values are rejected, unless the
     * second argument is set TRUE.
     *
     * bc. use Netcarver\Textile\DataBag;
     * $plant = new DataBag(array('key' => 'value'));
     * $plant->flower('rose')->color('red')->emptyValue(false, true);
     *
     * @param   string $name   The name
     * @param   array  $params Arguments
     * @return  DataBag
     */
    public function __call($name, array $params){
        if (!empty($params[1]) || !empty($params[0])) {
            $this->attribute[$name] = $params[0];
        }
        return $this;
    }

    /**
     * Returns the tag as HTML.
     *
     * bc. $img = new Tag('img');
     * $img->src('../test.png')->alt('Example image');
     * echo (string) $img;
     *
     * @return string A HTML element
     */
    public function __toString(){
        $tagAttribute = '';
        if ($this->attribute) {
            ksort($this->attribute);
            foreach ($this->attribute as $name => $value) {
                $tagAttribute .= " $name=\"$value\"";
            }
        }
        if ($this->tag) {
            return '<' . $this->tag . $tagAttribute . (($this->selfclose) ? " />" : '>');
        }
        return $tagAttribute;
    }
}