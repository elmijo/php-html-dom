<?php
namespace PHPHtmlDom;

/**
* Clase principal
*/
class PHPHtmlDom
{
    private $selector;

    private $logger;

    private $domdocument;

    private $importer;

    private $html_content; 
   
    function __construct()
    {
        $this->selector = new \Symfony\Component\CssSelector\CssSelector;
        $this->logger = new \PHPHtmlDom\Tools\PHPHtmlDomLog;
        $this->domdocument = new \DOMDocument;
        $this->importer = new \PHPHtmlDom\Tools\PHPHtmlDomImportHtml;
        $this->html_content = NULL;
    }

    final public function importHTML($text_html)
    {
        $content = $this->importer->import($text_html);

        if(!!is_null($content))
        {
            $this->logger->logWarn('E001', array($text_html));
        }
        else if(!$content)
        {
            $this->logger->logWarn('W001', array($text_html));
        }
        else
        {
            $this->html_content = $content;            
        }

        return !!$content;
    } 
}
?>