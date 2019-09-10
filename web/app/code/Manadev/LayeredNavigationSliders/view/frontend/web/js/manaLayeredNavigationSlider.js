define([
    'jquery',
    'jquery/ui'
], function($) {
    $.widget("mana.manaLayeredNavigationSlider", {
        options: {
            onSlide: function(value, slider) {
                if(slider.options.showRangeInput) {
                    slider.updateInputValue();
                } else {
                    var formattedValue = [slider.format(value[0], 'floor'), slider.format(value[1], 'ceil')];
                    var applied = slider.options.appliedFormat
                        .replace("__0__", formattedValue[0])
                        .replace("__1__", formattedValue[1]);
                    slider.rangeAppliedSpan.html(applied);
                }
            },
            onChange: function(value, slider) {
                var url;
                var x;

                if (value[0] == slider.options.range[0] && value[1] == slider.options.range[1]) {
                    // If selected range is minimum and maximum range, remove filter.
                    url = slider.options.clearFilterURL;
                    slider.setLocation(url, this.paramName + '=');
                    return;
                }

                if(!slider.isDropdownSlider()) {
                    url = slider.options.applyFilterURL
                        .replace("__0__", value[0])
                        .replace("__1__", value[1]);
                    slider.setLocation(url, this.paramName + '=' + value[0] + '-' + value[1]);
                } else {
                    var optionIds = [];
                    for (x = value[0]; x <= value[1]; x++) {
                        optionIds.push(slider.options.allowedValuesId[x]);
                    }
                    optionIds = optionIds.join('_');

                    if (slider.options.allowedValueUrlKeys) {
                        var selectedItems = [];
                        for (x = value[0]; x <= value[1]; x++) {
                            var optionId = slider.options.allowedValuesId[x];
                            selectedItems.push(slider.options.allowedValueUrlKeys[optionId]);
                        }
                        selectedItems.sort(function (a, b) {
                            if (parseInt(a.position) < parseInt(b.position)) return -1;
                            if (parseInt(a.position) > parseInt(b.position)) return 1;
                            return 0;
                        });
                        selectedItems = selectedItems.map(function (item) {
                            return item.url_key;
                        });
                        url = slider.options.applyFilterURL
                            .replace("__0__", selectedItems.join(slider.options.valueDelimiter));
                    }
                    else {
                        url = slider.options.applyFilterURL.replace("__0__", optionIds);
                    }
                    slider.setLocation(url, this.paramName + '=' + optionIds);
                }
            },
            range: false,
            appliedRange: false,
            appliedFormat: false,
            allowedValues: false,
            allowedValuesId: false,
            numberFormat: false,
            clearFilterURL: false,
            applyFilterURL: false,
            secondNumberFormat: false,
            useSecondNumberFormatOn: false,
            showThousandSeparator: false,
            showRangeInput: false,
            /**
             * Set to true so that the slider will initialize on show (needed to calculate slider width)
             */
            isInitLate: true,
            isDropdownInline: false,
            isDropdownSlider: false
        },

        handles: [],
        trackLength: 0,
        events: {},

        track: null,
        rangeFromSpan: null,
        rangeToSpan: null,
        rangeAppliedSpan: null,
        rangeAppliedFrom: null,
        rangeFromInput: null,
        rangeAppliedTo: null,
        rangeToInput: null,

        isDragging: false,

        needsResize: false,

        activeHandleIdx: null,

        setLocation: function (url, action) {
            location.href = url;
        },

        _bindInputRangeEvents: function () {
            var self = this;
            var _timer = null;

            function _triggerChange() {
                self.triggerChange();
            }

            function _changeValueToSlider(input) {
                self.setValue($(input).val(), $(input).data('idx'));
                self.updateInputValue();
            }

            function _onInputChange() {
                var input = this;
                _changeValueToSlider(input);
                if (!_timer) {
                    _timer = setTimeout(function () {
                        clearTimeout(_timer);
                        _timer = null;
                        _triggerChange();
                    }, 100);
                }
            }
            function _onInputKeyPress(e) {
                if (e.which == 13) {
                    if (!_timer) {
                        _timer = setTimeout(function () {
                            clearTimeout(_timer);
                            _timer = null;
                            _triggerChange();
                        }, 100);
                    }
                }
            }
            function _onInputFocus() {
                if (_timer) {
                    clearTimeout(_timer);
                    _timer = null;
                }
                var self = this;
                var focusing = setTimeout(function () {
                    clearTimeout(focusing);
                    focusing = null;
                    $(self).select();
                }, 100);

            }
            function _onInputBlur() {
                if (_timer) {
                    clearTimeout(_timer);
                    _timer = null;
                }
                _triggerChange();
            }

            this.rangeFromInput.data("idx", 0)
                .on("change", _onInputChange)
                .on("keypress", _onInputKeyPress)
                .on("focus", _onInputFocus);

            this.rangeToInput.data("idx", 1)
                    .on("change", _onInputChange)
                    .on("keypress", _onInputKeyPress)
                    .on("focus", _onInputFocus)
                    .on("blur", _onInputBlur);
        },
        _create: function () {
            var self = this;

            function getChildElementWithClass(className) {
                return $(self.element).find("." + className);
            }

            this.handles = [getChildElementWithClass('mana-slider-from'), getChildElementWithClass('mana-slider-to')];
            this.track = getChildElementWithClass('mana-filter-slider');
            this.span = getChildElementWithClass('mana-slider-span');
            this.rangeFromSpan = getChildElementWithClass('mana-slider-min-value');
            this.rangeToSpan = getChildElementWithClass('mana-slider-max-value');
            this.rangeAppliedSpan = getChildElementWithClass('mana-slider-selected-value');

            if(this.options.showRangeInput) {
                var rangeAppliedFromSpan = getChildElementWithClass('mana-slider-applied-from');
                var rangeAppliedToSpan = getChildElementWithClass('mana-slider-applied-to');

                this.rangeAppliedSpan.html(
                    this.options.appliedFormat
                        .replace("__0__", rangeAppliedFromSpan.prop("outerHTML"))
                        .replace("__1__", rangeAppliedToSpan.prop("outerHTML"))
                );
                this.rangeAppliedFrom = getChildElementWithClass('mana-slider-applied-from');
                this.rangeFromInput = this.rangeAppliedFrom.find("input");
                this.rangeAppliedTo = getChildElementWithClass('mana-slider-applied-to');
                this.rangeToInput = this.rangeAppliedTo.find("input");
                this._bindInputRangeEvents();
            }

            this.initSlider();

            this.events.mouseDown = $.proxy(this._eventStartDrag, this);
            this.events.mouseUp = $.proxy(this._eventEndDrag, this);
            this.events.mouseMove = $.proxy(this._eventUpdate, this);
            this.events.resizeWindow = $.proxy(this._eventResize, this);
            this.events.afterShow = $.proxy(this._afterShow, this);

            $.each(this.handles, function () {
                this.on("mousedown", self.events.mouseDown);
                this.on("touchstart", self.events.mouseDown);
            });

            $(document).on("mouseup", this.events.mouseUp);
            $(document).on("touchend", this.events.mouseUp);
            $(document).on("mousemove", this.events.mouseMove);
            $(document).on("touchmove", this.events.mouseMove);
            $(window).on("resize", this.events.resizeWindow);
            $(document).on("mana-after-show", this.events.afterShow);
        },

        _destroy: function () {
            var self = this;
            $.each(this.handles, function () {
                this.off("mousedown", self.events.mouseDown);
                this.off("touchstart", self.events.mouseDown);
            });

            $(document).off("mouseup", this.events.mouseUp);
            $(document).off("touchend", this.events.mouseUp);
            $(document).off("mousemove", this.events.mouseMove);
            $(document).off("touchmove", this.events.mouseMove);
            $(window).off("resize", this.events.resizeWindow);
            $(document).off("mana-after-show", this.events.afterShow);
        },

        initSlider: function () {
            var allowedValues = this.options.allowedValues;
            if (!this.isDropdownSlider()) {
                for (var i = 0; i < allowedValues.length; i++) {
                    allowedValues[i] = parseFloat(allowedValues[i]);
                }
            }
            var range = this.options.range;

            if (!range && !allowedValues) {
                console.error("Must provide either range or allowed values");
                return
            }

            this.handleLength = this.handles[0].outerWidth();

            if (allowedValues && !range) {
                if (this.isDropdownSlider()) {
                    this.options.range = [0, allowedValues.length - 1];
                } else {
                    this.options.range = [allowedValues[0], allowedValues[allowedValues.length - 1]];
                }
            }
            if (!this.options.appliedRange) {
                this.options.appliedRange = [parseFloat(this.options.range[0]), parseFloat(this.options.range[1])];
            }
            this.options.range[0] = parseFloat(this.options.range[0]);
            this.options.range[1] = parseFloat(this.options.range[1]);

            this.rangeFromSpan.html(this.format(this.options.range[0], 'floor'));
            this.rangeToSpan.html(this.format(this.options.range[1], 'ceil'));

            if (this.options.showRangeInput) {
                this.updateInputValue();
                this.rangeOnInputLoad = [this.rangeFromInput.val(), this.rangeToInput.val()];
                var numberFormat = this.getFormatForNumber(0);
                var before = numberFormat.substring(0, numberFormat.indexOf('0'));
                var after = numberFormat.substring(numberFormat.indexOf('0') + 1);
                this.rangeAppliedFrom.find(".mana-slider-before-input").html(before);
                this.rangeAppliedFrom.find(".mana-slider-after-input").html(after);
                this.rangeAppliedTo.find(".mana-slider-before-input").html(before);
                this.rangeAppliedTo.find(".mana-slider-after-input").html(after);
            }

            this._draw();
        },
        updateInputValue: function () {
            this.rangeFromInput.val(this.options.appliedRange[0]);
            this.rangeToInput.val(this.options.appliedRange[1]);
        },
        isDropdownSlider: function () {
            return this.options.isDropdownSlider == true;
        },

        setValue: function(sliderValue, handleIdx) {
            if (!this.isDragging) {
                this.activeHandleIdx = handleIdx;
            }
            handleIdx = handleIdx || this.activeHandleIdx || 0;
            sliderValue = this._getNearestValue(sliderValue, handleIdx);


            this.options.appliedRange[handleIdx] = sliderValue;

            if(this.options.appliedRange[1] < this.options.appliedRange[0]) {
                sliderValue = this.options.appliedRange[(handleIdx == 0) ? 1 : 0];
                this.options.appliedRange[handleIdx] = sliderValue;
            }

            this.handles[handleIdx].css("left", this._translateToPx(sliderValue, handleIdx));

            this._drawSpans();
        },
        isTrackVisible: function () {
            return this._getTrackLength() > 0;
        },
        getFormatForNumber: function (number) {
            var secondNumberFormat = this.options.secondNumberFormat;
            var numberFormat = this.options.numberFormat;
            if (secondNumberFormat && number >= this.options.useSecondNumberFormatOn) {
                numberFormat = secondNumberFormat;
            }
            return numberFormat;
        },
        getDecimalDigits: function(number) {
            var result = parseInt(this.options.decimalDigits);
            result = isNaN(result) ? 0 : result;

            if (!this.options.useSecondNumberFormatOn) {
                return result;
            }

            if (number >= this.options.useSecondNumberFormatOn) {
                result = parseInt(this.options.secondFormatDecimalDigits);
                result = isNaN(result) ? 0 : result;
            }

            return result;
        },

        format: function(value, roundingMethod) {
            if(this.isDropdownSlider()) {
                return this.options.allowedValues[value];
            }
            return this.formatNumber(value, roundingMethod);
        },
        formatNumber: function(number, roundingMethod) {
            function _numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            var numberFormat = this.getFormatForNumber(number);
            var decimalDigits = this.getDecimalDigits(number);
            var multiplier = Math.pow(10, decimalDigits);

            if(this.options.secondNumberFormat && number >= this.options.useSecondNumberFormatOn) {
                number /= this.options.useSecondNumberFormatOn;
            }
            number = Math[roundingMethod](number * multiplier) / multiplier;

            if(this.options.showThousandSeparator) {
                number = _numberWithCommas(number);
            }

            return numberFormat.replace('0', number);
        },

        _drawSpans: function () {
            // Draw span
            this.span.width(this._translateToPx(this.options.appliedRange[1] - this.options.appliedRange[0] + this.options.range[0]));
            this.span.css('left', this._translateToPx(this.options.appliedRange[0]));
        },
        _draw: function (setHandleValue) {
            setHandleValue = (setHandleValue === undefined) ? true : setHandleValue;
            // Track length is recalculated on resize and initialization
            this.trackLength = this._getTrackLength();
            this.handleLength = this.handles[0].outerWidth();
            this._drawSpans();

            if(setHandleValue) {
                // Draw handles
                var self = this;
                $.each(this.handles, function (i) {
                    self.setValue(self.options.appliedRange[i], i);
                });
            }
            if (this.options.onSlide) {
                this.options.onSlide(this.options.appliedRange, this);
            }
        },
        _translateToPx: function(value, handleIdx) {
            var handleLength = this.handleLength;
            var offset = (value - this.options.range[0]) / (this.options.range[1] - this.options.range[0]) * (this.trackLength - (2 * handleLength));
            if (handleIdx !== undefined) {
                if (handleIdx > 0) {
                    return Math.round(offset + handleLength) + 'px';
                }
                else {
                    return Math.round(offset) + 'px';
                }
            }
            else {
                return Math.round(offset + handleLength) + 'px';
            }
        },
        _translateToValue: function(offset) {
            var percent = 0;
            var adjustToCenterCursor = 0;

            if (this.activeHandleIdx > 0) {
                adjustToCenterCursor = 1.5 * this.handleLength;
                percent = (offset - adjustToCenterCursor) / (this.trackLength - 2 * this.handleLength)
            }
            else {
                adjustToCenterCursor = 0.25 * this.handleLength;
                percent = (offset - adjustToCenterCursor) / (this.trackLength - 2 * this.handleLength)
            }
            var value = percent * (this.options.range[1] - this.options.range[0]) + this.options.range[0];
            if (value < this.options.range[0]) {
                value = this.options.range[0];
            }
            else if (value > this.options.range[1]) {
                value = this.options.range[1];
            }
            return value;
        },
        _getNearestValue: function (value, handleIdx) {
            if (this.options.allowedValues && this.isDragging) {
                var lastRecord = this.options.allowedValues[this.options.allowedValues.length-1];
                var firstRecord = this.options.allowedValues[0];
                if (this.isDropdownSlider()) {
                    firstRecord = 0;
                    lastRecord = this.options.allowedValues.length-1;
                }

                if (value >= lastRecord) {
                    return lastRecord;
                }
                if (value <= firstRecord) {
                    return firstRecord;
                }

                var offset = Math.abs(firstRecord - value);
                var newValue = firstRecord;
                var self = this;
                $.each(this.options.allowedValues, function (i, v) {
                    if (self.isDropdownSlider()) {
                        v = i;
                    }
                    var currentOffset = Math.abs(v - value);
                    if (currentOffset <= offset) {
                        newValue = v;
                        offset = currentOffset;
                    }
                });
                return newValue;
            }
            if (parseFloat(value) > parseFloat(this.options.range[1])) {
                value = this.options.range[1];
            } else if (parseFloat(value) < parseFloat(this.options.range[0])) {
                value = this.options.range[0];
            }

            var decimalDigits = this.getDecimalDigits(0);
            var multiplier = Math.pow(10, decimalDigits);
            var roundingMethod = handleIdx == 0 ? 'floor' : 'ceil';
            return Math[roundingMethod](value * multiplier) / multiplier;
        },
        _getPointerX: function (event) {
            return event.originalEvent && event.originalEvent.touches
                ? event.originalEvent.touches[0].clientX
                : (event.touches
                    ? event.touches[0].clientX
                    : event.pageX);
        },
        _getOffset: function (e) {
            return this._getPointerX(e) - this.track.offset().left;
        },
        _getTrackLength: function () {
            return this.track.width();
        },

        _eventStartDrag: function(e) {
            this.isDragging = true;
            this.activeHandleIdx = (this.handles[0][0] == e.target) ? 0 : 1;
            this.valueBeforeDrag = [this.options.appliedRange[0], this.options.appliedRange[1]];
        },
        _getValuesBeforeChange: function () {
            return this.isDragging ? this.valueBeforeDrag : this.rangeOnInputLoad;
        },
        _valuesChanged: function () {
            var valueBeforeChange = this._getValuesBeforeChange();
            return valueBeforeChange[1] != this.options.appliedRange[1] || valueBeforeChange[0] != this.options.appliedRange[0];

        },
        triggerChange: function () {
            if (this.options.onChange && this._valuesChanged()) {
                this.options.onChange(this.options.appliedRange, this);
            }
        },
        _eventEndDrag: function(){
            if(this.isDragging) {
                this.triggerChange();
                this.isDragging = false;
            }
        },
        _eventUpdate: function(e) {
            if(this.isDragging) {
                if(!this.isTrackVisible()) {
                    this.options.appliedRange = this._getValuesBeforeChange();
                    this._draw();
                    this.needsResize = true;
                    this.isDragging = false;
                    return;
                }

                e.preventDefault();

                var handleIdx = this.activeHandleIdx;
                var offset = this._getOffset(e);
                var value = this._translateToValue(offset);
                var sliderValue = this._getNearestValue(value, handleIdx);
                this.options.appliedRange[handleIdx] = sliderValue;

                if (this.options.appliedRange[1] < this.options.appliedRange[0]) {
                    sliderValue = this.options.appliedRange[handleIdx == 0 ? 1 : 0];
                    this.options.appliedRange[handleIdx] = sliderValue;
                }
                this.setValue(sliderValue);

                this._draw(false);
            }
        },
        _eventResize: function() {
            this.needsResize = true;
            this._draw();
        },
        _afterShow: function(event, el) {
            if ($(el).has(this.element[0]).length) {
                this._draw();
            }
        }
    });

    return $.mana.manaLayeredNavigationSlider;
});