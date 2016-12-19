<?php

class Mdlext_Mdloption_Model_Config_Itemview 
{
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Item view style 1')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Item view style 2')),
			array('value' => '3', 'label'=>Mage::helper('adminhtml')->__('Item view style 3')),
			array('value' => '4', 'label'=>Mage::helper('adminhtml')->__('Item view style 4')),
			array('value' => '5', 'label'=>Mage::helper('adminhtml')->__('Item view style 5')),
        );
    }
}
?>