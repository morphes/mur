/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

var config = {
    config: {
        mixins: {
            'Magento_Catalog/js/product/list/toolbar': {
                'Manadev_LayeredNavigationAjax/js/mixins/productListToolbar': true
            },
            'Magento_Swatches/js/swatch-renderer': {
                'Manadev_LayeredNavigationAjax/js/mixins/swatchRenderer': true
            },
            'Manadev_LayeredNavigationSliders/js/manaLayeredNavigationSlider': {
                'Manadev_LayeredNavigationAjax/js/mixins/setLocation': true
            },
            'Manadev_LayeredNavigationDropdown/js/manadevSelectFilter': {
                'Manadev_LayeredNavigationAjax/js/mixins/setLocation': true
            },
            'Manadev_LayeredNavigationRadio/js/manadevRadioFilter': {
                'Manadev_LayeredNavigationAjax/js/mixins/setLocation': true
            }
        }
    }
};