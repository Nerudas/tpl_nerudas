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
		$('#regionSelect').on('show.uk.modal', function () {
			$('#openRegionSelect').trigger('click');
		});
	});
	$('[data-set-region]').live('click', function () {
		UIkit.modal('#regionSelect').hide();
		$.cookie('region', $(this).data('set-region'), {expires: 365, path: '/'});
		location.reload();
	});

})(jQuery)
