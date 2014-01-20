define(['jquery', 'jquery_cookie', 'underscore', 'backbone', 'app/router', 'views/main.view', 'bootbox'], function($, cookie, _, Backbone, Router, projectView){

    var router = new Router();
    var init = function () {
        this.access_token = $.cookie('ACCESS_TOKEN');
        Backbone.history.start();
        if (this.access_token) {
            //get info from token
            $.ajaxSetup({
                headers: { 'ACCESS_TOKEN': this.access_token }
            });

        } else {
            router.navigate('/login', {trigger: true});
        };
    };

    return {
        init : init
    };
});