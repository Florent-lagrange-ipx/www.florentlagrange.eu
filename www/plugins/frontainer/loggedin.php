<?php

function build_user_area(& $manager)
{
	global $fronainer_file;
	$fr = $fronainer_file;

	$tplEngine = $manager->getTemplateEngine(GSPLUGINPATH.'/frontainer/tpl/');
	$tplEngine->init();

	$output = '';

	// something gone wrong or user has no access, redirect to the login page
	if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
	{
		session_destroy();
		$_SESSION = array();
		if (!headers_sent())
		{
			// set a flash and redirect to the login page
			header('Status: 200');
			header('Location: ' . htmlspecialchars($manager->getSiteUrl().'/login/'));
			exit();
		} else
		{
			// throw an error message
			exit();
		}
	}

	// get Users category
	$catClass = $manager->getCategoryClass();
	$category = $catClass->getCategory('name=Users');
	if(!$category) {die('!');}

	// try to get user by id
	$itemClass = $manager->getItemClass();
	$itemClass->init($category->get('id'));
	$user = $itemClass->getItem((int)$_SESSION['userid']);
	if(!$user) {die('!');}

	// render user's personal area
	$tplsuser = $tplEngine->getTemplates('user');
	$tpl_loggedin_area = $tplEngine->getTemplate('loggedin_area', $tplsuser);

	// Set welkomme language messages
	MsgReporter::setClause('welcome_header', array(
			'user_name' => $user->name), false, $fr
	);

	return $tplEngine->render($tpl_loggedin_area, array(
			'lang_welcome_header' => MsgReporter::buildMsg()
		)
	);
}


?>