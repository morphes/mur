define([
    'jquery'
], function ($) {
    $.widget("mana.MobileLayeredNavigation", {
        options: {
            max_width: 0,
            layered_nav_class: ".mana-filter-block",
            mobile_nav_class: ".mana-filter-block-mobile",
            product_sorter_class: ".page-products .sorter"
        },
        _mobileMode: null,

        _create: function() {
            $(window).on('resize', $.proxy(this._determineMobileVisibility, this));
            $(this.element).on('click', '.filter-remove a', $.proxy(this._removeFilter, this));
            if (this._isWindowBelowMaxWidth()) {
                this._prepareMobileMode();
            } else {
                this._prepareDesktopMode();
            }
        },
        _destroy: function() {
            $(window).off('resize', $.proxy(this._determineMobileVisibility, this));
            $(this.element).off('click', '.filter-remove a', $.proxy(this._removeFilter, this));
        },
        // Private Methods
        _removeFilter: function(event) {
            location.href = event.target.href;
            event.preventDefault();
            event.stopPropagation();
        },
        _isWindowBelowMaxWidth: function () {
            // $(window).width or outerWidth or innerWidth will always include the scrollbar size in it.
            // var windowWidth = $(window).width();
            var windowWidth = this._getViewPort().width;

            return windowWidth <= this.options.max_width;
        },

        _getViewPort: function() {
            var e = window, a = 'inner';
            if (!('innerWidth' in window )) {
                a = 'client';
                e = document.documentElement || document.body;
            }
            return {width: e[a + 'Width'], height: e[a + 'Height']};
        },

        _determineMobileVisibility: function () {
            if (this._mobileMode == false && this._isWindowBelowMaxWidth()) {
                this._prepareMobileMode();
            } else if(this._mobileMode && ! this._isWindowBelowMaxWidth()) {
                this._prepareDesktopMode();
            }
        },
        _prepareMobileMode: function() {
            this._mobileMode = true;
            $('body').addClass('mana-mobile-layered-navigation-enabled');
            $(document).trigger('mana-after-show', [document.body]);
        },
        _prepareDesktopMode: function() {
            this._mobileMode = false;
            $('body').removeClass('mana-mobile-layered-navigation-enabled');
            $(document).trigger('mana-after-show', [document.body]);
        }
    });

    return $.mana.MobileLayeredNavigation;
});