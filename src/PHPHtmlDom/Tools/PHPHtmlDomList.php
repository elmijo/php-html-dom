<?php
namespace PHPHtmlDom\Tools;

use PHPHtmlDom\Tools\PHPHtmlDomElement;
/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomList
{
    public function __construct (\DOMNodeList $node_list)
    {
        $this->elements = array();

        foreach($node_list as $node)
        {
            if($node->nodeType == 1)
            {
                $this->elements[] = new PHPHtmlDomElement($node);
            }            
        }
    }

    final public function find()
    {

    }
}

?>
