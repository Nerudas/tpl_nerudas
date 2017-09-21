/*
 * @package    Nerudas Template
 * @version    5.0.0
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

/* Fix uikit cover image size */
function ukCoverImageFix() {
	$($("img[data-uk-cover]")).each(function () {
		var t = $(this).parents(".uk-cover-container");
		$(this).css("min-height", t.height())
	})
}

/* Set Ratio Height */
function setRatioHeight() {
	$($("[data-ratio-height]")).each(function () {
		var t = $(this).data("ratio-height").match(/(\d+):(\d+)/);
		if (null !== t) {
			var a = t[1], i = t[2];
			a && i && $(this).height(Math.round($(this).width() / a * i))
		} else console.error("data-ratio-height syntaxis eror")
	})
}

/* Set min Ratio Height */
function setRatioMinHeight() {
	$($("[data-ratio-min-height]")).each(function () {
		var t = $(this).data("ratio-min-height").match(/(\d+):(\d+)/);
		if (null !== t) {
			var a = t[1], i = t[2];
			a && i && $(this).css("min-height", Math.round($(this).width() / a * i))
		} else console.error("data-ratio-min-height syntaxis eror")
	})
}


/* Document ready tirger */
$(document).ready(function () {
	ukCoverImageFix();
	setRatioHeight();
	setRatioMinHeight();
});

/* Window resize tirger */
$(window).resize(function () {
	ukCoverImageFix();
	setRatioMinHeight();
	setRatioHeight();
});
