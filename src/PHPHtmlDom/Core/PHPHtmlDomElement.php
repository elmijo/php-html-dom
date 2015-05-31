<?php
namespace PHPTools\PHPHtmlDom\Core;

use PHPTools\PHPHtmlDom\Core\PHPHtmlDomList;
use PHPTools\PHPHtmlDom\Core\PHPHtmlDomElementAbstract;

$not_element_content = array('area','base','br','col','command','embed','hr','img','input','link','meta','param','source');

/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomElement extends PHPHtmlDomElementAbstract
{
    protected $dom_element;

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

    private function get_attrs()
    {
        $this->attrs = new \stdClass;

        foreach($this->dom_element->attributes as $name => $node)
        {
            $this->attrs->{strtolower($name)} = $node->nodeValue;
        }
        return $this;
    }

    private function get_childs()
    {
       $this->childs = new PHPHtmlDomList($this->dom_element->childNodes);

       return $this;
    }

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
?>
