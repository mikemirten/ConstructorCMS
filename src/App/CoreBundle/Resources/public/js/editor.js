$(function() {
	var container = $('#pageContainer');
	var elements  = container.find('.page-element');

	// Elements sorting
	container.sortable({
		start: function() {
			$(this).addClass('elements-highlight');
		},
		stop: function() {
			$(this).removeClass('elements-highlight');
		},
		update: function() {
			var list = [];

			container.find('.page-element').each(function() {
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

	var elementEdit = function()
	{
		
	};
	
	var elementRemove = function(element)
	{
		var button = $(this);

		var modal = application.modal({
			title:   'Warning',
			content: '<p>Remove the element: <b>"' + element.attr('data-title') + '"</b> ?</p>',
			buttons: [
				{
					title: 'Remove',
					class: 'btn btn-danger',
					click: function() {
						var url = container.attr('data-url-remove');
						var id  = element.attr('data-id');
						
						$.ajax({
							url:     url.replace('placementId', id),
							success: function(response) {
								if (response.success) {
									element.remove();
									modal.modal('hide');
								}
							}
						});

					}
				}
			]
		});
	};
	
	var addElementControl = function(element)
	{
		var panel   = $('<div>', {class: 'page-element-ctrl'});
		var header  = $('<div>', {class: 'page-element-ctrl-header'});
		var title   = $('<h4>', {class: 'page-element-ctrl-title pull-left'});
		var control = $('<div>', {class: 'btn-group pull-right'});
		
		control.append(application.button({
			icon:  'edit',
			title: 'Edit',
			class: 'btn btn-default btn-sm',
			click: elementEdit
		}));
		
		control.append(application.button({
			icon:  'remove',
			title: 'Remove',
			class: 'btn btn-default btn-sm',
			click: function() {
				elementRemove(element);
			}
		}));
		
		title.html(element.attr('data-title'));
		
		header.append(title).append(control);
		panel.append(header);
		element.append(panel);
	};

	// Add control to elements
	elements.each(function() {
		addElementControl($(this));
	});

	// Page control panel
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
											title: 'Create',
											type:  'primary',
											click: function() {
												$('.js-element-form').submit();
											}
										}
									]
								});

								$('.js-element-form').submit(function(event) {
									var form = $(this);

									$.ajax({
										url:     form.attr('action'),
										method:  form.attr('method'),
										data:    form.serialize(),
										success: function(response) {
											modal.modal('hide');
											
											var element = $('<section>', {class: 'page-element'});

											element.append(response);
											addElementControl(element);
											
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