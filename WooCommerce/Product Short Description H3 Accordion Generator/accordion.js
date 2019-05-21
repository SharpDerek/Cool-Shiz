(function($) {

	function doAccordion() {
		var accIndex = 0;
		$('.accordion-section').each(function() {
			$(this).attr('acc-index',accIndex);
			var itemIndex = 0;
			$(this).find('.accordion-item').each(function() {
				$(this)
					.attr('acc-item-index',itemIndex)
					.attr('acc-parent-index',accIndex)
					.attr('acc-status','closed');
				var thisItemIndex = itemIndex;
				var thisParentIndex = accIndex;
				$(this).find('.accordion-title').click(function() {
					accordionToggle(thisItemIndex,thisParentIndex);
				});
				itemIndex++;
			});
			accIndex++;
		});
	}

	function accordionToggle(index, parentIndex) {
		$('[acc-item-index][acc-parent-index]').each(function() {
			var thisItemIndex = $(this).attr('acc-item-index');
			var thisParentIndex = $(this).attr('acc-parent-index');
			var thisItemStatus = $(this).attr('acc-status');
			if (thisParentIndex == parentIndex) {
				if (thisItemIndex == index) {
					accordionState($(this),thisItemStatus != 'open');
				} else {
					accordionState($(this),false);
				}
			}
		});
	}

	function accordionState(item, state) {
		if (state) { 
			item.attr('acc-status','open');
			item.find('.accordion-content').slideDown();
		} else {
			item.attr('acc-status','closed');
			item.find('.accordion-content').slideUp();
		}
	}

	$(document).ready(function() {
		doAccordion();
	});

})(jQuery);
