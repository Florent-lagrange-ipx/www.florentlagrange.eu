<!--

██╗  ██╗███████╗ █████╗ ██████╗ ███████╗██████╗ 
██║  ██║██╔════╝██╔══██╗██╔══██╗██╔════╝██╔══██╗
███████║█████╗  ███████║██║  ██║█████╗  ██████╔╝
██╔══██║██╔══╝  ██╔══██║██║  ██║██╔══╝  ██╔══██╗
██║  ██║███████╗██║  ██║██████╔╝███████╗██║  ██║
╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═════╝ ╚══════╝╚═╝  ╚═╝
       
--> 
<div class="container" data-pg-name="HEADER"> 
    <div class="row"> 
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12" data-pg-name="ID" data-pg-collapsed> 
            <center> 
                <h1 data-pg-name="LOGO" class="logo"><img src="<?php get_theme_url(); ?>/images/logo_01.png" alt="Logo" class="logo" /></h1> 
            </center>             
            <center> 
                <h1 class="florent_lagrange" data-pg-name="TITRE_SITE"><?php get_site_name(); ?></h1> 
            </center>             
        </div>         
        <div data-pg-name="NAVIGATION" class="col-sm-12 col-xs-12 col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1" data-pg-collapsed> 
            <ol class="nav nav-tabs lead pull-left"> 
                <li class="nav-item active"> 
                    <?php get_navigation(return_page_slug()); ?> 
                </li>                 
            </ol>             
        </div>         
    <div class="col-md-12 ariane col-sm-12 col-xs-12 col-lg-12" data-pg-name="ARIANE" data-pg-collapsed> 
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
        </div>         
    </div>     
</div> 
<!-- /////////////////////////////////////////////////
██████╗  ██████╗ ██████╗ ██╗   ██╗
██╔══██╗██╔═══██╗██╔══██╗╚██╗ ██╔╝
██████╔╝██║   ██║██║  ██║ ╚████╔╝
██╔══██╗██║   ██║██║  ██║  ╚██╔╝
██████╔╝╚██████╔╝██████╔╝   ██║
╚═════╝  ╚═════╝ ╚═════╝    ╚═╝
============================================= -->
