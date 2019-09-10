define(['jquery', 'Manadev_Core/js/widget'], function($, widget) {
    $.widget('Manadev_Seo.createRedirectCheckbox', widget, {
        trEvents: {
            'keyup td.value > :first': 'onInputChange',
            'click td.use-default input': 'onUseDefaultClick'
        },
        events: {
            'click .toggle-history': 'onToggleHistoryClick'
        },

        _create: function() {
            this._super();

            this.originalValue = this.getValue();
            this.originalIsChecked = this.getUseDefaultCheckbox().is(':checked');
            this.showHistoryLabel = this.getHistoryToggler().html();
            this.hideHistoryLabel = this.options.hide_history_label;

            this.attachEvents('trEvents', this.getTr());
        },

        _destroy: function() {
            this._super();

            this.detachEvents('trEvents', this.getTr());
        },

        getTr: function() {
            return this.element.parent().parent();
        },
        getInput: function () {
            var $input = this.element.parent().children().first();

            if ($input.hasClass('input-text')) {
                return $input;
            }

            throw 'Input element type not supported';
        },

        getCreateRedirectCheckbox: function() {
            return this.element.find('input');
        },

        getUseDefaultCheckbox: function () {
            return this.element.parent().siblings('.use-default').find('input');
        },

        getValue: function() {
            var $input = this.getInput();

            if ($input.hasClass('input-text')) {
                return $input.val();
            }

            throw 'Input element type not supported';
        },

        getHistoryToggler: function() {
            return this.element.find('.toggle-history');
        },

        getHistoryTable: function () {
            return this.element.parent().find('.mana-redirects');
        },

        onInputChange: function() {
            this.disableOrEnableCreateRedirectCheckbox();
        },

        onUseDefaultClick: function () {
            this.disableOrEnableCreateRedirectCheckbox();
        },

        onToggleHistoryClick: function(e) {
            if (this.getHistoryToggler().html() == this.showHistoryLabel) {
                this.getHistoryToggler().html(this.hideHistoryLabel);
                this.getHistoryTable().show();
            }
            else {
                this.getHistoryToggler().html(this.showHistoryLabel);
                this.getHistoryTable().hide();
            }
            e.preventDefault();
        },

        disableOrEnableCreateRedirectCheckbox: function() {
            if (this.getValue() !== this.originalValue) {
                this.getCreateRedirectCheckbox().removeAttr('disabled').removeClass('disabled');
                return;
            }

            if (this.getUseDefaultCheckbox().is(':checked') !== this.originalIsChecked) {
                this.getCreateRedirectCheckbox().removeAttr('disabled').removeClass('disabled');
                return;
            }

            this.getCreateRedirectCheckbox().attr('disabled', 'disabled').addClass('disabled');
        }
    });

    return $.Manadev_Seo.createRedirectCheckbox;
});