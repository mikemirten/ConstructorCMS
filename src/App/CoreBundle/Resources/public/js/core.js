application = (function($) {
	/**
	 * Generate random hash
	 * 
	 * @returns {String}
	 */
	var generateHash = function()
	{
		var src = Date.now() + Math.round(Math.random() * 1000000000000000);
		
		return src.toString(16);
	}
	
	/**
	 * Create button
	 * 
	 * @param   {Object} options
	 * @returns {Object}
	 */
	var createButton = function(options)
	{
		if (typeof options.content === 'undefined') {
			throw 'Content must be defined';
		}
		
		var btnClass = (typeof options.class === 'undefined')
			? 'btn btn-default'
			: options.class;
		
		var button = $('<button>', {type:  'button', class: btnClass});
		
		button.html(options.content);
		
		if (typeof options.click !== 'undefined') {
			button.click(options.click);
		}
		
		return button;
	}
	
	/**
	 * Create modal's header
	 * 
	 * @param   {Object} options
	 * @returns {Object}
	 */
	var createModalHeader = function(options)
	{
		var headerBlock = $('<div>', {class: 'modal-header'});
		
		if (typeof options.close === 'undefined' || options.close === true) {
			var closeButton = $('<button>', {
				class:          'close',
				type:           'button',
				'data-dismiss': 'modal',
				'aria-label':   'Close'
			});
			
			var closeContent = $('<span>', {'aria-hidden': true});
			closeContent.html('&times;');
			
			closeButton.append(closeContent);
			headerBlock.append(closeButton);
		}
		
		var titleBlock  = $('<h4>', {class: 'modal-title'});
		
		var title = (typeof options.title === 'undefined')
			? 'Info' : options.title;
			
		titleBlock.html(title);
		
		headerBlock.append(titleBlock);
		
		return headerBlock;
	};
	
	/**
	 * Create modal's footer
	 * 
	 * @param   {Object} options
	 * @returns {Object}
	 */
	var createModalFooter = function(options)
	{
		var footerBlock = $('<div>', {class: 'modal-footer'});
		
		if (typeof options.close === 'undefined' || options.close === true) {
			var closeButton = $('<button>', {
				type:           'button',
				class:          'btn btn-default',
				'data-dismiss': 'modal'
			});
			
			closeButton.html('Close');
			
			footerBlock.append(closeButton);
		}
		
		if (typeof options.buttons !== 'undefined') {
			$.each(options.buttons, function() {
				footerBlock.append(createButton(this));
			});
		}
		
		return footerBlock;
	}
	
	return {
		/**
		 * Create modal window
		 * 
		 * @param   {String} content
		 * @param   {Object} options
		 * @returns {undefined}
		 */
		modal: function(options)
		{
			if (typeof options === 'string') {
				options = {content: options};
			}
			
			if (typeof options.content === 'undefined') {
				throw 'Content must be defined';
			}
			
			var id = (typeof options.id === 'undefined')
				? 'modal_' + generateHash()
				: options.id;
			
			var modalBlock = $('<div>', {
				id:       id,
				class:    'modal fade',
				tabindex: '-1',
				role:     'dialog'
			});
			
			var dialogClass = (typeof options.size === 'undefined')
				? 'modal-dialog'
				: (function(size) {
					if (size === 'small') {
						return 'modal-dialog modal-sm';
					}
					
					if (size === 'large') {
						return 'modal-dialog modal-lg';
					}
				})(options.size);
			
			var dialogBlock  = $('<div>', {class: dialogClass});
			var contentBlock = $('<div>', {class: 'modal-content'});
			var bodyBlock    = $('<div>', {class: 'modal-body'});
			
			bodyBlock.html(options.content);
			
			contentBlock.append(createModalHeader(options));
			contentBlock.append(bodyBlock);
			contentBlock.append(createModalFooter(options));
			
			dialogBlock.append(contentBlock);
			modalBlock.append(dialogBlock);
			
			modalBlock.on('hidden.bs.modal', function() {
				modalBlock.remove();
			});
			
			$(document.documentElement).append(modalBlock);
			
			return modalBlock.modal('show');
		}
	};
})(jQuery);