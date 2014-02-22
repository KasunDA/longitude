(function (LongitudeMap, $, undefined) {

	var map;

	function addPath(points) {
		var path = new google.maps.Polyline({
			path: points,
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
		});

		path.setMap(map);
	}
	
	function initialize() {
		var mapOptions = {
			center: new google.maps.LatLng(54.8941781, 23.9125384),
			zoom: 13
		};

		map = new google.maps.Map(
			document.getElementById("map-canvas"),
			mapOptions
		);

		var flightPlanCoordinates = [
			new google.maps.LatLng(54.916107, 23.982489),
			new google.maps.LatLng(54.911765, 23.968370),
			new google.maps.LatLng(54.912357, 23.958800),
			new google.maps.LatLng(54.911518, 23.938715)
		];

		addPath(flightPlanCoordinates);
	}

	$(function() {
		initialize();
	})

}(window.LongitudeMap = window.LongitudeMap || {}, jQuery));
