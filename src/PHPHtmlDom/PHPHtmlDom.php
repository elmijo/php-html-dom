<?php
namespace PHPHtmlDom;

/**
* Clase principal
*/
class PHPHtmlDom
{
    private $selector;

    private $logger;

    private $dom;

    private $xpath;

    private $importer;

    private $html_content; 
   
    function __construct()
    {
        $this->selector = new \Symfony\Component\CssSelector\CssSelector;
        $this->logger = new \PHPHtmlDom\Tools\PHPHtmlDomLog;
        $this->dom = new \DOMDocument;
        $this->importer = new \PHPHtmlDom\Tools\PHPHtmlDomImportHtml;
        $this->html_content = NULL;

        $this->dom->preserveWhiteSpace = false;
        $this->dom->validateOnParse = true;
    }

    final public function importHTML($text_html)
    {
        $content = $this->importer->import($text_html);

        if(!!is_null($content))
        {
            $this->logger->logError('E001', array($text_html));
        }
        else if(!$content)
        {
            $this->logger->logWarn('W001', array($text_html));
        }
        else
        {
            $this->html_content = $content;
        }

        return !!$this->domImport();
    }

    final public function e($css_selector)
    {
        $xpath = $this->toXPath($css_selector);

        if(!!$xpath)
        {
            return $this->xpath->query($xpath);
        }
        // $xpath->query()
    }

    private function domImport()
    {
        $dom_import = @$this->dom->loadHTML($this->html_content);

        if(!!$dom_import)
        {
            $this->xpath = new \DOMXPath($this->dom);
        }
        else
        {
            $this->logger->logError('E002', array($this->html_content));            
        }

        return $dom_import;
    }

    private function toXPath($css_selector)
    {
        $xpath = Null;

        try
        {
            $xpath = $this->selector->toXPath($css_selector);
        }
        catch (Exception $e)
        {
            $this->logger->logError('E003', array($css_selector));
            $this->logger->logError('E000', array($e->getMessage()));
        }

        return $xpath;
    }


        // \Symfony\Component\CssSelector\Exception\SyntaxErrorException
        // $this->selector->toXPath(' #containerMenu li')

        // use Symfony\Component\CssSelector\CssSelector;


}
?>