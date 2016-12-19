<?php

class Mdlext_Mdloption_Model_Config_Homepage 
{
    public function toOptionArray()
    {
        return array(
			array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Banner Bottom Collage Block')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Banner with 3 bottom static blocks')),
            array('value' => '3', 'label'=>Mage::helper('adminhtml')->__('Banner with 2 bottom static blocks')),
			array('value' => '4', 'label'=>Mage::helper('adminhtml')->__('Banner with 1 bottom static blocks'))
        );
    }
}
?>