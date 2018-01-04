jQuery(document).ready(function() { 
    //@TODO uncheck checked 

    var loadingAjaxIndicator = $('#loader');
    $(".delete").click( function($e) {
        $e.preventDefault();
        
        var message = $(this).attr("title");

        var answer = confirm(message);
        
        if (answer){
            $(par).each(function(key){
                $(this).css("font-style", "italic");
                $(this).addClass('deletedrow'); 
            })
            $(par).each(function(key){
                if (!$(this).hasClass('noajax')) {
                    loadingAjaxIndicator.show();
    
                    $.ajax({
                        type: "GET", 
                        url: all[key],
                        async: false,
                        cache: false,

                        success: function(response){
                               
                            if($("#pg_counter").length) {
                                counter=$("#pg_counter").html();
                                $("#pg_counter").html(counter-1);
                            }
				 	
                            $('div.wrapper .updated').remove();
                            $('div.wrapper .error').remove();
                            if($(response).find('div.error').html()) {
                                $('div.bodycontent').before('<div class="error"><p>'+ $(response).find('div.error').html() + '</p></div>');
                                $("input:checkbox").prop("checked", false);
                                $(this).css("font-style", "normal");
                                popAlertMsg();
                            }
                            if($(response).find('div.updated').html()) {
                                $('div.bodycontent').before('<div class="updated"><p>'+ $(response).find('div.updated').html() + '</p></div>');
                                $(par[key]).fadeOut(2000, function(){
                                    $(this).remove();
                                })
                                popAlertMsg(); 
                            }
                        }
                    });                    
                }              
            });
              
            loadingAjaxIndicator.fadeOut(500);         
        }else {
            $(par).each(function(){
                $(this). css("font-style", "normal");
            })
            return false;
        }
        $('div.wrapper .updated').fadeOut(2000, function(){
            $('div.wrapper .updated').remove();
        });
        $('div.wrapper .error').fadeOut(2000, function(){
            $('div.wrapper .error').remove();
        });
    });
    function popAlertMsg() {	
        $(".updated").fadeOut(500).fadeIn(500);
        $(".error").fadeOut(500).fadeIn(500);
    }
    
    //    $('div.wrapper .updated').fadeOut(5000, function(){  $('div.wrapper .updated').remove();});
    //    $('div.wrapper .error').fadeOut(5000, function(){  $('div.wrapper .error').remove();});
 

    $("#selectall").click(function () {
        $('.delete_checkboxes').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".delete_checkboxes").click(function(){
 
        if($(".delete_checkboxes").length == $(".delete_checkboxes:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
 
    });
    var lastChecked = null;

  
    var $chkboxes = $('.delete_checkboxes');
    $chkboxes.live('click', function(event) {
        if(!lastChecked) {
            lastChecked = this;
            return;
        }

        if(event.shiftKey) {
            var start = $chkboxes.index(this);
            var end = $chkboxes.index(lastChecked);

            $chkboxes.slice(Math.min(start,end), Math.max(start,end)+ 1).attr('checked', lastChecked.checked);

        }

        lastChecked = this;
    });
       

})

 
 
        
  