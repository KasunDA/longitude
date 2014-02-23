var Sequelize = require('sequelize');
var sequelize = new Sequelize('longitude', 'root', '', {
	dialect: "mysql",
	port:    3306,
});

var ApiToken = sequelize.define('ApiToken', {
	id:      Sequelize.INTEGER(10).UNSIGNED,
	token:   Sequelize.STRING(64)
}, {
	tableName:  'api_tokens',
	timestamps: false
});

var User = sequelize.define('user', {
	id:           Sequelize.INTEGER(10).UNSIGNED,
	username:     Sequelize.STRING(64),
	password:     Sequelize.STRING(255)
}, {
	tableName:   'users',
	underscored: true
});

User.hasMany(ApiToken);
ApiToken.belongsTo(User);

sequelize
	.authenticate()
	.complete(function(err) {
		if (!!err) {
			console.log('Unable to connect to the database:', err);
		} else {
			console.log('Connection has been established successfully.');
			User.find({id: 1}).complete(function (err, user) {
				console.log(user.values);
			});
		}
	});