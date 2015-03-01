<?php
/***
namespace Superterran\Blog\Block;
class Post extends \Magento\Framework\View\Element\Template
{
    /**
     * Preparing layout
     *
     * @return \Magento\Catalog\Block\Breadcrumbs
     /
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}

***************/

namespace Superterran\Blog\Block;
//class Post extends \Magento\Framework\View\Element\Template
class Posts extends \Magento\Framework\View\Element\AbstractBlock implements \Magento\Framework\View\Block\IdentityInterface
{
    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    protected $_filterProvider;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * Block factory
     *
     * @var \Magento\Cms\Model\BlockFactory
     */
    protected $_blockFactory;


    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $_post;


    protected $pageConfig;


    protected $collection;

    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Context $context
     * @param \Magento\Cms\Model\Template\FilterProvider $filterProvider
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Cms\Model\BlockFactory $blockFactory
     * @param array $data
     */
//    public function __construct(
//        \Magento\Framework\View\Element\Context $context,
//        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
//        \Magento\Store\Model\StoreManagerInterface $storeManager,
//        \Magento\Cms\Model\BlockFactory $blockFactory,
//        array $data = []
//    ) {
//        parent::__construct($context, $data);
//        $this->_filterProvider = $filterProvider;
//        $this->_storeManager = $storeManager;
//        $this->_blockFactory = $blockFactory;
//    }


    public function __construct(
        \Magento\Framework\View\Element\Context $context,
        \Magento\Cms\Model\Block $page,
        \Magento\Cms\Model\Template\FilterProvider $filterProvider,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Cms\Model\BlockFactory $pageFactory,
        \Magento\Framework\View\Page\Config $pageConfig,
//        \Magento\Cms\Model\Resource\Block\Collection $collection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        // used singleton (instead factory) because there exist dependencies on \Magento\Cms\Helper\Page
        $this->_post = $page;
        $this->_filterProvider = $filterProvider;
        $this->_storeManager = $storeManager;
        $this->_blockFactory = $pageFactory;
        $this->pageConfig = $pageConfig;
    }


    /**
     * Prepare Content HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $blockId = $this->getBlockId();
        $blockId = 'test';

        $html = 'initial content';




        return $html;

        $html = '';
        if ($blockId) {
            $storeId = $this->_storeManager->getStore()->getId();
            /** @var \Magento\Cms\Model\Block $block */
            $block = $this->_blockFactory->create();
            $block->setStoreId($storeId)->load($blockId);
            if ($block->getIsActive()) {
                $html = $this->_filterProvider->getBlockFilter()->setStoreId($storeId)->filter($block->getContent());
            }
        }
        return $html;
    }

    /**
     * Return identifiers for produced content
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Superterran\Blog\Model\Post::CACHE_TAG . '_' . $this->getBlockId()];
    }


    protected function _prepareLayout()
    {
        $post = $this->getPost();
//        $this->_addBreadcrumbs($post);
        $this->pageConfig->addBodyClass('blog-' . $post->getIdentifier());
        $this->pageConfig->getTitle()->set($post->getTitle());
        $this->pageConfig->setKeywords($post->getMetaKeywords());
        $this->pageConfig->setDescription($post->getMetaDescription());
//
        $pageMainTitle = $this->getLayout()->getBlock('page.main.title');
        if ($pageMainTitle) {
         //    Setting empty page title if content heading is absent
            $cmsTitle = $post->getTitle() ?: ' ';
            $pageMainTitle->setPageTitle($this->escapeHtml($cmsTitle));
        }
        return parent::_prepareLayout();
    }



    /**
     * Retrieve Page instance
     *
     * @return \Magento\Cms\Model\Page
     */
    public function getPost()
    {
        if (!$this->hasData('post')) {
            if ($this->getBlockId()) {
                /** @var \Magento\Cms\Model\Page $page */
                $post = $this->_blockFactory->create();
                $post->setStoreId($this->_storeManager->getStore()->getId())->load($this->getBlockId(), 'identifier');
            } else {
                $post = $this->_post;
            }
            $this->setData('post', $post);
        }
        return $this->getData('post');
    }

    public function getBlockId()
    {
        return 'test';
    }

}