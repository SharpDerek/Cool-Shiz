	jQuery.fn.extend({
		uniformSize: function(settings = {'breakpoint':0}) {
			$ = jQuery;
			var bases = $(this);
			var wrappers = [];
			bases.each(function(){
				$(this).css({
					'width':'auto',
					'margin':'auto'
				});
				if ('max_height' in settings) {
					$(this).css('max-height', settings['max_height']);
				}
				var parent = $(this).parent();
				var wrapper = $('<div class="size-wrapper"></div>');
				var wrapInner = $('<div class="wrapper-inner"></div>');
				wrapper.css({
					'display': 'table',
					'width': '100%'
				});
				wrapInner.css({
					'display': 'table-cell',
					'vertical-align': 'middle',
					'width': '100%'
				});
				wrapper.append(wrapInner);
				$(this).wrap(wrapper);
				wrappers.push($(this).parents('.size-wrapper'));
			});
			function resizeWrappers() {
				if ($(window).width() > settings['breakpoint']) {
					max_height = 0;
					$.each(wrappers,function(index,wrapper) {
						wrapper.css('height','auto');
						if (wrapper.outerHeight() > max_height) {
							max_height = wrapper.outerHeight();
						}
					});
					$.each(wrappers,function(index,wrapper) {
						wrapper.css('height',max_height + 'px');
					});
				} else {
					$.each(wrappers,function(index,wrapper) {
						wrapper.css('height','auto');
					});
				}
			}
			setTimeout(function() {
				resizeWrappers();
			},0);
			$(window).resize(function() {
				resizeWrappers();
			});
			return bases;
		}
	});
