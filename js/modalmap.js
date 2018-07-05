/*
 * @package    Nerudas Template
 * @version    4.9.22
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

(function ($) {
	$(document).ready(function () {

		// Create modal
		if ($('#modalmap').length == 0) {
			var modalHTML = '<div id="modalmap" class="uk-modal">\n' +
				'    <div id="modalmap_map" class="uk-modal-dialog">\n' +
				'        <a class="uk-modal-close uk-close"></a>\n' +
				'    </div>\n' +
				'</div>';
			$('body').append($(modalHTML));
		}

		var modal = UIkit.modal('#modalmap'),
			map = false;

		$('[data-modalmap]').each(function () {
			var link = $(this),
				selector = link.data('modalmap'),
				data = Joomla.getOptions(selector, '');
			if (data !== '') {
				$(link).on('click', function () {
					modal.show();
					if (!map) {
						initializeMap();
					}
					checkMap(function (map) {

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

						if (data.link) {
							placemark.events.add('click', function () {
								window.location.href = data.link;
							});
						}
					});
				});
			}
		});

		function checkMap(callback) {
			var test = setInterval(function () {
				if (map) {
					clearInterval(test);
					callback(map);
				}
			}, 3);
		}

		// Map initialization
		function initializeMap() {
			var setHeight = setInterval(function () {
				$('#modalmap_map').height(Math.round(($('#modalmap_map').width() / 4) * 3));
				if ($('#modalmap_map').width() > 0 && $('#modalmap_map').height() > 0) {
					clearInterval(setHeight);
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

						map = new ymaps.Map('modalmap_map', {
							center: mapParams.center,
							zoom: mapParams.zoom,
							controls: ['zoomControl', 'fullscreenControl', 'geolocationControl']
						});

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

})(jQuery);
