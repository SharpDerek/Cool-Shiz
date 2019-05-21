(function($) {

	function DoAccordion() {
		var accIndex = 0;
		$('.accordion-section').each(function() {
			$(this).attr('acc-index',accIndex);
			var itemIndex = 0;
			$(this).find('.accordion-item').each(function() {
				$(this).attr('acc-item-index',itemIndex);
				$(this).attr('acc-parent-index',accIndex);
				$(this).attr('acc-status','closed');
				var thisItemIndex = itemIndex;
				var thisParentIndex = accIndex;
				$(this).find('.accordion-title').click(function() {
					AccordionToggle(thisItemIndex,thisParentIndex);
				});
				itemIndex++;
			});
			accIndex++;
		});
	}

	function AccordionToggle(index, parentIndex) {
		$('[acc-item-index][acc-parent-index]').each(function() {
			var thisItemIndex = $(this).attr('acc-item-index');
			var thisParentIndex = $(this).attr('acc-parent-index');
			var thisItemStatus = $(this).attr('acc-status');
			if (thisParentIndex == parentIndex) {
				if (thisItemIndex == index) {
					if (thisItemStatus == 'open') {
						$(this).attr('acc-status','closed');
						$(this).find('.accordion-content').slideUp();
					} else {
						$(this).attr('acc-status','open');
						$(this).find('.accordion-content').slideDown();
					}
				} else {
					$(this).attr('acc-status','closed');
					$(this).find('.accordion-content').slideUp();
				}
			}
		});
	}

	$(document).ready(function() {
		DoAccordion();
	});

})(jQuery);
