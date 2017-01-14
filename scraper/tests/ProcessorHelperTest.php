<?php

use ProductsScraper\CatalogueProcessorHelper;

class ProcessorHelperTest extends PHPUnit_Framework_TestCase
{
    function testPriceFormat()
    {
        $processor = new CatalogueProcessorHelper();
        $this->assertEquals('0.00', $processor->formatPrice(0));
        $this->assertEquals('1.00', $processor->formatPrice(1));
        $this->assertEquals('2.30', $processor->formatPrice(2.3));
        $this->assertEquals('2.34', $processor->formatPrice(2.342));
        $this->assertEquals('2.35', $processor->formatPrice(2.345));
    }

    function testPageSize()
    {
        $processor = new CatalogueProcessorHelper();
        $this->assertEquals('0kb', $processor->pageSize(str_pad('', 0)));
        $this->assertEquals('1kb', $processor->pageSize(str_pad('', 1000)));
        $this->assertEquals('10kb', $processor->pageSize(str_pad('', 10000)));
        $this->assertEquals('10.1kb', $processor->pageSize(str_pad('', 10100)));
        $this->assertEquals('10.1kb', $processor->pageSize(str_pad('', 10121)));
        $this->assertEquals('10.2kb', $processor->pageSize(str_pad('', 10152)));
    }

    function testParsePrice()
    {
        $processor = new CatalogueProcessorHelper();
        $this->assertEquals(0, $processor->parseUnitPrice('&pound;0.00/unit'));
        $this->assertEquals(1.8, $processor->parseUnitPrice('&pound;1.80/unit'));
        $this->assertEquals(2.34, $processor->parseUnitPrice('&pound;2.34/unit'));
        $this->assertEquals(2.34, $processor->parseUnitPrice('&pound;2.34/unit'));
    }
}
