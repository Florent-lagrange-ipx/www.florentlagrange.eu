<?php if(!defined('IN_GS')){ die('You cannot load this page directly.'); }
/****************************************************
* @File: redirect.php
* @Package: GetSimple
* @Action: GS Evolve for GetSimple CMS
* *****************************************************/
header("HTTP/1.1 301 Moved Permanently");
header("Location: " . get_page_meta_keywords(false));
exit();
?>