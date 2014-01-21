require(
  [
    './js/config.js'
  ],
  function() {
    'use strict';
    //Start ApplicationModule
    require(
      [
        'app/application'
      ],
      function(Application) {
            window.SGS = Application;
            Application.init();
      });
  }
);