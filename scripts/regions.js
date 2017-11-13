/**
 * @package     Nerudas Template
 * @version     5.0
 * @author      Nerudas - nerudas.ru
 * @copyright   Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
(function ($) {
	$(document).ready(function() {
		$('#regionSelect').on('show.uk.modal', function(){		
			$('#openRegionSelect').trigger('click');
    	});
	});
	$('[data-set-region]').live('click', function() {
		UIkit.modal('#regionSelect').hide();
		$.cookie('region', $(this).data('set-region'), {expires: 365, path: '/' });
		location.reload();
	});
	
})(jQuery)
