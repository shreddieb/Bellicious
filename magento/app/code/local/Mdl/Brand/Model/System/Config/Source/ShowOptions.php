<?php

class Mdl_Brand_Model_System_Config_Source_ShowOptions
{
    const LABEL_ONLY='label_only';
    const IMAGE_ONLY='image_only';
    const IMAGE_AND_LABEL='image_and_lable';
    
    
    public function toOptionArray()
    {
        return array(
            array('value' => self::LABEL_ONLY, 'label' => Mage::helper('adminhtml')->__(' Label Only ')),
            array('value' => self::IMAGE_ONLY, 'label' => Mage::helper('adminhtml')->__(' Image Only ')),
            array('value' => self::IMAGE_AND_LABEL, 'label' => Mage::helper('adminhtml')->__(' Image and Label')),
        );
    }
}