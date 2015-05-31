<?php
namespace PHPTools\PHPHtmlDom\Core;

use PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement;
/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
abstract class PHPHtmlDomListAbstract
{
    final public function find($css_selector)
    {
        $find = NULL;

        $doc = new \PHPTools\PHPHtmlDom\PHPHtmlDom;

        if(!!$doc->importHTML($this->list_html))
        {
            $find = $doc->e($css_selector);
        }

        return $find;
    }

    final public function each($func)
    {
        foreach ($this->elements as $inx => $val)
        {
            call_user_func($func,$inx,$val);
        }
        return $this;
    }

    final public function eq($inx)
    {
        return isset($this->elements[$inx])?$this->elements[$inx]:NULL;
    }
}

?>
