define([
    'backbone',
    'bootstrap',
    'text!templates/register.tpl.html'
], function (Backbone, Bootstrap, tpl) {
    var view = Backbone.View.extend({
        initialize: function (el) {
            this.$el = el;
            this.el = el[0];
        },
        events: {
            'click #login-widget a':        'showRegister',
            'click #register-widget a':     'showLogin',
            'click #login-widget button':   'login',
            'click #register-widget button':   'register',
            'change input':                 'change'
        },
        change: function (evt) {
            var $el = $(evt.currentTarget),
                value = $el.val();
            switch (evt.target.id) {
                case 'regCuit':
                    this.registermodel.set('cuit', value, {validate:true});
                    break;
                case 'regEmail':
                    this.registermodel.set('email', value, {validate:true});
                    break;
                case 'regEmail2':
                    this.registermodel.set('email2', value, {validate:true});
                    break;
                case 'regPassword':
                    this.registermodel.set('password', value, {validate:true});
                    break;
                case 'regPassword2':
                    this.registermodel.set('password2', value, {validate:true});
                    break;
                case 'loginCuit':
                    this.loginmodel.set('cuit', value, {validate:true});
                    break;
                case 'loginPass':
                    this.loginmodel.set('password', value, {validate:true});
                    break;
                default:
            };
        },
        showLoginErrors: function (model, error, options) {
            //debugger;
            var $elem;

            $elem = this.$el.find('#loginCuit');
            if (error.cuit) {
                $elem.popover({
                    placement: "right",
                    content: error.cuit
                });
                $elem.popover('show');
            } else {
                $elem.tooltip('destroy');
            };

            $elem = this.$el.find('#loginPassword');
            if (error.password) {
                $elem.popover({
                    placement: "right",
                    content: error.passwword
                });
                $elem.popover('show');
            } else {
                $elem.popover('destroy');
            };
            console.log(error);
        },
        showRegisterErrors: function (model, error, options) {

        },
        render: function () {
            this.$el.html(tpl);
            this.showLogin();
        }
    });

    return view;
});
