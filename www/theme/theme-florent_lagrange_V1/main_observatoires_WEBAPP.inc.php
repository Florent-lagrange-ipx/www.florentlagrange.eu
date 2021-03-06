<!--
=================================================
=================================================
=================================================
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	|	* [Document] :      main_observatoires_MINDMAPPING.inc.php   	|
	|	* [Auteur]:   			Florent Lagrange                          |
	|	* [Date]:    			  <1983-2017>			                         	|
	|	* [Contact]:    		contact[at]florentlagrange[dot]eu 				|
	|	* [CCC]:    			  CC - BY - 4.0 		            						|
	|	Attribution-NonCommercial-NoDerivs 			         							|
	|	Conception et dévellopement réalisé par Florent Lagrange 			|



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 -->
<!--

       ___
      /\__\
     /:/ _/_
    /:/ /\__\
   /:/ /:/  /
  /:/_/:/  /
  \:\/:/  /
   \::/__/
    \:\  \
     \:\__\
      \/__/




 =================================================
 =================================================
 =================================================
 /////////////////////////////////////////////////
 /////////////////////////////////////////////////
 /////////////////////////////////////////////////
 /////////////////////////////////////////////////
 /////////////////////////////////////////////////
 Début : HEADER_A.INC.PHP.php
-->
 <!--
 ██╗  ██╗███████╗ █████╗ ██████╗
 ██║  ██║██╔════╝██╔══██╗██╔══██╗
 ███████║█████╗  ███████║██║  ██║
 ██╔══██║██╔══╝  ██╔══██║██║  ██║
 ██║  ██║███████╗██║  ██║██████╔╝
 ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝
 -->
 <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
 ////////// DEBUT : HEADER_A.INC.PHP //////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


 <div class="container" data-pg-name="MAIN" data-pg-collapsed>
    <div class="row" data-pg-collapsed>
        <div class="col-md-3" data-pg-name="SIDEBAR">
            <?php get_component('sidebar_observatoires'); ?>
        </div>
        <div class="col-md-8" data-pg-name="MAIN">
            <div class="row" data-pg-name="TITRE">
                <div title="TITRE" data-pg-name="TITRE" class="col-md-7">
                    <p class="Modele_P000"><?php get_page_title(); ?></p>
                    <p class="tag_titre"><?php get_page_meta_keywords(); ?></p>
                </div>
            </div>
            <div class="row" title="RESUME" data-pg-name="RESUME">
                <div data-pg-name="CARTEL" class="col-md-12" data-pg-collapsed>
                    <br>
                    <div class="nine columns" data-animated="fadeInUp" data-pg-collapsed>
                        <?php if(function_exists('return_theme_setting') && return_theme_setting('title_desc')) {

				if(get_page_meta_desc(false)) { ?>
                            <p class="cartel"><?php get_page_meta_desc(true) ?></p>
                        <?php } } ?>
                    </div>
                </div>
                <div class="col-md-12" title="///////////" data-pg-name="///////////" data-pg-collapsed>
                    <hr>
                </div>
                <div class="col-md-12" title="LIENS" data-pg-name="LIENS" data-pg-collapsed>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
LISTES LIENS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
 <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 liste" data-pg-collapsed>


    <p>

      <?php $links_html = return_links(2); ?>
                    <?php get_links(2); ?>
                    <hr>

    </p>

</diV>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
LISTES LIENS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
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
</div>

<!--
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
=================================================
=================================================
=================================================
-->
