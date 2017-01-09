<?php
class Mdl_Bestseller_Model_System_Config_Source_Filters
{
    public function toOptionArray()
    {
        return array(
			 array('value' => 0, 'label' => Mage::helper('adminhtml')->__('')),
            array('value' => 1, 'label' => Mage::helper('adminhtml')->__('ASC')),
            array('value' => 2, 'label' => Mage::helper('adminhtml')->__('DESC')),
            array('value' => 3, 'label' => Mage::helper('adminhtml')->__('RANDOM')),
        );
    }
}