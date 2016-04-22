<?php

require_once __DIR__ . '/include.php';

$url_queue = new UrlsMemoryQueue(array(START_PAGE_URL));
$extractor = new CatalogueUrlExtractor();
$processor = new CatalogueProcessor();

$crawler = new Crawler();
$crawler->setProcessor($processor);
$crawler->setUrlExtractor($extractor);
$crawler->setQueue($url_queue);
$crawler->crawl(0);

echo json_encode($processor->catalogue(), JSON_PRETTY_PRINT);


