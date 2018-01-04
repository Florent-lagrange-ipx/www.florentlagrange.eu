<form class="largeform" action="load.php?id=tide_news&amp;tide_news_settings&amp;subpage=tidenews_share" method="post" accept-charset="utf-8">
    <div id="metadata_window"  >
        <h3><?PHP  echo i18n_r('tide_news/S_MENU_SHARE'); ?></h3>
        <div class="leftopt" style="height: 1000px;">
      <p class="tide_admin_label ch_box" >
                <label for="use_addthis" >
                    <?php echo i18n_r('tide_news/S_MENU_ADDTHIS_ENABLE'); ?>               
                </label> 
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_ADDTHIS_ENABLE_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="use_addthis"  id="use_addthis"  <?php echo $data['use_addthis']; ?> />         
            </p> 
            <p class="tide_admin_label">
                <label for="addthis_key"><?php  echo i18n_r('tide_news/S_MENU_ADDTHIS_KEY'); ?>:</label>
                <input type="text" value="<?php echo $data['addthis_key']; ?>" name="addthis_key" id="addthis_key" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_ADDTHIS_KEY_INFO'); ?></span>
            </p>
            <p class="tide_admin_label ch_box"><label for="addthis_bar"><?php  echo i18n_r('tide_news/S_MENU_ADDTHIS_ADDRESS'); ?>:</label>
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_ADDTHIS_ADDRESS_INFO'); ?></span>
                 &nbsp;&nbsp;&nbsp;<input type="checkbox" name="addthis_bar"  id="addthis_bar"  <?php echo $data['addthis_bar']; ?> /> 
            </p>
            <p class="tide_admin_label" style="height: 80px;border: 2px solid #ccc;">
                <label class="clearfix">Use ID's: <br>
                    <span class="tide_admin_info_small">share_code_1/ SHARE_CODE_1</span></label>
                    <em id="addthis_1"></em>
            </p>
              <p class="tide_admin_label" style="height: 90px;border: 2px solid #ccc;">
                <label class="clearfix">Use ID's:<br>
                    <span class="tide_admin_info_small">share_code_2/ SHARE_CODE_2</span></label>
                    <em id="addthis_2"></em>
            </p>
            <p class="tide_admin_label" style="height: 70px;border: 2px solid #ccc;">
                <label class="clearfix">Use ID's: <br>
                    <span class="tide_admin_info_small">share_code_3/ SHARE_CODE_3</span></label>
                    <em id="addthis_3"></em>
            </p>
            <p class="tide_admin_label" style="height: 70px;border: 2px solid #ccc;">
                <label class="clearfix">Use ID's: <br>
                    <span class="tide_admin_info_small">share_code_4/ SHARE_CODE_4</span></label>
                    <em id="addthis_4"></em>
            </p>
            <p class="tide_admin_label" style="height: 360px;border: 2px solid #ccc;">
                 <label class="clearfix">Use ID's:</label>
                <div style="position: relative; top: -350px;margin-right: 10px;">
                <span class="tide_admin_info_small">1. share_code_5/ SHARE_CODE_5</span>
                <span class="tide_admin_info_small">2. share_code_6/ SHARE_CODE_6</span>
                <span class="tide_admin_info_small">3. share_code_7/ SHARE_CODE_7</span></div>
            <div style="position: relative; top: -350px;">
                <em id="addthis_5"></em>
                <em id="addthis_6"></em>
                <em id="addthis_7"></em>
</div> <div class="clear"></div>
            </p>
        </div>
        <div class="rightopt">
       <p class="tide_admin_label ch_box" >
                <label for="use_share_this" >
                    <?php echo i18n_r('tide_news/S_MENU_SHARETHIS_ENABLE'); ?>               
                </label> 
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_SHARETHIS_ENABLE_INFO'); ?></span>
                &nbsp;&nbsp;&nbsp;<input type="checkbox" name="use_share_this"  id="use_share_this"  <?php echo $data['use_share_this']; ?> />         
            </p> 
            <p class="tide_admin_label">
                <label for="sharethis_key"><?php  echo i18n_r('tide_news/S_MENU_SHARETHIS_KEY'); ?>:</label>
                <input type="text" value="<?php echo $data['sharethis_key']; ?>" name="sharethis_key" id="sharethis_key" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_SHARETHIS_KEY_INFO'); ?></span>
            </p>
            <p class="tide_admin_label"><label for="twitter_login"><?php  echo i18n_r('tide_news/S_MENU_SHARETHIS_TWITER'); ?>:</label>
                <input type="text" value="<?php echo $data['twitter_login']; ?>" name="twitter_login" id="twitter_login" class="text short">
                <span class="tide_admin_info_small"><?php echo i18n_r('tide_news/S_MENU_SHARETHIS_TWITER_INFO'); ?></span>
            </p>
            <p class="tide_admin_label">
                <label for="code_button"><?php  echo i18n_r('tide_news/S_MENU_SHARETHIS_CODE'); ?>:</label>
                <input type="button" value="Add ShareThis Code" class="code_button" id="code_button" />
            </p>
            <?php echo $data['sharethis_code']; ?>
             <p class="tide_admin_label tide_share_holder" id="share_code" style="display: none;"></p>
        </div>      
        <div class="clear"></div>
    </div>
    <p id="submit_line">
        <span><input type="submit" value="Save Settings" name="tide_settings_save" class="submit"></span>
    </p>

</form>