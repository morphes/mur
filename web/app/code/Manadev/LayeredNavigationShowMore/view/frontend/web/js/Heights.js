define(['module', 'Manadev_Core/js/functions/class', 'Manadev_Core/js/Data', 'jquery',
    'Manadev_LayeredNavigationShowMore/js/vars/styles', 'Manadev_Core/js/functions/px'],
function(module, class_, Data, $, styles, px) {
    /**
     * Properties:
     *      element
     *      number_of_visible_items
     *      child_element_selector
     */
    return class_(module.id, Data, {
        calculate: function(forceRecalculation) {
            if (forceRecalculation) this.heights_calculated = false;
            if (this.heights_calculated) return;

            this.applyStyles();
            var elements = this.getElements();
            var css = elements.inner.css(styles.css);

            var item_limit = parseInt(this.number_of_visible_items);
            var height = this.rule_based_height + parseInt(elements.inner.css('padding-top'));
            var maxHeight = height;
            var collapsibleMargin = 0;
            var i = 0;
            this.element.find(this.child_element_selector).each(function() {
                if (!$(this).is(':visible')) {
                    return;
                }
                var topMargin = parseInt($(this).css('margin-top'));
                var bottomMargin = parseInt($(this).css('margin-bottom'));
                if (collapsibleMargin) {
                    topMargin -= Math.min(collapsibleMargin, topMargin);
                }
                if (bottomMargin) {
                    collapsibleMargin = bottomMargin;
                }

                var thisHeight = topMargin + $(this).outerHeight() + bottomMargin;
                if(i < item_limit) {
                    height += thisHeight;
                }

                maxHeight += thisHeight;
                i++;
            });

            this.min = height;
            this.max = maxHeight;
            this.heights_calculated = true;
        },

        applyStyles: function() {
            var debug = false;

            if (this.css) {
                return;
            }

            var elements = this.getElements();
            this.css = elements.container.css(styles.css);

            if (debug) {
                console.log(this.element[0].id);
                console.log(elements);
                console.log('fetching', css);
            }
            var oldCss, cssToBeApplied;
            var newCss = {
                container: {},
                outer: {},
                inner: {},
                height: 0
            };

            styles.rules.forEach(function(rule) {
                if (!elements.outer.is(rule.selector)) {
                    return;
                }

                var ruleCss = rule.fn(this.css);

                for (var target in newCss) {
                    if (!newCss.hasOwnProperty(target)) continue;

                    if (target == 'height') {
                        if (ruleCss[target] !== undefined) {
                            newCss[target] = ruleCss[target];
                        }
                        continue;
                    }

                    $.extend(newCss[target], ruleCss[target] || {});
                }
            }.bind(this));

            this.rule_based_height = 0;
            for (var target in newCss) {
                if (!newCss.hasOwnProperty(target)) continue;

                if (target == 'height') {
                    this.rule_based_height = newCss[target];
                    continue;
                }

                oldCss = elements[target].css(styles.css);
                cssToBeApplied = {};
                for (var property in newCss[target]) {
                    if (!newCss[target].hasOwnProperty(property)) continue;
                    if (newCss[target][property] === undefined) continue;
                    if (newCss[target][property] === null) continue;
                    if (oldCss[property] === newCss[target][property]) continue;

                    cssToBeApplied[property] = newCss[target][property];
                }

                if (debug) {
                    console.log('Updating ' + target, cssToBeApplied);
                }
                elements[target].css(cssToBeApplied);
            }
        },

        getElements: function() {
            var elements = {inner: this.element.parent()};
            elements.outer = elements.inner.parent();
            elements.container = elements.outer.parent();

            return elements;
        }
    });
});