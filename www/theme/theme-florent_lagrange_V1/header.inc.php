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
    ██╗  ██╗███████╗ █████╗ ██████╗
    ██║  ██║██╔════╝██╔══██╗██╔══██╗
    ███████║█████╗  ███████║██║  ██║
    ██╔══██║██╔══╝  ██╔══██║██║  ██║
    ██║  ██║███████╗██║  ██║██████╔╝
    ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝
-->
<head>
        <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        META
        ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        TITRE
        ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <title> 
            <?php get_page_clean_title(); ?> - 
            <?php get_site_name(); ?> 
        </title>
        <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        FAVICON
        ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <link rel="icon" href="<?php get_theme_url(); ?>/images/evolve.ico">
        <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon" />
        <!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        CSS
        ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
        <link href="http://www.florentlagrange.eu/theme/thematic/assets/bouton/css/bouton.css" rel="stylesheet" type="text/css">
        <!-- CSS (Cdn) ================================================== -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
        <!-- CSS (Font) ================================================== -->
        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/assets/fonts/ArchivoNarrow/Archivo_Narrow.css">
        <!-- +-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+
SCRIPT
        +-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+ -->
        <script src="../../../html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - -->
        <![endif]-->
        <?php if (function_exists('return_theme_setting')) {

	if(return_theme_setting('jquery')==1 && return_theme_setting('jquery_header')==1) { ?>
            <script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js"></script>
        <?php } } ?>
        <?php	if(function_exists('return_theme_setting') && return_theme_setting('gmaps')==1 && return_page_slug()=='contact') {


	if(return_theme_setting('map-key')) { ?>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - -->
        <?php } ?>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - -->
        <!-- - - - - - - - - - - - - - - - - - - - - - - - -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
        <script src="js/index.js"></script>
        <!-- +-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+
HEADER
+-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+ -->
    <?php } ?>
    <?php get_header(); ?>
    <!-- +-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+
/ HEADER
+-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-++-+-+-+-+ -->
    <div class="container" data-pg-name="HEADER">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="ID" data-pg-collapsed>
                <center>
                    <h1 data-pg-name="LOGO" class="logo"><img src="http://www.florentlagrange.eu/theme/thematic/images/logo_01.png" alt="Logo" class="logo" /></h1>
                </center>
                <center>
                    <h1 class="florent_lagrange" data-pg-name="TITRE_SITE"><?php get_site_name(); ?></h1>
                </center>
            </div>
            <div data-pg-name="NAVIGATION" class="col-md-8 col-md-offset-2 col-sm-8 col-xs-8 col-xs-offset-2 col-sm-offset-2 col-lg-8 col-lg-offset-2" data-pg-collapsed>
                <ol class="nav nav-tabs lead pull-left">
                    <li class="nav-item active">
                        <?php get_navigation(return_page_slug()); ?>
                    </li>
                </ol>
            </div>
            <div data-pg-name="NAVIGATION" class="col-md-12 col-sm-12 col-xs-12 col-lg-12 text-center">
                <div class="menu">
</div>
            </center>
        <div class="col-md-12 ariane" data-pg-name="ARIANE" data-pg-collapsed>
                <hr class="hr_titre" />
                <?php if (function_exists( 'get_i18n_breadcrumbs')) { if(return_page_slug()!='index' ) { $to_home=return_i18n_menu_data( 'index'); ?>
                    <div class="seven columns">
                        <nav id="breadcrumbs">
                            <a href="<?php echo find_url('index',null); ?>"><?php echo $to_home[0][ 'menu']. '&nbsp;&nbsp;'; ?></a>
                            <?php get_i18n_breadcrumbs(return_page_slug()); ?>
                        </nav>
                    </div>
                <?php }} else { ?>
                <div class="breadcrumbs">
                    <nav id="breadcrumbs">
                        <?php get_parent_link( 'index'); ?>
                        <?php (get_parent(FALSE) !='index' ) ? get_parent_link(get_parent(FALSE)) : '' ?>
                        <b><?php get_page_clean_title(); ?></b>
                    </nav>
                </div>
            <?php } ?>
            <hr class="hr_titre" />
            </div>
            <!-- ------------------------------------------------------------------------------Fin : Logo------ -->
        </div>
    </div>
    <link href="http://www.florentlagrange.eu/theme/thematic/css/principal.css" rel="stylesheet" type="text/css">
    <link href="http://www.florentlagrange.eu/theme/thematic/css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>
    <!-- /////////////////////////////////////////////////
██████╗  ██████╗ ██████╗ ██╗   ██╗
██╔══██╗██╔═══██╗██╔══██╗╚██╗ ██╔╝
██████╔╝██║   ██║██║  ██║ ╚████╔╝
██╔══██╗██║   ██║██║  ██║  ╚██╔╝
██████╔╝╚██████╔╝██████╔╝   ██║
╚═════╝  ╚═════╝ ╚═════╝    ╚═╝
============================================= -->
    <!--//////// NAVIGATION ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <body id="<?php get_page_slug(); ?>" data-pg-collapsed>
        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Fin : header.inc.php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
>
