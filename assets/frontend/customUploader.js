
function formatBytes(bytes, decimals) {
	if(!decimals) {
		decimals = 2;
	}
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
var formUtils  ={
	validateStep:  function(step){ 
		var _isValid = true, _elem=false;
		
		$('[data-parsley-group=step_'+step+']').each(function(i,v){			
			
			if(!$(this).valid()){
				if(!_elem){
					_elem = this;
				}
			 _isValid = false;
		   }
			
		});	
		if(!_isValid){
			formUtils.scrollToFirstErrorElement(_elem);
			
			setTimeout(function(){
				$(_elem).focus();
			},1100);
		}
		return _isValid; 
	},
	scrollToFirstErrorElement:function(_elem){
		$('html, body').animate({
			scrollTop: $(_elem).offset().top - ( $('#header').height() + 50 )  
		}, 1000);
	},
	initCharacterCounter:function(){
		$('[data-length]').each(function () {
			var this_ = $(this),
			  max_ch = this_.data('length'),
			  curWords = wordCount(this.value);


			this_.on("change paste keyup", function () {
			  var v = wordCount(this.value);
			  this_.closest('.input-field').find('.character-counter').text(v.words + '/' + max_ch);

			  if (max_ch < v.words) {
				this_.addClass('invalid');
			  } else {
				this_.removeClass('invalid');
			  }

			});
			
			this_.closest('.input-field').find('.character-counter').text(curWords.words + '/' + max_ch); // For first init
		});
	
	},
	autoSaveForm:function(formID , autoSaveURL){
		
		$('body').addClass('autosaving');
		var dataToSend = $(formID).serializeArray();
		sendAjax(autoSaveURL,"POST",dataToSend,function(data){
			
			$('body').removeClass('autosaving');
		});
		
	},
	saveDraft:function(formID , draftURL){		
		$('body').addClass('autosaving');
		var dataToSend = $(formID).serializeArray();
		sendAjax(draftURL,"POST",dataToSend,function(data){
			$('body').removeClass('autosaving');
			if(!data.status){
				Swal.fire({
					text: data.message,
					type: 'error',
					confirmButtonText: okLang,
				});
			}
		});
		
	},
	saveForm:function(formID , saveURL){
		$('#flash-container').html('<div class="flash success">'+saveLang+'</div>');
		$('body').addClass('autosaving');
		var dataToSend = $(formID).serializeArray();
		sendAjax(saveURL,"POST",dataToSend,function(data){
			$('body').removeClass('autosaving');
			if(data.status){
				$(formID+'_wrapper').addClass('wizard-completed');
				$('#completeUpload').addClass('loading');
			}else{
				$('#form_error').addClass('error_message');
				$('#form_error').html(data.message);
				if($('#form_error').length){
					formUtils.scrollToFirstErrorElement($('#form_error').get(0));
				}
			}
		});
		
	},
	getUploadedFileCount: function(tableWrapper){
		
	}
	
};

function customPlUploader(selector, uploadURL, uploadMaxSize,uploadMaxFiles, validFormats , resultElemSelector){
	var uploaderArr = [], uploadCount = 0 , _this = $('#'+selector);
	
	var fileTypes = {		
		'pdf':[{title : "Pdf Document", extensions : "pdf"}],
		'word':[
			{title : "Word Document", extensions : "doc"},
			{title : "Word Document", extensions : "docx"},
			{title : "Word Document", extensions : "odt"}		
		],
		'image':[
			{title : "Image file", extensions : "jpg"},
			{title : "Image file", extensions : "jpeg"},
			{title : "Image file", extensions : "png"}
		]
	};
	
	var mimeTypes = [] , mimeStr = '';
	if(validFormats){
		for(var i=0,j=validFormats.length;i<j;i++ ){
			if(typeof fileTypes[validFormats[i]] != 'undefined'){
				$(fileTypes[validFormats[i]]).each(function(i,v){				
					mimeTypes.push(v);
					mimeStr += (v.extensions + ', ');
				});
			}
		}
	}
	if(mimeTypes){
		$('#'+selector).parent().find('.fileNameWrapper').append(' <span class="ltr fm_auto sizeFormatWrapper">(Max:'+uploadMaxSize+' MB ) ['+mimeStr.substring(0,mimeStr.length-2)+']</span>');
	}
	
	var uploader = new plupload.Uploader({
		runtimes : 'html5,flash,silverlight,html4',
		browse_button :selector,
		url : uploadURL,
		multi_selection : false,
		filters : {
			max_file_size : uploadMaxSize+'mb',
			mime_types:mimeTypes
		},
		multipart_params : {
			'controlName': _this.attr('data-type')
		},
		headers: { 'X-CSRF-TOKEN': window._token.csrfToken },
		init: {
			BeforeUpload:function (up,files){
				_this.closest('.input_parent').find('.uploadProgress').css({'width':'0%'});					
				_this.closest('.input_parent').find('.uploadPercentage').html('');
				uploader.settings.url = uploadURL;		
			},
			FilesAdded: function(up, files) {
				
				uploader.disableBrowse (true); // Disable file selection till file is uploaded completely
				
				uploadCount = $(resultElemSelector+ ' > tbody > tr').length; 
				// console.log(uploadCount);
				
				if(resultElemSelector && uploadCount >= uploadMaxFiles){
					up.stop();
					uploader.splice();						
					Swal.fire({
						text: maxUploadLimitReached,
						type: 'error',
						confirmButtonText: okLang,
					});
				}else{				
					up.start();
				}
							
				
			},
			UploadProgress: function(up, file) {
				_this.closest('.input_parent').find('.uploadProgress').css({'width':file.percent+'%'});					
				_this.closest('.input_parent').find('.uploadPercentage').html(file.percent+'%');				
			},
			FileUploaded:function(up,file,response){
					var t = response.response;
					
					try{	
						var rt  = $.parseJSON(t);
						
						if(rt.status == true ){
							_this.closest('.input_parent').find('input[type="file"]').removeClass('error')
							_this.closest('.input_parent').find('input[type="file"]').next('label').hide()
							_this.closest('.input_parent').find('input[type="file"]').attr('required',false)
							_this.closest('.input_parent').find('.filename').val(rt.data.id);
							_this.closest('.input_parent').find('.original').val(rt.data.fileName);	
							_this.closest('.input_parent').find('.uploadFileName').html(rt.data.fileName);	
							
							if(resultElemSelector){ //Only if multiple upload is present
								var SlNo = $(resultElemSelector+ ' > tbody > tr').length+1, size = formatBytes(rt.data.size);
								$(resultElemSelector + ' > tbody').append('<tr><td  class="cl_index" >'+SlNo+'</td><td  class="cl_lg"  ><div>'+rt.data.fileName+'</div><div class="size">'+size+'</div></td><td  class="cl_tool" ><a data-id="'+rt.data.id+'" href="#" class="delTR"><i class="icon icon-android-delete"></i><input type="hidden" value="'+rt.data.id+'" name="'+selector+'_upload[]" /></a><div class="tr_loader"><div class="tr_loader_wrapper"><span class="loader-dot"></span><span class="loader-dot"></span><span lass="loader-dot"></span><span class="loader-dot"></span></div></div></td></tr>');
								
								if(!$(resultElemSelector).parent().hasClass('show_')){
									$(resultElemSelector).parent().addClass('show_');
								}
								setTimeout(function(){
									_this.closest('.input_parent').find('.uploadFileName').html('');
									_this.closest('.input_parent').find('.filename').val('');
									_this.closest('.input_parent').find('.original').val('');
									_this.closest('.input_parent').find('.uploadProgress').css({'width':'0%'});					
									_this.closest('.input_parent').find('.uploadPercentage').html('');
								},500);
							}
						}else{
							_this.closest('.input_parent').find('.uploadFileName').html('');
							_this.closest('.input_parent').find('.filename').val('');
							_this.closest('.input_parent').find('.original').val('');
							_this.closest('.input_parent').find('.uploadProgress').css({'width':'0%'});					
							_this.closest('.input_parent').find('.uploadPercentage').html('');
							
						
							//swal('{{Lang::get('messages.invalid_file')}}')
							Swal.fire({
								text: 'Network Error Occured. Please try again.',
								type: 'error',
							});
						}
					}catch(ex){					
						
						Swal.fire({
							text: 'Network Error Occured. Please try again.',
							type: 'error',
						});
						_this.closest('.input_parent').find('.uploadFileName').html('');
						_this.closest('.input_parent').find('.filename').val('');
						_this.closest('.input_parent').find('.original').val('');
						_this.closest('.input_parent').find('.uploadProgress').css({'width':'0%'});					
						_this.closest('.input_parent').find('.uploadPercentage').html('');
					}
			},
			UploadComplete:function(up,files){
				uploadCount = $(resultElemSelector+ ' > tbody > tr').length;
				uploader.splice();
				uploader.disableBrowse(false);
			},
			Error: function(up, err) {
				uploader.disableBrowse (false);
				console.log(err);
				if(err.code == -600){
					
					Swal.fire({
						text: fileSizeExceededLang,
						type: 'error',
						confirmButtonText: okLang,
					});
				}
				if(err.code == -601){
					// alert('Invalid file format');
					Swal.fire({
						text: invalidFileFormatLang,
						type: 'error',
						confirmButtonText: okLang,
					});
					
				}
				/* swal({
					  title: "{{Lang::get('messages.error')}}",
					  text: "{!! Lang::get('messages.invalid_file') !!}",
					  type: "warning",
					  confirmButtonText: "{{Lang::get('messages.ok')}}",
					  confirmButtonColor:'#000',
					  closeOnConfirm: false
				}) */
				// uploadCount--;
			}	
		}
	});
	
	uploader.init();

	uploaderArr.push(uploader);
	
	//Table file delete Event Bindings
	
	
	var _$tableWrapper = $(resultElemSelector).parent();
	
	// console.log(selector);
	// console.log(_$tableWrapper);
	
	if(_$tableWrapper){
		// console.log(_$tableWrapper.get(0));
		$( _$tableWrapper.get(0) ).on('click','.delTR',function(e){
			e.preventDefault();
			var id = $(this).attr('data-id');
			var _TR = $(this).closest('tr');
			var _tableID = _TR.closest('table').attr('id');
			
			sendAjax(window.request+'delete-file/'+id,'GET',{},function(data){
				if(data.status){
					_TR.remove();
					
					$('#'+_tableID+' tr > td:first-child').each(function(i,v){
						$(this).html(i+1);
					});
					
					if(uploadCount > 0 && uploadCount <= uploadMaxFiles){
						uploadCount = $(resultElemSelector+ ' > tbody > tr').length;
						uploader.disableBrowse(false);
					}
				}else{
					// alert('Network error. Cannot delete file. Please try again');
					Swal.fire({
						text: 'Network Error Occured. Please try again.',
						type: 'error',
					});
				}
			},'.delTRLoader');
		});
	}
}


	
