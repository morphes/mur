define(['Manadev_LayeredNavigationAjax/js/vars/interceptor', 'jquery'], function(interceptor, $) {
    return function (config, element) {
        function intercept(event, callback) {
            if (!interceptor.started) {
                return;
            }

            var element = event.currentTarget;
            if (interceptor.intercept(element.href, element, 'p=' + callback())) {
                event.preventDefault();
            }
        }
        $(element).on('click', 'a.page', function (event) {
            intercept(event, function() {
                return $(event.currentTarget).find('span:not(.label)').text();
            });
        });
        $(element).on('click', 'a.action.previous', function (event) {
            intercept(event, function () {
                return interceptor.getCurrentPage() - 1;
            });
        });
        $(element).on('click', 'a.action.next', function (event) {
            intercept(event, function () {
                return interceptor.getCurrentPage() + 1;
            });
        });
    };
});