/*
 * @package    Nerudas Template
 * @version    4.9.40
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

(function ($) {
	$(document).ready(function () {
		var block = $('#locationSelect');

		$(block).appendTo('body');
		$(block).on('show.uk.modal', function () {
			modLocationRegionsGetRegions(block);
		});
	});
})(jQuery);