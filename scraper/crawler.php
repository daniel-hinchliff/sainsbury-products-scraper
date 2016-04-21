<?php

// Expected /products/** url which is not the case so matching is a bit week
define('ProductPagePattern', "/Developer_Scrape\/sainsburys-.*.html/");
define('START_PAGE_URL', 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html');

require_once '../vendor/daniel-hinchliff/php_web_crawler/Base/Crawler.php';
require_once 'CatalogueProcessor.php';
require_once 'CatalogueNavigator.php';

$url_queue = new UrlsMemoryQueue(array(START_PAGE_URL));
$processor = new CatalogueProcessor();
$navigator = new CatalogueNavigator();

$crawler = new Crawler();
$crawler->setProcessor($processor);
$crawler->setNavigator($navigator);
$crawler->setQueue($url_queue);
$crawler->crawl(0);

echo json_encode($processor->products());


