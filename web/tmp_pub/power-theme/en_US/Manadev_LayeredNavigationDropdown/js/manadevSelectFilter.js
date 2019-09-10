define([
    'jquery',
    'jquery/ui'
], function ($) {
    $.widget("mana.manadevSelectFilter", {
        _create: function() {
            $(this.element).on('change', this._onChangeEvent = this.onChangeEvent.bind(this));
        },
        _destroy: function() {
            $(this.element).off('change', this._onChangeEvent);
        },

        onChangeEvent: function (event) {
            this.setLocation(event.currentTarget.value,
                $(event.currentTarget).find('option:selected').data('action'));
        },
        setLocation: function (url, action) {
            location.href = url;
        }

    });

    return $.mana.manadevSelectFilter;
});