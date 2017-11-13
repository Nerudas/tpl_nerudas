/**
 * @package     Nerudas Template
 * @version     5.0
 * @author      Nerudas - nerudas.ru
 * @copyright   Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

(function($){
	$(document).ready(function() {
// Phones
		if($('*').is('[data-phones]')) {
			phones('start', $(this));
		}
		$('body').on('click', '[data-phone-add]',  function() {
			phones('add', $(this).parents('[data-phones]'));
		});
		function phones (action, parent) {
			var phones = parent.find('[data-phone]');
			if (action == 'start') {
				$(phones).each(function () {
					var input = $(this).find('[data-phone-number] input');
					if (input.val() !== ''){
						$(this).removeClass('uk-hidden');
						$(this).addClass('uk-show');
					}					
				});
			}
			var hidden = parent.find('[data-phone].uk-hidden');
			if (hidden.length > 0) {
				hidden[0].removeClass('uk-hidden');
				hidden[0].addClass('uk-show');
			}
			var show =  parent.find('[data-phone].uk-show');
			if (show.length == phones.length) {
				parent.find('[data-phone-add]').addClass('uk-hidden');
			}
		}
	});
})(jQuery);