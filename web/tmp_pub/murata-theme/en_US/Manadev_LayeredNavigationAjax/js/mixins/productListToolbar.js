define(['Manadev_LayeredNavigationAjax/js/vars/interceptor', 'jquery'], function(interceptor, $) {
    return function(ToolbarWidget) {
        var el;

        ToolbarWidget.prototype._processLink = function (event) {
            // modification of original method: saving clicked element to a variable
            el = event.currentTarget;

            event.preventDefault();
            this.changeUrl(
                event.data.paramName,
                $(event.currentTarget).data('value'),
                event.data.default
            );
        };

        ToolbarWidget.prototype._processSelect = function (event) {
            // modification of original method: saving clicked element to a variable
            el = event.currentTarget;

            this.changeUrl(
                event.data.paramName,
                event.currentTarget.options[event.currentTarget.selectedIndex].value,
                event.data.default
            );
        };

        ToolbarWidget.prototype.changeUrl = function (paramName, paramValue, defaultValue) {
            var decode = window.decodeURIComponent;
            var urlPaths = this.options.url.split('?'),
                baseUrl = urlPaths[0],
                urlParams = urlPaths[1] ? urlPaths[1].split('&') : [],
                paramData = {},
                parameters;
            for (var i = 0; i < urlParams.length; i++) {
                parameters = urlParams[i].split('=');
                paramData[decode(parameters[0])] = parameters[1] !== undefined
                    ? decode(parameters[1].replace(/\+/g, '%20'))
                    : '';
            }
            paramData[paramName] = paramValue;
            // if (paramValue == defaultValue) {
            //     delete paramData[paramName];
            // }
            paramData = $.param(paramData);

            // modification of original method: not just assign location.href, but also pipeline URL
            // through AJAX interceptor object. If object says that it will intercept this click,
            // location.href is not changed - we hope interceptor will do its jos
            var url = baseUrl + (paramData.length ? '?' + paramData : '');
            if (!interceptor.intercept(url, el, paramName + '=' + paramValue)) {
                location.href = url;
            }
        };

        return ToolbarWidget;
    };
});