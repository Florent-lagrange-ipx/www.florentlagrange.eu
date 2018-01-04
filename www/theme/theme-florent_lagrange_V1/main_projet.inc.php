<!--

	+---------------------------------------------------------------------------+
	|																			|
	|	* [Document] :      	main_standard.inc.php 							|
	|																			|
	|	* [Auteur]:   			Florent Lagrange  								|
	|																			|
	|	* [Date]:    			<1983-2017>								        |
	|																			|
	|	* [Contact]:    		contact[at]florentlagrange[dot]eu 				|
	|																			|
	|	* [CCC]:    			CC - BY - 4.0 									|
	|																			|
	|	Attribution-NonCommercial-NoDerivs 										|
	|																			|
	|	Conception et dévellopement réalisé par Florent Lagrange 				|
	+---------------------------------------------------------------------------+



 --> 
<div class="container"></div>
<div class="container" data-pg-name="MAIN"> 
    <div class="row" data-pg-name="ARTICLE">
        <div class="row">
            <div title="TITRE" data-pg-name="TITRE" class="col-md-12"> 
                <p class="Modele_P000"><?php get_page_title(); ?></p> 
                <p class="tag_titre"><?php get_page_meta_keywords(); ?></p> 
            </div>             
        </div>
        <div class="row"> 
            <div class="col-sm-8 col-xs-8 col-lg-8 col-md-8">
                <div class="table-responsive" data-pg-collapsed>
                    <table class="table table-hover table-condensed" data-pg-collapsed> 
                        <thead> 
                            <tr> 
                                <th>#B</th> 
                                <th>
                                    <th>Intitulés</th>
                            </tr>                             
                        </thead>                         
                        <tbody> 
                            <tr> 
                                <td>1</td> 
                                <td>Ref.</td> 
                                <td><?php get_custom_field('projet'); ?></td>
                            </tr>                             
                            <tr> 
                                <td>2</td> 
                                <td>Titre</td> 
                                <td><?php get_custom_field('titre'); ?></td> 
                            </tr>                             
                            <tr> 
                                <td>3</td> 
                                <td>Date</td> 
                                <td><?php get_custom_field('date'); ?></td> 
                            </tr>
                            <tr data-pg-collapsed> 
                                <td>4</td> 
                                <td>Type</td> 
                                <td><?php get_custom_field('type_d_oeuvre'); ?>/td>                                  
                            </tr>
                            <tr data-pg-collapsed> 
                                <td>5</td> 
                                <td>techniques</td> 
                                <td><?php get_custom_field('techniques'); ?></td> 
                            </tr>
                            <tr data-pg-collapsed> 
                                <td>6</td> 
                                <td>Média</td> 
                                <td><?php get_custom_field('media'); ?></td> 
                            </tr>
                            <tr data-pg-collapsed> 
                                <td>7</td> 
                                <td>Version</td> 
                                <td><?php get_custom_field('version'); ?></td> 
                            </tr>
                            <tr data-pg-collapsed> 
                                <td>8</td> 
                                <td>Format</td> 
                                <td><?php get_custom_field('format'); ?></td> 
                            </tr>
                            <tr data-pg-collapsed> 
                                <td>9</td> 
                                <td>Mots-clés</td> 
                                <td><?php get_custom_field('tags'); ?></td> 
                            </tr>                             
                            <tr data-pg-collapsed> 
                                <td>10</td> 
                                <td>Statut</td> 
                                <td><?php get_custom_field('statut'); ?></td> 
                            </tr>                             
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3 col-lg-3 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                <div class="thumbnail"> 
                    <img class="image carnet_image" src="<?php get_custom_field('vignettes'); ?>" style="width: 100%;">
                    <p data-pg-name="TITRE"><b class="numero">fig.P003.01</b><br><b><i>Détail d'une des pages de la lettre<br>Lyon. 201</i>3</b><br>
			&nbsp;</p> 
                </div>                 
            </div>             
        </div>
    </div>
    <div class="row"> 
        <div class="col-md-12" data-pg-name="MAIN"> 
            <div class="row" data-pg-name="TITRE"> 
                <div title="TITRE" data-pg-name="TITRE" class="col-md-7"> 
</div>                 
            </div>
            <div class="row" data-pg-name="ARTICLE" data-pg-collapsed> 
                <div class="col-md-2" data-pg-collapsed>
</div>
                <div data-pg-collapsed class="modele_meta_description_article meta col-md-4"> 
</div>
                <div data-pg-collapsed class="col-md-3">
                    <br>
                    &nbsp;
                    <p class="carnet_texte" data-pg-collapsed=""><br></p>
                </div>
            </div>             
            <div class="col-md-12" data-pg-name="MAIN" data-pg-collapsed> 
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
                        <?php get_custom_field('titrecomplet'); ?>
                        <?php get_custom_field('description'); ?>
                        <?php get_custom_field('destination'); ?>
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
    </div>
