<?php

class CatalogueNavigator extends Navigator
{
    public function test(&$url, $current_url)
    {
        return preg_match(ProductPagePattern, $url)
            && START_PAGE_URL == $current_url;
    }
}
