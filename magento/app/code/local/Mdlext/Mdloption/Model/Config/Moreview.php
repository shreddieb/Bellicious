<?php

class Mdlext_Mdloption_Model_Config_Moreview
{
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('More view on left')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('More view on Bottom')),
        );
    }
}
?>