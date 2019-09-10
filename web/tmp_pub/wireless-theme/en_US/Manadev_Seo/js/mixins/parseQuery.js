define(['jquery'], function($) {
    return function() {
        var originalParseQuery = $.parseQuery;

        $.parseQuery = function(options) {
            var params = originalParseQuery.call($, options);

            if (options !== undefined) {
                return params;
            }

            return window.manadevSeoQuery || params;
        };

        $.parseQuery.decode = originalParseQuery.decode;
        $.parseQuery.array_keys = originalParseQuery.array_keys;
        $.parseQuery.separator = originalParseQuery.separator;

    };
});