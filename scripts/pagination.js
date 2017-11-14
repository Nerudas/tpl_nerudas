/*
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
function addPagination(element, params) {
	var params = jQuery.parseJSON(params);
	var element = jQuery(element);
	(function ($) {
		var pageLimit = 3;
		if ($('body').innerWidth() >= 480) {
			var pageLimit = 5;
		}
		if ($('body').innerWidth() >= 768) {
			var pageLimit = 7;
		}
		element.html('');
		var pagination = UIkit.pagination(element);
		pagination.options.pages = params.pagesTotal;
		pagination.options.currentPage = params.pagesCurrent - 1;
		pagination.options.displayedPages = pageLimit;
		/*pagination.options.lblPrev = '<i class="uk-icon-angle-double-left"></i>';
		pagination.options.lblNext = '<i class="uk-icon-angle-double-right"></i>';*/
		pagination.init();
		$($(element.selector + ' a')).each(function () {
			var urlParams = getPaginationURLParams(window.location.href.split("#")[0]);
			urlParams.start = $(this).data('page') * params.limit;
			var url = window.location.href.split('?')[0];
			var url = url + '?' + getPaginationURL(urlParams);
			if (window.location.hash) {
				var url = url + window.location.hash;
			}
			$(this).attr('href', url);
			$(this).removeAttr('data-page');
		});
	})(jQuery);
}

function getPaginationURLParams(url) {
	var request = {};
	var pairs = url.substring(url.indexOf('?') + 1).split('&');
	for (var i = 0; i < pairs.length; i++) {
		if (!pairs[i]) {
			continue;
		}

		var pair = pairs[i].split('=');
		request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
	}
	return request;
}

function getPaginationURL(array) {
	var pairs = [];
	for (var key in array)
		if (array.hasOwnProperty(key))
			pairs.push(encodeURIComponent(key) + '=' + encodeURIComponent(array[key]));
	return pairs.join('&');
}
