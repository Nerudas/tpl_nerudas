/*
 * @package    Nerudas Template
 * @version    4.9.18
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

(function ($) {
	$(document).ready(function () {


		$('[data-tabmap]').each(function () {
			var link = $(this),
				selector = link.data('tabmap'),
				data = Joomla.getOptions(selector, ''),
				map = false;
			if (data !== '') {
				var initializeMap = setInterval(function () {
					if ($('#' + data.params.container).width() > 0 && $('#' + data.params.container).height() > 0) {
						clearInterval(initializeMap);
						ymaps.ready(function () {
							var mapParams = {};
							mapParams.center = [0, 0];
							mapParams.zoom = 0;
							var storageParams = localStorage.getItem('map');
							if (storageParams) {
								storageParams = $.parseJSON(storageParams);
								if (storageParams.center) {
									mapParams.center = storageParams.center;
								}
								if (storageParams.zoom) {
									mapParams.zoom = storageParams.zoom;
								}
							}

							map = new ymaps.Map(data.params.container, {
								center: mapParams.center,
								zoom: mapParams.zoom,
								controls: ['zoomControl', 'fullscreenControl', 'geolocationControl']
							});

							// Set Center
							var center = $.parseJSON(data.params.center),
								zoom = data.params.zoom * 1;

							map.setCenter(center, zoom, {
								checkZoomRange: true
							});

							// Placemark
							map.geoObjects.removeAll();
							var coordinates = $.parseJSON(data.placemark.coordinates),
								options = {};
							if (data.placemark.options) {
								$.each(data.placemark.options, function (key, value) {
									if (key == 'customLayout') {
										key = 'iconLayout';
										value = ymaps.templateLayoutFactory.createClass(value);
									}
									options[key] = value;
								});
							}
							else {
								options.iconLayout = 'default#image';
								options.iconImageHref = '/media/plg_fieldtypes_map/images/placemark.png';
								options.iconImageSize = [48, 48];
								options.iconImageOffset = [-24, -48];
							}

							var placemark = new ymaps.Placemark(coordinates, {}, options);
							map.geoObjects.add(placemark);

							// On change map bounds
							map.events.add('boundschange', function (event) {
								//  Change zoom
								if (event.get('newZoom') != event.get('oldZoom')) {
									var zoom = event.get('newZoom');

									mapParams.zoom = zoom;
								}

								//  Change center
								if (event.get('newCenter') != event.get('oldCenter')) {
									var
										latitude = event.get('newCenter')[0].toFixed(6),
										longitude = event.get('newCenter')[1].toFixed(6),
										center = [latitude, longitude];

									mapParams.center = center;
									mapParams.latitude = latitude;
									mapParams.longitude = longitude;
								}

								localStorage.setItem('map', JSON.stringify(mapParams));
							});
						});
					}
				}, 3);
			}
		});

	});

})(jQuery);
