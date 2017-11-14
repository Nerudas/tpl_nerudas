/*
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
(function($){
	$(document).ready(function() {
		/* Change category */
		showGroups($('#categorySelect li.uk-active a').data('change-category'));
		setActiveGroupsLi($('#categorySelect li.uk-active a').data('change-category'));
		dynamicContent();
		function showGroups (array) {
			$(array).each(function () {
				$('#categorySelect [data-change-category-block="'+this+'"]').removeClass('uk-hidden');
			});
		}
		function setActiveGroupsLi (array) {
			$(array).each(function () {
				$('#categorySelect [data-change-category-li="'+this+'"]').addClass('uk-active');
			});
		}
		$('#categorySelect a[data-change-category]').live('click',function() {
			$('[data-change-category-block]').addClass('uk-hidden');
			$('[data-change-category-li]').removeClass('uk-active');
			showGroups($(this).data('change-category'));
			setActiveGroupsLi($(this).data('change-category'));
			$('input[name=catid]').val($(this).data('change-category-id'));
			dynamicContent();
			$.ajax({
				type: 'POST', 
				dataType: 'json', 
				url: 'index.php?option=com_nerudas&format=json&task=k2.itemformCategoryChange',
				data: {
					catid : $(this).data('change-category-id'), 
					action : $(this).data('change-category-action'), 
					title : document.title,
					link : window.location.href,
				}, 
				success: function(response){ 
					console.log(response); 
					$('[data-change-category-new-name]').html(response.data.title);
					$('[data-change-category-new-title]').html(response.data.pageTitle);
					$('#k2thumb').attr('src', response.data.thumb);
					document.title = response.data.pageTitle;
					history.pushState('', response.data.pageTitle, response.data.pageLink);
				}
			});
					
					
		}); 
		function dynamicContent() {			
			$($('#adminForm [data-dynamic-content]')).each(function () {
				var catid = $('input[name=catid]').val();
				var ids = $(this).data('dynamic-content');
				var element = $(this);
				element.addClass('uk-hidden');
				$.each(ids , function (i, val) {
				  if (catid == val){
					  element.removeClass('uk-hidden');
				  }
				});				
			});
		}
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
		// Chnage Author
		$('#authorSelect').on({'show.uk.modal': function(){
				$('[data-change-author-block]').html('');
				changeAuthorLoadList();
			}
		});
		$('#authorChange input').keypress(function (e) {
  			if (e.which == 13) {
				$('[data-change-author-block]').html('');
				changeAuthorLoadList();
				return false;
			}
		});
		$('body').on('click', '[data-change-author-more]',  function() {
			changeAuthorLoadList();
		});

		$('body').on('click', '[data-change-author]',  function() {
			var id = $(this).data('change-author');
			var name = $(this).data('change-author-name');
			$('input[name="created_by"]').val(id);
			$('[data-change-author-new-name]').text(name);
			UIkit.modal('#authorSelect').hide();
		});
	
		function changeAuthorLoadList(){
			var search = $('#authorChange input').val();
			var offset = $('[data-change-author-block]').find('[data-change-author]').length;
			var limit = 5;
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'index.php?option=com_nerudas&format=json&task=k2.itemformAuthorChange',
				data: {'search': search, 'offset': offset, 'limit': limit},
				beforeSend: function() {
					$('[data-change-author-load]').removeClass('uk-hidden');
					$('[data-change-author-more]').addClass('uk-hidden');
				},
				complete: function() {
					$('[data-change-author-load]').addClass('uk-hidden');
				},
				success: function(response){
					var content = response.data.html;
					$(content).appendTo('[data-change-author-block]');
					if (response.data.count == limit) {
						$('[data-change-author-more]').removeClass('uk-hidden');
					}
				},
				error: function(){
				}
			});
			
		}
	});	
})(jQuery);