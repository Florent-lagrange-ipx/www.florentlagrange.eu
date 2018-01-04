<div class="container" data-pg-name="MAIN">
    <div class="row" data-pg-name="ARTICLE"> 
        <div title="TITRE" data-pg-name="TITRE" class="col-md-3" data-pg-collapsed> 
            <p class="Modele_P000"><?php get_page_title(); ?></p> 
            <p class="tag_titre"><?php get_page_meta_keywords(); ?></p> 
        </div>
        <div class="col-md-9"> 
            <br> 
            <div class="nine columns" data-animated="fadeInUp" data-pg-collapsed> 
                <?php if(function_exists('return_theme_setting') && return_theme_setting('title_desc')) {

				if(get_page_meta_desc(false)) { ?> 
                    <p class="cartel"><?php get_page_meta_desc(true) ?></p> 
                <?php } } ?> 
            </div>             
            <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed> 
                <hr> 
            </div>             
        </div>
        <div class="col-md-12"> 
            <p class="texte_principal modele_resume"> <?php get_page_content(); ?> </p> 
        </div>
        <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed> 
            <hr> 
        </div>         
    </div>
