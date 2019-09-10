define([
    'jquery'
], function($) {
    return function(config) {
        $(function() {
            var fieldset = $(".field-show_more_method, .field-show_more_item_limit, .field-show_option_search");
            var template = $("#filter_template");

            function _hideShowMore() {
                if(config.eligible_templates.indexOf(template.val()) !== -1) {
                    // If template is not on the array, show it.
                    fieldset.show();
                }  else {
                    fieldset.hide();
                }
            }

            template.on('change', _hideShowMore);

            _hideShowMore();
        });
    };
});
