/**
 * @package     JoomlaZen Nerudas Template
 * @version     4.3
 * @author      JoomlaZen - www.joomlazen.com
 * @copyright   Copyright (c) 2016 - 2016 JoomlaZen. All rights reserved.
 * @license     GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
(function($){
	$(document).ready(function() {	
		$(".phone input").focus(function(){
			$(this).parent().find('.code').addClass("uk-text-danger");
			$(this).parent().find('.code').removeClass("uk-text-color-inherit");
		})
		.blur(function(){
			if(!$(this).val()) {
				$(this).parent().find('.code').removeClass("uk-text-danger");
			}
			else {
				$(this).parent().find('.code').removeClass("uk-text-danger");
				$(this).parent().find('.code').addClass("uk-text-color-inherit");
			}
		})
	});
})(jQuery);
function phone(inp) {
	inp.value = inp.value.replace(/[^\d]*/g, '')
	.replace(/^[^\d]*(\d+([.,]\d{0,5})?).*$/g, '$1');
}