<?php

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
        $tag_attribute = '';
        if ($this->attribute) {
            ksort($this->attribute);
            foreach ($this->attribute as $name => $value) {
                $tag_attribute .= " $name=\"$value\"";
            }
        }
        if ($this->tag) {
            return '<' . $this->tag . $tag_attribute . (($this->selfclose) ? " />" : '>');
        }
        return $tag_attribute;
    }
}