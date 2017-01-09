<?php
class Mdl_Bestseller_IndexController extends Mage_Core_Controller_Front_Action {

	public function tabAction() {
		$id = $this->getRequest()->getParam('tabid');
		$product_block = new Mage_Catalog_Block_Product;
		$html='';
		if($id=='tab-bestseller')
		{
			$html.= Mage::getSingleton('core/layout')->createBlock('bestseller/bestsellingproduct')->setTemplate('mdl-bestseller/bestseller-product.phtml')->toHtml();
		} else {
			$html.= Mage::getSingleton('core/layout')->createBlock('bestseller/bestsellingproduct')->setTemplate('mdl-bestseller/new-product.phtml')->toHtml();
		}
			echo $html;
		}
		
		 public function clearAction()
    {
		 $response = array();
        $items = Mage::getResourceModel('catalog/product_compare_item_collection');

        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $items->setCustomerId(Mage::getSingleton('customer/session')->getCustomerId());
        } elseif ($this->_customerId) {
            $items->setCustomerId($this->_customerId);
        } else {
            $items->setVisitorId(Mage::getSingleton('log/visitor')->getId());
        }

        /** @var $session Mage_Catalog_Model_Session */
        $session = Mage::getSingleton('catalog/session');

        try {
            $items->clear();
            $session->addSuccess($this->__('The comparison list was cleared.'));
			
            Mage::helper('catalog/product_compare')->calculate();
        } catch (Mage_Core_Exception $e) {
            $session->addError($e->getMessage());
        } catch (Exception $e) {
            $session->addException($e, $this->__('An error occurred while clearing comparison list.'));
        }
		 $response['done'] ='done';
		  $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        return;
       
    }
	
	 public function removeAction()
    {
		 $response = array();
        if ($productId = (int) $this->getRequest()->getParam('product')) {
            $product = Mage::getModel('catalog/product')
                ->setStoreId(Mage::app()->getStore()->getId())
                ->load($productId);

            if($product->getId()) {
                /** @var $item Mage_Catalog_Model_Product_Compare_Item */
                $item = Mage::getModel('catalog/product_compare_item');
                if(Mage::getSingleton('customer/session')->isLoggedIn()) {
                    $item->addCustomerData(Mage::getSingleton('customer/session')->getCustomer());
                } elseif ($this->_customerId) {
                    $item->addCustomerData(
                        Mage::getModel('customer/customer')->load($this->_customerId)
                    );
                } else {
                    $item->addVisitorId(Mage::getSingleton('log/visitor')->getId());
                }

                $item->loadByProduct($product);

                if($item->getId()) {
                    $item->delete();
                    Mage::getSingleton('catalog/session')->addSuccess(
                        $this->__('The product %s has been removed from comparison list.', $product->getName())
                    );
                    Mage::dispatchEvent('catalog_product_compare_remove_product', array('product'=>$item));
                    Mage::helper('catalog/product_compare')->calculate();
                }
            }
        }
		//die('here');
		 $response['done'] ='done';
		  $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        return;
       
    }
		
		public function compareAction(){
        $response = array();
		 $added = array();
 		$collection = $this->getLayout()->createBlock('catalog/product_compare_list')->getItems();
		
		foreach($collection as $product) {
			$added[] = $product->getId();
		}
		
		$productId = (int) $this->getRequest()->getParam('product');
		if(in_array($productId,$added))	
		{
			 $response['already']='This product is already added in comparision list';
			 $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        	return;
		}
		else
		{
		 $response['already']='';	
			
		}
        if ($productId = (int) $this->getRequest()->getParam('product')) {
            $product = Mage::getModel('catalog/product')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($productId);
 
            if ($product->getId()/* && !$product->isSuper()*/) {
                Mage::getSingleton('catalog/product_compare_list')->addProduct($product);
                $response['status'] = 'SUCCESS';
                $response['message'] = $this->__('The product %s has been added to comparison list.', Mage::helper('core')->escapeHtml($product->getName()));
                Mage::register('referrer_url', $this->_getRefererUrl());
                Mage::helper('catalog/product_compare')->calculate();
                Mage::dispatchEvent('catalog_product_compare_add_product', array('product'=>$product));
                $this->loadLayout();
                $sidebar_block = $this->getLayout()->getBlock('catalog.product.compare.sidebar');
                $sidebar_block->setTemplate('mdl-bestseller/catalog/product/compare/sidebar.phtml');
                $sidebar = $sidebar_block->toHtml();
                $response['sidebar'] = $sidebar;
            }
        }
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        return;
    }
}
?>