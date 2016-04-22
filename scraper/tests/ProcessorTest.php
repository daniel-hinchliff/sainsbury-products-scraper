<?php

require_once __DIR__ . '/../include.php';

use ProductsScraper\CatalogueProcessor;

class ProcessorTest extends PHPUnit_Framework_TestCase
{
    function testPriceFormat()
    {
        $processor = new CatalogueProcessor();
        $this->assertEquals('0.00', $processor->formatPrice(0));
        $this->assertEquals('1.00', $processor->formatPrice(1));
        $this->assertEquals('2.30', $processor->formatPrice(2.3));
        $this->assertEquals('2.34', $processor->formatPrice(2.342));
        $this->assertEquals('2.35', $processor->formatPrice(2.345));
    }

    function testPageSize()
    {
        $processor = new CatalogueProcessor();
        $this->assertEquals('0kb', $processor->pageSize(str_pad('', 0)));
        $this->assertEquals('1kb', $processor->pageSize(str_pad('', 1000)));
        $this->assertEquals('10kb', $processor->pageSize(str_pad('', 10000)));
        $this->assertEquals('10.1kb', $processor->pageSize(str_pad('', 10100)));
        $this->assertEquals('10.1kb', $processor->pageSize(str_pad('', 10121)));
        $this->assertEquals('10.2kb', $processor->pageSize(str_pad('', 10152)));
    }

    function testParsePrice()
    {
        $processor = new CatalogueProcessor();
        $this->assertEquals(0, $processor->parseUnitPrice('&pound;0.00/unit'));
        $this->assertEquals(1.8, $processor->parseUnitPrice('&pound;1.80/unit'));
        $this->assertEquals(2.34, $processor->parseUnitPrice('&pound;2.34/unit'));
        $this->assertEquals(2.34, $processor->parseUnitPrice('&pound;2.34/unit'));
    }

    function testDataExtraction()
    {
        // Given
        $processor = new CatalogueProcessor();
        $product_page = file_get_contents(__DIR__ . '/sample_product.html');

        // When
        $processor->process($product_page, 'url');
        $processor->process($product_page, 'url');

        // Then
        $catalogue = $processor->catalogue();
        $this->assertEquals('3.00', $catalogue['total']);
        $this->assertEquals(2, count($catalogue['results']));

        $product_a = $catalogue['results'][0];
        $product_b = $catalogue['results'][1];
        $this->assertEquals($product_a, $product_b);
        $this->assertEquals("Sainsbury's Conference Pears, Ripe & Ready x4 (minimum)", $product_a->title);
        $this->assertEquals("Conference", $product_a->description);
        $this->assertEquals("1.50", $product_a->unit_price);
        $this->assertEquals("40.3kb", $product_a->size);
    }
}
