<?php
/**
 * @copyright   Copyright (c) http://www.manadev.com
 * @license     http://www.manadev.com/license  Proprietary License
 */

namespace Manadev\LayeredNavigationCategoryTree\Controller\Tree;

use Magento\Catalog\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class SaveState extends Action
{

    /**
     * @var Session
     */
    protected $catalogSession;

    public function __construct(
        Context $context,
        Session $catalogSession
    ) {
        parent::__construct($context);
        $this->catalogSession = $catalogSession;
    }

    /**
     * Dispatch request
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute() {
        if($state = $this->getRequest()->getParam('state')) {
            $this->catalogSession->setManaTreeState($state);
        }
    }
}