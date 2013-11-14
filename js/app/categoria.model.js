
//Categoria
//+ id 
//+ nombre - nivel
//+ monto
//+ antiguedad
//+ desde - fecha de valides
//+ hasta - fecha de valides
// -- De no cargar una nueva escala, debera andar cn la anterior.. 
//+ vale de comida - es una bonificacion de las horas extras

define (['backbone'], function(backbone){
	
	return backbone.Model.extend({
		defaults:{
			nivel: '',
			monto: '',
			antiguedad: '',
			desde: '',
			hasta: '',
			vale:'',
		}
	});
});