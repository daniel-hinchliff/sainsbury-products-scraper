<?php

namespace ProductsScraper;

class CatalogueProcessorHelper
{
    public function parseUnitPrice($html_price)
    {
        preg_match('/[0-9]+\.[0-9]{2}/', $html_price, $matches);

        if (empty($matches))
        {
            throw new \Exception("Invalid price [$html_price]");
        }

        return floatval($matches[0]);
    }

    public function formatPrice($price)
    {
        return sprintf("%.2f", $price);
    }

    public function pageSize($content)
    {
        return round(strlen($content) / 1000, 1) . "kb";
    }
}
