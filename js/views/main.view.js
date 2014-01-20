define(['jquery',
        'underscore',
        'backbone',
        'handlebars',
        'models/user.model',
        'text!templates/main.tpl.html',
        'text!templates/container.tpl.html',
        'text!templates/login.tpl.html'
    ], function($, _, Backbone, Handlebars, userModel, mainTpl, containerTpl, loginTpl){
    var mainView = Backbone.View.extend({
        user: new userModel(),
        el: $('body'),
        template: Handlebars.compile(mainTpl),
        templateContainer: Handlebars.compile(containerTpl),
        templateLogin: Handlebars.compile(loginTpl),
        render: function(){
            $el = $(this.el);
            $el.html(this.template({}));
            $el.find('#main-container').html(this.templateContainer({}));
        },
        renderLogin: function () {
            this.$el.find('#main-container').html(this.templateLogin({}));
        }

    });
    return mainView;
});
