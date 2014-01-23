
//Administrador
//+ id
//+ nombre
//+apellido
//+ telefono
//+ email o correo electonico

define (['backbone', 'underscore'], function(backbone, _){
	return backbone.Model.extend({
	    url: 'api/login',
		defaults:{
			cuit: '',
			password: ''
		},
		validate: function (attrs) {
		    var error = {};
		    if (attrs.cuit) {
		        if (attrs.cuit.length !== 11) {
		            error.cuit = "CUIT invalido, no contiene 11 caracteres";
		        }
		        if (!(!isNaN(parseFloat(attrs.cuit)) && isFinite(attrs.cuit))) {
		            error.cuit += "\r\nCUIT invalido, no es numerico";
		        }
		    };
		    if (attrs.password) {
		        if (attrs.password.length < 8) {
		            error.password = "password demasiado corto";
		        }
		    };

		    if (!_.isEmpty(error)) return error;
		}
	});

});