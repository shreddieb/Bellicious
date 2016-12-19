<?php

class Magic_Mdlblog_Model_Api extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('mdlblog/mdlblog');
    }

    public function getPostUrl($id)
    {
        $post = $this->load($id);
        if ($post->getId()) {
            $route = Mage::helper('mdlblog')->getRoute();
            return Mage::getUrl("{$route}/{$post->getIdentifier()}");
        }
        return false;
    }

    public function getPostCategories($id)
    {
        return Mage::getModel('mdlblog/cat')
            ->getCollection()
            ->addStoreFilter(Mage::app()->getStore()->getId())
            ->addPostFilter($id)
        ;
    }

    public function getPosts($status = array(), $store = array())
    {
        $collection = Mage::getModel('mdlblog/post')->getCollection();
        if (is_array($store) && !empty($store)) {
            $collection->addStoreFilter($store);
        }
        if (!empty($status)) {
            $collection->addStatusFilter($status);
        } else {
            $collection->addStatusFilter();
        }
        return $collection;
    }

    public function getPostShortContent($post, $storeId = 0)
    {
        $content = $post->getPostContent();
        $isUseShortContent = Mage::getStoreConfig(Magic_Mdlblog_Helper_Config::XML_BLOG_USESHORTCONTENT, $storeId);
        if ($isUseShortContent && trim($post->getShortContent())) {
            $content = trim($post->getShortContent());
        } elseif ((int)Mage::getStoreConfig(Magic_Mdlblog_Helper_Config::XML_BLOG_READMORE, $storeId)) {
            $strManager = new Magic_Mdlblog_Helper_Substring(
                array(
                     'input' => Mage::helper('mdlblog')->filterWYS($post->getPostContent())
                )
            );
            $content = $strManager->getHtmlSubstr((int)Mage::getStoreConfig(Magic_Mdlblog_Helper_Config::XML_BLOG_READMORE));
        }
        return $content;
    }
}