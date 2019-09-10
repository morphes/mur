define(['Manadev_LayeredNavigationAjax/js/vars/interceptor', 'jquery'], function(interceptor, $) {
    var state = {};

    return function(SwatchRendererWidget) {
        var originalInit = SwatchRendererWidget.prototype._init;
        var originalDestroy = SwatchRendererWidget.prototype._destroy;

        SwatchRendererWidget.prototype._init = function() {
            var id = this.element[0].className;
            if (id && state[id]) {
                for (var key in state[id]) {
                    if (!state[id].hasOwnProperty(key)) continue;

                    this.options[key] = state[id][key];
                }
            }

            if ($(document).data('mana-replacing-content')) {
                $('.swatch-option-tooltip').remove();
            }
            
            $(document).on('mana-before-replacing-content',
                this._bound_beforeReplacingContent = this._beforeReplacingContent.bind(this));

            originalInit.call(this);
        };

        SwatchRendererWidget.prototype._destroy = function() {
            $(document).off('mana-before-replacing-content', this._bound_beforeReplacingContent);

            originalDestroy.call(this);
        };

        SwatchRendererWidget.prototype._beforeReplacingContent = function(event, $containers) {
            if (!$containers.has(this.element[0]).length) {
                return;
            }

            var id = this.element[0].className;
            if (!id) {
                return;
            }

            state[id] = {
                mediaCache: this.options.mediaCache
            };
        };

        return SwatchRendererWidget;
    };
});