<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
	/****************************************************
		*
		* @File:      download.php
		* @Package:   GetSimple
		* @Action:    GS Evolve for GetSimple CMS
		*
	*****************************************************/

$object = $_GET['name'];
$file = $_GET['file'];
$download = GSDATAPATH.'uploads/'.$file;
//header("Location: $download");
exit();
?>
