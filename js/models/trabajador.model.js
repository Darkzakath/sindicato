//Trabajador
//+ id
//+ nombre
//+ apellido
//+ cuil
//+ fecha de ingreso
//+ categoria

define (['backbone'], function(backbone){
	return backbone.Model.extend({
		defaults:{
			nombre: '',
			apellido: '',
			cuil: '',
			fingreso: '',
			categoria: ''
		}
	});

});