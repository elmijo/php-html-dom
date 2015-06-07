<?php
namespace PHPTools\PHPHtmlDom\Core;

/**
* Esta clae contiene los metodos abstractos para todo PHPHtmlDomList
*/
abstract class PHPHtmlDomListAbstract
{
    /**
     * Este metodo permite obtener otros elementos internos.
     * @param  string $css_selector Cadena de texto con el selector css requerido.
     * @return PHPTools\PHPHtmlDom\Core\PHPHtmlDomList|Null
     */
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

    /**
     * Este metodo permite aplicar una funcion a la lista de los elementos
     * @param  function $func Funcion que se le aaplicara a caada elemento.
     * @return self
     */
    final public function each($func)
    {
        foreach ($this->elements as $inx => $val)
        {
            call_user_func($func,$inx,$val);
        }
        return $this;
    }

    /**
     * Este metoodo permite obtener un elemento espesifico de la lista.
     * @param  integer $inx Posicion del elemento a obtener
     * @return PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement|NULL
     */
    final public function eq($inx)
    {
        return isset($this->elements[$inx])?$this->elements[$inx]:NULL;
    }

    /**
     * Este metodo permite obener la cantidaad de elementoos que componen la lista.
     * @return integer
     */
    final public function count()
    {
        return count($this->elements);
    }
}