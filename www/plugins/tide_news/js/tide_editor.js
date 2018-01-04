tideData = function(data){
    if(data == "true" || data == "false" ){
      
        if(data == "true"){
            $('div.bodycontent').before('<div class="updated"><p>Edited File Updated.</p></div>');
            $('div.wrapper .updated').fadeOut(5000, function(){
                $(this).remove();
            })
        }else if(data == "false"){
            $('div.bodycontent').before('<div class="error"><p>Fail to Update Edited File.</p></div>');
            $('div.wrapper .error').fadeOut(5000, function(){
                $(this).remove();
            })
        }
        $('.CodeMirror').fadeOut(1000, function(e){
            
            $('.CodeMirror').remove();
            $("#editor_textarea").text("");
            $("#editor_textarea").fadeIn(1000, function(ee) {
               
                $("#edited_file_path").val(""); 
            });
   
        })
               
    }else{
        if(data[1] == 'tpl'){
            data[1] = 'application/x-httpd-php';
        }
        $("#editor_textarea").html(data[0]);
        $("#edited_file_path").attr("value", data[2]);
        editor_init(data);
       
    }
}

function editor_init(data){
    $('.CodeMirror').remove();

    editor = CodeMirror.fromTextArea(document.getElementById("editor_textarea"), {
        lineNumbers: true,
        matchBrackets: true,
        indentUnit: 4,
        lineWrapping : true,
        indentWithTabs: true,
        enterMode: "keep",
        mode: data[1],
        tabMode: "shift",
        theme:"default"      
    });
    $(".CodeMirror").resizable({
   
      resize: function() {
        $(".CodeMirror-scroll").height($(this).height());
        $(".CodeMirror-scroll").width($(this).width());
      }
 })
    if(data[1] == 'css'){
        $(".CodeMirror-scroll").css({
            'height': '300', 
            'overflow': 'auto'
        });
    }

 
    var hlLine = editor.setLineClass(0, "activeline");
}
    
jQuery(document).ready(function() {

    $("#cancel_edit").click(function(event) {
        event.preventDefault();
        $('.CodeMirror').fadeOut(1000, function(e){

            $('.CodeMirror').remove();
            $("#editor_textarea").text("");
            $("#editor_textarea").fadeIn(1000, function(ee) {
                $("#edited_file_path").val(""); 
            });
        });
    });
            
})