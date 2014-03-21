define(['jquery', 'underscore', 'backbone', 'views/authenticate.view'], function($, _, Backbone, authView){
    var router = Backbone.Router.extend({
            routes: {
                // Define some URL routes
                'login': 'login',
                'logout': 'logout',
                'singup': 'singup',
                'home': 'home',
                'register/:token': 'completeRegister',
                // Default
                '*actions': 'fetchUser'
            },
            initialize: function () {
                this.access_token = $.cookie('ACCESS_TOKEN');

                if (this.access_token) {
                //get info from token
                    $.ajaxSetup({
                        headers: { 'ACCESS_TOKEN': this.access_token }
                    });
                }
            },
            fetchUser: function () {
                SGS.mainView.user.fetch({
                    success: function () { SGS.router.navigate('home', {trigger: true}); },
                    error: function () { SGS.router.navigate('login', {trigger: true}); },
                });
            },
            login: function () {
                if (!SGS.mainView.user.isNew()) {
                    this.navigate('/home', {trigger: true});
                } else {
                    SGS.showLogin();
                };
            },
            logout: function () {},
            singup: function () {},
            home: function () {
                if (SGS.mainView.user.isNew()) {
                    this.navigate('login', {trigger: true});
                } else {
                    SGS.mainView.render();
                };
            },
            completeRegister: function (token) {
                var view = new authView($(document.body));
                view.render();
                view.validate(token);
            }
        });

    return router
});