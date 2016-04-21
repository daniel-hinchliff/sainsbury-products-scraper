<?php

define('START_PAGE_URL', 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html');

require_once '../vendor/autoload.php';
require_once '../vendor/daniel-hinchliff/php_web_crawler/Base/Crawler.php';
require_once 'CatalogueProcessor.php';
require_once 'CatalogueUrlExtractor.php';
require_once 'Product.php';

$url_queue = new UrlsMemoryQueue(array(START_PAGE_URL));
$extractor = new CatalogueUrlExtractor();
$processor = new CatalogueProcessor();

$crawler = new Crawler();
$crawler->setProcessor($processor);
$crawler->setUrlExtractor($extractor);
$crawler->setQueue($url_queue);
$crawler->crawl(0);

file_put_contents('results.json', json_encode($processor->catalogue()));


