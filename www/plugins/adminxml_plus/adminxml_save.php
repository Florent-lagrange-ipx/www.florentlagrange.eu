<?php 

	function admin_themer_update($data) 
	{
		$admin_xml = '../../theme/admin.xml';
		file_put_contents($admin_xml, $data);
		delete_cache();
		
	}
	function delete_cache() { 
		$cachepath = '../../data/cache/stylesheet.txt';
		if (file_exists($cachepath))
			unlink($cachepath);
	} 
	
	if (isset($_POST['admin_theme_data'])) {
		admin_themer_update($_POST['admin_theme_data']);
		die();
	}
