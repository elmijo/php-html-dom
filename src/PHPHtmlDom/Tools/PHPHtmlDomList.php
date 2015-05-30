<?php
namespace PHPHtmlDom\Tools;

use PHPHtmlDom\Tools\PHPHtmlDomElement;
/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomList
{
    private $list_html;

    private $elements = array();

    public function __construct (\DOMNodeList $node_list)
    {
        
        $d = new \DOMDocument();

        foreach($node_list as $node)
        {
            if($node->nodeType == 1&&!in_array($node->tagName, ['br','hr']))
            {
                $this->elements[] = new PHPHtmlDomElement($node);

                $d->appendChild($d->importNode($node->cloneNode(TRUE),TRUE));
            }            
        }

        $this->list_html = trim($d->saveHTML());
    }

    final public function find($css_selector)
    {
        $find = NULL;

        $doc = new \PHPHtmlDom\PHPHtmlDom;

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
