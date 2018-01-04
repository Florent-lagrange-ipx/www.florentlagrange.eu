jQuery(document).ready(function() {
    
    
    $('div.wrapper .updated').fadeOut(2000, function(){  $('div.wrapper .updated').remove();});
    $('div.wrapper .error').fadeOut(10000, function(){  $('div.wrapper .error').remove();});
    
      $('#summary_btn').click(function(event) { 
          event.preventDefault();
        $('#news_summary').slideToggle('slow', function() {});
    });  
function updateMetaDescriptionCounter() {
	  var remaining = 155 - jQuery('#metad').val().length;
	  jQuery('#countdown').text(remaining);
	}
	if ($('#metad').length) {
		updateMetaDescriptionCounter();
	  $('#metad').change(updateMetaDescriptionCounter);
	  $('#metad').keyup(updateMetaDescriptionCounter);
	}
	 

})
