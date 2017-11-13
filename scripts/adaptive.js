/**
 * @package     JoomlaZen Nerudas Template
 * @version     4.4
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2016 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

(function ($) {
	/* Ads */
	function adaptiveAds() {
		if ($('body').innerWidth() <= 479) {
			$('#ads.itemlist .item').each(function () {
				$(this).find('.title').appendTo($(this).find('.appendTop'));
				$(this).find('.category').appendTo($(this).find('.appendTop'));
				$(this).find('.image').appendTo($(this).find('.appendLeft'));
				$(this).find('.date').appendTo($(this).find('.appendMiddle'));
				$(this).find('.price ').appendTo($(this).find('.appendMiddle'));
				$(this).find('.icons').appendTo($(this).find('.appendMiddle'));
				$(this).find('.author').appendTo($(this).find('.appendBottom'));
			});
			$('#ads.article .introtext').appendTo($('#ads.article .appendTop'));
			$('#adsitem-author').appendTo($('#ads.article .appendLeft'));
			$().appendTo('#appendAddButton');
		}
		if ($('body').innerWidth() >= 480) {
			$('#ads.itemlist .item').each(function () {
				$(this).find('.title').appendTo($(this).find('.appendTop'));
				$(this).find('.date').appendTo($(this).find('.appendTop'));
				$(this).find('.image').appendTo($(this).find('.appendLeft'));
				$(this).find('.category').appendTo($(this).find('.appendMiddle'));
				$(this).find('.price ').appendTo($(this).find('.appendMiddle'));
				$(this).find('.icons').appendTo($(this).find('.appendMiddle'));
				$(this).find('.author').appendTo($(this).find('.appendMiddle'));
			});
			$('#ads.article .introtext').appendTo($('#ads.article .appendTop'));
			$('#adsitem-author').appendTo($('#ads.article .appendMiddle'));

		}
		if ($('body').innerWidth() >= 768) {
			$('#ads.itemlist .item').each(function () {
				$(this).find('.image').appendTo($(this).find('.appendLeft'));
				$(this).find('.title').appendTo($(this).find('.appendMiddle'));
				$(this).find('.category').appendTo($(this).find('.appendMiddle'));
				$(this).find('.author').appendTo($(this).find('.appendMiddle'));
				$(this).find('.date').appendTo($(this).find('.appendRight'));
				$(this).find('.price ').appendTo($(this).find('.appendRight'));
				$(this).find('.icons').appendTo($(this).find('.appendRight'));

			});
			$('#ads.article .introtext').appendTo($('#ads.article .appendMiddle'));
			$('#adsitem-author').appendTo($('#ads.article .appendLeft'));

		}
		if ($('body').innerWidth() >= 960) {
			$('#ads.itemlist .item').each(function () {
				$(this).find('.image').appendTo($(this).find('.appendLeft'));
				$(this).find('.title').appendTo($(this).find('.appendMiddle'));
				$(this).find('.category').appendTo($(this).find('.appendMiddle'));
				$(this).find('.author').appendTo($(this).find('.appendMiddle'));
				$(this).find('.date').appendTo($(this).find('.appendRight'));
				$(this).find('.price ').appendTo($(this).find('.appendRight'));
				$(this).find('.icons').appendTo($(this).find('.appendRight'));
			});
			$('#ads.article .introtext').appendTo($('#ads.article .appendMiddle'));
			$('#adsitem-author').appendTo($('#appendLeft'));


		}
		if ($('body').innerWidth() >= 1220) {
			$('#ads.itemlist .item').each(function () {
				$(this).find('.image').appendTo($(this).find('.appendLeft'));
				$(this).find('.title').appendTo($(this).find('.appendMiddle'));
				$(this).find('.category').appendTo($(this).find('.appendMiddle'));
				$(this).find('.author').appendTo($(this).find('.appendMiddle'));
				$(this).find('.date').appendTo($(this).find('.appendRight'));
				$(this).find('.price ').appendTo($(this).find('.appendRight'));
				$(this).find('.icons').appendTo($(this).find('.appendRight'));
			});
			$('#ads.article .introtext').appendTo($('#ads.article .appendMiddle'));
			$('#ads.article .icons').appendTo($('#ads.article .appendLeft'));
			$('#ads.article .mapimage').appendTo($('#ads.article .appendLeft'));
			$('#adsitem-author').appendTo($('#appendRight'));

		}
	}
	/* K2 Form System */
	function adaptiveK2FormSystem() {
		if ($('body').innerWidth() <= 479) {
			$('#k2FormSystem').appendTo($('#appendBeforeSave'));
		}
		if ($('body').innerWidth() >= 480) {
			$('#k2FormSystem').appendTo($('#appendBeforeSave'));
		}
		if ($('body').innerWidth() >= 768) {
			$('#k2FormSystem').appendTo($('#appendBeforeSave'));
		}
		if ($('body').innerWidth() >= 960) {
			$('#k2FormSystem').appendTo($('#appendLeftBottom'));
		}
		if ($('body').innerWidth() >= 1220) {
			$('#k2FormSystem').appendTo($('#appendRightBottom'));
		}
	}
	/* Rubrics - Normal */
	function adaptiveRubricsNormal() {
		$('#rubricsMobile').appendTo('body');
		if ($('body').innerWidth() <= 479) {
			$('#rubricsMenu.normal').appendTo('#rubricsMobile .uk-offcanvas-bar');
			$('#rubricsMenu.normal').attr('class', 'normal uk-nav uk-nav-parent-icon uk-nav-offcanvas uk-contrast');
		}
		if ($('body').innerWidth() >= 480) {
			$('#rubricsMenu.normal').appendTo('#rubricsMobile .uk-offcanvas-bar');
			$('#rubricsMenu.normal').attr('class', 'normal uk-nav uk-nav-parent-icon uk-nav-offcanvas uk-contrast');
		}
		if ($('body').innerWidth() >= 768) {
			$('#rubricsMenu.normal').appendTo('#rubricsMobile .uk-offcanvas-bar');
			$('#rubricsMenu.normal').attr('class', 'normal uk-nav uk-nav-parent-icon uk-nav-offcanvas uk-contrast');
		}
		if ($('body').innerWidth() >= 960) {
			$('#rubricsMenu.normal').appendTo('#rubricsDesktop');
			$('#rubricsMenu.normal').attr('class', 'normal uk-nav uk-nav-parent-icon uk-nav-side');
		}
		if ($('body').innerWidth() >= 1220) {
			$('#rubricsMenu.normal').appendTo('#rubricsDesktop');
			$('#rubricsMenu.normal').attr('class', 'normal uk-nav uk-nav-parent-icon uk-nav-side');
		}
	}
	/* Rubrics - light */
	function adaptiveRubricsLight() {
		$('#rubricsMobile').appendTo('body');
		if ($('body').innerWidth() <= 479) {
			$('#rubricsMenu.light').appendTo('#rubricsMobile .uk-offcanvas-bar');
			$('#rubricsMenu.light').attr('class', 'light offcanvas uk-contrast');
		}
		if ($('body').innerWidth() >= 480) {
			$('#rubricsMenu.light').appendTo('#rubricsMobile .uk-offcanvas-bar');
			$('#rubricsMenu.light').attr('class', 'light offcanvas uk-contrast');
		}
		if ($('body').innerWidth() >= 768) {
			$('#rubricsMenu.light').appendTo('#rubricsMobile .uk-offcanvas-bar');
			$('#rubricsMenu.light').attr('class', 'light offcanvas uk-contrast');
		}
		if ($('body').innerWidth() >= 960) {
			$('#rubricsMenu.light').appendTo('#rubricsDesktop');
			$('#rubricsMenu.light').attr('class', 'light side');
		}
		if ($('body').innerWidth() >= 1220) {
			$('#rubricsMenu.light').appendTo('#rubricsDesktop');
			$('#rubricsMenu.light').attr('class', 'light side');
		}
	}
	/* Profile Module */
	function adaptiveProfileModule() {
		if ($('body').innerWidth() <= 767) {
			$('header.tm-top .uk-navbar-flip .uk-navbar-nav > .profile > a.link').on('click', function () {
				window.location.href = $(this).data('href');
			});
			$('header.tm-top .uk-navbar-flip .uk-navbar-nav > .profile > a.link').on('tap', function () {
				window.location.href = $(this).data('href');
			});
		}
	}
	/* Simple filter */
	function adaptiveSimpleFilter() {
		$('#simpleFiterMobile').appendTo('body');
		if ($('body').innerWidth() <= 479) {
			$('#simpleFiter').appendTo('#simpleFiterMobile .uk-offcanvas-bar');
		}
		if ($('body').innerWidth() >= 480) {
			$('#simpleFiter').appendTo('#simpleFiterMobile .uk-offcanvas-bar');
		}
		if ($('body').innerWidth() >= 768) {
			$('#simpleFiter').appendTo('#simpleFiterMobile .uk-offcanvas-bar');
		}
		if ($('body').innerWidth() >= 960) {
			$('#simpleFiter').appendTo('#simpleFiterDesktop');
		}
		if ($('body').innerWidth() >= 1220) {
			$('#simpleFiter').appendTo('#simpleFiterDesktop');
		}
	}
	/* Add buttons */
	function adaptiveAddButtons() {
		adaptiveAddButtonsSet('#mod-285'); // Company
		adaptiveAddButtonsSet('#mod-287'); // Remozone
		adaptiveAddButtonsSet('#mod-265'); // Ads
		adaptiveAddButtonsSet('#mod-310'); // News - Comapny
		adaptiveAddButtonsSet('#mod-267'); // News - Rabotaem
		adaptiveAddButtonsSet('#mod-268'); // News - Herak
		adaptiveAddButtonsSet('#mod-269'); // Articles
		adaptiveAddButtonsSet('#mod-283'); // Nerudka
	}
	/* Add buttons Set */
	function adaptiveAddButtonsSet(selector) {
		if ($('body').innerWidth() <= 479) {
			$(selector).appendTo('#appendAddButton');
		}
		if ($('body').innerWidth() >= 480) {
			$(selector).appendTo('#appendAddButton');
		}
		if ($('body').innerWidth() >= 768) {
			$(selector).appendTo('#appendAddButton');
		}
		if ($('body').innerWidth() >= 960) {
			$(selector).appendTo('#appendLeft');
		}
		if ($('body').innerWidth() >= 1220) {
			$(selector).appendTo('#appendRight');
		}
	}

	/*
		function adaptiveName() {
			if ($('body').innerWidth() <= 479) {
				
			}
			if ($('body').innerWidth() >= 480) {
				
			}
			if ($('body').innerWidth() >= 768) {		
				
			}	
			if ($('body').innerWidth() >= 960) {
				
			}	
			if ($('body').innerWidth() >= 1220) {
				
			}	
		}
	*/
	/* General */
	function adaptive() {
		adaptiveAds(); // Ads
		adaptiveK2FormSystem(); // K2 Form System
		adaptiveRubricsNormal(); // RubricsMenu - Normal
		adaptiveRubricsLight(); // RubricsMenu - Light	
		adaptiveProfileModule(); // Profile Module	
		adaptiveSimpleFilter(); // Simple Filter	
		adaptiveAddButtons(); // Addd buttons
	}
	$(document).ready(function () {
		adaptive();
	});
	$(window).resize(function () {
		adaptive();
	});
})(jQuery);
