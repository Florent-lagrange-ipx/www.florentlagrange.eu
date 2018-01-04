jQuery(document).ready(function() {
  
    var $buttons  = $( "#toolbar_buttons");
    $( "#toolbar_buttons").sortable({
        revert: 'invalid',
        connectWith: ".docking",
        opacity: 0.6,
        receive: function( event, ui ) {
            updatePostOrder();
        }
    });
        
    for (i=0; i<5; i++){
        $( "#docking_area_"+ i ).sortable({
            revert: 'invalid',
            connectWith: ".docking",
            opacity: 0.6,
            receive: function( event, ui ) {
                updatePostOrder();
            },
            stop: function(event, ui) {
                updatePostOrder();    
            }
        });
     
        $( "#docking_area_"+ i ).disableSelection();
    }
       
    $("toolbar_buttons" ).disableSelection();    
    $('#dev_area_btn').click(function(event) {  
         event.preventDefault();
        $('#cke_code_area').slideToggle('slow', function() {});
    });      
    $('#cfg_area_btn').click(function(event) { 
         event.preventDefault();
        $('#config_file_content').slideToggle('slow', function() {
            editor = CodeMirror.fromTextArea(document.getElementById("cke_config"), {
                lineNumbers: true,
                matchBrackets: true,
                indentUnit: 4,
                lineWrapping : true,
                indentWithTabs: true,
                enterMode: "keep",
                mode: "javascript",
                tabMode: "shift",
                theme:"default"      
            });

            var hlLine = editor.setLineClass(0, "activeline");
        });
    }); 
    
    
    $("#ckeditor_type").live('change', function() {
        var selected = $(this).val();
        if(selected == 'custom'){
            $('#cke_custom_settings').slideToggle('slow', function() {});
        }else{
            if ($("#cke_custom_settings").is(":hidden")) {
             
            } else {
                $('#cke_custom_settings').slideToggle('slow', function() {});
            } 
        }   
    });
    $("#show_styles").fancybox({
        "width"                 : "300",
        "height"                : "500",
        "autoScale"     	: true,
        "scrolling"             : "no",
        "titlePosition"		: "inside",
        "transitionIn"		: "elastic",
        "transitionOut"		: "elastic"
    });
});
	
function updatePostOrder() { 

    order = [];
    test = [];
    for (i=0; i<5; i++){
        $( "#docking_area_"+ i).children('div').each(function(idx, elm) {
            order.push($(elm).attr('id'));   
        });  
        test[i] = order;
        order = [];
    }    
    string = '"';
    $.each(test, function(index, value){
        string += '[';
        $.each(value, function(ind, button){
             
            if(button == value[value.length-1]){
                string += "'"+ button + "'";
            }else{
                string += "'"+ button + "',"; 
            }          
        })
        if(value == test[test.length-1]){
            string += ']';
        }else{
            string += ']' + ",'/',";         
        }
    });
    string += '"';
    $("#cke_data").val(string);

}
