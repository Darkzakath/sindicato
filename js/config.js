define(function() {
  'use strict';

  require.config({
    baseUrl: 'js',
    paths: {
      'backbone' : 'vendors/backbone/backbone-0.9.10',
      'jquery' : 'vendors/jquery/jquery-1.9.0',
      'jquery_cookie': 'vendors/jquery/plugins/jquery-cookie',
      'underscore' : 'vendors/underscore/lodash',
      'handlebars' : 'vendors/handlebars/handlebars-1.0.0.beta.6',
      'modernizr' : 'vendors/modernizr/modernizr-latest',
      'bootstrap': 'vendors/bootstrap/bootstrap',
      'bootbox': 'vendors/bootstrap/bootbox',
      'text': 'vendors/require/plugins/text'
    },
    shim: {
      'underscore' : {
        exports: '_'
      },
      'backbone': {
        deps: ['underscore', 'jquery'],
        exports: 'Backbone'
      },
      'modernizr': {
        exports : 'Modernizr'
      },
      'handlebars': {
        exports : 'Handlebars'
      },
      'bootstrap': {
        exports : 'Bootstrap'
      },
      'bootbox': {
          deps: ['jquery', 'bootstrap'],
          exports: 'bootbox'
      },
      'jquery_cookie': {
            deps: ['jquery'],
            exports: 'jquery_cookie'
        }
    }
  });
});
