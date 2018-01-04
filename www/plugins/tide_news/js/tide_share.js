$(document).ready(function() {
    $("#code_button").click(function() {
        
        var intId = $("#share_code label").length + 1;
        var removeButton = $("<a class=\"remove\" href=\"\">remove</a>");
        var fieldWrapper = $("<label for=\"share_code_"+intId+"\" class=\"clearfix\" id=\""+intId+"\">Use ID\'s: <br /><span class=\"tide_admin_info_small\">share_code_"+intId+"/ SHARE_CODE_"+intId+"</span><br /></label>");
        var fName = $("<textarea class=\"text short\" id=\"share_code[share_code_" + intId + "]\" name=\"share_code[share_code_" + intId + "]\" ></textarea>");
        var fEnd = $("");
        
        removeButton.click(function(e) {
            e.preventDefault();
       
            $(this).parent().remove();
            if($("#share_code label").length == 0){
                $("#share_code").hide();
            }
        });

        $("#share_code").show();
        fieldWrapper.append(fName);
        fieldWrapper.append(fEnd);
        fieldWrapper.append(removeButton);
        // fieldWrapper.append(previewButton);
        $("#share_code").append(fieldWrapper);
    });
    $(".remove").click(function(e) {
        e.preventDefault();
             
        $(this).parent().remove();
        if($("#share_code label").length == 0){
            $("#share_code").hide();
        }
    })
});