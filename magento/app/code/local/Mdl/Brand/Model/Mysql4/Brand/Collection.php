<?php
class Mdl_Brand_Model_Mysql4_Brand_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{

   public function _construct()
   {
	  $this->_init("brand/brand");
   }

	public function addStoreFilter($store)
	{
       if ( !Mage::app()->isSingleStoreMode() ) {
		$filter = $this->addFieldToFilter('store_id', array(
		array('regexp'=>$store), 
		array('eq'=>'0')
		));
		return $filter;
		}
    return $this; 
   

    }
	
}
	 