define(['jquery', 'underscore', 'backbone', 'app/router', 'views/main.view'], function($, _, Backbone, router, projectView){
    var init = function () {
        router.init();
    };

    return {
        init : init
    };
});