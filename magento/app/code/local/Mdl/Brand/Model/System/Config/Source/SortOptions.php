<?php

class Mdl_Brand_Model_System_Config_Source_SortOptions
{
    const By_Name='brand_option_name';
    const By_POSITION='brand_position';
    const BY_ID='brand_id';
    
    
    
    public function toOptionArray()
    {
        return array(
            array('value' => self::By_Name, 'label' => Mage::helper('adminhtml')->__(' By Name ')),
            array('value' => self::By_POSITION, 'label' => Mage::helper('adminhtml')->__(' By  Postion ')),
            array('value' => self::BY_ID, 'label' => Mage::helper('adminhtml')->__('By ID')),
          
        );
    }
}