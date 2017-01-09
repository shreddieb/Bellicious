<?php
class Mdlb_Mlayer_Model_System_Config_Bannerfullwidth 
{
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label'=>Mage::helper('adminhtml')->__('Full width')),
            array('value' => '2', 'label'=>Mage::helper('adminhtml')->__('Boxed'))
        );
    }
}