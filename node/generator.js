var	path = require('path'),
	db   = require('./models');

var generator,
	base_lat = 54.909139,
	base_lng = 23.969559;

function generateLocations() {
	db.User.findAll().success(function (users) {
		for (var i = users.length - 1; i >= 0; i--) {
			var location = db.Location.build({
				latitude:  base_lat + ((Math.random() * 0.06) - 0.03),
				longitude: base_lng + ((Math.random() * 0.06) - 0.03),
				user_id:   users[i].id
			});
			location.save();
		};

		console.log('Generated locations.');
	});
}

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