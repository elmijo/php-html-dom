<?php

class PHPHtmlDomTest extends PHPUnit_Framework_TestCase
{
    public $url = 'http://php.net/';

    public $file = "tests/assert/parsehtml.txt";

    public $text = '<div id="content-1"><ul><li class="item">item 1</li><li class="item">item 2</li><li class="item">item 3</li></ul></div><div id="content-2" data-target="#content-1"><p>Lorem ipsum dolor sit <i>amet</i>, consectetur adipiscing elit. <b>Pellentesque</b>vel mauris maximus, euismod massa a, dignissim erat. Fusce non lorem eget orci <span>posuere dignissim</span> ut vitae metus.</p></div>';

    protected function setUp()
    {
        $this->domurl = new PHPTools\PHPHtmlDom\PHPHtmlDom;
        $this->domfile = new PHPTools\PHPHtmlDom\PHPHtmlDom;
        $this->domtext = new PHPTools\PHPHtmlDom\PHPHtmlDom;

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\PHPHtmlDom', $this->domurl);
        $this->assertInstanceOf('PHPTools\PHPHtmlDom\PHPHtmlDom', $this->domfile);
        $this->assertInstanceOf('PHPTools\PHPHtmlDom\PHPHtmlDom', $this->domtext);
    }

    public function testImportHtmlFromUrl()
    {
        $is_imported = $this->domurl->importHTML($this->url);

        $this->assertTrue($is_imported);

        return $this->domurl;
    }

    public function testImportHtmlFromFile()
    {
        $is_imported = $this->domfile->importHTML($this->file);

        $this->assertTrue($is_imported);

        return $this->domfile;
    }

    public function testImportHtmlFromText()
    {
        $is_imported = $this->domtext->importHTML($this->text);

        $this->assertTrue($is_imported);

        return $this->domtext;
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

        $this->assertGreaterThanOrEqual(0, $domlist->count());

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $element);

        $this->assertEquals('article', $element->tagName);

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $parentElem);

        $this->assertNull($element->data('algo'));

        $this->assertNull($element->attr('id'));

        $this->assertTrue($element->hasattr('class'));

        $this->assertFalse($element->hasclass('algo'));

        $this->assertTrue($element->hasclass('newsentry'));
    }

    /**
     * @depends testImportHtmlFromFile
     */
    public function testDomListByTagNameFromFile($dom)
    {
        $domlist = $dom->e('article');

        $element = $domlist->eq(0);

        $parentElem = $element->parent();

        $find = $domlist->eq(0)->childs->find('p');

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomList', $domlist);

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomList', $find);

        $this->assertGreaterThanOrEqual(0, $domlist->count());

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $element);

        $this->assertEquals('article', $element->tagName);

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $parentElem);

        $this->assertNull($element->data('algo'));

        $this->assertNull($element->attr('id'));

        $this->assertTrue($element->hasattr('class'));

        $this->assertFalse($element->hasclass('algo'));

        $this->assertTrue($element->hasclass('newsentry'));
    }    

    /**
     * @depends testImportHtmlFromText
     */
    public function testDomListByTagNameFromText($dom)
    {
        $domlist = $dom->e('#content-1');

        $element = $domlist->eq(0);

        $parentElem = $element->parent();

        $find = $domlist->eq(0)->childs->find('li');

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomList', $domlist);

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomList', $find);

        $this->assertGreaterThanOrEqual(0, $domlist->count());

        $domlist->eq(0)->childs->find('li')->each(function($inx,$ele){
            $this->assertTrue($ele->hasclass('item'));
            $this->assertInternalType('string', $ele->text);
        });

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $element);

        $this->assertEquals('div', $element->tagName);

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $parentElem);

        $this->assertNull($element->data('algo'));

        $this->assertEquals('content-1',$element->attr('id'));

        $this->assertFalse($element->hasattr('class'));

        $this->assertFalse($element->hasclass('algo'));

    }

    /**
     * @depends testImportHtmlFromText
     */
    public function testDomListByTagNameFromTextDos($dom)
    {
        $domlist = $dom->e('#content-2');

        $element = $domlist->eq(0);

        $parentElem = $element->parent();

        $find = $domlist->eq(0)->childs->find('li');

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomList', $domlist);

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomList', $find);

        $this->assertGreaterThanOrEqual(0, $domlist->count());

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $element);

        $this->assertEquals('div', $element->tagName);

        $this->assertInstanceOf('PHPTools\PHPHtmlDom\Core\PHPHtmlDomElement', $parentElem);

        $this->assertEquals('#content-1',$element->data('target'));
    }
}