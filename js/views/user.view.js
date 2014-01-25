define([
    'backbone',
    'bootstrap',
    'models/user.model',
    'text!templates/user.tpl.html'
],function(Backbone, Bootstrap, userModel, tpl){
    var view = Backbone.View.extend({
        initialize: function (el) {
            this.$el = el;
            this.el = el[0];
            // Algo bueno que hacer
        },
        usermodel: new userModel(),
        events: {
            // Declarar eventos
        }
        // funciones instanciadas por eventos
    });
    return view;
});