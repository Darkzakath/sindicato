define(['jquery', 'underscore', 'backbone', 'views/main.view'], function($, _, Backbone, projectView){

    var router = Backbone.Router.extend({
        routes: {
        // Define some URL routes
        'login': 'login',
        'logout': 'logout',
        'singup': 'singup',

        // Default
        '*actions': 'home'
        },
        initialize: function () {
            this.mainView = new projectView();
            this.mainView.render();
            window.project = this.mainView;
        },
        login: function () {
            debugger;
            if (!this.mainView.user.isNew()) {
                this.navigate('/home', {trigger: true});
            } else {
                this.mainView.renderLogin();
            };
        },
        logout: function () {},
        singup: function () {},
        home: function () {}
    });

    return router
});