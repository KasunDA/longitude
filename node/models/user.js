module.exports = function(sequelize, DataTypes) {
	var User = sequelize.define('User', {
		username:     DataTypes.STRING(64),
		user_type_id: DataTypes.INTEGER(10).UNSIGNED
	}, {
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
 