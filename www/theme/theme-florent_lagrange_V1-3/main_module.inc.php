<body id="<?php get_page_slug(); ?>"> 
    <div class="container" data-pg-name="MAIN"> 
        <div class="row" data-pg-name="META"> 
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <hr class="hr_argument"> 
            </div>             
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="Modele_P000" data-pg-name="TITRE" data-pg-collapsed><?php get_page_title(); ?></p> 
                <hr class="hr_argument_bas"> 
            </div>             
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="tag_titre" data-pg-name="TAG" data-pg-collapsed><?php get_page_meta_keywords(); ?><br></p> 
            </div>             
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <hr class="hr_argument_01"> 
            </div>             
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <div class="nine columns" data-animated="fadeInUp" data-pg-name="CARTEL" data-pg-collapsed> 
                    <?php if(function_exists('return_theme_setting') && return_theme_setting('title_desc')) {
				if(get_page_meta_desc(false)) { ?> 
                        <p class="description" data-pg-collapsed><?php get_page_meta_desc(true) ?></p> 
                    <?php } } ?> 
                    <br> 
                </div>                 
            </div>             
            <?php cbcontact_page('nameofuser or email', true,'user or email', 'user or email'); ?>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_custom_field('titre'); ?> </p> 
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_custom_field('date'); ?> </p> 
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_custom_field('techniques'); ?> </p> 
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_custom_field('version'); ?> </p> 
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_custom_field('tag1'); ?> </p> 
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_custom_field('tag2'); ?> </p> 
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_custom_field('tag3'); ?> </p> 
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_custom_field('tag4'); ?> </p> 
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_custom_field('tag5'); ?> </p> 
            </div>
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_page_content(); ?> </p> 
            </div>             
        </div>         
    </div>     
</body>
