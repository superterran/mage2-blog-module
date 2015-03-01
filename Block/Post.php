<?php

namespace Superterran\Blog\Block;
class Post extends \Magento\Framework\View\Element\Template
{

//    protected $_post;
//    protected $pageFactory;

    protected $_blockFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Model\BlockFactory $_blockFactory,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->_blockFactory = $_blockFactory;
    }

     /**
     * Preparing layout
     *
     * @return \Magento\Catalog\Block\Breadcrumbs
     */
    protected function _prepareLayout()
    {
        $this->setPost($this->_blockFactory->create()->load($this->getIdentifier()));
        return parent::_prepareLayout();
    }

    public function getIdentifier()
    {
        return 'test';
    }

}
