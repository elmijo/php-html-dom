<?php
namespace PHPHtmlDom\Tools;

use PHPHtmlDom\Tools\PHPHtmlDomElement;
/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomList/* extends \PHPErrorLog\PHPErrorLog*/
{
    private $node_list = array();

    public function __construct (\DOMNodeList $node_list)
    {
        foreach($node_list as $node)
        {
            $this->node_list[] = new PHPHtmlDomElement($node);
        }
    }

    final public function find()
    {

    }
}

?>
