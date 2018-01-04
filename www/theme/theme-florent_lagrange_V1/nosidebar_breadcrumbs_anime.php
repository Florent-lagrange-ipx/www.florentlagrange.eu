<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
/****************************************************
*
* @File:      nosidebar_breadcrumbs_anime.php
* @Package:   GetSimple
* @Action:    GS Evolve for GetSimple CMS
*
*****************************************************/
?>
<?php include('header.inc.php'); ?>
<!-- Content Wrapper
================================================== -->
<div id="content-wrapper">
	<!-- Parallex Page Title -->
	<div id="<?php echo (return_theme_setting('title_parallex')) ? 'parallex-inner' : 'no-parallex-inner' ?>" class="parallaxtitle<?php echo (return_theme_setting('color_scheme')) ? ' '.return_theme_setting('color_scheme') : '' ?>">
		<div class="container">
			<div class="nine columns"  data-animated="fadeInUp">
				<h1 id="pagetitle"><?php get_page_title(); ?></h1>
				<?php if(return_theme_setting('title_desc')) {
				if(get_page_meta_desc(false)) { ?>
				<p><?php get_page_meta_desc(true) ?></p>
				<?php } } ?>
			</div>
			<?php if (function_exists('get_i18n_breadcrumbs')) { 
				if(return_page_slug()!='index') { 
				$to_home=return_i18n_menu_data('index'); ?>
				<div class="seven columns">
                    <nav id="breadcrumbs">
						<a href="<?php echo find_url('index',null); ?>"><?php echo $to_home[0]['menu'].'&nbsp;&nbsp;'; ?></a>
					</nav>
				</div>
				<?php }}
				else { ?>
				<div class="breadcrumbs" >
					<nav id="breadcrumbs">
						<?php get_parent_link('index'); ?> <?php (get_parent(FALSE) != 'index') ? get_parent_link(get_parent(FALSE)) : '' ?> <b><?php get_page_clean_title(); ?></b>
					</nav>
				</div>
				<?php } ?>
			
		</div>
	</div>

	<!-- Container -->
	<div class="container" data-animated="fadeInDown">
		<?php get_page_content(); ?>
	</div>

<?php include('footer.inc.php'); ?>