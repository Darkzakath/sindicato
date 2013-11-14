//Categoria
//+ id 
//-- Queda por definir

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