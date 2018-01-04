<form name="ckeditor" action="#" method="post">
    <p class="inline">
        <label for="highlighter"><?php echo i18n_r('tide_news/CKE_INTEGRATE'); ?>:</label>
        <?php echo $data['highlighter']; ?>
        <span style="color: #ccc;padding:3px;"><?php echo i18n_r('tide_news/CKE_INFO'); ?></span>

    </p>
    <p class="inline">
        <label for="highlight_styles"><?php echo i18n_r('tide_news/CKE_STYLES'); ?>:</label>
        <?php echo $data['highlight_styles']; ?>
        <span style="color: #ccc;padding:3px;"><?php echo i18n_r('tide_news/CKE_STYLES_INFO'); ?></span>

    </p>
    <p class="inline">
        <label for="ckeditor_type"><?php echo i18n_r('tide_news/CKE_TYPE'); ?>:</label>
        <?php echo $data['ckeditor_type']; ?>
        <span style="color: #ccc;padding:3px;"><?php echo i18n_r('tide_news/CKE_TYPE_INFO'); ?></span>
    </p>
    <p style="text-align: right;"><input class="submit" type="submit" onclick="warnme=false;" value="<?php echo i18n_r('tide_news/CKE_UPDATE'); ?>" name="submitted"></p>
</form>