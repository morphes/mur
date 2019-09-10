<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Blocks\Adminhtml;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;

class UrlKeyFormContainer extends Container
{
    /**
     * @var Registry
     */
    protected $registry;

    public function __construct(Context $context, Registry $registry, array $data = []) {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize object state with incoming parameters
     *
     * @return void
     */
    protected function _construct()
    {
        /* @var $urlKey \Manadev\Seo\Models\UrlKey */
        $urlKey = $this->registry->registry('urlKey');

        $this->_objectId = 'id';
        $this->_blockGroup = 'Manadev_Seo';
        $this->_controller = 'urlKey';
        $this->_headerText = __("'%1' - %2 - URL Key",
            $urlKey->getData('url_key'), $urlKey->getData('description'));

        parent::_construct();

        if (!$this->_authorization->isAllowed('Manadev_Seo::url_key_save')) {
            $this->buttonList->remove('save');
        }

        $this->removeButton('reset');
        $this->removeButton('delete');
    }

    protected function _buildFormClassName()
    {
        return substr(__CLASS__, 0, strlen(__CLASS__) - strlen('Container'));
    }

}
