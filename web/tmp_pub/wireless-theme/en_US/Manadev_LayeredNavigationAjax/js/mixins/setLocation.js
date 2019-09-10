define(['Manadev_LayeredNavigationAjax/js/vars/interceptor'], function(interceptor) {
    return function(ClassHavingSetLocation) {
        var originalSetLocation = ClassHavingSetLocation.prototype.setLocation;

        ClassHavingSetLocation.prototype.setLocation = function (url, action) {
            if (!interceptor.intercept(url, this.element[0], action)) {
                originalSetLocation.call(this, url, action);
            }
        };

        return ClassHavingSetLocation;
    };
});