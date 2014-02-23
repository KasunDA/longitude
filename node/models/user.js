module.exports = function(sequelize, DataTypes) {
	var User = sequelize.define('User', {}, {
		tableName:    'users',
		underscored:  true,
		classMethods: {
			associate: function(models) {
				User.hasMany(models.ApiToken);
			}
		}
	});

	return User;
}
 