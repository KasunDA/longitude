(function (LongitudeMap, $, undefined) {
	
	function initialize() {
		var mapOptions = {
			center: new google.maps.LatLng(54.8941781, 23.9125384),
			zoom: 13
		};

		var map = new google.maps.Map(
			document.getElementById("map-canvas"),
			mapOptions
		);
	}

	$(function() {
		initalize();
	})

}(window.LongitudeMap = window.LongitudeMap || {}, jQuery));
