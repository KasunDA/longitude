module.exports = function(sequelize, DataTypes) {
	var ApiToken = sequelize.define('ApiToken', {
		token:    DataTypes.STRING(64),
		internal: DataTypes.BOOLEAN
	}, {
		tableName:  'api_tokens',
		timestamps: false,
		classMethods: {
			associate: function(models) {
				ApiToken.belongsTo(models.User, {foreignKey: 'user_id'});
			}
		}
	});

	return ApiToken;
}
