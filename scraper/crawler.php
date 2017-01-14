<?php

namespace ProductsScraper;

require_once __DIR__ . '/../vendor/autoload.php';

define('START_PAGE_URL', 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html');

$url_queue = new \Crawler\UrlsMemoryQueue(array(START_PAGE_URL));
$processor = new CatalogueProcessor(new CatalogueProcessorHelper());
$extractor = new CatalogueUrlExtractor();

$crawler = new \Crawler\Crawler();
$crawler->setProcessor($processor);
$crawler->setUrlExtractor($extractor);
$crawler->setQueue($url_queue);
$crawler->crawl(0);

echo json_encode($processor->catalogue(), JSON_PRETTY_PRINT);


