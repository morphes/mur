<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\Seo\Blocks\Adminhtml;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Manadev\Core\Exceptions\NotSupported;
use Manadev\Seo\Data\ConfigHistoryData;
use Manadev\Seo\Resources\ConfigHistoryResource;

class FieldWithCreateRedirectCheckbox extends Field
{
    /**
     * @var ConfigHistoryResource
     */
    protected $configHistoryResource;

    public function __construct(Context $context, array $data = []) {
        parent::__construct($context, $data);

        $objectManager = ObjectManager::getInstance();
        $this->configHistoryResource = $objectManager->get(ConfigHistoryResource::class);
    }

    protected function _renderValue(AbstractElement $element)
    {
        if ($element->getTooltip()) {
            $html = '<td class="value with-tooltip">';
            $html .= $this->_getElementHtml($element);
            $html .= '<div class="tooltip"><span class="help"><span></span></span>';
            $html .= '<div class="tooltip-content">' . $element->getTooltip() . '</div></div>';
        } else {
            $html = '<td class="value">';
            $html .= $this->_getElementHtml($element);
            $html .= $this->getCreateRedirectHtml($element);
        }
        if ($element->getComment()) {
            $html .= '<p class="note"><span>' . $element->getComment() . '</span></p>';
        }
        $html .= '</td>';
        return $html;
    }

    protected function getCreateRedirectHtml(AbstractElement $element) {
        $id = $element->getHtmlId() . '_create_redirect';
        $name = str_replace('groups[', 'mana_create_redirect[', $element->getName());
        $checkBoxLabel = __('Create Redirect for old URL');
        $showHistoryLabel = __('Show redirects');

        $js = json_encode(["Manadev_Seo/js/createRedirectCheckbox" => [
            'hide_history_label' => __('Hide redirects'),
        ]]);

        $historyToggler = '';
        if ($historyHtml = $this->getHistoryHtml($element)) {
            $historyToggler = <<<EOT
<a href="#" class="toggle-history">$showHistoryLabel</a>
EOT;
        }

        return <<<EOT
<div class="admin__field admin__field-option mana-create-redirect" data-mage-init='$js'>
    <input type="checkbox" class="admin__control-checkbox" id="$id" name="$name" value="1" checked disabled>
    <label class="admin__field-label" for="$id">$checkBoxLabel</label>
    $historyToggler
</div>
$historyHtml
EOT;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function getHistoryHtml(AbstractElement $element) {
        $path = $element->getData('field_config')['path'] . '/' . $element->getData('field_config')['id'];
        $scope = $element->getData('scope');
        $scopeId = $element->getData('scope_id') ?: 0;

        $historyRecords = $this->configHistoryResource->getByScopeAndPath($scope, $scopeId, $path);

        if (!count($historyRecords)) {
            return '';
        }

        $valueLabel = __('Redirect From');
        $scopeLabel = __('Redirect Defined');
        $actionLabel = __('Action');

        return <<<EOT
<table class="mana-redirects">
    <thead>
        <tr>
            <th class="col-value">$valueLabel</th>
            <th class="col-scope">$scopeLabel</th>
            <th class="col-action">$actionLabel</th>
        </tr>
    </thead>
    <tbody>
        {$this->getHistoryRows($element, $historyRecords)}
    </tbody>
</table>
EOT;
    }

    /**
     * @param AbstractElement $element
     * @param ConfigHistoryData[] $historyRecords
     * @return string
     */
    protected function getHistoryRows(AbstractElement $element, $historyRecords) {
        $result = '';

        foreach ($historyRecords as $history) {
            $result .= $this->getHistoryRow($element, $history);
        }

        return $result;
    }

    /**
     * @param AbstractElement $element
     * @param ConfigHistoryData $history
     * @return string
     */
    protected function getHistoryRow(AbstractElement $element, $history) {
        return <<<EOT
<tr>
    <td class="col-value">{$this->escapeHtml($history->value)}</td>
    <td class="col-scope">{$this->getScopeCell($history)}</td>
    <td class="col-action">{$this->getDeleteCell($element, $history)}</td>
</tr>
EOT;
    }

    /**
     * @param ConfigHistoryData $history
     * @return string
     * @throws NotSupported
     */
    protected function getScopeCell($history) {
        switch ($history->scope) {
            case 'stores':
                return $this->escapeHtml(__('On store level'));
            case 'websites':
                return $this->escapeHtml(__('On website level'));
            case 'default':
                return $this->escapeHtml(__('Globally'));
            default:
                throw new NotSupported();
        }
    }

    /**
     * @param AbstractElement $element
     * @param ConfigHistoryData $history
     * @return string
     */
    protected function getDeleteCell($element, $history) {
        $id = $element->getHtmlId() . '_delete_redirect_' . $history->id;
        $name = str_replace('groups[', 'mana_delete_redirect[', $element->getName()) . "[{$history->id}]";
        $checkBoxLabel = __('Delete');

        return <<<EOT
    <input type="checkbox" class="admin__control-checkbox" id="$id" name="$name" value="1">
    <label class="admin__field-label" for="$id">$checkBoxLabel</label>
EOT;
    }
}