/*
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
(function ($) {
	$(document).ready(function () {
		if (window.location.hash) {
			var hash = window.location.hash.substring(1);
			if (hash) {
				$('#tabs-nav .' + hash).addClass('uk-active');
			}
		}
		$('#comments .uk-pagination a').each(function () {
			if ($(this).attr('href')) {
				$(this).attr('href', $(this).attr('href') + '#comments');
			}
			;
		});
		$('#tabs-nav a').on('click', function () {
			var hash = $(this).parent().attr('class');
			window.location.hash = hash;
		});
	});
})(jQuery);