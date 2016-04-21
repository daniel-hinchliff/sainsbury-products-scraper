<?php

use Sunra\PhpSimple\HtmlDomParser;

class CatalogueUrlExtractor extends UrlExtractor
{
    public function extract($content, $current_url)
    {
        if ($current_url != START_PAGE_URL)
        {
            return array();
        }

        $html = HtmlDomParser::str_get_html($content);

        $links = $html->find('.productInfo a');

        return array_map(function ($link) {
            return $link->getAttribute('href');
        }, $links);
    }
}
