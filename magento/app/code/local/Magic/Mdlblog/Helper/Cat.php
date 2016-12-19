<?php

class Magic_Mdlblog_Helper_Cat extends Mage_Core_Helper_Abstract
{
    /**
     * Renders CMS page
     * Call from controller action
     *
     * @param Mage_Core_Controller_Front_Action $action
     * @param integer                           $identifier
     *
     * @return bool
     */
    public function renderPage(Mage_Core_Controller_Front_Action $action, $identifier = null)
    {
        if (!$catId = Mage::getSingleton('mdlblog/cat')->load($identifier)->getCatId()) {
            return false;
        }

        $pageTitle = Mage::getSingleton('mdlblog/cat')->load($identifier)->getTitle();
        $blogTitle = Mage::getStoreConfig('mdlblog/mdlblog/title') . " - " . $pageTitle;

        $action->loadLayout();
        if ($storage = Mage::getSingleton('customer/session')) {
            $action->getLayout()->getMessagesBlock()->addMessages($storage->getMessages(true));
        }
        $action->getLayout()->getBlock('head')->setTitle($blogTitle);

        $action->getLayout()->getBlock('root')->setTemplate(Mage::getStoreConfig('mdlblog/mdlblog/layout'));
        $action->renderLayout();

        return true;
    }
}