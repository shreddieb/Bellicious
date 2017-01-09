<?php

class Mdl_Mdltestimonials_Model_Mysql4_Mdltestimonials_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('mdltestimonials/mdltestimonials');
    }
}