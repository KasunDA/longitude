var	path            = require('path'),
	db              = require('./models'),
	WebSocketClient = require('websocket').client;

var generator,
	conn,
	base_lat = 54.909139,
	base_lng = 23.969559,
	client   = new WebSocketClient();

function sendMessage(message) {
	if (conn && conn.connected) {
		conn.sendUTF(JSON.stringify(message));
	}
}

function generateLocation(user) {
	var latitude;
	var longitude;

	if (user.locations.length > 0) {
		var longitudeDiff = 0;
		var latitudeDiff  = 0;

		var length = user.locations.length;
		var last   = user.locations[length - 1].values;

		if (user.locations.length > 1) {
			var secondToLast = user.locations[length - 2].values;

			var rotation = Math.atan2(last.latitude - secondToLast.latitude, last.longitude - secondToLast.longitude);
			var rotationDiff = (Math.random() - 0.5) * 0.3;
			rotation = rotation + rotationDiff;

			console.log(rotation, rotationDiff);

			var movedAmount = Math.random() * 0.001;

			latitudeDiff  = movedAmount * Math.sin(rotation);
			longitudeDiff = movedAmount * Math.cos(rotation);
		} else if (user.locations.length == 1) {
			latitudeDiff  = (Math.random() * 0.001) - 0.0005;
			longitudeDiff = (Math.random() * 0.001) - 0.0005;
		}

		latitude  = last.latitude + latitudeDiff;
		longitude = last.longitude + longitudeDiff;
	} else {
		latitude  = base_lat + ((Math.random() * 0.01) - 0.005);
		longitude = base_lng + ((Math.random() * 0.01) - 0.005);
	}

	return {
		latitude:  latitude,
		longitude: longitude
	};
}

function generateLocations() {
	db.User.findAll({include: [db.Location]}).success(function (users) {
		for (var i = users.length - 1; i >= 0; i--) {
			var location = generateLocation(users[i]);

			var locationData = location;
			locationData['user_id'] = users[i].id;
			db.Location.build(locationData).save();

			var message = location;
			message.type = 'newlocation';
			message.username = users[i].username;
			sendMessage(message);
		};

		console.log('Generated locations.');
	});
}

client.on('connectFailed', function (error) {
	console.log('Connect Error: ' + error.toString());
});

client.on('connect', function (connection) {
	conn = connection;
	console.log('WebSocket client connected');

	connection.on('error', function (error) {
		console.log("Connection Error: " + error.toString());
	});

	connection.on('close', function() {
		console.log('Connection Closed');
	});
});

client.connect('ws://localhost:9999/websocket');

db
	.sequelize
	.authenticate()
	.complete(function(err) {
		if (!!err) {
			console.log('Unable to connect to the database:', err);
		} else {
			generator = setInterval(generateLocations, 1000);
		}
	});