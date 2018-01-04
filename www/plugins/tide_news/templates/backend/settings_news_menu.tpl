<form class="largeform" action="load.php?id=tide_news&amp;tide_news_settings&amp;subpage=tidenews_news_menu" method="post" accept-charset="utf-8">
    <div id="metadata_window" >
        <h3><?PHP  echo i18n_r('tide_news/S_MENU_T_SETTINGS'); ?></h3>
        <div class="leftopt">
            <p class="tide_admin_label ch_box"><label for="menu_enable">
                    <?php echo i18n_r('tide_news/S_MENU_ENABLE'); ?> 
                    <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_ENABLE_INFO'); ?></span>
                </label>              
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="menu_enable"  id="menu_enable" <?php echo $data['menu_enable']; ?> />
            </p> 
            <p class="tide_admin_label"><label for="menu_news_number"><?php echo i18n_r('tide_news/S_MENU_NEWS_NUM'); ?>:</label>
                <?php echo $data['menu_news_number']; ?>
                <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/S_MENU_NEWS_NUM_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="menu_title"><?php  echo i18n_r('tide_news/S_MENU_TITLE'); ?>:</label>
                <input type="text" value="<?php echo $data['menu_title']; ?>" name="menu_title" id="menu_title" class="text short" />
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_NEWS_TITLE_INFO'); ?></span>
            </p>   
        </div>
        <div class="rightopt">
        <p class="tide_admin_label"><label for="menu_title_lenght"><?php echo i18n_r('tide_news/S_MENU_TITLE_LEN'); ?>:</label>
                <input type="text" value="<?php echo $data['menu_title_lenght'];  ?>" name="menu_title_lenght" id="menu_title_lenght" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_TITLE_LEN_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="menu_content_lenght"><?php echo i18n_r('tide_news/S_MENU_SHORT_LEN'); ?>:</label>
                <input type="text" value="<?php echo $data['menu_content_lenght'];  ?>" name="menu_content_lenght" id="menu_content_lenght" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_SHORT_LEN_INFO'); ?></span>
            </p>
        </div>      
        <div class="clear"></div>
    </div>
    <p id="submit_line">
        <span><input type="submit" value="Save Settings" name="tide_settings_save" class="submit"></span>
    </p>

</form>