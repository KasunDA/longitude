var	path = require('path'),
	db   = require('./models');

db
	.sequelize
	.authenticate()
	.complete(function(err) {
		if (!!err) {
			console.log('Unable to connect to the database:', err);
		} else {
			console.log('Connection has been established successfully.');
			db.User.find({id: 1}).complete(function (err, user) {
				console.log(user.values);
			});
		}
	});