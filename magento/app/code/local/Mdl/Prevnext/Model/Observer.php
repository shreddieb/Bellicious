<?php
class Mdl_Prevnext_Model_Observer
{
    public function setInchooFilteredCategoryProductCollection()
    {
		//print_r(Mage::app()->getRequest()->getControllerName());
		//print_r(Mage::app()->getRequest()->getActionName());
		if (Mage::app()->getRequest()->getControllerName() == 'product' && Mage::app()->getRequest()->getActionName() == 'view') {
			$products = Mage::app()->getLayout()
					->getBlockSingleton('Mage_Catalog_Block_Product_List')
					->getLoadedProductCollection()
					->getColumnValues('entity_id');

					//print_r($products);
					
			Mage::getSingleton('core/session')
					->setInchooFilteredCategoryProductCollection($products);

			unset($products);
		}
		if (Mage::app()->getRequest()->getControllerName() == 'category' && Mage::app()->getRequest()->getActionName() == 'view') {
			
			
			$products = Mage::app()->getLayout()
					->getBlockSingleton('Mage_Catalog_Block_Product_List')
					->getLoadedProductCollection()
					->getColumnValues('entity_id');

			Mage::getSingleton('core/session')
					->setInchooFilteredCategoryProductCollection($products);

			unset($products);
		}
		return $this;        
    }
}