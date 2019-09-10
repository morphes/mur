<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\AdminUsefulLinks\Block\Adminhtml\System\Config\Fieldset;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\ProductMetadataInterface;
use Magento\Framework\Module\ModuleList\Loader;
use Mageside\AdminUsefulLinks\Helper\Config as Helper;
use \Magento\Framework\Data\Form\Element\Renderer\RendererInterface;

class Hint extends \Magento\Backend\Block\Template implements RendererInterface
{
    /**
     * @var string
     */
    protected $_template = 'Mageside_AdminUsefulLinks::system/config/fieldset/hint.phtml';

    /**
     * @var \Magento\Framework\App\ProductMetadataInterface
     */
    protected $_metaData;

    /**
     * @var \Magento\Framework\Module\ModuleList\Loader
     */
    protected $_loader;

    /**
     * @var \Mageside\AdminUsefulLinks\Helper\Config
     */
    protected $_helper;

    /**
     * @param Context $context
     * @param ProductMetadataInterface $productMetaData
     * @param Loader $loader
     * @param Helper $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        ProductMetadataInterface $productMetaData,
        Loader $loader,
        Helper $helper,
        $data = []
    ) {
        parent::__construct($context, $data);
        $this->_metaData = $productMetaData;
        $this->_loader = $loader;
        $this->_helper = $helper;
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return mixed
     */
    public function render(AbstractElement $element)
    {
        return $this->toHtml();
    }

    public function getModuleName()
    {
        return $this->_helper->getConfigModule('module_name');
    }

    public function getVersion()
    {
        $modules = $this->_loader->load();
        $v = "";
        if (isset($modules['Mageside_AdminUsefulLinks'])) {
            $v = "v" . $modules['Mageside_AdminUsefulLinks']['setup_version'];
        }

        return $v;
    }

    public function getModulePage()
    {
        return $this->_helper->getConfigModule('module_page_link');
    }
}
