module.exports = function(sequelize, DataTypes) {
	var ApiToken = sequelize.define('ApiToken', {}, {
		tableName:  'api_tokens',
		timestamps: false,
		classMethods: {
			associate: function(models) {
				ApiToken.belongsTo(models.User);
			}
		}
	});

	return ApiToken;
}
