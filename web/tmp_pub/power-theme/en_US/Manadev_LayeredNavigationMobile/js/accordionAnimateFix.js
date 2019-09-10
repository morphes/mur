/**
 * This will make the non-multiple collapsible accordion do animation on deactivate when another collapsible is selected
 */
require(['jquery', 'mage/tabs'], function($) {
    $.mage.tabs.prototype._closeOthers = function () {
        var self = this;
        $.each(this.collapsibles, function () {
            $(this).on("beforeOpen", function () {
                // Use `activate` instead of `forceDeactivate` so that deactivation will trigger animation

                // self.collapsibles.not(this).collapsible("forceDeactivate");
                self.collapsibles.not(this).collapsible("deactivate");
            });
        });
    };
});