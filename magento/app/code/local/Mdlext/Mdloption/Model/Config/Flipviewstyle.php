<?php

class Mdlext_Mdloption_Model_Config_Flipviewstyle
{
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Slide')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Fade')),
        );
    }
}
?>