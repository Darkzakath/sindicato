define(function() {
  'use strict';

  require.config({
    //path aliases for loaded scripts
    paths: {
      'backbone' : 'vendors/backbone/backbone-0.9.10',
      'jquery' : 'vendors/jquery/jquery-1.8.0',
      'underscore' : 'vendors/underscore/lodash',
      'handlebars' : 'vendors/handlebars/handlebars-1.0.0.beta.6',
      'modernizr' : 'vendors/modernizr/modernizr-latest',
      'bootstrap': 'vendors/bootstrap/bootstrap'
    },
    //load script's dependencies in correct order &
    //wraps non-AMD scripts into AMD-modules
    // cosas que compila como modulosque no son modulos
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
