<!--

	+---------------------------------------------------------------------------+
	|																			|
	|	* [Document] :      	template_DEFAUT_page_STANDARD.php 				|
	|																			|
	|	* [Auteur]:   			Florent Lagrange  								|
	|																			|
	|	* [Date]:    			<1983-2018>								        |
	|																			|
	|	* [Contact]:    		contact[at]florentlagrange[dot]eu 				|
	|																			|
	|	* [CCC]:    			CC - BY - 18									|
	|   									         							|
	|   * Site basé sur <getSimple>												|
	|																			|
	|	* Attribution-NonCommercial-NoDerivs 									|
	|																			|
	|	* Conception et dévellopement réalisé par Florent Lagrange 				|
	+---------------------------------------------------------------------------+

 --> 
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Début : header.inc.php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
--> 
<?php

ob_start();

if(!defined('IN_GS')){ die('you cannot load this page directly.'); }


check_language();
$admin_mail = simple_c_default_email();

check_data_theme();

?> 
<!DOCTYPE html> 
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]--> 
<!--[if (gte IE 9)|!(IE)]><!--> 
<html lang="en"> 
    <!--<![endif]-->     
    <!--
███╗   ███╗███████╗████████╗ █████╗ 
████╗ ████║██╔════╝╚══██╔══╝██╔══██╗
██╔████╔██║█████╗     ██║   ███████║
██║╚██╔╝██║██╔══╝     ██║   ██╔══██║
██║ ╚═╝ ██║███████╗   ██║   ██║  ██║
╚═╝     ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝
-->     
<head> 
        <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        META
        ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->         
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
        <!--

██

 -->         
        <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        TITRE
        ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->         
        <!--

██

 -->         
        <title> 
            <?php get_page_clean_title(); ?> - 
            <?php get_site_name(); ?> 
        </title>         
        <!--

██

 -->         
        <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        FAVICON
        ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->         
        <link rel="icon" href="<?php get_theme_url(); ?>/assets/favicon/favicon.ico"> 
        <link rel="shortcut icon" href="<?php get_theme_url(); ?>/assets/favicon/favicon.ico" type="image/x-icon" /> 
        <!--

██

 -->         
        <!-- +-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+
		CSS
        +-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+ -->         
        <!-- CSS (style) ================================================== -->         
        <link href="<?php get_theme_url(); ?>/assets/bouton/css/bouton.css" rel="stylesheet" type="text/css"> 
        <link href="<?php get_theme_url(); ?>/css/principal.css" rel="stylesheet" type="text/css"> 
        <link href="<?php get_theme_url(); ?>/css/bootstrap.css" rel="stylesheet" type="text/css"> 
        <link href="<?php get_theme_url(); ?>/assets/menu-texte/css/style.css"> 
        <link href="<?php get_theme_url(); ?>/js/index.js" ''>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
        <!-- CSS (Cdn) ================================================== -->         
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'> 
        <!-- CSS (Font) ================================================== -->         
        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/assets/fonts/PT/PT-Serif.css"> 
        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/assets/fonts/ArchivoNarrow/Archivo_Narrow.css"> 
        <link rel="stylesheet" href="<?php get_theme_url(); ?>/assets/menu-texte/css/style.css">
        <!-- +-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+
		SCRIPT
        +-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+ -->         
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>         
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>         
        <?php if (function_exists('return_theme_setting')) {

		if(return_theme_setting('jquery')==1 && return_theme_setting('jquery_header')==1) { ?> 
            <script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js"></script>             
        <?php } } ?> 
        <?php	if(function_exists('return_theme_setting') && return_theme_setting('gmaps')==1 && return_page_slug()=='contact') {
		if(return_theme_setting('map-key')) { ?> 
            <!-- - - - - - - - - - - - - - - - - - - - - - - - -->             
        <?php } ?> 
        <!-- +-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+
		HEADER
		+-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+ -->         
    <?php } ?> 
    <?php get_header(); ?> 
    <?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }?> 
    <!--
| +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ 
| |H  | | |E  | | |A  | | |D  | | |E  | | |R  | | |.  | | |I  | | |N  | | |C  | | |.  | | |P  | | |H  | | |P  | 
| +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ 
 -->     
    <?php include('header_standard.inc.php'); ?> 
    <!--
| +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ 
| |M  | | |A  | | |I  | | |N  | | |.  | | |I  | | |N  | | |C  | | |.  | | |P  | | |H  | | |P  | 
| +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ 
 -->     
    <?php include('main_standard.inc.php'); ?> 
    <!----------------------------------------------


<!--
| +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ 
| |F  | | |O  | | |O  | | |T  | | |E  | | |R  | | |.  | | |I  | | |N  | | |C  | | |.  | | |P  | | |H  | | |P  | 
| +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ | +---+ 
 -->     
    <?php include('footer.inc.php'); ?>
