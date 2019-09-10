<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\AdminUsefulLinks\Helper;

/**
 * Class Config
 * @package Mageside\AdminUsefulLinks\Helper
 */
class Config extends \Magento\Framework\App\Helper\AbstractHelper
{

    /**
     * Get module settings
     *
     * @param string $key
     * @param string $section
     * @return mixed
     */
    public function getConfigModule($key, $section = 'general')
    {
        return $this->scopeConfig
            ->getValue(
                "mageside_adminusefullinks/{$section}/{$key}",
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        if ($this->getConfigModule('enabled')
            && $this->isModuleOutputEnabled('Mageside_AdminUsefulLinks')
        ) {
            return true;
        }

        return false;
    }

}
