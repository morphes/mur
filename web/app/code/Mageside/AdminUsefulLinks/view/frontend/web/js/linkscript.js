define([
    'jquery'
], function ($) {
    'use strict';

    $.widget('mageside.checkIsLogin', {

        _create: function () {
            this.sendPost();
        },

        sendPost: function () {
            $.get(this.options.url, function (data) {
                switch (this.options.source) {
                    case 'cms':
                        this.redirectAction(data, 'dashboard-cms');
                        break;
                    case 'category':
                        this.redirectAction(data, 'dashboard-category');
                        break;
                    case 'product':
                        this.redirectAction(data, 'dashboard-product');
                        break;
                    default:
                        break;
                }
            }.bind(this));

        },

        redirectAction: function (data, id) {
            var key = $(data).find('#' + id).html();
            if (key) {
                window.location.href = this.options.link + 'key/' + key;
            }
        }
    });

    return $.mageside.checkIsLogin;
});
