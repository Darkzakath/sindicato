define(['jquery',
        'jquery_cookie',
        'underscore',
        'backbone',
        'app/router',
        'views/main.view',
        'app/login.app',
        'bootbox'], 
    function($, cookie, _, Backbone, Router, projectView, loginApp){
    return {
        router : null,
        loginApp: loginApp,
        init : function () {
            this.router = new Router();
            this.mainView = new projectView();
            this.mainView.render();
            var self = this;
            

            Backbone.history.start();
        },
        showLogin: function () {
            this.loginApp.init($(document.body));
        }
    };
});