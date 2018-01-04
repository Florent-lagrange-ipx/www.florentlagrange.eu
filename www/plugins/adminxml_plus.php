<?php
/**
 *  Plugin Name: AdminXML Plus
 *  Description: Allows quickly changing, previewing, and exporting the admin.xml theme file. Requires GS Custom Settings 0.4+.
 *  Support thread: http://get-simple.info/forums/showthread.php?tid=7325
 *  Version: 0.2
 *  Author: Kevin Van Lierde (Tyblitz)
 *  Author URI: http://webketje.com/
 *  Check out my other plugins: http://get-simple.info/extend/a/Tyblitz
 **/

// custom lang handling, didn't feel like creating an extra PHP lang file.
$admin_themer_lang = GSPLUGINPATH . 'adminxml_plus/lang/';
if (file_exists($admin_themer_lang . $LANG . '.json'))
	$admin_themer_lang = json_decode(file_get_contents($admin_themer_lang . $LANG . '.json'), TRUE);
else
	$admin_themer_lang = json_decode(file_get_contents($admin_themer_lang . 'en_US.json'), TRUE);
$admin_themer_lang = $admin_themer_lang['strings'];

register_plugin(
	'adminxml_plus',
	$admin_themer_lang['PLUGIN_TITLE'],
	'0.2',
	'Kevin Van Lierde',
	'http://webketje.com', 
	$admin_themer_lang['PLUGIN_DESCR'],
	'plugins'
);

// provide a way for other themes/ plugins to check 
// whether AdminXML Plus is active and what version
define('ADMINXML_PLUS', '0.2');

// GS Custom Settings hooks. Load hook only works in GSCS 0.6+
// for set_setting function
if (defined('GS_CUSTOM_SETTINGS'))
	add_action('custom-settings-load', 'adminxml_plus_sync');
add_action('custom-settings-render-bottom', 'custom_settings_render', array('adminxml_plus', 'adminxml_plus_frontend'));

// if the user has an admin.xml, synchronize the values in the file with the data
// saved by GS Custom Settings. Exec'd in hook custom-settings-load, GSCS 0.6+
function adminxml_plus_sync() 
{
	$admin_xml = GSTHEMESPATH . 'admin.xml';
	if (file_exists($admin_xml)) {
		$admin_xml = getXML($admin_xml);
		$pri = $admin_xml->primary;
		$sec = $admin_xml->secondary;
		set_setting('adminxml_plus','primary0', trim((string)$pri->darkest));
		set_setting('adminxml_plus','primary1', trim((string)$pri->darker));
		set_setting('adminxml_plus','primary2', trim((string)$pri->dark));
		set_setting('adminxml_plus','primary3', trim((string)$pri->middle));
		set_setting('adminxml_plus','primary4', trim((string)$pri->light));
		set_setting('adminxml_plus','primary5', trim((string)$pri->lighter));
		set_setting('adminxml_plus','primary6', trim((string)$pri->lightest));
		set_setting('adminxml_plus','secondary0', trim((string)$sec->darkest));
		set_setting('adminxml_plus','secondary1', trim((string)$sec->lightest));
	} else {
		global $custom_settings;
		foreach ($custom_settings['data']['adminxml_plus']['settings'] as $setting) {
			if (array_key_exists('default', $setting))
				$setting['value'] = $setting['default'];
		}
	}
}

// fallback for GSCS 0.6-, see bottom of this file
function adminxml_plus_sync_default() 
{
	$admin_xml = GSTHEMESPATH . 'admin.xml';
	$dataPath = GSDATAOTHERPATH . 'custom_settings/plugin_data_adminxml_plus.json';
	if (!file_exists($dataPath)) 
		$datafile = json_decode(file_get_contents(GSPLUGINPATH . 'adminxml_plus/settings.json'), TRUE);
	else
		$datafile = json_decode(file_get_contents($dataPath), TRUE);
	$datafile = $datafile;
	if (file_exists($admin_xml)) {
		$admin_xml = getXML($admin_xml);
		$pri = $admin_xml->primary;
		$sec = $admin_xml->secondary;
		$datafile['settings'][1]['value'] = trim((string)$pri->darkest);
		$datafile['settings'][2]['value'] = trim((string)$pri->darker);
		$datafile['settings'][3]['value'] = trim((string)$pri->dark);
		$datafile['settings'][4]['value'] = trim((string)$pri->middle);
		$datafile['settings'][5]['value'] = trim((string)$pri->light);
		$datafile['settings'][6]['value'] = trim((string)$pri->lighter);
		$datafile['settings'][7]['value'] = trim((string)$pri->lightest);
		$datafile['settings'][9]['value'] = trim((string)$sec->darkest);
		$datafile['settings'][10]['value'] = trim((string)$sec->lightest);
	} else {
		foreach ($datafile['settings'] as $setting) {
			if (array_key_exists('default', $setting))
				$setting['value'] = $setting['default'];
		}
	}
	require_once(GSPLUGINPATH . 'custom_settings/filehandler.class.php');
	file_put_contents($dataPath, fileUtils::indentJSON(json_encode($datafile)));
}

// outputted under the GSCS render-bottom hook
function adminxml_plus_frontend()
{ 
	global $SITEURL; ?>
	<style>
		#color-bar-pri div, #color-bar-sec div { width: 0.4px; height: 15px; float: left;	}
		.setting, .ko-list-item { overflow: visible; }
		.setting .setting-field-container { position: relative; }
		.setting * { box-sizing: initial; }
		.wrapper .edit-nav a {  color: #ccc;}
		.edit-nav a:hover, #sidebar .snav li.current a, #sidebar .snav li a:hover, .wrapper .nav li a:hover { color: #fff !important;}
		#admin-xml-export { float: right; }
		#admin-theme-presets div input[type="radio"] { margin-right: 10px;}
		#admin-theme-presets div span { display: inline-block; }
		#admin-theme-presets div span:nth-child(2) { width: 250px; margin-right: 10px;}
		#admin-theme-presets div span:nth-child(n+3) { height: 14px; width: 14px; }
		#cs-render-bottom fieldset { width: 30%; float: right; overflow: auto; border: 1px solid #eee; box-sizing: border-box; padding: 10px; margin-top: 15px;}
		#cs-render-bottom fieldset button { margin-top: 10px; }
		#cs-render-bottom input { margin-bottom: 5px; padding: 2px 4px; -moz-border-radius: 3px; -webkit-border-radius: 3px; -o-border-radius: 3px; border-radius: 3px; border: 1px solid #ddd; outline: none;}
		#cs-render-bottom fieldset legend { font-size: 14px; font-style: italic; }
		#cs-render-bottom fieldset:nth-of-type(1) { width: 68%; float: left;}
		.ko-main input[type="text"].ko-code, .ko-code { display: none; }
	</style>
	<fieldset><legend>Choose an existing theme</legend>
		<div id="admin-theme-presets"></div>
		<button type="button" class="button" id="admin-theme-set">Set selected theme</button>
	</fieldset>
	<fieldset><legend>Export the current theme as admin.xml</legend>
		<label for="themegen-name">Theme name</label>
		<input type="text" id="themegen-name" name="themegen-name">
		<label for="themegen-auth">Author</label>
		<input type="text" id="themegen-auth" name="themegen-auth">
		<label for="themegen-auth-url">Author URL</label>
		<input type="text" id="themegen-auth-url" name="themegen-auth-url">
		<button type="button" class="button" id="admin-xml-export">Export current theme</button>
	</fieldset>
	<div class="clearfix"></div>
	<?php
}

// scripts front-end + GSCS 0.6- fallback for setting sync
if (isset($_GET['id']) && $_GET['id'] === 'custom_settings') {
	if (!defined('GS_CUSTOM_SETTINGS'))
		adminxml_plus_sync_default();
	register_script('adminxml-plus', $SITEURL . 'plugins/adminxml_plus/adminxml-plus.js', '1', TRUE);
	queue_script('adminxml-plus',GSBACK); 
}
