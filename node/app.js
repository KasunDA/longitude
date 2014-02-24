var	path   = require('path'),
	db     = require('./models'),
	http   = require('http'),
	sockjs = require('sockjs');

var server    = http.createServer(),
	sockets   = sockjs.createServer(),
	clients   = {},
	usernames = {},
	admins    = [];

function broadcast(clients, message) {
	for (var client in clients) {
		if (clients.hasOwnProperty(client)) {
			clients[client].write(JSON.stringify(message));
		}
	}
}

function sendLocation(location, username) {
	var message      = location;
	message.type     = 'location';
	message.username = username;

	var jsonMessage = JSON.stringify(message);

	if (usernames[username]) {
		var userConn = clients[usernames[username]];
		if (userConn.data.user_type_id != 1) {
			userConn.write(jsonMessage);
		}
	}

	for (var i = admins.length - 1; i >= 0; i--) {
		var adminConn = clients[admins[i]];
		adminConn.write(jsonMessage);
	}
}

function onConnection(conn) {
	console.log('New connection: ', conn.remoteAddress);

	conn.on('data', function (data) {
		data = JSON.parse(data);

		if (data.type == 'auth') {
			db.ApiToken.find({
				where: {
					token:    data.token,
					internal: true
				},
				include: [db.User]
			}).success(function (token) {
				if (token) {
					// Get user data
					var user = token.values.user.values;
					conn.data = user;
					console.log('[auth] Successfully authenticated: ' + user.username);

					// Save the connection
					clients[conn.id] = conn;
					usernames[user.username] = conn.id;

					if (user.user_type_id === 1) {
						admins.push(conn.id);
					}
				} else {
					console.log('[auth] Invalid API token: ' + data.token);
					conn.close(401, 'Invalid API token');
				}
			});
		}

		if (conn.remoteAddress == '127.0.0.1' && data.type == 'newlocation') {
			console.log('New location: ', data.latitude, data.longitude);
			var location = {
				latitude:  data.latitude,
				longitude: data.longitude
			};
			var username = data.username;
			sendLocation(location, username);
		}
	});

	conn.on('close', function() {
		delete clients[conn.id];
		delete usernames[conn.id];
	});
}

db
	.sequelize
	.authenticate()
	.complete(function(err) {
		if (!!err) {
			console.log('Unable to connect to the database:', err);
		} else {
			sockets.on('connection', onConnection);
			sockets.installHandlers(server);
			server.listen(9999, '0.0.0.0');
		}
	});