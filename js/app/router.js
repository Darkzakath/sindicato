define(['jquery', 'underscore', 'backbone', 'views/main.view'], function($, _, Backbone, projectView){
    var mainView = new projectView(),
        router = Backbone.Router.extend({
            routes: {
                // Define some URL routes
                'login': 'login',
                'logout': 'logout',
                'singup': 'singup',
                'home': 'home'
                // Default
                //'*actions': 'home'
            },
            initialize: function () {
                this.mainView = mainView
                this.mainView.render();
                window.project = this.mainView;
                var self = this;
                this.mainView.user.fetch({
                    success: function () { self.navigate('home', {trigger: true}); },
                    error: function () { self.navigate('login', {trigger: true}); },
                });
            },
            login: function () {
                debugger;
                if (!mainView.user.isNew()) {
                    this.navigate('/home', {trigger: true});
                } else {
                    this.mainView.renderLogin();
                };
            },
            logout: function () {},
            singup: function () {},
            home: function () {
                if (mainView.user.isNew()) {
                    this.navigate('login', {trigger: true});
                } else {
                    mainView.render();
                };
            }
        });

    return router
});