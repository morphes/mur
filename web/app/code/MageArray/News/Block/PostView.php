<?php

namespace MageArray\News\Block;

use MageArray\News\Helper\Data;
use MageArray\News\Model\Categories;
use MageArray\News\Model\Newspost;
use MageArray\News\Model\NewspostFactory;
use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use MageArray\News\Model\NewscatFactory;

/**
 * Class PostView
 * @package MageArray\News\Block
 */
class PostView extends Template
{
    const CATEGORY_RELEASES = 1;
    const CATEGORY_BLOGROLL = 2;
    const CATEGORY_PRODUCTS = 3;
    const CATEGORY_DCDC = 4;
    const CATEGORY_ACDC = 5;
    const CATEGORY_DPM = 6;
    const CATEGORY_MAGNETICS = 7;
    const CATEGORY_JAPAN = 15;
    const CATEGORY_OKAMI = 19;

    /**
     * @var Newspost
     */
    protected $_post;
    /**
     * @var NewspostFactory
     */
    protected $_newspostFactory;
    /**
     * @var Data
     */
    protected $_dataHelper;
    /**
     * @var Categories
     */
    protected $_categories;
    /**
     * @var FilterProvider
     */
    protected $_filterProvider;

    /**
     * @return $this
     */
    public function _prepareLayout()
    {
        $dataPost = $this->getPost();
        if ($dataPost['meta_title']) {
            $metaTitle = $dataPost['meta_title'];
        } else {
            $metaTitle = $dataPost['title'];
        }
        $this->pageConfig->getTitle()->set($metaTitle);
        $this->pageConfig->setKeywords($dataPost['meta_keywords']);
        $this->pageConfig->setDescription($dataPost['meta_description']);
        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle) {
            $pageMainTitle->setPageTitle($dataPost['title']);
        }
        return parent::_prepareLayout();
    }

    /**
     * PostView constructor.
     * @param Context $context
     * @param Newspost $post
     * @param NewspostFactory $postFactory
     * @param Categories $categories
     * @param Data $dataHelper
     * @param FilterProvider $filterProvider
     * @param array $data
     */
    public function __construct(
        Context $context,
        Newspost $post,
        NewspostFactory $postFactory,
        NewscatFactory $newscatFactory,
        Categories $categories,
        Data $dataHelper,
        FilterProvider $filterProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_post = $post;
        $this->_newspostFactory = $postFactory;
        $this->_newscatFactory = $newscatFactory;
        $this->_dataHelper = $dataHelper;
        $this->_categories = $categories;
        $this->_filterProvider = $filterProvider;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        if (!$this->hasData('post')) {
            if ($this->getPostId()) {
                $postData = $this->_newspostFactory->create();
                $post = $postData->getCollection()
                    ->setActiveFilter(true)
                    ->setPostFilter()
                    ->setStoreFilter($this->getStoreId());
            } else {
                $post = $this->_post;
            }
            $this->setData('post', $post);
        }
        return $this->getData('post');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->_filterProvider
            ->getBlockFilter()->filter($this->getPost()->getContent());
    }

    /**
     *
     */
    public function setPageView()
    {
        $id = $this->getRequest()->getParam('id');
        $postData = $this->_newspostFactory->create();
        $postViewsOld = $postData->load($id)->getViews();
        $postViewsNew = $postViewsOld + 1;
        $postData->setViews($postViewsNew);
        $postData->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTotalPosts($id)
    {
        $now = date('Y-m-d');
        $post = $this->_newspostFactory->create();
        $postCollection = $post->getCollection()
            ->addFieldToFilter('category', ['finset' => $id])
            ->setActiveFilter(true)
            ->setPostFilter()
            ->setStoreFilter($this->getStoreId())
            ->addFieldToFilter('publish_date', ['lteq' => $now]);
        $postCount = count($postCollection);
        return $postCount;
    }

    /**
     * @return mixed
     */
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    /**
     * @return int
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    /**
     * @return mixed
     */
    public function getCategoryTree()
    {
        return $this->_categories->getfrontOptionArray();
    }

    /**
     * @param $item
     * @param $width
     * @return bool|string
     */
    public function getImageUrl($item, $width)
    {
        return $this->_dataHelper->resize($item, $width);
    }

    /**
     * @param $item
     * @param $width
     * @return bool|string
     */
    public function getThumbImageUrl($item, $width)
    {
        return $this->_dataHelper->resizeThumb($item, $width);
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->getViewFileUrl('MageArray_News::images/views.png');
    }

    public function getMetaImageurl($item)
    {
        $image = $item->getImage();
        return $this->_dataHelper->getBaseUrlMedia() . $image;
    }

    public function getSecureConfig()
    {
        return $this->_storeManager->getStore()->isCurrentlySecure();
    }

    public function getCategories($post)
    {
        return explode(',', $post->getCategory());
    }

    public function isOkami($categories)
    {
        foreach($categories as $categoryId) {
            if($categoryId == self::CATEGORY_OKAMI) {
                return true;
            }
        }
    }

    public function isFrench($categories)
    {
        return false;
    }

    public function isGerman($categories)
    {
        return false;
    }

    public function isItalian($categories)
    {
        return false;
    }

    public function isChinese($categories)
    {
        return false;
    }

    public function isJapanese($categories)
    {
        foreach($categories as $categoryId) {
            if($categoryId == self::CATEGORY_JAPAN) {
                return true;
            }
        }
    }

    public function isNpi($categories)
    {
        foreach($categories as $categoryId) {
            if($categoryId == self::CATEGORY_PRODUCTS) {
                return true;
            }
        }
    }

    public function isNr($categories)
    {
        foreach($categories as $categoryId) {
            if($categoryId == self::CATEGORY_RELEASES) {
                return true;
            }
        }
    }

    public function getCategory($id)
    {
        $newsCatModel = $this->_newscatFactory->create();
        return $newsCatModel->load($id);
    }

}
