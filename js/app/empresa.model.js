
//Empresa
//+ id
//+ razon social
//+ nombre
//+ cuit
//+ domicilio
//+ telefono
//+ correo
//+ localidad

define (
	['backbone'], 
	function(backbone){
	return backbone.Model.extend({
		defaults:{
			razonsocial: '',
			nombre: '',
			cuit: '',
			domicilio: '',
			telefono: '',
			correo: '',
			localidad: ''
		}
	});

});
	