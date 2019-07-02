	jQuery.fn.extend({
		accordion: function(settings = {closeAll: true}) {
			$ = jQuery;
			/*
			settings = {
				item: "",
				toggle: "",
				content: "",
				closeAll: true
			}
			*/
			var wraps = $(this);
			var accIndex = 0;

			wraps.each(function() {
				var itemIndex = 0;
				$(this).find(settings.item).each(function() {
					var thisIndex = accIndex;
					var thisItemIndex = itemIndex;
					$(this)
						.attr("acc-index",thisIndex)
						.attr("acc-item-index",thisItemIndex)
						.find(settings.content).hide();
					$(this).find(settings.toggle).click(function() {
						toggleAccordion(thisIndex,thisItemIndex);
					});
					itemIndex++;
				});
				$(this).attr("acc-index", accIndex);
				accIndex++;
			});

			function toggleAccordion(index, itemIndex) {
				if (settings.closeAll) {
					$('[acc-index][acc-item-index]').each(function() {
						var thisAccIndex = $(this).attr('acc-index');
						var thisItemIndex = $(this).attr('acc-item-index');
						var thisItemActive = $(this).hasClass('acc-active');
						var setThisItemActive = (thisAccIndex == index) && (thisItemIndex == itemIndex) && (!thisItemActive);

						setItemState($(this), setThisItemActive);
					});
				} else {
					var thisItem = $('[acc-index="'+index+'"][acc-item-index="'+itemIndex+'"]');
					setItemState(thisItem, !thisItem.hasClass('acc-active'));
				}
			}

			function setItemState(item, state) {
				if (state) {
					item.addClass("acc-active");
					item.find(settings.content).slideDown();
				} else {
					item.removeClass("acc-active");
					item.find(settings.content).slideUp();
				}
			}

		}
	});
