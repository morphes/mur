<?php

/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */

namespace Mageside\AdminUsefulLinks\Controller\Preview;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
class Links extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * Links constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,

        PageFactory $resultPageFactory
    ) {

        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Links action
     *
     * @return $this
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        return $this->resultPageFactory->create();
    }
}
