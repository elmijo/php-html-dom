<?php
namespace PHPTools\PHPHtmlDom\Core;

/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
abstract class PHPHtmlDomElementAbstract
{
    final public function hasclass($classname)
    {
        return !!$this->hasattr('class')?in_array($classname, explode(' ', $this->attrs->class)):FALSE;
    }

    final public function hasattr($attr)
    {
        return !!isset($this->attrs->{$attr});
    }

    final public function attr($inx)
    {
        return !!$this->hasattr($inx)?$this->attrs->{$inx}:NULL;
    }

    final public function data($inx)
    {
        return $this->attr(sprintf('data-%s',$inx));
    }

    final public function parent()
    {
        $parent = NULL;

        if(!!isset($this->dom_element->parentNode))
        {
            if($this->dom_element->parentNode->nodeType == 1)
            {
                $parent = new PHPHtmlDomElement($this->dom_element->parentNode);
            }
            else
            {
                $parent = $this->dom_element->parentNode;
            }
        }
        return $parent;
    }
}
?>
