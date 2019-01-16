$(document).ready(function(){
    tinymce.init({
		selector: 'textarea#content',
		height: 350,
		width:"",
		plugins: [
			"codemirror advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste textcolor colorpicker textpattern imagetools code fullscreen"
		],
		toolbar1: "undo redo bold italic underline strikethrough cut copy paste| alignleft aligncenter alignright alignjustify bullist numlist outdent indent blockquote searchreplace | styleselect formatselect fontselect fontsizeselect ",
		toolbar2: "table | hr removeformat | subscript superscript | charmap emoticons ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft | link unlink anchor image media | insertdatetime preview | forecolor backcolor print fullscreen code ",
		image_advtab: true,
		image_advtab: true,
		menubar: false,
		toolbar_items_size: 'small',

		// trả về đường dẫn tương đối từ baseurl 
        relative_urls: false, 
        remove_script_host : false,
        filemanager_title:"Media Manager",	
		external_filemanager_path: homeUrl()+"/file/",
		external_plugins: {"filemanager":homeUrl()+"/file/plugin.min.js"},  
  //   	filemanager_access_key:csrf(),
    });

	tinymce.init({
		 selector: 'textarea#description',
		 toolbar_items_size: 'small',
		 height: 250,
		 width:"",
		 plugins: [
			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste textcolor colorpicker textpattern imagetools code fullscreen"
		],
		toolbar1: "undo redo bold italic underline | alignleft aligncenter alignright alignjustify bullist numlist outdent indent blockquote link unlink anchor image media | preview | forecolor backcolor fullscreen code",
		image_advtab: true,
		menubar: false,
		toolbar_items_size: 'small',

		//remove urls
        relative_urls: false,
        remove_script_host : false,
 		filemanager_title:"Media Manager",	
		external_filemanager_path: homeUrl()+"/file/",
		external_plugins: {"filemanager":homeUrl()+"/file/plugin.min.js"},  

	});

	$('a#select-img').click(function(event) {
		//') // initializes and invokes show immediately 
			$('#modal-media-image').modal('show');
       
			$('#modal-media-image').on('hide.bs.modal', function () {
            var imgUrrl = $('#image').val();
        	$('img#show-img').attr('src',imgUrrl);
    });
	})
	;

	 $('a#delete-img').click(function(event) {
		//') // initializes and invokes show immediately 
          	$('#image').val('');
        	$('img#show-img').attr('src','');
    });



	

	// jQuery(document).ready(function($) {
	// 	$('#show-media').click(function() {
	// 		$('#media-modal').modal('show');
	// 		// $('input#image').attr('value','sá');;
	// 		$('#media-modal').on('hide.bs.modal',function(){
	// 			var imgUrrl = $('#image').val();
	// 			$('img#show-img').attr('src',imgUrrl);
	// 			$('input#image').attr('value',imgUrrl);;
	// 			// alert(imgUrrl);
	// 		});
	// 	});
	// });
	
	})