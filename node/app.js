var	path   = require('path'),
	db     = require('./models'),
	http   = require('http'),
	sockjs = require('sockjs');

var server  = http.createServer(),
	sockets = sockjs.createServer(),
	clients = {};

function broadcast(message, exclude) {
	for (var client in clients) {
		if (clients.hasOwnProperty(client)) {
			if (client != exclude) {
				clients[client].write(JSON.stringify(message));
			}
		}
	}
}

function onConnection(conn) {
	clients[conn.id] = conn;

	conn.on('data', function (data) {
		data = JSON.parse(data);

		if (data.type == 'auth') {
			db.ApiToken.find({
				where: {token: data.token},
				include: [db.User]
			}).success(function (token) {
				conn.data.user = token.user;
				console.log(user.values);
				console.log('Successfully authenticated: ' + token.user.username);
			});
		}
	});

	conn.on('close', function() {
		delete clients[conn.id];
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