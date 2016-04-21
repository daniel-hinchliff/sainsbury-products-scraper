<?php

class CatalogueProcessor extends Processor
{
    protected $products = array();

    public function filter($url)
    {
        return preg_match(ProductPagePattern, $url);
    }

    public function process($content, $current_url)
    {
        echo $current_url, "\n";
    }

    public function products()
    {
        return $this->products;
    }

}

