<?php
namespace PHPHtmlDom\Tools;

use PHPHtmlDom\Tools\PHPHtmlDomList;
/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomElement
{
    private $current_element;

    // private $not_element_content = ['area','base','br','col','command','embed','hr','img','input','link','meta','param','source'];

    public function __construct (\DOMElement $element)
    {
        $this->current_element = $element;

        $this->tagName = $element->tagName;

        $this->text = '';

        $this
            ->getAllAttrs()
            ->getAllChilds()
            ->getAllText()
        ;

        // var_dump($element->ownerDocument);
    }

    final public function hasattr($attr)
    {
        return !!isset($this->attrs->{$attr});
    }

    private function getAllAttrs()
    {
        $this->attrs = new \stdClass;

        foreach($this->current_element->attributes as $name => $node)
        {
            $this->attrs->{strtolower($name)} = $node->nodeValue;
        }
        return $this;
    }

    private function getAllChilds()
    {
       $this->childs = new PHPHtmlDomList($this->current_element->childNodes);

       return $this;
    }

    private function getAllText()
    {
        foreach ($this->current_element->childNodes as $child)
        {
            if($child->nodeType == 3)
            {
                $this->setText(trim($child->textContent));
            }
        }

        return $this;
    }

    private function setText($text)
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
}

?>
