define(function() {
  'use strict';

  require.config({
    baseUrl: 'js',
    paths: {
      'backbone' : 'vendors/backbone/backbone-0.9.10',
      'jquery' : 'vendors/jquery/jquery-1.8.0',
      'underscore' : 'vendors/underscore/lodash',
      'handlebars' : 'vendors/handlebars/handlebars-1.0.0.beta.6',
      'modernizr' : 'vendors/modernizr/modernizr-latest',
      'bootstrap': 'vendors/bootstrap/bootstrap',
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
      }
    }
  });
});
