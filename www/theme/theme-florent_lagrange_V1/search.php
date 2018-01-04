<?php if(!defined('IN_GS')){ die('you cannot load this page directly.'); }
	/****************************************************
		*
		* @File:      search.php
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
	
		<!-- Container -->
		<div class="container" data-animated="fadeInUp">
			<?php
				if (function_exists('get_i18n_search_form')) {
					if(isset($_POST['keywords'])) $keywords = @explode(' ', $_POST['keywords']);
					if($language == "ru") $format_date = '%d.%m.%Y';
					else $format_date = '%Y.%m.%d';
					if(isset($_GET['tags'])) $keytags = $_GET['tags'];
					if(isset($_GET['words'])) $keywords = $_GET['words'];
					get_i18n_search_form(array('slug'=>'search'));
					if(!empty($keywords) && !empty($keytags) && !is_array($keywords)) {
						get_i18n_search_results(array('tags'=>$keytags, 'words'=>$keywords, 'DATE_FORMAT'=>$format_date));
					}
					else {
						if(!empty($keywords)) { get_i18n_search_results(array('words'=>$keywords, 'DATE_FORMAT'=>$format_date)); }
						if(!empty($keytags)) { get_i18n_search_results(array('tags'=>$keytags, 'DATE_FORMAT'=>$format_date)); }
					}
				} 
				else {
					get_search_results();
				} ?>
		</div>
	
	<?php include('footer.inc.php'); ?>
	