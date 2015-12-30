$(function() {
	var container = $('#pageContainer');

	container.sortable({
		start: function() {
			$(this).addClass('elements-highlight');
		},
		stop: function() {
			$(this).removeClass('elements-highlight');

			var list = [];

			container.find('.js-page-element').each(function() {
				var id = $(this).attr('data-id');
				list.push(parseInt(id));
			});

			$.ajax({
				url:     container.attr('data-url-sort'),
				method:  'POST',
				data:    { list: JSON.stringify(list) }
			});
		}
	});

	$('.js-content-remove-btn').click(function() {
		var button = $(this);

		var modal = application.modal({
			title:   'Warning',
			content: '<p>Remove the element: <b>"' + button.attr('data-title') + '"</b> ?</p>',
			buttons: [
				{
					content: 'Remove',
					class:   'btn btn-danger',
					click:   function() {
						$.ajax({
							url:     button.attr('data-url'),
							success: function(response) {
								if (response.success) {
									$(button.attr('data-target')).remove();
									modal.modal('hide');
								}
							}
						});

					}
				}
			]
		});
	});

	$.ajax({
		url:     container.attr('data-url-elements'),
		success: function(response) {
			var panel = ctrlPanel.create({
				id:    'editControl',
				title: 'Control'
			});

			$.each(response.data, function() {
				var name = this.name;
				var desc = this.description;
				var url  = this.url;

				panel.addElement({
					title: 'Create "' + desc + '"',
					icon:  this.icon,
					click: function() {
						$.ajax({
							url:     url,
							success: function(response) {
								var modal = application.modal({
									title:   'Create "' + desc + '"',
									size:    'large',
									content: response,
									buttons: [
										{
											content: 'Create',
											class:   'btn btn-primary',
											click:   function() {
												$('#core_element_form').submit();
												
											}
										}
									]
								});

								$('#core_element_form').submit(function(event) {
									var form = $(this);

									$.ajax({
										url:     form.attr('action'),
										method:  form.attr('method'),
										data:    form.serialize(),
										success: function(response) {
											modal.modal('hide');
											
											var element = $('<section>', {class: 'page-element js-page-element'});

											element.append(response);
											container.append(element);
										}
									});

									event.preventDefault();
								});
							}
						});
					}
				});
			});
		}
	});
});