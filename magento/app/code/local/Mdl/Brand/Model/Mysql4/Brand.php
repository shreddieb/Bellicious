<?php
class Mdl_Brand_Model_Mysql4_Brand extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("brand/brand", "brand_id");
    }
}