define([
    'jquery',
    'jquery/ui'
], function ($) {
    $.widget("mana.manadevRadioFilter", {
        _create: function() {
            $(this.element).find("input[type='radio']").on('click', this.bound_onChange = this.onChange.bind(this));
        },
        _destroy: function() {
            $(this.element).find("input[type='radio']").off('click', this.bound_onChange);
        },

        onChange: function (event) {
            this.setLocation(event.currentTarget.value, $(event.currentTarget).data('action'));
        },
        setLocation: function (url, action) {
            location.href = url;
        }
    });

    return $.mana.manadevRadioFilter;
});