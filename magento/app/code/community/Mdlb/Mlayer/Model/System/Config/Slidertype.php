<?php
class Mdlb_Mlayer_Model_System_Config_Slidertype{
	
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Full Screen Slider')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Camera Slider')),
			array('value' => '3', 'label'=>Mage::helper('adminhtml')->__('Owl Slider')),
        );
    }
}