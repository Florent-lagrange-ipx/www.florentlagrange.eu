
jQuery(document).ready(function() { 
    //@TODO uncheck checked 
    
    var loadingAjaxIndicator = $('#loader');
    $(".delete a").click( function($e) {
        $e.preventDefault();
        
        //var message = $(this).attr("title");

        newId = $(this).attr("href");
        parent = $(this).parents("tr");
        $(parent).css("font-style", "italic");
        $(parent).addClass('deletedrow'); 
        $(parent).fadeOut(2000, function(){
            $(parent).remove();
            $("#id_"+newId).remove();
              
        })
        return false;
    })
    var fixHelper = function(e, ui) {
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    };

    $("#rss_list tbody").sortable({ 
        create: function(event, ui) { 
            var order = $('#rss_list tbody').sortable('toArray');
                $("#order").val(order);
        },
        update: function(event, ui) { 
                var order = $('#rss_list tbody').sortable('toArray');
                $("#order").val(order);
    },
        helper: fixHelper
    }).disableSelection();

            
})
 