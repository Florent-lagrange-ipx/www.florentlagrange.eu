<?php
/*
Plugin Name: Search Widgets
Description: Search Widgets
Version: 0.1
Author: Andrejus Semionovas
Author URI: http://pigios-svetaines.eu/projects/eshop-ra
*/

i18n_merge('search_widgets') || i18n_merge('search_widgets','en_US');

if (session_id() === "") {
	session_start();
}
global $language; global $SW_MESS; global $SITEURL;
if(basename(dirname($_SERVER['PHP_SELF'])) != 'admin') {
	if(!isset($language) && isset($_GET['setlang'])) {
		$language = $_GET['setlang'];
		$_SESSION['language'] = serialize($language);
	}
	if(!isset($language) && !isset($_GET['setlang']) && isset($_SESSION['language'])) {
		$language = unserialize($_SESSION['language']);
	}
	$location = realpath(dirname(__FILE__)) .'/search_widgets/lang/';
	$location = str_replace('\\','/', $location);
	if(isset($language)) {
		if(strlen($language>2)) $language = substr(language,0,2);
	}
	else $language = "en";
	if(isset($language) && $language == "en") $language = "en_US";
	if (file_exists($location.$language.'_'.strtoupper($language).'.php')) {
		include($location.$language.'_'.strtoupper($language).'.php');
	}
	else {
		include($location.'en_US.php');
	}
}

# get correct id for plugin
$thisfile = basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile,							//Plugin id
	'Search Widgets ',					//Plugin name
	'0.1',								//Plugin version
	'Andrejus Semionovas',				//Plugin author 
	'http://pigios-svetaines.eu/projects/eshop-ra',		//author website
	i18n_r($thisfile.'/SW_DESC'),		//Plugin description
	'pages',							//page type - on which admin tab to display
	'search_widgets_settings'			//main function (administration)
);

add_action('pages-sidebar','createSideMenu',array('search_widgets',i18n_r('search_widgets/MENU_TEXT')));
add_action('theme-footer','sw_scripts');
add_filter('content','processContent');

register_style('swidgets', $SITEURL.'plugins/search_widgets/css/search_widgets.css', '0.1', 'screen');
queue_style('swidgets', GSFRONT);

if (file_exists(GSPLUGINPATH.'search_widgets/config.xml')) {
	$conf=getXML(GSPLUGINPATH.'search_widgets/config.xml');
	$jquery = $conf->swJquery;
	$jqueryhead = $conf->swJqueryHead;
	if (isset($jquery) && $jquery == 1 && isset($jqueryhead) && $jqueryhead == 1) {
		register_script('sw_jquery', $SITEURL.'plugins/search_widgets/js/jquery-1.11.3.min.js', '1.11.3',FALSE);
		queue_script('sw_jquery', GSFRONT);
	}
}

/* BackEnd function for Plugin Settings Page */
function search_widgets_settings(){
	global $SITEURL;
	if (!file_exists(GSPLUGINPATH.'search_widgets/config.xml')) {
		$new_config = @new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><config></config>');
		$new_config->addChild('parent', 'search-results');
		$new_config->addChild('itemClass', 'search-entry');
		$new_config->addChild('txtget', 'Intel,Radeon,Core,Pentium,Celeron');
		$new_config->addChild('txtwant', 'Intel®,Radeon™,Core™,Pentium®,Celeron®');
		XMLsave($new_config,GSPLUGINPATH.'search_widgets/config.xml');
	}
	if(isset($_POST['save_settings']) && $_POST['save_settings']) {
		$conf=getXML(GSPLUGINPATH.'search_widgets/config.xml');
		if(isset($_POST['parent_class']) && !empty($_POST['parent_class'])) $conf->parent = $_POST['parent_class'];
		if(isset($_POST['item_class']) && !empty($_POST['item_class'])) $conf->itemClass = $_POST['item_class'];
		if(isset($_POST['sw_jquery']) && !empty($_POST['sw_jquery'])) $conf->swJquery = $_POST['sw_jquery'];
		else $conf->swJquery = 0;
		if(isset($_POST['sw_jquery_head']) && !empty($_POST['sw_jquery_head'])) $conf->swJqueryHead = $_POST['sw_jquery_head'];
		else $conf->swJqueryHead = 0;
		if(isset($_POST['lazy_load']) && !empty($_POST['lazy_load'])) $conf->lazyLoad = $_POST['lazy_load'];
		else $conf->lazyLoad = 0;
		if(isset($_POST['txt_get']) && !empty($_POST['txt_get'])) $conf->txtget = $_POST['txt_get'];
		if(isset($_POST['txt_want']) && !empty($_POST['txt_want'])) $conf->txtwant = $_POST['txt_want'];
		XMLsave($conf,GSPLUGINPATH.'search_widgets/config.xml');
		unset($_POST['save_settings']);
	}
	//load current config
	$conf=getXML(GSPLUGINPATH.'search_widgets/config.xml');
	$parent = $conf->parent;
	$item = $conf->itemClass;
	$jquery = $conf->swJquery;
	$jqueryhead = $conf->swJqueryHead;
	$lazy = $conf->lazyLoad;
	$txt_get = $conf->txtget;
	$txt_want = $conf->txtwant;
?>
<style>
	#help-outer { display: none; position: relative; transition: all .2s ease-out; }
	.help-close { background-image:url("http://localhost:1234/gs-shop/plugins/search_widgets/images/close.png"); background-repeat: no-repeat;width: 16px;height: 16px;position: absolute;right: 6px;top: -6px;cursor: pointer; }
	#desc-help { padding: 20px; border: 1px solid blue; border-radius: 3px; margin: 10px; }
	.tab-settings { display: none; }
	.settings-desc { margin: 20px 0 6px 0 !important; }
</style>
	<h3 class="floated" style="float:left;margin-bottom: 20px;"><?php i18n('search_widgets/TITLE'); ?></h3>
	<div class="edit-nav" >
		<p>
			<a href="#" id="view" class="current" onclick="showTab('view')" ><?php i18n('search_widgets/VIEW_USAGE'); ?></a>
			<a href="#" id="settings" onclick="showTab('settings')" ><?php i18n('search_widgets/VIEW_SETTINGS'); ?></a>
		</p>
		<div class="clear" ></div>
	</div>
	<fieldset class="tab-view widesec" style="border-radius: 3px; padding: 10px; width: 96%;">
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT1'); ?></p>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT1_1'); ?></p>
		<code>(% get_search_widgets <i>parameters_list</i> %)</code>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT2'); ?></p>
		<code>(% get_search_widgets addFilter="specialfield" mode="filter mode" itemCaption="Your Item Caption" caption="Your Block Caption" showCounters=1 %)</code>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT2_1'); ?></p>
		<code>&lt;?php get_search_widgets(array('specialName'=>'laptops-items', 'addFilter'=>'manufacturer', 'mode'=>'dropdown', 'caption'=>'Trademarks', 'showCounters'=>1)); ?&gt;</code>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT3'); ?></p>
		<code>(% get_search_widgets addRange=1 caption="Your Block Caption" currencySign="$" %)</code>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT4'); ?></p>
		<code>(% get_search_widgets addPagify=1 showItemsNumber=1 showPagesNumber=1 %)</code>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT5'); ?></p>
		<code>(% get_search_widgets addSort="price,asc,number&price,desc,number" sortCaptions="Cheapest&Expensive" %)</code>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT6'); ?></p>
		<code>(% get_search_widgets addSearchBox="item-title" Placeholder="Search by title" %)</code>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT9'); ?></p>
		<code>(% searchresults addTags=_parent_laptops live=1 lang=en HEADER='' %)</code>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT7'); ?>
		<br />
			<div style="width: 160px; float: left;">1) I18n Base</div><div><?php echo (function_exists('i18n_init')) ? '<font color="green">'.i18n_r('search_widgets/PL_INSTALLED').'</font>' : '<font color="red">'.i18n_r('search_widgets/PL_NOTINSTALLED').'</font>'; ?></div>
			<div style="width: 160px; float: left;">2) I18n Special Pages</div><div><?php echo (function_exists('return_special_field')) ? '<font color="green">'.i18n_r('search_widgets/PL_INSTALLED').'</font>' : '<font color="red">'.i18n_r('search_widgets/PL_NOTINSTALLED').'</font>'; ?></div>
			<div style="width: 160px; float: left;">3) I18n Search</div><div><?php echo (function_exists('return_i18n_search_results')) ? '<font color="green">'.i18n_r('search_widgets/PL_INSTALLED').'</font>' : '<font color="red">'.i18n_r('search_widgets/PL_NOTINSTALLED').'</font>'; ?></div>
		</p>
		<p class="settings-desc" ><?php i18n('search_widgets/DESC_TXT8'); ?></p>
		<table id="editsearch" class="edittable highlight">
			<thead>
				<tr><th><?php i18n('search_widgets/TABLE_NAME'); ?></th><th><?php i18n('search_widgets/TABLE_TYPE'); ?></th><th style="white-space: nowrap;"><?php i18n('search_widgets/TABLE_DEFA'); ?></th><th><?php i18n('search_widgets/TABLE_DESC'); ?></th></tr>
			</thead>
			<tbody>
				<tr><td>specialName</td><td>string</td><td align="center">name</td><td><?php i18n('search_widgets/TABL_TXT0'); ?></td></tr>
				<tr><td colspan="4"><strong><?php i18n('search_widgets/TABLE_PAR1'); ?>addFilter</strong></td></tr>
				<tr><td>addFilter</td><td>string</td><td align="center">-</td><td><?php i18n('search_widgets/TABL_TXT1'); ?></td></tr>
				<tr><td>mode</td><td>string</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT2'); ?></td></tr>
				<tr><td>caption</td><td>string</td><td align="center">empty</td><td><?php i18n('search_widgets/TABL_TXT3'); ?></td></tr>
				<tr><td>itemCaption</td><td>string</td><td align="center">empty</td><td><?php i18n('search_widgets/TABL_TXT4'); ?></td></tr>
				<tr><td>showCounters</td><td>bool</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT5'); ?></td></tr>
				<tr><td>ItemsCount</td><td>int</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT6'); ?></td></tr>
				<tr><td colspan="4"><strong><?php i18n('search_widgets/TABLE_PAR1'); ?>addRange</strong></td></tr>
				<tr><td>addRange</td><td>int</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT7'); ?></td></tr>
				<tr><td>caption</td><td>string</td><td align="center">empty</td><td><?php i18n('search_widgets/TABL_TXT3'); ?></td></tr>
				<tr><td>currencySign</td><td>string</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT8'); ?></td></tr>
				<tr><td colspan="4"><strong><?php i18n('search_widgets/TABLE_PAR1'); ?>addPagify</strong></td></tr>
				<tr><td>addPagify</td><td>int</td><td align="center">-</td><td><?php i18n('search_widgets/TABL_TXT9'); ?></td></tr>
				<tr><td>ItemsperPage</td><td>int</td><td align="center">12</td><td><?php i18n('search_widgets/TABL_TXT10'); ?></td></tr>
				<tr><td>showItemsNumber</td><td>bool</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT11'); ?></td></tr>
				<tr><td>showPagesNumber</td><td>bool</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT12'); ?></td></tr>
				<tr><td colspan="4"><strong><?php i18n('search_widgets/TABLE_PAR1'); ?>addSort</strong></td></tr>
				<tr><td>addSort</td><td>string</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT13'); ?></td></tr>
				<tr><td>sortCaptions</td><td>string</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT14'); ?></td></tr>
				<tr><td colspan="4"><strong><?php i18n('search_widgets/TABLE_PAR1'); ?>addSearchBox</strong></td></tr>
				<tr><td>addSearchBox</td><td>string</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT15'); ?></td></tr>
				<tr><td>Placeholder</td><td>string</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT16'); ?></td></tr>
				<tr><td colspan="4"><strong><?php i18n('search_widgets/TABLE_PAR1'); ?>addReset</strong></td></tr>
				<tr><td>addReset</td><td>string</td><td align="center">false</td><td><?php i18n('search_widgets/TABL_TXT17'); ?></td></tr>
				<tr><td>caption</td><td>string</td><td align="center">'Reset'</td><td><?php i18n('search_widgets/TABL_TXT18'); ?></td></tr>
			</tbody>
		</table>
	</fieldset>
	<form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" class="tab-settings" >
		<fieldset class="container widesec" style="border-radius: 3px; padding: 10px; width: 96%;">
			<div class="inner-divs" style="display: inline-block;width: 100%;">
				<div style="width: 40%; float: left;"><span class="input-span"><?php i18n('search_widgets/PARENT_CLASS'); ?></span></div>
				<div style="width: 40%; float: left;"><input class="text" type="text" name="parent_class" style="width: 100%;" value="<?php echo $parent; ?>"/></div>
				<div style="width: 20%; float: left; text-align: center;"><span style="position: absolute; padding: 0px 10px; margin-top: -3px; cursor: pointer;" title="<?php i18n('search_widgets/HELP_DESC'); ?>" onclick="myFunction('<?php i18n('search_widgets/HELP_PARENT'); ?>')"><img src="<?php echo $SITEURL.'plugins/search_widgets/images/qmark.png'; ?>" /></span></div>
			</div>
			<div class="inner-divs" style="display: inline-block;width: 100%;">
				<div style="width: 40%; float: left;"><span class="input-span"><?php i18n('search_widgets/ITEM_CLASS'); ?></span></div>
				<div style="width: 40%; float: left;"><input class="text" type="text" name="item_class" style="width: 100%;" value="<?php echo $item; ?>"/></div>
				<div style="width: 20%; float: left; text-align: center;"><span style="position: absolute; padding: 0px 10px; margin-top: -3px; cursor: pointer;" title="<?php i18n('search_widgets/HELP_DESC'); ?>" onclick="myFunction('<?php i18n('search_widgets/HELP_ITEM'); ?>')"><img src="<?php echo $SITEURL.'plugins/search_widgets/images/qmark.png'; ?>" /></span></div>
			</div>
			<div class="inner-divs widesec" style="margin: 20px 0px;">
				<div class="leftsec">
					<input type="checkbox" id="sw_jquery" name="sw_jquery" value=1 <?php echo $jquery==1?"checked":"" ?> style="float: left; margin-right: 6px; cursor: pointer;" /><label for="sw_jquery" style="cursor: pointer;"><?php i18n('search_widgets/SW_JQUERY'); ?></label>
				</div>
				<div class="rightsec">
					<input type="checkbox" id="sw_jquery_head" name="sw_jquery_head" value=1 <?php echo $jqueryhead==1?"checked":"" ?> style="float: left; margin-right: 6px; cursor: pointer;" /><label for="sw_jquery_head" style="cursor: pointer;"><?php i18n('search_widgets/SW_JQUERY_HEAD'); ?></label>
				</div>
			</div>
			<div class="inner-divs" style="padding-bottom: 20px;">
				<input type="checkbox" id="lazy_load" name="lazy_load" value=1 <?php echo (isset($lazy) && $lazy==1)?"checked":"" ?> style="float: left; margin-right: 6px; cursor: pointer;" /><label for="lazy_load" style="cursor: pointer;"><?php i18n('search_widgets/LAZY_LOAD'); ?></label>
			</div>
			<hr>
			<div class="inner-divs widesec" style="margin: 20px 0 0;">
				<span class="input-span"><?php i18n('search_widgets/TXT_GET'); ?></span>
				<input class="text" type="text" name="txt_get" style="width: 98%;margin-bottom: 10px;" value="<?php echo $txt_get; ?>"/>
				<span class="input-span"><?php i18n('search_widgets/TXT_WANT'); ?></span>
				<input class="text" type="text" name="txt_want" style="width: 98%;margin-bottom: 12px;" value="<?php echo $txt_want; ?>"/>
				<span class="input-span"><?php i18n('search_widgets/TXT_REPLACE'); ?></span>
			</div>
			<hr>
			<div id="help-outer">
				<div class="help-close" onclick="HelpClose()"></div>
				<div id="desc-help"></div>
			</div>
			<input type="submit" name="save_settings" class="change-button" value="<?php i18n('search_widgets/SUBMIT'); ?>" style="padding: 6px 14px; cursor: pointer;" />
		</fieldset>
	</form>
	<script>
	function myFunction(text) {
		var a = document.getElementById("help-outer");
		var e = document.getElementById("desc-help");
		e.innerHTML = text;
		$("#help-outer").toggle(200);
	}
	function HelpClose() {
		$("#help-outer").hide(200);
	}
	function showTab(element) {
		if(element == 'view') {
			$(".tab-settings").hide();
			$(".tab-view").show();
			$("#settings").removeClass('current');
			$("#view").addClass('current');
		}
		if(element == 'settings') {
			$(".tab-view").hide();
			$(".tab-settings").show();
			$("#view").removeClass('current');
			$("#settings").addClass('current');
		}
	}
	</script>
<?php
}

/* FrontEnd function for Search Widgets elements rendering */
function get_search_widgets($params=null){
	global $SITEURL; global $TEMPLATE; global $i18n;
	if(!function_exists("SearchParams")) {
		function SearchParams($params) {
			if (file_exists(GSPLUGINPATH.'search_widgets/config.xml')) {
				$data = getXML(GSPLUGINPATH.'search_widgets/config.xml');
				if ($data) foreach ($data->children() as $child) {
					if (!array_key_exists($child->getName(), $params)) $params[$child->getName()] = (string) $child;
				}
			}
			return $params;  
		}
	}

	$params = SearchParams(is_array($params) ? $params : array()); 
	if(array_key_exists('txtget',$params)) {
		$txt_get = explode(',', $params['txtget']);
	}
	if(array_key_exists('txtwant',$params)) {
		$txt_want = explode(',', $params['txtwant']);
	}
	
	/* Get Plugin Parameters List */
	$addFilter = array_key_exists('addFilter',$params) ? $params['addFilter'] : false;
	$mode = array_key_exists('mode',$params) ? $params['mode'] : false;
	$caption = array_key_exists('caption',$params) ? $params['caption'] : '';
	$itemCaption = array_key_exists('itemCaption',$params) ? $params['itemCaption'] : '';
	$ItemsCount = array_key_exists('ItemsCount',$params) ?  intval($params['ItemsCount']) : false;
	$showCounters = isset($params['showCounters']) && $params['showCounters'];
	$addRange = array_key_exists('addRange',$params) ? $params['addRange'] : false;
	$RangePath = array_key_exists('RangePath',$params) ? $params['RangePath'] : false;
	$currencySign = array_key_exists('currencySign',$params) ? $params['currencySign'] : false;
	$addPagify = isset($params['addPagify']) && $params['addPagify'];
	$showPagesNumber = isset($params['showPagesNumber']) && $params['showPagesNumber'];
	$showItemsNumber = isset($params['showItemsNumber']) && $params['showItemsNumber'];
	$ItemsperPage = array_key_exists('ItemsperPage',$params) ? (int) $params['ItemsperPage'] : 12;
	$addSort = array_key_exists('addSort',$params) ? $params['addSort'] : false;
	$sortCaptions = array_key_exists('sortCaptions',$params) ? $params['sortCaptions'] : false;
	$addSearchBox = array_key_exists('addSearchBox',$params) ? $params['addSearchBox'] : false;
	$Placeholder = array_key_exists('Placeholder',$params) ? $params['Placeholder'] : false;
	$specialName = array_key_exists('specialName',$params) ? $params['specialName'] : false;
	$addReset = array_key_exists('addReset',$params) ? $params['addReset'] : false;

	if(!function_exists("sa_field_values")) {
		function sa_field_values($name, $spec_name) {
			$sp = i18n_specialpages_settings();
			$sp_fields = $sp[$spec_name]['fields'];
			$field_values = false;
			foreach($sp_fields as $sp_field) {
				if((string)$sp_field['name'] == trim($name)) {
					if((string)$sp_field['type'] == 'dropdown') {
						$field_values = $sp_field['options'];
					} else {
						$field_values = $sp_field['name'];
					}
				}
			}
			return $field_values;
		}
	}
	
	$pages = return_i18n_pages();
	if($specialName) {
		$spec_name = str_replace(array(",", " ", "_", "special"), "", $specialName);
	}
	else {
		$curr = (string)return_page_slug();
		if(isset($pages[$curr]['children'][0])) {
			$child = (string)$pages[$curr]['children'][0];
			$spec_name = str_replace(array(",", " ", "_", "special"), "", $pages[$child]['tags']);
		} else {
			return;
		}
	}
?>
<!-- jPList start -->
<?php
if($addFilter) {
	global $SW_MESS; ?>
<div class="search-widget sa-search">
	<div class="tags">
		<div class="sa-filter"> <?php
		if(isset($caption) && !empty($caption)) { ?>
			<p class="filter-caption"><?php echo $caption; ?></p>
<?php	}
		if ($mode == 'checkbox' || $mode == 'radio' || $mode == 'dropdown') {
			if ($mode == 'checkbox') { ?>
			<div id="<?php echo $addFilter; ?>" class="jplist-group checkbox-filter" data-control-type="checkbox-group-filter" data-control-action="filter" data-control-name="<?php echo $addFilter; ?>" >
			<!-- checkbox filters --> <?php
			}
			if ($mode == 'radio') { ?>
			<div id="<?php echo $addFilter; ?>" class="jplist-group radio-filter" >
			<!-- radio filters --> <?php
			}
			if ($mode == 'dropdown') { ?>
			<div id="<?php echo $addFilter; ?>" class="jplist-drop-down" data-control-type="filter-drop-down" data-control-name="<?php echo $addFilter; ?>-filter" data-control-action="filter" >
			<!-- dropdown filters -->
				<ul>
					<li><span data-path="default"><?php echo $SW_MESS['TXT_DROP']; ?></span></li>
			<?php
			}
			$filters = sa_field_values($addFilter, $spec_name);
			$counter = 1;
			foreach ($filters as $filter) {
				$name = str_replace('&quot;', '"', $filter);
				$name = str_replace($txt_get, $txt_want,  $name);
				$filter = strtolower($filter);
				if (count($filters) > 0) {
					$tags = return_i18n_tags();
					$metak = html_entity_decode(strip_tags(stripslashes(htmlspecialchars_decode($filter))), ENT_QUOTES, 'UTF-8');
					$filter = trim($metak);
					$tag = mb_ereg_replace("[^\w]", " ", mb_strtolower($filter, 'UTF-8'));
					$tag = str_replace(array('&quot;', '"', ' ', '(', ')'), '_',  $tag);
					$tag = str_replace(array('____', '___', '__', '_'), ' ',  $tag);
					if(strpos($tag, '"')) {
						$path = strtolower(strpos($filter, '"') ? substr($filter, 0, strpos($filter, '"')) : str_replace(' ', '-',  $filter));
					} elseif(strpos($filter, '&quot;')) {
						$path = strtolower(strpos($filter, '&quot;') ? substr($filter, 0, strpos($filter, '&quot;')) : str_replace(' ', '-',  $filter));
						
					} else { $path = str_replace(' ', '-',  $tag); }
					if (isset($tags[$tag]) && count($tags[$tag]) > 0) {
						if($ItemsCount && $counter > $ItemsCount)  $div_style = "display:none;";
						else $div_style = "display:block;";
							if ($mode == 'checkbox') { ?>
				<div style="<?php echo $div_style; ?>"><input data-path=".<?php echo $path; ?>" id="<?php echo $path; ?>" type="checkbox" /> 
				<label for="<?php echo $path; ?>"><?php echo htmlspecialchars($name); ?></label> <?php
								 $counter++;
							}
							if ($mode == 'radio') { ?>
				<div style="<?php echo $div_style; ?>"><input data-control-type="radio-buttons-filters" data-control-action="filter" data-control-name="<?php echo $path; ?>" data-path=".<?php echo $path; ?>" id="<?php echo $path; ?>" type="radio" name="jplist" /> 
				<label for="<?php echo $path; ?>"><?php echo htmlspecialchars($name); ?></label>
					<?php		 $counter++;
							}
							if ($mode == 'dropdown') { ?>
				<li><span data-path=".<?php echo $path; ?>"><?php echo htmlspecialchars($name); ?></span>
					 <?php		if($showCounters && $mode == 'dropdown') { ?>
					<span class="search-counts <?php echo $path; ?>" style="padding-right:4px" data-control-type="counter" data-control-action="counter" data-control-name="<?php echo $path; ?>-counter" data-format="({count})" data-path=".<?php echo $path; ?>" data-mode="filter"  data-type="path"></span>
					<?php		} ?>
				</li>
					<?php	}
						if($showCounters && $mode != 'dropdown') { ?>
				<span class="search-counts <?php echo $path; ?>" data-control-type="counter" data-control-action="counter" data-control-name="<?php echo $path; ?>-counter" data-format="({count})" data-path=".<?php echo $path; ?>" data-mode="filter"  data-type="path"></span>
						<?php	}
						if ($mode != 'dropdown') { ?>
				</div>
				<?php		
						}
					}
					
				}	
			}
			if($ItemsCount && is_numeric($ItemsCount)) { ?>
			<a class="load-more" href="#" style="font-size: 14px;" onclick="showMore(this); return false;"><?php echo $SW_MESS['SHOW_MORE']; ?><span style="background: url(<?php echo $SITEURL;?>plugins/search_widgets/images/arrow_down.png) no-repeat bottom right; height: 20px; width: 15px; position: absolute; margin-left: 10px;"></span></a>	<?php
			}
			if ($mode == 'dropdown') { ?>
			</ul>
		<?php } ?>
		</div> <?php
		} else { ?>
			<div id="<?php echo $addFilter; ?>" class="jplist-group checkbox-filter" data-control-type="checkbox-group-filter" data-control-action="filter" data-control-name="<?php echo $addFilter; ?>" > <?php
			$filters = explode('&', $addFilter);
			if(isset($itemCaption) && !empty($itemCaption)) $captions = explode('&', $itemCaption);
			$sc = 0;
			foreach ($filters as $filter) {
				$filter = sa_field_values($filter, $spec_name);
				$name = $filter;
				$filter = strtolower($filter);
				if (count($filters) > 0) { ?>
			<!-- checkbox filters -->
				<input data-path=".<?php echo str_replace(' ', '-',  $filter); ?>" id="<?php echo str_replace(' ', '-',  $filter); ?>" type="checkbox" /> 
				<label for="<?php echo str_replace(' ', '-',  $filter); ?>"><?php echo isset($captions) ? $captions[$sc] : htmlspecialchars($name); ?></label> <?php
				if($showCounters) { ?>
				<span class="search-counts" data-control-type="counter" data-control-action="counter" data-control-name="<?php echo str_replace(' ', '-',  $filter); ?>-counter" data-format="({count})" data-path=".<?php echo str_replace(' ', '-',  $filter); ?>" data-mode="filter"  data-type="path"></span>
		<?php	} ?>
				<br />
				<?php
					$sc++;
				}
			} ?>
			</div> <?php
		}
		?>
		</div>
	</div>
</div> <?php
}
if($addRange) { 
	global $currSign;
	if($currencySign) $currSign = $currencySign; ?>
<div class="search-widget sa-search">
	<div class="tags">
		<div class="sa-filter">  <?php
	if($RangePath) { $range_path = $RangePath; }
	else { $range_path = 'price'; }
	if(isset($caption) && !empty($caption)) { ?>
		<p class="filter-caption"><?php echo $caption; ?></p> <?php
	} ?>
			<div class="jplist-range-slider" data-control-type="range-slider" data-control-name="range-slider-prices" data-control-action="filter" data-path=".<?php echo $range_path; ?>" data-slider-func="pricesSlider" 	data-setvalues-func="priesValues">
				<div class="value prev" data-type="prev-value"></div>
				<div class="ui-slider" data-type="ui-slider"></div>
				<div class="value next" data-type="next-value"></div>
			</div>
		</div>
	</div>
</div>
<?php
}
if ($addPagify) {
	global $SW_MESS;
	if($showPagesNumber) { ?>
	<div class="jplist-label" data-type="<?php echo $SW_MESS['TXT_PAGE']; ?> {current} <?php echo $SW_MESS['TXT_OF']; ?> {pages}" data-control-type="pagination-info"    data-control-name="paging" data-control-action="paging"></div>
	<?php
	}
	if($showItemsNumber) { ?>
	<div class="jplist-label" data-type="{start} - {end} <?php echo $SW_MESS['TXT_OF']; ?> {all}" data-control-type="pagination-info"    data-control-name="paging" data-control-action="paging"></div>
	<?php
	} ?>
	<div class="jplist-pagination" data-control-type="pagination" data-control-name="paging" 		   data-control-action="paging" data-items-per-page="<?php echo $ItemsperPage; ?>"></div> <?php
}
if ($addSort) {
	global $SW_MESS;
	$all_sorts = explode('&', $addSort);
	if ($sortCaptions) { $sorts_captions = explode('&', $sortCaptions); }
 	else { $sorts_captions = 'Sort Item #'; }
	?>
	<!-- sort dropdown -->
	<div class="jplist-drop-down sort-widget" data-control-type="sort-drop-down" data-control-name="sort" 			data-control-action="sort" data-datetime-format="{month}/{day}/{year}"><ul>
		<li><span data-path="default"><?php echo $SW_MESS['TXT_SORT']; ?></span></li> <?php
	$ss = 0;
	foreach ($all_sorts as $some_sort) {
		$sort_element = explode(',', $some_sort);
		$sort_field = $sort_element[0];
		if(isset($sort_element[1])) $sort_order = $sort_element[1];
		else $sort_order = 'asc';
		if(isset($sort_element[2])) $sort_type = $sort_element[2];
		else $sort_type = 'text'; ?>
		<li><span data-path=".<?php echo $sort_field; ?>" data-order="<?php echo $sort_order; ?>" data-type="<?php echo $sort_type; ?>"><?php echo $sortCaptions ? $sorts_captions[$ss] : $sorts_captions.($ss+1); ?></span></li> <?php
		$ss++;
	}
?>
	</ul></div> <?php
} 
if($addSearchBox) { 
	if(!$Placeholder) $Placeholder = 'Filter by Title';
	?>
	<div class="search-widgets text-filter-box">
		<i class="fa fa-search jplist-icon"></i>
		<!--[if lt IE 10]>
		<div class="jplist-label"><?php echo $Placeholder; ?>:</div>
		<![endif]-->
		<input data-path=".<?php echo $addSearchBox; ?>" type="text" value="" placeholder="<?php echo $Placeholder; ?>" data-control-type="textbox" data-control-name="title-filter" data-control-action="filter" />
	</div>	
<?php
}
if($addReset) {
	if(isset($caption) && !empty($caption)) $btntxt = $caption;
	else $btntxt = "Reset"; ?>
	<button type="button" class="jplist-reset-btn" data-control-type="reset" data-control-name="reset" data-control-action="reset">
		<?php echo $btntxt; ?><i class="fa fa-share"></i>
	</button>
<?php
}
}

function replaceContentMatch($match) {
    global $args;
    $function = $match[2];
    $params = array();
    $paramstr = isset($match[3]) ? html_entity_decode(trim($match[3]), ENT_QUOTES, 'UTF-8') : '';
    while (preg_match('/^([a-zA-Z][a-zA-Z0-9_-]*)[:=]([^"\'\s]*|"[^"]*"|\'[^\']*\')(?:\s|$)/', $paramstr, $pmatch)) {
      $key = $pmatch[1];
      $value = trim($pmatch[2]);
      if (substr($value,0,1) == '"' || substr($value,0,1) == "'") $value = substr($value,1,strlen($value)-2);
      $params[$key] = $value;
      $paramstr = substr($paramstr, strlen($pmatch[0]));
    }
    $replacement = '';
    if (@$match[1] && (!@$match[4] || $function == 'searchrss')) $replacement .= $match[1];
    ob_start();
    if ($function == 'get_search_widgets') {
      get_search_widgets($params);
    }
    $replacement .= ob_get_contents();
    ob_end_clean();
    if (@$match[4] && (!@$match[1])) $replacement .= $match[4];
    return $replacement;
}

function processContent($content) {
    return preg_replace_callback("/(<p>\s*)?\(%\s*(get_search_widgets)(\s+(?:%[^%\)]|[^%])+)?\s*%\)(\s*<\/p>)?/", 
	'replaceContentMatch',$content);
 }

function sw_scripts() {
	if (file_exists(GSPLUGINPATH.'search_widgets/config.xml')) {
		$conf=getXML(GSPLUGINPATH.'search_widgets/config.xml');
		$parent = $conf->parent;
		$item = $conf->itemClass;
		$jquery = $conf->swJquery;
		$jqueryhead = $conf->swJqueryHead;
		$lazy = $conf->lazyLoad;
	} else {
		$parent = 'search-results';
		$item = 'search-entry';
	}
	global $currSign; global $SITEURL;
	?>
<script>
var path = "<?php echo $SITEURL; ?>plugins/search_widgets";
var item = "<?php echo $item; ?>";
var parent = "<?php echo $parent; ?>";
var swjquery = "<?php echo $jquery; ?>";
var swjqueryhead = "<?php echo $jqueryhead; ?>";
var lazy = "<?php echo $lazy; ?>";
/* Section for Search Widgets dinamic JS scripts loading */
if (typeof swjquery != 'undefined' && swjquery == 1 || typeof swjqueryhead == 'undefined' && swjqueryhead == 0) {
	document.write('<script type="text/javascript" src="'+path+'/js/jquery-1.11.3.min.js"><\/script>');
}
if ($('.'+parent)[0] || $('.'+parent)[0]) {
	document.write('<link rel="stylesheet" type="text/css" href="'+path+'/css/jplist.core.min.css" />');
	document.write('<script type="text/javascript" src="'+path+'/js/jplist.core.min.js"><\/script>');
	if (typeof lazy !== 'undefined' && lazy != 0) {	// Enabling Lazy Load function
		document.write('<script type="text/javascript" src="'+path+'/js/jquery.lazy.min.js"><\/script>');
		$(function() {
			$( '.'+item ).addClass( "lazy" );
			$( '.'+item+' img' ).addClass( "lazy load" );
			$(".lazy img").each(function() {
				$(this).attr("data-src",$(this).attr("src"));
				$(this).removeAttr("src");
			}); 
			$("<style type='text/css'> .lazy.load{ background-image: url('"+path+"/images/loading.gif');background-repeat: no-repeat;background-position: 50% 50%;} </style>").appendTo("head");
			$('.search-entry').attr('data-loader', 'customLoaderName');
			$('.lazy').lazy({
				customLoaderName: function(element) {
					element.load();
				}
			});
		});
	}
}
if ($(".checkbox-filter")[0]) {
	document.write('<script type="text/javascript" src="'+path+'/js/jplist.filter-toggle-bundle.min.js"><\/script>');
}
if ($(".search-counts")[0]) {
	document.write('<script type="text/javascript" src="'+path+'/js/jplist.counter-control.min.js"><\/script>');
}
if ($(".jplist-range-slider")[0]) {
	document.write('<link rel="stylesheet" type="text/css" href="'+path+'/css/jquery-ui.css" />');
	document.write('<script type="text/javascript" src="'+path+'/js/vendor/jquery-ui.js"><\/script>');
	document.write('<script type="text/javascript" src="'+path+'/js/jplist.jquery-ui-bundle.min.js"><\/script>');
}
if ($(".text-filter-box")[0]) {
	document.write('<script type="text/javascript" src="'+path+'/js/jplist.textbox-filter.min.js"><\/script>');
}
if ($(".jplist-pagination")[0]) {
	document.write('<script type="text/javascript" src="'+path+'/js/jplist.pagination-bundle.min.js"><\/script>');
}
if ($(".sort-widget")[0]) {
	document.write('<script type="text/javascript" src="'+path+'/js/jplist.sort-bundle.min.js"><\/script>');
}
if ($(".jplist-reset-btn")[0]) {
	document.write('<script type="text/javascript" src="'+path+'/js/jplist.history-bundle.min.js"><\/script>');
}
if ($(".jplist-drop-down")[0]) {
	document.write('<script type="text/javascript" src="'+path+'/js/jplist.filter-dropdown-bundle.min.js"><\/script>');
}
/* Scripts loading section END */

function minMaxId(selector) {	/* Determines MIN and MAX values for numbers range widget */
	var minmax=null, min=null, max=null;
	$(selector).each(function() {
		var sum =  $(this).text();
		var minmax = parseInt(sum, 10);
		if ((min===null) || (minmax < min)) { min = minmax-1; }
		if ((max===null) || (minmax > max)) { max = minmax+1; }
	});
	return {min:min, max:max};
}

function showMore(element) {	/* Show more elements on filter widgets */
	var id = element.parentNode.id;
	$("#"+id+" div").attr("style","display: block");
	$("#"+id+" .load-more").attr("style","display: none");
}

if ($('.'+parent)[0] || $('.'+parent)[0]) {
$('document').ready(function(){
	var minimi = minMaxId('.price');
	var currency = "<?php echo $currSign; ?>";
	jQuery.fn.jplist.settings = {
	/** PRICES: jquery ui range slider **/
	pricesSlider: function ($slider, $prev, $next){
		$slider.slider({
			min: minimi['min']
			,max: minimi['max']
			,range: true
			,values: [minimi['min'], minimi['max']]
			,slide: function (event, ui){
				$prev.text(ui.values[0] + currency);
				$next.text(ui.values[1] + currency);
			}
		});
	}
	/** PRICES: jquery ui set values **/
	,priesValues: function ($slider, $prev, $next){
		$prev.text($slider.slider('values', 0) + currency);
		$next.text($slider.slider('values', 1) + currency);
	}
	};
	
	var parent = "<?php echo $parent; ?>";
	var item = "<?php echo $item; ?>";
	$('#search-outer').jplist({		/* Initializing Search Widgets structure */
		itemsBox: '.'+parent
		,itemPath: '.'+item 
		,panelPath: '.search-widgets'	
	});
});
}
</script>
<?php
}
?>
