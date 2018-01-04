<!--=============================================
Fin : HEADER.INC.php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

██╗  ██╗███████╗ █████╗ ██████╗
██║  ██║██╔════╝██╔══██╗██╔══██╗
███████║█████╗  ███████║██║  ██║
██╔══██║██╔══╝  ██╔══██║██║  ██║
██║  ██║███████╗██║  ██║██████╔╝
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝
-->
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////// DEBUT : HEADER_A.INC.PHP //////////////////////////////////////////////////////////////////////////////////
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
<head>
        <!--



+---+  +---+  +---+  +---+
|M  |  |E  |  |T  |  |A  |
+---+  +---+  +---+  +---+

-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?php get_page_clean_title(); ?> -
            <?php get_site_name(); ?>
        </title>
        <!--



+---+  +---+  +---+  +---+ +---+  +---+  +---+
|F  |  |A  |  |V  |  |I  | |C  |  |O  |  |N  |
+---+  +---+  +---+  +---+ +---+  +---+  +---+

-->
        <!-- Favicon ============================================== -->
        <link rel="icon" href="<?php get_theme_url(); ?>/images/evolve.ico">
        <link rel="shortcut icon" href="/assets/favicon/favicon.ico" type="image/x-icon" />
        <!-- Mobile Specific ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--
+---+  +---+  +---+
|C  |  |S  |  |S  |
+---+  +---+  +---+
-->
        <!-- CSS ================================================== -->
        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/principal.css">
        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/assets/fonts/ArchivoNarrow/Archivo_Narrow.css">
        <!-- CSS (en ligne) ================================================== -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'>
        <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
        <!-- CSS (Dynamique) ================================================== -->
        <?php if(function_exists('return_theme_setting') && return_theme_setting('color_scheme')) { ?>
            <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/colors/<?php get_theme_setting('color_scheme'); ?>.css" id="colors">
            <?php } else { ?>
            <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/colors/grayblue.css" id="colors">
        <?php } ?>
        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/animate.css">
        <?php if(function_exists('return_theme_setting') && return_theme_setting('viadeo')) { ?>
            <link href="https://file.myfontastic.com/n6vo44Re5QaWo8oCKShBs7/icons.css" rel="stylesheet">
        <?php } ?>
        <!--[if lt IE 9]>





 <!--
+---+  +---+  +---+  +---+ +---+  +---+  +---+
|S  |  |C  |  |R  |  |I  | |P  |  |T  |  |S  |
+---+  +---+  +---+  +---+ +---+  +---+  +---+
-->
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
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php get_theme_setting('map-key')?>&callback=initialize" async defer></script>
            <?php } else { ?>
            <!-- - - - - - - - - - - - - - - - - - - - - - - - -->
            <script src="https://maps.googleapis.com/maps/api/js"></script>
        <?php } ?>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - -->
        <!-- Google Maps Initiation -->
        <script>

function initialize() {

    var latitude = "<?php echo return_theme_setting('map-lat');?>";
	var longitude = "<?php echo return_theme_setting('map-lot');?>";
	var markers = "<?php echo return_theme_setting('map-marker');?>";
	var zooms = "<?php echo return_theme_setting('map-zoom');?>";
	var mapCanvas = document.getElementById('map');
	var myLatLng = new google.maps.LatLng(latitude, longitude);
	var mapOptions = {
		center: myLatLng,
		zoom: Number(zooms),
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.DEFAULT,

		},

		disableDoubleClickZoom: true,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
		},

		scaleControl: true,
		scrollwheel: true,
		streetViewControl: true,
		draggable : true,
		overviewMapControl: true,
		overviewMapControlOptions: {
			opened: true,

		},

	}

	var map = new google.maps.Map(mapCanvas, mapOptions)
	var marker = new google.maps.Marker({

		position: myLatLng,
		map: map,
		title: markers

	});
	marker.setMap(map);

}

<?php if(function_exists('return_theme_setting') && !return_theme_setting('map-key')) { ?>
google.maps.event.addDomListener(window, 'load', initialize);

<?php } ?>
</script>
        <!-- - - - - - - - - - - - - - - - - - - - - - - - -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
        <script src="js/index.js"></script>
    <?php } ?>
    <!-- - - - - - - - - - - - - - - - - - - - - - - - -->
    <?php get_header(); ?>
    <!-- - - - - - - - - - - - - - - - - - - - - - - - -->
    <!-- Google Analytics -->
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-90569075-1', 'auto');
  ga('send', 'pageview');
</script>
    </head>
    <!--=============================================
Fin : HEADER.INC.php
/////////////////////////////////////////////////
██████╗  ██████╗ ██████╗ ██╗   ██╗
██╔══██╗██╔═══██╗██╔══██╗╚██╗ ██╔╝
██████╔╝██║   ██║██║  ██║ ╚████╔╝
██╔══██╗██║   ██║██║  ██║  ╚██╔╝
██████╔╝╚██████╔╝██████╔╝   ██║
╚═════╝  ╚═════╝ ╚═════╝    ╚═╝
============================================= -->
    <!--//////// NAVIGATION ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <body id="<?php get_page_slug(); ?>">
        <div class="container" data-pg-name="HEADER" data-pg-collapsed>
            <div class="row" data-pg-collapsed>
                <!-- ------------------------------------------------------------------------------------------------- -->
                <!-- ----Début : Logo -------------------------------------------------------------------------------- -->
                <div class="navbar-header col-md-1 pg-empty-placeholder" data-pg-name="LOGO" data-pg-collapsed>
                    <div id="logo">
                        <h1><a href="index.html"> 
                                <img src="<?php get_theme_url(); ?>/images/gif00.gif" alt="Logo" /> 
                            </a></h1> 
                    </div>
                </div>
                <!-- ------------------------------------------------------------------------------Fin : Logo------ -->
                <!-- ----Début : Hashtag -------------------------------------------------------------------------------- -->
                <div class="col-md-2" data-pg-name="HASHTAG" data-pg-collapsed>
                    <p class=".header_nom-du-site" data-pg-collapsed><?php get_site_name(); ?></p>
                    <p class="header_statut">[Artiste-chercheur].</p>
                    <div id="site-name" data-pg-collapsed>
                        <?php if(function_exists( 'return_theme_setting') && return_theme_setting( 'site_slogan')) { ?>
                            <p><a href="<?php get_site_url(); ?>"><?php get_theme_setting( 'site_slogan'); ?></a></p>
                        <?php } ?>
                    </div>
                </div>
                <!-- ------------------------------------------------------------------------------Fin Hashtag------ -->
                <!-- ----Début : Navigation -------------------------------------------------------------------------------- -->
                <div class="col-md-8 col-md-offset-1 header_navigation" data-pg-name="NAVIGATION" data-pg-collapsed>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item active">
                            <?php get_navigation(return_page_slug()); ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 header_ariane" title="ARIANE" data-pg-name="ARIANE" data-pg-collapsed>
                    <hr class="hr_titre" />
                <div class="container" data-pg-collapsed>
                        <?php if (function_exists( 'get_i18n_breadcrumbs')) { if(return_page_slug()!='index' ) { $to_home=return_i18n_menu_data( 'index'); ?>
                            <div class="seven columns" data-pg-hidden>
                                <nav id="breadcrumbs">
                                    <a href="<?php echo find_url('index',null); ?>"><?php echo $to_home[0][ 'menu']. '&nbsp;&nbsp;'; ?></a>
                                    <?php get_i18n_breadcrumbs(return_page_slug()); ?>
                                </nav>
                            </div>
                        <?php }} else { ?>
                        <div class="breadcrumbs" data-pg-hidden data-pg-collapsed>
                            <nav id="breadcrumbs" data-pg-hidden>
                                <?php get_parent_link( 'index'); ?>
                                <?php (get_parent(FALSE) !='index' ) ? get_parent_link(get_parent(FALSE)) : '' ?>
                                <b data-pg-hidden><?php get_page_clean_title(); ?></b> 
                            </nav>
                        </div>
                    <?php } ?>
                    </div>
                    <hr class="hr_titre" />
                </div>
                <!-- ------------------------------------------------------------------------------Fin : Logo------ -->
            </div>
        </div>
        <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////// FIN : HEADER_A.INC.PHP ////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
