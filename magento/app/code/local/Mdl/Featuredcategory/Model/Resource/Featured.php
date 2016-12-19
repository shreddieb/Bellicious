<?php 
class Mdl_Featuredcategory_Model_Resource_Featured extends Mage_Core_Model_Resource_Db_Abstract{
    protected function _construct()
    {   
        $this->_init('featuredcategory/featured', 'featured_id');
    }
}