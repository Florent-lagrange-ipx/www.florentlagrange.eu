<div class="tide_news_summary">
    <div>
        <div class="tide_news_title">
            <?php echo $data['title']; ?>
        </div>
        <div class="tide_news_date">
            <?php echo $data['date']; echo $data['category_title']; ?>    
        </div>

        <div class="tide_news_content">
            <?php echo $data['summary']; ?>
        </div>
         <div class="tide_news_tags_holder">
            <span class="tide_news_tags_pre">
                <?php echo i18n_r('tide_news/NEWS_TAGS'); ?> : 
            </span>
            <?php echo $data['c_tags']; ?>
         </div>
    </div>
</div>
<div class="clearfix"></div>