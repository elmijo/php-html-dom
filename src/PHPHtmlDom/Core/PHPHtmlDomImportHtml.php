<?php
namespace PHPTools\PHPHtmlDom\Core;

/**
* Clase permite obtener un contenido que pude venir de una url o una archivo
*/
class PHPHtmlDomImportHtml
{
    /**
     * contexto de flujo.
     * @var resource
     */
    private $context;

    /**
     * Opcionees del contexto de flujo
     * @var array
     */
    private $context_options = array('http'=>array('method'=>"GET",'timout'=> 6,'ignore_errors' => true));

    function __construct()
    {
       $this->context = stream_context_create($this->context_options);
    }

    /**
     * Este metodo permite importar el contenido proveniente de una url, path o texto.
     * @param  string $content Cadena de texto con la url, path o texto html.
     * @return string|boolean     Devuelve el contenido importado si el mismo tiene formato html o False en caso contrario.
     */
    final public function import($content)
    {
        if(!!filter_var($content,FILTER_VALIDATE_URL)||!!is_readable($content))
        {
            $content = @file_get_contents($content,false,$this->context);

            return !!$this->isStringHtml($content)?$content:False;
        }
        return !!$this->isStringHtml($content)?$content:NULL;
    }

    /**
     * Este metodo permite validar si una cadena de texto efectivamente es texto html.
     * @param  string  $str Cadena de texto a evaluar.
     * @return boolean
     */
    private function isStringHtml($str)
    {
        return $str != strip_tags($str);
    }
}

?>
