/*
 * @package    Nerudas Template
 * @version    4.9.7
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

(function ($) {
	$(document).ready(function () {
		var field = $('[data-input-boardcategories]'),
			data = field.data('input-boardcategories'),
			items = field.find('.categories .item'),
			tags = field.find('input[type="checkbox"]'),
			currents = field.find('.actives'),
			titleField = field.closest('form').find('[name*="title"]'),
			modal = UIkit.modal('#categorySelect');
		if (data == 'show') {
			modal.show();
		}
		setActives();

		// On click item
		$(items).on('click', function () {
			$(tags).prop('checked', false);

			var values = $(this).data('tags');
			$(values).each(function (key, val) {
				field.find('input[value="' + val + '"]').prop('checked', true);
			});

			setActives();

			modal.hide();
		});

		$(tags).on('change', function () {
			setTimeout(setActives, 50);
		});

		function setActives() {
			items.removeClass('active');
			$(currents).html('');

			var notextd = field.find('.actives.not-extd'),
				extd = field.find('.actives.extd');

			var values = [];
			$(tags).each(function (i, input) {
				if ($(input).prop('checked')) {
					values.push($(input).val() * 1);
				}
			});
			$(items).each(function (i, item) {
				var active = true;
				var itemTags = $(item).data('tags');
				$(itemTags).each(function (ik, tag) {
					if ($.inArray(tag, values) == -1) {
						active = false;
					}
				});

				if (active) {
					$(item).addClass('active');
					var itemHTML = '<li class="item">' + $(item).data('title') + '</li>';
					if (values.length == itemTags.length) {
						$(itemHTML).appendTo($(notextd));
						if ($(titleField).val() == '') {
							$(titleField).val($(item).data('title'));
						}
					}
					$(itemHTML).appendTo($(extd));
				}
			});
			if ($(notextd).find('.item').length == 0) {
				var itemHTML = '<li class="item">' + $(notextd).data('title-extd') + '</li>';
				$(itemHTML).appendTo($(notextd));
			}
		}
	});
})(jQuery);