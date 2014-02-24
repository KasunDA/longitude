module.exports = function(sequelize, DataTypes) {
	var Location = sequelize.define('Location', {
		latitude:  DataTypes.FLOAT(10, 6),
		longitude: DataTypes.FLOAT(10, 6)
	}, {
		tableName:  'locations',
		timestamps: false,
		classMethods: {
			associate: function(models) {
				Location.belongsTo(models.User, {foreignKey: 'user_id'});
			}
		}
	});

	return Location;
}
