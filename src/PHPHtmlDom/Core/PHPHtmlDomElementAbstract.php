<?php
namespace PHPTools\PHPHtmlDom\Core;

/**
* Esta clae contiene los metodos abstractos para todo PHPHtmlDomElement
*/
abstract class PHPHtmlDomElementAbstract
{
    /**
     * Permite saber si el elemento posee una clase.
     * @param  string $classname Cadena de texto con el nombre d ela clase a buscar.
     * @return boolean
     */
    final public function hasclass($classname)
    {
        return !!$this->hasattr('class')?in_array($classname, explode(' ', $this->attrs->class)):FALSE;
    }

    /**
     * Permite saber si el elemento tiene definido un atributo.
     * @param  string $attr cadena de texto con el nombre del atributo a buscar.
     * @return boolean
     */
    final public function hasattr($attr)
    {
        return !!isset($this->attrs->{$attr});
    }

    /**
     * Permite obtener el valor de un attributo del elemento.
     * @param  string $inx Cadena de texto con el nombre del aatributo a obtener
     * @return string|NULL Devuelve el valor del atributo si el mismo se encuentra definido o NULL en caso contrario.
     */
    final public function attr($inx)
    {
        return !!$this->hasattr($inx)?$this->attrs->{$inx}:NULL;
    }

    /**
     * Permite obtener el valor de un atributo tipo data.
     * @param  string $inx Cadena de texto con el nombre del atributo a obtener sin la palabra data
     * @return string|NULL Devuelve el valor del atributo si el mismo se encuentra definido o NULL en caso contrario.
     */
    final public function data($inx)
    {
        return $this->attr(sprintf('data-%s',$inx));
    }

    /**
     * Permite obtener el elemeno padre si lo posee
     * @return PHPHtmlDomElement|DOMDocument
     */
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