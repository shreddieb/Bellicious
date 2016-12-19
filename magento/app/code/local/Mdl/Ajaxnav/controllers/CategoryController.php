<?php
class Mdl_Ajaxnav_CategoryController extends Mage_Core_Controller_Front_Action {
    public function viewAction() {
        // init category
        $categoryId = (int) $this->getRequest()->getParam('id', false);
        if (!$categoryId) {
            $this->_forward('noRoute');
            return;
        }

        $category = Mage::getModel('catalog/category')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($categoryId);
        Mage::register('current_category', $category);
        $this->getLayout()->createBlock('ajaxnav/catalog_layer_view');
        $this->loadLayout();
        $this->renderLayout();
    }
}