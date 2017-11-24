/*
 * @package    Nerudas Template
 * @version    4.9.3
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

/*! UIkit 2.27.4 | http://www.getuikit.com | (c) 2014 YOOtheme | MIT License */
(function (addon) {

	var component;

	if (window.UIkit2) {
		component = addon(UIkit2);
	}

	if (typeof define == 'function' && define.amd) {
		define('uikit-form-password', ['uikit'], function () {
			return component || addon(UIkit2);
		});
	}

})(function (UI) {

	"use strict";

	UI.component('formPassword', {

		defaults: {
			lblShow: 'Show',
			lblHide: 'Hide'
		},

		boot: function () {
			// init code
			UI.$html.on('click.formpassword.uikit', '[data-uk-form-password]', function (e) {

				var ele = UI.$(this);

				if (!ele.data('formPassword')) {

					e.preventDefault();

					UI.formPassword(ele, UI.Utils.options(ele.attr('data-uk-form-password')));
					ele.trigger('click');
				}
			});
		},

		init: function () {

			var $this = this;

			this.on('click', function (e) {

				e.preventDefault();

				if ($this.input.length) {
					var type = $this.input.attr('type');
					$this.input.attr('type', type == 'text' ? 'password' : 'text');
					$this.element.html($this.options[type == 'text' ? 'lblShow' : 'lblHide']);
				}
			});

			this.input = this.element.next('input').length ? this.element.next('input') : this.element.prev('input');
			this.element.html(this.options[this.input.is('[type="password"]') ? 'lblShow' : 'lblHide']);


			this.element.data('formPassword', this);
		}
	});

	return UI.formPassword;
});
