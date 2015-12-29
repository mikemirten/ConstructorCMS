ctrlPanel = (function($) {
	/**
	 * Element object
	 */
	var Element = function(options)
	{
		this.block = $('<button>', {class: 'ctrl-panel-btn'});
		this.title = '&nbsp;';
		
		/**
		 * Init the element
		 * 
		 * @param {pbject} title
		 */
		this.init = function(options)
		{
			if (typeof options.title !== 'undefined') {
				this.setTitle(options.title);
			}

			if (typeof options.icon !== 'undefined') {
				this.setIcon(options.icon);
			}

			if (typeof options.click !== 'undefined') {
				this.setClick(options.click);
			}
		}
		
		/**
		 * Set icon for the element
		 * 
		 * @param  {string} title
		 * @return {this}
		 */
		this.setIcon = function(iconName)
		{
			var icon = $('<span>', {class: 'glyphicon glyphicon-' + iconName});
			
			this.block.empty().append(icon);
			
			return this;
		};
		
		/**
		 * Set title
		 * 
		 * @param   {string} title
		 * @returns {this}
		 */
		this.setTitle = function(title)
		{
			this.title = title;
			
			return this;
		};
		
		/**
		 * Get title
		 * 
		 * @returns {String}
		 */
		this.getTitle = function()
		{
			return this.title;
		}
		
		/**
		 * Set on click callback
		 * 
		 * @param   {function} callback
		 * @returns {this}
		 */
		this.setClick = function(callback)
		{
			this.block.click(callback);
			
			return this;
		};
		
		this.init(options);
	};
	
	/**
	 * Panel object
	 */
	var Panel = function(options)
	{
		this.id = options.id;
		
		this.block     = $('<div>', {class: 'ctrl-panel'});
		this.header    = $('<div>', {class: 'ctrl-panel-header'});
		this.body      = $('<div>', {class: 'ctrl-panel-body'});
		this.footer    = $('<div>', {class: 'ctrl-panel-footer'});
		this.title     = $('<h3>', {class: 'ctrl-panel-title'});
		this.closeBtn  = $('<button>', {class: 'ctrl-panel-header-btn pull-right'});
		this.closeIcon = $('<span>', {class: 'glyphicon glyphicon-remove'});
		this.hint      = $('<p>', {class: 'ctrl-panel-info text-center'});
		
		/**
		 * Init the panel
		 * 
		 * @param {object} options
		 */
		this.init = function(options)
		{
			var block = this.block;
			
			if (typeof options.title !== 'undefined') {
				this.setTitle(options.title);
			}
			
			this.closeIcon.click(function() {
				block.remove();
			});
			
			this.closeBtn.append(this.closeIcon);
			
			this.header.append(this.title);
			this.header.append(this.closeBtn);
			
			this.footer.append(this.hint);
			
			this.block.append(this.header);
			this.block.append(this.body);
			this.block.append(this.footer);
		};
		
		/**
		 * Set title
		 * 
		 * @param   {string} title
		 * @returns {this}
		 */
		this.setTitle = function(title)
		{
			this.title.html(title);
		};
		
		/**
		 * Add element to the panel
		 * 
		 * @returns {this}
		 */
		this.addElement = function(options)
		{
			var hint    = this.hint;
			var element = new Element(options);
			
			this.body.append(element.block);
			
			element.block.hover(function() {
				hint.html(element.getTitle());
			}, function() {
				hint.html('&nbsp;');
			});
			
			return element;
		};
		
		/**
		 * Save panel's state
		 */
		this.saveState = function() {
			var position = this.block.position();

			window.localStorage.setItem('ctrlPanelState.' + this.id, JSON.stringify({
				posX:  position.left,
				posY:  position.top,
				sizeX: this.block.width(),
				sizeY: this.block.height()
			}));
		};
		
		/**
		 * Restore panel's state
		 */
		this.restoreState = function() {
			var stateRaw = window.localStorage.getItem('ctrlPanelState.' + this.id);

			if (stateRaw === null) {
				return;
			}

			var state = JSON.parse(stateRaw);

			this.block.css({
				position: 'absolute',
				top:      state.posY + 'px',
				left:     state.posX + 'px',
				width:    state.sizeX + 'px',
				height:   state.sizeY + 'px'
			});
		};
		
		this.init(options);
	};
	
	return {
		/**
		 * Create panel
		 * 
		 * @param   {type} options
		 * @returns {Panel}
		 */
		create: function(options) {
			var panel = new Panel(options);

			panel.block.draggable({
				snap: true,
				stop: function() {
					panel.saveState();
				}
			});

			panel.block.resizable({
				stop: function() {
					panel.saveState();
				}
			});

			if (typeof options.elements !== 'undefined') {
				$.each(options.elements, function() {
					panel.addElement(this);
				});
			}

			panel.restoreState();

			$(document.documentElement).append(panel.block);
			
			return panel;
		}
	};
}(jQuery));