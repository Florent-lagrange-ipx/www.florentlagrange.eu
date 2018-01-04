<?php
/****************************************************
 *
 * @File: 	compatibility.php
 * @Package:	MLD Newsletter
 * @Subject:	Functions for backwards compatibility GS3.0
 * @Date:	4 February 2012
 * @Revision:	4 February 2012
 * @Version:	0.3
 * @Status:	Beta
 * @Author:	Leen Moerland (www.leenmoerland.com)
 *
*****************************************************/


/**
 * Create Navigation Tab
 *
 * This adds a top level tab to the control panel
 *
 * @param string $id Id of current page
 * @param string $txt Text to add to tabbed link
 * @param string $klass class to add to a element
 * @author GetSimple 3.1B
 */
function createNavTabBC($tabname, $id, $txt, $action=null) {
  global $plugin_info;
  $current = false;
  if (basename($_SERVER['PHP_SELF']) == 'load.php') {
    $plugin_id = @$_GET['id'];
    if ($plugin_info[$plugin_id]['page_type'] == $tabname) $current = true;
  }
  echo '<li id="nav_'.$id.'"><a href="load.php?id='.$id.($action ? '&amp;'.$action : '').'" '.($current ? 'class="current"' : '').' >'.$txt.'</a></li>';
}

/**
 * Create Side Menu
 *
 * This adds a side level link to a control panel's section
 *
 * @param string $id ID of the link you are adding
 * @param string $txt Text to add to tabbed link
 * @author GetSimple 3.1B
 */
function createSideMenuBC($id, $txt, $action=null, $always=true){
  $current = false;
  if (isset($_GET['id']) && $_GET['id'] == $id && (!$action || isset($_GET[$action]))) {
    $current = true;
  }
  if ($always || $current) {
    echo '<li id="sb_'.$id.'"><a href="load.php?id='.$id.($action ? '&amp;'.$action : '').'" '.($current ? 'class="current"' : '').' >'.$txt.'</a></li>';
  }
}

/**
 * Add css file to header
 *
 * @param string $cssfile url to css file
 * @author Leen Moerland
 */
function addStyleBC($cssfile) {
	$css = "<style type='text/css'>  /*MLD NEWSLETTER CSS STYLESHEET*/ \r\n";
	$css.= file_get_contents($cssfile);
	$css.= "</style>";
	echo $css;
}
?>