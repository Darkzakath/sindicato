define([
    'views/login.view'
], function (loginView) {
    var app = {
        view: null,
        init: function (el) {
            this.view = new loginView(el);
            this.view.render();
        }
    };

    return app;
});