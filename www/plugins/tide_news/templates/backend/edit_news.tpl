<div class="tide_logo_admin">
    <img src="<?php echo SITE_URL; ?>plugins/TIDEGetSimple/images/TIDEngine.ico" />
</div>
<h3 class="tide_title_admin"><?php echo i18n_r('tide_news/NEWS_EDIT'); ?></h3>
<form class="largeform" action="load.php?id=tide_news&amp;tide_edit_news" method="post" accept-charset="utf-8">
    <div class="edit-nav" >
        <a href="" id="metadata_toggle" accesskey="O" ><?php echo i18n_r('tide_news/NEWS_OPTIONS'); ?></a>
        <div class="clear" ></div>
    </div>
    <p><input class="text title" name="title" type="text" value="<?php echo $data['title']; ?>" /></p>
    <div class="clear" ></div>
    <div style="display:none;" id="metadata_window" > 
        <div class="clear"></div>
        <h3><?php echo i18n_r('tide_news/NEWS_SETTINGS'); ?></h3>
        <div class="leftopt">
            <p class="inline clearfix tide_admin_label in_drop" >
                <label for="category"><?php echo i18n_r('tide_news/NEWS_CATEGORY'); ?></label>
                <?php echo $data['category']; ?> 
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/NEWS_CATEGORY_INFO'); ?></span>
            </p>
            <p class="tide_admin_label">
                <label for="slug"><?php echo i18n_r('tide_news/NEWS_SLUG'); ?></label>
                <input class="text short" id="slug" name="slug" value="<?php echo $data['slug']; ?>" type="text">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/NEWS_SLUG_INFO'); ?></span>
            </p>         
            <p class="tide_admin_label">
                <label for="keywords"><?php echo i18n_r('tide_news/NEWS_META_KEYWORDS'); ?></label>
                <input class="text short" id="keywords" name="keywords" value="<?php echo $data['keywords']; ?>" type="text">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/NEWS_META_KEYWORDS_INFO'); ?></span>
            </p>
            <p class="tide_admin_label meta_dsc">
                <label for="metad" class="clearfix"><?php echo i18n_r('tide_news/NEWS_META_DESCRIPTION'); ?>
                    <span id="countdownwrap"><strong id="countdown">155</strong> characters remaining</span></label>
                <textarea class="text short" id="metad" name="metad"><?php echo $data['metad']; ?></textarea>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/NEWS_META_DESCRIPTION_INFO'); ?></span>
            </p>
        </div>
        <div class="rightopt">
            <p class="inline clearfix tide_admin_label in_drop" >
                <label  for="news_visibility"><?php echo i18n_r('tide_news/NEWS_VISIBILITY'); ?> &nbsp; </label>
                <?php echo $data['news_visibility']; ?>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/NEWS_VISIBILITY_INFO'); ?></span>
            </p>
               <p class="tide_admin_label ch_box">
                <label for="permanent_link">
                    <?php echo  i18n_r('tide_news/NEWS_PERMANENT_LINK'); ?>               
                </label>  <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/NEWS_PERMANENT_LINK_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="permanent_link" id="permanent_link" <?php echo $data['permanent_link']; ?> /> 
            </p>
            <p class="tide_admin_label ch_box">
                <label for="date_show">
                    <?php echo  i18n_r('tide_news/NEWS_DATE_SHOW'); ?>               
                </label>  <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/NEWS_DATE_SHOW_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="date_show" id="date_show" <?php echo $data['date_show']; ?> /> 
            </p>
            <p class="tide_admin_label">
                <label for="date"><?php echo i18n_r('tide_news/NEWS_DATE_CREATED'); ?></label> 
                 <input class="text short" id="date" style="width:120px;float: left;margin-left: 10px;" name="date" value="<?php echo $data['date']; ?>" type="text">             
                 <input class="text short" id="time" style="width:120px;float: right;margin-right: 10px;" name="time" value="<?php echo $data['time']; ?>" type="text">
                <span class="tide_admin_info_small" style="width:120px;float: left;margin-left: 10px;text-align: right;"><?php echo i18n_r('tide_news/NEWS_DATE_CREATED_INFO'); ?></span>
                <span style="width:130px;float: right; text-align: right;" class="tide_admin_info_small"><?php echo i18n_r('tide_news/NEWS_DATE_TIME_INFO'); ?></span>
            </p>
            <p class="tide_admin_label ch_box">
                <label for="click_title">
                    <?php echo  i18n_r('tide_news/NEWS_TITLE_LINK'); ?>               
                </label>  <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/NEWS_TITLE_LINK_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="click_title" id="click_title" <?php echo $data['click_title']; ?> /> 
            </p>
            <p class="tide_admin_label ch_box">
                <label for="modified">
                    <?php echo  i18n_r('tide_news/NEWS_MODIFICATION_DATE'); ?>               
                </label>  <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/NEWS_MODIFICATION_DATE_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="modified" id="modified" <?php echo $data['modified']; ?> /> 
            </p>
        </div>
        <div class="clear"></div>
    </div>
    <h3><?php echo i18n_r('tide_news/NEWS_CONTENT'); ?></h3>
    <?php echo $data['textarea']; ?>
    <p>
        <textarea class="tide_news_textarea" name="content" ><?php echo $data['content']; ?></textarea>
        <?php echo $data['rich_editor_content']; ?>
    </p>
     <h3><?php echo i18n_r('tide_news/NEWS_TAGS'); ?></h3>
     <div class="tide_admin_label" style="min-height: 60px;height: 100%;margin-bottom:20px;">
           <ul id="tags" name="tags[]">
               <?php echo $data['c_tags']; ?>
           </ul>
     </div>
     <input type="hidden" id="old_data" name="old_data" value='<?php echo $data['old_data']; ?>'/>

    <div class="clearfix"></div>
    <p id="submit_line"><input name="tide_update_news" type="submit" class="submit" value="<?php echo i18n_r('tide_news/NEWS_UPDATE'); ?>" />
        <a href="load.php?id=tide_news&amp;tide_news_overview=<?php echo $data['old_category']; ?>&amp;c_title=<?php echo $data['c_title']; ?>" class="cancel" id="cancel_edit" title="<?php echo i18n_r('tide_news/NEWS_CANCEL'); ?>"><?php echo i18n_r('tide_news/NEWS_CANCEL'); ?></a>
    </p>
</form>