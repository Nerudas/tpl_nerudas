/*
 * @package    Nerudas Template
 * @version    4.9.15
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

(function ($) {
	function setRatioHeight() {
		$($('[data-ratio-height]')).each(function () {
			var data = $(this).data('ratio-height');
			var width = data[0];
			var height = data[1];
			$(this).height(Math.round(($(this).width() / width) * height));

		});
	}

	function setMiddleMinHeight() {
		if ($('*').is('.tm-middle')) {
			var middleHeight = $(window).height() - $('.tm-middle').offset().top - $('.tm-footer').outerHeight(true);
			if (middleHeight < $(window).height()) {
				// $('.tm-middle').css('min-height',middleHeight);	
			}
		}
	}

	function headerBreadcrumb() {
		var block = $('.tm-top .uk-navbar-breadcrumb');
		var list = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb');
		var dropItem = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop');
		var dropList = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop ul');
		var dropTitle = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop > a > .text');
		if (list.width() > block.width()) {
			$($('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .item')).each(function () {
				if ($(list).width() > block.width()) {
					var items = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .item');
					dropItem.removeClass('uk-hidden');
					var text = $(this).find('a .text').text();
					if (text !== '') {
						dropTitle.text(text);
					}
					$(this).prependTo(dropList);
					if ($(items).length == 1) {
						dropItem.width(block.width());
					}
				}
			});

		}
		else {
			$($('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop .item')).each(function () {
				if ($(list).width() <= block.width()) {
					var dropItems = $(this).parent().find('li');
					var text = $(dropItems[1]).find('a .text').text();
					if (text !== '') {
						dropTitle.text(text);
					}
					dropItem.after($(this));
					if ($(dropItems).length == 0) {
						dropItem.addClass('uk-hidden');
					}
				}
				else {
					dropItem.addClass('uk-hidden');
				}
			});
		}
	}

	$(document).ready(function () {
		$('[data-save-tabs]').each(function () {
			var key = window.location.href + '#' + $(this).data('save-tabs'),
				storage = sessionStorage.getItem(key);
			if (storage) {
				$(this).find('a[href="' + storage + '"]').closest('li').addClass('uk-active');
			}
			$(this).find('a').on('click', function () {
				sessionStorage.setItem(key, $(this).attr('href'));
			});
		});
	});

	function newMapHeight() {
		var newMap = $('html.new .tm-middle.map');
		if (newMap.length > 0) {
			$(newMap).outerHeight($(window).outerHeight() - $(newMap).offset().top);
		}

	}

	$(document).ready(function () {
		newMapHeight();
		$('#navigation').on({
			'show.uk.offcanvas': function () {
				$('body').css('overflow', 'hidden');
			},
			'hide.uk.offcanvas': function () {
				$('body').css('overflow', '');
			}
		});

		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#backToTop').fadeIn();
			} else {
				$('#backToTop').fadeOut();
			}
		});
		$('time.timeago').timeago();
		$('body').on('keyup', 'input[data-numbers]', function () {
			var value = $(this).val().replace(/[^\d]*/g, '').replace(/^[^\d]*(\d+([.,]\d{0,5})?).*$/g, '$1');
			$(this).val(value);
		});
		if ($('*').is('.uk-form-file-input')) {
			$('input.uk-form-file-input').change(function () {
				$(this).parent().find('.uk-form-file-text').text(jQuery(this).val());
			});
		}

		$('#regionSelect').on('show.uk.modal', function () {
			$('#openRegionSelect').trigger('click');
		});

		$('[data-set-region]').live('click', function () {
			UIkit.modal('#regionSelect').hide();
			$.cookie('region', $(this).data('set-region'), {expires: 365, path: '/'});
			location.reload();
		});

		if ($('*').is('[data-phones]')) {
			phones('start', $(this));
		}
		$('body').on('click', '[data-phone-add]', function () {
			phones('add', $(this).parents('[data-phones]'));
		});

		function phones(action, parent) {
			var phones = parent.find('[data-phone]');
			if (action == 'start') {
				$(phones).each(function () {
					var input = $(this).find('[data-phone-number] input');
					if (input.val() !== '') {
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
			var show = parent.find('[data-phone].uk-show');
			if (show.length == phones.length) {
				parent.find('[data-phone-add]').addClass('uk-hidden');
			}
		}

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
		});
		$('#tabs-nav a').on('click', function () {
			var hash = $(this).parent().attr('class');
			window.location.hash = hash;
		});

		if ($('body').find('#modal-map').length > 0) {
			var map;

			function modalMap() {
				var map = new ymaps.Map('modal-map', {
					center: [0, 0],
					zoom: 10,
					controls: ['zoomControl']
				});
				$('body').on('click', '[data-nerudas-modal-map]', function () {
					var data = $(this).data('nerudas-modal-map');
					UIkit.modal('#mapModal').show();
					$('#modal-map').height(Math.round(($('#modal-map').width() / 4) * 3));
					$('#mapModal .uk-modal-header').html('<a href="' + data.link + '" class="uk-link-muted">' + data.title + '</a>');
					// Mark
					map.geoObjects.removeAll();
					contentLayout = ymaps.templateLayoutFactory.createClass(
						'<a style=" display:block; position: absolute; padding: 10px; bottom: 10px; color: #444; font-weight: bold; text-align: left; white-space: nowrap; border: 1px solid #e5e5e5; background: #fff;" href="' + data.link + '">' + data.title + '</a>'
					),
						map.setCenter([data.latitude, data.longitude], data.zoom, {
							checkZoomRange: true
						});
					map.geoObjects.add(new ymaps.Placemark([data.latitude, data.longitude], {
						balloonContentHeader: '<a href="' + data.link + '">' + data.title + '</a>',
						balloonContent: data.text,
						iconContent: data.title

					}, {
						iconImageHref: data.mark,
						iconLayout: 'default#imageWithContent',
						iconImageSize: JSON.parse(data.markSize),
						iconImageOffset: JSON.parse(data.markOffset),
						iconContentLayout: contentLayout,
						preset: 'default#image'
					}))
				});
			}

			ymaps.ready(modalMap);
		}
		setMiddleMinHeight();
		setRatioHeight();
		headerBreadcrumb();

	});
	$(window).resize(function () {
		setMiddleMinHeight();
		setRatioHeight();
		headerBreadcrumb();
		newMapHeight();
	});
})(jQuery);

function setAutoTextFieldWidth(filter) {
	var width = (filter.val().length + 1) * 8;
	filter.css('width', width);
}

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