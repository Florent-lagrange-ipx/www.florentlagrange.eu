jQuery(document).ready(function() { 
    
    $("#feed_image").live('change', function() {
       
        var src = $(this).val();

        $("#feed_im_prew").attr('src', "../data/uploads/" + src );
    });
    $("#feed_icon").live('change', function() {
        var src = $(this).val();

        $("#feed_ico_prew").attr('src',  "../plugins/tide_news/icons/" + src  );
    });
});