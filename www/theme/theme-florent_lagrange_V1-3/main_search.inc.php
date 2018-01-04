<body id="<?php get_page_slug(); ?>"> 
    <div class="container" data-pg-name="MAIN"> 
        <div class="row" data-pg-name="META"> 
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <hr class="hr_argument"> 
            </div>             
            <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                <p class="Modele_P000" data-pg-name="TITRE" data-pg-collapsed><?php get_page_title(); ?></p> 
                <hr class="hr_argument_bas"> 
                <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                    <p class="tag_titre" data-pg-name="TAG" data-pg-collapsed><?php get_custom_field('tag1'); ?>&nbsp; |  &nbsp;<?php get_custom_field('tag2'); ?>&nbsp; |  &nbsp;<?php get_custom_field('tag3'); ?>&nbsp; |  &nbsp;<?php get_custom_field('tag4'); ?>&nbsp; |  &nbsp;<?php get_custom_field('tag5'); ?><br></p> 
                </div>                 
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
            <div class="row" data-pg-name="TABLE DES MATIERES"> 
                <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                    <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_i18n_search_form(array('slug'=>'search')); ?></p> 
                </div>                 
            </div>             

            <div class="row" data-pg-name="TABLE DES MATIERES"> 
                <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                    <p class="texte_principal modele_resume" data-pg-name="CONTENT"><?php get_i18n_search_form(array('slug'=>'search','showTags'=>0)); ?> </p> 
                </div>                 
            </div>
            <div class="row" data-pg-name="TABLE DES MATIERES"> 
                <div class=" col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="MAIN" data-pg-collapsed> 
                    <p class="texte_principal modele_resume" data-pg-name="CONTENT"> <?php get_page_content(); ?> </p> 
                </div>                 
            </div>
