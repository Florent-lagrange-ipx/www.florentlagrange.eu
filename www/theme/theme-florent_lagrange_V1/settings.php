<?php
/*****************************/
/** Theme's current version **/
/*****************************/
$theme_ver = "0.3";
/*****************************/
?>
<style>
	.evolve-settings {
	padding-left: 8px;
    padding-right: 20px;
	}
	.container-collapsed {
    margin-bottom: 20px;
	padding: 5px;
	}
	.component-settings, .expand-settings {
    display: none;
    padding: 5px;
	}
	.iframe-buttn, .sl-trans-button {
	float: right;
	line-height: 21px !important;
	margin-right: 2px;
	color: #CCC !important;
	font-weight: bold !important;
	text-decoration: none !important;
	background-color: #182227;
	text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.2);
	transition: all 0.1s ease-in-out 0s;
	font-size: 10px;
	text-transform: uppercase;
	display: block;
	padding: 3px 10px;
	float: right;
	margin: 0px 0px 0px 5px;
	border-radius: 3px;
	background-repeat: no-repeat;
	background-position: 94% center;
	cursor: pointer;
	border: medium none;
	}
	.iframe-buttn:hover, .sl-trans-button:hover {
	line-height: 21px !important;
	background-color: #CF3805;
	text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.2);
	}
	.inner-divs label {
    display: inline-block;
    padding-right: 10px;
    margin-top: 4px;
	}
	.effect-text {
    padding-left: 30px;
    margin-top: 4px;
	}
	#effect-code {
    padding: 5px 10px;
    border-radius: 2px;
    border: 1px solid rgb(170, 170, 170);
	}
	#effect-code code {
    color: #F00;
    font-size: 1.3em;
	}
	.collapsedlegend {
    cursor: pointer;
    background-image: url("../admin/template/images/utick.png");
    background-repeat: no-repeat;
    background-position: 92% center;
    padding: 0px 18px 0px 8px;
    margin: 6px;
	}
	textarea {
	width: 98% !important;
	height: auto !important;
	margin-bottom: 10px;
	}
	#contact_photo {
	width: 75% !important;
	margin-bottom: 10px;
	}
	#snapshot, #snapshot1 {
    -moz-transition: all .5s;
    -webkit-transition: all .5s;
    transition: all .5s;
    -moz-transform: scale(1,1);
    -webkit-transform: scale(1,1);
    transform: scale(1,1);
	overflow: hidden;
	cursor: zoom-in;
	}
	#snapshot:hover, #snapshot1:hover {
	-moz-transform: scale(2,2);
    -webkit-transform: scale(2,2);
    transform: scale(1.5,1.5);
	}
	#container-4 label {
		width: 118px;
	}
	
.wrapper-tooltip {
  cursor: help;
  margin: 4px;
  padding: 2px 10px;
  background-image: url("../theme/Evolve/images/question.png");
  background-repeat: no-repeat;
  display: inline;
  position: relative;
  text-align: center;
  -webkit-transform: translateZ(0); /* webkit flicker fix */
  -webkit-font-smoothing: antialiased; /* webkit text rendering fix */
}

.wrapper-tooltip .tooltip {
  background: #000000;
  bottom: 100%;
  color: #fff;
  display: block;
  left: -140px;
  margin-bottom: 15px;
  opacity: 0;
  padding: 20px;
  pointer-events: none;
  position: absolute;
  width: 260px;
  border-radius: 6px;
  -webkit-transform: translateY(10px);
     -moz-transform: translateY(10px);
      -ms-transform: translateY(10px);
       -o-transform: translateY(10px);
          transform: translateY(10px);
  -webkit-transition: all .25s ease-out;
     -moz-transition: all .25s ease-out;
      -ms-transition: all .25s ease-out;
       -o-transition: all .25s ease-out;
          transition: all .25s ease-out;
  -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
     -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
      -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
       -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
          box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the tooltip without it disappearing */
.wrapper-tooltip .tooltip:before {
  bottom: -20px;
  content: " ";
  display: block;
  height: 20px;
  left: 0;
  position: absolute;
  width: 100%;
}  

/* CSS Triangles - see Trevor's post */
.wrapper-tooltip .tooltip:after {
  border-left: solid transparent 10px;
  border-right: solid transparent 10px;
  border-top: solid #000000 10px;
  bottom: -10px;
  content: " ";
  height: 0;
  left: 50%;
  margin-left: -13px;
  position: absolute;
  width: 0;
}
  
.wrapper-tooltip:hover .tooltip {
  opacity: 1;
  pointer-events: auto;
  -webkit-transform: translateY(0px);
     -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
       -o-transform: translateY(0px);
          transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .wrapper-tooltip .tooltip {
  display: none;
}

.lte8 .wrapper-tooltip:hover .tooltip {
  display: block;
}
.theme-version {
    position: relative;
	text-align: right;
    top: -22px;
    margin-bottom: -15px;
}
</style>

<?php
global $TEMPLATE;
global $SITENAME; 

	if(!defined('IN_GS') || !cookie_check()) die;
	
	global $error_file, $eror_path, $eror_component;
	$error_file=false;
	$eror_component=false;
	
	if (!function_exists('component_exists')) {
		function component_exists($id) {
			global $components;
			if (!$components) {
				if (file_exists(GSDATAOTHERPATH.'components.xml')) {
					$data = getXML(GSDATAOTHERPATH.'components.xml');
					$components = $data->item;
					} else {
					$components = array();
				}
			}
			$exists = FALSE;
			if (count($components) > 0) {
				foreach ($components as $component) {
					if ($id == $component->slug) {
						$exists = TRUE;
						break;
					}
				}
			}
			return $exists;
		}
	}
	
	function plugins_check($search_for) {
		if(!empty($search_for) && file_exists(GSDATAOTHERPATH.'plugins.xml')) {
			$data = getXML(GSDATAOTHERPATH.'plugins.xml');
			$aplugins = $data->item;
			if (count($aplugins) > 0) {
				foreach ($aplugins as $aplugin) {
					if ($search_for == rtrim($aplugin->plugin, ".php") && $aplugin->enabled == 'true') {
						return true;
						break;
					}
				}
			}
		}
		return false;
	}
	
	function custom_getXML($file, $nocdata = true) {
		if (!file_exists($file)) {
			global $error_file, $eror_path;
			$eror_path = $file;
			$error_file=true;
			return false;
		}
		$xml = @file_get_contents($file);
		if ($xml) {
			if ($nocdata) {
				$data = simplexml_load_string($xml, 'SimpleXMLExtended', LIBXML_NOCDATA);
				} else {
				$data = simplexml_load_string($xml, 'SimpleXMLExtended');
			}
			return $data;
		}
	}
	
	function remove_component($file,$slug) {
		$data = custom_getXML($file, false);
		foreach($data->item as $item) {
			if($item->slug == $slug) {
				$dom = dom_import_simplexml($item);
				$dom->parentNode->removeChild($dom);
			}
		}
		XMLsave($data, $file);
	}
	
	function import_component($file, $component_slug) {
		global $TEMPLATE;
		$c_path = trim("../theme/" . $TEMPLATE)."/inc/".$component_slug.".php";
		$c_title = str_replace("-"," ", ucfirst($component_slug));
		if(file_exists($c_path)) include($c_path);
		else {
			global $eror_component;
			$eror_component=true;
			return false;
		}
		$param = htmlentities($param,ENT_QUOTES,'UTF-8');
		$data = custom_getXML($file, false);
		if ($data) {
			$component = $data;
			$components = $component->addChild('item');
			$compons = $components->addChild('title');
			$compons->addCData($c_title);
			$compons = $components->addChild('slug', $component_slug);
			$compons = $components->addChild('value');
			$compons->addCData( $param);
			XMLsave($data, $file);
		}
	}
	
	function check_data_contact() {
		/*******************************************
			***      Create XML for Contact form     ***
			***             if not exist             ***
		********************************************/
		if (!file_exists(GSDATAPAGESPATH.'contact.xml')) {
			global $pagesArray, $USR, $USR1;
			$pagesSorted = subval_sort($pagesArray, 'menuOrder');
			if (count($pagesSorted) != 0) {
				$menu_order = 0;
				foreach ($pagesSorted as $page) {
					if($menu_order < (int)$page['menuOrder']) $curr_order = (int)$page['menuOrder'];
				}
				$curr_order = $curr_order + 1;
			}
			else $curr_order = 0;
			$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
			$xml->addChild('pubDate', date(DATE_RFC2822));
			$dataval = $xml->addChild('title');
			$dataval->addCData("Contact");
			$dataval = $xml->addChild('url');
			$dataval->addCData("contact");
			$dataval = $xml->addChild('meta');
			$dataval->addCData("");
			$dataval = $xml->addChild('metad');
			$dataval->addCData("");
			$dataval = $xml->addChild('menu');
			$dataval->addCData("Contact");
			$dataval = $xml->addChild('menuOrder');
			$dataval->addCData($curr_order);
			$dataval = $xml->addChild('menuStatus');
			$dataval->addCData("Y");
			$dataval = $xml->addChild('template');
			$dataval->addCData("contact.php");
			$dataval = $xml->addChild('parent');
			$dataval->addCData("");
			$dataval = $xml->addChild('content');
			$dataval->addCData("E-message sending form");
			$dataval = $xml->addChild('private');
			$dataval->addCData("");
			$dataval = $xml->addChild('author');
			$dataval->addCData(isset($USR1)?$USR1:$USR);
			$xml->asXML(GSDATAPAGESPATH.'contact.xml');
			if (function_exists('i18n_init')) {
				if (!file_exists(GSDATAPAGESPATH.'contact_lt.xml')) {
					$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
					$xml->addChild('pubDate', date(DATE_RFC2822));
					$dataval = $xml->addChild('title');
					$dataval->addCData("Kontaktai");
					$dataval = $xml->addChild('url');
					$dataval->addCData("contact_lt");
					$dataval = $xml->addChild('meta');
					$dataval->addCData("");
					$dataval = $xml->addChild('metad');
					$dataval->addCData("");
					$dataval = $xml->addChild('menu');
					$dataval->addCData("Kontaktai");
					$dataval = $xml->addChild('menuOrder');
					$dataval->addCData("0");
					$dataval = $xml->addChild('menuStatus');
					$dataval->addCData("");
					$dataval = $xml->addChild('template');
					$dataval->addCData("contact.php");
					$dataval = $xml->addChild('parent');
					$dataval->addCData("");
					$dataval = $xml->addChild('content');
					$dataval->addCData("El. pranešimų siuntimo formą");
					$dataval = $xml->addChild('private');
					$dataval->addCData("");
					$dataval = $xml->addChild('author');
					$dataval->addCData(isset($USR1)?$USR1:$USR);
					$xml->asXML(GSDATAPAGESPATH.'contact_lt.xml');
				}
				if (!file_exists(GSDATAPAGESPATH.'contact_ru.xml')) {
					$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
					$xml->addChild('pubDate', date(DATE_RFC2822));
					$dataval = $xml->addChild('title');
					$dataval->addCData("Контакты");
					$dataval = $xml->addChild('url');
					$dataval->addCData("contact_ru");
					$dataval = $xml->addChild('meta');
					$dataval->addCData("");
					$dataval = $xml->addChild('metad');
					$dataval->addCData("");
					$dataval = $xml->addChild('menu');
					$dataval->addCData("Контакты");
					$dataval = $xml->addChild('menuOrder');
					$dataval->addCData("0");
					$dataval = $xml->addChild('menuStatus');
					$dataval->addCData("");
					$dataval = $xml->addChild('template');
					$dataval->addCData("contact.php");
					$dataval = $xml->addChild('parent');
					$dataval->addCData("");
					$dataval = $xml->addChild('content');
					$dataval->addCData("E-форма отправки сообщений");
					$dataval = $xml->addChild('private');
					$dataval->addCData("");
					$dataval = $xml->addChild('author');
					$dataval->addCData(isset($USR1)?$USR1:$USR);
					$xml->asXML(GSDATAPAGESPATH.'contact_ru.xml');
				}
			}
			$xml_file = @file_get_contents(GSDATAOTHERPATH.'pages.xml');
			$xml_pages = simplexml_load_string($xml_file, 'SimpleXMLExtended');
			if ($xml_pages) {
				$items = $xml_pages->addChild('item');
				$items->addChild('pubDate', date(DATE_RFC2822));
				$datavap = $items->addChild('title');
				$datavap->addCData("Contact");
				$datavap = $items->addChild('url');
				$datavap->addCData("contact");
				$datavap = $items->addChild('meta');
				$datavap->addCData("");
				$datavap = $items->addChild('metad');
				$datavap->addCData("");
				$datavap = $items->addChild('menu');
				$datavap->addCData("Contact");
				$datavap = $items->addChild('menuOrder');
				$datavap->addCData($curr_order);
				$datavap = $items->addChild('menuStatus');
				$datavap->addCData("Y");
				$datavap = $items->addChild('template');
				$datavap->addCData("contact.php");
				$datavap = $items->addChild('parent');
				$datavap->addCData("");
				$datavap = $items->addChild('private');
				$datavap->addCData("");
				$datavap = $items->addChild('author');
				$datavap->addCData(isset($USR1)?$USR1:$USR);
				$datavap = $items->addChild('slug');
				$datavap->addCData("contact");
				$datavap = $items->addChild('filename');
				$datavap->addCData("contact.xml");
				if (function_exists('i18n_init')) {
					/*** LT ***/
					$items = $xml_pages->addChild('item');
					$items->addChild('pubDate', date(DATE_RFC2822));
					$datavap = $items->addChild('title');
					$datavap->addCData("Kontaktai");
					$datavap = $items->addChild('url');
					$datavap->addCData("contact_lt");
					$datavap = $items->addChild('meta');
					$datavap->addCData("");
					$datavap = $items->addChild('metad');
					$datavap->addCData("");
					$datavap = $items->addChild('menu');
					$datavap->addCData("Kontaktai");
					$datavap = $items->addChild('menuOrder');
					$datavap->addCData("0");
					$datavap = $items->addChild('menuStatus');
					$datavap->addCData("Y");
					$datavap = $items->addChild('template');
					$datavap->addCData("contact.php");
					$datavap = $items->addChild('parent');
					$datavap->addCData("");
					$datavap = $items->addChild('private');
					$datavap->addCData("");
					$datavap = $items->addChild('author');
					$datavap->addCData(isset($USR1)?$USR1:$USR);
					$datavap = $items->addChild('slug');
					$datavap->addCData("contact_lt");
					$datavap = $items->addChild('filename');
					$datavap->addCData("contact_lt.xml");
					/*** RU ***/
					$items = $xml_pages->addChild('item');
					$items->addChild('pubDate', date(DATE_RFC2822));
					$datavap = $items->addChild('title');
					$datavap->addCData("Контакты");
					$datavap = $items->addChild('url');
					$datavap->addCData("contact_ru");
					$datavap = $items->addChild('meta');
					$datavap->addCData("");
					$datavap = $items->addChild('metad');
					$datavap->addCData("");
					$datavap = $items->addChild('menu');
					$datavap->addCData("Контакты");
					$datavap = $items->addChild('menuOrder');
					$datavap->addCData("0");
					$datavap = $items->addChild('menuStatus');
					$datavap->addCData("Y");
					$datavap = $items->addChild('template');
					$datavap->addCData("contact.php");
					$datavap = $items->addChild('parent');
					$datavap->addCData("");
					$datavap = $items->addChild('private');
					$datavap->addCData("");
					$datavap = $items->addChild('author');
					$datavap->addCData(isset($USR1)?$USR1:$USR);
					$datavap = $items->addChild('slug');
					$datavap->addCData("contact_ru");
					$datavap = $items->addChild('filename');
					$datavap->addCData("contact_ru.xml");
				}
				$xml_pages->asXML(GSDATAOTHERPATH.'pages.xml');
			}
			if (function_exists('i18n_init')) {
				$xml_file = @file_get_contents(GSDATAOTHERPATH.'i18n_menu_cache.xml');
				$xml_menu = simplexml_load_string($xml_file, 'SimpleXMLExtended');
				if ($xml_menu) {
					$items = $xml_menu->addChild('page');
					$datavam = $items->addChild('url');
					$datavam->addCData("contact");
					$datavam = $items->addChild('menuStatus');
					$datavam->addCData("Y");
					$datavam = $items->addChild('menuOrder');
					$datavam->addCData($curr_order);
					$datavam = $items->addChild('menu');
					$datavam->addCData("Contact");
					$datavam = $items->addChild('title');
					$datavam->addCData("Contact");
					$datavam = $items->addChild('parent');
					$datavam->addCData("");
					$datavam = $items->addChild('private');
					$datavam->addCData("");
					$datavam = $items->addChild('tags');
					$datavam->addCData("");
					$datavam = $items->addChild('menu_lt');
					$datavam->addCData("Kontaktai");
					$datavam = $items->addChild('title_lt');
					$datavam->addCData("Kontaktai");
					$datavam = $items->addChild('menu_ru');
					$datavam->addCData("Контакты");
					$datavam = $items->addChild('title_ru');
					$datavam->addCData("Контакты");
				}
				$xml_menu->asXML(GSDATAOTHERPATH.'i18n_menu_cache.xml');
			}
		}
	}
	
	function uncheck_data_contact() {
		if (file_exists(GSDATAPAGESPATH.'contact.xml')) {
			unlink(GSDATAPAGESPATH.'contact.xml');
			$xml_file = @file_get_contents(GSDATAOTHERPATH.'pages.xml');
			$xml_pages = simplexml_load_string($xml_file, 'SimpleXMLExtended');
			$xml_pages_new = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>');
			if ($xml_pages) {
				foreach ($xml_pages as $item) {
					if ($item->template != "contact.php") {
						$from_dom = dom_import_simplexml($item);
						$to_dom = dom_import_simplexml($xml_pages_new);
						$to_dom->appendChild($to_dom->ownerDocument->importNode($from_dom, true));
					}
				}
				$xml_pages_new->asXML(GSDATAOTHERPATH.'pages.xml');
			}
			$xml_file = @file_get_contents(GSDATAOTHERPATH.'i18n_menu_cache.xml');
			$xml_menu = simplexml_load_string($xml_file, 'SimpleXMLExtended');
			$xml_menu_new = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><pages></pages>');
			if ($xml_menu) {
				foreach ($xml_menu as $item) {
					if ($item->url != "contact") {
						$from_dom = dom_import_simplexml($item);
						$to_dom = dom_import_simplexml($xml_menu_new);
						$to_dom->appendChild($to_dom->ownerDocument->importNode($from_dom, true));
					}
				}
				$xml_menu_new->asXML(GSDATAOTHERPATH.'i18n_menu_cache.xml');
			}
		}
		if (file_exists(GSDATAPAGESPATH.'contact_lt.xml')) unlink(GSDATAPAGESPATH.'contact_lt.xml');
		if (file_exists(GSDATAPAGESPATH.'contact_ru.xml')) unlink(GSDATAPAGESPATH.'contact_ru.xml');
	}
	
	function check_data_search() {
		/*******************************************
			***      Create XML for Search page      ***
			***             if not exist             ***
		********************************************/
		if (!file_exists(GSDATAPAGESPATH.'search.xml')) {
			global $pagesArray, $USR, $USR1;
			$pagesSorted = subval_sort($pagesArray, 'menuOrder');
			if (count($pagesSorted) != 0) {
				$menu_order = 0;
				foreach ($pagesSorted as $page) {
					if($menu_order < (int)$page['menuOrder']) $curr_order = (int)$page['menuOrder'];
				}
				$curr_order = $curr_order + 1;
			}
			else $curr_order = 0;
			$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
			$xml->addChild('pubDate', date(DATE_RFC2822));
			$dataval = $xml->addChild('title');
			$dataval->addCData("Search");
			$dataval = $xml->addChild('url');
			$dataval->addCData("search");
			$dataval = $xml->addChild('meta');
			$dataval->addCData("");
			$dataval = $xml->addChild('metad');
			$dataval->addCData("");
			$dataval = $xml->addChild('menu');
			$dataval->addCData("");
			$dataval = $xml->addChild('menuOrder');
			$dataval->addCData("0");
			$dataval = $xml->addChild('menuStatus');
			$dataval->addCData("");
			$dataval = $xml->addChild('template');
			$dataval->addCData("search.php");
			$dataval = $xml->addChild('parent');
			$dataval->addCData("");
			$dataval = $xml->addChild('content');
			$dataval->addCData("");
			$dataval = $xml->addChild('private');
			$dataval->addCData("");
			$dataval = $xml->addChild('author');
			$dataval->addCData(isset($USR1)?$USR1:$USR);
			$xml->asXML(GSDATAPAGESPATH.'search.xml');
			if (function_exists('i18n_init')) {
				if (!file_exists(GSDATAPAGESPATH.'search_lt.xml')) {
					$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
					$xml->addChild('pubDate', date(DATE_RFC2822));
					$dataval = $xml->addChild('title');
					$dataval->addCData("Paieška");
					$dataval = $xml->addChild('url');
					$dataval->addCData("search_lt");
					$dataval = $xml->addChild('meta');
					$dataval->addCData("");
					$dataval = $xml->addChild('metad');
					$dataval->addCData("");
					$dataval = $xml->addChild('menu');
					$dataval->addCData("");
					$dataval = $xml->addChild('menuOrder');
					$dataval->addCData("0");
					$dataval = $xml->addChild('menuStatus');
					$dataval->addCData("");
					$dataval = $xml->addChild('template');
					$dataval->addCData("search.php");
					$dataval = $xml->addChild('parent');
					$dataval->addCData("");
					$dataval = $xml->addChild('content');
					$dataval->addCData("");
					$dataval = $xml->addChild('private');
					$dataval->addCData("");
					$dataval = $xml->addChild('author');
					$dataval->addCData(isset($USR1)?$USR1:$USR);
					$xml->asXML(GSDATAPAGESPATH.'search_lt.xml');
				}
				if (!file_exists(GSDATAPAGESPATH.'search_ru.xml')) {
					$xml = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><item></item>');
					$xml->addChild('pubDate', date(DATE_RFC2822));
					$dataval = $xml->addChild('title');
					$dataval->addCData("Поиск");
					$dataval = $xml->addChild('url');
					$dataval->addCData("search_ru");
					$dataval = $xml->addChild('meta');
					$dataval->addCData("");
					$dataval = $xml->addChild('metad');
					$dataval->addCData("");
					$dataval = $xml->addChild('menu');
					$dataval->addCData("");
					$dataval = $xml->addChild('menuOrder');
					$dataval->addCData("0");
					$dataval = $xml->addChild('menuStatus');
					$dataval->addCData("");
					$dataval = $xml->addChild('template');
					$dataval->addCData("search.php");
					$dataval = $xml->addChild('parent');
					$dataval->addCData("");
					$dataval = $xml->addChild('content');
					$dataval->addCData("");
					$dataval = $xml->addChild('private');
					$dataval->addCData("");
					$dataval = $xml->addChild('author');
					$dataval->addCData(isset($USR1)?$USR1:$USR);
					$xml->asXML(GSDATAPAGESPATH.'search_ru.xml');
				}
			}
			
			$xml_file = @file_get_contents(GSDATAOTHERPATH.'pages.xml');
			$xml_pages = simplexml_load_string($xml_file, 'SimpleXMLExtended');
			if ($xml_pages) {
				$items = $xml_pages->addChild('item');
				$items->addChild('pubDate', date(DATE_RFC2822));
				$datavap = $items->addChild('title');
				$datavap->addCData("Search");
				$datavap = $items->addChild('url');
				$datavap->addCData("search");
				$datavap = $items->addChild('meta');
				$datavap->addCData("");
				$datavap = $items->addChild('metad');
				$datavap->addCData("");
				$datavap = $items->addChild('menu');
				$datavap->addCData("");
				$datavap = $items->addChild('menuOrder');
				$datavap->addCData("0");
				$datavap = $items->addChild('menuStatus');
				$datavap->addCData("");
				$datavap = $items->addChild('template');
				$datavap->addCData("search.php");
				$datavap = $items->addChild('parent');
				$datavap->addCData("");
				$datavap = $items->addChild('private');
				$datavap->addCData("");
				$datavap = $items->addChild('author');
				$datavap->addCData(isset($USR1)?$USR1:$USR);
				$datavap = $items->addChild('slug');
				$datavap->addCData("search");
				$datavap = $items->addChild('filename');
				$datavap->addCData("search.xml");
				if (function_exists('i18n_init')) {
					/*** LT ***/
					$items = $xml_pages->addChild('item');
					$items->addChild('pubDate', date(DATE_RFC2822));
					$datavap = $items->addChild('title');
					$datavap->addCData("Paieška");
					$datavap = $items->addChild('url');
					$datavap->addCData("search_lt");
					$datavap = $items->addChild('meta');
					$datavap->addCData("");
					$datavap = $items->addChild('metad');
					$datavap->addCData("");
					$datavap = $items->addChild('menu');
					$datavap->addCData("");
					$datavap = $items->addChild('menuOrder');
					$datavap->addCData("0");
					$datavap = $items->addChild('menuStatus');
					$datavap->addCData("");
					$datavap = $items->addChild('template');
					$datavap->addCData("search.php");
					$datavap = $items->addChild('parent');
					$datavap->addCData("");
					$datavap = $items->addChild('private');
					$datavap->addCData("");
					$datavap = $items->addChild('author');
					$datavap->addCData(isset($USR1)?$USR1:$USR);
					$datavap = $items->addChild('slug');
					$datavap->addCData("search_lt");
					$datavap = $items->addChild('filename');
					$datavap->addCData("search_lt.xml");
					/*** RU ***/
					$items = $xml_pages->addChild('item');
					$items->addChild('pubDate', date(DATE_RFC2822));
					$datavap = $items->addChild('title');
					$datavap->addCData("Поиск");
					$datavap = $items->addChild('url');
					$datavap->addCData("search_ru");
					$datavap = $items->addChild('meta');
					$datavap->addCData("");
					$datavap = $items->addChild('metad');
					$datavap->addCData("");
					$datavap = $items->addChild('menu');
					$datavap->addCData("");
					$datavap = $items->addChild('menuOrder');
					$datavap->addCData("0");
					$datavap = $items->addChild('menuStatus');
					$datavap->addCData("");
					$datavap = $items->addChild('template');
					$datavap->addCData("search.php");
					$datavap = $items->addChild('parent');
					$datavap->addCData("");
					$datavap = $items->addChild('private');
					$datavap->addCData("");
					$datavap = $items->addChild('author');
					$datavap->addCData(isset($USR1)?$USR1:$USR);
					$datavap = $items->addChild('slug');
					$datavap->addCData("search_ru");
					$datavap = $items->addChild('filename');
					$datavap->addCData("search_ru.xml");
				}
				$xml_pages->asXML(GSDATAOTHERPATH.'pages.xml');
			}
		}
	}
	
	function uncheck_data_search() {
		if (file_exists(GSDATAPAGESPATH.'search.xml')) {
			unlink(GSDATAPAGESPATH.'search.xml');
			$xml_file = @file_get_contents(GSDATAOTHERPATH.'pages.xml');
			$xml_pages = simplexml_load_string($xml_file, 'SimpleXMLExtended');
			$xml_pages_new = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>');
			if ($xml_pages) {
				foreach ($xml_pages as $item) {
					if ($item->template != "search.php") {
						$from_dom = dom_import_simplexml($item);
						$to_dom = dom_import_simplexml($xml_pages_new);
						$to_dom->appendChild($to_dom->ownerDocument->importNode($from_dom, true));
					}
				}
				$xml_pages_new->asXML(GSDATAOTHERPATH.'pages.xml');
			}
			$xml_file = @file_get_contents(GSDATAOTHERPATH.'i18n_menu_cache.xml');
			$xml_menu = simplexml_load_string($xml_file, 'SimpleXMLExtended');
			$xml_menu_new = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><pages></pages>');
			if ($xml_menu) {
				foreach ($xml_menu as $item) {
					if ($item->url != "search") {
						$from_dom = dom_import_simplexml($item);
						$to_dom = dom_import_simplexml($xml_menu_new);
						$to_dom->appendChild($to_dom->ownerDocument->importNode($from_dom, true));
					}
				}
				$xml_menu_new->asXML(GSDATAOTHERPATH.'i18n_menu_cache.xml');
			}
		}
		if (file_exists(GSDATAPAGESPATH.'search_lt.xml')) unlink(GSDATAPAGESPATH.'search_lt.xml');
		if (file_exists(GSDATAPAGESPATH.'search_ru.xml')) unlink(GSDATAPAGESPATH.'search_ru.xml');
	}
	
	global $LANG, $SITEURL;
	$def_lang=$LANG;
	$file_path=GSDATAOTHERPATH.'components.xml';
	if(!isset($def_lang) || empty($def_lang)) $def_lang="en_US";
	if(!file_exists(str_replace('\\','/',dirname(__FILE__)).'/lang/'.$def_lang.'.php')) $def_lang="en_US";
	include(str_replace('\\','/',dirname(__FILE__)).'/lang/'.$def_lang.'.php');
	
	if(isset($_POST['code-generate']) && $_POST['code-generate']) {
			$slide_trans = '';
			$caption_trans = '';
			$cap_options = '';
			$cap_options1 = '';
			if(return_theme_setting('sl_trans')) {
				$sl_trans = return_theme_setting('sl_trans');
				$slide_trans = 'var _SlideshowTransitions = ['. PHP_EOL;
				$slide_trans .= rtrim($sl_trans,  PHP_EOL." \t\n,");
				$slide_trans .= PHP_EOL .'];'. PHP_EOL;
			}
			if(return_theme_setting('caption_trans')) {
				$caption_trans = PHP_EOL .'var _CaptionTransitions = [];'. PHP_EOL;
				$caption_trans .= return_theme_setting('caption_trans'). PHP_EOL;
			}
			$sl_options = 'var options = {'. PHP_EOL;
			$sl_options .= '$AutoPlay: ';
			$sl_options .= (return_theme_setting('autoplay')==1?"true":"false").','. PHP_EOL;
			$sl_options .= '$AutoPlayInterval: ';
			$sl_options .= (return_theme_setting('slide_delay')?return_theme_setting('slide_delay'):"0").','. PHP_EOL;
			$sl_options .= '$SlideDuration: '.return_theme_setting('sl_duration').','. PHP_EOL;
			$sl_options .= '$ArrowKeyNavigation: ';
			$sl_options .= (return_theme_setting('key_nav')==1?"true":"false").','. PHP_EOL;
			$sl_options .= '$PauseOnHover: '.return_theme_setting('pause_hover').','. PHP_EOL;
			$sl_options .= '$FillMode: ';
			$sl_options .= (return_theme_setting('fill_mode')?return_theme_setting('fill_mode'):"0").','. PHP_EOL;
			$sl_options .= '$PlayOrientation: '.return_theme_setting('orientation').','. PHP_EOL;
			$sl_options .= '$DragOrientation: ';
			$sl_options .= (return_theme_setting('drag_orient')?return_theme_setting('drag_orient'):"0").','. PHP_EOL;
			$sl_options .= '$SlideEasing: $JssorEasing$.$';
			$sl_options .= (return_theme_setting('easing')?return_theme_setting('easing'):"EaseOutQuad").','. PHP_EOL;
			$sl_options .= '$Cols: ';
			$sl_options .= (return_theme_setting('pieces')?return_theme_setting('pieces'):"1").','. PHP_EOL;
			if(strlen(return_theme_setting('sl_width')) > 0) {
				$sl_options .= '$SlideWidth: ';
				$sl_options .= (return_theme_setting('sl_width')?return_theme_setting('sl_width'):"").','. PHP_EOL;
			}
			if(strlen(return_theme_setting('sl_height')) > 0) {
				$sl_options .= '$SlideHeight: ';
				$sl_options .= (return_theme_setting('sl_height')?return_theme_setting('sl_height'):"").','. PHP_EOL;
			}
			$sl_options .= '$SlideSpacing: ';
			$sl_options .= (return_theme_setting('sl_spacing')?return_theme_setting('sl_spacing'):"0").','. PHP_EOL;
			$sl_options .= '$Align: ';
			$sl_options .= (return_theme_setting('sl_parking')?return_theme_setting('sl_parking'):"0").','. PHP_EOL;
			if(return_theme_setting('sl_trans') || return_theme_setting('caption_trans')) {
				$cap_options = PHP_EOL .'$SlideshowOptions: {'. PHP_EOL .'$Class: $JssorSlideshowRunner$,'. PHP_EOL .'$Transitions: _SlideshowTransitions,'. PHP_EOL;
				$cap_options .= '$TransitionsOrder: ';
				$cap_options .= (return_theme_setting('trans_order')?return_theme_setting('trans_order'):"0").','. PHP_EOL;
				$cap_options .= '$ShowLink: ';
				$cap_options .= (return_theme_setting('show_link')==1?"true":"false"). PHP_EOL .'},'. PHP_EOL;
			}
			if(return_theme_setting('caption_trans')) {
				$cap_options1 = PHP_EOL .'$CaptionSliderOptions: {'. PHP_EOL .'$Class: $JssorCaptionSlider$,'. PHP_EOL .'$CaptionTransitions: _CaptionTransitions,'. PHP_EOL;
				$cap_options1 .= '$PlayInMode: ';
				$cap_options1 .= (return_theme_setting('play_in')?return_theme_setting('play_in'):"0").','. PHP_EOL;
				$cap_options1 .= '$PlayOutMode: ';
				$cap_options1 .= (return_theme_setting('play_out')?return_theme_setting('play_out'):"0"). PHP_EOL .'},';
			}
				$bull_options = PHP_EOL .'$BulletNavigatorOptions: {'. PHP_EOL .'$Class: $JssorBulletNavigator$,'. PHP_EOL;
				$bull_options .= '$ChanceToShow: ';
				$bull_options .= (return_theme_setting('show_bull')?return_theme_setting('show_bull'):"0");
			if(return_theme_setting('show_bull')) {				
				$bull_options .= ','. PHP_EOL .'$AutoCenter: ';
				$bull_options .= (return_theme_setting('auto_bull')?return_theme_setting('auto_bull'):"0").','. PHP_EOL;
				$bull_options .= '$ActionMode: ';
				$bull_options .= (return_theme_setting('act_bull')?return_theme_setting('act_bull'):"0").','. PHP_EOL;
				$bull_options .= '$SpacingX: ';
				$bull_options .= (return_theme_setting('bull_spacing')?return_theme_setting('bull_spacing'):"0").','. PHP_EOL;
				$bull_options .= '$SpacingY: ';
				$bull_options .= (return_theme_setting('bull_spacing')?return_theme_setting('bull_spacing'):"0");
			}
				$bull_options .= PHP_EOL .'},';
				$bull_options .= PHP_EOL . PHP_EOL .'$ArrowNavigatorOptions: {'. PHP_EOL .'$Class: $JssorArrowNavigator$,'. PHP_EOL;
				$bull_options .= '$ChanceToShow: ';
				$bull_options .= (return_theme_setting('show_arrow')?return_theme_setting('show_arrow'):"0");
			if(return_theme_setting('show_arrow')) {				
				$bull_options .= ','. PHP_EOL .'$AutoCenter: ';
				$bull_options .= (return_theme_setting('auto_arrow')?return_theme_setting('auto_arrow'):"0");
			}
				$bull_options .= PHP_EOL .'},';
				$bull_options .= PHP_EOL . PHP_EOL .'$ThumbnailNavigatorOptions: {'. PHP_EOL .'$Class: $JssorThumbnailNavigator$,'. PHP_EOL;
				$bull_options .= '$ChanceToShow: ';
				$bull_options .= (return_theme_setting('show_thumb')?return_theme_setting('show_thumb'):"0");
			if(return_theme_setting('show_thumb')) {				
				$bull_options .= ','. PHP_EOL .'$ActionMode: ';
				$bull_options .= (return_theme_setting('act_thumb')?return_theme_setting('act_thumb'):"0").','. PHP_EOL;
				$bull_options .= '$DisableDrag: ';
				$bull_options .= (return_theme_setting('thumb_drag')==1?"true":"false").','. PHP_EOL;
				$bull_options .= '$Orientation: '.return_theme_setting('thumb_orient').','. PHP_EOL;
				if(return_theme_setting('thumb_lanes')) {
					$bull_options .= '$Rows: '.return_theme_setting('thumb_lanes').','. PHP_EOL;
				}
				if(return_theme_setting('thumb_parking')) {
					$bull_options .= '$ParkingPosition: '.return_theme_setting('thumb_parking').','. PHP_EOL;
				}
				if(return_theme_setting('thumb_spacex')) {
					$bull_options .= '$SpacingX: '.return_theme_setting('thumb_spacex').','. PHP_EOL;
				}
				if(return_theme_setting('thumb_spacey')) {
					$bull_options .= '$SpacingY: '.return_theme_setting('thumb_spacey').','. PHP_EOL;
				}
				if(return_theme_setting('thumb_cols')) {
					$bull_options .= '$Cols: '.return_theme_setting('thumb_cols');
				}
				$bull_options .= '$AutoCenter: ';
				$bull_options .= (return_theme_setting('auto_thumb')?return_theme_setting('auto_thumb'):"3").','. PHP_EOL;
			}
			$bull_options .= PHP_EOL .'}'. PHP_EOL;
			$bull_options .= '};'. PHP_EOL;
			$slider_func = PHP_EOL .'var jssor_slider1 = new $JssorSlider$("'.return_theme_setting('slide_id').'", options);'. PHP_EOL;
			$slider_func .= PHP_EOL .'function ScaleSlider() {'. PHP_EOL;
			$slider_func .= (return_theme_setting('fullwidth')?'var bodyWidth = document.body.clientWidth;'. PHP_EOL .'if (bodyWidth)'. PHP_EOL .'jssor_slider1.$ScaleWidth(Math.min(bodyWidth, '.return_theme_setting('width_min').'));':'var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;'. PHP_EOL .'if (parentWidth)'. PHP_EOL .'jssor_slider1.$ScaleWidth(Math.max(Math.min(parentWidth, '.return_theme_setting('width_min').'), '.return_theme_setting('width_max').'));');
			$slider_func .= PHP_EOL .'else'. PHP_EOL .'window.setTimeout(ScaleSlider, 30);'. PHP_EOL .'}'. PHP_EOL .'ScaleSlider();'. PHP_EOL;
			$slider_func .= PHP_EOL .'$(window).bind("load", ScaleSlider);'. PHP_EOL .'$(window).bind("resize", ScaleSlider);'. PHP_EOL .'$(window).bind("orientationchange", ScaleSlider);'. PHP_EOL;
			$fileid = return_theme_setting('slide_id');
			$filename = '../theme/'.$TEMPLATE.'/scripts/jssor/'.$fileid.'.js';
			$file = fopen($filename, "w")  or die("Couldn't open $filename");
			fwrite($file, 'jQuery(document).ready(function ($) {'. PHP_EOL);
			fwrite($file, $slide_trans);
			fwrite($file, $caption_trans);
			fwrite($file, $sl_options);
			fwrite($file, $cap_options);
			fwrite($file, $cap_options1);
			fwrite($file, $bull_options);
			fwrite($file, $slider_func);
			fwrite($file, "$('.jssor-slider .slider-inner').attr('style', 'display: block;');". PHP_EOL);
			fwrite($file, '});');
			fclose($file);
	}
	
	if(component_exists('evolve-accordion') && return_theme_setting('evolve-accordion')==0) remove_component($file_path,'evolve-accordion');
	if(return_theme_setting('evolve-accordion')==1 && !component_exists('evolve-accordion')) import_component($file_path, 'evolve-accordion');
	if(component_exists('evolve-animated-number') && return_theme_setting('evolve-animated-number')==0) remove_component($file_path,'evolve-animated-number');
	if(return_theme_setting('evolve-animated-number')==1 && !component_exists('evolve-animated-number')) import_component($file_path, 'evolve-animated-number');
	if(component_exists('evolve-camera-gallery') && return_theme_setting('evolve-camera-gallery')==0) remove_component($file_path,'evolve-camera-gallery');
	if(return_theme_setting('evolve-camera-gallery')==1 && !component_exists('evolve-camera-gallery')) import_component($file_path, 'evolve-camera-gallery');
	if(component_exists('evolve-customers-carousel') && return_theme_setting('evolve-customers-carousel')==0) remove_component($file_path,'evolve-customers-carousel');
	if(return_theme_setting('evolve-customers-carousel')==1 && !component_exists('evolve-customers-carousel')) import_component($file_path, 'evolve-customers-carousel');
	if(component_exists('evolve-faq') && return_theme_setting('evolve-faq')==0) remove_component($file_path,'evolve-faq');
	if(return_theme_setting('evolve-faq')==1 && !component_exists('evolve-faq')) import_component($file_path, 'evolve-faq');
	if(component_exists('evolve-featered-boxes') && return_theme_setting('evolve-featered-boxes')==0) remove_component($file_path,'evolve-featered-boxes');
	if(return_theme_setting('evolve-featered-boxes')==1 && !component_exists('evolve-featered-boxes')) import_component($file_path, 'evolve-featered-boxes');
	if(component_exists('evolve-parallex-content') && return_theme_setting('evolve-parallex-content')==0) remove_component($file_path,'evolve-parallex-content');
	if(return_theme_setting('evolve-parallex-content')==1 && !component_exists('evolve-parallex-content')) import_component($file_path, 'evolve-parallex-content');
	if(component_exists('evolve-partners-carousel') && return_theme_setting('evolve-partners-carousel')==0) remove_component($file_path,'evolve-partners-carousel');
	if(return_theme_setting('evolve-partners-carousel')==1 && !component_exists('evolve-partners-carousel')) import_component($file_path, 'evolve-partners-carousel');
	if(component_exists('evolve-pie-chart') && return_theme_setting('evolve-pie-chart')==0) remove_component($file_path,'evolve-pie-chart');
	if(return_theme_setting('evolve-pie-chart')==1 && !component_exists('evolve-pie-chart')) import_component($file_path, 'evolve-pie-chart');
	if(component_exists('evolve-portfolio-carousel') && return_theme_setting('evolve-portfolio-carousel')==0) remove_component($file_path,'evolve-portfolio-carousel');
	if(return_theme_setting('evolve-portfolio-carousel')==1 && !component_exists('evolve-portfolio-carousel')) import_component($file_path, 'evolve-portfolio-carousel');
	if(component_exists('evolve-service-box') && return_theme_setting('evolve-service-box')==0) remove_component($file_path,'evolve-service-box');
	if(return_theme_setting('evolve-service-box')==1 && !component_exists('evolve-service-box')) import_component($file_path, 'evolve-service-box');
	if(component_exists('evolve-skill-bars') && return_theme_setting('evolve-skill-bars')==0) remove_component($file_path,'evolve-skill-bars');
	if(return_theme_setting('evolve-skill-bars')==1 && !component_exists('evolve-skill-bars')) import_component($file_path, 'evolve-skill-bars');
	if(component_exists('evolve-main-slider') && return_theme_setting('evolve-main-slider')==0) remove_component($file_path,'evolve-main-slider');
	if(return_theme_setting('evolve-main-slider')==1 && !component_exists('evolve-main-slider')) import_component($file_path, 'evolve-main-slider');
	if(component_exists('evolve-tabs') && return_theme_setting('evolve-tabs')==0) remove_component($file_path,'evolve-tabs');
	if(return_theme_setting('evolve-tabs')==1 && !component_exists('evolve-tabs')) import_component($file_path, 'evolve-tabs');
	if(component_exists('evolve-tagline') && return_theme_setting('evolve-tagline')==0) remove_component($file_path,'evolve-tagline');
	if(return_theme_setting('evolve-tagline')==1 && !component_exists('evolve-tagline')) import_component($file_path, 'evolve-tagline');
	if($error_file) {
		?> <div class="fancy-message error" style="border: 1px solid; padding: 20px 10px 10px 10px; border-radius: 4px; margin-bottom: 20px; background: #F2DEDE; color: #A94442;"><p><?php echo $set_lang['XML_ERROR'].$eror_path; ?></p></div> <?php
	}
	if($eror_component) {
		?> <div class="fancy-message error" style="border: 1px solid; padding: 20px 10px 10px 10px; border-radius: 4px; margin-bottom: 20px; background: #F2DEDE; color: #A94442;"><p><?php echo $set_lang['COMPONENT_ERROR'].$eror_path; ?></p></div> <?php
	}
	if(return_theme_setting('contact_form')==1) check_data_contact();
	else uncheck_data_contact();
	
	if(return_theme_setting('search_form')==1) check_data_search();
	else uncheck_data_search();
?>
<div class="leftsec" style="width: 45%;">
	<p>
		<label for="tagline"><?php echo $set_lang['SITE_PHONE']; ?></label>
		<input type="text" class="text" name="phone" id="phone" value="<?php get_theme_setting('phone'); ?>">
	</p>
	
	<p>
		<label for="tagline"><?php echo $set_lang['SITE_DEFLANG']; ?></label>
		<input type="text" class="text" name="site_deflang" id="site_deflang" value="<?php get_theme_setting('site_deflang'); ?>">
	</p>
	<p>
		<label for="site_slogan"><?php echo $set_lang['SLOGAN_LINE']; ?></label>
		<input type="text" class="text" name="site_slogan" id="site_slogan" value="<?php get_theme_setting('site_slogan'); ?>">
	</p>
	
	<p>
		<input type="checkbox" name="contact_form" value=1 <?php echo return_theme_setting('contact_form')==1?"checked":"" ?>><span class="evolve-settings"><?php echo $set_lang['CONTACT_SET']; ?></span>
	</p>
	
	<p>
		<input type="checkbox" name="search_form" value=1 <?php echo return_theme_setting('search_form')==1?"checked":"" ?>><span class="evolve-settings"><?php echo $set_lang['SEARCH_SET']; ?></span>
	</p>
	
	
</div>
<div class="theme-version">Theme GS Evolve version <?php echo $theme_ver; ?></div>
<div class="rightsec" style="margin-top: 16px; width: 55%;">
	<div class="widesec" id="snapshot" style="height: 240px; border: 1px solid; border-radius: 4px;"></div>
</div>
<div class="widesec">
	<div class="leftsec" style="width: 45%;">
		<p>
			<input type="checkbox" name="title_desc" value=1 <?php echo return_theme_setting('title_desc')==1?"checked":"" ?>><span class="evolve-settings"><?php echo $set_lang['TITLE_DESC']; ?></span>
		</p>
	</div>
	<div class="rightsec" style="width: auto;">
		<p>
			<label for="schema" style="float: left;"><?php echo $set_lang['COLOR_SCHEME']; ?></label>
			<select name="color_scheme" id="color_scheme" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
				<option value="grayblue" <?php echo return_theme_setting('color_scheme')== 'grayblue' ? ' selected="selected"' : '' ?>>Gray Blue</option>
				<option value="beige" <?php echo return_theme_setting('color_scheme')== 'beige' ? ' selected="selected"' : '' ?>>Beige</option>
				<option value="blue" <?php echo return_theme_setting('color_scheme')== 'blue' ? ' selected="selected"' : '' ?>>Blue</option>
				<option value="brown" <?php echo return_theme_setting('color_scheme')== 'brown' ? ' selected="selected"' : '' ?>>Brown</option>
				<option value="cyan" <?php echo return_theme_setting('color_scheme')== 'cyan' ? ' selected="selected"' : '' ?>>Cyan</option>
				<option value="gray" <?php echo return_theme_setting('color_scheme')== 'gray' ? ' selected="selected"' : '' ?>>Gray</option>
				<option value="green" <?php echo return_theme_setting('color_scheme')== 'green' ? ' selected="selected"' : '' ?>>Green</option>
				<option value="yellow" <?php echo return_theme_setting('color_scheme')== 'yellow' ? ' selected="selected"' : '' ?>>Yellow</option>
				<option value="navy" <?php echo return_theme_setting('color_scheme')== 'navy' ? ' selected="selected"' : '' ?>>Navy</option>
				<option value="olive" <?php echo return_theme_setting('color_scheme')== 'olive' ? ' selected="selected"' : '' ?>>Olive</option>
				<option value="orange" <?php echo return_theme_setting('color_scheme')== 'orange' ? ' selected="selected"' : '' ?>>Orange</option>
				<option value="pink" <?php echo return_theme_setting('color_scheme')== 'pink' ? ' selected="selected"' : '' ?>>Pink</option>
				<option value="purple" <?php echo return_theme_setting('color_scheme')== 'purple' ? ' selected="selected"' : '' ?>>Purple</option>
				<option value="red" <?php echo return_theme_setting('color_scheme')== 'red' ? ' selected="selected"' : '' ?>>Red</option>
			</select>
		</p>
	</div>
	<div class="rightsec" style="width: auto; margin-left: 20px;">
		<input type="checkbox" id="title_parallex" name="title_parallex" value=1 <?php echo return_theme_setting('title_parallex')==1?"checked":"" ?>><span class="evolve-settings"><?php echo $set_lang['TITLE_PARALLEX']; ?></span>
	</div>
</div>
<div class="widesec">
	<label for="seo_slug" style="float: left; margin-right: 10px;"><?php echo $set_lang['SEO_SLUG']; ?></label>
	<input type="text" class="text" name="seo_slug" id="seo_slug" value="<?php get_theme_setting('seo_slug'); ?>" style="width: 75%; margin-top: -5px" title="<?php echo $set_lang['SEO_SLUG_DESC']; ?>">
</div>

<fieldset class="container-collapsed widesec" id="container-0">
	<legend class="collapsedlegend" id="legend-1"><?php echo $set_lang['EVOLVE_SET_EXPAND']; ?></legend>
	<h3 style="margin:20px 10px"><?php echo $set_lang['CONTACT_INFO']; ?></h3>
	<div class="component-settings">
		<div class="inner-divs">

				<label for="contact_photo"><?php echo $set_lang['CONTACT_PHOTO']; ?></label>
			<?php if(plugins_check("responsivefilemanager")) { ?>
				<a href="../plugins/responsivefilemanager/dialog.php?type=1&lang=<?php echo $def_lang; ?>&field_id=contact_photo" class="btn iframe-buttn" type="button">Select</a>
			<?php } ?>
				<input type="text" class="text" name="contact_photo" id="contact_photo" value="<?php get_theme_setting('contact_photo'); ?>" placeholder="<?php echo $set_lang['PHOTO_PLACE']; ?>">
			<br>
			<label for="contact_desc"><?php echo $set_lang['CONTACT_DESC']; ?></label>
			<textarea rows="2" cols="50" class="text" name="contact_desc" id="contact_desc"><?php get_theme_setting('contact_desc'); ?></textarea>
			<label for="address"><?php echo $set_lang['CONTACT_ADDRESS']; ?></label>
			<textarea rows="2" cols="50" class="text" name="address" id="address"><?php get_theme_setting('address'); ?></textarea>
			<label for="contact_phone"><?php echo $set_lang['CONTACT_PHONE']; ?></label>
			<textarea rows="2" cols="50" class="text" name="contact_phone" id="contact_phone"><?php get_theme_setting('contact_phone'); ?></textarea>
			<label for="contact_email"><?php echo $set_lang['CONTACT_EMAIL']; ?></label>
			<textarea rows="2" cols="50" class="text" name="contact_email" id="contact_email"><?php get_theme_setting('contact_email'); ?></textarea>
			<label for="contact_support"><?php echo $set_lang['CONTACT_SUPPORT']; ?></label>
			<textarea rows="2" cols="50" class="text" name="contact_support" id="contact_support"><?php get_theme_setting('contact_support'); ?></textarea>
		</div>
		
	</div>
</fieldset>

<fieldset class="container-collapsed widesec" id="container-1" style="padding: 5px;">
	<legend class="collapsedlegend" id="legend-0"><?php echo $set_lang['EVOLVE_SET_EXPAND']; ?></legend>
	<h3 style="margin:20px 10px"><?php echo $set_lang['ADD_SOCIAL']; ?></h3>
	<div class="component-settings">
		<div class="inner-divs" style="margin: 10px;">
			<p>
				<label for="facebook">Facebook:</label>
				<input type="text" class="text" name="facebook" id="facebook" style="width: 80%;float: right;" value="<?php get_theme_setting('facebook'); ?>">
			</p>
			<p>
				<label for="twitter">Twitter:</label>
				<input type="text" class="text" name="twitter" id="twitter" style="width: 80%;float: right;" value="<?php get_theme_setting('twitter'); ?>">
			</p>
			<p>
				<label for="linkedin">Linkedin:</label>
				<input type="text" class="text" name="linkedin" id="linkedin" style="width: 80%;float: right;" value="<?php get_theme_setting('linkedin'); ?>">
			</p>
			<p>
				<label for="viadeo">Viadeo:</label>
				<input type="text" class="text" name="viadeo" id="viadeo" style="width: 80%;float: right;" value="<?php get_theme_setting('viadeo'); ?>">
			</p>
			<p>
				<label for="dribbble">Dribbble:</label>
				<input type="text" class="text" name="dribbble" id="dribbble" style="width: 80%;float: right;" value="<?php get_theme_setting('dribbble'); ?>">
			</p>
			<p>
				<label for="flickr">Flickr:</label>
				<input type="text" class="text" name="flickr" id="flickr" style="width: 80%;float: right;" value="<?php get_theme_setting('flickr'); ?>">
			</p>
			<p>
				<label for="youtube">Youtube:</label>
				<input type="text" class="text" name="youtube" id="youtube" style="width: 80%;float: right;" value="<?php get_theme_setting('youtube'); ?>">
			</p>
			<p>
				<label for="skype">Skype:</label>
				<input type="text" class="text" name="skype" id="skype" style="width: 80%;float: right;" value="<?php get_theme_setting('skype'); ?>">
			</p>
			<p>
				<label for="google">Google+:</label>
				<input type="text" class="text" name="google" id="google" style="width: 80%;float: right;" value="<?php get_theme_setting('google'); ?>">
			</p>
			<p>
				<label for="kontakte">VKontakte:</label>
				<input type="text" class="text" name="kontakte" id="kontakte" style="width: 80%;float: right;" value="<?php get_theme_setting('kontakte'); ?>">
			</p>
			<p>
				<label for="instagram">Instagram:</label>
				<input type="text" class="text" name="instagram" id="instagram" style="width: 80%;float: right;" value="<?php get_theme_setting('instagram'); ?>">
			</p>
			<p>
				<label for="rss">RSS:</label>
				<input type="text" class="text" name="rss" id="rss" style="width: 80%;float: right;" value="<?php get_theme_setting('rss'); ?>">
			</p>
			<p style="font-style:italic;margin:0;"><?php echo $set_lang['SOCIAL_DESC']; ?></p>
		</div>
	</div>
</fieldset>

<fieldset class="container-collapsed widesec" id="container-2">
	<legend class="collapsedlegend" id="legend-1"><?php echo $set_lang['EVOLVE_SET_EXPAND']; ?></legend>
	<h3 style="margin:20px 10px"><?php echo $set_lang['ADD_COMPONENTS']; ?></h3>
	<div class="component-settings">
		<div class="inner-divs">
			<p><input type="checkbox" name="evolve-accordion" value=1 <?php echo return_theme_setting('evolve-accordion')==1?"checked":"" ?>><span class="evolve-settings">Accordion</span>
			<input type="checkbox" name="evolve-animated-number" value=1 <?php echo return_theme_setting('evolve-animated-number')==1?"checked":"" ?>><span class="evolve-settings">Animated numbers</span>
			<input type="checkbox" name="evolve-camera-gallery" value=1 <?php echo return_theme_setting('evolve-camera-gallery')==1?"checked":"" ?>><span class="evolve-settings">Camera gallery</span>
			<input type="checkbox" name="evolve-customers-carousel" value=1 <?php echo return_theme_setting('evolve-customers-carousel')==1?"checked":"" ?>><span class="evolve-settings">Customers carousel</span>
			<input type="checkbox" name="evolve-faq" value=1 <?php echo return_theme_setting('evolve-faq')==1?"checked":"" ?>><span class="evolve-settings">FAQ</span></p>
			<p><input type="checkbox" name="evolve-featered-boxes" value=1 <?php echo return_theme_setting('evolve-featered-boxes')==1?"checked":"" ?>><span class="evolve-settings">Featered boxes</span>
			<input type="checkbox" name="evolve-main-slider" value=1 <?php echo return_theme_setting('evolve-main-slider')==1?"checked":"" ?>><span class="evolve-settings">JSSOR slider</span>
			<input type="checkbox" name="evolve-parallex-content" value=1 <?php echo return_theme_setting('evolve-parallex-content')==1?"checked":"" ?>><span class="evolve-settings">Parallex content</span>
			<input type="checkbox" name="evolve-partners-carousel" value=1 <?php echo return_theme_setting('evolve-partners-carousel')==1?"checked":"" ?>><span class="evolve-settings">Partners carousel</span>
			<input type="checkbox" name="evolve-pie-chart" value=1 <?php echo return_theme_setting('evolve-pie-chart')==1?"checked":"" ?>><span class="evolve-settings">Pie chart</span></p>
			<p><input type="checkbox" name="evolve-portfolio-carousel" value=1 <?php echo return_theme_setting('evolve-portfolio-carousel')==1?"checked":"" ?>><span class="evolve-settings">Portfolio carousel</span>
			<input type="checkbox" name="evolve-service-box" value=1 <?php echo return_theme_setting('evolve-service-box')==1?"checked":"" ?>><span class="evolve-settings">Service boxes</span>
			<input type="checkbox" name="evolve-skill-bars" value=1 <?php echo return_theme_setting('evolve-skill-bars')==1?"checked":"" ?>><span class="evolve-settings">Skill bars</span>
			<input type="checkbox" name="evolve-tabs" value=1 <?php echo return_theme_setting('evolve-tabs')==1?"checked":"" ?>><span class="evolve-settings">Tabs</span>
			<input type="checkbox" name="evolve-tagline" value=1 <?php echo return_theme_setting('evolve-tagline')==1?"checked":"" ?>><span class="evolve-settings">Tagline</span></p>
		</div>
		
	</div>
</fieldset>
<?php
	if(return_theme_setting('evolve-main-slider')) {
	?>
	<fieldset class="container-collapsed widesec" id="container-4">
		<legend class="collapsedlegend" id="legend-3"><?php echo $set_lang['EVOLVE_SET_EXPAND']; ?></legend>
		<h3 style="margin:20px 10px"><?php echo $set_lang['EVOLVE_CAROUSEL']; ?></h3>
		<div class="expand-settings">
			<div class="inner-divs">
				<div class="leftsec" style="height: 35px;">
					<label for="slide_id">Slider ID:</label>
					<input type="text" class="text" name="slide_id" id="slide_id" value="<?php echo return_theme_setting('slide_id')?return_theme_setting('slide_id'):"slider1_container"; ?>" style="width: 100px;">
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="fill_mode" style="float: left;">Fill Mode:</label>
					<select name="fill_mode" id="fill_mode" class="text" style="width: 136px; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo (return_theme_setting('fill_mode')== 0 || !return_theme_setting('fill_mode')) ? ' selected="selected"' : '' ?>>Stretch</option>
						<option value="1" <?php echo return_theme_setting('fill_mode')== 1 ? ' selected="selected"' : '' ?>>Contain</option>
						<option value="2" <?php echo return_theme_setting('fill_mode')== 2 ? ' selected="selected"' : '' ?>>Cover</option>
						<option value="4" <?php echo return_theme_setting('fill_mode')== 4 ? ' selected="selected"' : '' ?>>Actual size</option>
						<option value="5" <?php echo return_theme_setting('fill_mode')== 5 ? ' selected="selected"' : '' ?>>Contain for large image, actual size for small image</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_FILLMODE_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="width_min">Min width (px):</label>
					<input type="text" class="text" name="width_min" id="width_min" value="<?php echo return_theme_setting('width_min')?return_theme_setting('width_min'):"1920"; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_MIN_WIDTH_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="width_max">Max width (px):</label>
					<input type="text" class="text" name="width_max" id="width_max" value="<?php echo return_theme_setting('width_max')?return_theme_setting('width_max'):""; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_MAX_WIDTH_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="slide_delay">Play Interval (ms):</label>
					<input type="text" class="text" name="slide_delay" id="slide_delay" value="<?php echo return_theme_setting('slide_delay')?return_theme_setting('slide_delay'):""; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_DELAY_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<input type="checkbox" name="autoplay" id="autoplay" value=1 <?php echo return_theme_setting('autoplay')==1?"checked":"" ?> ><span class="evolve-settings">Slideshow AutoPlay</span>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_AUTOPLAY_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="sl_duration">Slide Duration (ms):</label>
					<input type="text" class="text" name="sl_duration" id="sl_duration" value="<?php echo return_theme_setting('sl_duration')?return_theme_setting('sl_duration'):"500"; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_DURATION_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<input type="checkbox" name="key_nav" id="key_nav" value=1 <?php echo return_theme_setting('key_nav')==1?"checked":"" ?> ><span class="evolve-settings">Keyboard navigation </span>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_KEYB_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="pause_hover" style="float: left;">Pause On Hover:</label>
					<select name="pause_hover" id="pause_hover" class="text" style="width: 136px; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('pause_hover')== 0 ? ' selected="selected"' : '' ?>>No pause</option>
						<option value="1" <?php echo (return_theme_setting('pause_hover')== 1 || !return_theme_setting('pause_hover')) ? ' selected="selected"' : '' ?>>Pause for desktop</option>
						<option value="2" <?php echo return_theme_setting('pause_hover')== 2 ? ' selected="selected"' : '' ?>>Pause for touch device</option>
						<option value="3" <?php echo return_theme_setting('pause_hover')== 3 ? ' selected="selected"' : '' ?>>Pause for desktop and touch device</option>
						<option value="4" <?php echo return_theme_setting('pause_hover')== 4 ? ' selected="selected"' : '' ?>>Freeze for desktop</option>
						<option value="8" <?php echo return_theme_setting('pause_hover')== 8 ? ' selected="selected"' : '' ?>>Freeze for touch device</option>
						<option value="12" <?php echo return_theme_setting('pause_hover')== 12 ? ' selected="selected"' : '' ?>>Freeze for desktop and touch device</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_HOVERP_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<input type="checkbox" name="fullwidth" id="fullwidth" value=1 <?php echo return_theme_setting('fullwidth')==1?"checked":"" ?> ><span class="evolve-settings">Slider full width (on/off)</span>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_FULLW_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="orientation" style="float: left;">Play Orientation:</label>
					<select name="orientation" id="orientation" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="1" <?php echo return_theme_setting('orientation')== 1 ? ' selected="selected"' : '' ?>>Horizontal</option>
						<option value="2" <?php echo return_theme_setting('orientation')== 2 ? ' selected="selected"' : '' ?>>Vertical</option>
						<option value="5" <?php echo return_theme_setting('orientation')== 5 ? ' selected="selected"' : '' ?>>Horizontal reverse</option>
						<option value="6" <?php echo return_theme_setting('orientation')== 6 ? ' selected="selected"' : '' ?>>Vertical reverse</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_PORIENT_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="drag_orient" style="float: left;">Drag Orientation:</label>
					<select name="drag_orient" id="drag_orient" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('drag_orient')== 0 ? ' selected="selected"' : '' ?>>No drag</option>
						<option value="1" <?php echo (return_theme_setting('drag_orient')== 1 || !return_theme_setting('drag_orient')) ? ' selected="selected"' : '' ?>>Horizontal</option>
						<option value="2" <?php echo return_theme_setting('drag_orient')== 2 ? ' selected="selected"' : '' ?>>Vertical</option>
						<option value="3" <?php echo return_theme_setting('drag_orient')== 3 ? ' selected="selected"' : '' ?>>Either</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_DORIENT_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="trans_order" style="float: left;">Transitions Order:</label>
					<select name="trans_order" id="trans_order" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('trans_order')== 0 ? ' selected="selected"' : '' ?>>Random</option>
						<option value="1" <?php echo (return_theme_setting('trans_order')== 1 || !return_theme_setting('trans_order')) ? ' selected="selected"' : '' ?>>Sequence</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_TRORDER_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<input type="checkbox" name="show_link" id="show_link" value=1 <?php echo (return_theme_setting('show_link')==1 || !return_theme_setting('show_link'))?"checked":"" ?> ><span class="evolve-settings">Show Link</span>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_ISLINK_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="play_in" style="float: left;">PlayIn Mode:</label>
					<select name="play_in" id="play_in" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('play_in')== 0 ? ' selected="selected"' : '' ?>>None</option>
						<option value="1" <?php echo (return_theme_setting('play_in')== 1 || !return_theme_setting('play_in')) ? ' selected="selected"' : '' ?>>Chain</option>
						<option value="3" <?php echo return_theme_setting('play_in')== 3 ? ' selected="selected"' : '' ?>>Chain Flatten</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_PLAYIN_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="play_out" style="float: left;">PlayOut Mode:</label>
					<select name="play_out" id="play_out" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('play_out')== 0 ? ' selected="selected"' : '' ?>>None</option>
						<option value="1" <?php echo (return_theme_setting('play_out')== 1 || !return_theme_setting('play_out')) ? ' selected="selected"' : '' ?>>Chain</option>
						<option value="3" <?php echo return_theme_setting('play_out')== 3 ? ' selected="selected"' : '' ?>>Chain Flatten</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_PLAYOUT_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="easing" style="float: left;">Slide Easing:</label>
					<input type="text" class="text" name="easing" id="easing" value="<?php echo return_theme_setting('easing')?return_theme_setting('easing'):"EaseOutQuad"; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_EASING_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="pieces" style="float: left;">Display Pieces:</label>
					<input type="text" class="text" name="pieces" id="pieces" value="<?php echo return_theme_setting('pieces')?return_theme_setting('pieces'):"1"; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_PIECES_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="sl_width" style="float: left;">Slide Width (px):</label>
					<input type="text" class="text" name="sl_width" id="sl_width" value="<?php echo return_theme_setting('sl_width')?return_theme_setting('sl_width'):""; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_SLWIDTH_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="sl_height" style="float: left;">Slide Height (px):</label>
					<input type="text" class="text" name="sl_height" id="sl_height" value="<?php echo return_theme_setting('sl_height')?return_theme_setting('sl_height'):""; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_SLHEIGHT_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="sl_spacing" style="float: left;">Slide Spacing (px):</label>
					<input type="text" class="text" name="sl_spacing" id="sl_spacing" value="<?php echo return_theme_setting('sl_spacing')?return_theme_setting('sl_spacing'):"0"; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_SLSPACE_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="sl_parking" style="float: left;">Align Position (px):</label>
					<input type="text" class="text" name="sl_parking" id="sl_parking" value="<?php echo return_theme_setting('sl_parking')?return_theme_setting('sl_parking'):"0"; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_APOZ_DESC']; ?></div>
					</div>
				</div>
		<fieldset class="container-collapsed" id="container-8">
		<legend class="collapsedlegend" id="legend-8"><?php echo $set_lang['EVOLVE_SET_EXPAND']; ?></legend>
		<h4 style="background-color:#fff;font-size:16px;color:blue;padding:10px;">Navigation Settings</h4>
		<div class="expand-settings">
			<div class="inner-divs">
				<div class="leftsec" style="height: 35px;">
					<label for="show_bull" style="float: left;">Show Bullets:</label>
					<select name="show_bull" id="show_bull" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('show_bull')== 0 ? ' selected="selected"' : '' ?>>Never</option>
						<option value="1" <?php echo (return_theme_setting('show_bull')== 1) ? ' selected="selected"' : '' ?>>Mouse Over</option>
						<option value="3" <?php echo return_theme_setting('show_bull')== 3 ? ' selected="selected"' : '' ?>>Always</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_SBULL_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="act_bull" style="float: left;">Bullets Action:</label>
					<select name="act_bull" id="act_bull" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('act_bull')== 0 ? ' selected="selected"' : '' ?>>None</option>
						<option value="1" <?php echo (return_theme_setting('act_bull')== 1) ? ' selected="selected"' : '' ?>>Act by click</option>
						<option value="2" <?php echo return_theme_setting('act_bull')== 2 ? ' selected="selected"' : '' ?>>Act by mouse hover</option>
						<option value="3" <?php echo return_theme_setting('act_bull')== 3 ? ' selected="selected"' : '' ?>>Both</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_BULLACT_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="auto_bull" style="float: left;">Bullets AutoCenter:</label>
					<select name="auto_bull" id="auto_bull" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo (return_theme_setting('auto_bull')== 0 || !return_theme_setting('auto_bull')) ? ' selected="selected"' : '' ?>>None</option>
						<option value="1" <?php echo return_theme_setting('auto_bull')== 1 ? ' selected="selected"' : '' ?>>Horizontal</option>
						<option value="2" <?php echo return_theme_setting('auto_bull')== 3 ? ' selected="selected"' : '' ?>>Vertical</option>
						<option value="3" <?php echo return_theme_setting('auto_bull')== 3 ? ' selected="selected"' : '' ?>>Both</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_BULLCNTR_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="bull_spacing">Bullets Spacing (px)</label>
					<input type="text" class="text" name="bull_spacing" id="bull_spacing" value="<?php echo return_theme_setting('bull_spacing')?return_theme_setting('bull_spacing'):"0"; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_BULLSPAC_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="show_arrow" style="float: left;">Show Arrows:</label>
					<select name="show_arrow" id="show_arrow" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('show_arrow')== 0 ? ' selected="selected"' : '' ?>>Never</option>
						<option value="1" <?php echo (return_theme_setting('show_arrow')== 1) ? ' selected="selected"' : '' ?>>Mouse Over</option>
						<option value="2" <?php echo return_theme_setting('show_arrow')== 2 ? ' selected="selected"' : '' ?>>Always</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_ISARROW_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="auto_arrow" style="float: left;">Arrows AutoCenter:</label>
					<select name="auto_arrow" id="auto_arrow" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo (return_theme_setting('auto_arrow')== 0 || !return_theme_setting('auto_arrow')) ? ' selected="selected"' : '' ?>>None</option>
						<option value="1" <?php echo return_theme_setting('auto_arrow')== 1 ? ' selected="selected"' : '' ?>>Horizontal</option>
						<option value="2" <?php echo return_theme_setting('auto_arrow')== 2 ? ' selected="selected"' : '' ?>>Vertical</option>
						<option value="3" <?php echo return_theme_setting('auto_arrow')== 3 ? ' selected="selected"' : '' ?>>Both</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_ARROWCNTR_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec" style="height: 35px;">
					<label for="show_thumb" style="float: left;">Show Thumbs:</label>
					<select name="show_thumb" id="show_thumb" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('show_thumb')== 0 ? ' selected="selected"' : '' ?>>Never</option>
						<option value="1" <?php echo return_theme_setting('show_thumb')== 1 ? ' selected="selected"' : '' ?>>Mouse Over</option>
						<option value="2" <?php echo return_theme_setting('show_thumb')== 2 ? ' selected="selected"' : '' ?>>Always</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_ISTHUMB_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="act_thumb" style="float: left;">Thumbs Action:</label>
					<select name="act_thumb" id="act_thumb" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('act_thumb')== 0 ? ' selected="selected"' : '' ?>>None</option>
						<option value="1" <?php echo (return_theme_setting('act_thumb')== 1) ? ' selected="selected"' : '' ?>>Act by click</option>
						<option value="2" <?php echo return_theme_setting('act_thumb')== 2 ? ' selected="selected"' : '' ?>>Act by mouse hover</option>
						<option value="3" <?php echo return_theme_setting('act_thumb')== 3 ? ' selected="selected"' : '' ?>>Both</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_THUMBACT_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec">
					<input type="checkbox" name="thumb_drag" id="thumb_drag" value=1 <?php echo return_theme_setting('thumb_drag')==1?"checked":"" ?> ><span class="evolve-settings">Thumbs Drag</span>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_THUMBDR_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec">
					<label for="thumb_orient" style="float: left;">Thumbs Drag Orient:</label>
					<select name="thumb_orient" id="thumb_orient" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="1" <?php echo (return_theme_setting('thumb_orient')== 1 || !return_theme_setting('thumb_orient')) ? ' selected="selected"' : '' ?>>Horizontal</option>
						<option value="2" <?php echo return_theme_setting('thumb_orient')== 2 ? ' selected="selected"' : '' ?>>Vertical</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_THUMDOR_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec">
					<label for="thumb_lanes">Thumbs Rows</label>
					<input type="text" class="text" name="thumb_lanes" id="thumb_lanes" value="<?php echo return_theme_setting('thumb_lanes')?return_theme_setting('thumb_lanes'):"1"; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_THUMLANE_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec">
					<label for="thumb_parking">Thumbs Parking</label>
					<input type="text" class="text" name="thumb_parking" id="thumb_parking" value="<?php echo return_theme_setting('thumb_parking')?return_theme_setting('thumb_parking'):""; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_THUMPARK_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec">
					<label for="thumb_cols">Thumbs Cols</label>
					<input type="text" class="text" name="thumb_cols" id="thumb_cols" value="<?php echo return_theme_setting('thumb_cols')?return_theme_setting('thumb_cols'):"1"; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_THUMCOLS_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec" style="height: 35px;">
					<label for="auto_thumb">Thumbs AutoCenter</label>
					<select name="auto_thumb" id="auto_thumb" class="text" style="width: auto; margin-left: 4px; margin-top: -4px;">
						<option value="0" <?php echo return_theme_setting('auto_thumb')== 0 ? ' selected="selected"' : '' ?>>None</option>
						<option value="1" <?php echo return_theme_setting('auto_thumb')== 1 ? ' selected="selected"' : '' ?>>Horizontal</option>
						<option value="2" <?php echo return_theme_setting('auto_thumb')== 2 ? ' selected="selected"' : '' ?>>Vertical</option>
						<option value="3" <?php echo (return_theme_setting('auto_thumb')== 3 || !return_theme_setting('auto_thumb')) ? ' selected="selected"' : '' ?>>Both</option>
					</select>
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_THUMCNTR_DESC']; ?></div>
					</div>
				</div>
				<div class="leftsec">
					<label for="thumb_spacex">Thumbs SpacingX</label>
					<input type="text" class="text" name="thumb_spacex" id="thumb_spacex" value="<?php echo return_theme_setting('thumb_spacex')?return_theme_setting('thumb_spacex'):""; ?>" style="width: 100px;">
					<div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_THUMSPX_DESC']; ?></div>
					</div>
				</div>
				<div class="rightsec">
					<label for="thumb_spacey">Thumbs SpacingY</label>
					<input type="text" class="text" name="thumb_spacey" id="thumb_spacey" value="<?php echo return_theme_setting('thumb_spacey')?return_theme_setting('thumb_spacey'):""; ?>" style="width: 100px;">
					 <div class="wrapper-tooltip">
						<div class="tooltip"><?php echo $set_lang['JSSOR_THUMSPY_DESC']; ?></div>
					</div>
				</div>
				</div>
				</div>
				</fieldset>
		<fieldset class="container-collapsed" id="container-9">
		<legend class="collapsedlegend" id="legend-9"><?php echo $set_lang['EVOLVE_SET_EXPAND']; ?></legend>
		<h4 style="background-color:#fff;font-size:16px;color:blue;padding:10px;">Transition Settings</h4>
		<div class="expand-settings">
			<div class="inner-divs">
				<div class="widesec"><label for="slider-transitions">Slider Transitions</label>
					<a id="slider-transitions" href="../theme/<?php echo $TEMPLATE; ?>/scripts/jssor/tools/slideshow-transitions.html" class="sl-trans-button">Transitions</a>
					<a id="transitions-clear1" class="sl-trans-button trans-clear">Clear</a>
					<textarea class="text" name="sl_trans" id="sl_trans" style="width:96%;" rows="5"><?php get_theme_setting('sl_trans'); ?></textarea>
				</div>
				<div class="widesec"><label for="captions-transitions">Captions Transitions</label>
					<a id="captions-transitions" href="../theme/<?php echo $TEMPLATE; ?>/scripts/jssor/tools/caption-transitions.html" class="sl-trans-button">Transitions</a>
					<a id="transitions-clear2" class="sl-trans-button trans-clear">Clear</a>
					<textarea class="text" name="caption_trans" id="caption_trans" style="width:96%;" rows="5"><?php get_theme_setting('caption_trans'); ?></textarea>
				</div>
				</div>
				</div>
				</fieldset>
				<div class="widesec">
					<input type="submit" id="code-generate" name="code-generate" class="sl-trans-button" style="float:none;" value="Generate" />
				</div>
			</div>
		</div>
	</fieldset>
	<?php
	}
?>
<fieldset class="container-collapsed widesec" id="container-5">
	<legend class="collapsedlegend" id="legend-4"><?php echo $set_lang['EVOLVE_SET_EXPAND']; ?></legend>
	<h3 style="margin:20px 10px"><?php echo $set_lang['EVOLVE_SCRIPTS']; ?></h3>
	<div class="expand-settings">
		<div class="inner-divs">
			<p style="font-style:italic;"><?php echo $set_lang['EVOLVE_SCRIPT_DESC']; ?></p>
			<p><input type="checkbox" name="jquery" value=1 <?php echo return_theme_setting('jquery')==1?"checked":"" ?>><span class="evolve-settings" style="color:red;">Jquery<?php echo $set_lang['EVOLVE_REQUIRED']; ?></span>
			<input type="checkbox" name="jquery_header" value=1 <?php echo return_theme_setting('jquery_header')==1?"checked":"" ?>><span class="evolve-settings">Load Jquery in Header</span>
			<input type="checkbox" name="jquery_easing" value=1 <?php echo return_theme_setting('jquery_easing')==1?"checked":"" ?>><span class="evolve-settings" style="color:red;">Jquery Easing<?php echo $set_lang['EVOLVE_REQUIRED']; ?></span></p>
			<p><input type="checkbox" name="jquery_superfish" value=1 <?php echo return_theme_setting('jquery_superfish')==1?"checked":"" ?>><span class="evolve-settings" style="color:red;">Jquery Superfish<?php echo $set_lang['EVOLVE_REQUIRED']; ?></span>
			<input type="checkbox" name="jpanelmenu" value=1 <?php echo return_theme_setting('jpanelmenu')==1?"checked":"" ?>><span class="evolve-settings" style="color:red;">Jquery Jpanelmenu<?php echo $set_lang['EVOLVE_REQUIRED']; ?></span></p>
		</div>
	</div>
</fieldset>
<fieldset class="container-collapsed widesec" id="container-6">
	<legend class="collapsedlegend" id="legend-5"><?php echo $set_lang['EVOLVE_SET_EXPAND']; ?></legend>
	<h3 style="margin:20px 10px"><?php echo $set_lang['EVOLVE_MAPS']; ?></h3>
	<div class="expand-settings">
		<div class="inner-divs">
			<p>
				<input type="checkbox" name="gmaps" id="gmaps" value=1 <?php echo return_theme_setting('gmaps')==1?"checked":"" ?>><span class="evolve-settings"><?php echo $set_lang['EVOLVE_MAPS_ENABLE']; ?></span>
			</p>
			<?php if(return_theme_setting('gmaps')) $maps_options = "display:block;";
			else $maps_options = "display:none;"; ?>
			<div id="gmapsoptions" style="<?php echo $maps_options; ?>">
				<div class="leftsec">
					<p>
						<label for="map-lat"><?php echo $set_lang['EVOLVE_MAPS_LAT']; ?></label>
						<input type="text" class="text" name="map-lat" id="map-lat" style="width: 80%;" value="<?php echo return_theme_setting('map-lat')?return_theme_setting('map-lat'):38.8987394 ?>">
					</p>
				</div>
				<div class="rightsec">
					<p>
						<label for="map-lot"><?php echo $set_lang['EVOLVE_MAPS_LONG']; ?></label>
						<input type="text" class="text" name="map-lot" id="map-lot" style="width: 80%;" value="<?php echo return_theme_setting('map-lot')?return_theme_setting('map-lot'):-77.0372789 ?>">
					</p>
				</div>
				<div class="leftsec">
					<p>
						<label for="map-marker"><?php echo $set_lang['EVOLVE_MAPS_MARKER']; ?></label>
						<input type="text" class="text" name="map-marker" id="map-marker" style="width: 80%;" value="<?php  echo return_theme_setting('map-marker')?return_theme_setting('map-marker'):$SITENAME ?>">
					</p>
				</div>
				<div class="rightsec">
					<p>
						<label for="map-zoom" style="display: block;"><?php echo $set_lang['EVOLVE_MAPS_ZOOM']; ?></label>
						<input type="text" class="text" name="map-zoom" id="map-zoom" style="width: 20%;" value="<?php echo return_theme_setting('map-zoom')?return_theme_setting('map-zoom'):14 ?>">
					</p>
				</div>
				<div class="leftsec">
					<p>
						<label for="map-key"><?php echo $set_lang['EVOLVE_MAPS_KEY']; ?></label>
						<input type="text" class="text" name="map-key" id="map-key" style="width: 80%;" value="<?php  echo return_theme_setting('map-key')?return_theme_setting('map-key'):'' ?>">
					</p>
				</div>
				<div class="rightsec">
					<p style="line-height: 50px;">
						<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank"><?php echo $set_lang['EVOLVE_MAPS_GETKEY']; ?></a>
					</p>
				</div>
				<p style="font-style:italic;"><?php echo $set_lang['EVOLVE_MAPS_DESC']; ?></p>
			</div>
			
		</div>
	</div>
</fieldset>

<fieldset class="container-collapsed widesec" id="container-7">
	<legend class="collapsedlegend" id="legend-4"><?php echo $set_lang['EVOLVE_SET_EXPAND']; ?></legend>
	<h3 style="margin:20px 10px"><?php echo $set_lang['EVOLVE_FOOTER']; ?></h3>
	<div class="expand-settings">
		<div class="inner-divs">
		<div class="leftsec" style="width: 40%;">
			<p style="font-style:italic;"><?php echo $set_lang['EVOLVE_FOOTER_DESC']; ?></p>
				<input type="radio" id="footer_mode" name="footer_mode" value=1 <?php echo return_theme_setting('footer_mode')==1?"checked":"" ?> style="margin-right: 6px;">Full
				<input type="radio" id="footer_mode" name="footer_mode" value=2 <?php echo return_theme_setting('footer_mode')==2?"checked":"" ?> style="margin-left: 20px;margin-right: 6px;">Middle
				<input type="radio" id="footer_mode" name="footer_mode" value=3 <?php echo return_theme_setting('footer_mode')==3?"checked":"" ?> style="margin-left: 20px;margin-right: 6px;">Minimal
			</div>
			<div class="rightsec" style="width: 60%;">
				<div class="widesec" id="snapshot1" style="height: 180px; border: 1px solid; border-radius: 4px;"></div>
			</div>
		</div>
	</div>
</fieldset>
<p style="text-align:center">© 2015 Andrejus Semionovas (aka asemion) - Please consider a <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RRPX5MZZJX4MW" target="_blank">Donation</a></p>
<script type="text/javascript">
	
	function testAnim(x) {
		jQuery('#animationSandbox').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
			jQuery(this).removeClass();
		});
	};
	
	jQuery('.js--animations').change(function(){
		var anim = jQuery(this).val();
		testAnim(anim);
		var anim_effect=anim;
		$("#effect-code #effect-code-name").text(anim_effect+'"');
	})
	
	jQuery('.collapsedlegend').click(function(){
		var path = '<?php echo $SITEURL; ?>';
		var expand = '<?php echo $set_lang['EVOLVE_SET_EXPAND']; ?>';
		var colapse = '<?php echo $set_lang['EVOLVE_SET_COLAPS']; ?>';
		if($(this).text()==expand){
			$(this).parent('fieldset').find('div:first').show(500);
			$(this).text(colapse);
			$(this).css('background-image', 'url('+path+'admin/template/images/tick.png)');
			}else{
			$(this).parent('fieldset').find('div:first').hide(500);
			$(this).text(expand);
			$(this).css('background-image', 'url('+path+'admin/template/images/utick.png)');
		}
	});
	
	jQuery('.trans-clear').click(function(){
		if($(this).attr('id')=='transitions-clear1'){
			$('#sl_trans').val('');
		}
		if($(this).attr('id')=='transitions-clear2'){
			$('#caption_trans').val('');
		}
	});
	
	jQuery(function(){
		setTimeout(function() {
			jQuery(".fancy-message").hide('slow');
		}, 10000);
		
		
	});
	jQuery('.iframe-buttn').fancybox({	
		'width'		: 900,
		'height'	: 600,
		'type'		: 'iframe',
		'autoScale'    	: false
	});
	
	var _tmpvar;
	var is_choose=false;
	jQuery('#slider-transitions').fancybox({	
		'width'		: 900,
		'height'	: 600,
		'type'		: 'iframe',
		'autoScale'    	: false,
		afterShow: function () {
            var $iframe = $('.fancybox-iframe');
			_tmpvar = $('#stTransition', $iframe.contents()).val();
            $('#ssTransition', $iframe.contents()).bind('change',function() {
                _tmpvar = $('#stTransition', $iframe.contents()).val();
            });
			$("#trans-choose", $iframe.contents()).bind('click', function () {
				is_choose=true;
			});
        },
        afterClose: function () {
			if(is_choose===true) {
				var trans = $('textarea[name=sl_trans]').val();
				$('textarea[name=sl_trans]').val(trans + _tmpvar + ',\n');
				is_choose=false;
			}
		}
		
	});

	var _tmpcode;
	jQuery('#captions-transitions').fancybox({	
		'width'		: 900,
		'height'	: 600,
		'type'		: 'iframe',
		'autoScale'    	: false,
		afterShow: function () {
            var $iframe = $('.fancybox-iframe');
			_tmpvar = $('#stTransition', $iframe.contents()).val();
			_tmpcode = $('#ssTransition option:selected', $iframe.contents()).text();
            $('#ssTransition', $iframe.contents()).bind('change',function() {
                _tmpvar = $('#stTransition', $iframe.contents()).val();
				_tmpcode = $('#ssTransition option:selected', $iframe.contents()).text();
            });
			$("#trans-choose", $iframe.contents()).bind('click', function () {
				is_choose=true;
			});
        },
        afterClose: function () {
			if(is_choose===true) {
				var trans = $('textarea[name=caption_trans]').val();
				$('textarea[name=caption_trans]').val(trans + '_CaptionTransitions["' + _tmpcode + '"] = ' + _tmpvar + ';\n');
				is_choose=false;
			}
		}
		
	});
	
	
	jQuery('#gmaps').change(function(){
		if(document.getElementById('gmaps').checked) {
			$("#gmapsoptions").css("display", "block");
			} else {
			$("#gmapsoptions").css("display", "none");
		}
	})
	
	jQuery(document.body).on('change',"#color_scheme",function (e) {
		var image;
		if(document.getElementById('title_parallex').checked) {
			image = 'parallex.jpg';
		} else {
			var schema = $('select[name=color_scheme]').val();
			switch(schema) {
				case 'default':
			image = 'parallex.jpg';
			break;
			case 'grayblue':
			image = 'grayblue.jpg';
			break;
			case 'beige':
			image = 'beige.jpg';
			break;
			case 'blue':
			image = 'blue.jpg';
			break;
			case 'brown':
			image = 'brown.jpg';
			break;
			case 'cyan':
			image = 'cyan.jpg';
			break;
			case 'gray':
			image = 'gray.jpg';
			break;
			case 'green':
			image = 'green.jpg';
			break;
			case 'yellow':
			image = 'yellow.jpg';
			break;
			case 'navy':
			image = 'navy.jpg';
			break;
			case 'olive':
			image = 'olive.jpg';
			break;
			case 'orange':
			image = 'orange.jpg';
			break;
			case 'pink':
			image = 'pink.jpg';
			break;
			case 'purple':
			image = 'purple.jpg';
			break;
			case 'red':
			image = 'red.jpg';
			break;
			default:
			image = 'no-paletes.jpg';
			}
		}
		var template = '<?php echo $TEMPLATE; ?>';
		var img_path = '../theme/'+template+'/images/snapshots/'+image;
		$("#snapshot").css("background", "transparent url('"+img_path+"') no-repeat scroll 0% 0% / 358px 235px");
	});
	
	jQuery(document.body).on('change',"#title_parallex",function (e) {
		var image;
		if(document.getElementById('title_parallex').checked) {
			image = 'parallex.jpg';
		} else {
			var schema = $('select[name=color_scheme]').val();
			switch(schema) {
				case 'default':
			image = 'parallex.jpg';
			break;
			case 'grayblue':
			image = 'grayblue.jpg';
			break;
			case 'beige':
			image = 'beige.jpg';
			break;
			case 'blue':
			image = 'blue.jpg';
			break;
			case 'brown':
			image = 'brown.jpg';
			break;
			case 'cyan':
			image = 'cyan.jpg';
			break;
			case 'gray':
			image = 'gray.jpg';
			break;
			case 'green':
			image = 'green.jpg';
			break;
			case 'yellow':
			image = 'yellow.jpg';
			break;
			case 'navy':
			image = 'navy.jpg';
			break; 
			case 'olive':
			image = 'olive.jpg';
			break;
			case 'orange':
			image = 'orange.jpg';
			break;
			case 'pink':
			image = 'pink.jpg';
			break;
			case 'purple':
			image = 'purple.jpg';
			break;
			case 'red':
			image = 'red.jpg';
			break;
			default:
			image = 'no-paletes.jpg';
			}
		}
		var template = '<?php echo $TEMPLATE; ?>';
		var img_path = '../theme/'+template+'/images/snapshots/'+image;
		$("#snapshot").css("background", "transparent url('"+img_path+"') no-repeat scroll 0% 0% / 358px 235px");
	});
	
	jQuery(document.body).on('change',"#footer_mode",function (e) {
		var image;
		var schemaf = $('input[name=footer_mode]');
		var val;
		for(var i = 0; i < schemaf.length; i++){
			if(schemaf[i].checked){
				val = schemaf[i].value;
			}
		}
		if(val == 1) { image = 'footer_max.jpg'; $("#snapshot1").css("height", "180px"); }
		if(val == 2) { image = 'footer_middle.jpg'; $("#snapshot1").css("height", "75px"); }
		if(val == 3) { image = 'footer_min.jpg'; $("#snapshot1").css("height", "25px"); }
		var template = '<?php echo $TEMPLATE; ?>';
		var img_path = '../theme/'+template+'/images/snapshots/'+image;
		$("#snapshot1").css("background", "transparent url('"+img_path+"') no-repeat scroll 0% bottom / 384px auto");
	});
	
	$( document ).ready(function() {
        var schema = $('select[name=color_scheme]').val();
		var schemaf = $('input[name=footer_mode]');
		var image1;
		var val;
		for(var i = 0; i < schemaf.length; i++){
			if(schemaf[i].checked){
				val = schemaf[i].value;
			}
		}
		if(val == 1) { image1 = 'footer_max.jpg'; }
		if(val == 2) { image1 = 'footer_middle.jpg'; $("#snapshot1").css("height", "75px"); }
		if(val == 3) { image1 = 'footer_min.jpg'; $("#snapshot1").css("height", "25px"); }
		var image;
		var parra = "<?php echo return_theme_setting('title_parallex'); ?>";
		var optScheme = parra;
		if(optScheme == 1) {
			image = 'parallex.jpg';
		} else {
		switch(schema) {
			case 'default':
			image = 'parallex.jpg';
			break;
			case 'grayblue':
			image = 'grayblue.jpg';
			break;
			case 'beige':
			image = 'beige.jpg';
			break;
			case 'blue':
			image = 'blue.jpg';
			break;
			case 'brown':
			image = 'brown.jpg';
			break;
			case 'cyan':
			image = 'cyan.jpg';
			break;
			case 'gray':
			image = 'gray.jpg';
			break;
			case 'green':
			image = 'green.jpg';
			break;
			case 'yellow':
			image = 'yellow.jpg';
			break;
			case 'navy':
			image = 'navy.jpg';
			break; 
			case 'olive':
			image = 'olive.jpg';
			break;
			case 'orange':
			image = 'orange.jpg';
			break;
			case 'pink':
			image = 'pink.jpg';
			break;
			case 'purple':
			image = 'purple.jpg';
			break;
			case 'red':
			image = 'red.jpg';
			break;
			default:
			image = 'no-paletes.jpg';
		}
		}
		var template = '<?php echo $TEMPLATE; ?>';
		var img_path = '../theme/'+template+'/images/snapshots/'+image;
		var img_path1 = '../theme/'+template+'/images/snapshots/'+image1;
		$("#snapshot").css("background", "transparent url('"+img_path+"') no-repeat scroll 0% 0% / 358px 235px");
		$("#snapshot1").css("background", "transparent url('"+img_path1+"') no-repeat scroll 0% bottom / 384px auto");
    });
	</script>	