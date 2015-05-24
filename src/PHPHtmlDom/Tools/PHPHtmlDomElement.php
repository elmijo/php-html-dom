<?php
namespace PHPHtmlDom\Tools;

/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomElement
{
    private $current_element;

    public function __construct (\DOMElement $element)
    {
        $this->current_element = $element;

        $this->tagName = $element->tagName;

        $this->getAllAttrs();
    }

    final public function hasattr($attr)
    {
        return !!isset($this->attrs->{$attr});
    }

    private function getAllAttrs()
    {
        $this->attrs = new \stdClass;

        foreach($this->current_element->attributes as $name => $node)
        {
            $this->attrs->{strtolower($name)} = $node->nodeValue;
        }
    }
}

?>
