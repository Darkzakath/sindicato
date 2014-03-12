
//Administrador
//+ id
//+ nombre
//+apellido
//+ telefono
//+ email o correo electonico

define (['backbone'], function(backbone){
	return backbone.Model.extend({
	    url: 'api/register/newbusiness',
		defaults:{
			cuit: '',
			password: '',
		    password2: '',
		    email: '',
		    email2: ''
		}
	});

});