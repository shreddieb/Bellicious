<?php

class Mdlext_Mdloption_Model_Config_Headerbox 
{
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Header style 1')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Header style 2')),
			array('value' => '3', 'label'=>Mage::helper('adminhtml')->__('Header style 3')),
			array('value' => '4', 'label'=>Mage::helper('adminhtml')->__('Header style 4')),
			array('value' => '5', 'label'=>Mage::helper('adminhtml')->__('Header style 5')),
			array('value' => '6', 'label'=>Mage::helper('adminhtml')->__('Header style 6')),
			array('value' => '7', 'label'=>Mage::helper('adminhtml')->__('Header style 7')),
        );
    }
}
?>