<?php

class Mdl_Brand_Model_System_Config_Source_Sidebar
{
    const DISABLE_BRAND_IN_SIDEBAR=0;
    const SHOW_BRAND_IN_LEFT='left';
    const SHOW_BRAND_IN_RIGHT='right';
    
    
    
    public function toOptionArray()
    {
        return array(
            array('value' => self::DISABLE_BRAND_IN_SIDEBAR, 'label' => Mage::helper('adminhtml')->__('Select Sidebar')),
            array('value' => self::SHOW_BRAND_IN_LEFT, 'label' => Mage::helper('adminhtml')->__('Left')),
            array('value' => self::SHOW_BRAND_IN_RIGHT, 'label' => Mage::helper('adminhtml')->__('Right')),
          
        );
    }
}