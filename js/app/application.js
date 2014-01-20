define(['jquery', 'jquery_cookie', 'underscore', 'backbone', 'app/router', 'views/main.view', 'bootbox'], function($, cookie, _, Backbone, Router, projectView){

    var init = function () {
        this.access_token = $.cookie('ACCESS_TOKEN');

        if (this.access_token) {
        //get info from token
            $.ajaxSetup({
                headers: { 'ACCESS_TOKEN': this.access_token }
            });
        };
        var router = new Router();
        Backbone.history.start();

    };

    return {
        init : init
    };
});