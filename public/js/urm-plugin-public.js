jQuery(function( $ ) {
	'use strict';
	let receipts = $('#receipts-list').clone();
	let letters = $('#letters-list').clone();
	let taxs = $('#tax-documents-list').clone();

	$(document).on("click", '.reset-filter', function () {
		let type = $(this).data('type');
		switch (type) {
			case 'receipt':
				$(this).next('.filter').find('input').val("");
				$('#receipts-list').html(receipts);
				break;
			case 'letter':
				$(this).next('.filter').find('input').val("");
				$('#letters-list').html(letters);
				break;
			case 'tax':
				$(this).next('.filter').find('input').val("");
				$('#tax-documents-list').html(taxs);
				break;
		
			default:
		}
	});

	$(document).on("click", '.document_filter', function () {
		let type = $(this).data('type');
		let date = $(this).parents('.filter').find('.filter-date').val();
		let btn = $(this);
		if (date !== '') {
			$.ajax({
				type: "get",
				url: publicajax.ajaxurl,
				data: {
					action: "filter_document",
					type: type,
					date: date
				},
				beforeSend: () => {
					btn.prop('disabled', true);	
				},
				dataType: "json",
				success: function (response) {
					btn.removeAttr('disabled');

					if (response.success) {
						let data = response.success;

						switch (type) {
							case 'receipt':
								$('#receipts-list').html("");
								break;
							case 'letter':
								$('#letters-list').html("");
								break;
							case 'tax':
								$('#tax-documents-list').html("");
								break;
						
							default:
								break;
						}

						if (data.length > 0) {
							data.forEach(element => {
								let elem = `<li class="list-group-item d-flex justify-content-between align-items-center">
									<div class="file_info d-flex flex-column">
										<span class="filename font-weight-bold">${element.filename}</span>
										<span class="published_date font-weight-light">${element.publish_date}</span>
									</div>

									<div class="file_action">
										<a href="${element.fileurl}" target="_black" class="ml-3 btn btn-primary view-file-btn">View</a>
									</div>
								</li>`;

								switch (type) {
									case 'receipt':
										$('#receipts-list').append(elem);
										break;
									case 'letter':
										$('#letters-list').append(elem);
										break;
									case 'tax':
										$('#tax-documents-list').append(elem);
										break;
								
									default:
										break;
								}

							});
						} else {
							switch (type) {
								case 'receipt':
									$('#receipts-list').html("<div class='mt-3 alert alert-danger'>Sorry! No documents are found.</div>");
									break;
								case 'letter':
									$('#letters-list').html("<div class='mt-3 alert alert-danger'>Sorry! No documents are found.</div>");
									break;
								case 'tax':
									$('#tax-documents-list').html("<div class='mt-3 alert alert-danger'>Sorry! No documents are found.</div>");
									break;
							
								default:
									break;
							}
						}
					}
				}
			});
		}
		
	});
});
