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

function onConnection(conn) {
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
					lients[conn.id] = conn;
					usernames[user.username] = conn.id;

					if (user.user_type_id === 1) {
						admins.push(conn.id);
					}

					// conn.write(JSON.stringify({
					// 	type:      'location',
					// 	username:  'admin',
					// 	latitude:  54.904734,
					// 	longitude: 23.948715
					// }));
				} else {
					console.log('[auth] Invalid API token: ' + data.token);
					conn.close(401, 'Invalid API token');
				}
			});
		}

		if (data.type == 'newlocation') {
			console.log('New location: ', data.latitude, data.longitude);
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