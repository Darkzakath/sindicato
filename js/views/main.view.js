define(['jquery',
        'underscore',
        'backbone',
        'handlebars',
        'text!templates/main.tpl.html',
        'text!templates/container.tpl.html',
        'text!templates/login.tpl.html'
    ], function($, _, Backbone, Handlebars, mainTpl, containerTpl, loginTpl){
    var mainView = Backbone.View.extend({
        el: $('body'),
        template: Handlebars.compile(mainTpl),
        templateContainer: Handlebars.compile(containerTpl),
        templateLogin: Handlebars.compile(loginTpl),
        render: function(){
            debugger;
            $el = $(this.el);
            $el.html(this.template({}));
            $el.find('#main-container').html(this.templateContainer({}));
        }
    });
    return mainView;
});
