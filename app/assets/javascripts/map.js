(function ($, undefined) {

	var googleMap;
	var googleMapInitialized = false;
	var mapElement;
	
	function initMap() {
		var mapOptions = {
			center: new google.maps.LatLng(54.8941781, 23.9125384),
			zoom: 13
		};

		googleMap = new google.maps.Map(
			mapElement[0],
			mapOptions
		);

		googleMapInitialized = true;
	}

	function toLatLngArray(arr) {
		var latLngArr = [];

		for (var i = arr.length - 1; i >= 0; i--) {
			latLngArr.push(new google.maps.LatLng(
				arr[i].latitude, arr[i].longitude
			));
		};

		return latLngArr;
	}

	function addPath(points) {
		var path = new google.maps.Polyline({
			path: points,
			geodesic: true,
			strokeColor: '#FF0000',
			strokeOpacity: 1.0,
			strokeWeight: 2
		});

		if (googleMapInitialized) {
			path.setMap(googleMap);
		} else {
			alert('Map not initialized yet!');
		}
	}

	function loadLocations() {
		var url = BASE_URL + '/api/locations';

		$.ajax({
			url:      url,
			type:     'GET',
			dataType: 'json'
		}).done(handleLocationsLoaded);
	}

	function handleLocationsLoaded(data) {
		data = data.locations;

		for (var user in data) {
			if (data.hasOwnProperty(user)) {
				var userLocations = data[user];
				var path = toLatLngArray(userLocations);
				addPath(path);
			}
		}
	}

	$(function() {
		mapElement = $('#map-canvas');
		if (mapElement.length === 0) {
			return;
		}

		loadLocations();
		initMap();
	});

}(jQuery));
