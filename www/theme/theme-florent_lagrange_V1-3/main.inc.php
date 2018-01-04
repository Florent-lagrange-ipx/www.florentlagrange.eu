<div class="container" data-pg-name="MAIN">
    <div class="row pg-empty-placeholder" data-pg-collapsed data-pg-name="META"> 
        <div class="col-md-2" data-pg-name="SIDEBAR" data-pg-collapsed> 
            <?php get_component('sidebar');	?> 
        </div>         
        <div class="col-md-9" data-pg-name="MAIN" data-pg-collapsed> 
            <div class="row" data-pg-name="TITRE"> 
                <div title="TITRE" data-pg-name="TITRE" class="col-md-7"> 
                    <p class="Modele_P000"><?php get_page_title(); ?></p> 
                    <p class="tag_titre"><?php get_page_meta_keywords(); ?></p> 
                </div>                 
            </div>             
            <div class="row" title="RESUME" data-pg-name="RESUME"> 
                <div data-pg-name="CARTEL" class="col-md-12"> 
                    <br> 
                    <div class="nine columns" data-animated="fadeInUp"> 
                        <?php if(function_exists('return_theme_setting') && return_theme_setting('title_desc')) {
				if(get_page_meta_desc(false)) { ?> 
                            <p class="description"><?php get_page_meta_desc(true) ?></p> 
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
                <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed> 
                    <hr> 
                </div>                 
            </div>             
        </div>         
    </div>
    