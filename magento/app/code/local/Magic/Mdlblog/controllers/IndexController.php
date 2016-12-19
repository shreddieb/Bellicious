<?php

class Magic_Mdlblog_IndexController extends Mage_Core_Controller_Front_Action
{
    public function preDispatch()
    {
        parent::preDispatch();
        if (!Mage::helper('mdlblog')->getEnabled()) {
            $this->_redirectUrl(Mage::helper('core/url')->getHomeUrl());
        }
        Mage::helper('mdlblog')->ifStoreChangedRedirect();
    }

    public function indexAction()
    {
        $this->_forward('list');
    }

    public function listAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('root')->setTemplate(Mage::helper('mdlblog')->getLayout());
        $this->renderLayout();
    }
}