<div class="container">
    <div class="row" title="FOOTER" data-pg-name="FOOTER" data-pg-collapsed>
        <hr class="hr_titre hr_css" />
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <center>
                <img src="http://www.florentlagrange.eu/data/uploads/habillage/habillage_167x57_72-ppp_10032012_009.png" width="200" class="footer" />
            </center>
        </div>
        <hr class="hr_footer footer_hr" data-pg-name="////////////" />
        <div class="col-md-3 footer_colonne_01 col-xs-3 col-sm-3 col-lg-3" title="Footer_colonne_01" data-pg-name="Footer_colonne_01" data-pg-collapsed>
            <div data-pg-collapsed>
                <i class="fa fa-creative-commons footer_fa"></i> 
                <p class="footer_p">Année de création 2009 - 2017</p>
                <p class="footer_p">Créé par Florent Lagrange</p>
                <hr>
                <img src="http://www.florentlagrange.eu/data/uploads/habillage/creative_common_logo.png" width="75">
                <br>
                <p><a href="https://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank" class="footer_p"> CC-BY-NC-ND-4.0</a><br></p>
                <p class="footer_colonne_01_attribution">Attribution-NonCommercial-NoDerivs&nbsp;</p>
            </div>
        </div>
        <div class="footer_colonne_01 col-md-3 col-sm-3 col-xs-3 col-lg-3" title="Footer_colonne_02" data-pg-name="Footer_colonne_02" data-pg-collapsed>
            <i class="fa fa-envelope-o footer_fa"></i> 
            <div class="feature-box" data-pg-collapsed>
                <p class="footer_p">Région Auvergne-Rhône-Alpes,</p>
                <p class="footer_p">Paris, France.</p>
                <hr>
                <p class="footer_p">EMAIL</p>
                <a href="mailto:#">contact[at]florentlagrange[dot]eu</a> 
            </div>
        </div>
        <div class="footer_colonne_01 col-md-3 col-sm-3 col-xs-3 col-lg-3" data-pg-name="Footer_colonne_03" data-pg-collapsed>
            <div data-pg-collapsed>
                <div class="col-md-4" data-pg-collapsed>
                    <i class="fa fa-gear footer_fa"></i> 
                    <p><a href="http://www.florentlagrange.eu/admin">Admin</a></p>
                </div>
                <div class="col-md-4" data-pg-collapsed>
                    <i class="fa fa-sitemap footer_fa"></i> 
                    <p><a href="http://www.florentlagrange.eu/sitemap.xml">Sitemap</a></p>
                </div>
                <div class="col-md-4" data-pg-collapsed>
                    <i class="fa fa-rss footer_fa"></i> 
                    <p><a href="http://www.florentlagrange.eu/subdirectory/rss/?lang=fr">Rss</a></p>
                </div>
            </div>
            <div class="col-md-12" title="Footer_colonne_01" data-pg-name="Footer_colonne_01" data-pg-collapsed>
                <div>
                    <hr>
                    <i class="fa fa-firefox footer_fa">&nbsp;</i> 
                    <i class="fa fa-chrome footer_fa">&nbsp;</i> 
                    <i class="fa fa-safari" aria-hidden="true"></i> 
                    <i class="fa fa-opera" aria-hidden="true"></i> 
                    <p class="footer_p">Site optimisé pour Firefox, et Chrome.</p>
                    <hr>
                </div>
                <div>
                    <i class="fa fa-desktop"></i> 
                    <i class="fa fa-tablet footer_fa" aria-hidden="true"></i> 
                    <i class="fa fa-mobile footer_fa" aria-hidden="true"></i> 
                    <p class="footer_p">1920x1080, 800x600, 400x250</p>
                    <hr>
                    <br>
                </div>
            </div>
            <hr>
        </div>
        <div class="footer_colonne_01 col-md-3 col-sm-3 col-xs-3 col-lg-3" title="Footer_colonne_04" data-pg-name="Footer_colonne_04" data-pg-collapsed>
            <div class="feature-box" data-pg-collapsed="">
                <img src="http://www.florentlagrange.eu/data/uploads/habillage/_ipxlab.png" width="125">
            </div>
            <p class="footer_p">Internet eXchange Point est une plateforme de production, de rencontre et d'exposition basée sur les paradigmes des pratiques et des cultures numériques. [...]</p>
            <br>
            <div class="feature-box">
                <img src="http://www.florentlagrange.eu/data/uploads/hypertext_logo_550x550_01.png" width="60px">
                <p><a href="http://hypertext.florentlagrange.eu/" target="_blank" class="footer_p"> STUDIO HYPERTEXT</a><br></p>
            </div>
        </div>
    </div>     
</div> 
    <div id="footer" <div class="container"> 
    <div class="container" data-pg-collapsed> 
        <?php if(function_exists('return_theme_setting') && return_theme_setting('footer_mode') == 1) { ?> 
            <?php }

		if(function_exists('return_theme_setting') && return_theme_setting('footer_mode') == 2) { ?> 
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
        <?php } ?> 
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
                <script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js" data-pg-hidden></script>                 
            <?php } } else { ?> 
            <script src="<?php get_theme_url(); ?>/scripts/jquery-1.11.3.min.js" data-pg-hidden></script>             
            <?php }

if(function_exists('return_theme_setting')) {

	if(return_theme_setting('jquery_easing')) { ?> 
                <script src="<?php get_theme_url(); ?>/scripts/jquery.easing.min.js" data-pg-hidden></script>                 
            <?php } } else { ?> 
            <script src="<?php get_theme_url(); ?>/scripts/jquery.easing.min.js" data-pg-hidden></script>             
            <?php }

if(function_exists('return_theme_setting')) {

	if(return_theme_setting('jquery_superfish')) { ?> 
                <script src="<?php get_theme_url(); ?>/scripts/jquery.superfish.js" data-pg-hidden></script>                 
            <?php } } else { ?> 
            <script src="<?php get_theme_url(); ?>/scripts/jquery.superfish.js" data-pg-hidden></script>             
            <?php }

if(function_exists('return_theme_setting')) {

	if(return_theme_setting('jpanelmenu')) { ?> 
                <script src="<?php get_theme_url(); ?>/scripts/jquery.jpanelmenu.js" data-pg-hidden></script>                 
            <?php } } else { ?> 
            <script src="<?php get_theme_url(); ?>/scripts/jquery.jpanelmenu.js" data-pg-hidden></script>             
        <?php } ?> 
        <script type="text/javascript" data-pg-hidden>

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
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>         
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>         
        <script src="http://edition.florentlagrange.eu/js/index.js"></script>
        <?php get_footer(); ?> 
</div>
