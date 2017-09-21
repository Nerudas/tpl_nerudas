/*
 * @package    Nerudas Template
 * @version    5.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
		typeof define === 'function' && define.amd ? define('uikit-template', factory) :
			(global.UIkitTemplate = factory());
}(this, (function () {
	'use strict';
	var Icons = {};
	function plugin(UIkit) {
		if (plugin.installed) {
			return;
		}
		UIkit.icon.add(Icons);
	}

	if (typeof window !== 'undefined' && window.UIkit) {
		window.UIkit.use(plugin);
	}
	return plugin;
})));