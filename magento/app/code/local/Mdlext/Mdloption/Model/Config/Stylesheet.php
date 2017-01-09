<?php

class Mdlext_Mdloption_Model_Config_Stylesheet 
{
    public function toOptionArray()
    {
        return array(
			array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Default')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Yellow')),
            array('value' => '3', 'label'=>Mage::helper('adminhtml')->__('Green')),
			array('value' => '4', 'label'=>Mage::helper('adminhtml')->__('Blue')),
			array('value' => '5', 'label'=>Mage::helper('adminhtml')->__('Pink')),
        );
    }
}
?>