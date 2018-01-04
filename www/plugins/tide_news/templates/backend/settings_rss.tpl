<form class="largeform" action="load.php?id=tide_news&amp;tide_news_settings&amp;subpage=tidenews_rss_feed" method="post" accept-charset="utf-8">
    <div id="metadata_window" >
        <h3><?PHP  echo i18n_r('tide_news/S_RSS'); ?></h3>
        <div class="leftopt">
            <p class="tide_admin_label ch_box">
                <label for="feed_enable">
                    <?php echo i18n_r('tide_news/S_RSS_ENABLE'); ?>
                </label> 
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_ENABLE_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="feed_enable"  id="feed_enable"  <?php echo $data['feed_enable']; ?> />
            </p> 
            <p class="tide_admin_label ch_box"><label for="feed_auto" >
                    <?php echo i18n_r('tide_news/S_RSS_AUTO'); ?>
                </label> 
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_AUTO_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="feed_auto"  id="feed_auto" <?php echo $data['feed_auto']; ?> />
            </p>        
            <p class="tide_admin_label"><label for="feed_title"><?php echo i18n_r('tide_news/S_RSS_TITLE'); ?>:</label>
                <input type="text" value="<?php echo $data['feed_title']; ?>" name="feed_title" id="feed_title" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_TITLE_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="category_feed_title"><?php echo i18n_r('tide_news/S_RSS_TITLE_CAT'); ?>:</label>
                <input type="text" value="<?php echo $data['category_feed_title']; ?>" name="category_feed_title" id="category_feed_title" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_TITLE_CAT_INFO'); ?></span>
            </p>
            <p class="tide_admin_label meta_dsc"><label for="feed_description"><?php echo  i18n_r('tide_news/S_RSS_DESC'); ?>:</label>
                <textarea name="feed_description" id="feed_description" class="text" ><?php echo $data['feed_description']; ?></textarea>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_DESC_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="feed_lang"><?php echo i18n_r('tide_news/S_RSS_LANG'); ?>:</label>
                <?php echo $data['feed_lang']; ?>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_LANG_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="feed_num"><?php echo  i18n_r('tide_news/S_RSS_IT_NUM'); ?>:</label> 
                <?php echo $data['feed_num']; ?>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_IT_NUM_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="feed_generator"><?php echo i18n_r('tide_news/S_RSS_GEN'); ?>:</label>
                <input type="text" value="<?php echo $data['feed_generator']; ?>" name="feed_generator" id="feed_generator" class="text short">
                 <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_GEN_INFO'); ?></span>
            </p> 
        </div>
        <div class="rightopt">
            <p class="tide_admin_label ch_box">
                <label for="feed_menu_enable">
                    <?php echo i18n_r('tide_news/S_RSS_MENU_ENABLE'); ?>
                </label> 
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_MENU_ENABLE_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="feed_menu_enable"  id="feed_menu_enable"  <?php echo $data['feed_menu_enable']; ?> />
            </p> 
            <p class="tide_admin_label"><label for="feed_menu_title"><?php echo i18n_r('tide_news/S_RSS_MENU_TITLE'); ?>:</label>
                <input type="text" value="<?php echo $data['feed_menu_title']; ?>" name="feed_menu_title" id="feed_menu_title" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_MENU_TITLE_INFO'); ?></span>
            </p>
            <p class="tide_admin_label feed_ico"><label for="feed_icon"><?php echo i18n_r('tide_news/S_RSS_ICO'); ?>:</label>
                <?php echo $data['feed_icon']; ?>           
                <img id="feed_ico_prew" src="<?php echo $data['icon']; ?>" alt="rss-icon" />   
                <span class="tide_admin_info_small" style="position: relative; top: -17px;"><?php echo i18n_r('tide_news/S_RSS_ICO_INFO'); ?></span>
            </p>                
            <p class="tide_admin_label ta"> 
                <label><?php echo i18n_r('tide_news/S_RSS_IMG_UPLOAD'); ?>:</label>
                <span class="tide_admin_info_small" style="position: relative; top: -10px;"><?php echo i18n_r('tide_news/S_RSS_IMG_UPLOAD_INFO'); ?></span>
                <?php echo $data['upload_image']; ?>
                 
            </p>  
            <p class="tide_admin_label feed_img">
                <label for="feed_image"><?php echo i18n_r('tide_news/S_RSS_IMG'); ?>:</label>
                <?php echo $data['feed_images']; ?>    
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_RSS_IMG_INFO'); ?></span>
            </p>
            <p class="tide_admin_label show_feed_image">
                <?php echo $data['image']; ?>
            </p>
        </div>      
        <div class="clear"></div>
    </div>
    <p id="submit_line">
        <span><input type="submit" value="Save Settings" name="tide_settings_save" class="submit"></span>
    </p>

</form>