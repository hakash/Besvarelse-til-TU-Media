#!/usr/bin/php
<?php

ini_set("display_errors",1);
error_reporting(-1);

function getArticleURLs($url, $querystring, $recurse = false){
	$urls = [];

	$doc = new DOMDocument();
	@$doc->loadHTMLFile($url . $querystring);
	$xpath = new DOMXPath($doc);

	$nodelist = $xpath->query("//table[@class='search-results']/tbody/tr/th/h4/a/@href[../../../../td/small/time[contains(text(),'2012')]]");
	foreach($nodelist as $node){
		$urls[] = $node->nodeValue;
	}

	if($recurse){
		$visited = [];
		$nodelist = $xpath->query("//ul[@class[starts-with(., 'pagination')]]/li/a/@href");
		foreach($nodelist as $node){
			if(array_search($node->nodeValue, $visited) === false){
				$visited[] = $node->nodeValue;
				array_merge($urls, getArticleURLs($url, $node->nodeValue));
			}
		}
	}

	return $urls;
}

function getPageData($url){

	$data = new stdClass();
	$data->url = $url;
	$data->title = "";
	$data->image = "";
	$data->published = "";
	$data->author = "";
	$data->numComments = -1;

	$doc = new DOMDocument();
	@$doc->loadHTMLFile($url);
	$xpath = new DOMXPath($doc);

	$nodelist = $xpath->query("//span[@class='diskusjon-post-count']");
	$data->numComments = $nodelist->item(0)->nodeValue;
	
	$nodelist = $xpath->query("//meta[@property='og:title']/@content");
	$data->title = $nodelist->item(0)->nodeValue;

	$nodelist = $xpath->query("//meta[@property='og:image']/@content");
	$data->image = $nodelist->item(0)->nodeValue;

	$nodelist = $xpath->query("//meta[@property='article:published_time']/@content");
	$data->published = $nodelist->item(0)->nodeValue;

	$nodelist = $xpath->query("//meta[@property='og:article:author']/@content");
	$data->author = $nodelist->item(0)->nodeValue;

	return $data;
}

$base_url = "http://www.tek.no/artikler";
$seed_querystring = "?q=ivy+bridge";
$articlesByAuthor = new stdClass();

$urls = getArticleURLs($base_url, $seed_querystring, true);

foreach($urls as $url){
	$data = getPageData($url);
	if(!isset($articlesByAuthor->{$data->author})){
		$articlesByAuthor->{$data->author} = [];
	}
	$articlesByAuthor->{$data->author}[] = $data;
}

foreach($articlesByAuthor as $author => $articles){
	usort($articlesByAuthor->{$author},function($a,$b){
		if( $a->numComments > $b->numComments) return 1;
		if( $a->numComments < $b->numComments) return -1;
		return 0;
	});
}

echo json_encode($articlesByAuthor, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

echo PHP_EOL . PHP_EOL;