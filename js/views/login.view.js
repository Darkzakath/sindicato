define([
    'backbone',
    'bootstrap',
    'models/login.model',
    'models/register.model',
    'text!templates/login.tpl.html'
], function (Backbone, Bootstrap, loginModel, registerModel, tpl) {
    var view = Backbone.View.extend({
        initialize: function (el) {
            this.$el = el;
            this.el = el[0];
            this.loginmodel.on('invalid', this.showLoginErrors, this);
            this.registermodel.on('invalid', this.showRegisterErrors, this);
        },
        loginmodel: new loginModel(),
        registermodel: new registerModel(),
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
        },
        showRegister: function () {
            this.$el.find('#login-widget').hide();
            this.$el.find('#register-widget').show();
        },
        showLogin: function () {
            this.$el.find('#login-widget').show();
            this.$el.find('#register-widget').hide();
        },
        login: function (evt) {
            this.loginmodel.save({
                success: function () {
                    SGS.router.navigate('home', {trigger:true});
                },
                error: function () {
                    //mostrar cartel de salame
                }
            })

            evt.preventDefault();
            return false;
        },
        register: function (evt) {
            this.registermodel.save({
                success: function () {
                    SGS.router.navigate('login', {trigger:true});
                },
                error: function () {
                    //mostrar cartel de salame
                }
            })

            evt.preventDefault();
            return false;
        }
    });

    return view;
});
