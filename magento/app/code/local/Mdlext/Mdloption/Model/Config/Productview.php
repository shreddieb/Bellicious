<?php

class Mdlext_Mdloption_Model_Config_Productview 
{
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Product view style 1')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Product view style 2')),
        );
    }
}
?>