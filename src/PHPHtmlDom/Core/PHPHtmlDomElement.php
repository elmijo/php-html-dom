<?php
namespace PHPTools\PHPHtmlDom\Core;

/**
* Esta clase representativa de un objeto DOMElement
*/
class PHPHtmlDomElement extends \PHPTools\PHPHtmlDom\Core\PHPHtmlDomElementAbstract
{
    /**
     * Objeto nativo php que representa un elemento DOM.
     * @var \DOMElement
     */
    protected $dom_element;

    /**
     * Nombre de la etiqueta del elemento.
     * @var string
     */
    public $tagName;

    /**
     * Texto que contiene el elemento, puede ser un arreglo de texto o una cadena d etexto simple.
     * @var array|string
     */
    public $text;

    /**
     * Texto con formato que contiene el elemento, esto abarca todas las etiquetas de estilo de texto.
     * @var string
     */
    public $textFormatting;

    /**
     * Objeto que contiene los atributos del elemento.
     * @var \stdClass
     */
    public $attrs;

    /**
     * Objeto que contiene los elementtos hijos.
     * @var \PHPTools\PHPHtmlDom\Core\PHPHtmlDomList
     */
    public $childs;

    public function __construct (\DOMElement $element)
    {
        $this->dom_element = $element;

        $this->tagName = $element->tagName;

        $this->text = '';

        $this->textFormatting = '';

        $this
            ->get_attrs()
            ->get_childs()
            ->get_Text()
        ;
    }

    /**
     * Metodo que permite obtener todos atributos del elementos y convertirlos en un objeto stdClass.
     * @return self
     */
    private function get_attrs()
    {
        $this->attrs = new \stdClass;

        foreach($this->dom_element->attributes as $name => $node)
        {
            $this->attrs->{strtolower($name)} = $node->nodeValue;
        }
        return $this;
    }

    /**
     * Metodo que permite obtener los elementos hijos y convertirlos en un objeto lista PHPHtmlDomList.
     * @return self
     */
    private function get_childs()
    {
       $this->childs = new \PHPTools\PHPHtmlDom\Core\PHPHtmlDomList($this->dom_element->childNodes);

       return $this;
    }

    /**
     * Metodo que permite obtener el texto que se encuentra dentro del elemento. 
     * @return self
     */
    private function get_Text()
    {
        $text_formatting = array('b','strong','em','i','small','strong','sub','sup','ins','del','mark','br','hr');

        foreach ($this->dom_element->childNodes as $node)
        {
            if($node->nodeType == 3)
            {
                $this->set_text(trim($node->textContent));
                $this->textFormatting.=$node->textContent;
            }
            else if($node->nodeType == 1 && !!in_array($node->tagName, $text_formatting))
            {
                if(!!in_array($node->tagName, ['br','hr']))
                {
                    $this->textFormatting.= sprintf('<%s>',$node->tagName);
                }
                else
                {
                    $tag = $node->tagName;
                    $attrs = $this->attrs_to_string($node->attributes);
                    $text = $node->textContent;

                    $this->textFormatting.= sprintf('<%1$s%2$s>%3$s</%1$s>',$tag,$attrs,$text);
                }
            }            
        }

        return $this;
    }

    /**
     * Metodo que permite definir e texto del elemento.
     * @param string  $text Cden de texto a definirse.
     * @return self
     */
    private function set_text($text)
    {
        if(!!$text)
        {
            if(!!$this->text)
            {
                if(!!is_array($this->text))
                {
                    $this->text[] = $text;
                }
                else
                {
                    $this->text = array($this->text,$text);
                }
            }
            else
            {
                $this->text = $text;
            }
        }

        return $this;       
    }

    /**
     * Este metodo permite concatenar un objeto de atributos en una sola cadena. 
     * @param  attay $attrs Arreglo de atributos.
     * @return string
     */
    private function attrs_to_string($attrs)
    {
        $attrs_string ='';

        foreach($attrs as $name => $node)
        {
            $attrs_string.= sprintf(' %s="%s"',$name,$node->nodeValue);
        }

        return $attrs_string;
    }
}