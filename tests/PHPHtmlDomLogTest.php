<?php

class PHPHtmlDomLogTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->logger = new \PHPTools\PHPHtmlDom\Core\PHPHtmlDomLog;
    }
    public function testOne()
    {
        $this->assertInstanceOf('\PHPTools\PHPHtmlDom\Core\PHPHtmlDomLog', $this->logger);
    }
    public function testLogError()
    {
        $this->assertNull($this->logger->logError('E000',array('probando logError 1..')));
        $this->assertNull($this->logger->logError('E001',array('probando logError 1.. 2..')));
        $this->assertNull($this->logger->logError('E002',array('probando logError 1.. 2.. 3..')));
        $this->assertNull($this->logger->logError('E003',array('probando logError 1.. 2.. 3.. 4..')));
    }
    public function testlogWarn()
    {
        $this->assertNull($this->logger->logWarn('W000',array('probando logWarn 1..')));
        $this->assertNull($this->logger->logWarn('W001',array('probando logWarn 1.. 2..')));
    }
    public function testloginfo()
    {
        $this->assertNull($this->logger->logInfo('I000',array('probando logInfo 1..')));
    }
}