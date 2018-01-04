<?php 
if(!defined("IN_GS")){ die("you cannot load this page directly."); }

	header("Content-Type: application/rss+xml");
	header("Content-Type: application/xhtml+xml");
	header("Content-Type: application/rss+xml");
	header("Content-Type: text/xml"); 
	tide_rss_feed($_GET["page"]);