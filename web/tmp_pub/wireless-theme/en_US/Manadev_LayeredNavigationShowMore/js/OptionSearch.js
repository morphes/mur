define(["jquery", "jquery/ui"], function($) {
    $.widget("mana.OptionSearch", {
        _create: function() {
            this.bound_search = this.search.bind(this);
            this.element.on('keyup', this.bound_search);
            this.element.on('change', this.bound_search);
        },
        search: function() {
            var needle = this.element.val().toLowerCase();
            if (needle) {
                this.$items().each(function(index, element) {
                    var $item = $(element);
                    var haystack = $item.text().toLowerCase();
                    if (haystack.indexOf(needle) != -1) {
                        $item.removeClass('mana-no-match');
                    }
                    else {
                        $item.addClass('mana-no-match');
                    }
                }.bind(this));
            }
            else {
                this.$items().removeClass('mana-no-match');
            }

            $(document).trigger('mana-after-show', [this.element.parent().parent()]);
        },
        $items: function() {
            return this.element.parent().next().find('li');
        }
    });

    return $.mana.OptionSearch;
});