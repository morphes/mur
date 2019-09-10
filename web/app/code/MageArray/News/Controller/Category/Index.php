<?php

namespace MageArray\News\Controller\Category;

use MageArray\News\Helper\Index\View;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use \MageArray\News\Helper\Data;
/**
 * Class Index
 * @package MageArray\News\Controller\Category
 */
class Index extends Action
{
    /**
     * @var View
     */
    protected $_viewHelper;

    protected $_dataHelper;

    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    protected $_categoryModel;

    /**
     * Index constructor.
     * @param Context $context
     * @param View $viewHelper
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        View $viewHelper,
        Data $dataHelper,
        PageFactory $resultPageFactory,
        \MageArray\News\Model\NewscatFactory $newscatFactory
    ) {
        $this->_viewHelper = $viewHelper;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_dataHelper = $dataHelper;
        $this->_categoryModel = $newscatFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $categoryId = $this->getRequest()->getParam('cat', false);
        $page = $this->_resultPageFactory->create(false, ['isIsolated' => true]);
        if($categoryId) {
            $category = $this->_categoryModel->create();
            $category = $category->load($categoryId);
            if($category) {
                $page->getConfig()->getTitle()->set(__($category->getCatName()));
                $breadcrumbShow = $this->_dataHelper
                    ->getStoreConfig('magearray_news/general/breadcrumb');
                if ($breadcrumbShow == 1) {
                    $breadcrumbs = $page->getLayout()
                        ->getBlock('breadcrumbs');
                    $breadcrumbs->addCrumb(
                        'home',
                        [
                            'label' => __('Home'),
                            'title' => __('Home'),
                            'link' => $this->_url->getUrl('')
                        ]
                    );
                    $breadcrumbs->addCrumb(
                        'news',
                        [
                            'label' => __('News'),
                            'title' => __('News'),
                            'link' => $this->_url->getUrl('news')
                        ]
                    );
                    $breadcrumbs->addCrumb(
                        'magearray_news',
                        [
                            'label' => __($category->getCatName()),
                            'title' => __($category->getCatName())
                        ]
                    );

                }
            }
        }

        $pageNo = $this->getRequest()->getParam('p');
        $this->_viewHelper->prepareAndRenderCat($page, $pageNo);
        return $page;
    }
}
