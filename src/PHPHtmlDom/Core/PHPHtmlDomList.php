<?php
namespace PHPTools\PHPHtmlDom\Core;

/**
* Esta clase permite manipulat un la listas de elementos.
*/
class PHPHtmlDomList extends \PHPTools\PHPHtmlDom\Core\PHPHtmlDomListAbstract
{
    /**
     * Caena de texto con la lista de elementos concatenados.
     * @var string
     */
    protected $list_html;

    /**
     * Arreglo con los elementos de la listas.
     * @var array
     */
    protected $elements = array();

    public function __construct (\DOMNodeList $node_list)
    {
        $d = new \DOMDocument();

        foreach($node_list as $node)
        {
            if($node->nodeType == 1&&!in_array($node->tagName, ['br','hr']))
            {
                $this->elements[] = new \PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement($node);

                $d->appendChild($d->importNode($node->cloneNode(TRUE),TRUE));
            }
        }

        $this->list_html = trim($d->saveHTML());
    }
}