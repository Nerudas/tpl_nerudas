/*
 * @package    Nerudas Template
 * @version    4.9.7
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

(function ($) {
	$(document).ready(function () {

		var initializeMap = setInterval(function () {
			var params = Joomla.getOptions('profileMap', ''),
				mapSelector = params.selector,
				map = false;

			$('#' + mapSelector).height(Math.round(($('#' + mapSelector).width() / 4) * 3));
			if ($('#' + mapSelector).width() > 0 && $('#' + mapSelector).height() > 0) {
				clearInterval(initializeMap);
				ymaps.ready(function () {
					// Set Params
					var storageParams = localStorage.getItem('map'),
						mapParams = {};
					if (storageParams) {
						storageParams = $.parseJSON(storageParams);
					}
					else {
						storageParams = {
							latitude: params.latitude,
							longitude: params.longitude,
							center: params.center,
							zoom: params.zoom
						};
						localStorage.setItem('map', JSON.stringify(storageParams));
					}
					mapParams = storageParams;

					map = new ymaps.Map(mapSelector, {
						center: mapParams.center,
						zoom: mapParams.zoom,
						controls: ['zoomControl', 'fullscreenControl', 'geolocationControl']
					});

					// Board
					var boardTotal = 0,
						boardOffset = 0;

					function getBoard() {
						var ajaxData = [];
						ajaxData.push({name: 'filter[author_id]', value: params.author_id});
						ajaxData.push({name: 'filter[allregions]', value: 1});
						if (boardTotal == 0) {
							$.ajax({
								type: 'GET',
								dataType: 'json',
								url: '/index.php?option=com_board&task=map.getItemsTotal',
								data: ajaxData,
								success: function (response) {
									var total = response.data;
									boardTotal = total;
									if (total > 0) {
										getBoard();
									}
								}
							});
						}
						if (boardTotal > 0) {
							ajaxData.push({name: 'limitstart', value: boardOffset});
							itemsRequest = $.ajax({
								type: 'GET',
								dataType: 'json',
								url: '/index.php?option=com_board&task=map.getItems',
								data: ajaxData,
								success: function (response) {
									if (response.success) {
										var data = response.data,
											placemarks = data.placemarks;
										$.each(placemarks, function (key, placemark) {
											var coordinates = $.parseJSON(placemark.coordinates),
												options = {};
											if (placemark.options) {
												$.each(placemark.options, function (key, value) {
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
											var object = new ymaps.Placemark(coordinates, {}, options);
											map.geoObjects.add(object);
											if (placemark.link) {
												object.events.add('click', function () {
													window.open(placemark.link, '_blank');
												});
											}
										});

										boardOffset = boardOffset + data.count;
										map.setBounds(map.geoObjects.getBounds(), {
											checkZoomRange: true,
											zoomMargin: 100
										});

										if (boardOffset < boardTotal) {
											getBoard();
										}
									}
								}
							});
						}
					}

					getBoard();

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
	});
})(jQuery);