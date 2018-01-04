<?php 

    global $SITEURL; 
    
    $uploadsDirPart = str_replace(GSROOTPATH, '', GSDATAUPLOADPATH); //find name of uploads subdir
?>

<script>
    $(document).ready(function() {  
        
        //generated by php
        var fieldsData = <?php echo json_encode($fieldsData) ?>;
        var pageData = <?php echo json_encode($pageData) ?>;
        var imageFieldNames = <?php echo json_encode($imageFieldNames) ?>, //standard image fields
            specialSettings = <?php echo json_encode($specialSettings) ?>,
            isBusy = false;
        
        var $editForm = $('#editform'),
            reqImg = ' <img class="spe_img" src="../plugins/SpecialPagesExtras/img/required.png"  />';
			
		//disable default title validation used by GS, moved to external ajax validation, do not use off
		//override function
		checkTitle = function(){ return true }; 
           
        //page modifications
        if (pageData['type-show']){
            $('.main h3:first').append(' ('+ specialSettings.title +')');
        }    
 
        if (pageData['content-hide']){
            $('#post-content').closest('p').hide();
        } 
  
        if (pageData['title-label-show']){
            $('label[for="post-title"]').show();
            $editForm.addClass('title-label-visible');
        }      
        if (pageData['title-label']){
            $('label[for="post-title"]').html(pageData['title-label'])
            $('#post-title').removeAttr('placeholder');
        }    
        if (pageData['content-label-show']){
            $('label[for="post-content"]').show();
        }      
        if (pageData['content-label']){
            $('label[for="post-content"]').html(pageData['content-label']);
            $editForm.addClass('content-label-visible');
        }   
        if (pageData['content-required']){
            var $cLab = $('label[for="post-content"]');
            $cLab.html($cLab.html() + reqImg);
        }    
        if (pageData['menu-hide']){
            setTimeout(function(){
                $('.post-menu,#menu-items').hide();
            }, 0); //delay after all js execution
        }      
        if (pageData['tags-hide']){
            $('#post-metak').closest('p').hide();
        }    
        if (pageData['meta-description-hide']){
            $('#post-metad').closest('p').hide();
        }    
        if (pageData['options-show']){
            $('#metadata_toggle').remove();
            setTimeout(function(){
                $('#metadata_window').show();
            }, 0);//delay after all js execution
        }     
        
        if (pageData['extra-browser']){ //extra browser enabled so replace window.open with proxy
        
            //wait until whole page is loaded, on bottom there are i18n specialpages click handlers attached to images fields
            setTimeout(function(){
                $.each(imageFieldNames, function(index, val){
                    $('span.edit-nav a[id="browse-'+val.name+'"]')
                    .off('click')
                    .on('click', function(event){
                        event.preventDefault();
                        $.extraBrowser({
                            addImage : function(filename){
                                window['fill_sp_'+val.index]('<?php echo $SITEURL.$uploadsDirPart ?>'+filename);
                            }
                        });
                    });
                });
                
                replaceCKEImageBrowser(); 
                
            }, 500); //wait a little for special pages wysiwyg initializations and full page load
            
        }
        
        //function used to add image to multiimage by browser and when generting
		//multiimage ul holder for function
		var $spe_multiimageUl = null;
		//function used when selected image
		window.spe_multiimageSelected = function(url){
            var $cell = $('<li class="spe_image-cell"></li>'),
                $thumbDiv = thumbnailDiv();
            
            $thumbDiv.data('url', url);
            prepareThumbnail( url, $thumbDiv.find('img'), 'multi-image-thumb');
            
            $thumbDiv.find('.spe_delete').click(function(event){
                event.preventDefault();
                var $a = $(this);
                
                $a.closest('.spe_cell').find('input:first').trigger('paste'); //trigger change event !use paste!! to prevent remaking whole multiimage
                $cell.remove();
            });
        
            $cell.append($thumbDiv);
			$spe_multiimageUl.append($cell);
		};		
        
        //used when user selects image from browser
        var $spe_thumbfieldInput = null;
		//function used when selected image
		window.spe_thumbFieldImageSelected = function(url){
            $spe_thumbfieldInput.val(url).trigger('change'); //trigger change to update thumb and mark form as dirty
		};

        //field modifications
        if (fieldsData){
      
            $.each(fieldsData, function(name, fieldData){
			
                var $input = $editForm.find(':input[id="post-sp-'+ name +'"]'),
                    $speCell = $input.closest('.spe_cell'),
                    $b = $speCell.find('b');
	
                // $b.text($b.text().slice(0,-1)); //remove : char auto added
                
                if ( fieldData.description ){
                    $input.before('<div class="spe_description">' + fieldData.description + '</div>');
                }    
                
                if ( fieldData.required ){
                    $speCell.find('b:first').after(reqImg);
                }   

				if ( fieldData['new-type'] == 'multiselect' ){
                    $input
                        .hide()
                        .change(function(){ // use change handler to support changing data by language copier
                            var $inp = $(this);
   
                            $inp.siblings('.spe_multiselect').remove(); 
                        
                            var values = fieldData['options'].split('||')
								$select = $('<select class="spe_multiselect text" multiple size="'+ (values.length + 1) +'"></select>');
                
                            for (var i=0; i < values.length; i++)
                            { 
                                $select.append('<option name="'+values[i]+'">'+values[i]+'</option>');
                            }
							
							if ($inp.val()) //is something selected
								$select.val($inp.val().split('||'));
     
                            $inp.after($select);
                        })
                        .trigger('change');
                }           
                else if (fieldData['new-type'] == 'imagewiththumb'){
					$input.hide(); //hide original input
					
                    var $thumbDiv = thumbnailDiv(),
                        $img = $thumbDiv.find('img'),
                        $remove = $thumbDiv.find('.spe_delete');

					prepareThumbnail( $input.val(), $img, 'image-field-thumb');
					$input.before($thumbDiv);
						
					// on input change update thumbnail
                    $input.change(function(event){
						prepareThumbnail( $(this).val(), $img, 'image-field-thumb');
                    });
					
					var $button = $('<button type="button" class="spe"><?php i18n('SpecialPagesExtras/BROWSE') ?></button>');
					$input.before($button);	//add browse button	
                    
                    $remove.click(function(event){
                        event.preventDefault();
                        $input.val('').trigger('change');
                    });

					$button.click(function(){
                        $spe_thumbfieldInput = $input; //sotre used input
                        
						if (pageData['extra-browser']){
							$.extraBrowser({
								addImage : function(filename){
									spe_thumbFieldImageSelected('<?php echo $SITEURL.$uploadsDirPart ?>'+filename);
								}
							});
						}
						else{
 
							window.open('<?php echo $SITEURL; ?>plugins/i18n_specialpages/browser/filebrowser.php?func=spe_thumbFieldImageSelected&type=images', 'browser', 'width=800,height=500,left=100,top=100,scrollbars=yes');
						}
					});
					
				}
                else if (fieldData['new-type'] == 'multitext'){				
                    $input
                        .hide()
                        .change(function(){ // use change handler to support changing data by language copier
                            var $inp = $(this);
   
                            $inp.siblings('.spe_multitext').remove(); 
                        
                            var values = $inp.val().split('||'),
                                html = '<div class="spe_multitext">';
                            
                            for (var i=0; i < values.length; i++)
                            { 
                                html += multiTextRow(values[i]);
                            }
                            html += '<button type="button" class="spe"><?php i18n('SpecialPagesExtras/ADD') ?></button>';
                            html += '</div>';
                            
                            var $multiDiv = $(html);
     
                            $inp.closest('.spe_cell').append($multiDiv);
                            
                            //sortable fields
                            $multiDiv.sortable();
                            
                        })
                        .trigger('change');
                }
				else if (fieldData['new-type'] == 'multiimage'){
                    $input
                        .hide()
                        .change(function(){ // use change handler to support changing data by language copier
                            var $inp = $(this);
                            $inp.siblings('.spe_multiimage').remove(); 
                        
                            var val = $inp.val(),
								values = val ? val.split('||') : [],
                                $div = $('<div class="spe_multiimage"></div>'),
                                $ul = $('<ul></ul>'),
                                $add = $('<button type="button" class="spe"><?php i18n('SpecialPagesExtras/ADD') ?></button>');

                            //set last ul
                            $spe_multiimageUl = $ul;
                            //function used when selected image
                            for (var i=0; i < values.length; i++){ 
                                window.spe_multiimageSelected(values[i]);
                            }
                            
                            $div.append($ul);
                            $div.append($add);
                            
                            $inp.closest('.spe_cell').append($div);
                            
                            //sortable fields
                            $div.find('> ul').sortable();
                        })
                        .trigger('change');
                }
            });
        }
        
        //multitext delete handler
        $editForm.on('click', '.spe_multitext a.spe_delete', function(event){
            event.preventDefault();
            
            var $a = $(this);
            $a.closest('spe_cell').find('input:first').trigger('paste'); //trigger change event, use paste!
            $a.closest('.spe_row').remove();
        });    
        
        //multitext add handler
        $editForm.on('click', '.spe_multitext button.spe', function(event){
            event.preventDefault();
            
            var $button = $(this);
            $button.before(multiTextRow(''));
            $button.closest('.spe_cell').find('input:first').trigger('paste'); //trigger change event use paste!
        });  
		
		//multiimage add handler
        $editForm.on('click', '.spe_multiimage button.spe', function(event){
            event.preventDefault();
            
            var $a = $(this),
				$ul = $a.siblings('ul:first');
				
            $spe_multiimageUl = $ul;
            
            if (pageData['extra-browser']){
                $.extraBrowser({
                    multipleSelection : true,
                    addImage : function(filename){
                        spe_multiimageSelected('<?php echo $SITEURL.$uploadsDirPart ?>'+filename);
                    }
                });
            }
            else{
                window.open('<?php echo $SITEURL; ?>plugins/i18n_specialpages/browser/filebrowser.php?func=spe_multiimageSelected&type=images', 'browser', 'width=800,height=500,left=100,top=100,scrollbars=yes');
            }
			
            
            $a.closest('.spe_cell').find('input:first').trigger('paste'); //trigger change event use paste!
        });
		

        var openOptions = false,
			skipAsyncValidation = false; //used when async validation passed
			
        $editForm.submit(function(event){    
			
            if (isBusy){
                event.preventDefault();
                return;
            }
            
            isBusy = true;

            //fill multitext
            $editForm.find('.spe_multitext').each(function(){
                var $multiText = $(this),
                    $input = $multiText.siblings('input[type="text"]'),
                    vals = [];
                    
                $multiText.find('input').each(function(){
                    var val = $(this).val(); //remove empty fields
                    
                    vals.push(val);
                });
                
                $input.val(vals.join('||'));
            });  

			//fill multiimage
            $editForm.find('.spe_multiimage').each(function(){
                var $multiImage = $(this),
                    $input = $multiImage.siblings('input[type="text"]'),
                    vals = [];
                    
                $multiImage.find('.spe_thumbnail').each(function(){
                    var val = $(this).data('url');
                    
                    if (val)
                        vals.push(val);
                });
                
                $input.val(vals.join('||'));
            });  


            $editForm.find('.spe_multiselect').each(function(){
                var $multiSelect = $(this),
                    $input = $multiSelect.siblings('input[type="text"]'),
					vals = $multiSelect.val();

                $input.val(vals ? vals.join('||') : '');
				
				// alert($input.val());
            });  
		
                
            if (typeof CKEDITOR != 'undefined' && CKEDITOR.instances){
                //update now
                for(var i in CKEDITOR.instances) {
                   /* this updates the value of the textarea from the CK instances.. */
                   CKEDITOR.instances[i].updateElement();
                }
            }
			
			if (skipAsyncValidation){
				skipAsyncValidation = false; //used when title is empty and first validation async is passed
				return true;
			}

			lockUI();

			$.ajax({
				type: 'POST',
				url: '../plugins/SpecialPagesExtras/validator/?cachebust=' + (new Date()).getTime(),
				data: $editForm.serialize(),
				dataType: 'json'
			})
			.done(function(data){
                isBusy = false;
                
                //clear previous errors
                unmarkInvalids();
				
				//title validation empty
				if (data['validation-failed'] === false){ //success  
					warnme = false; //set flag of exit warning to disable it
					skipAsyncValidation = true;
					$('#page_submit').trigger('click'); //submit form
				}		
				else if (data['validation-failed'] === true && data['fields']){ //fields failed 
					unlockUI();
                    
					$.each(data['fields'], function( postName, value ) {					
						var name = postName.replace(/post-sp-|post-/g, ''), //remove 'post-sp-' or post- (title need this)
 							newType = fieldsData && fieldsData[name] ? fieldsData[name]['new-type'] : ''; //can be not in fields data (post content) or fieldsdata can not exists
							
						if (value === true) //validation passed
							return; //jquery continue
					
							//main input for field
						var $input = $editForm.find('*[name="' + postName+ '"]');

 						if (newType == 'multitext'){ //is multitext
							$.each(value, function( i, fieldIndex ) {
								var $rowInp = $input.siblings('.spe_multitext').find('.spe_row:eq('+fieldIndex+') input');

								if (!$rowInp.length) //row not found so mark add button
									$input.siblings('.spe_multitext').find('button.spe').addClass('spe_validation-error');
								else
									$rowInp.addClass('spe_validation-error');
								
								openOptions = true;
							});
						}				
                        else if (newType == 'multiimage'){ //is multiimage
                            if (value === false){ //strict to not treat 0 as false
                                $input.siblings('.spe_multiimage').find('button.spe').addClass('spe_validation-error');
                            }
                            else{
                                $.each(value, function( i, fieldIndex ) {
                                    var $imageCell = $input.siblings('.spe_multiimage').find('.spe_image-cell:eq('+fieldIndex+')');

                                    $imageCell.addClass('spe_validation-error');
                                });
                            }
                            openOptions = true;
						}
                        else{ //normal field or content field
							var $speCell = $input.closest('.spe_cell'); //p is for title field
							
							if ($speCell.length){ //special field
								if ($input.next('span[id^="cke_"]').length) //is cke editor
									$input.next('span[id^="cke_"]').addClass('spe_validation-error');
								else
									$speCell.addClass('spe_validation-error');
							}
							else{ //title or content
								$input.addClass('spe_validation-error'); //title
								
								
								//if its post content
								if ($input.attr('id') == 'post-content'){
									$input.closest('p').addClass('spe_validation-error');
								}
							}
							
							//is part of special fields
							if ($input.closest('.spe_special-container').length)
								openOptions = true;
						}
					});
					
					showValidationError();
				}
				else{
					alert('SpecialPagesExtras: async validation failed.');
				}
			})
			.fail(function(){
				alert('SpecialPagesExtras: async validation error.');
			});
			
			event.preventDefault();
        });
		
		
		function lockUI(){
			$editForm.animate({opacity: 0.5}); //pseudo lock
			
			$editForm.on("keydown.spe keypress.spe keyup.spe", keyboardLocker);
		}	

		function unlockUI(){
			$editForm.stop().css('opacity', '');
			
			$editForm.off('.spe');
		}
		
		function keyboardLocker(event){
			event.preventDefault();
		}
		
		function showValidationError(){
			if (openOptions && $('#metadata_window').is(':hidden') ){
                $('#metadata_window').slideToggle('fast');
                $('#metadata_toggle').toggleClass('current');
            }
		
			//there are some errors
            if ($editForm.find('.spe_validation-error').length){
                $('.notify_error').remove();

                var m = notifyError("<?php i18n('SpecialPagesExtras/VALIDATION_ERROR');?>");
                
                setTimeout(function(){
                    m.popit();
                }, 400);
                            
                var top = $('html').scrollTop() || $('body').scrollTop(); //for chrome
                if (top > 120){
                    $('body,html').animate({scrollTop: 0}, 400);
                }
            }   
		}
		
		function unmarkInvalids($input){
			$editForm.find('.spe_validation-error').removeClass('spe_validation-error');
		}
        
		//prepares div holding thumbnail
        function prepareThumbnail(imgUrl, $img, mode){
			$img.off().removeAttr('src'); //stop loading, mainly used when change event is dispatched
			
            $img.attr('title', imgUrl);
            
			$img.siblings('.spe_error,.spe_empty').hide();
            
			if (!imgUrl){ //no source show empty
                $img.closest('.spe_thumbnail').find('.spe_delete').hide();
				$img.hide();
				$img.siblings('.spe_empty').show(); //do not use show(), jquery cannot find whats initial state of div
				return;
			}

			$img.show().on('load error', function(event){
				$img.off();
                $img.closest('.spe_thumbnail').find('.spe_delete').show();
				if (event.type == 'error')
					$img.hide().siblings('.spe_error').show();
			})
			.attr('src', findThumbSrc(imgUrl, mode))
        }   

		function findThumbSrc(imgUrl, mode){
            return '../plugins/SpecialPagesExtras/thumb/?mode=' + mode + '&img='+ encodeURIComponent(imgUrl);
        }     
        
        //creates div with thumb used in fieldwiththumb and multiimage
        function thumbnailDiv(){
            var $thumb = $('<div class="spe_thumbnail"></div>'),
                $wrap = $('<div class="spe_wrap"></div>'),
                $error = $('<div class="spe_error"><?php i18n('SpecialPagesExtras/FIELD_IMAGE_ERROR');?></div>').hide(),
                $empty = $('<div class="spe_empty"><?php i18n('SpecialPagesExtras/FIELD_IMAGE_NOT_SELECTED');?></div>').hide(),
                $remove = $('<a href="#" class="spe_delete"></a>').hide(),
                $img = $('<img/>').hide();
                
            $thumb.append($wrap).append($remove);
                
            $wrap.append($error)
                .append($empty)
                .append($img);
                
            return $thumb;
        }

        function multiTextRow(value, empty){
            return '<div class="spe_row"><div class="spe_image-cell">' + (empty ? '' : '<input type="text" class="text" value="'+value.replace(/"/g, '&quot;')+'" />')+'</div><div class="spe_image-cell spe_narrow">'+ (empty ? '' : '<a href="#" class="spe_delete" title="<?php i18n('SpecialPagesExtras/DELETE') ?>"></a>')+ '</div><div class="spe_image-cell spe_drag"><img class="spe_img" src="../plugins/SpecialPagesExtras/img/drag.png"  /></div></div>'
        } 
        
        /* 
        * Replaces CKE editor image browser for extrabrowser 
        */
        function replaceCKEImageBrowser(){
            if (typeof CKEDITOR != 'undefined' && CKEDITOR.instances){

                for(var i in CKEDITOR.instances) { //iterate over instances of ckeeditor
                   var oldP = CKEDITOR.instances[i].popup;

                   CKEDITOR.instances[i].popup = function(url){ //change some things in popup plugin to open extrabrowser
                        var funcNm = parseInt(getParamByName('CKEditorFuncNum', url)),
                            type = getParamByName('type', url);

                        if (type == 'images'){
                            $('#extraBrowser').css('z-index', 10099); //move above dialog
                            $.extraBrowser({
                                addImage : function(filename){
                                    CKEDITOR.tools.callFunction( funcNm, '<?php echo $SITEURL.$uploadsDirPart ?>'+filename);
                                }
                            });
                            return true;
                        }
                        
                        return oldP.apply(this, arguments); //no images call default one
                   };

                }
            }
        }
        
        //used to find parameter value in query string, needed for overriding CKE editor popup
        function getParamByName(name, queryString) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(queryString);
            return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }
		
		function checkTitleEmpty(){
			return $.trim($("#post-title").val()).length == 0;
		}
    });
</script>