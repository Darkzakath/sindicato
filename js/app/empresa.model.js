
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
			razonSocial: '',
			nombre: '',
			cuit: '',
			domicilio: '',
			telefono: '',
			correo: '',
			localidad: ''
		}
	});

});
	