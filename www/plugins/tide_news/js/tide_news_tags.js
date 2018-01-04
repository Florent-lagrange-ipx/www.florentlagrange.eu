jQuery(document).ready(function() {

    $("#start_color").ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).ColorPickerHide();
        },
        onChange: function (hsb, hex, rgb) {
            $("#start_color div").css("backgroundColor", "#" + hex);
            $("input#tags_menu_start_color").val(hex);
            $("#tags .tide_tag_item_small a").css("color", "#"+hex);
        }
    });
    $("#end_color").ColorPicker({
        onSubmit: function(hsb, hex, rgb, el) {
            $(el).ColorPickerHide();
        },
        onChange: function (hsb, hex, rgb) {
            $("#end_color div").css("backgroundColor", "#" + hex);
            $("input#tags_menu_end_color").val(hex);
            $("#tags .tide_tag_item_large a").css("color", "#"+hex);
        }
    })	
    $("#tags_font").fontselect().change(function(){
        
        // replace + signs with spaces for css
        var font = $(this).val().replace(/\+/g, " ");
          
        // split font into family and weight
        font = font.split(":");
          
        // set family on paragraphs 
        $("#tags").css("font-family", font[0]);
 
    });  
    $("#tags .tide_tag_item_small a").jfontsize({
        btnMinusClasseId: "#font_decrease_small",
        btnDefaultClasseId: "#font_reset_small",
        btnPlusClasseId: "#font_increase_small",
        inputUpdate: '#tags_font_size_min'
    });
    $("#tags .tide_tag_item_large a").jfontsize({
        btnMinusClasseId: "#font_decrease_large",
        btnDefaultClasseId: "#font_reset_large",
        btnPlusClasseId: "#font_increase_large",
        inputUpdate: '#tags_font_size_max'
       
    });
});