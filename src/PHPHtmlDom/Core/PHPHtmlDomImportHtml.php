<?php
namespace PHPTools\PHPHtmlDom\Core;

/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomImportHtml
{
    private $context = NULL;

    private $context_options = array('http'=>array('method'=>"GET",'timout'=> 6,'ignore_errors' => true));

    function __construct()
    {
       $this->context = stream_context_create($this->context_options);
    }

    final public function import($content)
    {

        if(!!filter_var($content,FILTER_VALIDATE_URL)||!!is_readable($content))
        {
            $content = @file_get_contents($content,false,$this->context);

            return !!$this->isStringHtml($content)?$content:False;
        }

        return !!$this->isStringHtml($content)?$content:NULL;
    }

    private function isStringHtml($str)
    {
        return $str != strip_tags($str);
    }
}

?>
