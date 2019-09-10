define([
    "jquery",
    "jquery/ui"
], function($) {
    $.widget("mana.showMorePopup", {
        options: {

        },
        _create: function() {
            console.log('show more popup');
        }
    });

    return $.mana.showMorePopup;
});