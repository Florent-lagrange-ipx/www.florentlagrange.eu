<form class="largeform" action="load.php?id=tide_news&amp;tide_news_settings&amp;subpage=tidenews_general" method="post" accept-charset="utf-8">
    <div id="metadata_window" >
        <h3><?PHP  echo i18n_r('tide_news/S_NEWS_GENERAL'); ?></h3>
        <div class="leftopt">

            <p class="tide_admin_label"><label for="news_page_number"><?php echo i18n_r('tide_news/S_NEWS_NUM'); ?>:</label>	
                <?php echo $data['news_page_number']; ?>
                <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/S_NEWS_NUM_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="all_news_page"><?php echo i18n_r('tide_news/S_NEWS_ALL'); ?>:</label>	
                <?php echo $data['all_news_page']; ?>
                <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/S_NEWS_ALL_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="news_summary"><?php echo i18n_r('tide_news/S_NEWS_SUMMARY'); ?>:</label>	
                <?php echo $data['news_summary']; ?>
                <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/S_NEWS_SUMMARY_INFO'); ?></span>
            </p>
            <p class="tide_admin_label">
                <label for="slug_separator"><?php  echo i18n_r('tide_news/S_NEWS_SLUG'); ?>:</label>
                <?php echo $data['slug_separator']; ?>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_NEWS_SLUG_INFO'); ?></span>
            </p>
            <p class="tide_admin_label ch_box">
                <label for="duplicate_name">
                    <?php echo  i18n_r('tide_news/S_NEWS_DUPLICATE_NAME'); ?>               
                </label>  <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/S_NEWS_DUPLICATE_NAME_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="duplicate_name" id="duplicate_name" <?php echo $data['duplicate_name']; ?> /> 
            </p>            
        </div>
        <div class="rightopt">

            <p class="tide_admin_label"><label for="language"><?php echo  i18n_r('tide_news/S_NEWS_LANGUAGE'); ?>:</label>
                <?php echo $data['language']; ?>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_NEWS_LANGUAGE_INFO'); ?></span>
            </p>
            <p class="tide_admin_label">
                <label for="date_format"><?php  echo i18n_r('tide_news/S_MENU_DATEFORMAT'); ?>:</label>
                <input type="text" value="<?php echo $data['date_format']; ?>" name="date_format" id="date_format" class="text short">  
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_DATEFORMAT_INFO'); ?></span>
            </p> 
             <p class="tide_admin_label">
                <label for="time_format"><?php  echo i18n_r('tide_news/S_MENU_TIMEFORMAT'); ?>:</label>
                <input type="text" value="<?php echo $data['time_format']; ?>" name="time_format" id="time_format" class="text short">  
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_TIMEFORMAT_INFO'); ?></span>
            </p>                    
            <p class="tide_admin_label"><label for="navigation_type"><?php echo  i18n_r('tide_news/S_NEWS_PAG'); ?>:</label>
                <?php echo $data['navigation_type']; ?>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_NEWS_PAG_INFO'); ?></span>
            </p>
            <p class="tide_admin_label">
                <label for="external_comments">
                    <?php echo  i18n_r('tide_news/S_NEWS_COMM'); ?>
                    <span class="tide_admin_info_small"><?php echo $data['external_exist'] ; ?></span>
                </label> 
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="external_comments" id="external_comments" <?php echo $data['external_comments']; ?> />            
            </p>
            <input type="hidden" id="old_master_page" name="old_master_page" value="<?php echo $data['old_master_page']; ?>" />
        </div>
        <div class="clear"></div>
    </div>
    <p id="submit_line">
        <span><input type="submit" value="Save Settings" name="tide_settings_save" class="submit"></span>
    </p>

</form>