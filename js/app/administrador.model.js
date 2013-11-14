
//Administrador
//+ id
//+ nombre
//+apellido
//+ telefono
//+ email o correo electonico

define (['backbone'], function(backbone){
	return backbone.Model.extend({
		defaults:{
			nombre: '',
			apellido: '',
			telefono: '',
			correo: '',
		}
	});

});