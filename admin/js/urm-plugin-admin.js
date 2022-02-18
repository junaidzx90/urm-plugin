jQuery(function( $ ) {
	'use strict';

	function loadFile() {
		var pdfFile, selectedFile;
		// If the frame already exists, re-open it.
		if ( pdfFile ) {
			pdfFile.open();
			return;
		}
		//Extend the wp.media object
		pdfFile = wp.media.frames.file_frame = wp.media({
			title: 'Choose PDF',
			button: {
				text: 'Choose PDF'
			},
			library: {
				type: ['application/pdf']
			},
			multiple: false
		});

		//When a file is selected, grab the URL and set it as the text field's value
		pdfFile.on('select', function() {
			selectedFile = pdfFile.state().get('selection').first().toJSON();
			$('.file_preview').remove();
			$('#document').append(`<div class="file_preview">
				<input type="hidden" value="${selectedFile.id}" name="document_file">
				<p><a target="_blank" href="${selectedFile.url}">File: ${selectedFile.filename}</a></p>
			</div>`);
		});

		//Open the uploader dialog
		pdfFile.open();
	}

	$('.user_document_btn').on("click", ()=>{
		loadFile();
	});

	function makeid(length) {
		var result           = '';
		var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		var charactersLength = characters.length;
		for ( var i = 0; i < length; i++ ) {
		  result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
		
		result = result.toLowerCase();
	   	return result;
	}

	// generate sponsor id
	if ($(document).find('#post_type') && $('#post_type').val() === 'recipient') {
		$('input[name="post_title"]').after('<button class="button-secondary" id="generate_id">Generate ID</button>');

		if ($('input[name="post_title"]').val().length === 0) {
			$('input[name="post_title"]').val(makeid(6));
		}

		$('#generate_id').on("click", function (e) {
			e.preventDefault();
			$('input[name="post_title"]').val(makeid(6));
		});
	}

});