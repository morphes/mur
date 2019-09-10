<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Plugins;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Request\Http as Request;
use Magento\Store\Model\StoreManagerInterface;
use Manadev\Core\Features;
use Manadev\Seo\Data\ConfigHistoryData;
use Manadev\Seo\Resources\ConfigHistoryResource;

class ConfigSaveAction
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var ConfigHistoryResource
     */
    protected $configHistoryResource;
    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var Features
     */
    protected $features;

    public function __construct(Context $context, ScopeConfigInterface $scopeConfig,
        ConfigHistoryResource $configHistoryResource, StoreManagerInterface $storeManager,
        Features $features)
    {
        $this->request = $context->getRequest();
        $this->messageManager = $context->getMessageManager();
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
        $this->scopeConfig = $scopeConfig;
        $this->configHistoryResource = $configHistoryResource;
        $this->storeManager = $storeManager;
        $this->features = $features;
    }

    public function aroundExecute($saveAction, callable $proceed) {
        if (!$this->features->isEnabled(__CLASS__, 0)) {
            return $proceed();
        }

        try {
            $this->saveHistory();
            $this->deleteHistory();
        }
        catch (\Exception $e) {
            $this->messageManager->addException($e,
                __('Something went wrong while creating redirects for old configuration values: %s', $e->getMessage()));

            return $this->stopSaving($saveAction);
        }

        return $proceed();
    }

    protected function saveHistory() {
        if (!($groups = $this->request->getParam('mana_create_redirect'))) {
            return;
        }

        foreach ($groups as $groupName => $group) {
            if (!isset($group['fields'])) {
                continue;
            }

            foreach ($group['fields'] as $fieldName => $field) {
                if (!isset($field['value'])) {
                    continue;
                }

                $this->compareValuesAndSave($groupName, $fieldName);
            }
        }
    }

    protected function deleteHistory() {
        if (!($groups = $this->request->getParam('mana_delete_redirect'))) {
            return;
        }

        foreach ($groups as $groupName => $group) {
            if (!isset($group['fields'])) {
                continue;
            }

            foreach ($group['fields'] as $fieldName => $field) {
                if (!isset($field['value'])) {
                    continue;
                }

                if (!is_array($field['value'])) {
                    continue;
                }

                $this->delete(array_keys($field['value']));
            }
        }
    }

    protected function stopSaving($saveAction) {
        $class = new \ReflectionClass($saveAction);
        $method = $class->getMethod('_saveState');
        $method->setAccessible(true);
        $method->invoke($saveAction, $this->request->getPost('config_state'));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('adminhtml/system_config/edit', [
            '_current' => ['section', 'website', 'store'],
            '_nosid' => true
        ]);
    }

    protected function compareValuesAndSave($group, $field) {
        $old = $this->getOldValue($group, $field);
        $new = $this->getNewValue($group, $field);
        if ($old == $new) {
            return;
        }

        $this->save($group, $field, $old);
    }

    protected function getOldValue($group, $field) {
        return $this->scopeConfig->getValue($this->getPath($group, $field), $this->getScopeType(), $this->getScope());
    }

    protected function getNewValue($group, $field) {
        if (!($groups = $this->request->getParam('groups'))) {
            return $this->getDefaultValue($group, $field);
        }

        if (!isset($groups[$group]['fields'][$field]['value'])) {
            return $this->getDefaultValue($group, $field);
        }

        return $groups[$group]['fields'][$field]['value'];
    }

    protected function save($group, $field, $value) {
        $this->configHistoryResource->saveOne(new ConfigHistoryData([
            'scope' => $this->getScopeType(),
            'scope_id' => $this->getScope() ?: '0',
            'path' => $this->getPath($group, $field),
            'value' => $value,
        ]));
    }

    protected function delete($ids) {
        $this->configHistoryResource->deleteById($ids);
    }

    protected function getPath($group, $field) {
        return "{$this->request->getParam('section')}/$group/$field";
    }

    protected function getScopeType() {
        if ($store = $this->request->getParam('store')) {
            return 'stores';
        }
        elseif ($website = $this->request->getParam('website')) {
            return 'websites';
        }
        else {
            return ScopeConfigInterface::SCOPE_TYPE_DEFAULT;
        }
    }

    protected function getScope() {
        if ($store = $this->request->getParam('store')) {
            return $store;
        }
        elseif ($website = $this->request->getParam('website')) {
            return $website;
        }
        else {
            return null;
        }
    }

    protected function getDefaultValue($group, $field) {
        if ($store = $this->request->getParam('store')) {
            return $this->scopeConfig->getValue($this->getPath($group, $field), 'website',
                $this->storeManager->getStore($store)->getWebsiteId());
        }
        elseif ($website = $this->request->getParam('website')) {
            return $this->scopeConfig->getValue($this->getPath($group, $field));
        }
        else {
            return null;
        }
    }
}