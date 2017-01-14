<?php

namespace ProductsScraper;

use Sunra\PhpSimple\HtmlDomParser;

class CatalogueProcessor extends \Crawler\Processor
{
    protected $total = 0;
    protected $helper = null;
    protected $products = array();

    const descriptionSelector = 'div.productText p';
    const priceSelector = '.pricePerUnit';
    const titleSelector = 'h1';

    public function __construct(CatalogueProcessorHelper $helper)
    {
        $this->helper = $helper;
    }

    public function filter($url)
    {
        return START_PAGE_URL != $url;
    }

    public function process($content, $current_url)
    {
        $html = HtmlDomParser::str_get_html($content);

        $html_price = $this->getElementText($html, self::priceSelector);
        $price = $this->helper->parseUnitPrice($html_price);

        $product = new Product();
        $product->title = $this->getElementText($html, self::titleSelector);
        $product->description = $this->getElementText($html, self::descriptionSelector);
        $product->unit_price = $this->helper->formatPrice($price);
        $product->size = $this->helper->pageSize($content);

        $this->products[] = $product;
        $this->total += $price;
    }

    protected function getElementText($html, $selector)
    {
        $element = $html->find($selector, 0);

        if (empty($element))
        {
            throw new \Exception("Element [$selector] not found");
        }

        return $element->plaintext;
    }

    public function catalogue()
    {
        return array(
            'results' => $this->products,
            'total' => $this->helper->formatPrice($this->total),
        );
    }
}

