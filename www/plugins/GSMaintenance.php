<?php

# get correct id for plugin
$thisfile = basename(__FILE__, ".php");

# add in this plugin's language file
i18n_merge('GSMaintenance') || i18n_merge('GSMaintenance', 'en_US');

# register plugin
register_plugin(
	$thisfile,
	'GSMaintenance',
	'1.0.6',
	'Frank Ferdinand',
	'',
	i18n_r('GSMaintenance/DESCRIPTION'),
	'index',
	'gsm_init'
);

add_action('index-pretemplate', 'gsm_pre');

function gsm_init() {

	global $SITEURL, $TEMPLATE, $editor_id;	
	// create the directory if it doesn't exist. 
	if (!is_dir(GSDATAOTHERPATH . 'GSMaintenance/')) {
		if (!mkdir(GSDATAOTHERPATH . 'GSMaintenance/')) {
			echo i18n_r('GSMaintenance/ERR_CREATEFOLDER') . ' "' . GSDATAOTHERPATH . 'GSMaintenance/' . '" !';
		}
	}

	$file = GSDATAOTHERPATH . 'GSMaintenance/GSMaintenance.xml';
	$gsm_onoff = '';
	$gsm_msg = '';
	
	//get info from xml
	if (file_exists($file)){
		$data = getXML($file);
		$gsm_onoff = $data->onoff;
		$gsm_msg = $data->message;
	}

	//if enabled place check
	if ($gsm_onoff != '' ) { $gsm_onoff = 'checked'; }
	
	$EDHEIGHT = defined('GSEDITORHEIGHT') ? GSEDITORHEIGHT . 'px' : '300px';
	$EDTOOL = defined('GSEDITORTOOL') ? GSEDITORTOOL : 'advanced'; //'basic';
	$EDLANG = defined('GSEDITORLANG') ? GSEDITORLANG : i18n_r('CKEDITOR_LANG');
	$EDOPTIONS = defined('GSEDITOROPTIONS') && trim(GSEDITOROPTIONS) != '' ? ', ' . GSEDITOROPTIONS : '';

	if ($EDTOOL == 'advanced') 
	{
		$TOOLBAR = "
		['Bold', 'Italic', 'Underline', 'NumberedList', 'BulletedList', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', 'Table', 'TextColor', 'BGColor', 'Link', 'Unlink', 'Image', 'RemoveFormat', 'Source'],
		'/',
		['Styles','Format','Font','FontSize']
		";
	} 
	elseif ($EDTOOL == 'basic') 
	{
		$TOOLBAR = "['Bold', 'Italic', 'Underline', 'NumberedList', 'BulletedList', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', 'Link', 'Unlink', 'Image', 'RemoveFormat', 'Source']";
	} 
	else 
	{
		$TOOLBAR = GSEDITORTOOL;
	}

	?>
	<br /><hr>
	<b>GSMaintenance</b><br /><br />
	<input type="checkbox" name="gsm_onoff" value="1" <?php echo $gsm_onoff ?>> &nbsp;<b><?php echo i18n_r('GSMaintenance/CHECKBOX'); ?></b><br /><br />
	<textarea name="gsm_msg" id="gsm_msg" rows="10" cols="80"><?php echo $gsm_msg ?></textarea>
	
    <script type="text/javascript" src="template/js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
      var editor = CKEDITOR.replace('gsm_msg<?php echo $editor_id; ?>', {
        skin : 'getsimple',
        forcePasteAsPlainText : true,
        language : '<?php echo $EDLANG; ?>',
        defaultLanguage : 'en',
        <?php
        if (file_exists(GSTHEMESPATH . $TEMPLATE . '/editor.css')) {
          $path = suggest_site_path();
          ?>
          contentsCss: '<?php echo $path; ?>theme/<?php echo $TEMPLATE; ?>/editor.css',
          <?php
        }
        ?>
        entities : true,
        uiColor : '#FFFFFF',
        height: '<?php echo $EDHEIGHT; ?>',
        baseHref : '<?php echo $SITEURL; ?>',
        toolbar :
        [
        <?php echo $TOOLBAR; ?>
        ]
        <?php echo $EDOPTIONS; ?>,
        tabSpaces:10,
        filebrowserBrowseUrl : 'filebrowser.php?type=all',
        filebrowserImageBrowseUrl : 'filebrowser.php?type=images',
        filebrowserWindowWidth : '730',
        filebrowserWindowHeight : '500'
      });
    </script>

<?php 
	
}

function gsm_pre(){
	global $USR;
	$file = GSDATAOTHERPATH . 'GSMaintenance/GSMaintenance.xml';
	$maintenancemsg = '';
  	if(file_exists($file)) {
		$data = getXML($file);
		$gsm_onoff = $data->onoff;
		$gsm_msg = $data->message;
		if ($gsm_onoff != '') {
			if (function_exists('get_cookie') && (!isset($USR) || $USR !== get_cookie('GS_ADMIN_USERNAME'))) {
				$protocol = "HTTP/1.0";
				if ( "HTTP/1.1" == $_SERVER["SERVER_PROTOCOL"] ) $protocol = "HTTP/1.1";
				header( "$protocol 503 Service Unavailable", true, 503 );
				header( "Retry-After: 3600" );

				echo '<!DOCTYPE html><html><head>';
				echo '<meta charset="utf-8">';
				echo '<meta name="keywords" content="';	
				get_page_meta_keywords();
				echo '">';
				echo '<title>';	get_site_name(); 
				echo '</title></head>';
				echo '<body><div>' . $gsm_msg . '</div>';
				echo '</body></html>';
				die;
			}
		}
	}	
}

function gsm_save() {
  	$file = GSDATAOTHERPATH . 'GSMaintenance/GSMaintenance.xml';
	$informationfile = GSDATAOTHERPATH . 'GSMaintenance/user.xml';
   	$xml = @new SimpleXMLElement('<maintenance></maintenance>');
   	$xml->addChild('onoff', $_POST['gsm_onoff']);
	if(isset($_POST['gsm_msg']) && $_POST['gsm_msg'] != ''){
		$xml->addChild('message', stripslashes(html_entity_decode($_POST['gsm_msg'], ENT_QUOTES, "utf-8")));
	} else {
		$defaultmsg = 'Site is currently down for maintenance.';
		$xml->addChild('message', $defaultmsg);
	}
   	$xml->asXML($file);
}

add_action('settings-website-extras', 'gsm_init', array());
add_action('settings-website', 'gsm_save', array());
?>