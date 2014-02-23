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
	clients[conn.id] = conn;

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
					var user = token.values.user.values;
					conn.data = user;
					console.log('[auth] Successfully authenticated: ' + user.username);

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