/*
 * @package    Nerudas Template
 * @version    4.9.1
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2017 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */
(function ($) {
	var map;
	function modalMap() {
		var map = new ymaps.Map('modal-map', {
			center: [0,0],
			zoom:  10,
			controls: ['zoomControl'],
		});
		$('body').on('click', '[data-nerudas-modal-map]',  function() {
			var data = $(this).data('nerudas-modal-map');
			UIkit.modal('#mapModal').show();
			$('#modal-map').height(Math.round(($('#modal-map').width()/4)*3));
			$('#mapModal .uk-modal-header').html('<a href="'+data.link+'" class="uk-link-muted">'+data.title+'</a>');
			// Mark	 
			map.geoObjects.removeAll();
			contentLayout = ymaps.templateLayoutFactory.createClass(
            	'<a style=" display:block; position: absolute; padding: 10px; bottom: 10px; color: #444; font-weight: bold; text-align: left; white-space: nowrap; border: 1px solid #e5e5e5; background: #fff;" href="'+data.link+'">'+data.title+'</a>'
			 ),
			map.setCenter([data.latitude, data.longitude], data.zoom, {
				checkZoomRange: true
			});
			map.geoObjects.add(new ymaps.Placemark([data.latitude, data.longitude], {
				balloonContentHeader: '<a href="'+data.link+'">'+data.title+'</a>',
				balloonContent: data.text,
				iconContent: data.title,
				 
			}, {
				iconImageHref: data.mark,
				iconLayout :'default#imageWithContent',
				iconImageSize : JSON.parse(data.markSize),
				iconImageOffset : JSON.parse(data.markOffset),
				iconContentLayout: contentLayout,				
				preset: 'default#image'
			}))
		});
	}
	ymaps.ready(modalMap);	
	
})(jQuery)
