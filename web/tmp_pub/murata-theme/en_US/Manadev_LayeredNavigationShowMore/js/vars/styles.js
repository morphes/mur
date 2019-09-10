define(['Manadev_Core/js/functions/px'], function(px) {
    return {
        /**
         * CSS properties listed here are fetched from filter container element and passed into `css`
         * parameter in rule functions
         */

        css: [
            'margin-top',
            'margin-right',
            'margin-bottom',
            'margin-left',
            'border-top-width',
            'border-right-width',
            'border-bottom-width',
            'border-left-width',
            'padding-top',
            'padding-right',
            'padding-bottom',
            'padding-left'
        ],

        /**
         * Rule functions are defined below.
         *
         * Rule functions modify CSS properties of container, outer and inner elements based on container element
         * properties provided by theme.
         *
         * Rule functions are executed in the same order as they are defined for each filter having
         * show more/show less or scrollbar functionality and matching specified CSS selector.
         *
         * CSS property is not modified if its value is null or undefined. It is also not modified if value
         * calculated by rule functions is the same as the one calculated in theme CSS files.
         *
         */

        rules: [
            {
                selector: '.scrollbar',
                fn: function(css) {
                    return {
                        container: {
                            'margin-top': '0px',
                            'margin-right': '0px',
                            'margin-bottom': '0px',
                            'margin-left': '0px',
                            'border-top-width': '0px',
                            'border-right-width': '0px',
                            'border-bottom-width': '0px',
                            'border-left-width': '0px',
                            'padding-top': '0px',
                            'padding-right': '0px',
                            'padding-bottom': '0px',
                            'padding-left': '0px'
                        },
                        inner: {
                        },
                        outer: {
                            'margin-top': (px(css['margin-top']) + px(css['padding-top'])) + 'px',
                            'margin-right': css['margin-right'],
                            'margin-bottom': (px(css['margin-bottom']) + px(css['padding-bottom'])) + 'px',
                            'margin-left': css['margin-left'],
                            'padding-top': '0px',
                            'padding-right': css['padding-right'],
                            'padding-bottom': '0px',
                            'padding-left': css['padding-left']
                        }
                    };
                }
            },
            {
                selector: '.mana-filter-block.mana-mobile .scrollbar, ' +
                    '.mana-filter-block.mana-filter-block-above-menu .scrollbar',
                fn: function(css) {
                    return {
                        container: {
                        },
                        inner: {
                            'margin-top': (px(css['margin-top']) + px(css['padding-top'])) + 'px',
                            'margin-bottom': (px(css['margin-bottom']) + px(css['padding-bottom'])) + 'px',
                        },
                        outer: {
                            'margin-top': '0px',
                            'margin-bottom': '0px'
                        }
                    };
                }
            },
            {
                selector: '.mana-filter-block.mana-filter-block-above-menu .scrollbar',
                fn: function(css) {
                    return {
                        container: {
                        },
                        inner: {
                        },
                        outer: {
                        },
                        height: (px(css['margin-top']) + px(css['padding-top']))
                    };
                }
            },
            {
                selector: '.show-more-show-less',
                fn: function(css) {
                    return {
                        container: {
                            'margin-top': '0px',
                            'margin-right': '0px',
                            'margin-bottom': '0px',
                            'margin-left': '0px',
                            'border-top-width': '0px',
                            'border-right-width': '0px',
                            'border-bottom-width': '0px',
                            'border-left-width': '0px',
                            'padding-top': '0px',
                            'padding-right': '0px',
                            'padding-bottom': '0px',
                            'padding-left': '0px'
                        },
                        inner: {
                            'margin-top': css['margin-top'],
                            'margin-right': css['margin-right'],
                            'margin-bottom': css['margin-bottom'],
                            'margin-left': css['margin-left'],
                            'border-top-width': css['border-top-width'],
                            'border-right-width': css['border-right-width'],
                            'border-bottom-width': css['border-bottom-width'],
                            'border-left-width': css['border-left-width'],
                            'padding-top': css['padding-top'],
                            'padding-right': css['padding-right'],
                            'padding-bottom': css['padding-bottom'],
                            'padding-left': css['padding-left']
                        },
                        outer: {
                        }
                    };
                }
            },
            {
                selector: '.mana-filter-block.mana-filter-block-above-menu .show-more-show-less, ' +
                    '.mana-filter-block.mana-filter-block-above-horizontal .show-more-show-less',
                fn: function(css) {
                    return {
                        container: {
                        },
                        inner: {
                        },
                        outer: {
                        },
                        height: (px(css['margin-top']) + px(css['padding-top']))
                    };
                }
            }
        ]
    };
});