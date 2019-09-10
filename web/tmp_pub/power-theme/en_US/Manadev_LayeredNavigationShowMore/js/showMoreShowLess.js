define([
    "jquery",
    "Manadev_LayeredNavigationShowMore/js/Heights",
    "jquery/ui"
], function($, Heights) {
    var state = {};

    $.widget("mana.showMoreShowLess", {
        options: {
            number_of_visible_items: 0,
            transition_duration_ms: 500
        },

        _create: function() {
            if ($(document).data('mana-replacing-content')) {
                if (state[this.element[0].id] !== undefined) {
                    this.expanded = state[this.element[0].id];
                    delete state[this.element[0].id];
                }
            }
            else {
                this.expanded = false;
            }
            $(document).on('mana-before-replacing-content', function(event, $containers) {
                if ($containers.has(this.element[0]).length) {
                    state[this.element[0].id] = this.expanded;
                }
            }.bind(this));

            this.heights = new Heights({
                element: this.element,
                number_of_visible_items: this.options.number_of_visible_items,
                child_element_selector: 'li'
            });
            this.heights.calculate(true);
            this.update();

            this.transition_duration_ms = this.options.transition_duration_ms;

            $(document).on('mana-after-show', function (event, el) {
                if ($(el).has(this.element[0]).length) {
                    this.heights.calculate(true);
                    this.update(true);
                }
            }.bind(this));

            var inner = this.element.parent();
            var outer = inner.parent();
            var container = outer.parent();

            container.find('.manadev-show-more a').on('click', function(event) {
                this.expanded = !this.expanded;
                this.update();

                event.preventDefault();
                event.stopPropagation();
            }.bind(this));

            outer.css({'transition-duration': '' + this.transition_duration_ms + 'ms'});
        },
        update: function(refresh) {
            var inner = this.element.parent();
            var outer = inner.parent();
            var container = outer.parent();

            var duration = refresh ? 0 : this.transition_duration_ms;

            outer.css({'transition-duration': '' + duration + 'ms'});
            if (this.heights.min < this.heights.max) {
                container.find('.manadev-show-more').show();
            }
            else {
                container.find('.manadev-show-more').hide();
            }
            outer.height(this.expanded ? this.heights.max : this.heights.min);

            setTimeout(function() {
                container.find('.manadev-show-more a').text(this.expanded
                    ? this.options.show_less_label
                    : this.options.show_more_label);
                outer.css({'transition-duration': '' + this.transition_duration_ms + 'ms'});
            }.bind(this), duration);
        }
    });

    return $.mana.showMoreShowLess;
});