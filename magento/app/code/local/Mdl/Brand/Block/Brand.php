<?php   
class Mdl_Brand_Block_Brand extends Mage_Core_Block_Template
{   
   

   public function getBrandColletion()
   {
       return $this->_getBrandCollection();
   }
    
    /*
    * retrun brand collection
    */
    
   protected function _getBrandCollection()
   {   $config=Mage::helper('brand/data')->getStoreConfig();
       $sortOrder=$config['general']['sort_by'];
       $store_id=Mage::app()->getStore()->getId();
       $brandCollection=Mage::getModel('brand/brand')->getCollection()
       ->addStoreFilter($store_id)->addFieldToFilter('brand_status',1)
       ->setOrder($sortOrder,'asc');
       return $brandCollection; 
   }

   public function getBrand()
   {
       return $this->_getBrand();   
   }

   /*
    * retrun brand name 
    */
   protected function _getBrand()
   {
      $brandParam=Mage::helper('brand/data')->getBrandParam();
      $optionvalue=Mage::app()->getRequest()->getParam($brandParam);        
      $optionName=Mage::helper('brand/data')->getAttributeOptionName($optionvalue);
      $store_id=Mage::app()->getStore()->getId();
      $brand=Mage::getModel('brand/brand')->getCollection()
            ->addStoreFilter($store_id)->addFieldToFilter('brand_status',1)
            ->addFieldToFilter('brand_option_name',$optionName);              
      return $brand;         
    }
        
  
}