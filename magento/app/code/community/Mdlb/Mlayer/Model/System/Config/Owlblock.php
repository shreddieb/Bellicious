<?php
class Mdlb_Mlayer_Model_System_Config_Owlblock{
	
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('3 bottom static blocks')),
			array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('2 bottom static blocks')),
			array('value' => '3', 'label'=>Mage::helper('adminhtml')->__('No static blocks'))
        );
    }
}