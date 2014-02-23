(function ($, undefined) {

	var googleMap;
	var googleMapInitialized = false;
	var mapElement;
	var rColor = new RColor();

	var paths = {};
	
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

	function addLocation(user, latlng) {
		if (!paths[user]) {
			var path = new google.maps.Polyline({
				path: [latlng],
				geodesic: true,
				strokeColor: rColor.get(true),
				strokeOpacity: 1.0,
				strokeWeight: 2
			});

			if (googleMapInitialized) {
				path.setMap(googleMap);
			} else {
				alert('Map not initialized yet!');
			}

			paths[user] = path;
		} else {
			paths[user].getPath().push(latlng);
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

				for (var i = path.length - 1; i >= 0; i--) {
					addLocation(user, path[i]);
				};
			}
		}
	}

	function initializeSocks() {
		var sock = new SockJS('http://localhost:9999/');

		sock.onopen = function() {
			sock.send(JSON.stringify({
				type:  'auth',
				token: API_TOKEN
			}));
		};

		sock.onmessage = function(e) {
			var data = JSON.parse(e.data);

			if (data.type == 'location') {
				addLocation(data.username, new google.maps.LatLng(
					data.latitude,
					data.longitude
				));
			}

			console.log('message', e.data);
		};

		sock.onclose = function() {
			console.log('close');
		};
	}

	$(function() {
		mapElement = $('#map-canvas');
		if (mapElement.length === 0) {
			return;
		}

		loadLocations();
		initializeSocks();
		initMap();
	});

}(jQuery));
