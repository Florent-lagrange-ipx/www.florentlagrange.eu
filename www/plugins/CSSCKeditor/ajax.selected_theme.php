<?php


	$url = $_GET['url'];
	$getSimplePath = $_GET['site'];

	//echo "HELLO:$url == getSimplePath:$getSimplePath\n";

	$pathTheme = $getSimplePath . 'theme/' . $url;

	//echo "pathTheme:$pathTheme\n\n\n";

	$files = scandir($pathTheme);

	$outFile = array();

	foreach ($files as $f) {
		$outFile[] = $f;
	}

	echo json_encode($outFile);

?>