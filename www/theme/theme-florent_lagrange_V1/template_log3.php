<!doctype html> 
<html lang="en" class="background texte_principal consolas" data-pgc-set-master> 
    <head content="IPX, Internet eXchange Point, Ecole, Edition, Logiciel, Plateforme, Echange, Partage, Numérique, Art, Lyon, Rhone-Alpes " data-pg-name="HEAD" class="pg-empty-placeholder"> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="description" content="Florent Lagrange, Sofware Studies, Digital Humanities, Toplogie,, Internet eXchange Point, Ecole, Edition, Logiciel, Plateforme, Echange, Partage, Numérique, Art, Lyon, Rhone-Alpes "> 
        <meta name="keywords" content="Florent Lagrange, Sofware Studies, Digital Humanities, Toplogie,, Internet eXchange Point, Ecole, Edition, Logiciel, Plateforme, Echange, Partage, Numérique, Art, Lyon, Rhone-Alpes "> 
        <meta name="author" content="Florent Lagrange"> 
        <title>Page Modèle - Florent Lagrange</title>         
        <!-- Bootstrap core CSS -->         
        <!-- Custom styles for this template -->         
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->         
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->         
        <link rel="shortcut icon" href="../../assets/favicon/favicon.ico" type="image/x-icon" /> 
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="assets/fonts/ArchivoNarrow/Archivo_Narrow.css" rel="stylesheet" type="text/css">
        <link href="css/principal.css" rel="stylesheet" type="text/css">
    </head>
    <head content="IPX, Internet eXchange Point, Ecole, Edition, Logiciel, Plateforme, Echange, Partage, Numérique, Art, Lyon, Rhone-Alpes " data-pg-name="HEAD" class="pg-empty-placeholder"> 
        <meta charset="utf-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="description" content="Florent Lagrange, Sofware Studies, Digital Humanities, Toplogie,, Internet eXchange Point, Ecole, Edition, Logiciel, Plateforme, Echange, Partage, Numérique, Art, Lyon, Rhone-Alpes "> 
        <meta name="keywords" content="Florent Lagrange, Sofware Studies, Digital Humanities, Toplogie,, Internet eXchange Point, Ecole, Edition, Logiciel, Plateforme, Echange, Partage, Numérique, Art, Lyon, Rhone-Alpes "> 
        <meta name="author" content="Florent Lagrange"> 
        <title>Page Modèle - Florent Lagrange</title>         
        <!-- Bootstrap core CSS -->         
        <!-- Custom styles for this template -->         
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->         
        <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->         
        <link rel="shortcut icon" href="../../assets/favicon/favicon.ico" type="image/x-icon" /> 
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="assets/fonts/ArchivoNarrow/Archivo_Narrow.css" rel="stylesheet" type="text/css">
        <link href="css/principal.css" rel="stylesheet" type="text/css">
    </head>
    <body id="<?php get_page_slug(); ?>" data-pg-name="BODY">
            <div class="container pg-empty-placeholder" data-pg-name="HEADER.INC.PHP" data-pg-collapsed>
            <?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
	/****************************************************
		*
		* @File:      template.php
		* @Package:   GetSimple
		* @Action:    GS Evolve for GetSimple CMS
		*
	*****************************************************/
?> 
                <?php
ob_start();
if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      header.inc.php
* @Package:   GetSimple
* @Action:    GS Evolve for GetSimple CMS
*
*****************************************************/
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
                        <!-- Basic Page Needs
================================================== -->                         
                        <meta charset="utf-8"> 
                        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
                        <title> 
                            <?php get_page_clean_title(); ?> -
                            <?php get_site_name(); ?> 
                        </title>                         
                        <!-- Favicon
    ============================================== -->                         
                        <link rel="icon" href="<?php get_theme_url(); ?>/images/evolve.ico"> 
                        <!-- Mobile Specific
================================================== -->                         
                        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
                        <!-- CSS
================================================== -->                         
                        <link rel="stylesheet" type="text/css" href="<?php get_theme_url(); ?>/css/style.css"> 
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
	<script src="../../../html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->                         
                        <?php if (function_exists('return_theme_setting')) {
	if(return_theme_setting('jquery')==1 && return_theme_setting('jquery_header')==1) { ?> 
                            <script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js"></script>                             
                        <?php } } ?> 
                        <?php	if(function_exists('return_theme_setting') && return_theme_setting('gmaps')==1 && return_page_slug()=='contact') {
	if(return_theme_setting('map-key')) { ?> 
                            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php get_theme_setting('map-key')?>&callback=initialize" async defer></script>                             
                            <?php } else { ?> 
                            <script src="https://maps.googleapis.com/maps/api/js"></script>                             
                        <?php } ?> 
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
                    <?php } ?> 
                    <?php get_header(); ?>
        </div>
        <div class="container" data-pg-name="HEADER">
            <div class="container pg-empty-placeholder"></div>
            <!--//////// NAVIGATION ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->             
            <div class="row" data-pg-name="NAVIGATION" data-pg-collapsed>
                <!--//////// LOGO //////// -->
                <div class="navbar-header col-md-1 pg-empty-placeholder" data-pg-collapsed data-pg-name="LOGO">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 
                        <span class="icon-bar"></span> 
                    </button>
                    <img src="../../images/gabarit/gif00.gif" width="45px" class="logo" />
                </div>
                <!-- ------------------------------------------------------------------------------------------------- -->
                <!--//////// HASHTAG ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <div class="col-md-2" data-pg-name="HASHTAG" data-pg-collapsed> 
                    <h1 class="florent_lagrange"><?php get_site_name(); ?></h1>
                    <p>[Artiste-chercheur]. </p> 
                    <p style="font-size:x-small" class="hashtag couleur_01 couleur_A couelur_B">  # Critical_Code_Studie  # Art  # Code  # Humanities  # Art  # Code  # Humanities </p>
                </div>
                <!-- ------------------------------------------------------------------------------------------------- -->
                <!--//////// NAVIGATION ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <div class="col-md-8 col-md-offset-1" data-pg-name="NAVIGATION">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item active">
                            <?php get_navigation(return_page_slug()); ?> 
                        </li>
                    </ul>                     
                </div>
                <div class="col-md-12 hr_fil_bas" title="ARIANE" data-pg-name="ARIANE"> 
                    <hr class="hr_titre" />
                <div class="container"> 
                        <?php if (function_exists('get_i18n_breadcrumbs')) { 
				if(return_page_slug()!='index') { 
				$to_home=return_i18n_menu_data('index'); ?> 
                            <div class="seven columns" data-pg-collapsed> 
                                <nav id="breadcrumbs"> 
                                    <a href="<?php echo find_url('index',null); ?>"><?php echo $to_home[0]['menu'].'&nbsp;&nbsp;'; ?></a> 
                                    <?php get_i18n_breadcrumbs(return_page_slug()); ?> 
                                </nav>                                 
                            </div>                             
                        <?php }}
				else { ?> 
                        <div class="breadcrumbs" data-pg-collapsed> 
                            <nav id="breadcrumbs"> 
                                <?php get_parent_link('index'); ?> 
                                <?php (get_parent(FALSE) != 'index') ? get_parent_link(get_parent(FALSE)) : '' ?> 
                                <b><?php get_page_clean_title(); ?></b> 
                            </nav>                             
                        </div>                         
                    <?php } ?> 
                    </div>
                    <hr class="hr_titre" /> 
                </div>
                <!-- ------------------------------------------------------------------------------------------------- -->
            </div>             
        </div>
        <div class="container" data-pg-name="MAIN" data-pg-collapsed> 
            <div class="row" data-pg-name="CONTENT"> 
                <div class="col-md-3" data-pg-name="SIDEBAR" data-pg-collapsed> 
                    <?php get_component('sidebar');	?>
                    <div class="row" data-pg-name="SIDEBAR_TREE" data-pg-collapsed data-pgc="SIDEBAR_TREE"> 
                        <div data-pg-name="[INDEX]" data-pg-collapsed class="col-md-12"> 
                            <p class="Modele_P000">[Index]</p> 
                        </div>                         
                        <div class="col-md-12" data-pg-collapsed="" title="///////////" data-pg-name="///////////"> 
                            <hr> 
                        </div>                         
                        <div data-pg-collapsed class="col-md-10 col-md-offset-1" title="ARTICLE" data-pg-name="ARTICLE"> 
                            <p class="sidebar_01 sidebar_p000">1. Table des matières</p> 
                            <p class="sidebar_01 sidebar_p000">2. Galerie</p> 
                            <p class="sidebar_01 sidebar_p000">3. Références</p> 
                        </div>                         
                        <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed> 
                            <hr> 
                        </div>                         
                    </div>                     
                </div>                 
                <div class="col-md-9" data-pg-name="MAIN"> 
                    <div class="row" data-pg-name="TITRE"> 
                        <div title="TITRE" data-pg-name="TITRE" class="col-md-7"> 
                            <p class="Modele_P000"><?php get_page_title(); ?></p>
                            <p class="tag_titre"><?php get_page_meta_keywords(); ?></p> 
                        </div>                         
                    </div>                     
                    <div class="row" title="RESUME" data-pg-name="RESUME"> 
                        <div data-pg-name="CARTEL" class="col-md-12 cartel" data-pg-collapsed> 
                            <br> 
                            <div class="nine columns" data-animated="fadeInUp" data-pg-collapsed> 
                                <?php if(function_exists('return_theme_setting') && return_theme_setting('title_desc')) {
				if(get_page_meta_desc(false)) { ?> 
                                    <p><?php get_page_meta_desc(true) ?></p> 
                                <?php } } ?> 
                            </div>                             
                        </div>
                        <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed> 
                            <hr> 
                        </div>                         
                    </div>                     
                    <div class="row" data-pg-name="ARTICLE">
                        <div class="col-md-12"> 
                            <p class="texte_principal modele_resume"> <?php get_page_content(); ?> </p> 
                        </div>                         
                        <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pgc-lock data-pg-collapsed> 
                            <hr> 
                        </div>
                    </div>                     
                </div>                 
            </div>
                <div id="footer" <div class="container" data-pgc="FOOTER" data-pgc-field="FOOTER" data-pg-collapsed>
                <div class="row" title="FOOTER" data-pg-name="FOOTER" data-pg-collapsed> 
                    <hr class="hr_footer" data-pg-name="////////////" /> 
                    <div class="col-md-3 col-sm-6 col-xs-12 footer_colonne_01" title="Footer_colonne_01" data-pg-name="Footer_colonne_01"> 
                        <div> 
                            <i class="fa fa-creative-commons footer_fa"></i> 
                            <p class="footer_p">Année de création 1983 - <?php echo date('Y'); ?></p>
                            <p class="footer_p">Créé par <?php get_site_name(); ?></p> 
                            <hr> 
                            <img src="images/block/footer/creative_common_logo.png" width="75"> 
                            <br> 
                            <p><a href="https://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank" class="footer_p"> CC-BY-NC-ND-4.0</a><br></p> 
                            <p class="footer_colonne_01_attribution">Attribution-NonCommercial-NoDerivs&nbsp;</p>
                        </div>
                        <p class="footer_p"> Theme réalisé par <?php get_site_name(); ?></p> 
                    </div>                     
                    <div class="col-sm-6 col-xs-12 footer_colonne_01 col-md-3" data-pg-collapsed title="Footer_colonne_02" data-pg-name="Footer_colonne_02"> 
                        <i class="fa fa-envelope-o footer_fa"></i> 
                        <div class="feature-box" data-pg-collapsed> 
                            <p class="footer_p">Région Auvergne-Rhône-Alpes,</p> 
                            <p class="footer_p"> Paris, France. </p> 
                            <hr> 
                            <p class="footer_p">EMAIL</p> 
                            <p class="footer_p"><a href="mailto:#">contact@florentlagrange.eu</a> </p> 
                        </div>                         
                    </div>                     
                    <div class="col-sm-6 col-xs-12 footer_colonne_01 col-md-3" data-pg-name="Footer_colonne_03" data-pg-collapsed> 
                        <div data-pg-collapsed> 
                            <div class="col-md-4" data-pg-collapsed> 
                                <i class="fa fa-gear footer_fa"></i> 
                                <p class="footer_p"><a href="http://www.florentlagrange.eu/admin">Admin</a></p>
                            </div>                             
                            <div class="col-md-4" data-pg-collapsed> 
                                <i class="fa fa-sitemap footer_fa"></i> 
                                <p class="footer_p">Sitemap</p> 
                            </div>                             
                            <div class="col-md-4" data-pg-collapsed> 
                                <i class="fa fa-rss footer_fa"></i> 
                                <p class="footer_p">Rss</p> 
                            </div>                             
                        </div>                         
                        <div class="footer_colonne_01 col-md-12" title="Footer_colonne_01" data-pg-name="Footer_colonne_01" data-pg-collapsed> 
                            <div> 
                                <hr> 
                                <i class="fa fa-firefox footer_fa">&nbsp;</i> 
                                <i class="fa fa-chrome footer_fa">&nbsp;</i> 
                                <p class="footer_p">Site optimisé pour Firefox, et Chrome.</p> 
                                <hr> 
                            </div>                             
                            <div> 
                                <i class="fa fa-desktop footer_fa"></i> 
                                <p class="footer_p">1920x1080, 800x600, 400x250</p> 
                                <hr> 
                                <br> 
                            </div>                             
                        </div>                         
                        <hr> 
                    </div>                     
                    <div class="col-sm-6 col-xs-12 footer_colonne_01 col-md-3" data-pg-collapsed title="Footer_colonne_04" data-pg-name="Footer_colonne_04"> 
                        <div class="feature-box"> 
                            <img src="file:///D:/%5B%20www%20%5D/www.florentlagrange.eu/www/images/contact/cafe-logo-master-noir.png" width="45" /> 
                        </div>                         
                        <div class="feature-box" data-pg-collapsed> 
                            <br>
                            <p class="footer_p">Internet eXchange Point est une plateforme de production, de rencontre et d'exposition basée sur les paradigmes des pratiques et des cultures numériques. [...]</p> 
                            <br> 
                            <a href="../../404.html" class="lien">&gt;&gt;&gt;</a>
                        </div>                         
                    </div>                     
                </div>
                <?php echo (isset($style))?'style="'.$style.'"':'' ?>
                <div class="container" data-pg-collapsed>
                    <?php if(function_exists('return_theme_setting') && return_theme_setting('footer_mode') == 1) { ?>
                        <div class="four columns" data-pg-collapsed>
                            <h3><?php echo $set_lang['FOOTER_ABOUT']; ?></h3>
                            <p style="margin:0;"><?php file_exists(GSDATAPAGESPATH.'about.xml') ? get_excerpt('about', 220, '') : get_excerpt('index', 220, '') ?></p>
                            <hr class="sep30">
                            <h3><?php echo $set_lang['FOOTER_CONTACT']; ?></h3>
                            <ul class="get-in-touch">
                                <li>
                                    <i class="typcn typcn-location-outline"></i>
                                    <p><?php echo $c_address; ?></p>
                                </li>
                                <li>
                                    <i class="typcn typcn-phone-outline"></i>
                                    <p><strong><?php echo current(explode(' ',$set_lang['CONTACT_PHONE'])).":"; ?></strong> <?php echo $c_phone; ?></p>
                                </li>
                                <li>
                                    <i class="typcn typcn-mail"></i>
                                    <p><strong><?php echo current(explode(' ',$set_lang['CONTACT_EMAIL'])).":"; ?></strong> <a href="<?php echo $SITEURL; ?>contact"><?php echo $c_email; ?></a></p>
                                </li>
                            </ul>
                        </div>
                        <div class="eight columns" data-pg-collapsed>
                            <div class="four alt columns">
                                <h3><?php echo $set_lang['FOOTER_CATEGORIES']; ?></h3>
                                <div class="widget_latest_posts">
                                    <?php echo get_categories(); ?>
                                </div>
                            </div>
                            <hr class="sep30">
                            <div class="eight columns">
                                <h3><?php echo $set_lang['FOOTER_NEWS']; ?></h3>
                                <p><?php echo $set_lang['FOOTER_NEWS_DESC']; ?></p>
                                <?php   if(plugins_check('mld-newsletter')) $news_url = $SITEURL."newsletter";
					else $news_url = "#"; ?>
                                <form action="<?php echo $news_url; ?>" method="post">
                                    <input class="newsletter" name="newssubscriber" type="text" onblur="if(this.value=='')this.value='Email Address';" onfocus="if(this.value=='Email Address')this.value='';" value="Email Address" />
                                    <button class="newsletter-btn" type="submit">
                                        <?php echo $set_lang['FOOTER_NEWS_SUBS']; ?>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="four columns" data-pg-collapsed>
                            <h3><?php echo $set_lang['FOOTER_TAGS']; ?></h3>
                            <div class="footer_tags">
                                <ul>
                                    <?php echo get_all_tags(); ?>
                                </ul>
                            </div>
                            <hr class="sep30">
                            <?php get_component('paypal'); ?>
                        </div>
                        <?php }
		if(function_exists('return_theme_setting') && return_theme_setting('footer_mode') == 2) { ?>
                        <div class="one-third column" data-pg-collapsed>
                            <h3><?php echo $set_lang['FOOTER_ABOUT']; ?></h3>
                            <p style="margin:0;"><?php file_exists(GSDATAPAGESPATH.'about.xml') ? get_excerpt('about', 220, '') : get_excerpt('index', 220, '') ?></p>
                        </div>
                        <div class="one-third column" data-pg-collapsed>
                            <h3><?php echo $set_lang['FOOTER_CONTACT']; ?></h3>
                            <ul class="get-in-touch">
                                <li>
                                    <i class="typcn typcn-location-outline"></i>
                                    <p><?php echo $c_address; ?></p>
                                </li>
                                <li>
                                    <i class="typcn typcn-phone-outline"></i>
                                    <p><strong><?php echo current(explode(' ',$set_lang['CONTACT_PHONE'])).":"; ?></strong> <?php echo $c_phone; ?></p>
                                </li>
                                <li>
                                    <i class="typcn typcn-mail"></i>
                                    <p><strong><?php echo current(explode(' ',$set_lang['CONTACT_EMAIL'])).":"; ?></strong> <a href="<?php echo $SITEURL; ?>contact"><?php echo $c_email; ?></a></p>
                                </li>
                            </ul>
                        </div>
                        <div class="one-third column" data-pg-collapsed>
                            <h3>Tags</h3>
                            <div class="footer_tags">
                                <ul>
                                    <?php echo get_all_tags(); ?>
                                </ul>
                            </div>
                        </div>
                        <?php }
		if(function_exists('return_theme_setting') && return_theme_setting('footer_mode') == 3) { ?>
                        <div class="one-third column" data-pg-collapsed>
                            <ul class="get-in-touch">
                                <li>
                                    <i class="typcn typcn-location-outline"></i>
                                    <p><?php echo $c_address; ?></p>
                                </li>
                            </ul>
                        </div>
                        <div class="one-third column" data-pg-collapsed>
                            <ul class="get-in-touch">
                                <li>
                                    <i class="typcn typcn-phone-outline"></i>
                                    <p><strong><?php echo current(explode(' ',$set_lang['CONTACT_PHONE'])).":"; ?></strong> <?php echo $c_phone; ?></p>
                                </li>
                            </ul>
                        </div>
                        <div class="one-third column">
                            <ul class="get-in-touch">
                                <li>
                                    <i class="typcn typcn-mail"></i>
                                    <p><strong><?php echo current(explode(' ',$set_lang['CONTACT_EMAIL'])).":"; ?></strong> <a href="<?php echo $SITEURL; ?>contact"><?php echo $c_email; ?></a></p>
                                </li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
                <div id="footer-bottom" data-pg-collapsed>
                    <!-- Container -->
                    <div class="container">
                        <div class="ten columns">
</div>
                    </div>
                    <!-- Container / End -->
                </div>
                <?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      footer.inc.php
* @Package:   GetSimple
* @Action:    GS Evolve for GetSimple CMS
*
*****************************************************/
?>
                    <?php if(function_exists('return_theme_setting') && return_theme_setting('footer_mode')==2) $style="padding: 30px 0px 20px !important;";
	if(function_exists('return_theme_setting') && return_theme_setting('footer_mode')==3) $style="padding: 10px 0px 20px !important;"; 

	if(function_exists('return_theme_setting') && return_theme_setting('contact_email')) {
		$c_email = current(explode('_',str_replace("\n","_",return_theme_setting('contact_email'))));
	} else {
		$c_email = $admin_mail;
	}
	if(function_exists('return_theme_setting') && return_theme_setting('contact_phone')) {
		$c_phone = current(explode('_',str_replace("\n","_",return_theme_setting('contact_phone'))));
	} else {
		$c_phone = "+XXX XXX XX XXX";
	}
	if(function_exists('return_theme_setting') && return_theme_setting('address')) {
		$c_address = current(explode('_',str_replace("\n","_",return_theme_setting('address'))));
	} else {
		$c_address = "Location unknown";
	}
?>
                        <?php
if(function_exists('return_theme_setting')) {
	if(return_theme_setting('jquery') && return_theme_setting('jquery_header')==0) { ?>
                            <script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js"></script>
                        <?php } } else { ?>
                        <script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js"></script>
                        <?php }
if(function_exists('return_theme_setting')) {
	if(return_theme_setting('jquery_easing')) { ?>
                            <script src="<?php get_theme_url(); ?>/scripts/jquery.easing.min.js"></script>
                        <?php } } else { ?>
                        <script src="<?php get_theme_url(); ?>/scripts/jquery.easing.min.js"></script>
                        <?php }
if(function_exists('return_theme_setting')) {
	if(return_theme_setting('jquery_superfish')) { ?>
                            <script src="<?php get_theme_url(); ?>/scripts/jquery.superfish.js"></script>
                        <?php } } else { ?>
                        <script src="<?php get_theme_url(); ?>/scripts/jquery.superfish.js"></script>
                        <?php }
if(function_exists('return_theme_setting')) {
	if(return_theme_setting('jpanelmenu')) { ?>
                            <script src="<?php get_theme_url(); ?>/scripts/jquery.jpanelmenu.js"></script>
                        <?php } } else { ?>
                        <script src="<?php get_theme_url(); ?>/scripts/jquery.jpanelmenu.js"></script>
                    <?php } ?>
                    <script type="text/javascript">
function loadjscssfile(filename, filetype){
    if (filetype=="js"){ //if filename is a external JavaScript file
        var fileref=document.createElement('script');
        fileref.setAttribute("type","text/javascript");
        fileref.setAttribute("src", filename);
		fileref.async = false;
    }
    else if (filetype=="css"){ //if filename is an external CSS file
        var fileref=document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", filename);
    }
	else if (filetype=="show"){
		$('.jssor-slider .slider-inner').attr('style', 'display: block;');
	}
    if (typeof fileref!="undefined") {
		document.body.appendChild(fileref);
	}
}
if (window.addEventListener)
	window.addEventListener("load", loadjscssfile, false);
else if (window.attachEvent)
	window.attachEvent("onload", loadjscssfile);
else window.onload = loadjscssfile;

function slider_show() {
	$('.jssor-slider .slider-inner').attr('style', 'display: block;');
}

if ($(".jssor-slider")[0]){
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jssor/jssor.slider.mini.js", "js");
	$('.jssor-slider').each(function() {
		loadjscssfile("<?php get_theme_url(); ?>/scripts/jssor/" + this.id + ".js", "js");
	});
}
if ($("#content-wrapper .tp-banner").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/rs-plugin/css/settings.css", "css");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.themepunch.plugins.min.js", "js");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.themepunch.revolution.min.js", "js");
}
if ($(".camera_wrap")[0]){
	loadjscssfile("<?php get_theme_url(); ?>/css/camera.css", "css");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/camera.min.js", "js");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/camera-script.js", "js");
}
if ($( "div" ).hasClass( "parallex" )) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/parallex.js", "js");
}
if ($(".tooltip").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.tooltips.min.js", "js");
}
if ($("#content-wrapper .mfp-gallery").length || $(".mfp-image").length || $(".mfp-video").length || $(".mfp-online").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.magnific-popup.min.js", "js");
}
if ($("#content-wrapper .flexslider").length || $("#content-wrapper .flexslider-blog").length || $("#content-wrapper .testimonial-home").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.flexslider.js", "js");
}
if ($("#content-wrapper #portfolio-wrapper").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.isotope.min.js", "js");
}
if ($(".percentage, .percentage-light").length) { 
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.easy-pie-chart.js", "js");
}
if ($("#recent-work").length || $("#our-clients").length || $("#testimonials").length || $("#happy-clients").length || $("#team-members").length || $("#recent-blog").length) {
	loadjscssfile("<?php get_theme_url(); ?>/scripts/jquery.themepunch.showbizpro.min.js", "js");
}
	loadjscssfile("<?php get_theme_url(); ?>/scripts/appear.js", "js");
	loadjscssfile("<?php get_theme_url(); ?>/scripts/custom.js", "js");
</script>
                    <?php get_footer(); ?>
            </div>
