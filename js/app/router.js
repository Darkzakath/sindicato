define(['jquery', 'underscore', 'backbone'], function($, _, Backbone){
    var router = Backbone.Router.extend({
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
                this.access_token = $.cookie('ACCESS_TOKEN');

                if (this.access_token) {
                //get info from token
                    $.ajaxSetup({
                        headers: { 'ACCESS_TOKEN': this.access_token }
                    });
                };

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
            }
        });

    return router
});