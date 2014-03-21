define([
    'backbone',
    'bootstrap',
    'bootbox',
    'text!templates/main.tpl.html',
    'text!templates/authenticate.tpl.html'
], function (Backbone, Bootstrap, bootbox, mainTpl, tpl) {
    var view = Backbone.View.extend({
        initialize: function (el) {
            this.$el = el;
            this.el = el[0];            
        },
        status: "",
        events: {
            "click a.btn-primary": "goLogin"
        },
        goLogin: function () {
            SGS.router.navigate("login", {trigger: true});
        },
        change: function (evt) {
            var $el = $(evt.currentTarget),
                value = $el.val();
            switch (evt.target.id) {
                case 'regCuit':
                    this.registermodel.set('cuit', value, {validate:true});
                    break;
                case 'regEmail':
                    this.registermodel.set('email', value, {validate:true});
                    break;
                case 'regEmail2':
                    this.registermodel.set('email2', value, {validate:true});
                    break;
                case 'regPassword':
                    this.registermodel.set('password', value, {validate:true});
                    break;
                case 'regPassword2':
                    this.registermodel.set('password2', value, {validate:true});
                    break;
                case 'loginCuit':
                    this.loginmodel.set('cuit', value, {validate:true});
                    break;
                case 'loginPass':
                    this.loginmodel.set('password', value, {validate:true});
                    break;
                default:
            };
        },
        render: function () {
            if (this.status == "") {
                this.$el.html(mainTpl);
                this.$el.find('#main-container').html(tpl);
            } else {
                debugger;
                if (this.status == "ok") {
                    this.$el.find(".jumbotron").addClass("bg-success");
                    this.$el.find(".hidden").removeClass("hidden")
                    this.$el.find("p.text").text("Ha completado el proceso de alta satisfactoriamente, ahora podra ingresar al sitio con el cuit y la contraseña elegida");
                } else {
                    this.$el.find("h1").removeClass("hidden").text("Hubo un error...")
                    this.$el.find("p.text").text("El token no pudo ser validado, por favor pruebe mas tarde");
                }
            };
        },        
        validate: function (token) {
            var self = this;
            $.ajax({
                type: "POST",
                url: 'api/register/business/' + token,
                success: function() {
                    self.status = "ok";
                    self.render();
                },
                error: function(){
                    self.status = "error";
                    self.render();
                }
            });
        }
    });

    return view;
});
