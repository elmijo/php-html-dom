<?php
namespace PHPTools\PHPHtmlDom\Core;

use PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement;
use PHPTools\PHPHtmlDom\Core\PHPHtmlDomListAbstract;
/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomList extends PHPHtmlDomListAbstract
{
    protected $list_html;

    protected $elements = array();

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
}

?>
