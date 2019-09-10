define([
    'jquery',
    'Manadev_Core/js/hideShowElementSelect'
], function($) {
    $(function() {
        function _isSlider(value) {
            return $.inArray(value, ['slider', 'min_max_slider', 'range_input']) !== -1;
        }

        function _isMinMaxSlider(value) {
            return value == 'min_max_slider';
        }

        function getTemplateFieldset() {
            var filterTemplateFieldset = $("#filter_template_fieldset");
            var fieldCount = filterTemplateFieldset.find(".manadev-admin-field").length;
            if(fieldCount > 2) {
                return $('.field-minimum_product_count_per_option, .field-hide_filter_with_single_visible_item');
            }

            return filterTemplateFieldset;
        }

        function showElements(fields) {
            for (var i in fields) {
                $(fields[i]).show();
            }
        }

        function hideElements(fields) {
            for(var i in fields) {
                $(fields[i]).hide();
            }
        }

        function _change() {
            var templateValue = $("#filter_template").val();
            var isTwoFormatValue = $("#filter_is_two_number_formats").val();
            var minMaxRoleValue = $("#filter_min_max_role").val();

            var templateFieldset = getTemplateFieldset();
            var sliderFieldset = $('#filter_slider_fieldset');


            if(_isSlider(templateValue)) {
                sliderFieldset.show();
                templateFieldset.hide();
            } else {
                sliderFieldset.hide();
                templateFieldset.show();
            }

            function secondNumberFields() {
                var secondNumberFormatFields = [".field-use_second_number_format_on", ".field-second_number_format", ".field-second_decimal_digits"];
                if (isTwoFormatValue == '1' && minMaxRoleValue == 'min') {
                    showElements(secondNumberFormatFields);
                } else {
                    hideElements(secondNumberFormatFields);
                }
            }

            secondNumberFields();

            var minMaxSliderFields = [".field-min_max_role", ".field-min_slider_code"];
            var minElements = [
                ".field-calculate_slider_min_max_based_on",
                ".field-number_format",
                ".field-decimal_digits",
                ".field-is_two_number_formats",
                ".field-use_second_number_format_on",
                ".field-second_number_format",
                ".field-second_decimal_digits",
                ".field-show_thousand_separator",
                ".field-is_slide_on_existing_values",
                ".field-is_manual_range",
                ".field-slider_style"
            ];
            if(_isMinMaxSlider(templateValue)) {
                showElements(minMaxSliderFields);
                var maxElements = [".field-min_slider_code"];
                if(minMaxRoleValue == 'min') {
                    showElements(minElements);
                    hideElements(maxElements);
                } else {
                    hideElements(minElements);
                    showElements(maxElements);
                }
                // secondNumberFields();
            } else {
                hideElements(minMaxSliderFields);
                showElements(minElements);
                // secondNumberFields();
            }
            secondNumberFields();
        }

        $("#filter_template").on('change', _change);
        $("#filter_is_two_number_formats").on('change', _change);
        $("#filter_min_max_role").on('change', _change);

        _change();
    });
});
