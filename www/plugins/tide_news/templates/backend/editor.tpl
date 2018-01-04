<div class="tide_logo_admin">
    <img src="<?php echo SITE_URL; ?>plugins/TIDEGetSimple/images/TIDEngine.ico" />
</div>
<h3 class="tide_title_admin"><?php   echo i18n_r('tide_news/FILE_EDITOR') ?></h3>
<div class="clearfix"></div>
<form name="file_editor_form" id="file_editor_form" action="#" method="post">
    <div id="metadata_window">
        <p class="tide_admin_label">
            <label for="tide_files"><?php echo i18n_r('tide_news/FILE_EDIT'); ?>:</label>
            <?php echo $data['tide_files']; ?>
             <span class="tide_admin_info_small"><?php echo  i18n_r('tide_news/FILE_EDIT_INFO'); ?></span>
        </p>
        <p id="tide_editor" style="margin-top: 20px;">
            <input class="submit" type="submit"  value="<?php echo i18n_r('tide_news/FILE_EDIT_BTN'); ?>" name="edit_file" id="edit_file">
        </p>
        <p class="tide_admin_label tide_editable"><label for="editor_textarea"><?php echo  i18n_r('tide_news/FILE_EDIT_AREA'); ?>:</label>
            <textarea name="editor_textarea" id="editor_textarea" style="display: none;" class="text"></textarea>
        </p>
        <input type="hidden" value="" id="edited_file_path" name="edited_file_path" />

        <div class="clear"></div>

    </div>
    <p id="submit_line"><input class="submit" type="submit"  value="<?php echo i18n_r('tide_news/FILE_SAVE_BTN'); ?>" name="save_file" id="save_file">
        <a href="" class="cancel" id="cancel_edit" title="<?php echo i18n_r('tide_news/NEWS_CANCEL'); ?>"><?php echo i18n_r('tide_news/NEWS_CANCEL'); ?></a>
    </p>

</form>
