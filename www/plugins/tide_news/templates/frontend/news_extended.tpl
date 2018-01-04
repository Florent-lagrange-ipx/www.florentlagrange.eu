<div class="tide_news_extended">
    <div>
        <div class="tide_news_title">
            <?php echo $data['title']; ?>
        </div>
        <div class="tide_news_date">
            <?php echo $data['date']; echo $data['category_title']; ?>
        </div>

        <div class="tide_news_content">
            <?php echo $data['summary']; ?>
            <div class="tide_news_content_modified"><?php  echo $data['modified']; ?></div>
             {%{TIDE_ADDTHIS::SHARE_CODE_1}%}
        </div> 
        <div class="tide_news_permanent_link">
            <span class="tide_news_permanent_link_pre">
                <?php echo i18n_r('tide_news/NEWS_PERMANENT'); ?>
            </span>
            <div class="tide_news_permanent_link_content">
                <?php echo $data['p_link']; ?>
            </div>
        </div>
        <div class="tide_news_tags_holder">
            <span class="tide_news_tags_pre">
                <?php echo i18n_r('tide_news/NEWS_TAGS'); ?> : 
            </span>
            <?php echo $data['c_tags']; ?>
         </div>
 <div class="clearfix"></div>
       
        
    </div>
</div>