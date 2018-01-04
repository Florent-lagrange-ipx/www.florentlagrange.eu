<?php
/*
Plugin Name: CSS CKeditor
Description: Select a CSS file for the editor
Version: 0.5
Author: Sergio Guastaferro
Author URI: https://www.linkedin.com/in/sergio-guastaferro-5826a171
*/


# get correct id for plugin
$thisfile=basename(__FILE__, ".php");

# register plugin
register_plugin(
	$thisfile, 
	'CSS CKeditor', 	
	'0.5', 		
	'Sergio Guastaferro',
	'https://www.linkedin.com/in/sergio-guastaferro-5826a171', 
	'Select a CSS file for the editor',
	'settings',
	'main'  
);


//add manager in setting page
add_action('settings-sidebar', 'createSideMenu', array($thisfile,'Select CSS Editor') );

//do logic to append CSS in editor CKEditor
add_action('html-editor-init', 'html_main', array() );


//-------------------------------- functions ----------------------------

function init_plugin(){
	if( file_exists ( GSDATAOTHERPATH . 'CSSCKedito-conf.urls' ) )
		return;
	$db = fopen(GSDATAOTHERPATH . 'CSSCKedito-conf.urls', 'w');
	fclose($db);
}

function reset_settings(){
	$db = fopen(GSDATAOTHERPATH . 'CSSCKedito-conf.urls', 'w');
	fwrite($db, "");
	fclose($db);
}

function load_settings(){

	$db = fopen(GSDATAOTHERPATH . 'CSSCKedito-conf.urls', 'r');
	$out = array();

	while( ($line = fgets($db)) != NULL ){
			$out[] = $line;
	}

	fclose($db);

	return $out;

}

function save_settings($cssList){

	$db = fopen(GSDATAOTHERPATH . 'CSSCKedito-conf.urls', 'w');

	for ($i=0; $i < count($cssList) - 1 ; $i++) { 
		fwrite($db, "\r\n".$cssList[$i] );
	}
	fwrite($db, $cssList[$i] );

	fclose($db);

}

function append_settings($theme, $file){

	//$newCssList = load_settings();
	//$urlThemes = str_replace($_SERVER["DOCUMENT_ROOT"], "", GSTHEMESPATH);
	//$newCssList[] = $urlThemes . $theme . '/' . $file;

	$db_path = GSDATAOTHERPATH . 'CSSCKedito-conf.urls';
	$db = fopen($db_path, 'a');

	$urlThemes = str_replace($_SERVER["DOCUMENT_ROOT"], "", GSTHEMESPATH);
	$line = $urlThemes . $theme . '/' . $file;

	if( 0 != filesize( $db_path ) )
		$line = "\r\n" . $line;

	fwrite($db, $line);

}


function make_panel(){

	echo '<h3>Select Css Editor</h3>';
	//echo '<p> GSDATAOTHERPATH : '. GSDATAOTHERPATH .'</p>';
	//echo '<p> GSTHEMESPATH : '. GSTHEMESPATH .'</p>';
	//echo '<p> GSPLUGINPATH  : '. GSPLUGINPATH .'</p>';
	//echo '<p> $_SERVER["DOCUMENT_ROOT"] : ' . $_SERVER["DOCUMENT_ROOT"] . '</p>';
	//echo '<p> $_GET[] : '  . print_r($_GET,true)  . '</p>';
	//echo '<p> $_POST[] : ' . print_r($_POST,true)  . '</p>';

	$urlPlugin = str_replace($_SERVER["DOCUMENT_ROOT"], "", GSPLUGINPATH);
	$urlPlugin .= basename(__FILE__, ".php");
	//echo '<p> urlPlugin : ' . $urlPlugin . '</p>';

	//ajax calling to get css in the theme selected;
	echo '<script>function getCss(select){ 
					//alert("AJAX!!");
					$(".files-theme").empty()
					$.get("'. $urlPlugin .'/ajax.selected_theme.php?site='. GSROOTPATH .'&url="+select.value, 
							function(data){
								console.log("data:"+data);
								data = JSON.parse(data);
								for( i = 0; i < data.length; i++ ){
									$(".files-theme").append("<option>"+data[i]+"</option>");
								}
							});  
					
					};
		  </script>';






	echo '<div class="leftsec" >';
		echo '<label>Current settings : </label>';
		echo '<ul>';
		$urls = load_settings();
		foreach ($urls as $u) {
			echo '<li>' . $u . '</li>';
		}
		echo '</ul>';
	echo '</div>';
	echo '<div class="rightsec" >';
		echo '<form action="load.php?id='. basename(__FILE__, ".php") .'" method="post" >';
		echo '<input type="hidden" name="reset" value="yes"/>';
		echo '<input class="submit" type="submit" value="Clear" />';
		echo '</form>';
	echo '</div>';


	echo '<div class="clear"></div>';

	echo '<p>Select a theme and the css to use in the editor of page </p>';
	echo '<form action="load.php?id='. basename(__FILE__, ".php") .'" method="post" >';

		echo '<div class="leftsec" >';
		echo '<p><label>Themes avaibles</label> <select style="width: 90%;" name="theme" onchange="getCss(this)" >';
		$themes = scandir(GSTHEMESPATH);
		foreach ($themes as $th) {
			echo '<option>' . $th . '</option>';
		}
		echo '</select> </p></div>';

		echo '<div class="rightsec" >';
		echo '<p><label>Files avaibles</label> <select style="width: 90%;" name="cssfile" class="files-theme"></select> </p></div>';

		echo '<input class="submit" type="submit" value="Append CSS" />';

	echo '</form>';



}


/*--------------------------------------------------------*/

/* Admin gui */
function main() {

	//launch the init of plugin ( exists the config?? )
	init_plugin();

	if( isset($_POST['reset']) && $_POST['reset'] == 'yes' ){
		reset_settings();
	}

	if( isset($_POST['theme']) && isset($_POST['cssfile']) ){
		append_settings($_POST['theme'], $_POST['cssfile']);
	}

	//draw the panel of the plugin
	make_panel();


}



/*--------------------------------------------------------*/

/* HTML editor gui */

function html_main(){

	$cssList = load_settings();
	$params = implode(",", $cssList);

	$s = '<script class="MIO" >';
		$s .= 'CKEDITOR.config.contentsCss = "' . $params .'";';  
	$s .= '</script>';

	echo $s;
}

?>