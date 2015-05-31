<?php

require 'vendor/autoload.php';
/**
* 
*/
class PHPHtmlDomTest extends PHPUnit_Framework_TestCase
{
    public $url = 'http://php.net/';

    public $file = "tests/assert/parsehtml.txt";

    public $text = '<div id="content-1"><ul><li class="item">item 1</li><li class="item">item 2</li><li class="item">item 3</li></ul></div><div id="content-2" data-target="#content-1"><p>Lorem ipsum dolor sit <i>amet</i>, consectetur adipiscing elit. <b>Pellentesque</b>vel mauris maximus, euismod massa a, dignissim erat. Fusce non lorem eget orci <span>posuere dignissim</span> ut vitae metus.</p></div>';

    public function testInstancePHPHtmlDom()
    {
        $dom = new PHPTools\PHPHtmlDom\PHPHtmlDom;

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\PHPHtmlDom', $dom);

        return $dom;
    }

    /**
     * @depends testInstancePHPHtmlDom
     */
    public function testImportHtmlFromUrl($dom)
    {
        $is_imported = $dom->importHTML($this->url);

        $this->assertTrue($is_imported);

        return $dom;
    }

    /**
     * @depends testInstancePHPHtmlDom
     */
    public function testImportHtmlFromFile($dom)
    {
        $is_imported = $dom->importHTML($this->url);

        $this->assertTrue($is_imported);

        return $dom;
    }

    /**
     * @depends testInstancePHPHtmlDom
     */
    public function testImportHtmlFromText($dom)
    {
        $is_imported = $dom->importHTML($this->url);

        $this->assertTrue($is_imported);

        return $dom;
    }

    /**
     * @depends testImportHtmlFromUrl
     */
    public function testDomListByTagNameFromUrl($dom)
    {
        $domlist = $dom->e('article');

        $element = $domlist->eq(0);

        $parentElem = $element->parent();

        $find = $domlist->eq(0)->childs->find('p');

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomList', $domlist);

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomList', $find);

        $this->assertGreaterThan(0, $domlist->count());

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $element);

        $this->assertEquals('article', $element->tagName);

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $parentElem);

        $this->assertNull($element->data('algo'));

        $this->assertNull($element->attr('id'));

        $this->assertTrue($element->hasattr('class'));

        $this->assertFalse($element->hasclass('algo'));

        $this->assertTrue($element->hasclass('newsentry'));
    }
}