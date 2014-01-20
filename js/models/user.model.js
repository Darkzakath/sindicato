define (['backbone'], function(backbone){
	return backbone.Model.extend({
		defaults:{
			username: '',
			password: '',
			email: '',
			loged: false
		},
		url: 'api/my',
        login: function (loginObj) {
            $.ajax({
                url: 'api/login',
                type: "POST",
                data: JSON.stringify(loginObj),
                processData: false,
                contentType: "application/json; charset=utf-8",
                success: function(response) {
                    $.ajaxSetup({
                        headers: { 'ACCESS_TOKEN': response }
                    });
                    this.set('loged', true);
                    this.set('token', response);
                    $.cookie('ACCESS_TOKEN', response);
                    this.fetch();
                }.bind(this),
                error: function() {
                        bootbox.dialog({
                          message: "Error al ingresar, compruebe usuario y password",
                          title: "Error al ingreso",
                          buttons: {
                            main: {
                              label: "Ok",
                              className: "btn-primary",
                              callback: function() {}
                            }
                          }
                        });
                    }
            })
        }
	});

});