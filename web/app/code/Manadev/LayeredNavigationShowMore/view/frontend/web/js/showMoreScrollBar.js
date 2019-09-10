define([
    "jquery",
    "Manadev_LayeredNavigationShowMore/js/Heights",
    "Manadev_Core/js/functions/px",
    "jquery/ui"
], function($, Heights, px) {
    $.widget("mana.showMoreScrollBar", {
        options: {
            number_of_visible_items: 0
        },

        _create: function() {
            this.heights = new Heights({
                element: this.element,
                number_of_visible_items: this.options.number_of_visible_items,
                child_element_selector: 'li'
            });
            this.heights.calculate(true);
            this.update();

            $(document).on('mana-after-show', function (event, el) {
                if ($(el).has(this.element[0]).length) {
                    this.heights.calculate(true);
                    this.update();
                }
            }.bind(this));
        },
        update: function() {
            var inner = this.element.parent();
            var outer = inner.parent();

            outer.height(this.heights.min);
            if (this.heights.min < this.heights.max) {
                outer.addClass('scrollbar');
            }
            else {
                outer.removeClass('scrollbar');
            }
        }
    });

    return $.mana.showMoreScrollBar;
});