<?php
class Mdl_Ajaxnav_FrontController extends Mage_Core_Controller_Front_Action {
    
    public function categoryAction() {
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

        $this->loadLayout();
        $response = array();
		$tempConfig = Mage::getStoreConfig('mdlpump/item_view/itemviewbox');
		$response['layer'] = $this->getLayout()->getBlock('layer')->toHtml();
		if($tempConfig==1)
		{
        $response['products'] = $this->getLayout()->getBlock('root')->toHtml();
		}
		elseif($tempConfig==2) {
		$response['products'] = $this->getLayout()->getBlock('type2')->toHtml();
		}
		elseif($tempConfig==3) {
		$response['products'] = $this->getLayout()->getBlock('type3')->toHtml();
		}
		elseif($tempConfig==4) {
		$response['products'] = $this->getLayout()->getBlock('type4')->toHtml();
		}
		elseif($tempConfig==5) {
		$response['products'] = $this->getLayout()->getBlock('type5')->toHtml();
		}
        $response['ajaxstate'] = $this->getLayout()->createBlock('catalog/product_list')->setTemplate('mdl/ajaxnav/layerstates.phtml')->toHtml();
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
    }

    public function searchAction() {
        $this->loadLayout();
        $response = array();
        $response['layer'] = $this->getLayout()->getBlock('layer')->toHtml();
        $response['products'] = $this->getLayout()->getBlock('root')->setIsSearchMode()->toHtml();
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
    }
}