var	path            = require('path'),
	db              = require('./models'),
	WebSocketClient = require('websocket').client;

var generator,
	conn,
	base_lat = 54.909139,
	base_lng = 23.969559,
	client   = new WebSocketClient();

function sendMessage(message) {
	if (conn.connected) {
		conn.sendUTF(JSON.stringify(message));
	}
}

function generateLocations() {
	db.User.findAll().success(function (users) {
		for (var i = users.length - 1; i >= 0; i--) {
			var locationData = {
				latitude:  base_lat + ((Math.random() * 0.06) - 0.03),
				longitude: base_lng + ((Math.random() * 0.06) - 0.03),
				user_id:   users[i].id
			};

			//var location = db.Location.build(locationData);
			//location.save();

			locationData.type = 'newlocation';
			sendMessage(locationData);
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