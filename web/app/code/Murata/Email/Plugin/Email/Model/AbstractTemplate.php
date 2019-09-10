<?php

namespace Murata\Email\Plugin\Email\Model;

class AbstractTemplate
{
    private $emailConfig;

    public function __construct(\Magento\Email\Model\Template\Config $emailConfig)
    {
        $this->emailConfig = $emailConfig;
    }

    public function aroundSetForcedArea(\Magento\Email\Model\AbstractTemplate $subject, \Closure $proceed, $templateId)
    {
        if (!isset($subject->area)) {
            $subject->area = $this->emailConfig->getTemplateArea($templateId);
        }
        return $subject;
    }
}