<?php

namespace ProductsScraper;

require_once __DIR__ . '/include.php';

$url_queue = new \UrlsMemoryQueue(array(START_PAGE_URL));
$processor = new CatalogueProcessor(new CatalogueProcessorHelper());
$extractor = new CatalogueUrlExtractor();

$crawler = new \Crawler();
$crawler->setProcessor($processor);
$crawler->setUrlExtractor($extractor);
$crawler->setQueue($url_queue);
$crawler->crawl(0);

echo json_encode($processor->catalogue(), JSON_PRETTY_PRINT);


