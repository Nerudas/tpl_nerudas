<?php
/**
 * @package    Nerudas Template
 * @version    4.9.18
 * @author     Nerudas  - nerudas.ru
 * @copyright  Copyright (c) 2013 - 2018 Nerudas. All rights reserved.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 * @link       https://nerudas.ru
 */

defined('_JEXEC') or die;
?>
<script>
	ymaps.ready(initializeMap);

	function initializeMap() {
		(function ($) {
			// Map
			$(document).ready(function () {
				if (localStorage.getItem('mapCenter')) {
					center = [localStorage.getItem('mapCenterLat'), localStorage.getItem('mapCenterLng')];
				}
				else {
					center = <?php echo $this->get('params')->map->center; ?>;
				}
				if (localStorage.getItem('mapZoom')) {
					zoom = localStorage.getItem('mapZoom');
				}
				else {
					zoom = <?php echo $this->get('params')->map->zoom; ?>;
				}
			});
			var map = new ymaps.Map('map', {
				center: center,
				zoom: zoom,
				controls: []
			})
			map.behaviors.disable("dblClickZoom");
			map.events.add('boundschange', function (event) {
				if (event.get('newZoom') != event.get('oldZoom')) {
					localStorage.setItem('mapZoom', event.get('newZoom'));
				}
				if (event.get('newCenter') != event.get('oldCenter')) {
					localStorage.setItem('mapCenter', event.get('newCenter'));
					localStorage.setItem('mapCenterLat', event.get('newCenter')[0]);
					localStorage.setItem('mapCenterLng', event.get('newCenter')[1]);
				}
			});
			// Object Manager
			objectManager = new ymaps.ObjectManager({
				clusterize: true,
				clusterDisableClickZoom: true,
				clusterOpenBalloonOnClick: false,
				clusterBalloonPanelMaxMapArea: 0,
				gridSize: 64,
				minClusterSize: <?php echo $this->get('params')->map->cluster->size; ?>

			});
			map.geoObjects.add(objectManager);
			// Cluster
			objectManager.clusters.options.set({
				preset: 'islands#invertedBlackClusterIcons',
				clusterIcons: <?php echo $this->get('params')->map->cluster->icons; ?>,
				clusterNumbers: <?php echo $this->get('params')->map->cluster->numbers; ?>
			});
			objectManager.clusters.events.add('click', function (e) {
				objectManager.clusters.setClusterOptions(e.get('objectId'), {
					preset: 'islands#invertedBlackClusterIcons',
					clusterIcons: <?php echo $this->get('params')->map->cluster->iconsClick; ?>,
					clusterNumbers: <?php echo $this->get('params')->map->cluster->numbers; ?>
				});
			});
			// Marks
			$(document).ready(function () {
				addMarks();
			});
			map.events.add('boundschange', function (event) {
				addMarks();
			});

			function addMarks(objects) {
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: '<?php echo $this->get('params')->map->ajaxLink; ?>getmarks',
					data: {
						bounds: getBounds(),
						objects: getShowMarks(),
						<?php if (isset($this->get('params')->map->categories)){ ?>
						categories: <?php echo $this->get('params')->map->categories; ?>,
						<?php } ?>
						<?php if (isset($this->get('params')->map->filter)){ ?>
						filter: <?php echo $this->get('params')->map->filter; ?>,
						<?php } ?>
					},
					beforeSend: function (marks) {
						$('#loading').show();
					},
					success: function (marks) {
						objectManager.add(marks.data);
					},
					complete: function (marks) {
						$('#loading').hide();
					},
				})
			};

			function getShowMarks() {
				var mapObjects = [];
				for (var key in objectManager.objects.getAll()) {
					var objectState = objectManager.getObjectState(objectManager.objects.getAll()[key].id);
					var objectId = objectManager.objects.getAll()[key].id;
					var objectType = objectManager.objects.getAll()[key].type;
					if (objectState.isShown) {
						mapObjects.push({id: objectId, type: objectType});
					}
				}
				;
				if (mapObjects.length > 500) {
					objectManager.removeAll();
					mapObjects = null;
				}
				return mapObjects;
			}

			function getBounds() {
				var projection = map.options.get('projection');
				var center = map.getGlobalPixelCenter();
				var zoom = map.getZoom();
				var size = map.container.getSize();
				var lowerCorner = projection.fromGlobalPixels([
					center[0] - size[0] / 2 + <?php echo $this->get('params')->map->offset->left; ?>,
					center[1] + size[1] / 2 - <?php echo $this->get('params')->map->offset->bottom; ?>
				], zoom);
				var upperCorner = projection.fromGlobalPixels([
					center[0] + size[0] / 2 - <?php echo $this->get('params')->map->offset->right; ?>,
					center[1] - size[1] / 2 + <?php echo $this->get('params')->map->offset->top; ?>
				], zoom);
				var mapBounds = map.getBounds();
				var offsetBounds = [lowerCorner, upperCorner];
				var north = offsetBounds[1][0];
				var south = offsetBounds[0][0];
				if (mapBounds[0][1].toFixed(6) != mapBounds[1][1].toFixed(6)) {
					var west = offsetBounds[0][1];
					var east = offsetBounds[1][1];
				}
				else {
					var west = -180;
					var east = 180;
				}
				var bounds = [[south, west], [north, east]];
				return bounds;
			}

			objectManager.objects.events.add('click', function (e) {
				objectManager.objects.setObjectOptions(e.get('objectId'), {
					iconImageHref: objectManager.objects.getById(e.get('objectId')).options.iconClickImageHref,
					iconImageSize: objectManager.objects.getById(e.get('objectId')).options.iconClickImageSize,
					iconImageOffset: objectManager.objects.getById(e.get('objectId')).options.iconClickImageOffset
				});
			});
			// Balloon
			objectManager.clusters.events.add('click', function (e) {
				var objectId = e.get('objectId');
				var cluster = objectManager.clusters.getById(objectId)
				var objects = cluster.features;
				showBalloon(objects);

			});
			objectManager.objects.events.add('click', function (e) {
				var objectId = e.get('objectId');
				var mark = objectManager.objects.getById(objectId);
				var objects = [mark];
				showBalloon(objects);

			});

			function showBalloon(objects) {
				UIkit.modal('#baloon').show();
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: '<?php echo $this->get('params')->map->ajaxLink; ?>getBalloon',
					data: {
						objects: objects,
						theme: '<?php echo $this->get('params')->map->balloon->layout; ?>',
					},
					beforeSend: function (balloon) {
						$('#baloon .list').html('');
						$('#baloon .loading').show();
					},
					success: function (balloon) {
						$('#baloon .list').html(balloon.data);
					},
					complete: function (balloon) {
						$('#baloon .loading').hide();
					}
				})
			}

			// Zoom
			$(document).ready(function () {
				$('#zoom .count').html(map.getZoom().toFixed());
				$('#zoom .plus').on('click', function () {
					if (map.getZoom() != 20) {
						map.setZoom(map.getZoom() + 1, {duration: 500});
					}
				});
				$('#zoom .minus').on('click', function () {
					if (map.getZoom() != 0) {
						map.setZoom(map.getZoom() - 1, {duration: 500});
					}
				});
			});
			map.events.add('boundschange', function (event) {
				if (event.get('newZoom') != event.get('oldZoom')) {
					$('#zoom .count').html(event.get('newZoom').toFixed());
					if (event.get('newZoom') == 20) {
						$('#zoom .plus').addClass('mutted');
					}
					else {
						$('#zoom .plus').removeClass('mutted');
					}
					if (event.get('newZoom') == 0) {
						$('#zoom .minus').addClass('mutted');
					}
					else {
						$('#zoom .minus').removeClass('mutted');
					}
				}
			});
			// Geo
			$(document).ready(function () {
				$('#geo').on('click', function () {
					ymaps.geolocation.get().then(function (geo) {
						var coords = geo.geoObjects.position;
						map.setCenter(coords, 15);
						map.geoObjects.add(new ymaps.Placemark(coords, {}, {preset: 'islands#geolocationIcon'}))
					});
				});
			});
			<?php if (isset($this->get('params')->form)): ?>
			// Edit map
			var mapEdit, mapEditPlacemark, mapEditCoords;

			function initializeMapEdit() {
				$('#addMarkmap').html('');

				mapEdit = new ymaps.Map("addMarkmap", {
					center: map.getCenter(),
					zoom: map.getZoom(),
					controls: ["zoomControl", "fullscreenControl", "geolocationControl"]
				});
				mapEdit.behaviors.disable("scrollZoom");
				var searchControl = new ymaps.control.SearchControl({
					options: {
						float: "left",
						floatIndex: 100,
						noPlacemark: true
					}
				});
				mapEdit.controls.add(searchControl);
				mapEditCoords = mapEdit.getCenter();
				mapEditPlacemark = new ymaps.Placemark(mapEdit.getCenter(), {}, {
					preset: "islands#redIcon",
					draggable: true
				});
				mapEdit.geoObjects.add(mapEditPlacemark);

				mapEditPlacemark.events.add("dragend", function (e) {
					mapEditCoords = this.geometry.getCoordinates();
					mapEditSaveCoords();
				}, mapEditPlacemark);
				mapEdit.events.add("click", function (e) {
					mapEditCoords = e.get("coords");
					mapEditSaveCoords();
				});

				searchControl.events.add("resultselect", function (e) {
					mapEditCoords = searchControl.getResultsArray()[0].geometry.getCoordinates();
					mapEditSaveCoords();
				});

				function mapEditSaveCoords() {
					var new_mapEditCoords = [mapEditCoords[0], mapEditCoords[1]];
					var new_mapEditCoords_lat = [mapEditCoords[0]];
					var new_mapEditCoords_lng = [mapEditCoords[1]];
					mapEditPlacemark.getOverlaySync().getData().geometry.setCoordinates(new_mapEditCoords);
					document.getElementById("addMarkLatitude").value = new_mapEditCoords_lat;
					document.getElementById("addMarLongitude").value = new_mapEditCoords_lng;
				}

				var new_mapEditCoords = [mapEditCoords[0], mapEditCoords[1]];
				var new_mapEditCoords_lat = [mapEditCoords[0]];
				var new_mapEditCoords_lng = [mapEditCoords[1]];
				document.getElementById("addMarkLatitude").value = new_mapEditCoords_lat;
				document.getElementById("addMarLongitude").value = new_mapEditCoords_lng;
			}

			$(document).ready(function () {
				$('#addMarkShow').on('click', function () {
					UIkit.modal('#form').show();
					initializeMapEdit();
				});

				if (window.location.hash && window.location.hash == '#showaddform') {
					UIkit.modal('#form').show();
					initializeMapEdit();
				}
			});

			// Add
			$('#addMarkForm').submit(function (event) {
				var formData = $(this).serializeArray();
				var errors = [];
				$(formData).each(function (x) {
					if (formData[x]["value"] == "") {
						errors.push(formData[x]);
					}
				});
				if (errors.length > 0) {
					$(errors).each(function (x) {
						$('#addMarkForm [name="' + errors[x].name + '"]').addClass('uk-form-danger');
					});
				}
				else {
					$('#page-loading').fadeIn();
					$.ajax({
						type: 'POST',
						dataType: 'json',
						url: '<?php echo $this->get('params')->map->ajaxLink; ?>addMark',
						data: {
							data: formData,
						},
						beforeSend: function (index) {
						},
						success: function (index) {
							jQuery('#addMarkForm')[0].reset();
							objectManager.removeAll();
							UIkit.modal('#form').hide();
							objectManager.add(index.data);
							map.setCenter(index.data.geometry.coordinates)
							map.setZoom(17);
							console.log(index.data.geometry.coordinates);
						},
						error: function (index) {
							console.log('error');
							console.log(index.data);
						},
						complete: function (index) {
							$('#page-loading').fadeOut();
						}
					});
				}
				return false;
			});
			<?php endif; ?>
		})(jQuery)
	}
</script>