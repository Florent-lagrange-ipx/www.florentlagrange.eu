<form class="largeform" action="load.php?id=tide_news&amp;tide_category&amp;subpage=tide_create_category" method="post" accept-charset="utf-8">
    <p id="title_holder"><input class="text title" name="category_title" id="category_title" type="text" value="<?php echo $data['category_title']; ?>" placeholder="<?php echo  i18n_r('tide_news/CATEGORY_TITLE'); ?>" /></p>  
    <div class="clear" ></div> 
    <div id="metadata_window" > 
        <div class="leftopt">
            <p class="tide_admin_label">
                <label for="category_slug"><?php echo i18n_r('tide_news/CATEGORY_SLUG'); ?></label>
                <input class="text short" id="category_slug" name="category_slug" value="<?php echo $data['category_slug']; ?>" type="text">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/CATEGORY_SLUG_INFO'); ?></span>
            </p>  
            <p class="tide_admin_label">
                <label for="keywords"><?php echo i18n_r('tide_news/NEWS_META_KEYWORDS'); ?></label>
                <input class="text short" id="keywords" name="keywords" value="<?php echo $data['keywords']; ?>" type="text">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/NEWS_META_KEYWORDS_INFO'); ?></span>
            </p>     
        </div>
        <div class="rightopt">
            <p class="tide_admin_label" style="height: 120px;"> <label for="pages"><?php echo i18n_r('tide_news/CATEGORY_PAGES'); ?>:</label>	
                <?php echo $data['pages']; ?>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/CATEGORY_PAGES_INFO'); ?></span>
                <span class="edit-nav" style="font-style: normal">
                 <a href="edit.php" target="_blank"><?php echo i18n_r('tide_news/CATEGORY_ADD_PAGES'); ?></a>  
                  <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/CATEGORY_ADD_PAGES_INFO'); ?></span>
                </span>
                
            </p>
            <p class="inline clearfix tide_admin_label" >
                <label  for="category_visibility"><?php echo i18n_r('tide_news/CATEGORY_VISIBILITY'); ?> &nbsp; </label>
                <?php echo $data['category_visibility']; ?>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/CATEGORY_VISIBILITY_INFO'); ?></span>
            </p>
        </div>
        <div class="clear"></div>
        <p class="tide_admin_label meta_dsc">
            <label for="metad" class="clearfix"><?php echo i18n_r('tide_news/CATEGORY_META_DESCRIPTION'); ?>
                <span id="countdownwrap"><strong id="countdown">155</strong> characters remaining</span></label>
            <textarea class="text short" id="metad" name="metad"><?php echo $data['metad']; ?></textarea>
            <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/CATEGORY_META_DESCRIPTION_INFO'); ?></span>
        </p>
    </div>
    <p id="submit_line">
        <span><input type="submit" value="Create Category" name="tide_category_save" class="submit"></span>
    </p>

</form>