<?php

class Magic_Mdlblog_Model_System_Config_Source_Listviewoption
{
    public function toOptionArray()
    {
        return array(
            array('value' => 1, 'label' => Mage::helper('adminhtml')->__('1 column')),
            array('value' => 2, 'label' => Mage::helper('adminhtml')->__('2 column')),
            array('value' => 3, 'label' => Mage::helper('adminhtml')->__('3 column')),
        );
    }
}