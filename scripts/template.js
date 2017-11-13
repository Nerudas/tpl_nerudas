/**
 * @package     Nerudas Template
 * @version     5.0
 * @author      Nerudas - nerudas.ru
 * @copyright   Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
(function($){
	function setRatioHeight() {
		$($('[data-ratio-height]')).each(function () {
			var data = $(this).data('ratio-height');
			var width = data[0];
			var height = data[1];
			$(this).height(Math.round(($(this).width()/width)*height));	
			
		});
	}
	function setMiddleMinHeight() {
		if($('*').is('.tm-middle')) {
			var middleHeight = $(window).height() - $('.tm-middle').offset().top - $('.tm-footer').outerHeight(true);
			if (middleHeight <  $(window).height()){
				// $('.tm-middle').css('min-height',middleHeight);	
			}
		}
	}
/*		var ellements = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .item');
		var ellement = $(ellements[0]);
		var ellementTitle = ellement.find('a').text();
		var dropItem = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop');
		var dropList = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop ul');
		var dropElements = dropList.find('.item');
		var dropElement = $(dropElements[0]);
		var dropTitle = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop > a > .text');
			dropTitle.text(ellementTitle);
			ellement.append(dropList);
			dropItem.removeClass('uk-hidden');
			dropElement.append(list);
				headerBreadcrumb ();
					if (dropElements.length > 0) {
				
			}
			else {
				//dropItem.addClass('uk-hidden');
			}
*/
	function headerBreadcrumb () {
		var block = $('.tm-top .uk-navbar-breadcrumb');
		var list = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb');
		var dropItem = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop');
		var dropList = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop ul');
		var dropTitle = $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .drop > a > .text');
		if (list.width() > block.width()) {
			$($('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .item')).each(function () {
				if ($(list).width() > block.width()) {
					var items =  $('.tm-top .uk-navbar-breadcrumb .uk-breadcrumb > .item');
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
					var dropItems =  $(this).parent().find('li');
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
	
	$(document).ready(function() {
		$('#navigation').on({
			'show.uk.offcanvas': function(){
				$('body').css('overflow', 'hidden');
			},
			'hide.uk.offcanvas': function(){
				$('body').css('overflow', '');
			}
		});
		$('body').on('keyup', 'input[data-numbers]',  function() {
			var value = $(this).val().replace(/[^\d]*/g, '').replace(/^[^\d]*(\d+([.,]\d{0,5})?).*$/g, '$1');
			$(this).val(value);
		});
		if($('*').is('.uk-form-file-input')) {
			$('input.uk-form-file-input').change(function() {
				$(this).parent().find('.uk-form-file-text').text(jQuery(this).val());
			});
		}

		setMiddleMinHeight();
		setRatioHeight();
		headerBreadcrumb();
		
	});
	$(window).resize(function () {
		setMiddleMinHeight();
		setRatioHeight();
		headerBreadcrumb();
	});
})(jQuery);
function setAutoTextFieldWidth (filter){
	var width = (filter.val().length + 1) * 8;
	filter.css('width', width);
}
