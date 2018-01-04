<form class="largeform" action="load.php?id=tide_news&amp;tide_news_settings&amp;subpage=tidenews_ckeditor" method="post" accept-charset="utf-8">
    <div id="metadata_window" >
        <h3><?PHP  echo i18n_r('tide_news/CKE_SETTINGS'); ?></h3>
        <div class="leftopt">
            <p class="tide_admin_label">
                <label for="cke_in_use"><?php echo i18n_r('tide_news/CKE_USE'); ?> :</label>
                <?php echo $data['cke_in_use']; ?> 
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/CKE_USE_INFO'); ?></span>              
            </p>           
            <p class="tide_admin_label" >
                <label for="cke_languages"><?php echo i18n_r('tide_news/CKE_LANG'); ?>:</label>
                <?php echo $data['cke_languages']; ?>
                <span  class="tide_admin_info_small"><?php echo i18n_r('tide_news/CKE_LANG_INFO'); ?></span>
            </p>
             <p class="tide_admin_label"><label for="cke_height"><?php  echo i18n_r('tide_news/CKE_HEIGHT'); ?>:</label>
                <input type="text" value="<?php echo $data['cke_height']; ?>" name="cke_height" id="cke_height" class="text short" />
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/CKE_HEIGHT_INFO'); ?></span>
            </p>            
        </div>
        <div class="rightopt">
            <p class="tide_admin_label" >
                <label for="highlighter"><?php echo i18n_r('tide_news/CKE_INTEGRATE'); ?>:</label>
                <?php echo $data['highlighter']; ?>
                <span  class="tide_admin_info_small"><?php echo i18n_r('tide_news/CKE_INFO'); ?></span>
            </p>
            <p class="tide_admin_label" >
                <label for="highlight_styles"><?php echo i18n_r('tide_news/CKE_STYLES'); ?>:</label>
                <?php echo $data['highlight_styles']; ?>
                <span  class="tide_admin_info_small">
                    <a id="show_styles" title="Integrated Styles" href="#styles_list">
                        <?php echo i18n_r('tide_news/CKE_STYLES_INFO'); ?>
                    </a>              
                </span>

            </p>
            <p class="tide_admin_label" >
                <label for="ckeditor_type"><?php echo i18n_r('tide_news/CKE_TYPE'); ?>:</label>
                <?php echo $data['ckeditor_type']; ?>
                <span  class="tide_admin_info_small"><?php echo i18n_r('tide_news/CKE_TYPE_INFO'); ?></span>
            </p>
        </div>      
        <div class="clear"></div>
        <div id="styles_list" style="display: none; background-color: #000; border: none;text-align: center; padding: 10px;">
            <?php echo $data['images']; ?> 
        </div>
        <div id="cke_custom_settings" style="display: none">
            <div class='tide_cke_simulation' >
                <div class="docking"  id="toolbar_buttons" style="border:none;">
                    <?php echo $data['cke_toolbar']; ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clearfix"></div>

            <div class="tide_new_line">
                Just drag and drop buttons to adjust your toolbar  <span id="dev_area_btn" style="cursor: pointer">Show/Hide Code</span>
            </div>
            <div class='tide_cke_simulation' id="drop">
                <div class="docking" id="docking_area_0"></div>
                <div class="docking" id="docking_area_1"></div>
                <div class="docking" id="docking_area_2"></div>
                <div class="docking" id="docking_area_3"></div>
                <div class="docking" id="docking_area_4"></div>
            </div>
            <p id="cke_code_area" style="display:none;">
                <textarea id="cke_data" name="cke_data" class="textareas"></textarea>
            </p>
        </div>
    </div>
    <p id="submit_line">
        <span><input type="submit" value="Save Settings" name="tide_settings_save" class="submit"></span>
    </p>
</form>