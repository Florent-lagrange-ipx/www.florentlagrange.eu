<form class="largeform" action="load.php?id=tide_news&amp;tide_news_settings&amp;subpage=tidenews_tags" method="post" accept-charset="utf-8">
    <div id="metadata_window" >
        <h3><?PHP  echo i18n_r('tide_news/S_TAGS'); ?></h3>
        <div class="leftopt">
            <p class="tide_admin_label ch_box" >
                <label for="use_share_this" >
                    <?php echo i18n_r('tide_news/S_TAGS_ENABLE'); ?>               
                </label> 
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_TAGS_ENABLE_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="tags_menu_status"  id="tags_menu_status"  <?php echo $data['tags_menu_status']; ?> />         
            </p> 
            <p class="tide_admin_label"><label for="tags_title"><?php echo i18n_r('tide_news/S_TAGS_MENU_TITLE'); ?>:</label>
                <input type="text" value="<?php echo $data['tags_title']; ?>" name="tags_title" id="tags_title" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_TAGS_MENU_TITLE_INFO'); ?></span>
            </p>  
            <p class="tide_admin_label"><label for="tags_title_category"><?php echo i18n_r('tide_news/S_TAGS_MENU_TITLE_CAT'); ?>:</label>
                <input type="text" value="<?php echo $data['tags_title_category']; ?>" name="tags_title_category" id="tags_title_category" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_TAGS_MENU_TITLE_CAT_INFO'); ?></span>
            </p>   
            <p class="tide_admin_label" ><label for="tags_occurence"><?php echo i18n_r('tide_news/S_TAGS_OCCURENCE'); ?>:</label>	
                <?php echo $data['tags_occurence']; ?>
                <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/S_TAGS_OCCURENCE_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="tags_size"><?php echo i18n_r('tide_news/S_TAGS_SIZE_TYPE'); ?>:</label>	
                <?php echo $data['tags_size']; ?>
                <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/S_TAGS_SIZE_TYPE_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="tags_min_length"><?php echo i18n_r('tide_news/S_TAGS_MENU_LENGTH'); ?>:</label>
                <?php echo $data['tags_min_length']; ?>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_TAGS_MENU_LENGTH_INFO'); ?></span>
            </p>
        </div>
        <div class="rightopt" style="height: 200px;">
            <p class="tide_admin_label">
                <label><?php  echo i18n_r('tide_news/S_TAGS_COLORS'); ?>: </label>
                <div class="tide_color_picker">
                    <div class="colorSelector_holder"><div class="tide_title"><?php echo i18n_r('tide_news/S_TAGS_END_COLOR'); ?>:</div><div class="colorSelector" id="end_color"><div style="background-color: #<?php  echo $data['tags_menu_start_color']; ?>"></div></div></div>
                    <div class="colorSelector_holder"><div class="tide_title"><?php echo i18n_r('tide_news/S_TAGS_START_COLOR'); ?>:</div><div class="colorSelector" id="start_color"><div style="background-color: #<?php  echo $data['tags_menu_end_color']; ?>"></div></div></div>
                    <span class="tide_admin_info_small" style="position: relative;margin: -60px -30px 0 0;"><?php echo i18n_r('tide_news/S_TAGS_COLORS_INFO'); ?></span>
                </div>
                <div class="clearfix"></div>
                <input type="hidden" value="<?php echo $data['tags_menu_start_color']; ?>" name="tags_menu_start_color" id="tags_menu_start_color" class="text short" />            
                <input type="hidden" value="<?php echo $data['tags_menu_end_color']; ?>" name="tags_menu_end_color" id="tags_menu_end_color" class="text short" />           
            </p>
            <p class="tide_admin_label" style="height: 100px;margin-top: -40px;">
                <label><?php  echo i18n_r('tide_news/S_TAGS_SIZE'); ?>: </label>
            <div style="position: relative; top: -90px; left: 20px;">

                <div class="font_size_holder"><div class="tide_title"><?php echo i18n_r('tide_news/S_TAGS_SIZE_MIN'); ?>:</div>
                    <div style="">
                        <span id="font_decrease_large" class="jfontsize-button-decrease"><a href=""></a></span>                      
                        <span id="font_reset_large" class="jfontsize-button-reset"><a href=""></a></span>
                        <span id="font_increase_large" class="jfontsize-button-increase"><a href=""></a></span>
                    </div>  
                </div> 
                <div class="clearfix"></div>
                <div class="font_size_holder"><div class="tide_title"><?php echo i18n_r('tide_news/S_TAGS_SIZE_MAX'); ?>:</div>
                    <div style="">
                        <span id="font_decrease_small" class="jfontsize-button-decrease"><a href=""></a></span>
                        <span id="font_reset_small" class="jfontsize-button-reset"><a href=""></a></span>
                        <span id="font_increase_small" class="jfontsize-button-increase"><a href=""></a></span>

                    </div>
                </div>
                <span class="tide_admin_info_small" style="margin: 15px 30px 0 0"><?php echo i18n_r('tide_news/S_TAGS_SIZE_INFO'); ?></span>

            </div>
            <input type="hidden" value="<?php echo $data['tags_font_size_min']; ?>" name="tags_font_size_min" id="tags_font_size_min" class="text short">            
            <input type="hidden" value="<?php echo $data['tags_font_size_max']; ?>" name="tags_font_size_max" id="tags_font_size_max" class="text short">           
            </p>
            <p class="tide_admin_label" style="position: relative; top: -60px; height: 85px;">
            <div  style="position: relative; top: -165px;">
                <label for="tags_font"><?php  echo i18n_r('tide_news/S_TAGS_FONT'); ?>: </label>
                <input type="text" value="<?php echo $data['tags_font']; ?>" name="tags_font" id="tags_font" class="text short"> 
                <span class="tide_admin_info_small" style="position: relative;margin: 10px 10px 0 0;"><?php echo i18n_r('tide_news/S_TAGS_FONT_INFO'); ?></span>
            </div>
            </p> 

        </div>      
        <div class="clear"></div>
    </div>
    <p id="submit_line">
        <span><input type="submit" value="Save Settings" name="tide_settings_save" class="submit"></span>
    </p>

</form>

