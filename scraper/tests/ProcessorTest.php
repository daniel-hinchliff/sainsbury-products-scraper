<?php

use ProductsScraper\CatalogueProcessor;
use ProductsScraper\CatalogueProcessorHelper;
use PHPUnit\Framework\TestCase;

class ProcessorTest extends TestCase
{
    function testDataExtraction()
    {
        // Given
        $processor = new CatalogueProcessor(new CatalogueProcessorHelper());
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
