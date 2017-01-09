<?php
class Mdl_Mdltestimonials_Model_Mysql4_Mdltestimonials extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('mdltestimonials/mdltestimonials', 'mdltestimonials_id');
    }
}