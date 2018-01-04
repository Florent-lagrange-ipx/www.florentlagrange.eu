<div class="tide_news_comments">
    <div class="tide_news_comments_title"><?php echo i18n_r('tide_news/COMMENTS_INFO'); ?></div>
    <a href="http://facebook.com" ><img alt="tidengine_facebook_logo" src="<?php echo $data['icon']; ?>facebook.gif" /></a>
    <a href="http://intensedebate.com/" ><img alt="tidengine_intensedebate_logo" src="<?php echo $data['icon']; ?>intensedebate.gif" /></a>
    <a href="http://disqus.com/"><img alt="tidengine_template_disqus_logo" src="<?php echo $data['icon']; ?>disqus.gif" /></a>
    <a href="http://livefyre.com/"><img alt="tidengine_template_livefyre_logo" src="<?php echo $data['icon']; ?>livefyre.gif" /></a>
    <a href="http://vk.com" ><img alt="tidengine_template_vke_logo" src="<?php echo $data['icon']; ?>vk.gif" /></a>
    <?php get_external_comments($data['slug'], $data['permanent_link'] , $data['title']); ?>
</div>