<?php
namespace PHPTools\PHPHtmlDom;

/**
* Esta es la clas eque el usuario debe inicializar para convertir un texto html en un objeto DOM.
*/
class PHPHtmlDom
{
    /**
     * Objeto que permite convertir un selector css en un path.
     * @var \Symfony\Component\CssSelector\CssSelector
     */
    private $selector;

    /**
     * Objeto que permite escribir logs.
     * @var \PHPTools\PHPHtmlDom\Core\PHPHtmlDomLog
     */
    private $logger;

    /**
     * Objeto nativo de php que permite crear un documento DOM.
     * @var \DOMDocument
     */
    private $dom;

    /**
     * Objeto nativo de php que permite buscar un xpath dentro de un documento DOM.
     * @var \DOMXPath
     */
    private $xpath;

    /**
     * Objeto que permite importar el contennido html.
     * @var \PHPTools\PHPHtmlDom\Core\PHPHtmlDomImportHtml
     */
    private $importer;

    /**
     * Contenido crudo html.
     * @var string
     */
    private $html_content; 
   
    public function __construct()
    {
        $this->selector = new \Symfony\Component\CssSelector\CssSelector;
        $this->logger = new \PHPTools\PHPHtmlDom\Core\PHPHtmlDomLog;
        $this->dom = new \DOMDocument;
        $this->importer = new \PHPTools\PHPHtmlDom\Core\PHPHtmlDomImportHtml;
        $this->html_content = NULL;

        $this->dom->preserveWhiteSpace = false;
        $this->dom->validateOnParse = true;
    }

    /**
     * Metodo que importa y convierte el contenido html en un objeto DOM.
     * @param  string $text_html Cadena de texto con la url, path, texto html.
     * @return boolean
     */
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

    /**
     * Metodo que permite buscar elementos hijos a partir de un selector css.
     * @param  string $css_selector Cadena de texto con el selector css.
     * @return PHPTools\PHPHtmlDom\Core\PHPHtmlDomList
     */
    final public function e($css_selector)
    {
        $xpath = $this->toXPath($css_selector);

        if(!!$xpath)
        {
            return new \PHPTools\PHPHtmlDom\Core\PHPHtmlDomList($this->xpath->query($xpath));
        }
    }

    /**
     * Permite importar el contenido dom del texto html.
     * @return boolean
     */
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

    /**
     * Metodo que convierte un selector css en un xpath
     * @param  string $css_selector Cadena de texto con el selector css.
     * @return string|NULL          Devuelve una cadena de texto con formato xpath si la converción e sposible o NULL en caso contrario.
     */
    private function toXPath($css_selector)
    {
        $xpath = Null;

        try
        {
            $xpath = $this->selector->toXPath($css_selector);
        }
        catch (\Exception $e)
        {
            $this->logger->logError('E003', array($css_selector));
            $this->logger->logError('E000', array($e->getMessage()));
        }

        return $xpath;
    }
}